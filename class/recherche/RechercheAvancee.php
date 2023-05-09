<?php
namespace recherche;

use recette\Ingredient;
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
}