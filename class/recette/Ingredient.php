<?php

namespace recette;

use classe\PDO;

class Ingredient extends RecetteBD
{
    public string $name;
    public string $image;
    public int $num_ing;

    public $alling = array();

    public function __construct(string $nom_ing, string $img, int $num_ing)
    {
        parent::__construct();
        $this->name = $nom_ing;
        $this->num_ing = $num_ing;
        $this->image = $img;
        $this->init_alling();


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
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "BaseRenderer");
        return $results;

    }

    public function init_alling():void
    {
        $tab_ing = $this->getAllIngredient();
        $i = 0;
        foreach($tab_ing as $I){
            $this->alling[$i] = new Ingredient($I->nom_ing, $I->image_ing, $I->pk_num_ing );
        }
    }



}