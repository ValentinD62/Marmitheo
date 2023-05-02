<?php

namespace recette;

class Recette extends RecetteBD
{

    public string $name;
    public string $image;
    public string $description;
    public int $num_rec;
    public $ing = array();
    public $liste_tag = array();


    public function __construct(){
        parent::__construct();
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

    //permet de creer une recette
    public function createRecette($name, $description = null, $img = null, $alltag = null):void
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


        if($alltag != null){
            $tag_base = $this->getAllTag();
            $nb_recette_base = count($this->getAllRecette());
            $i = 0;
            foreach($tag_base as $res){
                $tab_name[$i] = $res->nom_tag;
                $i++;
            }

            foreach ($alltag as $tag){
                $exists = array_search($tag, $tab_name);
                $nb_tag_rec = count($this->getAll_num_Tag_recette());
                if ($exists != false){
                    $ajouter_tag_rec = 'INSERT INTO tag_recette(pk_tag_rec,fk_num_tag, fk_num_rec) VALUES (:tag_rec,:num_tag, :num_rec)';
                    $params = [ // JE COMPRENDS PAS LA.
                        'tag_rec' => $nb_tag_rec + 1,
                        'num_tag' =>$tag_base[$exists]->pk_num_tag,
                        'num_rec' => $nb_recette_base,
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }

                else{
                    $this->addTagBD($tag);
                    $nb_rec = count($this->getAllTag());
                    $ajouter_tag_rec = 'INSERT INTO tag_recette(fk_num_tag, fk_num_rec) VALUES (:num_tag, :num_rec)';
                    $params = [ // JE COMPRENDS PAS LA.
                        'num_tag' => $nb_rec,
                        'num_rec' => $nb_recette_base,
                    ];
                    $this->exec($ajouter_tag_rec, $params);
                }
            }
        }
    }

    public function Allrecette($tab_get_allrecette): array{
        $i = 0;
        $tab_allrecette = array();
        foreach ($tab_get_allrecette as $recette){
            $tab_tag = $this->getTagofRecette($recette->pk_num_rec);
            $n_recette = new Recette();
            $n_recette->setName($recette->nom_rec);
            $n_recette->setImage($recette->image_rec);
            $n_recette->setDescription($recette->description);
            $j = 0;
            foreach ($tab_tag as $tag){
                $n_recette->liste_tag[$j] = $tag->nom_tag;
                $j++;
            }
            $tab_allrecette[$i] = $n_recette;
            $i++;
        }
        return $tab_allrecette;
    }

    //supprimer la recette name dans la table recette
    public function deleteRecette($name):void
    {
        $name = htmlspecialchars($name);
        $del_rec = 'DELETE FROM recette WHERE pk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = :name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($del_rec, $params);
    }

    //supprimer les lignes dans Ing_recette en lien avec la recette name
    public function deleteIngRec($name):void
    {
        $name = htmlspecialchars($name);
        $del_ing_rec = 'DELETE FROM ing_recette WHERE fk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = $name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($del_ing_rec, $params);
    }

    //supprimer les lignes dans Tag_recette en lien avec la recette name
    public function deleteTagRec($name):void
    {
        $name = htmlspecialchars($name);
        $del_tag_rec = 'DELETE FROM tag_recette WHERE fk_num_rec = (SELECT pk_num_rec FROM recette WHERE nom_rec = $name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($del_tag_rec, $params);
    }

    public function editionRecette():void
    {
        
    }

}