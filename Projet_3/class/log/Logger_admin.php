<?php

namespace log;

class Logger_admin{

    //Classe venant du tp2.

    public function generateLoginForm(string $action, string $erreur): void{ // $action est le nom de la page sur lequel la fonction doit agir.
        echo "<div id = 'login-form'>
        <div id = 'text-login'>Connexion pour mode admin </div></br>
         <div class ='error'> $erreur </div>
        <form method='post'
              action = $action 
              css= 'width: 30%; margin: 10px'>
            <input type='text' class='form-control' id='username' placeholder='username'
                   name='name'></br>
            <input type='password' class='form-control' id='password' placeholder='password'
                   name='pwd'></br>
            <button type='submit' class='btn' css='margin-top: 10px ; width: 100%'>
            Login
            </button>
        </form>
    </div>";
    }

    public function log(string $username, string $password) : array{
        $array = array(
            "granted" => false,
            "nick" => null,
            "error" => null
        );
        if (empty($username)){
            $array["error"] = "username is empty";
        }
        else{
            if (empty($password)){
                $array["error"] = "password is empty";
            }
            else{
                if ($password == "matheo" && $username == "chef"){
                    $array["granted"] = true;
                    $array["nick"] = "CHEF";
                }
                else{
                    $array["error"] = "authentification failed";
                }
            }
        }
        return $array;
    }

}