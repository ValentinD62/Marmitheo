
<?php

use recette\RecetteBD;

$recette = new RecetteBD();

?>
<script>
    var button = document.getElementById("edit_name");
    function ah() {

        elems = this.querySelector("#id-recherche").innerHTML
        location.href="../pages/detail.php?id=" + elems  ;
    }

    var button_add_ing = document.getElementById("btn-ajt-ing");
    var button_add_tag = document.getElementById("btn-ajt-tag");
    function editingadd(){
        var x = document.getElementById("ing-edit");
        let inp = document.createElement("input");
        inp.type = "text";
        inp.classList.add("form-ingredient-input");
        inp.color = "black";
        inp.name = "nom_ing[]";
        let inp_img = document.createElement("input");
        inp_img.type = "file";
        inp_img.classList.add("input-modif-img");
        inp_img.color = "black";
        inp_img.accept = "image/png, image/gif, image/jpeg";
        inp_img.name = "img_ing[]";
        x.appendChild(inp);
        x.appendChild(inp_img);
    }

    function edittagadd(){
        var x = document.getElementById("tag-edit");
        let inp = document.createElement("input");
        inp.setAttribute('list', "list_tag");
        inp.type = "text";
        inp.classList.add("form-tag-input");
        inp.color = "black";
        inp.name = "nom_tag[]";
        x.appendChild(inp);

    }
    if(button!=null) {
        for (var i = 0; i < button.length; i++) {
            button[i].addEventListener('click', m);
        }
    }
    button_add_ing.addEventListener('click', editingadd);
    button_add_tag.addEventListener('click', edittagadd);
</script>

<?php ?>

