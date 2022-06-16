<?php
    ob_start();
    $title="Erreur 404";

?>

<p class="display-1 text-center">Erreur 404 : La page n'existe pas</p>

<?php
    $content = ob_get_clean();
    require "./views/template.php";
?>