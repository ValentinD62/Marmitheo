<?php
namespace recherche;

class Recherche{
    function getRechercheRecette(): void{
        echo $_POST['recherche'];
    }
}