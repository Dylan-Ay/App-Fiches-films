

<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/style.css">
    <script src="https://kit.fontawesome.com/aadee783c9.js" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
  </head>
  <header class="bg-dark mb-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container pt-1">
          <a class="navbar-brand" href="index.php?action=home">Fiches de Films</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto ps-lg-5 align-items-center">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-lg-5" href="index.php?action=moviesList">Films</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" href="#">Séries</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=actorsList">Acteurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link px-lg-5" href="index.php?action=directorsList">Réalisateurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=genresList">Genres</a>
              </li>
            </ul>
            <form class="form my-2 my-lg-0 d-flex">
              <input class="form-control mr-sm-2" type="search" aria-label="recherche">
              <button class="btn" type="submit"><i class="fa-solid fa-lg fa-magnifying-glass"></i></button>
            </form>
          </div>
        </div>
    </nav>
</header>
<body>
    <main>
            <?php if (isset($h1)):?>
                    <h1 class="text-center pt-2 mx-3"><?= $h1?></h1>
            <?php endif;?>
            <div class="container py-5">
                <?= $content ?>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted">
        <!-- Section: Social media -->
            <section
                class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom container">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </section>

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Fiches de Films
                            </h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae nihil cupiditate voluptate sapiente quaerat quam non fugit! Quam quia quas quae expedita, dolores veritatis, cupiditate nam voluptas, culpa corrupti recusandae!
                            </p>
                        </div>
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <h6 class="text-uppercase fw-bold mb-4">
                                Liens
                            </h6>
                            <p>
                                <a href="index.php?action=moviesList" class="text-reset">Films</a>
                            </p>
                            <p>
                                <a href="index.php?action=actorsList" class="text-reset">Acteurs</a>
                            </p>
                            <p>
                                <a href="index.php?action=directorsList" class="text-reset">Réalisateurs</a>
                            </p>
                        </div>
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contact
                            </h6>
                                <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                info@example.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright: Dylan
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/"></a>
            </div>
        </footer>
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
