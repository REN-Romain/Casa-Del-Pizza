<?php
require_once("model/pizza.php");

class controllerPizza extends controllerObjet {
    
    protected static string $classe = "pizza";
    protected static string $identifiant = "numPizza";
    
    protected static $champs = array(
        "nomPizza"         => ["text", "Nom de la pizza"],
        "descriptionPizza" => ["textarea", "Description de la pizza"],
        "prixInitial"      => ["number", "Prix initial"]
    );
    

}
?>
