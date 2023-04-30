<?php

namespace recette;

class RecetteRenderer{

    public function getHTMLForSearch(): void {?>
        <div class="recette">
            <div id="img-recherche">
            <img src= "../img/<?= $this->image_rec?>">
            </div>
            <div id="nom-recherche"><?= $this->nom_rec ?></div>
        </div>
    <?php }

    public function getAllHTML(): void{ ?>
        <div class="recette-allHtml">
            <div id="img-allHtml">
            <img src= "../img/<?= $this->image_rec?>">
            </div>
            <div id="nom-allHtml"><?= $this->nom_rec ?></div>
            <div id = "description-allHtml"><?= $this->description ?></div>
            <?php if ($this->liste_tag != null): ?>
                 <div id="tags_allHtml"><?php foreach ($this->liste_tag as $tag): ?>
                    <div id = "tag_recette"><?= $tag->name ?></div>
                    <?php endforeach; ?>
                 </div>
            <?php endif ?>
        </div>
    <?php }
}