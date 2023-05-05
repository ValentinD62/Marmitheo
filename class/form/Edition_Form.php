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
                <label for="nom_rec" class="form-label">Nom recette</label>
                <input type="text" class="form-control" id="name" color="black" name="name" aria-describedby="name">
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
                <label for="nom_ing" class="form-label">Nom ingrédient</label>
                <input type="text" class="form-control" id="name" color="black" name="name" aria-describedby="name" >
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
                <label for="ancien_nom_tag" class="form-label">Ancien nom Tag</label>
                <input type="text" class="form-control" id="name" color="black" name="ancien_nom_tag" aria-describedby="ancien_nom_tag" list="list_tag">
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
            <div class="mb-3 neon">
                <label for="nouveau_nom_tag" class="form-label">Nouveau nom Tag</label>
                <input type="text" class="form-control" id="name" color="black" name="nouveau_nom_tag" aria-describedby="nouveau_nom_tag">
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
