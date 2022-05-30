<?php
    ob_start();
    $movie = $state->fetch();
    $title="Détail du film";
?>

<section id="detail-movie">
    <div class='col-12'>
        <article class='card mb-5 flex-wrap flex-lg-nowrap justify-content-center align-items-center'>
            <img class="card-img-top fit-content" src="<?= $movie['poster']?>" alt="<?= $movie['title'] ?>">
            <div class='card-body'>
                <h1 class='card-title mb-4'> <?= $movie['title']?> </h1>
                <span class='fw-bold'>Synopsis:</span>
                <p class='card-text'> <?= $movie['synopsis']?> </p>
                <ul class='list-group list-unstyled justify-content-between pt-4 flex-column flex-xxl-row align-items-center align-items-lg-start'>
                    <li><span class='fw-bold'>Réalisateur:</span> <a href="index.php?action=detailDirector&id=<?= $movie['id_director'] ?>"><?= $movie['firstname']. " ". $movie['lastname'] ?> </a></li>
                    <li><span class='fw-bold'>Année de sortie:</span> <?= $movie['release_date'] ?> </li>
                    <li><span class='fw-bold'>Durée: </span> <?= $movie['length'] ?> min</li>
                    <li><span class='fw-bold'>Note: </span> <?= $movie['rate'] ?> </li>
                </ul>
            </div>
        </article>
    </div>       
</section>

<?php
    

   $content = ob_get_clean();
   require "./views/template.php"
?>