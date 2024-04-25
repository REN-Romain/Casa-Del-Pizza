<?php
require_once("objet.php");

class compositionPizza extends objet {

    protected static string $classe = "compositionPizza";
    protected static string $identifiant = "numPizza";

    protected int $numPizza;
    protected int $numIngredient;
    protected float $quantiteIngredient;

    public function __construct(
        int $numPizza = null,
        int $numIngredient = null,
        float $quantiteIngredient = null
    ) {
        if (!is_null($numPizza) && !is_null($numIngredient)) {
            $this->numPizza = $numPizza;
            $this->numIngredient = $numIngredient;
            $this->quantiteIngredient = $quantiteIngredient;
        }
    }

    public function __toString(): string {
        return "CompositionPizza (Pizza #$this->numPizza, Ingredient #$this->numIngredient)";
    }
}
?>


 