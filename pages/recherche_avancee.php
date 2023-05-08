<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;

ob_start()  ?>

<div id = "input_recherche_avancée">

</div>

<div id = "liste-tags">

</div>

<div id = "resultat_recherche_avancée">

</div>
<?php $content = ob_get_clean();
Template::render($content);
?>

