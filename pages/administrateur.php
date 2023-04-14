<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use Template\Template;
use form\Creation_form;
use recette\RecetteBD;
use recette\RecetteRenderer;

?>

<?php ob_start() ?>

<?php session_start() ;?>

<?php

$n_recette = new RecetteBD();
$logger = new Creation_form();
if (empty($_POST['name'])){
    $logger->generateCreationForm();
}
else{
    $imgFile = isset($_FILES['image']) ? $_FILES['image'] : null ;
    $n_recette->createRecette($_POST['name'], $_POST['description'], $imgFile);
    $logger->generateCreationForm();
}
?>

<?php
if(empty($_POST['nom_rec']) or empty($_POST('nom_tag'))) {
    $logger->generateDeleteForm();
}
?>


<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>

<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

