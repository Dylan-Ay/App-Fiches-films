<?php
    session_start();
    require_once "controllers/WelcomeController.php";
    require_once "controllers/ActorController.php";
    require_once "controllers/MovieController.php";
    require_once "controllers/GenreController.php";
    require_once "controllers/DirectorController.php";
    require_once "controllers/ErrorController.php";
    include 'service/functions.php';

    $welcomeCtrl = new WelcomeController;
    $movieCtrl = new MovieController;
    $actorCtrl = new ActorController;
    $directorCtrl = new DirectorController;
    $genreCtrl = new GenreController;
    $errorCtrl = new ErrorController;

    if(isset($_GET['action'])){
        switch($_GET['action']){  
            case "home":
                $welcomeCtrl->welcomePage();
                break;
            case "moviesList":
                $movieCtrl->findAll();
                break;    
            case "actorsList":
                $actorCtrl->findAll();
                break;
            case "directorsList":
                $directorCtrl->findAll();
                break;
            case "genresList":
                $genreCtrl->findAll();
                break;
            case "detailMovie":
                $movieCtrl->findOneById($_GET['id']);
                break;
            case "detailDirector":
                $directorCtrl->findOneById($_GET['id']);
                break;
            case "detailActor":
                $actorCtrl->findOneById($_GET['id']);
                break;
            case "detailGenre":
                $genreCtrl->getAllMoviesByGenre($_GET['id']);
                break;
            case "addMovie":
                $movieCtrl->addMovie();
                break;
            case "deleteMovie":
                $movieCtrl->deleteMovie($_GET['id']);
                break;
            case "modifyMovie":
                $movieCtrl->modifyMovie($_GET['id']);
                break;
            case "error":
                $errorCtrl->errorPage();
                break;
            default:
                header('Location: index.php?action=home');
        }
    }
    else{
        header('Location: index.php?action=home');
    }
?>