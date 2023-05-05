<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use recette\Recette;
use recette\RecetteBD;
use Template\Template;
?>


<?php ob_start()  ?>
<?php session_start() ;
session_destroy(); ?>

<?php
$id_recette = $_GET['id'];
$recettesBD = new RecetteBD();
$recette = new Recette();
$recettesBD = $recettesBD->getRecetteById($id_recette);
$liste_recette = $recette->AllRecette($recettesBD);
$i = 0;
foreach ($recettesBD as $recette){
    $recette->getAllHTML($liste_recette[$i]);
    $i++;
}

?>



<?php $content = ob_get_clean();
Template::render($content);
?>

