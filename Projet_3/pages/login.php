<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use Template\Template;
use log\Logger_admin;

?>

<?php ob_start() ?>

<?php session_start() ;?>

<?php

if (isset($_POST['name']) && isset($_POST["pwd"])){
    if ($_POST["name"] == "chef" && $_POST["pwd"] == "matheo"){
        $_SESSION['name'] = $_POST['name'] ;
        header("Location: administrateur.php");
    }
    else{
        $logger = new Logger_admin();
        $username = $_POST['name'];
        $pwd = $_POST['pwd'];
        $array_form = $logger->log($username, $pwd);
        $logger->generateLoginForm("login.php", $array_form["error"]);
    }
}
else{
    $logger = new Logger_admin();
    $logger->generateLoginForm("login.php", " ");
}


?>

    <!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>

    <!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>