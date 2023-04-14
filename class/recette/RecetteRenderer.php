<?php

namespace recette;

class RecetteRenderer{

    public function getHTML(): void {?>
        <div class="recette">
            <div id="img-recherche">
            <img src= "../img/<?= $this->image_rec?>">
            </div>
                <div id="nom-recherche"><?= $this->nom_rec ?></div>
                <!-- <div><? // = $this->description ?></div> -->
        </div>
    <?php }
}