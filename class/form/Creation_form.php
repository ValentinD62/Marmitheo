<?php

namespace form;

class Creation_form{

    public function generateCreationForm(){?>
        <div id="b">
            <nav id="primary_nav_wrap1">

                <ul>

                    <li class="MainMenu" id="MainMenurot"><a href="#"></a>
                        <p id="menu"> Menu</p>
                        <ul>
                            <li><a href="#">DELETE</a></li>
                            <li><a href="#">EDIT</a></li>

                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
        <div id ="General">
            <div id = "Creation">Créez vos recettes : </div>
            <form id="game-form" method="POST" enctype="multipart/form-data">
               <div id="one">
                <div id="nom">
                    <label for="name" class="form-label" id="nameadd">Nom de la recette </label>
                    <input type="text"  id="name" color = "black" name="name" aria-describedby="name">
                </div>
                <div id="descri">
                    <label for="description" class="form-label" id="descriadd">Description</label>
                    <textarea type = "black" class="form-control" id="description" name="description" color="black"></textarea>
                </div>
               </div>
                <div id="ima">
                    <label for="image" id="imaadd" > Uploader l'image du plat    :
                        <div id="preview-container">
                            <img id="preview-image" src="">
                        </div>
                    </label>
                    <input type="file" id="inpadd"  name="image" accept="image/png, image/gif, image/jpeg">
                </div>


                <div id="ing-tag">
                    <div id="alltag">
                <label for="tag" class="CENTER">Tag</label>
                <div id="form_tag">
                    <input type="text" class="form-tag-input" id="tag_1" color = "black" name="tag">
                    </div>
                    </div>
                    <div id="alling">
                <label for="ingredient" class="CENTER">Ingrédient</label>
                <div id="form_ingredient">
                    <input type="text" class="form-ingredient-input" id="ingredient_1" color = "black" name="ingredient">
                </div>
                    </div>


                </div>
                <div id="sub-reset" style="display: flex">
                    <button type="submit" class="btn">Submit</button>
                    <div style="width: 30px"></div>
                    <button type="reset" class="btn">Reset</button>
                </div>

            </form>
        </div>
        <?php
    }
}