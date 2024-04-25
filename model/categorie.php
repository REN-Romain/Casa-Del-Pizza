<?php
require_once("objet.php");

class categorie extends objet {

    protected static string $classe = "categorie";
    protected static string $identifiant = "numCategorie";

    protected static $tableauSelect = array("categorie", "nomCategorie");

    protected int $numCategorie;
    protected string $nomCategorie;

    public function __construct(
        int $numCategorie = null,
        string $nomCategorie = null
    ) {
        if (!is_null($numCategorie)) {
            $this->numCategorie = $numCategorie;
            $this->nomCategorie = $nomCategorie;
        }
    }

    public function __toString(): string {
        $n = $this->nomCategorie;
        return "Categorie $n";
    }
}
?>
