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
        unset($_SESSION['message']);
        require "views/movie/moviesList.php";
    }

    // Get Movie by id for detailMovie.php
    public function findOneById($id) 
    {
        $db = new DAO;
        $sql = 
        "SELECT title, DATE_FORMAT(release_date, '%d %M %Y') AS release_date, length, synopsis, rate, m.poster AS poster, p.firstname AS firstname, p.lastname AS lastname, m.id_director AS id_director, g.name AS genre, m.id_movie AS id_movie
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

        unset($_SESSION['message']);
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

                $genreId = $_POST['genre'];

                // Inserts to the DB
                $db = new DAO;
                $sql4 = 
                "INSERT INTO movie(title, release_date, length, synopsis, rate, id_director)
                VALUES (:title, :release_date, :length, :synopsis, :rate, :id_director)";

                $stateAddMovie = $db->executeRequest($sql4, [
                    'title'=> $title,
                    'release_date'=> $releaseDate,
                    'length' => $length,
                    'synopsis' => $synopsis,
                    'rate' => $rate,
                    'id_director' => $directorId
                ]);

                // Get the last ID received in the db
                $lastInsertId = $db->lastInsertId();

                $sql5 = "INSERT INTO movie_genre(id_genre) 
                VALUES (:id_genre) WHERE id_movie = :id_movie)";

                $stateMovieGenre = $db->executeRequest($sql5, [
                    'id_genre' => $genreId,
                    'id_movie' => $lastInsertId
                ]);

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

    public function modifyMovie($id)
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
        "SELECT g.id_genre AS id_genre, g.name AS name_genre
        FROM genre g
        GROUP BY g.name
        ORDER BY g.name ASC";
        $genresNames = $db->executeRequest($sql2);

        $db = new DAO;
        $sql3 = 
        "SELECT title, DATE_FORMAT(release_date, '%d %M %Y') AS release_date, length, synopsis, rate, m.poster AS poster, p.firstname AS firstname, p.lastname AS lastname, m.id_director AS id_director, g.name AS genre, m.id_movie AS id_movie, g.id_genre AS id_genre
        FROM movie m
        INNER JOIN director d
        ON d.id_director = m.id_director
        INNER JOIN person p 
        ON p.id_person = d.id_person
        INNER JOIN movie_genre mg
        ON mg.id_movie = m.id_movie
        INNER JOIN genre g
        ON g.id_genre= mg.id_genre
        WHERE m.id_movie = :id";
        $stateMovie = $db->executeRequest($sql3, ["id" => $id]);
        
         // Restrictions for the inputs received
         if ($_SERVER["REQUEST_METHOD"] === "POST"){

            if (!empty($_POST['title']) && !empty($_POST['release_date']) && !empty($_POST['length']) && filter_var($_POST['length'], FILTER_VALIDATE_INT) && !empty($_POST['rate']) && filter_var($_POST['rate'], FILTER_VALIDATE_INT) && !empty($_POST['synopsis']) && !empty($_POST['director']) && !empty($_POST['genre']) && !empty($_POST['id-movie'])){

                $title = htmlspecialchars(trim($_POST['title']));
                
                $releaseDate = htmlspecialchars(trim($_POST['release_date']));

                $length = htmlspecialchars(trim($_POST['length']));
                
                $rate = htmlspecialchars(trim($_POST['rate']));
                
                $synopsis = htmlspecialchars(trim($_POST['synopsis']));

                $idMovie = $_POST['id-movie'];

                $idDirector = $_POST['director'];

                $idGenre = $_POST['genre'];

                // Update db
                $db = new DAO;
                $sql4 = 
                "UPDATE movie SET title = :title, release_date = :release_date, length = :length, synopsis = :synopsis, rate = :rate, id_director = :id_director WHERE id_movie = :id_movie";

                $modifyMovie = $db->executeRequest($sql4,[
                    "title" => $title,
                    "release_date" => $releaseDate,
                    "length" => $length,
                    "synopsis" => $synopsis,
                    "rate" => $rate,
                    "id_director" => $idDirector,
                    "id_movie" => $idMovie
                ]);

                $sql5 = 
                "UPDATE movie_genre SET id_genre = :id_genre
                WHERE id_movie = :id_movie";
                
                $stateMovieGenre = $db->executeRequest($sql5,[
                    'id_genre' => $idGenre,
                    'id_movie' => $idMovie
                ]);

                // Informations messages
                $_SESSION['message'] = "<div class='alert alert-success' role='alert'>
                Le film a bien été mis à jour.</div>";
            } else{
                $_SESSION['message'] = "<div class='alert alert-danger' role='alert'>
                Le formulaire comporte une erreur.</div>";
            }
            header('Location: index.php?action=modifyMovie&id=5');
        }
        require "views/movie/modifyMovie.php";
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

        unset($_SESSION['message']);
        header('Location: index.php?action=moviesList');
    }

}