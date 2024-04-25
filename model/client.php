<?php
require_once("objet.php");

class client extends objet {

    protected static string $classe = "client";
    protected static string $identifiant = "numClient";

    protected static $tableauSelect = array("client", "nomClient");

    protected int $numClient;
    protected string $nomClient;
    protected string $prenomClient;
    protected string $mailClient;
    protected string $telClient;
    protected string $mdpClient;
    protected ?string $numRueAdresseClient;
    protected ?string $nomAdresseClient;
    protected ?string $villeAdresseClient;
    protected ?string $codePostalAdresseClient;
    protected ?string $infoComplementAdresseClient;

    public function __construct(
        int $numClient = null,
        string $nomClient = null,
        string $prenomClient = null,
        string $mailClient = null,
        string $telClient = null,
        string $mdpClient = null,
        string $numRueAdresseClient = null,
        string $nomAdresseClient = null,
        string $villeAdresseClient = null,
        string $codePostalAdresseClient = null,
        string $infoComplementAdresseClient = null
    ) {
        if (!is_null($numClient)) {
            $this->numClient = $numClient;
            $this->nomClient = $nomClient;
            $this->prenomClient = $prenomClient;
            $this->mailClient = $mailClient;
            $this->telClient = $telClient;
            $this->mdpClient = $mdpClient;
            $this->numRueAdresseClient = $numRueAdresseClient;
            $this->nomAdresseClient = $nomAdresseClient;
            $this->villeAdresseClient = $villeAdresseClient;
            $this->codePostalAdresseClient = $codePostalAdresseClient;
            $this->infoComplementAdresseClient = $infoComplementAdresseClient;
        }
    }

    public function __toString(): string {
        $n = $this->nomClient;
        $p = $this->prenomClient;
        return "Client#$this->numClient $n $p";
    }

    public static function checkMDP($l, $m) {
        // écriture de la requête
        $classePreparee="CLIENT";
        $requetePreparee = "SELECT * FROM CLIENT WHERE mailClient = :mailClient_tag AND mdpClient = :mdp_tag;";
        // envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->prepare($requetePreparee);
        // on crée le tableau contenant le tag et sa valeur
        $tags = array("mailClient_tag" => $l, "mdp_tag" => $m);
        try {
          // on exécute la requête préparée
          $resultat->execute($tags);
          // on interprète le résultat selon la classe récupérée
          $resultat->setFetchmode(PDO::FETCH_CLASS, $classePreparee);
          // on récupère le tableau
          $tableau = $resultat->fetchAll();
          // on retourne lefait que $tableau soit oui ou non de taille 1
          $size=sizeof($tableau);
          echo"$size";
          if($size == 1){
            return 1;
          }else {
            return 0;
          }
        } catch(PDOException $e) {
          echo $e->getMessage();
        }
        return false;
      }
}
?>
