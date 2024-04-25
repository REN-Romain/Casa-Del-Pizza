<?php
require_once("model/commande.php");

class controllerCommande extends controllerObjet {
    
    protected static string $classe = "commande";
    protected static string $identifiant = "numCommande";
    
    protected static $champs = array(
        "dateDebutCommande" => ["datetime", "Date de début de commande"],
        "dateFinCommande"   => ["datetime", "Date de fin de commande"],
        "numLivraison"      => ["select", "Numéro de livraison"],
        "numClient"         => ["select", "Numéro de client"],
        "numStatutCommande" => ["select", "Numéro de statut de commande"],
        "numModePaiement"   => ["select", "Numéro de mode de paiement"]
    );
    
}
?>