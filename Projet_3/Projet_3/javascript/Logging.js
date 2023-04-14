

let form = document.getElementById("formLog")
let erreur = document.getElementById("erreur")
// enregistrement dans le gestionnaire d'évènements 'submit'
form.addEventListener('submit', function (event){
    // on procède aux vérifications
    if(form.name.value == ""){
        erreur.innerHTML = "L'id est vide";
        event.preventDefault();
    }
    else if(form.pwd.value ==""){
        erreur.innerHTML = "Le mot de passe est vide"
    }
    else {
        if (form.name.value != "chef" || form.pwd.value != "matheo") {
            erreur.innerHTML = "L'id ou le mdp est erroné";
            event.preventDefault();
        }
    }
})


