<?php
require_once("objet.php");

class produit extends objet {

    protected static string $classe = "produit";
    protected static string $identifiant = "numProduit";

    protected static $tableauSelect = array("produit", "nomProduit");

    protected int $numProduit;
    protected string $nomProduit;
    protected float $prixUnitaire;
    protected int $quantiteStock;
    protected int $quantiteAlerte;
    protected int $numCategorie;

    public function __construct(
        int $numProduit = null,
        string $nomProduit = null,
        float $prixUnitaire = null,
        int $quantiteStock = null,
        int $quantiteAlerte = null,
        int $numCategorie = null
    ) {
        if (!is_null($numProduit)) {
            $this->numProduit = $numProduit;
            $this->nomProduit = $nomProduit;
            $this->prixUnitaire = $prixUnitaire;
            $this->quantiteStock = $quantiteStock;
            $this->quantiteAlerte = $quantiteAlerte;
            $this->numCategorie = $numCategorie;
        }
    }

    public function __toString(): string {
        $n = $this->nomProduit;
        return "Produit $n";
    }
}
?>
