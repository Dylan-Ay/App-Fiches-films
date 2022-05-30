<?php
    ob_start();
    $title="Tous les acteurs";
    $h1 = "Tous les acteurs";
?>

<section id="actors">
    <div class="row list-section justify-content-center justify-content-lg-start pt-3 pb-5">
        <?php foreach($actors->fetchAll() as $actor): ?>
            <div class="col-sm-5 col-lg-3 mb-4 mb-sm-0 img-container align-items-center">
                <figure>
                    <a href=" index.php?action=actor&id=<?=$actor['id_actor'] ?>">   
                        <img class="img-fluid" src="<?= $actor['poster']?>" alt="<?=$actor['firstname']. " ". $actor['lastname']?>">
                        <figcaption><?= $actor['firstname']. " ". $actor['lastname']?></figcaption>
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