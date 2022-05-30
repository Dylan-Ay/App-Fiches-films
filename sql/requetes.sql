-- a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et réalisateur
SELECT id_movie, title, release_date, length, p.lastname, p.firstname
FROM movie m 
INNER JOIN director d
ON d.id_director = m.id_director
INNER JOIN person p 
ON p.id_person = d.id_person;

-- b. Liste des films dont la durée excède 2h15 classés par durée (du plus long au plus court)
SELECT *
FROM movie 
WHERE length > 135
ORDER BY length DESC;

-- c. Liste des films d’un réalisateur (en précisant l’année de sortie)
SELECT title, release_date
FROM movie m
INNER JOIN director d
ON d.id_director = m.id_director
INNER JOIN person p
ON p.id_person = d.id_person
WHERE p.lastname = "lucas";

-- d. Nombre de films par genre (classés dans l’ordre décroissant) 
SELECT name, COUNT(mt.id_movie) AS nbMovies
FROM type t 
INNER JOIN movie_type mt 
ON t.id_type = mt.id_type
GROUP BY name
ORDER BY nbMovies DESC;

-- e. Nombre de films par réalisateur (classés dans l’ordre décroissant)
SELECT p.firstname, p.lastname, COUNT(m.id_director) AS nbMoviePerDirector
FROM movie m 
INNER JOIN director d 
ON d.id_director = m.id_director
INNER JOIN person p 
ON p.id_person = d.id_person
GROUP BY p.lastname
ORDER BY nbMoviePerDirector DESC;

-- f. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe
SELECT lastname, firstname, gender
FROM person p 
INNER JOIN actor a 
ON a.id_person = p.id_person
INNER JOIN casting c 
ON a.id_actor = c.id_actor
WHERE c.id_movie = 2
GROUP BY lastname;

-- g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de sortie (du film le plus récent au plus ancien)
SELECT title, release_date, r.role_name, p.firstname, p.lastname
FROM movie m 
INNER JOIN casting c
ON c.id_movie = m.id_movie
INNER JOIN actor a 
ON a.id_actor = c.id_actor
INNER JOIN person p 
ON p.id_person = a.id_person
INNER JOIN role r 
ON r.id_role = c.id_role
WHERE a.id_actor = 1
GROUP BY title
ORDER BY release_date DESC;

-- h. Listes des personnes qui sont à la fois acteurs et réalisateurs 
SELECT *
FROM person p 
WHERE p.id_person IN ( 
    SELECT a.id_person
    FROM actor a
) AND p.id_person IN (
    SELECT d.id_person
    FROM director d);

-- i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)
SELECT *
FROM movie
WHERE TIMESTAMPDIFF(YEAR, release_date,DATE(NOW())) < 5
ORDER BY release_date DESC;

-- j. Nombre d’hommes et de femmes parmi les acteurs

-- Nombre d'hommes 
SELECT p.firstname, p.lastname, COUNT(a.id_person) AS nbMen
FROM actor a
INNER JOIN person p
ON p.id_person = a.id_person
WHERE p.gender = "Homme";
    

-- L'addition des 2 
SELECT COUNT(a.id_person) AS nbMenAndWomen
FROM actor a
INNER JOIN person p
ON p.id_person = a.id_person
WHERE p.gender = "Homme" OR p.gender = "Femme";

-- Avec UNION

(SELECT gender, COUNT(a.id_person) AS nbMenAndWomen
    FROM actor a
    INNER JOIN person p
    ON p.id_person = a.id_person
    WHERE p.gender = "Homme")
UNION
(SELECT gender, COUNT(a.id_person) AS nbMenAndWomen
    FROM actor a
    INNER JOIN person p
    ON p.id_person = a.id_person
    WHERE p.gender = "Femme");

-- k. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)
SELECT *
FROM person p 
INNER JOIN actor a
ON p.id_person = a.id_person
WHERE TIMESTAMPDIFF(YEAR, p.birthdate, DATE(NOW())) > 50;

-- l. Acteurs ayant joué dans 3 films ou plus 
SELECT p.firstname, p.lastname
FROM person p
INNER JOIN actor a 
ON a.id_person = p.id_person
INNER JOIN casting c
ON c.id_actor = a.id_actor
GROUP BY p.lastname
HAVING COUNT(c.id_movie) >= 3;

-- Autres

-- Liste des acteurs : 
SELECT firstname, lastname, picture
FROM person p
INNER JOIN actor a
ON p.id_person = a.id_person
ORDER BY p.firstname;