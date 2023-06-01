<?php

use recette\RecetteBD;
use recette\Recette;

$recette_BD = new RecetteBD();
$recette = new Recette();
?>

<script>//Vu dans le tp 2 de javascript.

    <?php
        $tab_rec = $recette->Convertir_recette($recette_BD->getAllRecette());
        $nb_recettes = count($tab_rec) - 1;
        $nb_1_image = rand(0, $nb_recettes);
        $nb_2_image = rand(0, $nb_recettes);
        $nb_3_image = rand(0, $nb_recettes);
        while ($nb_1_image == $nb_2_image){
            $nb_2_image = rand(0,$nb_recettes);
        }
        while ($nb_3_image === $nb_1_image || $nb_3_image == $nb_2_image){
            $nb_3_image = rand(0, $nb_recettes);
        }
    ?>

    let recette1 = "<?= $tab_rec[$nb_1_image]->name?>"
    let recette2 = "<?= $tab_rec[$nb_2_image]->name?>"
    let recette3 = "<?= $tab_rec[$nb_3_image]->name?>"
    let images = []
    images.push("../img/<?= $tab_rec[$nb_1_image]->image?>")
    images.push("../img/<?= $tab_rec[$nb_2_image]->image?>")
    images.push("../img/<?= $tab_rec[$nb_3_image]->image?>")


    let thumbs = []
    let currentThumb = 0

    let nb_image = [<?= $tab_rec[$nb_1_image]->id?>,<?= $tab_rec[$nb_2_image]->id?>,<?= $tab_rec[$nb_3_image]->id?>]
    let displayImage = undefined

    let timer = undefined

    let gaucheIcon = undefined
    let droiteIcon = undefined

    //On initialise les différentes images à mettre sur la page.
    function createThumbs(){
        for (let src of images){
            let img = document.createElement("img")
            img.src = src
            let div = document.createElement("div")
            div.appendChild(img)
            thumbs.push(div) //Liste qui contient toutes les images sous "format élément".
        }
    }

    /**
     * Récupération de la chaine correspondant à l'attribut 'src' de la balise 'img' du '.thumb'
     * @param thumb : un élément ".thumb"
     * @returns le contenu de l'attribut 'src'
     */

    function getSrc(thumb){
       return thumb.getElementsByTagName("img")[0].src
    }

        /**
        * Affiche dans #display-image l'image contenue dans thumb
        * @param thumb : l'élément contenant l'image à afficher
        */

    function displayThumb(thumb){
        currentThumb = thumbs.indexOf(thumb)
        displayImage.src = getSrc(thumb)
    }

        /**
        * Fais passer l'affichage au thumb suivant dans thumbs
        */
    function displayNextThumb(){
        currentThumb = (currentThumb+1) % thumbs.length
        displayThumb(thumbs[currentThumb])
    }

    /**
     * Fais passer l'affichage au thumb précédent dans thumbs
     */

    function displayPreviousThumb(){
        if (currentThumb === 0){
            currentThumb = thumbs.length -1;
        }
        else{
            currentThumb = currentThumb -1;
        }
        displayThumb(thumbs[currentThumb])
    }


    //Fonction avec temps.

    function play(delay= 5000){
        // on lance le 1er sans attendre
        displayNextThumb()

        timer = window.setInterval(function (){
            displayNextThumb() }, delay)
    }

    function stop(){
        window.clearInterval(timer)
        timer = undefined
    }


    //Tant qu'on ne touche pas au caroussel, le site play tout seul.
    function togglePlay(){
        if(timer === undefined){ // il n'y a pas de timer actif
            play()
        }
        else{ // le timer existe : il faut l'arrêter
            stop()
        }
    }

    function m(currentThumb) {
        //Pas bien fait mais je vois pas d'autre moyen
        elem = nb_image[currentThumb];
        location.href="../pages/detail.php?id=" + elem  ;
    }


    //Main
    document.addEventListener("DOMContentLoaded", function (){

        createThumbs()

        displayImage = document.getElementById("display-image")
        if (displayImage != null){
            displayThumb(thumbs[0])
            togglePlay() //Tant qu'on ne touche pas au caroussel, le site play tout seul.

            gaucheIcon = document.getElementById("icone_gauche")
            droiteIcon = document.getElementById("icone_droite")

            displayImage.addEventListener('click', function(){
              m(currentThumb);
            })
            gaucheIcon.addEventListener('click', function (){
                displayPreviousThumb();
                stop();
            })
            droiteIcon.addEventListener('click', function(){
                displayNextThumb();
                stop();
            })
        }
    })

    // pour stopper le diaporama quand on change de fenêtre
    window.addEventListener('blur', function (){
        stop()
    })

</script>