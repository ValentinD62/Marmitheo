<?php

use recette\RecetteBD;
//Atag = tableau de tout les tags present dans la base de donnees
//Aing = tableau de tout les ingredients present dans la base de donnees
$m = new RecetteBD();
$Atag = $m->getAllTag();
$Aing = $m->getAllIngredient();


?>


<script>
//fonction qui permet de gerer les inputs des formulaires.
document.addEventListener('DOMContentLoaded', function (){
    // récupération du formulaire
    let form_tag = document.getElementById("form_tag");
    if (form_tag != null){
        let inputs = form_tag.getElementsByTagName("input"); //Liste d'input.
        let datalist = form_tag.getElementsByTagName("datalist"); //Liste de select.
            form_tag.addEventListener('keyup', function(){
            let i = 0;
            for (let input of inputs){
                i = i+1;
            }

            if (inputs[i-1].value.length >= 1 && inputs[i] !== null){
                let vrai_i = i+1;
                let data = document.createElement("datalist");
                data.id = "list_tag_" + vrai_i;
                let l = 0;
                for (let input of inputs){
                    if (input.type === "text"){
                        l = l+1;
                    }
                }
                let num = 0;
                <?php
                for ($i = 0; $i < sizeof($Atag); $i++) {?>
                num = 0;
                //ne pas afficher les tags deja selectionner
                for(let k = 0; k < l; k++){
                    if("<?php echo $Atag[$i]->nom_tag; ?>" == inputs[k].value){
                        num = num + 1;
                    }}

                if(num == 0) {
                    let opt_<?= $i ?> = document.createElement("option");
                    opt_<?= $i ?>.value = "<?php echo $Atag[$i]->nom_tag; ?>";
                    opt_<?= $i ?>.innerHTML = "<?php echo $Atag[$i]->nom_tag; ?>";
                    data.appendChild(opt_<?= $i ?>);
                }
                <?php }?>


                let inp = document.createElement("input");
                inp.setAttribute('list', "list_tag_" + vrai_i);
                inp.type = "text";
                inp.classList.add("form-tag-input");
                inp.id = "tag_" + vrai_i;
                inp.color = "black";
                inp.name = "tag_" + vrai_i;

                form_tag.appendChild(inp);
                form_tag.appendChild(data);


            }
            if (i >= 2) {
                if (inputs[i-2].value.length === 0){
                    form_tag.removeChild(inputs[i-1])
                    form_tag.removeChild(datalist[i-1])

                }
            }
        })

    }

    let form_ingredient = document.getElementById("form_ingredient");
    if (form_ingredient != null){
        let inputs = form_ingredient.getElementsByTagName("input"); //Liste d'input.
        let datalist = form_ingredient.getElementsByTagName("datalist"); //Liste de datalist.
        form_ingredient.addEventListener('keyup', function(){
            let i = 0;
            let name = [];
            for (let input of inputs){
                if (input.type === "text"){
                    i = i+1;
                    name[i] = input;
                    console.log(name[i].value)
                }
            }
            let j = 0;
            let image = [];
            for (let input of inputs){
                if (input.type === "file"){
                    j = j+1;
                    image[i] = input;
                }
            }
            if (name[i].value.length >= 1){
                let vrai_i = i+1;
                let data = document.createElement("datalist");
                data.id = "list_ingredient_" + vrai_i;

                let num = 0;
                <?php for ($i = 0; $i < sizeof($Aing); $i++) {?>

                    num = 0;
                    for(let k = 0; k < l; k++){
                        if(<?php echo $Aing[$i]->nom_ing; ?> == inputs[k].value){
                            num = num + 1;
                    }}
                    if(num == 0){
                        let opt_<?= $i ?>= document.createElement("option");
                        opt_<?= $i ?>.value = "<?php echo $Aing[$i]->nom_ing; ?>";
                        opt_<?= $i ?>.innerHTML = "<?php echo $Aing[$i]->nom_ing; ?>";
                        data.appendChild(opt_<?= $i ?>);
                    }

                <?php }?>


                let inp = document.createElement("input");
                inp.type = "text";
                inp.classList.add("form-ingredient-input");
                inp.id = "ingredient_" + vrai_i;
                inp.color = "black";
                inp.name = "ingredient_" + vrai_i;
                inp.setAttribute('list', "list_ingredient_" + vrai_i);
                form_ingredient.appendChild(inp);
                form_ingredient.appendChild(data);
                let img_add = document.createElement("input");
                img_add.type = "file";
                img_add.classList.add("img_ing_add");
                img_add.id = "image_ing_" + vrai_i;
                img_add.name = "image_ing_" + vrai_i;
                img_add.accept = "image/png, image/gif, image/jpeg";
                form_ingredient.appendChild(img_add);
                console.log("If : " + inputs[i-1].type);
            }

            if (i >= 2) {
                console.log(name[i].value.length)
                if (name[i].value.length === 0 && name[i-1].value.length === 0){
                    form_ingredient.removeChild(name[i])
                    form_ingredient.removeChild(image[i])
                    form_ingredient.removeChild(datalist[i-1])
                }
            }
        })
    }


})
</script>