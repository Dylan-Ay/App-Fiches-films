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
        $sql = "SELECT title, DATE_FORMAT(release_date, '%d-%c-%Y') AS release_date, length, synopsis, rate, m.poster AS poster, p.firstname AS firstname, p.lastname AS lastname, m.id_director AS id_director
        FROM movie m
        INNER JOIN director d
        ON d.id_director = m.id_director
        INNER JOIN person p 
        ON p.id_person = d.id_person
        WHERE id_movie = :id ";
        $state = $db->executeRequest($sql, ["id" => $id]);
        require "views/movie/detailMovie.php";
    }
}