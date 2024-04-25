<?php
require_once("objet.php");

class StatutLivreur extends objet {

    protected static string $classe = "StatutLivreur";
    protected static string $identifiant = "numStatutLivreur";

    protected static $tableauSelect = array("StatutLivreur", "nomStatutLivreur");

    protected int $numStatutLivreur;
    protected string $nomStatutLivreur;

    public function __construct(
        int $numStatutLivreur = null,
        string $nomStatutLivreur = null
    ) {
        if (!is_null($numStatutLivreur)) {
            $this->numStatutLivreur = $numStatutLivreur;
            $this->nomStatutLivreur = $nomStatutLivreur;
        }
    }

    public function __toString(): string {
        $n = $this->nomStatutLivreur;
        return "StatutLivreur $n";
    }
}
?>
