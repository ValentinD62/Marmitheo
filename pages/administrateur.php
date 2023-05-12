    <?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use recette\Tag;
use recette\Ingredient;
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
<div id="b">
            <nav id="primary_nav_wrap1">

                <ul>

                    <li class="MainMenu" id="MainMenurot"><a href="#"></a>
                        <p id="menu1"> Menu</p>
                        <ul>
                            <li><a href="#Creation">CREATE</a></li>
                            <li><a href="#sup-menu">DELETE</a></li>
                            <li><a href="#recette-edit">EDIT</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
<?php


$n_recette = new RecetteBD();
$rec = new Recette();
$tag = new Tag();
$ing = new Ingredient();
$logger = new Creation_form();
$des = new Destruction_form();
$edition = new Edition_Form();



if (empty($_POST['name'])){
    $logger->generateCreationForm();
}
else{
    $all_recette = $n_recette->getAllRecette();
    $bon = true;
    foreach($all_recette as $recette){ //Vérification pour voir si le nom de la recette est déjà dans la base de données.
        if ($recette->nom_rec == $_POST['name']){
            $bon = false;
        }
    }
    if (!$bon){?>
        <div class = "error_admin"><?= "La recette est déjà dans la base de données" ?> </div><?php
        $logger->generateCreationForm();
    }
    else{
        if(empty($_FILES['image']['name'])){?>
            <div class = "error_admin"><?= "Il manque la photo" ?> </div> <?php
            $logger->generateCreationForm();
        }
        else{
            if (empty($_POST['description'])){?>
                <div class = "error_admin"> <?= "Veuillez mettre une description svp" ?></div> <?php
                $logger->generateCreationForm();
            }
            $i = 1;
            $all_tag = array();
            while (!empty($_POST["tag_" . $i])){
                $all_tag[$i] = $_POST["tag_" . $i];
                $i ++;
            }
            $i = 1;
            $all_name_ing = array();
            $all_img_ing = array();
            while(!empty($_POST["ingredient_" . $i]) && !empty($_FILES["image_ing_" . $i])){
                $all_name_ing[$i - 1] = $_POST["ingredient_" . $i];
                $all_img_ing[$i - 1] = $_FILES["image_ing_" . $i];
                $i++;
            }
            $imgFile = isset($_FILES['image']) ? $_FILES['image'] : null ;
            $rec->createRecette($_POST['name'], $_POST['description'], $imgFile, $all_tag, $all_name_ing, $all_img_ing); ?>
            <div id = "bravo" > Recette ajoutée dans la base de données </div>
            <?php $logger->generateCreationForm();
        }
    }
}
?>

<img class="separateur" src="../img/separator.png">

<?php
if(empty($_POST['delete_name'])) {
    $des->generateDeleteRecetteForm();
}
else{
    $all_recette = $n_recette->getAllRecette();
    $bon = false;
    foreach($all_recette as $recette){ //Vérification pour voir si le nom de la recette est déjà dans la base de données.
        if ($recette->nom_rec == $_POST['delete_name']){
            $bon = true;
        }
    }
    if (!$bon){?>
        <div class = "error_admin"><?= "La recette n'est pas présente dans la base de données." ?> </div><?php
        $des->generateDeleteRecetteForm();
        }
    else{
        $rec->deleteRecette($_POST['delete_name']);?>
        <div class = "bravo" > Recette supprimé de la base de données </div><?php
        $des->generateDeleteRecetteForm();
    }
}
?>
<img class="separateur" src="../img/separator.png">
<?php
if(empty($_POST['delete_tag'])){
    $des->generateDeleteTagForm();
}
else{
    $all_tag = $n_recette->getAllTag();
    $bon = false;
    foreach($all_tag as $recette){ //Vérification pour voir si le nom de la recette est déjà dans la base de données.
        if ($recette->nom_tag == $_POST['delete_tag']){
            $bon = true;
        }
    }
    if (!$bon){ ?>
        <div class = "error_admin"><?= "Le tag n'est pas présent dans la base de données." ?> </div><?php
        $des->generateDeleteTagForm();
    }
    else{
        $tag->deleteTag($_POST['delete_tag']); ?>
    <div class = "bravo"> Tag supprimé de la base de données </div> <?php
        $des->generateDeleteTagForm();
    }
}

