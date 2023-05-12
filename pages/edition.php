<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use recette\Recette;
use recette\RecetteBD;
use recette\RecetteRenderer;
use Template\Template;
?>

<?php ob_start()  ?>


<?php $content = ob_get_clean();
Template::render($content);
?>