<?php
require_once("objet.php");

class Commande extends objet {

    protected static string $classe = "commande";
    protected static string $identifiant = "numCommande";

    protected int $numCommande;
    protected ?string $dateDebutCommande;
    protected ?string $dateFinCommande;
    protected ?int $numLivraison;
    protected int $numClient;
    protected int $numStatutCommande;
    protected ?int $numModePaiement;

    public function __construct(
        int $numCommande = null,
        ?string $dateDebutCommande = null,
        ?string $dateFinCommande = null,
        ?int $numLivraison = null,
        int $numClient = null,
        int $numStatutCommande = null,
        ?int $numModePaiement = null
    ) {
        if (!is_null($numCommande)) {
            $this->numCommande = $numCommande;
            $this->dateDebutCommande = $dateDebutCommande;
            $this->dateFinCommande = $dateFinCommande;
            $this->numLivraison = $numLivraison;
            $this->numClient = $numClient;
            $this->numStatutCommande = $numStatutCommande;
            $this->numModePaiement = $numModePaiement;
        }
    }

    public function __toString(): string {
        return "Commande #$this->numCommande";
    }
}
?>
