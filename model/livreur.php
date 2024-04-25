<?php
require_once("objet.php");

class livreur extends objet {

    protected static string $classe = "livreur";
    protected static string $identifiant = "numLivreur";

    protected static $tableauSelect = array("livreur", "nomLivreur");

    protected int $numLivreur;
    protected string $nomLivreur;
    protected string $prenomLivreur;
    protected string $mailLivreur;
    protected string $telLivreur;
    protected string $mdpLivreur;
    protected int $statutLivreur;

    public function __construct(
        int $numLivreur = null,
        string $nomLivreur = null,
        string $prenomLivreur = null,
        string $mailLivreur = null,
        string $telLivreur = null,
        string $mdpLivreur = null,
        int $statutLivreur = null
    ) {
        if (!is_null($numLivreur)) {
            $this->numLivreur = $numLivreur;
            $this->nomLivreur = $nomLivreur;
            $this->prenomLivreur = $prenomLivreur;
            $this->mailLivreur = $mailLivreur;
            $this->telLivreur = $telLivreur;
            $this->mdpLivreur = $mdpLivreur;
            $this->statutLivreur = $statutLivreur;
        }
    }

    public function __toString(): string {
        $n = $this->nomLivreur;
        $p = $this->prenomLivreur;
        return "Livreur $n $p";
    }
}
?>
