<?php
require_once "db/DAO.php";

class MovieController{

    // Get all movies for moviesList.php
    public function findAll()
    {
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

    // Get Movie by id for detailMovie.php
    public function findOneById($id) 
    {
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

    public function addMovie()
    {
        // Get all the directors names for the select
        $db = new DAO;
        $sql1 =
        "SELECT firstname, lastname, d.id_director AS id_director
        FROM person p
        INNER JOIN director d
        ON p.id_person = d.id_person
        ORDER BY p.firstname";
        $directorsNames = $db->executeRequest($sql1);

        // Get all genres names for the select
        $db = new DAO;
        $sql2 =
        "SELECT mg.id_genre AS id_genre, g.name AS name_genre
        FROM movie_genre mg
        INNER JOIN genre g 
        ON mg.id_genre = g.id_genre
        GROUP BY g.name
        ORDER BY g.name ASC";
        $genresNames = $db->executeRequest($sql2);

        $db = new DAO;
        $sql3 = 
        "SELECT id_movie FROM movie";
        $movieId = $db->executeRequest($sql3);

        
        // Restrictions for the inputs received
        if ($_SERVER["REQUEST_METHOD"] === "POST"){

            if (!empty($_POST['title']) && !empty($_POST['release_date']) && !empty($_POST['length']) && filter_var($_POST['length'], FILTER_VALIDATE_INT) && !empty($_POST['rate']) && filter_var($_POST['rate'], FILTER_VALIDATE_INT) && !empty($_POST['synopsis']) && !empty($_POST['director']) && !empty($_POST['genre'])){

                $title = htmlspecialchars(trim($_POST['title']));
                
                $releaseDate = htmlspecialchars(trim($_POST['release_date']));

                $length = htmlspecialchars(trim($_POST['length']));
                
                $rate = htmlspecialchars(trim($_POST['rate']));
                
                $synopsis = htmlspecialchars(trim($_POST['synopsis']));

                $director = explode("_",$_POST['director']);
                $directorId = $director[0];

                $genre = explode("_",$_POST['genre']);
                $genreId = $genre[0];

                // Inserts to the DB
                $db = new DAO;
                $sql4 = "INSERT INTO movie(`title`, `release_date`, `length`, `synopsis`, `rate`, `id_director`)
                VALUES ('$title','$releaseDate','$length','$synopsis','$rate', '$directorId')";

                $stateAddMovie = $db->executeRequest($sql4);

                // Get the last ID received in the db
                $lastInsertId = $db->lastInsertId();

                $sql5 = "INSERT INTO movie_genre(`id_genre`, `id_movie`) 
                VALUES ('$genreId', '$lastInsertId')";
                $stateMovieGenre = $db->executeRequest($sql5);

                // Informations messages
                $_SESSION['message'] = "<div class='alert alert-success' role='alert'>
                Le film a bien été ajouté</div>";
            } else{
                $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>
                Le formulaire comporte une erreur</div>";
            }
            header('Location: index.php?action=addMovie');
        }
        require "views/movie/addMovie.php";
    }

    // Delete a movie with id
    public function deleteMovie($id)
    {
        $db = new DAO;
        $sql1 =
        "DELETE FROM movie_genre WHERE id_movie = :id";
        $sql2 =
        "DELETE FROM casting WHERE id_movie = :id";
        $sql3 =
        "DELETE FROM movie WHERE id_movie = :id";
        $stateDeleteMovieGenre = $db->executeRequest($sql1, ["id" => $id]);
        $stateDeleteMovieCasting = $db->executeRequest($sql2, ["id" => $id]);
        $stateDeleteMovie = $db->executeRequest($sql3, ["id" => $id]);
        header('Location: index.php?action=moviesList');
    }
}