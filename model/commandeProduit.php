<?php
require_once("objet.php");

class commandeProduit extends objet {

    protected static string $classe = "commandeProduit";
    protected static string $identifiant = "numCommande";

    protected int $numCommande;
    protected int $numProduit;
    protected int $quantiteProduit;

    public function __construct(
        int $numCommande = null,
        int $numProduit = null,
        int $quantiteProduit = null
    ) {
        if (!is_null($numCommande) && !is_null($numProduit)) {
            $this->numCommande = $numCommande;
            $this->numProduit = $numProduit;
            $this->quantiteProduit = $quantiteProduit;
        }
    }

    public function __toString(): string {
        return "CommandeProduit (Commande #$this->numCommande, Produit #$this->numProduit)";
    }
}
?>
