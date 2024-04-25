<?php
require_once("objet.php");

class selection extends objet {

    protected static string $classe = "selection";
    protected static string $identifiant = "numPizzaSpeciale";

    protected int $numPizzaSpeciale;
    protected int $numCommande;
    protected int $quantitePizzaSpe;

    public function __construct(
        int $numPizzaSpeciale = null,
        int $numCommande = null,
        int $quantitePizzaSpe = null
    ) {
        if (!is_null($numPizzaSpeciale) && !is_null($numCommande)) {
            $this->numPizzaSpeciale = $numPizzaSpeciale;
            $this->numCommande = $numCommande;
            $this->quantitePizzaSpe = $quantitePizzaSpe;
        }
    }

    public function __toString(): string {
        return "Selection (PizzaSpecial #$this->numPizzaSpeciale, Commande #$this->numCommande)";
    }
}
?>
