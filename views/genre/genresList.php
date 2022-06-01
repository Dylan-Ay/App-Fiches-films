<?php
    ob_start();
    $title="Tous les genres";
    $h1 = "Tous les genres";
?>

<section id="genre">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($genres->fetchAll() as $genre): ?>
            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center postion-relative">
                <figure>
                    <a href=" index.php?action=detailGenre&id=<?=$genre['id_genre'] ?>">   
                        <img class="img-fluid" src="<?= $genre['image']?>" alt="<?=$genre['name']?>">
                        <figcaption> 
                            <h5> <?= $genre['name']?> </h5>
                        </figcaption>
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