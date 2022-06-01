<?php
require_once "db/DAO.php";

class ActorController{

    public function findAll(){
        $dao = new DAO;
        $sql = 
        "SELECT firstname, lastname, poster, a.id_actor
        FROM person p
        INNER JOIN actor a
        ON p.id_person = a.id_person
        ORDER BY p.firstname;";

        $actors = $dao->executeRequest($sql);
        require "views/actor/actorsList.php";
    }

    public function findOneById($id) {
        $db = new DAO;
        $sql = 
        "SELECT firstname, lastname, gender, nationality, poster, DATE_FORMAT(birthdate, '%d %M %Y') AS birthdate, biography
        FROM person p
        INNER JOIN actor a
        ON p.id_person = a.id_person
        WHERE id_actor = :id";
        $stateActor = $db->executeRequest($sql, ["id" => $id]);

        $sql2 =
        "SELECT m.id_movie AS id_movie, title, poster
        FROM movie m
        INNER JOIN casting c
        ON c.id_movie = m.id_movie
        INNER JOIN actor a 
        ON a.id_actor = c.id_actor
        WHERE a.id_actor = :id";
        $displayMovie = $db->executeRequest($sql2, ["id" => $id]);

        require "views/actor/detailActor.php";
    }
}