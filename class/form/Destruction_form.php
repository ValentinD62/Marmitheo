<?php

namespace form;

use recette\RecetteBD;

class Destruction_form{
    public function generateDeleteRecetteForm()
    {
        ?>
        <div class="General">
        <div class="Suppression">Supprimer une recette :</div>

        <form id="recette-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="nom_rec" class="form-label">Nom de la recette :</label>
                <input type="text" class="form-control2" id="delete_name" name="delete_name" aria-describedby="name" list="list_rec">
                <datalist id="list_rec">
                    <?php
                    $m = new RecetteBD();
                    $query = $m->getAllRecette();

                    for ($i = 0; $i < sizeof($query); $i++) {
                        ?>
                        <option value="<?php echo $query[$i]->nom_rec; ?>">
                            <?php echo $query[$i]->nom_rec; ?>
                        </option>
                    <?php } ?>
                </datalist>
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

    public function generateDeleteTagForm()
    {
        ?>
        <div class="General">
        <div class="Suppression">Supprimer un Tag :</div>
        <form id="recette-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="nom_tag class=" form-label">Nom du tag :</label>
                <input type="text" class="form-control2" id="delete_tag" name="delete_tag" aria-describedby="name" list="list_tag">
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
            <div class="sub-supp">
                <button type="submit" style="border-radius: 20px">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" style="border-radius: 20px">Reset</button>
            </div>
        </form>
            </div>
        <?php

    }

    public function generateDeleteIngredientForm()
    {
        ?>
        <div class="General">
        <div class="Suppression">Supprimer un Ingredient :</div>
        <form id="recette-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="nom_ing class=" form-label">Nom de l'ingredient :</label>
                <input type="text" class="form-control2" id="delete_ing" name="delete_ing" aria-describedby="name" list="list_ing">
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

