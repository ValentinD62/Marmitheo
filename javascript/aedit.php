
<?php

use recette\RecetteBD;

$recette = new RecetteBD();

?>
<script>
    var button = document.getElementById("edit_name");
    function ah() {

        elems = this.querySelector("#id-recherche").innerHTML
        location.href="../pages/detail.php?id=" + elems  ;
    };

    for (var i = 0;i<button.length;i++) {
        button[i].addEventListener('click',m);
    }

</script>

<?php ?>
