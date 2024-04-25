<?php
require_once("objet.php");

class PizzaSpeciale extends objet {

    protected static string $classe = "PizzaSpeciale";
    protected static string $identifiant = "numPizzaSpeciale";

    protected int $numPizzaSpeciale;
    protected int $numPizza;
    protected int $numTaille;
    protected int $numStatutPizzaSpeciale;

    public function __construct(
        int $numPizzaSpeciale = null,
        int $numPizza = null,
        int $numTaille = null,
        int $numStatutPizzaSpeciale = null
    ) {
        if (!is_null($numPizzaSpeciale)) {
            $this->numPizzaSpeciale = $numPizzaSpeciale;
            $this->numPizza = $numPizza;
            $this->numTaille = $numTaille;
            $this->numStatutPizzaSpeciale = $numStatutPizzaSpeciale;
        }
    }

    public function __toString(): string {
        return "PizzaSpeciale #$this->numPizzaSpeciale";
    }
}
?>
