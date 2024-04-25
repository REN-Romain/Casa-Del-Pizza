<?php
require_once("objet.php");

class compositionPizzaSpeciale extends objet {

    protected static string $classe = "compositionPizzaSpeciale";
    protected static string $identifiant = "numPizzaSpeciale";

    protected int $numPizzaSpeciale;
    protected int $numIngredient;
    protected float $quantite;

    public function __construct(
        int $numPizzaSpeciale = null,
        int $numIngredient = null,
        float $quantite = null
    ) {
        if (!is_null($numPizzaSpeciale) && !is_null($numIngredient)) {
            $this->numPizzaSpeciale = $numPizzaSpeciale;
            $this->numIngredient = $numIngredient;
            $this->quantite = $quantite;
        }
    }

    public function __toString(): string {
        return "CompositionPizzaSpeciale (PizzaSpeciale #$this->numPizzaSpecial, Ingredient #$this->numIngredient)";
    }
}
?>
