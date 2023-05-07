<?php

namespace log;

class Logger_admin{

    //Classe venant du tp2.

    public function generateLoginForm(string $action, string $erreur): void{ // $action est le nom de la page sur lequel la fonction doit agir.
        echo "
            <script defer src='../javascript/Logging.js'></script>

<div id = 'login-form'>
        <div id = 'text-login'>Connexion pour mode admin </div></br>
         <div class ='error' id='erreur'> $erreur </div>

        <form method='post'
              action = $action
              id='formLog'
              css= 'width: 30%; margin: 10px'>
            <input type='number' class='form-control1' id='username' placeholder='password'
                   name='name'></br>
            <button type='submit' id='submit' class='bt1' css='margin-top: 10px ; width: 100%'>
            Enter
            </button>
    </form>
        
        <div id='button-login'>
         <button id='1' class='login-btn'>1</button>
         <button id='2' class='login-btn'>2</button>
         <button id='3' class='login-btn'>3</button>
         <button id='4' class='login-btn'>4</button>
         <button id='5' class='login-btn'>5</button>
         <button id='6' class='login-btn'>6</button>
         <button id='7' class='login-btn'>7</button>
         <button id='8' class='login-btn'>8</button>
         <button id='9' class='login-btn'>9</button>
         <button id='0' class='login-btn'>0</button>
         <button id='0' class='login-btn'>0</button>
         </div>
    </div>";
    }

    public function log(string $username) : array{ //Fonction qui vérifie le bon mot de passe pour pouvoir transmettre les informations.
        $array = array(
            "granted" => false,
            "nick" => null,
            "error" => null
        );
        if (empty($username)){
            $array["error"] = "password  is empty";
        }
        else{

            if ($username == 1234){
                $array["granted"] = true;
                $array["nick"] = "CHEF";
            }
            else{
                $array["error"] = "authentification failed";}
        }

        return $array;
    }

}