?>
    <img class="separateur" src="../img/separator.png">

    <?php

if(empty($_POST['delete_ing'])){
    $des->generateDeleteIngredientForm();
}
else{
    $all_ing = $n_recette->getAllIngredient();
    $bon = false;
    foreach($all_ing as $recette){ //Vérification pour voir si le nom de la recette est déjà dans la base de données.
        if ($recette->nom_ing == $_POST['delete_ing']){
            $bon = true;
        }
    }
    if (!$bon){ ?>
        <div class = "error_admin"><?= "Le tag n'est pas présent dans la base de données." ?> </div><?php
        $des->generateDeleteIngredientForm();
    }
    else{
        $ing->deleteIng($_POST['delete_ing']); ?>
        <div class = "bravo"> Ingrédient supprimé de la base de données </div> <?php
        $des->generateDeleteIngredientForm();
    }
}
    ?>
    <img class="separateur" src="../img/separator.png">
    <?php

    //edition recette

if(empty($_POST['edit_recette'])){
    $edition->generateEditionRecetteForm();
}
else{
    $edition->generateEditionRecetteForm();
}

?>
    <img class="separateur" src="../img/separator.png">
    <?php

    //edition ingredient


if(empty($_POST['nom_ing'])){
    $edition->generateEditionIngForm();
}
else{
    echo $_POST['nom_ing'];
    $all_ing = $n_recette->getAllIngredient();
    $bon = false;
    foreach($all_ing as $ing){ //Vérification pour voir si le nom de l'ingredient est déjà dans la base de données.
        if ($ing->nom_ing == $_POST['nom_ing']){
            $bon1 = true;
        }
    }
    if (!$bon){ ?>
        <div class = "error_admin"><?= "L'ingredient n'est pas présent dans la base de données." ?> </div><?php
        $edition->generateEditionIngForm();
    }
    else{
        if(!empty($_POST['nouveau_nom_ing'])  && empty($_FILES['nouveau_img_ing'])){
            $ing->editionIng($_POST['nom_ing'], $_POST['nouveau_nom_ing'], null); ?>
            <div class = "bravo"> Tag supprimé de la base de données </div> <?php
            $edition->generateEditionTagForm();
        }
        if(empty($_POST['nouveau_nom_ing']) && !empty($_FILES['nouveau_img_ing'])){
            $ing->editionIng($_POST['nom_ing'], null, $_FILES['nouveau_img_ing']); ?>
            <div class = "bravo"> Tag supprimé de la base de données </div> <?php
            $edition->generateEditionTagForm();
        }
        else{
            $ing->editionIng($_POST['nom_ing'], $_POST['nouveau_nom_ing'], $_FILES['nouveau_img_ing']); ?>
            <div class = "bravo"> Tag supprimé de la base de données </div> <?php
            $edition->generateEditionTagForm();
        }
    }

    }
?>


    <img class="separateur" src="../img/separator.png">

    <?php


    //edition des tags

if(empty($_POST['nom_tag'])){
        $edition->generateEditionTagForm();
    }
else{
    $all_tag = $n_recette->getAllTag();
    $bon2 = false;
    foreach($all_tag as $recette){ //Vérification pour voir si le nom du tag est déjà dans la base de données.
        if ($recette->nom_tag == $_POST['edit_tag']){
            $bon2 = true;
        }
    }
    if (!$bon2){ ?>
        <div class = "error_admin"><?= "Le tag n'est pas présent dans la base de données." ?> </div><?php
        $edition->generateEditionTagForm();
    }
    else{
        $tag->editionTag($_POST['ancien_nom_tag'], $_POST['nouveau_nom_tag'],); ?>
        <div class = "bravo"> Tag supprimé de la base de données </div> <?php
        $edition->generateEditionTagForm();
    }

}

?>

<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>

<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

