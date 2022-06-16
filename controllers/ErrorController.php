<?php
require_once 'db/DAO.php';

class ErrorController{

    public function errorPage(){
        require "views/errors/error.php";
    }
}