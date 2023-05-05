<?php require_once __DIR__ . "/../class/autoload.php";

Autoloader::register();


use Template\Template;
?>


<?php ob_start()  ?>
<?php session_start() ;
session_destroy(); ?>

<div id="detail-Title">Le nom de la recette</div>


<div id="detail">
    <div id="detail-description">
        aa aa aa aaa aaaaaaaa aaaaaaaaaaa aaa aaaaaaaaaaa aaa aa
        aa aa aa aaa aaaaaaaa aaaaaaaaaaa aaa aaaaaaaaaaa aaa aa

    </div>

    <div id="detail-img">
        <img src="../img/Chocolat_Matheo.jpg">

    </div>




</div>



<?php $content = ob_get_clean();
Template::render($content);
?>

