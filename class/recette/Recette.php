<?php

namespace recette;

class Recette extends RecetteBD
{

    public int $id;
    public string $name;
    public string $image;
    public string $description;
    public int $num_rec;
    public $liste_ing = array();
    public $liste_tag = array();


    public function __construct(){
        parent::__construct();
    }

    //------------- Tous les setters de Recette. -------------------
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setName(string $name):void
    {
        $this->name = $name;
    }
    public function setImage(string $img):void
    {
        $this->image = $img;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setNum_rec(int $num_rec):void
    {
        $this->num_rec = $num_rec;
    }

    public function __toString()
    {
        return $this->name . " avec comme image : " . $this->image . "et comme description :" . $this->description;
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

    //permet de creer une recette et de l'ajouter dans la base de données.
    public function createRecette($name, $description = null, $img = null, $alltag = null, $all_name_ing, $all_img_ing):void
    {
        $name = htmlspecialchars($name);
        $description = htmlspecialchars($description);
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
        $query = 'INSERT INTO recette(nom_rec, image_rec, description) VALUES (:name, :img, :description)';
        $params = [
            'name' => htmlspecialchars($name),
            'img' => $imgName,
            'description' => htmlspecialchars($description)
        ];
        $this->exec($query, $params);

        // ----------- Partie pour ajouter les tags à la recette. -----------------------
        if($alltag != null){
            $tag_base = $this->getAllTag(); // récupère tous les tags sous formes de classes données par le PDO.
            $nb_recette_base = $this->getMax_num_Recette(); // récupère le num max de recette qui vaut donc la nouvelle recette qu'on vient d'ajouter.
            $i = 0;
            foreach($tag_base as $res){ // Récupération de tous les noms des tags.
                $tab_name[$i] = $res->nom_tag;
                $i++;
            }

            foreach ($alltag as $tag){
                if ($tab_name == null){
                    $exists = false;
                }
                else {
                    $exists = array_search($tag, $tab_name); // Recherche si le nom du tag est déjà dans la base de données.
                }
                $nb_tag_rec = $this->getMax_num_Tag_recette(); // le numéro du dernier tag_rectte enregistré.
                if ($exists != false){
                    $ajouter_tag_rec = 'INSERT INTO tag_recette(pk_tag_rec,fk_num_tag, fk_num_rec) VALUES (:tag_rec, :num_tag, :num_rec)';
                    $params = [
                        'tag_rec' => $nb_tag_rec + 1, //la Primary key du nouveau tag_recette
                        'num_tag' =>$tag_base[$exists]->pk_num_tag, // le numéro du tag que l'on veut lier.
                        'num_rec' => $nb_recette_base, // le numéro de la recette que l'on vient de créer.
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }

                else{
                    $this->addTagBD($tag); // ajoute le nouveau tag dans la base de données.
                    $nb_rec = $this->getMax_num_Tag(); // donne le numéro du tag que l'on vient de créer.
                    $ajouter_tag_rec = 'INSERT INTO tag_recette(pk_tag_rec, fk_num_tag, fk_num_rec) VALUES (:tag_rec, :num_tag, :num_rec)';
                    $params = [
                        'tag_rec' => $nb_tag_rec + 1, // la Primary Key du nouveau tag_recette.
                        'num_tag' => $nb_rec, // le numéro du tag que l'on vient de mettre dans la BDD.
                        'num_rec' => $nb_recette_base, // le numéro de la recette que l'on vient de créer
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }
            }
        }

        // ----------- Partie pour ajouter les ingrédients à la recette. -----------------------

        if($all_name_ing != null && $all_img_ing != null){
            $ing_base = $this->getAllIngredient(); // récupère tous les ingrédients sous formes de classes données par le PDO.
            $nb_recette_base = $this->getMax_num_Recette(); // donne le numéro de la recette que l'on vient de créer.
            $i = 0;
            foreach($ing_base as $ing){ // Récupération de tous les noms des ingrédients.
                $tab_ing_name[$i] = $ing->nom_ing;
                $i++;
            }
            var_dump($ing_base);
            $i = 0;
            foreach ($all_name_ing as $ing) {
                $exists = array_search($ing, $tab_ing_name); //Vérifie si l'ingrédient est dans la BDD.
                $nb_ing_rec = $this->getMax_num_Ing_recette(); //donne le numéro du dernier ing_recette créé.

                if ($exists != false) {
                    $ajouter_tag_rec = 'INSERT INTO ing_recette(pk_id, fk_num_rec, fk_num_ing) VALUES (:id,:num_rec, :num_ing)';
                    $params = [
                        'id' => $nb_ing_rec + 1, //la primary key du nouveau ing_recette.
                        'num_rec' => $nb_recette_base, //le numéro de la recette que l'on vient de créer.
                        'num_ing' => $ing_base[$exists]->pk_num_ing, // le numéro de l'ingrédient que l'on veut lier.
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }

                else{
                    $img_Ing_Name = null;
                    if ($img != null) {
                        $tmpName = $all_img_ing[$i]['tmp_name'];
                        $img_Ing_Name = $all_img_ing[$i]['name'];
                        $img_Ing_Name = urlencode(htmlspecialchars($img_Ing_Name));
                        $dirname = self::UPLOAD_DIR_ING;
                        if (!is_dir($dirname)) mkdir($dirname);
                        $uploaded = move_uploaded_file($tmpName, $dirname . $img_Ing_Name);
                        if (!$uploaded) die("FILE NOT UPLOADED");
                    } else echo "NO IMAGE !!!!";
                    $this->addIngBD($ing, $img_Ing_Name); // ajoute le nouvel ingrédient dans la BDD.
                    $nb_rec = $this->getMax_num_Ing(); // donne le numéro de l'ingrédient que l'on vient de créer.
                    $ajouter_tag_rec = 'INSERT INTO ing_recette(pk_id, fk_num_rec, fk_num_ing) VALUES (:id, :num_rec, :num_ing)';
                    $params = [
                        'id' => $nb_ing_rec + 1, //la primary key du nouveau ing_recette.
                        'num_rec' => $nb_recette_base, // le numéro de la recette que l'on vient de créer.
                        'num_ing' => $nb_rec, //le numéro de l'ingrédient que l'on vient de mettre dans la BDD.
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }
                $i++;
            }
        }
    }

    //Fonction qui permet de convertir un array de classe reçu par le PDO en classe Recette.
    public function Convertir_recette($tab_get_allrecette): array{
        $i = 0;
        $tab_allrecette = array();
        foreach ($tab_get_allrecette as $recette){
            $tab_tag = $this->getTagofRecette($recette->pk_num_rec); //Liste des tags_recette de la recette
            $tab_ing = $this->getIngofRecette($recette->pk_num_rec); //Liste des ing_recette de la recette
            $n_recette = new Recette();

            //Set des différentes informations.
            $n_recette->setId($recette->pk_num_rec);
            $n_recette->setName($recette->nom_rec);
            $n_recette->setImage($recette->image_rec);
            $n_recette->setDescription($recette->description);
            $j = 0;
            foreach ($tab_tag as $tag){
                $n_recette->liste_tag[$j] = $tag->nom_tag;
                $j++;
            }
            $j = 0;
            foreach ($tab_ing as $ing) {
                $n_recette->liste_ing[$j][0] = $ing->nom_ing;
                $n_recette->liste_ing[$j][1] = $ing->image;
                $j++;
            }
            $tab_allrecette[$i] = $n_recette;
            $i++;
        }
        return $tab_allrecette;
    }

    //supprimer les lignes dans Ing_recette en lien avec la recette name
    public function deleteIngRec($name):void
    {
        $name = htmlspecialchars($name);
        $del_ing_rec = "DELETE FROM ing_recette WHERE fk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = '" . $name. "' LIMIT 1)";
        $statement = $this->pdo->prepare($del_ing_rec);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //supprimer les lignes dans Tag_recette en lien avec la recette name
    public function deleteTagRecByRecette($name):void
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = "DELETE FROM tag_recette WHERE 'fk_num_rec' = (SELECT pk_num_rec FROM recette WHERE nom_rec = '" . $name. "' LIMIT 1 )";
        $statement = $this->pdo->prepare($del_tag_rec);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }




    //supprimer la recette correspondant au $name dans les différentes tables recettes.
    public function deleteRecette($name):void
    {
        $name = htmlspecialchars($name);
        $del_rec = "DELETE FROM recette WHERE nom_rec = '" . $name . "' LIMIT 1";

        $statement = $this->pdo->prepare($del_rec);
        // Exécution de la requête

        $this->deleteIngRec($name);
        $this->deleteTagRecByRecette($name);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function editionRecette():void
    {

    }

}