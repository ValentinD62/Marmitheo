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
?>

<div id = "liste-avancee">
    <div class = "titre_liste_avancee"> TAG :</div>
    <div id = "liste_tag">
        <?php
            $recherche_a->afficher_liste_tag();
        ?>
    </div>
    <div class = "titre_liste_avancee"> INGREDIENT :</div>
    <div id = "liste_ing">
        <?php
            $recherche_a->afficher_liste_ing();
        ?>
    </div>
</div>


<div id = "resultat_recherche_avancée">
    <?php
        if (isset($_POST['recherche_avancee'])){
            echo $_POST['recherche_avancee'];
        }
        else{
            $recherche_a->getRechercheRecette();
        }
    ?>
</div>
<?php $content = ob_get_clean();
Template::render($content);
?>

