<?php
require_once "db/DAO.php";

class MovieController{

    public function findAll(){
        $db = new DAO;
        $sql = 
        "SELECT m.id_movie AS id_movie, title, release_date, m.poster, length, p.lastname, p.firstname
        FROM movie m 
        INNER JOIN director d
        ON d.id_director = m.id_director
        INNER JOIN person p 
        ON p.id_person = d.id_person
        ORDER BY title";
        $movies = $db->executeRequest($sql);
        require "views/movie/moviesList.php";
    }

    public function findOneById($id) {
        $db = new DAO;
        $sql = 
        "SELECT title, DATE_FORMAT(release_date, '%d %M %Y') AS release_date, length, synopsis, rate, m.poster AS poster, p.firstname AS firstname, p.lastname AS lastname, m.id_director AS id_director, g.name AS genre
        FROM movie m
        INNER JOIN director d
        ON d.id_director = m.id_director
        INNER JOIN person p 
        ON p.id_person = d.id_person
        INNER JOIN movie_genre mg
        ON mg.id_movie = m.id_movie
        INNER JOIN genre g
        ON g.id_genre= mg.id_genre
        WHERE m.id_movie = :id ";
        $stateMovie = $db->executeRequest($sql, ["id" => $id]);

        $sql2 =
        "SELECT firstname, lastname, poster, a.id_actor
        FROM person p 
        INNER JOIN actor a
        ON a.id_person = p.id_person
        INNER JOIN casting c
        ON c.id_actor = a.id_actor
        WHERE c.id_movie = :id
        GROUP BY p.firstname;";
        $displayActor = $db->executeRequest($sql2, ["id" => $id]);

        require "views/movie/detailMovie.php";
    }
}