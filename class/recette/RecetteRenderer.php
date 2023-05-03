<?php

namespace recette;

class RecetteRenderer{

    public function getHTMLForSearch($recette): void {?>
        <div class="recette">
            <div id="img-recherche">
            <img src= "../img/<?= $recette->image ?>">
            </div>
            <div id="nom-recherche"><?= $recette->name ?></div>
        </div>
    <?php }

    public function getAllHTML($recette): void{ ?>
        <div class="recette-allHtml">
            <div id="img-allHtml">
            <img src= "../img/<?= $recette->image?>">
            </div>
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