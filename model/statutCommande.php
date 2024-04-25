<?php
require_once("objet.php");

class statutCommande extends objet {

    protected static string $classe = "statutCommande";
    protected static string $identifiant = "numStatutCommande";

    protected static $tableauSelect = array("statutCommande", "nomStatutCommande");

    protected int $numStatutCommande;
    protected string $nomStatutCommande;

    public function __construct(
        int $numStatutCommande = null,
        string $nomStatutCommande = null
    ) {
        if (!is_null($numStatutCommande)) {
            $this->numStatutCommande = $numStatutCommande;
            $this->nomStatutCommande = $nomStatutCommande;
        }
    }

    public function __toString(): string {
        $n = $this->nomStatutCommande;
        return "StatutCommande $n";
    }
}
?>
