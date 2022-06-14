<?php
    ob_start();
    $title="Tous les films";
    $h1 = "Tous les films";
?>

<section id="movies">
    <div class="row justify-content-center pb-4">
        <a class="btn btn-outline-success w-25" href="index.php?action=addMovie">Ajouter un nouveau Film</a>
    </div>
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($movies->fetchAll() as $movie): ?>
        <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center">
            <figure>
                <a href="index.php?action=detailMovie&id=<?=$movie['id_movie'] ?>">   
                    <img class="img-fluid" src="<?= $movie['poster']?>" alt="<?=$movie['title']?>">
                    <figcaption> <?= $movie['title']?> </figcaption>
                </a>
            </figure>
            <a href="index.php?action=modifyMovie&id=<?=$movie['id_movie']?>" class="d-flex justify-content-center py-2 btn btn-outline-secondary align-items-center bold mb-2">
                <i class="fa-solid fa-angle-right me-1"></i>Modifier ce film</a>
            <a href="index.php?action=deleteMovie&id=<?=$movie['id_movie']?>" class="d-flex justify-content-center py-2 btn btn-outline-danger align-items-center bold">
                <i class="fa-solid fa-angle-right me-1"></i>Supprimer ce film</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>