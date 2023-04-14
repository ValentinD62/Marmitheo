<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use Template\Template;
use form\Creation_form;
use form\Destruction_form;
use recette\RecetteBD;
use recette\Recette;
use form\Edition_Form;
use recette\RecetteRenderer;


?>

<?php ob_start() ?>

<?php session_start() ;?>

<?php

$n_recette = new RecetteBD();
$rec = new Recette();
$logger = new Creation_form();
$des = new Destruction_form();
$edition = new Edition_Form();

if (empty($_POST['name'])){
    $logger->generateCreationForm();
}
else{
    $imgFile = isset($_FILES['image']) ? $_FILES['image'] : null ;
    $rec->createRecette($_POST['name'], $_POST['description'], $imgFile);
    $logger->generateCreationForm();
}
?>

<img id="separateur" src="../img/separator.png">

<?php
if(empty($_POST['nom_rec'])) {
    $des->generateDeleteRecetteForm();
}

if(empty($_POST['nom_tag'])){
    $des->generateDeleteTagForm();
}
?>


<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>

<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

