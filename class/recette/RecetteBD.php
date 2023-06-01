<?php
namespace recette;
use PDO;

class RecetteBD
{
    public PDO $pdo;
    public const UPLOAD_DIR = "../img/";

    public const UPLOAD_DIR_ING = "../img/img_ingredient/";
    public function __construct() // Constructeur pour pouvoir lier le php avec la BDD
    {
        // Informations sur la BDD et le serveur qui la contient
        $db_name = "Projet_3" ;
        $db_host = "127.0.0.1" ;
        $db_port = "3306" ;
        // Informations d'authentification de votre script PHP :
        $db_user = "root" ;
        $db_pwd = "" ;
        // Connexion à la BDD
        try{
            // Agrégation des informations de connexion dans une chaine DSN (Data Source Name)
            $dsn = 'mysql:dbname=' . $db_name . ';host='. $db_host. ';port=' . $db_port;

            // Connexion et récupération de l'objet connecté
            $this->pdo = new PDO($dsn, $db_user, $db_pwd);
        }

            // Récupération d'une éventuelle erreur
        catch (\Exception $ex){ ?>
            <!-- Affichage des informations liées à l'erreur-->
            <div style="color: red">
            <b>!!! ERREUR DE CONNEXION !!!</b><br>
            Code : <?= $ex->getCode() ?><br>
            Message : <?= $ex->getMessage() ?>
            </div><?php
            // Arrêt de l'exécution du script PHP
            die("-> Exécution stoppée <-") ;
        }
    }

    public function exec($statement, $params, $classname=null){
        $res = $this->pdo->prepare($statement) ;
        $res->execute($params) or die(print_r($res->errorInfo()));

        if($classname != null){
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        }else{
            $data = $res->fetchAll(PDO::FETCH_OBJ);
        }

        return $data ;
    }

    //----------------------------------- Fonctions d'ajout -----------------------------------------------

    //permet d'ajouter des tags dans la base de données
    public function addTagBD($name):void
    {
        $name = htmlspecialchars($name);
        $query = 'INSERT INTO tag(nom_tag) VALUES (:name)';
        $params = [
            'name' => htmlspecialchars($name)
        ];
        $this->exec($query, $params);
    }

    //permet d'ajouter des ingrédients dans la base de données
    public function addIngBD($name, $image):void
    {
        $name = htmlspecialchars($name);
        $query = 'INSERT INTO ingrédient(nom_ing, image) VALUES (:name, :img)';
        $params = [
            'name' => htmlspecialchars($name),
            'img' => $image
        ];
        $this->exec($query, $params);
    }

    //----------------------------------- Fonctions de recherche de recettes -----------------------------------------------
    //Retourne toutes les recettes sous forme de tableau de recettes.
    public function getAllRecette(): array{
        // Préparation d'une requête simple
        $sql = "SELECT* FROM recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de recette
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        return $results;
    }

    //Fonction qui récupère les fonctions correspondant à (ou contenant) $name.
    public function getRecetteByName($name): array{ //
        // Préparation d'une requête simple
            $sql = "SELECT * FROM recette WHERE nom_rec like '%" . $name . "%'";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de recette
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        return $results;
    }

    //Fonction qui récupère la recette correspondant à l'id dans la BDD.
    public function getRecetteById($id): array{
        // Préparation d'une requête simple
        $sql = "SELECT * FROM recette WHERE pk_num_rec =" . $id;
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de recette
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        return $results;
    }

    //Fonction qui récupère les recettes ayant le tag $name
    public function getRecetteByTag($name): array{
        // Préparation d'une requête simple
        $sql = "SELECT * FROM recette INNER JOIN tag_recette on recette.pk_num_rec = tag_recette.fk_num_rec INNER JOIN tag on tag.pk_num_tag = tag_recette.fk_num_tag WHERE tag.pk_num_tag = (SELECT pk_num_tag FROM tag WHERE nom_tag ='" . $name . "')";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        return $results;
    }

    //Fonction qui récupère les recettes ayant le tag de $id
    public function getRecetteByTagId($id): array{
        // Préparation d'une requête simple
        $sql1 ="SELECT fk_num_rec FROM tag_recette INNER JOIN tag on tag.pk_num_tag = tag_recette.fk_num_tag WHERE tag.pk_num_tag =" . $id ;
        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute() or die(var_dump($statement1->errorInfo()));
        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results1 = $statement1->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        $results_final = array();
        foreach ($results1 as $res){
            $sql = "SELECT * FROM recette WHERE pk_num_rec =" . $res->fk_num_rec;
            $statement = $this->pdo->prepare($sql);
            // Exécution de la requête
            $statement->execute() or die(var_dump($statement->errorInfo()));
            // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
            $results_final = array_merge($results_final, $results);
        }
        return $results_final;
    }

