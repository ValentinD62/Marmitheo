
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

            if (i >= 3) {
                console.log(name[i].value.length)
                if (name[i].value.length == 0 && name[i-1].value.length == 0){

                    form_ingredient.removeChild(name[i])
                    form_ingredient.removeChild(image[i])
                }
            }
        })
    }

})
