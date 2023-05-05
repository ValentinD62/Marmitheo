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
                    echo $recette->getHTMLForSearch($liste_recette[$i]);
                    $i++;
                }
                ?>
            </section> <?php
        }
        else{
            $liste_recetteBD = $recettesBD->getRecetteByName($recherche);
            if ($liste_recetteBD == null): ?>
                <div id = "nothing"> Nothing Here </div>
            <?php
            else :
                $liste_recette = $recettes->AllRecette($liste_recetteBD);
                $i = 0;?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recetteBD as $recette){
                    echo $recette->getHTMLForSearch($liste_recette[$i]);
                    $i++;
                } ?>
            </section>
                <?php endif;
        }
    }
}