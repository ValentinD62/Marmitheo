<?php
namespace recherche;

use recette\Ingredient;
use recette\Recette;
use recette\RecetteBD;
use recette\Tag;

class RechercheAvancee{


    public function Recherche_avancee_form(): void{?>
        <div id = "input_recherche_avancée">
            <form method='post' action = 'recherche_avancee.php' id="form-rech" >
                <input type="text" id="recherche_avancee" name="recherche_avancee" placeholder="Cherchez une recette, un tag...">
            </form>
        </div>
        <?php
    }
    public function afficher_liste_tag(): void{
        $tags = new Tag();
        $recettesBD = new RecetteBD();
        $tab_tag = $recettesBD->getAllTag();
        $tab_tag = $tags->Convertir_tag($tab_tag);
        foreach ($tab_tag as $tag) {
            echo $tag->name . " " . "</br>";
        }
    }

    public function afficher_liste_ing(): void{
        $tags = new Ingredient();
        $recettesBD = new RecetteBD();
        $tab_ing = $recettesBD->getAllIngredient();
        $tab_ing = $tags->Convertir_ingredient($tab_ing);
        foreach ($tab_ing as $ing) {
            echo $ing->name . " " . "</br>";
        }
    }

    public function getRechercheRecette(): void{
        $recettesBD = new RecetteBD();
        $recettes = new Recette();
        $recherche = $_POST['recherche_avancee'];
        if ($recherche == ""){
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
            $liste_recetteBD = $recettesBD->getRecetteByName($recherche); // Récupération des recettes par nom
            $liste_recetteBD_tag = $recettesBD->getRecetteByTag($recherche); // Récupération des recettes par nom de tag.
            $liste_recette_finale = array_merge($liste_recetteBD, $liste_recetteBD_tag);

            if ($liste_recette_finale == null): ?>
                <div id = "nothing"> Nothing Here </div>
            <?php
            else :
                $liste_recette = $recettes->Convertir_recette($liste_recette_finale);
                $i = 0;?>
                <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                    <?php foreach ($liste_recette_finale as $recette){
                        echo $recette->getHTMLForSearch($liste_recette[$i]);
                        $i++;
                    } ?>
                </section>
            <?php endif;
        }
    }
}