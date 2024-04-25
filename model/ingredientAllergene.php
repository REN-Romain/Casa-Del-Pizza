<?php
require_once("objet.php");

class ingredientAllergene extends objet {

    protected static string $classe = "ingredientAllergene";
    protected static string $identifiant = "numIngredient";

    protected int $numIngredient;
    protected int $numAllergene;

    public function __construct(
        int $numIngredient = null,
        int $numAllergene = null
    ) {
        if (!is_null($numIngredient) && !is_null($numAllergene)) {
            $this->numIngredient = $numIngredient;
            $this->numAllergene = $numAllergene;
        }
    }

    public function __toString(): string {
        return "IngredientAllergene (Ingredient #$this->numIngredient, Allergene #$this->numAllergene)";
    }
}
?>
