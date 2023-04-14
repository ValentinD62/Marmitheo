<?php
namespace recette;
use PDO;

class RecetteBD
{
    public $pdo;
    public const UPLOAD_DIR = "../img/";
    public function __construct()
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

    public function getAllRecette():void
    {
        // Préparation d'une requête simple
        $sql = "SELECT* FROM recette" ;
        $statement = $this->pdo->prepare($sql) ;
        // Exécution de la requête
        $statement->execute() or die(var_dump($statement->errorInfo())) ;

        // Récupération de la réponse sous forme d'un tableau d'instances de GameRenderer
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "BaseRenderer") ;?>
        <ul>
            <?php foreach ($results as $recette): ?>
                <li><?= $recette->getHTML() ?></li>
            <?php endforeach;?>
        </ul>
        <?php
    }

    public function createRecette($name, $description=null, $img=null){
        $name = htmlspecialchars($name);
        $description = htmlspecialchars($description);
        $imgName = null;
        if($img != null){
            $tmpName = $img['tmp_name'] ;
            $imgName = $img['name'] ;
            $imgName = urlencode(htmlspecialchars($imgName)) ;
        }
        else{
            echo "NO IMAGE !!!!" ;
        }
        $query = 'INSERT INTO recette(nom_rec, image_rec, description) VALUES (:name, :img, :description)';
        $params=[
            'name' => htmlspecialchars($name),
            'img' => $imgName,
            'description' => htmlspecialchars($description)
        ];
        return $this->exec($query, $params);
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
}
