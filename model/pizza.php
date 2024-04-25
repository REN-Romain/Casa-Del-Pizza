<?php
require_once("objet.php");

class pizza extends objet {

    protected static string $classe = "pizza";
    protected static string $identifiant = "numPizza";

    protected static $tableauSelect = array("pizza", "nomPizza");

    protected int $numPizza;
    protected string $nomPizza;
    protected ?string $descriptionPizza;
    protected bool $estDuMoment;
    protected float $prixInitial;

    public function __construct(
        int $numPizza = null,
        string $nomPizza = null,
        ?string $descriptionPizza = null,
        bool $estDuMoment = null,
        float $prixInitial = null
    ) {
        if (!is_null($numPizza)) {
            $this->numPizza = $numPizza;
            $this->nomPizza = $nomPizza;
            $this->descriptionPizza = $descriptionPizza;
            $this->estDuMoment = $estDuMoment;
            $this->prixInitial = $prixInitial;
        }
    }

    public function __toString(): string {
        $n = $this->nomPizza;
        return "Pizza $n";
    }
}
?>
