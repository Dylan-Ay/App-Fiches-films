<?php
    ob_start();
    $title="Tous les réalisateurs";
    $h1 = "Tous les réalisateurs";
?>

<section id="directors">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($directors->fetchAll() as $director): ?>
            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center">
                <figure>
                    <a href=" index.php?action=detailDirector&id=<?=$director['id_director'] ?>">   
                        <img class="img-fluid" src="<?= $director['poster']?>" alt="<?=$director['firstname']. " ". $director['lastname']?>">
                        <figcaption class="m-auto"> <?= $director['firstname']. " ". $director['lastname']?> </figcaption>
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