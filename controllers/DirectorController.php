<?php
require_once 'db/DAO.php';

class DirectorController{

    public function findAll(){
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
}