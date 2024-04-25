<?php
require_once("model/ingredient.php");

class controllerIngredient extends controllerObjet {
    
    protected static string $classe = "ingredient";
    protected static string $identifiant = "numIngredient";
    
    protected static $champs = array(
        "nomIngredient"  => ["checkbox", "Nom de l'ingredient"],
    );
    

}
?>
