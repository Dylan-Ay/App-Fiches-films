<?php
require_once 'db/DAO.php';

class GenreController{

    public function findAll()
    {
        $db = new DAO;
        $sql = 
        "SELECT id_genre, name, image
        FROM genre g;
        ORDER BY name";
        $genres = $db->executeRequest($sql);
        require "views/genre/genresList.php";
    }

    public function getAllMoviesByGenre($id) {
        $db = new DAO;
        $sql = 
        "SELECT m.id_movie AS id_movie, title, release_date, m.poster AS poster, length, p.lastname, p.firstname, g.id_genre AS id_genre, g.name AS genre_name
        FROM movie m 
        INNER JOIN director d
        ON d.id_director = m.id_director
        INNER JOIN person p 
        ON p.id_person = d.id_person
        INNER JOIN movie_genre mg
        ON mg.id_movie = m.id_movie
        INNER JOIN genre g 
        ON g.id_genre = mg.id_genre
        WHERE g.id_genre = :id
        ORDER BY title";
        $displayMovie = $db->executeRequest($sql, ["id" => $id]);

        require "views/genre/detailGenre.php";
    }

}