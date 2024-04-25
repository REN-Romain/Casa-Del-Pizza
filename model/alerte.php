<?php
require_once("objet.php");

class alerte extends objet {

    protected static string $classe = "alerte";
    protected static string $identifiant = "numAlerte";

    protected int $numAlerte;
    protected string $dateAlerte;
    protected ?int $numIngredient;
    protected float $quantiteStock;
    protected ?int $numProduit;

    public function __construct(
        int $numAlerte = null,
        string $dateAlerte = null,
        ?int $numIngredient = null,
        float $quantiteStock = null,
        ?int $numProduit = null
    ) {
        if (!is_null($numAlerte)) {
            $this->numAlerte = $numAlerte;
            $this->dateAlerte = $dateAlerte;
            $this->numIngredient = $numIngredient;
            $this->quantiteStock = $quantiteStock;
            $this->numProduit = $numProduit;
        }
    }

    public function __toString(): string {
        $date = $this->dateAlerte;
        return "Alerte du $date";
    }
}
?>
