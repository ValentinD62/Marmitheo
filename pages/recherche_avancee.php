<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;
use recette\RecetteBD;
use recherche\RechercheAvancee;

session_start() ;

session_destroy();

ob_start() ?>

<div id="recheche-all">
<?php
    $recherche_a = new RechercheAvancee();



    $recherche_a->afficher_liste_checks();

   ?>

<div id="gauche_oskour">
<?php
$recherche_a->Recherche_avancee_form();
?>

<div id = "resultat_recherche_avancée">
    <?php
        $recherche_a->getRechercheRecette();
    ?>
</div>
</div>
</div>
<?php $content = ob_get_clean();
Template::render($content);
?>

