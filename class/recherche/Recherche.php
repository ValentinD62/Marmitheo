<?php
namespace recherche;

use recette\Recette;
use recette\RecetteBD;
use recette\RecetteRenderer;

class Recherche{
    function getRechercheRecette(): void{
        $recettesBD = new RecetteBD();
        $recettes = new Recette();
        $recherche = $_POST['recherche'];
        if ($recherche == ""){
            $liste_recetteBD = $recettesBD->getAllRecette();
            $liste_recette = $recettes->AllRecette($liste_recetteBD);
            $i = 0;  ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recetteBD as $recette){
                    echo $liste_recette[$i]->image;
                    echo $recette->getAllHTML($liste_recette[$i]);
                    $i++;
                }
                ?>
            </section> <?php
        }
        else{
            $liste_recette = $recettes->AllRecette($recettesBD->getRecetteByName($recherche));
            if ($liste_recette == null): ?>
                <div id = "nothing"> Nothing Here </div>
            <?php
            else : ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recette as $recette): ?>
                    <?= $recette->getHTMLForSearch() ?>
                <?php endforeach; ?>
            </section>
                <?php endif;
        }
    }
}