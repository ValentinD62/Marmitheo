<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;
use recette\RecetteBD;
use recherche\RechercheAvancee;

session_start() ;

session_destroy();

ob_start() ?>


<?php
    $recherche_a = new RechercheAvancee();
    $recherche_a->Recherche_avancee_form();

    $recherche_a->afficher_liste_check();
?>

<div id = "resultat_recherche_avancée">
    <?php
    echo var_dump($_POST["selection_tag"]);
    echo var_dump($_POST["selection_ing"]);
        if (isset($_POST['recherche_avancee'])){
            echo $_POST['recherche_avancee'];
        }
        else{
            $recherche_a->getRechercheRecette();
            echo $_POST['recherche_avancee'];
        }
    ?>
</div>
<?php $content = ob_get_clean();
Template::render($content);
?>

