<?php

namespace recette;

use PDO;

class Ingredient extends RecetteBD
{
    public string $name;
    public string $image;
    public int $num_ing;

    public function __construct()
    {
        parent::__construct();
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

    /*public function createIng($name, $img = null):void
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

    }*/

    public function editionIng($ancien_nom, $nouv_nom = null, $img = null):void
    {
        if($nouv_nom != null){
            $nouv_nom = htmlspecialchars($nouv_nom);
            $ancien_nom = htmlspecialchars($ancien_nom);
            $edition_ing_nom = "UPDATE ingrédient SET nom_ing ='". $nouv_nom. "' WHERE nom_tag = '". $ancien_nom . "'";
            $statement = $this->pdo->prepare($edition_ing_nom);
            $statement->execute() or die(var_dump($statement->errorInfo()));

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
            $edition_ing_img = "UPDATE ingrédient SET image  '" .$imgName. "' WHERE nom_ing ='" .$ancien_nom."'";
            $statement = $this->pdo->prepare($edition_ing_img);
            $statement->execute() or die(var_dump($statement->errorInfo()));

        }

    }

    //supprimer les lignes dans Tag_recette en lien avec le tag name.
    public function deleteIngRecByIng($name):void
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = "DELETE FROM ing_recette WHERE 'fk_num_ing' = (SELECT pk_num_ing FROM ingrédient WHERE nom_ing = '" . $name. "' LIMIT 1 )";
        $statement = $this->pdo->prepare($del_tag_rec);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //supprimer les lignes dans tag en lien avec le tag name.
    public function deleteIng($name): void{
        $name = htmlspecialchars($name);
        $del_tag = "DELETE FROM ingrédient WHERE nom_ing = '" . $name . "' LIMIT 1";

        $statement = $this->pdo->prepare($del_tag);

        $this->deleteIngRecByIng($name);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //Fonction qui permet de convertir un array de classe reçu par le PDO en classe Ingredient.
    public function Convertir_Ingredient($tab_ing) :array{
        $tab_classe_ing = array();
        $i = 0;
        foreach ($tab_ing as $ing){
            $n_ing = new Ingredient();
            $n_ing->setNum_ing($ing->pk_num_ing);
            $n_ing->setImage($ing->image);
            $n_ing->setName($ing->nom_ing);
            $tab_classe_ing[$i] = $n_ing;
            $i++;
        }

        return $tab_classe_ing;
    }


}