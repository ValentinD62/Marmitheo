<?php require_once __DIR__ . "/../class/autoload.php";
Autoloader::register();
use Template\Template;

ob_start()  ?>
<?php session_start() ;
session_destroy(); ?>

<?php
$id_recette = $_GET['id'];


?>


<?php $content = ob_get_clean();
Template::render($content);
?>