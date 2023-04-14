<?php

namespace recette;

class RecetteRenderer{

    public function getHTML(): void {?>
        <div class="recettes">
            <b><?= $this->nom_rec ?></b>
            <img src= "../img/<?= $this->image_rec?>">
            <div><?= $this->description ?></div>
        </div>
    <?php }
}