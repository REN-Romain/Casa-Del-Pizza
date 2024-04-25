<?php
require_once("objet.php");

class taillePizza extends objet {

    protected static string $classe = "taillePizza";
    protected static string $identifiant = "numTaille";

    protected static $tableauSelect = array("taillePizza", "nomTaille");

    protected int $numTaille;
    protected string $nomTaille;
    protected float $majorationTaille;

    public function __construct(
        int $numTaille = null,
        string $nomTaille = null,
        float $majorationTaille = null
    ) {
        if (!is_null($numTaille)) {
            $this->numTaille = $numTaille;
            $this->nomTaille = $nomTaille;
            $this->majorationTaille = $majorationTaille;
        }
    }

    public function __toString(): string {
        $n = $this->nomTaille;
        return "TaillePizza $n";
    }
}
?>
