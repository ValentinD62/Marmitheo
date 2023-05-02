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

    public function getAllHTML($recette): void{ ?>
        <div class="recette-allHtml">
            <div id="img-allHtml">
                <?= "OUI ??"?>
            <img src= "../img/<?= $recette->image?>">
            </div>
                <?= "NON ??" ?>
            <div id="nom-allHtml"><?= $recette->name ?></div>
            <div id = "description-allHtml"><?= $recette->description ?></div>
            <?php if ($recette->liste_tag != null): ?>
                 <div id="tags_allHtml"><?php foreach ($recette->liste_tag as $tag): ?>
                    <div id = "tag_recette"><?= $tag ?></div>
                    <?php endforeach; ?>
                 </div>
            <?php endif ?>
        </div>
    <?php }
}