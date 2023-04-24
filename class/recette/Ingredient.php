<?php

namespace recette;

use PDO;

class Ingredient //extends RecetteBD
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

    public function createIng($name, $img = null):void
    {
        $name = htmlspecialchars($name);
        $imgName = null;
        if ($img != null) {
            $tmpName = $img['tmp_name'];
            $imgName = $img['name'];
            $imgName = urlencode(htmlspecialchars($imgName));
            $dirname = self::UPLOAD_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else echo "NO IMAGE !!!!";
        $query = 'INSERT INTO ingrédient(nom_ing, image) VALUES (:name, :img)';
        $params = [
            'name' => htmlspecialchars($name),
            'img' => $imgName,
        ];
        $this->exec($query, $params);

    }

    public function editionIng($ancien_nom, $nouv_nom = null, $img = null):void
    {
        if($nouv_nom != null){
            $nouv_nom = htmlspecialchars($nouv_nom);
            $ancien_nom = htmlspecialchars($ancien_nom);
            $edition_ing_nom = 'UPDATE ingrédient SET nom_ing = :n_nom WHERE nom_tag = :a_nom ';
            $params = [
                'n_nom' => htmlspecialchars($nouv_nom),
                'a_nom' => htmlspecialchars($ancien_nom)
            ];
            $this->exec($edition_ing_nom, $params);
        }
        if($img != null){
            $ancien_nom = htmlspecialchars($ancien_nom);
            $tmpName = $img['tmp_name'];
            $imgName = $img['name'];
            $imgName = urlencode(htmlspecialchars($imgName));
            $dirname = self::UPLOAD_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
            $edition_ing_img = 'UPDATE ingrédient SET image = :img WHERE nom_ing = : a_nom';
            $params = [
                'img' => imgName,
                'a_nom' => htmlspecialchars($ancien_nom)
            ];
            $this->exec($edition_ing_img, $params);
        }

    }



}