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
        <div id="detail-Title"><?= $recette->name ?></div>

        <div id="detail">
            <div id = "detail-description"><?= $recette->description ?></div>

            <div id="detail-img">
                <img src= "../img/<?= $recette->image?>">
            </div>

        </div>

        <div id = "detail-tag-ing">

            <div id = "detail-tag">
            <?php
            if ($recette->liste_tag != null){
                     foreach ($recette->liste_tag as $tag){
                         echo $tag;
                     }
            }?>
            </div>
            <?php if ($recette->liste_ing != null): ?>
                <div id="ings_allHtml"><?php foreach ($recette->liste_ing as $ing): ?>
                        <div id = "ing_recette"><?= $ing[0]?></div>
                        <img src= "../img/img_ingredient/<?=$ing[1]?>">
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        </div>
    <?php }
}