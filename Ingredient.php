<?php

namespace classe;

class Ingredient
{
    public string $name;
    public string $image;
    public int $num_ing;

    public function __construct()
    {
        parent::__construct();
        $tab_ing = $this->getAllIngredient();
        $this->name = $tab_ing->nom_ing;
        $this->num_ing = $tab_ing->pk_num_ing;
        $this->image = $tab_ing->image_ing;


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

}