<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use Template\Template;
use log\Logger_admin;

?>

<?php ob_start() ?>

<?php session_start() ;?>

<?php

if (isset($_POST['name'])){
    if ($_POST["name"] == 1234){
        $_SESSION['name'] = $_POST['name'] ;
        header("Location: administrateur.php");
    }
    else{
        $logger = new Logger_admin();
        $username = $_POST['name'];
        $array_form = $logger->log($username);
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