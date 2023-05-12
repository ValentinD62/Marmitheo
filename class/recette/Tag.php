<?php

namespace recette;

use PDO;

class Tag extends RecetteBD
{
    public string $name;
    public int $num_tag;

    public function __construct(){
        parent::__construct();
    }

    public function setName($name):void{
        $this->name = $name;
    }

    public function setNum_tag($num_tag):void{
        $this->num_tag = $num_tag;
    }

    //Fonction qui permet de convertir un array de classe reçu par le PDO en classe Tag.
    public function Convertir_tag($tab_tag) :array{
        $tab_classe_tag = array();
        $i = 0;
        foreach ($tab_tag as $tag){
            $n_tag = new Tag();
            $n_tag->setNum_tag($tag->pk_num_tag);
            $n_tag->setName($tag->nom_tag);
            $tab_classe_tag[$i] = $n_tag;
            $i++;
        }

        return $tab_classe_tag;
    }

    //permet de modifier le tag
    public function editionTag($ancien_nom, $nouveau_nom):void
    {
        $ancien_nom = htmlspecialchars($ancien_nom);
        $nouveau_nom = htmlspecialchars($nouveau_nom);
        $edition_tag = "UPDATE tag SET nom_tag = '". $nouveau_nom."' WHERE nom_tag = '" .$ancien_nom."'";
        $statement = $this->pdo->prepare($edition_tag);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }


    //supprimer les lignes dans Tag_recette en lien avec le tag name.
    public function deleteTagRecByTag($name):void
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = "DELETE FROM tag_recette WHERE 'fk_num_tag' = (SELECT pk_num_tag FROM tag WHERE nom_tag = '" . $name. "' LIMIT 1 )";
        $statement = $this->pdo->prepare($del_tag_rec);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //supprimer les lignes dans tag en lien avec le tag name.
    public function deleteTag($name): void{
        $name = htmlspecialchars($name);
        $del_tag = "DELETE FROM tag WHERE nom_tag = '" . $name . "' LIMIT 1";

        $statement = $this->pdo->prepare($del_tag);

        $this->deleteTagRecByTag($name);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }
}