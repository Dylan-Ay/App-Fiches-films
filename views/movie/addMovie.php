<?php
    ob_start();
    $title="Ajouter un Film";
    $h1 = "Ajouter un Film";
    $directorsNamesList = $directorsNames->fetchAll();
    $genresNamesList = $genresNames->fetchAll();
?>

<section id="add-movie">
    
    <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
    <form class=" w-50 m-auto" action="index.php?action=addMovie" method="post">
        <div class="form-group d-flex flex-column">
            <label for="title">Titre:</label>
            <input class="form-control mb-3" type="text" name="title" id="title" required>

            <label for="release-date">Date de sortie:</label>
            <input class="form-control mb-3" type="date" name="release_date" id="release_date" required>

            <label for="length">Durée: (<small>en minutes</small>)</label>
            <input class="form-control mb-3" type="number" name="length" id="length" required>

            <label for="director">Réalisateur:</label>
            <select class="form-control mb-3" name="director" id="director">
                <option value="select-director" disabled selected hidden >Veuillez selectionner un réalisateur</option>
                <?php foreach ($directorsNamesList as $key => $value):?>
                    <option value="<?= $directorsNamesList[$key]['id_director']?>"> <?= $directorsNamesList[$key]['firstname']. " ". $directorsNamesList[$key]['lastname']?> </option>
                <?php endforeach;?>
            </select>

            <label for="genre">Genre:</label>
            <select class="form-control mb-3" name="genre" id="genre">
                <option value="select-director" disabled selected hidden>Veuillez selectionner un genre</option>
                <?php foreach ($genresNamesList as $key => $value):?>
                    <option value="<?= $genresNamesList[$key]['id_genre']?>"> <?= $genresNamesList[$key]['name_genre']?> </option>
                <?php endforeach;?>
            </select>
            
            <label for="rate">Note:</label>
            <input class="form-control mb-3" type="number" name="rate" id="rate" min="1" max="5" required>

            <label for="synopsis">Synopsis:</label>
            <textarea class="form-control mb-3" name="synopsis" id="synopsis" cols="30" rows="10" required></textarea>

            <input class="btn btn-outline-success w-50 m-auto" type="submit" value="Valider">
        </div>
    </form>

</section>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>