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

    //permet de modifier le tag
    public function editionTag($ancien_nom, $nouveau_nom):void
    {
        $ancien_nom = htmlspecialchars($ancien_nom);
        $nouveau_nom = htmlspecialchars($nouveau_nom);
        $edition_tag = 'UPDATE tag SET nom_tag = :n_nom WHERE nom_tag = :a_nom ';
        $params = [
            'n_nom' => htmlspecialchars($nouveau_nom),
            'a_nom' => htmlspecialchars($ancien_nom)
            ];
        $this->exec($edition_tag, $params);
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
