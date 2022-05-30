<?php
    ob_start();
?>

<h1>Bienvenue</h1>

<?php
    $content = ob_get_clean();
    $title="Page d'accueil";
    require "./views/template.php";
?>