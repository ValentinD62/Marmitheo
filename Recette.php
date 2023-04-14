<?php

namespace classe;


class Recette extends Base
{

    private string $name;
    private string $image;
    private string $description;
    private int $num_rec;
    private $ing = array();
    private $tag = array();
    private $rec = array();

    public function __construct(string $nom_rec, string $img, string $desc, int $num)
    {
        parent::__construct();
        $this->name = $nom_rec;
        $this->image = $img;
        $this->description = $desc;
        $this->num_rec = $num;
        $this->init_ing();
        $this->init_tag();
        $this->init_rec();
    }

    //return tout les elements de la table recette
    public function getAllRecette(): array
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

    public function init_rec():void
    {
        $tab_rec = $this->getAllRecette();
        $i = 0;
        foreach($tab_rec as $R){
            $this->rec[$i] = new Recette($R->nom_rec,$R->image_rec, $R->description, $R->pk_num_rec );
        }
    }

    //return tout les elements de la table ing_recette
    public function getAllRecIng(): array
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM ing_recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

    //return tout les elements de la table tag_recette
    public function getAllRecTag(): array
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM tag_recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "BaseRenderer");
        return $results;
    }

    public function init_ing(): void
    {
        $tab_ingRec = $this->getAllRecIng();
        $i = 0;
        foreach($tab_ingRec as $ingRec){
            if($this->num_rec == $ingRec->fk_num_rec){
                $this->ing[$i] = new Ingredient();
                $this->ing[$i]->num_ing = $ingRec->fk_num_ing;
                $name = 'SELECT nom_ing FROM ingrédient WHERE pk_num_ing =:num ';
                $img = 'SELECT image_ing FROM ingrédient WHERE pk_num_ing = :num';
                $params=['num' => $ingRec->fk_num_ing];
                $this->ing[$i]->name = $this->exec($name, $params);
                $this->ing[$i]->image = $this->exec($img, $params);
                $i = $i + 1;
            }
        }
    }

    //initialise le tableau de tag
    public function init_tag(): void
    {
        $tab_tagRec = $this->getAllRecTag();
        $i = 0;
        foreach($tab_tagRec as $tagRec){
            if($this->num_rec == $tagRec->fk_num_rec){
                $this->tag[$i] = new Tag();
                $this->tag[$i]->num_tag = $tagRec->fk_num_tag;
                $name = 'SELECT nom_tag FROM Tag WHERE pk_num_tag =:num ';
                $params=['num' => $tagRec->fk_num_tag];
                $this->tag[$i]->name = $this->exec($name, $params);
                $i = $i + 1;
            }
        }
    }

    //permet de creer une recette
    public function createRecette($name, $description = null, $img = null)
    {
        $name = htmlspecialchars($name);
        $description = htmlspecialchars($description);
        $imgName = null;
        if ($img != null) {
            $tmpName = $img['tmp_name'];
            $imgName = $img['name'];
            $imgName = urlencode(htmlspecialchars($imgName));

            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else echo "NO IMAGE !!!!";
        $query = 'INSERT INTO recette(nom_rec, image_rec, description) VALUES (:name, :img, :description)';
        $params = [
            'name' => htmlspecialchars($name),
            'img' => $imgName,
            'description' => htmlspecialchars($description)
        ];
        return $this->exec($query, $params);
    }

    //supprimer la recette name dans la table recette
    public function deleteRecette($name)
    {
        $name = htmlspecialchars($name);
        $del_rec = 'DELETE FROM recette WHERE pk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($del_rec, $params);
    }

    //supprimer les lignes dans Ing_recette en lien avec la recette name
    public function deleteIngRec($name)
    {
        $name = htmlspecialchars($name);
        $del_ing_rec = 'DELETE FROM ing_recette WHERE fk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = $name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($del_ing_rec, $params);
    }

    //supprimer les lignes dans Tag_recette en lien avec la recette name
    public function deleteTagRec($name)
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = 'DELETE FROM tag_recette WHERE fk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = $name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        return $this->exec($del_tag_rec, $params);
    }

}