    //Fonction qui récupère les recettes ayant le tag de $id
    public function getRecetteByIngID($id): array{
        // Préparation d'une requête simple
        $sql1 ="SELECT fk_num_rec FROM ing_recette INNER JOIN ingrédient on ingrédient.pk_num_ing = ing_recette.fk_num_ing WHERE ingrédient.pk_num_ing =" . $id;
        $statement1 = $this->pdo->prepare($sql1);
        $statement1->execute() or die(var_dump($statement1->errorInfo()));
        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results1 = $statement1->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
        $results_final = array();
        foreach ($results1 as $res){
            $sql = "SELECT * FROM recette WHERE pk_num_rec =" . $res->fk_num_rec;
            $statement = $this->pdo->prepare($sql);
            // Exécution de la requête
            $statement->execute() or die(var_dump($statement->errorInfo()));
            // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "recette\RecetteRenderer");
            $results_final = array_merge($results_final, $results);
        }

        return $results_final;
    }


//----------------------------------- Fonctions de recherhce des 2 tables de "liaison"-----------------------------------------------

    //Fonction qui récupère le nom des tags liés à la recette avec l'id $num_recette
    public function getTagofRecette($num_recette): array{
        $sql = "SELECT nom_tag FROM tag INNER JOIN tag_recette on tag.pk_num_tag = tag_recette.fk_num_tag WHERE tag_recette.fk_num_rec = " . $num_recette;
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

    //Fonction qui récupère les informations des ingrédients liés à la recette avec l'id $num_recette
    public function getIngofRecette($num_recette): array{
        $sql = "SELECT nom_ing, image FROM ingrédient INNER JOIN ing_recette on ingrédient.pk_num_ing = ing_recette.fk_num_ing WHERE ing_recette.fk_num_rec = " . $num_recette;
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }


    //----------------------------------- Fonctions pour retourner tous les éléments des 2 tables de liaison -----------------------------------------------

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
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

//----------------------------------- Fonctions de recherches de tous les tags et ingrédients -----------------------------------------------

    //Fonction qui récupère tous les tags de la BDD.
    public function getAllTag(): array{
        // Préparation d'une requête simple
        $sql = "SELECT* FROM tag";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;
    }

    //Fonction qui récupère tous les ingrédients de la BDD.
    public function getAllIngredient(): array{

        // Préparation d'une requête simple
        $sql = "SELECT* FROM ingrédient";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances d'ingredient.
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results;

    }
    //----------------------------------- Fonctions de récupération des derniers éléments crées -----------------------------------------------

    //récupère le numéro du dernier tag_recette créé.
    public function getMax_num_Tag_recette(): int{
        // Préparation d'une requête simple
        $sql = "SELECT MAX(pk_tag_rec) FROM tag_recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetch(PDO::FETCH_UNIQUE);
        return $results[0];
    }

    //récupère le numéro du dernier ing_recette créé.
    public function getMax_num_Ing_recette(): int{
        // Préparation d'une requête simple
        $sql = "SELECT MAX(pk_id) FROM ing_recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetch(PDO::FETCH_UNIQUE);
        return $results[0];
    }

    //récupère le numéro de la dernière recette créé.
    public function getMax_num_Recette(): int{
        // Préparation d'une requête simple
        $sql = "SELECT MAX(pk_num_rec) FROM recette";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetch(PDO::FETCH_UNIQUE);
        return $results[0];
    }

    //récupère le numéro du dernier tag créé.
    public function getMax_num_Tag(): int{
        // Préparation d'une requête simple
        $sql = "SELECT MAX(pk_num_tag) FROM tag";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetch(PDO::FETCH_UNIQUE);
        return $results[0];
    }

    //récupère le numéro du dernier ingrédient créé.
    public function getMax_num_Ing(): int{
        // Préparation d'une requête simple
        $sql = "SELECT MAX(pk_num_ing) FROM ingrédient";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse sous forme d'un tableau d'instances de tag
        $results = $statement->fetch(PDO::FETCH_UNIQUE);
        return $results[0];
    }

    //---------------------------Vérification des tags et ingrédients dans la recette -----------------------------------------------

    public function TaginRecette($id_tag, $id_rec): bool{
        $sql = "SELECT * FROM tag_recette WHERE fk_num_tag = '" . $id_tag . "' AND fk_num_rec = '" . $id_rec . "'";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse.
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results != null; //Return true si le tag est dans la recette sinon false;
    }

    public function InginRecette($id_ing, $id_rec): bool{
        $sql = "SELECT * FROM ing_recette WHERE fk_num_ing = '" . $id_ing . "' AND fk_num_rec = '" . $id_rec . "'";
        $statement = $this->pdo->prepare($sql);
        // Exécution de la requête
        $statement->execute() or die(var_dump(statement->errorInfo()));

        // Récupération de la réponse.
        $results = $statement->fetchAll(PDO::FETCH_CLASS);
        return $results != null; //Return true si le tag est dans la recette sinon false;
    }
}