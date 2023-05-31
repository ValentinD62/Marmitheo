<?php

use recette\RecetteBD;

$recette = new RecetteBD();

?>
<script>
    var button = document.getElementsByClassName('nolog');
    var button2 = document.getElementsByClassName('modifie');
    function m() {

        elems = this.querySelector("#id-recherche").innerText
        location.href="../pages/detail.php?id=" + elems  ;
    }

    function modi() {

        elems = this.querySelector("#id-recherche").innerText
        location.href="../pages/edit-recette.php?id=" + elems  ;
    }


    for (var i = 0;i<button.length;i++) {
        button[i].addEventListener('click',m);
    }
    for (var j = 0;j<button2.length;j++) {
        button2[j].addEventListener('click',modi);
    }



</script>

<?php ?>


