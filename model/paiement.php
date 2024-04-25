<?php
require_once("objet.php");

class paiement extends objet {

    protected static string $classe = "paiement";
    protected static string $identifiant = "numPaiement";

    protected int $numPaiement;
    protected int $numClient;
    protected int $numCommande;
    protected string $numCarteBleu;
    protected string $cryptoCarteBleu;
    protected string $dateExpiration;
    protected string $datePaiement;

    public function __construct(
        int $numPaiement = null,
        int $numClient = null,
        int $numCommande = null,
        string $numCarteBleu = null,
        string $cryptoCarteBleu = null,
        string $dateExpiration = null,
        string $datePaiement = null
    ) {
        if (!is_null($numPaiement)) {
            $this->numPaiement = $numPaiement;
            $this->numClient = $numClient;
            $this->numCommande = $numCommande;
            $this->numCarteBleu = $numCarteBleu;
            $this->cryptoCarteBleu = $cryptoCarteBleu;
            $this->dateExpiration = $dateExpiration;
            $this->datePaiement = $datePaiement;
        }
    }

    public function __toString(): string {
        return "Paiement #$this->numPaiement";
    }
}
?>
