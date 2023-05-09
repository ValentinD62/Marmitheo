<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;
use recherche\RechercheAvancee;

ob_start() ?>


<?php
$recherche_a = new RechercheAvancee();
?>
<div id = "input_recherche_avancée">
    <form method='post' action = 'recherche_avancee.php' id="form-rech" >
        <input type="text" id="recherche_avancee" name="recherche_avancee" placeholder="Cherchez une recette, un tag...">
    </form>
</div>

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

</div>
<?php $content = ob_get_clean();
Template::render($content);
?>

