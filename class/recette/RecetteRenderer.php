<?php

namespace recette;

class RecetteRenderer{

    public function getHTML(): void {?>
        <div class="recette">
            <img src= "../img/<?= $this->image_rec?>">
            <b><?= $this->nom_rec ?></b>
            <div><?= $this->description ?></div>
        </div>
    <?php }
}