<?php

namespace form;

use recette\RecetteBD;

class Edition_Form{
    public function generateEditionRecetteForm()
    {
        ?>
        <div class="General">
        <div class="Edit" id="recette-edit">Modifier une recette :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="nom_rec" class="form-label">Nom de la recette :</label>
                <input type="text" class="form-control2 " id="edit_name" color="black" name="name" aria-describedby="name">
                <datalist id="list_rec">
                    <?php
                    $m = new RecetteBD();
                    $query = $m->getAllRecette();

                    for ($i =   0; $i < sizeof($query); $i++) {
                        ?>
                        <option value="<?php echo $query[$i]->nom_rec; ?>">
                            <?php echo $query[$i]->nom_rec; ?>
                        </option>
                    <?php } ?>
                </datalist>
            </div>
             <div class="sub-supp">
                <button type="submit"style="border-radius: 20px" onclick="ah()">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset"style="border-radius: 20px" >Reset</button>
            </div>
        </form>
        </div>
        <?php
    }

    public function generateEditionIngForm()
    {
        ?>
        <div class="General">
        <div class="Edit">Modifier un ingrédient :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">

                <label for="nom_ing" class="form-label2">Nom de l'ingrédient :</label>
                <input type="text" class="form-control2" id="tag-Edit" color="black" name="name" aria-describedby="name" list="list_ing">


                <datalist id="list_ing">
                    <?php
                    $m = new RecetteBD();
                    $query = $m->getAllIngredient();

                    for ($i = 0; $i < sizeof($query); $i++) {
                        ?>
                        <option value="<?php echo $query[$i]->nom_ing; ?>">
                            <?php echo $query[$i]->nom_ing; ?>
                        </option>
                    <?php } ?>
                </datalist>

            </div>
            <div class="sendhelp">
            <div class="should_center_this">
                <label for="nouveau_nom_ing" class="form-label2">Nouveau nom d'Ingredient :</label>
                <input type="text" class="form-control2" id="new_ing" color="black" name="nouveau_nom_ing" aria-describedby="nouveau_nom_ing">
            </div>
                <div class = "new-img-ing">
                <input type="file" class="form-2" id="new_img" color="black" name="nouveau_img_ing" aria-describedby="nouveau_img_ing">
                </div>
            </div>


            <div class="sub-supp">
                <button type="submit" style="border-radius: 20px">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" style="border-radius: 20px">Reset</button>
            </div>
        </form>
        </div>
        <?php
    }

    public function generateEditionTagForm()
    {
        ?>
        <div class="General">
        <div class="Edit">Modifier un Tag :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="ancien_nom_tag" class="form-label">Nom du Tag :</label>
                <input type="text" class="form-control2" id="tag_edit" color="black" name="ancien_nom_tag" aria-describedby="ancien_nom_tag" list="list_tag">

                <datalist id="list_tag">
                    <?php
                    $m = new RecetteBD();
                    $query = $m->getAllTag();

                    for ($i = 0; $i < sizeof($query); $i++) {
                        ?>
                        <option value="<?php echo $query[$i]->nom_tag; ?>">
                            <?php echo $query[$i]->nom_tag; ?>
                        </option>
                    <?php } ?>
                </datalist>
            </div>
            <div class="should_center_this">
                <label for="nouveau_nom_tag" class="form-label">Nouveau nom de Tag :</label>
                <input type="text" class="form-control2" id="new-tag" color="black" name="nouveau_nom_tag" aria-describedby="nouveau_nom_tag">
            </div>
            <div class="sub-supp">
                <button type="submit" style="border-radius: 20px">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" style="border-radius: 20px">Reset</button>
            </div>

        </form>
        </div>
        <?php
    }
}
