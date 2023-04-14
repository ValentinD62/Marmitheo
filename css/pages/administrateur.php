<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use Template\Template;
use form\Creation_form;
use recette\RecetteBD;
use recette\RecetteRenderer;

?>

<?php ob_start() ?>

<?php session_start() ;?>

<div id="b">
    <nav id="primary_nav_wrap1">

        <ul>

            <li class="MainMenu" id="MainMenurot"><a href="#"></a>
                <p id="menu"> Menu</p>
                <ul>
                    <li><a href="#"> CREATION</li>
                    <li><a href="#">DELETE</a></li>
                    <li><a href="#">EDIT</a></li>

                </ul>
            </li>
        </ul>
    </nav>
</div>

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
<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>

<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

