<?php

namespace form;

use recette\RecetteBD;

class Destruction_form{
    public function generateDeleteRecetteForm()
    {
        ?>
        <div id="General">
        <div id="Suppression">Supprimer une recette :</div>

        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="should_center_this">
                <label for="nom_rec" class="form-label">Nom recette</label>
                <input type="text" class="form-control" id="delete_name" name="delete_name" aria-describedby="name" list="list_rec">
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
            <div style="display: flex">
                <button type="submit" class="btn">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" class="btn">Reset</button>
            </div>

        </form>
            </div>
        <?php
    }

    public function generateDeleteTagForm()
    {
        ?>
        <div id="Delete_tag">Supprimer un Tag :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="nom_tag class=" form-label">Nom Tag</label>
                <input type="text" class="form-control" id="delete_tag" name="delete_tag" aria-describedby="name" list="list_tag">
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
            <div style="display: flex">
                <button type="submit" class="btn neon">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" class="btn neon">Reset</button>
            </div>
        </form>
        <?php

    }
}

