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
        require "views/actor/actorList.php";
    }
}