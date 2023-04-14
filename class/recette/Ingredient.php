<?php

namespace recette;

use classe\PDO;

class Ingredient extends RecetteBD
{
    public string $name;
    public string $image;
    public int $num_ing;

    public $alling = array();

    public function __construct()
    {
        parent::__construct();
        $this->init_alling();
    }

    public function setName($name):void
    {
        $this->name = $name;
    }

    public function setNum_ing($num_ing):void
    {
        $this->num_ing = $num_ing;
    }

    public function setImage($img):void
    {
        $this->image = $img;
    }

    //return tout les elements de la table Ingredient
    public function getAllIngredient(): array
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM ingrédient";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;

    }

    public function init_alling():void
    {
        $tab_ing = $this->getAllIngredient();
        $i = 0;
        foreach($tab_ing as $I){
            $this->alling[$i] = new Ingredient();
            $this->alling[$i]->name = $I->nom_ing;
            $this->alling[$i]->num_ing = $I->pk_num_ing;
            $this->alling[$i]->image = $I->image;
        }
    }





}