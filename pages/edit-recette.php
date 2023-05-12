<?php ob_start()  ?>
<?php session_start() ;
session_destroy(); ?>

<?php
$id_recette = $_GET['id'];


?>


<?php $content = ob_get_clean();
Template::render($content);
?>