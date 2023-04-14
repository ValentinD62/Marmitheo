<?php

namespace classe;

class Tag extends Base
{
    public string $name;
    public int $num_tag;
    public $alltag = array();

    public function __construct(string $nom_tag, int $num_tag)
    {
        parent::__construct();
        $this->name = $nom_tag;
        $this->num_tag = $num_tag;
        $this->init_alltag();
    }

    public function getAllTag(): array
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM tag";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "BaseRenderer");
        return $results;
    }

    public function init_alltag():void
    {
        $tab_tag = $this->getAllTag();
        $i = 0;
        foreach($tab_tag as $T){
            $this->alltag[$i] = new Tag($T->nom_rec, $T->pk_num_rec );
        }
    }

    //permet d'ajouter des tags
    public function createTag($name)
    {
        $name = htmlspecialchars($name);
        $query = 'INSERT INTO tag(nom_tag) VALUES (:name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($query, $params);
    }

    //supprimer le Tag name dans la table Tag
    public function deleteTag($name)
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = 'DELETE FROM tag WHERE pk_num_tag = (SELECT pk_num_tag FROM recette WHERE nom_tag = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($del_tag_rec, $params);

    }

    //permet de supprimer toute les elements de tag_recette qui on pour tag name
    public function deleteRecTag($name)
    {
        $name = htmlspecialchars($name);
        $del_rec_tag = 'DELETE FROM tag_recette WHERE fk_num_tag = (SELECT pk_num_tag FROM tag WHERE nom_rec = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($del_rec_tag, $params);
    }


}
