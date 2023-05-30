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
    if ($nom_modif == ""){?>
        <div class = "error_admin"><?= "Veuillez mettre le nom de la recette." ?> </div> <?php
        $recette_R->getAllModifHTML($liste_recette[0]);
    }
    else{
        $nom_modif = htmlspecialchars($nom_modif);
        $description_modif = $_POST['description_modif'];
        if ($description_modif == ""){?>
            <div class = "error_admin"><?= "Veuillez mettre la description de la recette." ?> </div> <?php
            $recette_R->getAllModifHTML($liste_recette[0]);
        }
        else{
            $description_modif = htmlspecialchars($description_modif);
            $image_modif = $_FILES["image_recette_modif"];
            if ($image_modif["name"] == ""){
                $image_modif = $liste_recette[0]->image;
            }
            /*echo $image_modif["name"];
            $all_name_tag = $_POST["tag_modif"];
            for ($i = 0; $i < count($all_name_tag); $i++){
                $all_name_tag[$i] = htmlspecialchars($all_name_tag[$i]);
            }
            $all_name_ing = $_POST["nom_ing_modif"];
            for ($i = 0; $i < count($all_name_ing); $i++){
                $all_name_ing[$i] = htmlspecialchars($all_name_ing[$i]);
            }
            $all_img_ing = $_FILES["image_ing_modif"];
            $recette->editRecette($id_recette,$nom_modif, $description_modif, $image_modif, $all_name_tag, $all_name_ing, $all_img_ing);
        */}
    }
}

?>


<?php $content = ob_get_clean();
Template::render($content);
?>