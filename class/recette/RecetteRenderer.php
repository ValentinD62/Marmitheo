<?php

namespace recette;

class RecetteRenderer{

    public const UPLOAD_DIR = "../img/";

    //Fonction pour afficher la fonction minimaliste des informations
    //d'une recette.
    public function getHTMLForSearch($recette): void {?>

        <div class="recette" id="recette<?php echo $recette->id?>">
            <div class = "nolog">
                <div id="img-recherche">
                <img src= "../img/<?= $recette->image ?>">
                </div>
                <div id="nom-recherche"><?= $recette->name ?></div>
                <div id="id-recherche"><?= $recette->id ?></div>
            </div>
            <?php if (isset($_SESSION['name'])):?>
                <script>
                    var m = document.querySelector("#recette<?php echo $recette->id?>");
                    var Item = document.createElement("div");
                    var elem = document.createElement("img");
                    var elem1 = document.createElement("div");
                    elem1.setAttribute("id","id-recherche");
                    elem1.innerText = <?= $recette->id ?>;
                    Item.appendChild(elem1);
                    elem.setAttribute("src", "../img/bouton-modifier.png");
                    elem.classList.add("img-edit");
                    Item.appendChild(elem);
                    Item.classList.add("modifie");
                    m.appendChild(Item);
                </script>
            <?php endif ?>
        </div>

    <?php }


    //Fonction pour afficher toutes les informations d'une recette.
    public function getAllHTML($recette): void{ ?>
        <div id="detail-Title"><?= $recette->name ?></div>

        <div id="detail">
            <div id = "detail-description"><?= $recette->description ?></div>

            <div id="detail-img">
                <img src= "../img/<?= $recette->image?>">
            </div>

        </div>

        <div id = "detail-tag-ing">

            <div class = "detail-tag">
                <div class="txt-detail"> Tag : </div>
            <?php
            if ($recette->liste_tag != null){
                     foreach ($recette->liste_tag as $tag){ ?>
                         <div class = "tag_recette"><?= $tag?></div>
                     <?php
                     }
            }?>
            </div>
            <?php if ($recette->liste_ing != null): ?>
                <div class="detail-ing">
                    <div class="txt-detail">Ingredients : </div>

                    <?php foreach ($recette->liste_ing as $ing): ?>
                    <div class = "sep-detail-ing">
                        <img src= "../img/img_ingredient/<?=$ing[1]?>">
                        <div class = "ing_recette"><?= $ing[0]?></div>
                    </div>
                    <?php endforeach; ?>

                </div>
            <?php endif ?>
        </div>
    <?php }

    //Fonction pour pouvoir modifier les différentes recettes.
    public function getAllModifHTML($recette): void{ ?>
        <form id="edit-form" method="POST" enctype="multipart/form-data">
            <div id="detail-Title" class="centeragain">
                <label for="nom_recette" > Nom de la Recette</label>
                <input type="text" class = "input-modif1" id = "nom_recette" name = "nom_recette" value="<?= $recette->name?>">
                <?= $recette->image ?>
            </div>

            <div id="detail">
                <div id = "detail-description">
                    <label for="description_modif" id="labelmod"> Description</label>
                    <textarea class = "input-modif" id = "description_modif" name = "description_modif"> <?= $recette->description?> </textarea>
                </div>
                <div id="detail-img">
                    <label for="image_recette"> Image :</label>
                    <input type="file" class = "input-modif-img" id = "image_recette_modif" name = "image_recette_modif" value="<?= self::UPLOAD_DIR . $recette->image?>" accept="image/png, image/gif, image/jpeg">
                    <img  id = "img-modif" src= "<?= self::UPLOAD_DIR . $recette->image?>" alt="image de la recette">
                </div>
            </div>

            <div id = "detail-tag-ing" class="taging-mod">
                <div class = "detail-tag">
                    <div class="txt-detail"> Tag : </div>
                    <?php
                    if ($recette->liste_tag != null){
                        foreach ($recette->liste_tag as $tag){ ?>
                            <div class = "tag_recette">
                                <input type="text" class = "input-modif" name = "tag_modif[]" value="<?= $tag?>">
                            </div>
                            <?php
                        }
                    }?>
                </div>
                <div class="detail-ing">
                    <div class="txt-detail">Ingredients : </div>
                    <?php if ($recette->liste_ing != null): ?>
                        <?php foreach ($recette->liste_ing as $ing): ?>
                            <div class = "sep-detail-ing">
                                <div class = "ing_recette">
                                    <input type="text" class = "input-modif" name = "nom_ing_modif[]" value="<?= $ing[0]?>">
                                </div>
                                <input type="file" class = "input-modif" id = "image_recette" name = "image_ing_modif[]" value="<?= "../img/img_ingredient/" . $ing[1]?>" accept="image/png, image/gif, image/jpeg">
                                <img src= "../img/img_ingredient/<?=$ing[1]?>" alt="image de <?= $ing[0]?>">
                            </div>
                        <?php endforeach; ?>
                <?php endif ?>
                </div>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    <?php }
}