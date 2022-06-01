<?php
    ob_start();
    $movie = $stateMovie->fetch(); // Fetch the movie's details
    $movieActorsList = $displayActor->fetchAll(); // Fetch the movie's casting
    $title= $movie['title'];
?>
<section id="detail-movie">
    <div class='col-12'>
        <article class='card mb-5 flex-wrap flex-lg-nowrap justify-content-center align-items-center'>
            <img class="card-img-top fit-content" src="<?= $movie['poster']?>" alt="<?= $movie['title'] ?>">
            <div class='card-body'>
                <h1 class='card-title mb-4'> <?= $movie['title']?> </h1>
                <span class='fw-bold d-block pb-3'>Synopsis:</span>
                <p class='card-text'> <?= $movie['synopsis']?> </p>
                <ul class='row list-group list-unstyled pt-4'>
                    <li>
                        <span class='fw-bold'>Réalisateur:</span> <a href="index.php?action=detailDirector&id=<?= $movie['id_director'] ?>"><?= $movie['firstname']. " ". $movie['lastname'] ?> </a>
                    </li>
                    <li>
                        <span class='fw-bold'>Année de sortie:</span> <?= dateToFrench($movie['release_date']) ?> 
                    </li>
                    <li>
                        <span class='fw-bold'>Durée: </span> <?= $movie['length'] ?> min
                    </li>
                    <li>
                        <span class='fw-bold'>Genre: </span> <a href="index.php?action=genresList"> <?= $movie['genre'] ?> </a> 
                    </li>
                    <li>
                        <span class='fw-bold'>Note: </span> <?= getRateInStars($movie['rate']) ?> 
                    </li>
                </ul>
            </div>
        </article>
    </div>       
    <div class='row justify-content-center justify-content-md-start'>
        <span class='fw-bold pb-3 fs-filmography'>Casting:</span>
        
        <?php foreach ($movieActorsList as $key => $value):?>
            <div class='col-8 col-sm-6 col-md-4 col-xl-2 img-container adjust-col-xl'>
                <figure>
                    <a href=" index.php?action=detailActor&id=<?= $movieActorsList[$key]['id_actor']?>">
                        <img class="img-fluid" src=" <?= $movieActorsList[$key]['poster']?> " alt=" <?= "Photo de ". $movieActorsList[$key]['firstname']. " ". $movieActorsList[$key]['lastname'] ?>">

                        <figcaption class="text-center"> <?= $movieActorsList[$key]['firstname']. " ". $movieActorsList[$key]['lastname'] ?> </figcaption>
                    </a>
                </figure>
            </div>
        <?php endforeach; ?>
        
    </div>
</section>

<?php
   $content = ob_get_clean();
   require "./views/template.php"
?>