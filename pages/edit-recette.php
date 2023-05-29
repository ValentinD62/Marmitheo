<?php require_once __DIR__ . "/../class/autoload.php";
Autoloader::register();

use recette\Recette;
use recette\RecetteBD;
use recette\RecetteRenderer;
use Template\Template;

ob_start()  ?>

<?php session_start();?>

<?php
$id_recette = $_GET['id'];
$recette_R = new RecetteRenderer();
$recettesBD = new RecetteBD();
$recette = new Recette();
$recettesBD = $recettesBD->getRecetteById($id_recette);
$liste_recette = $recette->Convertir_recette($recettesBD);

$recette_R->getAllModifHTML($liste_recette[0]);
if (isset($_POST['nom_recette'])){
    $nom_modif = $_POST['nom_recette'];
    if ($nom_modif == ""){
        echo "bah il faut un nom en fait";
        $recette_R->getAllModifHTML($liste_recette[0]);
    }
    else{
        $nom_modif = htmlspecialchars($nom_modif);
        $description_modif = $_POST['description_modif'];
        if ($description_modif == ""){
            echo "Il faut une description";
            $recette_R->getAllModifHTML($liste_recette[0]);
        }
        else{
            $description_modif = htmlspecialchars($description_modif);
            $image_modif = $_FILES["image_recette_modif"];
            echo $image_modif->name;
            $all_name_tag = $_POST["tag_modif"];
            $all_name_tag = htmlspecialchars($all_name_tag);
            $all_name_ing = $_POST["nom_ing_modif"];
            $all_name_ing = htmlspecialchars($all_name_ing);
            $all_img_ing = $_FILES["image_ing_modif"];
            $recette->editRecette($id_recette,$nom_modif, $description_modif);
        }
    }
}

?>


<?php $content = ob_get_clean();
Template::render($content);
?>