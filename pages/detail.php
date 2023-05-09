<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use recette\Recette;
use recette\RecetteBD;
use recette\RecetteRenderer;
use Template\Template;
?>


<?php ob_start()  ?>
<?php session_start() ;
session_destroy(); ?>

<?php
$id_recette = $_GET['id'];
$recette_R = new RecetteRenderer();
$recettesBD = new RecetteBD();
$recette = new Recette();
$recettesBD = $recettesBD->getRecetteById($id_recette);
$liste_recette = $recette->Convertir_recette($recettesBD);

$recette_R->getAllHTML($liste_recette[0]);

?>


<?php $content = ob_get_clean();
Template::render($content);
?>