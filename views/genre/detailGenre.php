<?php
    ob_start();

    $displayMovieByGenre = $displayMovie->fetchAll();
    foreach ($displayMovieByGenre as $key => $movie) {
    }

    $title="Film du genre ". $displayMovieByGenre[$key]['genre_name'];
    $h1 = "Film du genre ". $displayMovieByGenre[$key]['genre_name'];
?>

<section id="movies">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($displayMovieByGenre as $movie): ?>
            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center">
                <figure>
                    <a href=" index.php?action=detailMovie&id=<?=$movie['id_movie'] ?>">   
                        <img class="img-fluid" src="<?= $movie['poster']?>" alt="<?=$movie['title']?>">
                        <figcaption> <?= $movie['title']?> </figcaption>
                    </a>
                </figure>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>