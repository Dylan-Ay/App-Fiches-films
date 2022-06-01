<?php
require_once 'db/DAO.php';

class DirectorController{

    public function findAll()
    {
        $dao = new DAO;
        $sql = 
        "SELECT firstname, lastname, poster, d.id_director
        FROM person p
        INNER JOIN director d
        ON p.id_person = d.id_person
        ORDER BY p.firstname;";

        $directors = $dao->executeRequest($sql);
        require "views/director/directorsList.php";
    }

    public function findOneById($id) 
    {
        $db = new DAO;
        $sql = 
        "SELECT firstname, lastname, gender, nationality, poster, DATE_FORMAT(birthdate, '%d %M %Y') AS birthdate, biography
        FROM person p
        INNER JOIN director d
        ON p.id_person = d.id_person
        WHERE id_director = :id";
        $stateDirector = $db->executeRequest($sql, ["id" => $id]);

        $sql2 =
        "SELECT m.id_movie AS id_movie, title, m.poster
        FROM movie m
        INNER JOIN director d 
        ON d.id_director = m.id_director
        WHERE d.id_director = :id";
        $displayMovie = $db->executeRequest($sql2, ["id" => $id]);
        require "views/director/detailDirector.php";
    }
}