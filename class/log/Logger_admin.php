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
                   name='name' ></br>
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
         <button id='0' class='login-btn mid'>0</button>
         <button id='back' class='login-btn'>";
        echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-backspace' viewBox='0 0 16 16'>
  <path d='M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z'/>
  <path d='M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z'/>
</svg>"; echo "</button>
         </div>
    </div>";
    }

    public function log(string $username) : array{
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