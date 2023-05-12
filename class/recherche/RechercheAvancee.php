<?php
namespace recherche;

use recette\Ingredient;
use recette\Recette;
use recette\RecetteBD;
use recette\Tag;

class RechercheAvancee{


    public function Recherche_avancee_form(): void{?>
        <div id = "input_recherche_av">
            <form method='post' action = 'recherche_avancee.php' id="form-rech1" >
                <input type="text" id="recherche_avancee_h" name="recherche_avancee" placeholder="Cherchez une recette, un tag...">
            </form>
        </div>
        <?php
    }
    public function afficher_liste_checks(): void{?>
            <div id = "liste-avancee">
            <form class="input_recherche_avancee" action="recherche_avancee.php" method="post" autocomplete="off">
               <div id="pour-le-after"> <button type = submit id = "button-avancee">Rechercher  </button></div>
                <div class = "titre_liste_avancee"> TAG :</div>
                <div id="pour-le-after">
                <div id = "liste_tag">
                    <?php
                    $tags = new Tag();
                    $recettesBD = new RecetteBD();
                    $tab_tag = $recettesBD->getAllTag();
                    $tab_tag = $tags->Convertir_tag($tab_tag);

                    foreach ($tab_tag as $tag) {?>
                        <input id = "<?= $tag->num_tag ?>" value="<?= $tag->num_tag ?>" type = "checkbox" name = "selection_tag[]">
                        <?php echo $tag->name . "</br>";
                    } ?>
                </div>
                </div>
                <div class = "titre_liste_avancee"> INGREDIENT :</div>
                <div id = "liste_ing">
                    <?php
                    $tags = new Ingredient();
                    $recettesBD = new RecetteBD();
                    $tab_ing = $recettesBD->getAllIngredient();
                    $tab_ing = $tags->Convertir_ingredient($tab_ing);

                    foreach ($tab_ing as $ing) { ?>
                        <input id = "<?=$ing->num_ing ?>" value="<?=$ing->num_ing ?>" type="checkbox" name = "selection_ing[]">
                        <?php echo $ing->name . " " . "</br>";
                    } ?>
                </div>
            </form>
            </div><?php
    }

    public function getRechercheRecette(): void{
        $recettesBD = new RecetteBD();
        $recettes = new Recette();
        if (!empty($_POST['recherche_avancee']))
            $recherche = $_POST['recherche_avancee'];
        else
            $recherche = "";

        if (!empty($_POST['selection_tag']))
            $recherche_tag = $_POST['selection_tag'];
        else
            $recherche_tag = "";

        if (!empty($_POST['selection_ing']))
            $recherche_ing = $_POST['selection_ing'];
        else
            $recherche_ing = "";

        if ($recherche == "" && $recherche_ing == "" && $recherche_tag == ""){
            $liste_recetteBD = $recettesBD->getAllRecette();
            $liste_recette = $recettes->Convertir_recette($liste_recetteBD);
            $i = 0;  ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recetteBD as $recette){
                    echo $recette->getHTMLForSearch($liste_recette[$i]);
                    $i++;
                }
                ?>
            </section> <?php
        }
        else{
            $liste_recetteBD = array();
            $liste_recetteBD_ing = array();
            $liste_recetteBD_tag = array();

            if ($recherche != "")
                $liste_recetteBD = $recettesBD->getRecetteByName($recherche); // Récupération des recettes par nom

            if ($recherche_tag != ""){
                $i = 0;
                foreach ($recherche_tag as $tag){
                    $liste_recetteBD_t = $recettesBD->getRecetteByTagId($tag); // Récupération des recettes par id de tag.
                    $liste_recetteBD_tag[$i] = $liste_recetteBD_t;
                    $i++;
                }
            }

            if ($recherche_ing != ""){
                $i = 0;
                foreach ($recherche_ing as $ing){
                    $liste_recetteBD_ing[$i] = $recettesBD->getRecetteByIngID($ing);
                    $i++;
                }

            }

            $liste_recette_finale = array_merge($liste_recetteBD, $liste_recetteBD_tag, $liste_recetteBD_ing); // Permet de concaténer les 2 arrays obtenus précédemment.
            $bon = true;
            foreach ($liste_recette_finale as $fin){
                if (gettype($fin) == "array"){
                    if (sizeof($fin) == 0)
                        $bon = false;
                }
            }

            if ($bon == false): ?>
                <div id = "nothing"> Nothing Here </div>
            <?php
            else :
                $liste_recette = array();
                foreach ($liste_recette_finale as $fin){
                    $liste_recette = array_merge($liste_recette, $recettes->Convertir_recette($fin));
                }
                var_dump($liste_recette);
                $i = 0;?>
                <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                    <?php foreach ($liste_recette_finale as $recette){
                        echo $recette[$i]->getHTMLForSearch($liste_recette[$i]);
                        $i++;
                    } ?>
                </section>
            <?php endif;
        }
    }
}