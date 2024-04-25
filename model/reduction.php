<?php
require_once("objet.php");

class reduction extends objet {

    protected static string $classe = "reduction";
    protected static string $identifiant = "numReduction";

    protected static $tableauSelect = array("reduction", "nomReduction");

    protected int $numReduction;
    protected string $nomReduction;
    protected float $pourcentageReduction;
    protected bool $estUtilisee;
    protected ?string $dateFin;
    protected ?int $numCommandeSource;
    protected ?int $numCommandeReduite;
    protected int $numClient;

    public function __construct(
        int $numReduction = null,
        string $nomReduction = null,
        float $pourcentageReduction = null,
        bool $estUtilisee = null,
        ?string $dateFin = null,
        ?int $numCommandeSource = null,
        ?int $numCommandeReduite = null,
        int $numClient = null
    ) {
        if (!is_null($numReduction)) {
            $this->numReduction = $numReduction;
            $this->nomReduction = $nomReduction;
            $this->pourcentageReduction = $pourcentageReduction;
            $this->estUtilisee = $estUtilisee;
            $this->dateFin = $dateFin;
            $this->numCommandeSource = $numCommandeSource;
            $this->numCommandeReduite = $numCommandeReduite;
            $this->numClient = $numClient;
        }
    }

    public function __toString(): string {
        return "Reduction #$this->numReduction";
    }
}
?>
