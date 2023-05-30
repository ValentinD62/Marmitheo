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

            if (isset($_POST["nom_tag"])){
                $all_tag = $_POST["nom_tag"];
                $all_name_tag = array();
                $j = 0;
                for ($i = 0; $i < count($all_tag); $i++){
                    if ($all_tag[$i] != ""){
                        $all_name_tag[$j] = htmlspecialchars($all_tag[$i]); //Au cas où l'utilisateur laisse des trous dans les inputs.
                        $j++;
                    }
                }
            }
            else{
                $all_name_tag = null;
            }
            if (isset($_POST["nom_ing"])){
                $all_name_ing = $_POST["nom_ing"];
                $all_img_ing = $_FILES["img_ing"];
                $j = 0;
                $true_all_img_ing = array();
                $true_all_name_ing= array();
                for ($i = 0; $i < count($all_name_ing); $i++){
                    if ($all_name_ing[$i] != ""){
                        $true_all_name_ing[$j] = htmlspecialchars($all_name_ing[$i]);
                        if ($all_img_ing["name"][$i] != ""){
                            $true_all_img_ing[$j]['name'] = $all_img_ing["name"][$i]; //Conversion pour plus de facilité par la suite
                            $true_all_img_ing[$j]['tmp_name'] = $all_img_ing["tmp_name"][$i]; // Et au cas où l'utilisateur laisse des trous dans les inputs.
                            $j++;
                        }
                    }
                }
                if (count($true_all_img_ing) != count($true_all_name_ing)){?>
                    <div class = "error_admin"><?= "Veuillez mettre une image à l'ingrédient svp." ?> </div> <?php
                    $recette_R->getAllModifHTML($liste_recette[0]);
                }
                else{
                    $recette->editRecette($id_recette,$nom_modif, $description_modif, $image_modif, $all_name_tag, $true_all_name_ing, $true_all_img_ing);
                    $recette_R->getAllModifHTML($liste_recette[0]);
                }
            }
            else{
                $recette->editRecette($id_recette,$nom_modif, $description_modif, $image_modif, $all_name_tag);
                $recette_R->getAllModifHTML($liste_recette[0]);
            }

        }
    }
}
else{
    $recette_R->getAllModifHTML($liste_recette[0]);
}

?>


<?php $content = ob_get_clean();
Template::render($content);
?>