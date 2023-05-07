

let form = document.getElementById("formLog")
let erreur = document.getElementById("erreur")
let usernam = document.getElementById("username")
// enregistrement dans le gestionnaire d'évènements 'submit'

function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}







form.addEventListener('submit', function (event){
    // on procède aux vérifications
    if(form.name.value == ""){
        erreur.innerHTML = "Le mot de passe est vide";
        event.preventDefault();
    }
    else {
        if (form.name.value != 1234 ) {
            erreur.innerHTML = "Le mot de passe est erroné";
            usernam.style.borderColor = "red";
            usernam.value = ""
            event.preventDefault();
        }
    }
})

function func(){

    var r = document.getElementById('username');
    if(this.id == "back"){
        r.value = r.value.substr(0,r.value.length-1)
    }
    else {
        r.value = r.value + this.id;
    }
}



let allButton = document.getElementsByClassName('login-btn');


for (var i = 0;i<allButton.length;i++){
    allButton[i].addEventListener('click',func);
}


