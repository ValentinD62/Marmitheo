<?php

namespace form;

class Destruction_form{
    public function generateDeleteRecetteForm()
    {
        ?>
        <div id="Creation">Supprimer une recette :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="nom_rec" class="form-label">Nom recette</label>
                <input type="text" class="form-control" id="delete_name" name="delete_name" aria-describedby="name">
            </div>
            <div style="display: flex">
                <button type="submit" class="btn neon">Submit</button>
                <div style="width: 30px"></div>
                <button type="reset" class="btn neon">Reset</button>
            </div>
        </form>
        <?php
    }

    public function generateDeleteTagForm()
    {
        ?>
        <div id="Creation">Supprimer un Tag :</div>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div class="mb-3 neon">
                <label for="nom_tag class=" form-label">Nom Tag</label>
                <input type="text" class="form-control" id="delete_tag" name="delete_tag" aria-describedby="name">
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

