<?php
    ob_start();

    if (isset($_GET['id'])){
        $displayMovieByGenre = $displayMovie->fetchAll();
        foreach ($displayMovieByGenre as $key => $movie) {
        }
        $title="Films du genre ". $displayMovieByGenre[$key]['genre_name'];
        $h1 = "Films du genre ". $displayMovieByGenre[$key]['genre_name'];
    }
    $title = $movie['title'];

    if (array_key_exists('id_genre', $displayMovieByGenre[$key])):
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
    <?php else: header('Location: index.php?action=error'); endif;?>
</section>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>