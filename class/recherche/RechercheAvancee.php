<?php
namespace recherche;

use recette\Ingredient;
use recette\Recette;
use recette\RecetteBD;
use recette\Tag;

class RechercheAvancee{

    public function getHTMLForSearch($recette): void { //Fonction pour pouvoir accéder au HTML sans passer par RecetteRenderer?>

        <div class="recette">

            <div id="img-recherche">
                <img src= "../img/<?= $recette->image ?>">
            </div>
            <div id="nom-recherche"><?= $recette->name ?></div>
            <div id="id-recherche"><?= $recette->id ?></div>
        </div>

    <?php }
    public function afficher_liste_checks(): void{ //Affiche tous les tags et les ingrédients dont on a besoin pour la recherche avancee?>
            <div id = "liste-avancee">
            <form class="input_recherche_avancee" action="recherche_avancee.php" method="post" autocomplete="off">
               <div id="pour-le-after"> <button type = submit id = "button-avancee">Rechercher  </button></div>
                <div class = "titre_liste_avancee"> TAG :</div>
                <div id="pour-le-after">
                <div id = "liste_tag">
                    <?php
                    $tags = new Tag();
                    $recettesBD = new RecetteBD();
                    $tab_tag = $recettesBD->getAllTag();
                    $tab_tag = $tags->Convertir_tag($tab_tag);

                    foreach ($tab_tag as $tag) {?>
                        <input id = "<?= $tag->num_tag ?>" value="<?= $tag->num_tag ?>" type = "checkbox" name = "selection_tag[]">
                        <?php echo $tag->name . "</br>";
                    } ?>
                </div>
                </div>
                <div class = "titre_liste_avancee"> INGREDIENT :</div>
                <div id = "liste_ing">
                    <?php
                    $tags = new Ingredient();
                    $recettesBD = new RecetteBD();
                    $tab_ing = $recettesBD->getAllIngredient();
                    $tab_ing = $tags->Convertir_ingredient($tab_ing);

                    foreach ($tab_ing as $ing) { ?>
                        <input id = "<?=$ing->num_ing ?>" value="<?=$ing->num_ing ?>" type="checkbox" name = "selection_ing[]">
                        <?php echo $ing->name . " " . "</br>";
                    } ?>
                </div>
            </form>
            </div><?php
    }

    public function getRechercheRecette_avancee(): void{
        $recettesBD = new RecetteBD();
        $recettes = new Recette();

        if (!empty($_POST['selection_tag']))
            $recherche_tag = $_POST['selection_tag'];
        else
            $recherche_tag = "";

        if (!empty($_POST['selection_ing']))
            $recherche_ing = $_POST['selection_ing'];
        else
            $recherche_ing = "";

        if ($recherche_ing == "" && $recherche_tag == ""){
            $liste_recetteBD = $recettesBD->getAllRecette();
            $liste_recette = $recettes->Convertir_recette($liste_recetteBD);
            $i = 0;  ?>
            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php foreach ($liste_recetteBD as $recette){
                    echo $recette->getHTMLForSearch($liste_recette[$i]);
                    $i++;
                }
                ?>
            </section> <?php
        }
        else{
            $liste_recetteBD_ing = array();
            $liste_recetteBD_tag = array();

            if ($recherche_tag != ""){
                $i = 0;
                foreach ($recherche_tag as $tag){
                    $liste_recetteBD_t = $recettesBD->getRecetteByTagId($tag); // Récupération des recettes par id de tag.
                    $liste_recetteBD_tag[$i] = $liste_recetteBD_t;
                    $i++;
                }
            }

            if ($recherche_ing != "") {
                $i = 0;
                foreach ($recherche_ing as $ing) {
                    $liste_recetteBD_ing[$i] = $recettesBD->getRecetteByIngID($ing);
                    $i++;
                }
            }

            $liste_recette_finale = array_merge($liste_recetteBD_tag, $liste_recetteBD_ing); // Permet de concaténer les 2 arrays obtenus précédemment.
            $liste_recette = array();
            $i = 0;
            foreach ($liste_recette_finale as $fin){
                $liste_recette[$i] = $recettes->Convertir_recette($fin);
                $i++;
            }?>

            <section class = "recettes-list"><!--Affichage du champ 'name' des objets récupérés -->
                <?php
                $bon = false;
                $liste_dans_page = array();
                foreach ($liste_recette as $rec){
                    if ($rec != null){
                        for ($i = 0; $i < sizeof($rec); $i++){
                            $est_dedans = array_search($rec[$i]->id, $liste_dans_page);
                            if (gettype($est_dedans) == "boolean"){
                                $this->getHTMLForSearch($rec[$i]);
                                $liste_dans_page[$i] = $rec[$i]->id;
                                $bon = true;
                            }
                        }
                    }
                }
                if (!$bon){ ?>
                    <div class = "nothing">Nothing here</div> <?php
                }?>
            </section>
            <?php
        }
    }
}