<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;

ob_start()  ?>


<?php $content = ob_get_clean();
Template::render($content);
?>

