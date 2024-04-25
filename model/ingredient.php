<?php
require_once("objet.php");

class ingredient extends objet {

    protected static string $classe = "ingredient";
    protected static string $identifiant = "numIngredient";

    protected static $tableauSelect = array("ingredient", "nomIngredient");

    protected int $numIngredient;
    protected string $nomIngredient;
    protected string $uniteDeMesure;
    protected float $prixInitial;
    protected ?float $prixSupplement;
    protected ?float $quantiteSupplement;
    protected float $quantiteStock;
    protected ?float $quantiteAlerte;

    public function __construct(
        int $numIngredient = null,
        string $nomIngredient = null,
        string $uniteDeMesure = null,
        float $prixInitial = null,
        ?float $prixSupplement = null,
        ?float $quantiteSupplement = null,
        float $quantiteStock = null,
        ?float $quantiteAlerte = null
    ) {
        if (!is_null($numIngredient)) {
            $this->numIngredient = $numIngredient;
            $this->nomIngredient = $nomIngredient;
            $this->uniteDeMesure = $uniteDeMesure;
            $this->prixInitial = $prixInitial;
            $this->prixSupplement = $prixSupplement;
            $this->quantiteSupplement = $quantiteSupplement;
            $this->quantiteStock = $quantiteStock;
            $this->quantiteAlerte = $quantiteAlerte;
        }
    }

    public function __toString(): string {
        $n = $this->nomIngredient;
        return "Ingredient $n";
    }
}
?>

 