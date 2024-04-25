<?php
require_once("objet.php");

class livraison extends objet {

    protected static string $classe = "livraison";
    protected static string $identifiant = "numLivraison";

    protected int $numLivraison;
    protected string $dateDebutLivraison;
    protected string $dateFinLivraison;
    protected int $numLivreur;

    public function __construct(
        int $numLivraison = null,
        string $dateDebutLivraison = null,
        string $dateFinLivraison = null,
        int $numLivreur = null
    ) {
        if (!is_null($numLivraison)) {
            $this->numLivraison = $numLivraison;
            $this->dateDebutLivraison = $dateDebutLivraison;
            $this->dateFinLivraison = $dateFinLivraison;
            $this->numLivreur = $numLivreur;
        }
    }

    public function __toString(): string {
        return "Livraison #" . $this->numLivraison;
    }
}
?>
