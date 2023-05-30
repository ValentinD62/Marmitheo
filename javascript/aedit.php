
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
        x.appendChild(inp);
    }

    function edittagadd(){
        var x = document.getElementById("tag-edit");
        let inp = document.createElement("input");
        inp.setAttribute('list', "list_tag");
        inp.type = "text";
        inp.classList.add("form-tag-input");
        inp.color = "black";
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

