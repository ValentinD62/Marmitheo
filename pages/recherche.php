<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();

use recherche\Recherche;

use Template\Template;

session_start() ;

?>

<?php ob_start() ?>

<?php
$recherche = new Recherche();
$recherche->getRechercheRecette();

?>



<?php

?>


<?php
$content = ob_get_clean();
Template::render($content);
