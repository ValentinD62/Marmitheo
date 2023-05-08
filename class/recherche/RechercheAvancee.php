<?php
namespace recherche;

use recette\RecetteBD;
use recette\Tag;

class RechercheAvancee{


    public function afficher_liste_tag(): void{
        $tags = new Tag();
        $recettesBD = new RecetteBD();
        $tab_tag = $recettesBD->getAllTag();
        $tab_tag = $tags->Convertir_tag($tab_tag);
        foreach ($tab_tag as $tag) {
            echo $tag->name . " " . "</br>";
        }
    }
}