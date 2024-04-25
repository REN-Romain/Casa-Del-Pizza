<?php
require_once("objet.php");

class statutPreparation  extends objet {

    protected static string $classe = "statutPreparation ";
    protected static string $identifiant = "numStatutPreparation";

    protected static $tableauSelect = array("statutPreparation ", "nomStatutPreparation");

    protected int $numStatutPreparation;
    protected string $nomStatutPreparation ;

    public function __construct(
        int $numStatutPreparation = null,
        string $nomStatutPreparation  = null
    ) {
        if (!is_null($numStatutPreparation)) {
            $this->numStatutPreparation = $numStatutPreparation;
            $this->nomStatutPreparation  = $nomStatutPreparation ;
        }
    }

    public function __toString(): string {
        $n = $this->nomStatutPreparation ;
        return "StatutPreparation  $n";
    }
}
?>
