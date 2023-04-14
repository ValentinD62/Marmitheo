

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
                let inp = document.createElement("input");
                inp.type = "text";
                inp.classList.add("form-tag-input");
                inp.id = "tag_" + i;
                inp.color = "black";
                inp.name = "tag";
                form_tag.appendChild(inp);
            }
        })
    }

    let form_ingredient = document.getElementById("form_ingredient");
    if (form_ingredient != null){
        let inputs = form_ingredient.getElementsByTagName("input"); //Liste d'input.
        form_ingredient.addEventListener('keyup', function(){
            let i = 0;
            for (let input of inputs){
                i = i+1;
            }
            if (inputs[i-1].value.length >= 1 && inputs[i] !== null){
                let inp = document.createElement("input");
                inp.type = "text";
                inp.classList.add("form-ingredient-input");
                inp.id = "tag_" + i;
                inp.color = "black";
                inp.name = "tag";
                form_ingredient.appendChild(inp);
            }
        })
    }

})