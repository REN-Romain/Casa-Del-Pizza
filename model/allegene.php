<?php
require_once("objet.php");

class allergene extends objet {

    protected static string $classe = "allergene";
    protected static string $identifiant = "numAllergene";

    protected static $tableauSelect = array("allergene", "nomAllergene");

    protected int $numAllergene;
    protected string $nomAllergene;

    public function __construct(
        int $numAllergene = null,
        string $nomAllergene = null
    ) {
        if (!is_null($numAllergene)) {
            $this->numAllergene = $numAllergene;
            $this->nomAllergene = $nomAllergene;
        }
    }

    public function __toString(): string {
        $n = $this->nomAllergene;
        return "Allergene $n";
    }
}
?>
