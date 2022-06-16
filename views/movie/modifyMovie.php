<?php
    ob_start();
    $movieInformations = $stateMovie->fetch();
    $directorsNamesList = $directorsNames->fetchAll();
    $genresNamesList = $genresNames->fetchAll();
    $title= "Modification du Film". " «". $movieInformations['title']. "»";
    $h1 = "Mise à jour du film :<br>". " «". $movieInformations['title']. "»";
?>

<section id="modify-movie">
    <figure class="text-center">
        <img class="img-fluid" src="<?= $movieInformations['poster'] ?>" alt="">
    </figure>
    
    <?php if (isset($_SESSION['message'])): echo $_SESSION['message']; endif; ?>
    
    <form class=" w-75 m-auto" action="index.php?action=modifyMovie" method="post">
        <div class="form-group d-flex flex-column">
            <label for="title">Titre:</label>
            <input class="form-control mb-3" type="text" name="title" id="title" value="<?= $movieInformations['title'] ?>" required>

            <label for="release_date">Date de sortie:</label>
            <input class="form-control mb-3" type="date" name="release_date" id="release_date" value="<?= date('Y-m-d', strtotime($movieInformations['release_date'])) ?>" required>

            <label for="length">Durée: (<small>en minutes</small>)</label>
            <input class="form-control mb-3" type="number" name="length" id="length" value="<?= $movieInformations['length']?>" required>

            <label for="director">Réalisateur:</label>
            <select class="form-control mb-3" name="director" id="director" required>
                <option value= "<?= $movieInformations['id_director']?>"> <?= $movieInformations['firstname']. ' '. $movieInformations['lastname']?></option>
                
                <?php foreach ($directorsNamesList as $key => $value):?>
                <option value="<?= $directorsNamesList[$key]['id_director']?>"> 
                    <?= $directorsNamesList[$key]['firstname']. " ". $directorsNamesList[$key]['lastname']?> 
                </option>
                <?php endforeach;?>
            </select>

            <label for="genre">Genre:</label>
            <select class="form-control mb-3" name="genre" id="genre" required>
                <option value="<?= $movieInformations['id_genre'] ?>"> <?= $movieInformations['genre'] ?></option>

                <?php foreach ($genresNamesList as $key => $value):?>
                    <option value="<?= $genresNamesList[$key]['id_genre']?>"> <?= $genresNamesList[$key]['name_genre']?> </option>
                <?php endforeach;?>
            </select>
            
            <label for="rate">Note:</label>
            <input class="form-control mb-3" type="number" name="rate" id="rate" min="1" max="5" value="<?= $movieInformations['rate'] ?>" required>

            <label for="synopsis">Synopsis:</label>
            <textarea class="form-control mb-3" name="synopsis" id="synopsis" cols="30" rows="10" required><?= $movieInformations['synopsis']?> </textarea>

            <input type="text" hidden name="id-movie" id="id-movie" value="<?= $movieInformations['id_movie'] ?>">

            <input class="btn btn-outline-success w-50 m-auto" type="submit" value="Valider">
        </div>
    </form>

</section>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>