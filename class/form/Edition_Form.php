<?php

namespace form;

use recette\RecetteBD;

class Edition_Form{
    public function generateEditionRecetteForm()
    {
        ?>
        <div id="Creation">Modifier une recette :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="nom_rec" class="form-label">Editer recette</label>
                <input type="text" class="form-control" id="edit_recette" color="black" name="edit_recette" aria-describedby="name">
            </div>
             <div style="display: flex">
                <button type="submit" class="btn neon">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" class="btn neon">Reset</button>
            </div>
        </form>
        <?php
    }

    public function generateEditionIngForm()
    {
        ?>
        <div id="Creation">Modifier un ingrédient :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="nom_ing" class="form-label">Editer Ingrédient</label>
                <input type="text" class="form-control" id="edit_ing" color="black" name="edit_ing" aria-describedby="name" >
                <datalist id="list_ing">

            </div>
            <div style="display: flex">
                <button type="submit" class="btn neon">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" class="btn neon">Reset</button>
            </div>
        </form>
        <?php
    }

    public function generateEditionTagForm()
    {
        ?>
        <div id="Creation">Modifier un Tag :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="ancien_nom_tag" class="form-label">Editer tag</label>
                <input type="text" class="form-control" id="edit_tag" color="black" name="edit_tag" aria-describedby="ancien_nom_tag" list="list_tag">
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
        </form>
        <?php
    }
}
