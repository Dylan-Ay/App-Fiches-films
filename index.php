<?php
    require_once "controllers/WelcomeController.php";
    require_once "controllers/ActorController.php";
    require_once "controllers/MovieController.php";
    require_once "controllers/TypeController.php";
    require_once "controllers/DirectorController.php";

    $welcomeCtrl = new WelcomeController;
    $movieCtrl = new MovieController;
    $actorCtrl = new ActorController;
    $directorCtrl = new DirectorController;

    if(isset($_GET['action'])){
        switch($_GET['action']){  
            case "moviesList":
                $movieCtrl->findAll();
                break;    
            case "actorsList":
                $actorCtrl->findAll();
                break;
            case "directorsList":
                $directorCtrl->findAll();
                break;
            case "detailMovie":
                $movieCtrl->findOneById($_GET['id']);
                break;

            // case "detailFilm":$ctrlFilm->findOneById($_GET["id"]);break;    
        }
    }
    else{
        $welcomeCtrl -> welcomePage();
    }
?>