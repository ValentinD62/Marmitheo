
<?php

use recette\RecetteBD;

$recette = new RecetteBD();

?>
<script>
var button = document.getElementsByClassName('recette');
function m() {

    elems = this.querySelector("#nom-recherche").innerHTML
    location.href="../pages/detail.php?name=" + elems  ;
};

for (var i = 0;i<button.length;i++) {
    button[i].addEventListener('click',m);
}

</script>

<?php ?>

