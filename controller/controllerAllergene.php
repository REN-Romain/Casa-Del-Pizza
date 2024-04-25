<?php
require_once("model/allegene.php");

class controllerAllergene extends controllerObjet {
    
    protected static string $classe = "allergene";
    protected static string $identifiant = "numAllergene";
    
    protected static $champs = array(
        "nomAllergene"  => ["checkbox", "Nom de l'allergene"],
    );
    

}
?>
