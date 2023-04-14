

document.addEventListener('DOMContentLoaded', function (){
    // récupération du formulaire
    let form_tag = document.getElementById("form_tag");
    if (form_tag != null){
        let inputs = form_tag.getElementsByTagName("input"); //Liste d'input.
        form_tag.addEventListener('keyup', function(){
            let i = 0;
            for (let input of inputs){
                i = i+1;
            }
            if (inputs[i-1].value.length >= 1 && inputs[i] !== null){
                let vrai_i = i+1;
                let inp = document.createElement("input");
                inp.type = "text";
                inp.classList.add("form-tag-input");
                inp.id = "tag_" + vrai_i;
                inp.color = "black";
                inp.name = "tag_" + vrai_i;
                form_tag.appendChild(inp);
            }
            if (i >= 2) {
                if (inputs[i-2].value.length === 0){
                    form_tag.removeChild(inputs[i-1])
                }
            }
        })
    }

    let form_ingredient = document.getElementById("form_ingredient");
    if (form_ingredient != null){
        let inputs = form_ingredient.getElementsByTagName("input"); //Liste d'input.
        form_ingredient.addEventListener('keyup', function(){
            let i = 0;
            for (let input of inputs){
                if (input.type === "text"){
                    i = i+1;
                }
            }
            console.log(i);
            if (inputs[i-1].type === "text"){
                if (inputs[i-1].value.length >= 1 && inputs[i] !== null){
                    let vrai_i = i+1;
                    let inp = document.createElement("input");
                    inp.type = "text";
                    inp.classList.add("form-ingredient-input");
                    inp.id = "ingredient_" + vrai_i;
                    inp.color = "black";
                    inp.name = "ingredient_" + vrai_i;
                    form_ingredient.appendChild(inp);
                    let img_add = document.createElement("input");
                    img_add.type = "file";
                    img_add.classList.add("img_ing_add");
                    img_add.name = "image_ing_" + vrai_i;
                    img_add.accept = "image/png, image/gif, image/jpeg";
                    form_ingredient.appendChild(img_add);
                    console.log("If : " + inputs[i-1].type);
                }
            }
            else{
                console.log("else");
                if (inputs[i-2].value.length >= 1 && inputs[i-1] !== null){
                    console.log("Dans le else : " + inputs[i-2].id);
                    let vrai_i = i+1;
                    let inp = document.createElement("input");
                    inp.type = "text";
                    inp.classList.add("form-ingredient-input");
                    inp.id = "ingredient_" + vrai_i;
                    inp.color = "black";
                    inp.name = "ingredient_" + vrai_i;
                    form_ingredient.appendChild(inp);
                    let img_add = document.createElement("input");
                    img_add.type = "file";
                    img_add.classList.add("img_ing_add");
                    img_add.name = "image_ing_" + vrai_i;
                    img_add.accept = "image/png, image/gif, image/jpeg";
                    form_ingredient.appendChild(img_add);

                }
            }
            if (i >= 3) {
                if (inputs[i-3].value.length === 0){
                    form_ingredient.removeChild(inputs[i-1])
                    form_ingredient.removeChild(inputs[i-1])
                }
            }
        })
    }

})
