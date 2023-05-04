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

    //supprimer le Tag name dans la table Tag
    public function deleteTag($name):void
    {
        $name = htmlspecialchars($name);
        $del_tag = 'DELETE FROM tag WHERE pk_num_tag = (SELECT pk_num_tag FROM recette WHERE nom_tag = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($del_tag, $params);

    }

    //permet de supprimer toute les elements de tag_recette qui on pour tag name
    public function deleteRecTag($name):void
    {
        $name = htmlspecialchars($name);
        $del_rec_tag = 'DELETE FROM tag_recette WHERE fk_num_tag = (SELECT pk_num_tag FROM tag WHERE nom_rec = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($del_rec_tag, $params);
    }


}
