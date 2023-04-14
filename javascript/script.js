//Vu dans le tp 2 de javascript.
let images = []
images.push("../img/Chocolat_Matheo.jpg")
images.push("../img/pif.jpg")
images.push("../img/Super-Mario-Wallpapers-15.jpg")

let thumbs = []
let currentThumb = 0

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
    console.log(thumbs.length)
    console.log(currentThumb)
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


//Main
document.addEventListener("DOMContentLoaded", function (){

    createThumbs()

    displayImage = document.getElementById("display-image")
    if (displayImage != null){
        displayThumb(thumbs[0])
        togglePlay() //Tant qu'on ne touche pas au caroussel, le site play tout seul.

        gaucheIcon = document.getElementById("icone_gauche")
        droiteIcon = document.getElementById("icone_droite")

        gaucheIcon.addEventListener('click', function (event){
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