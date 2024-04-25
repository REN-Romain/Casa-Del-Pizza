<?php
require_once("model/produit.php");
require_once("model/categorie.php");

class controllerProduit extends controllerObjet {
    
    protected static string $classe = "produit";
    protected static string $identifiant = "numProduit";
    
    public static function displayCreationForm() {
        $title = "Création de produit";
        $selectCategorie = categorie::getSelect();
        include("view/debut.php");
        include("view/menu.html");
        include("view/produit/formulaireCreation.php");
        include("view/fin.php");
    }

}
?>
