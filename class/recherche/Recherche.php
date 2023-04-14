<?php
namespace recherche;

use recette\RecetteBD;

class Recherche{
    function getRechercheRecette(): void{
        $recettes = new RecetteBD();
        $recherche = $_POST['recherche'];
        if ($recherche == ""){
            $recettes = new RecetteBD();
            $liste_recette = $recettes->getAllRecette(); ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recette as $recette): ?>
                    <?= $recette->getHTML() ?>
                <?php endforeach; ?>
            </section> <?php
        }
        else{
            $liste_recette = $recettes->getRecetteByName($recherche);
            if ($liste_recette == null): ?>
                <div id = "nothing"> Nothing Here </div>
            <?php
            else : ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recette as $recette): ?>
                    <?= $recette->getHTML() ?>
                <?php endforeach; ?>
            </section>
                <?php endif;
        }
    }
}