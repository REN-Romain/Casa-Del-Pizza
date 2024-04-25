<?php
require_once("objet.php");

class modePaiement extends objet {

    protected static string $classe = "modePaiement";
    protected static string $identifiant = "numModePaiement";

    protected static $tableauSelect = array("modePaiement", "nomModePaiement");

    protected int $numModePaiement;
    protected string $nomModePaiement;

    public function __construct(
        int $numModePaiement = null,
        string $nomModePaiement = null
    ) {
        if (!is_null($numModePaiement)) {
            $this->numModePaiement = $numModePaiement;
            $this->nomModePaiement = $nomModePaiement;
        }
    }

    public function __toString(): string {
        $n = $this->nomModePaiement;
        return "ModePaiement $n";
    }
}
?>
