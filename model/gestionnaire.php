<?php
require_once("objet.php");

class gestionnaire extends objet {

    protected static string $classe = "gestionnaire";
    protected static string $identifiant = "numGestionnaire";

    protected static $tableauSelect = array("gestionnaire", "nomGestionnaire");

    protected int $numGestionnaire;
    protected string $nomGestionnaire;
    protected string $prenomGestionnaire;
    protected string $mailGestionnaire;
    protected string $mdpGestionnaire;

    public function __construct(
        int $numGestionnaire = null,
        string $nomGestionnaire = null,
        string $prenomGestionnaire = null,
        string $mailGestionnaire = null,
        string $mdpGestionnaire = null
    ) {
        if (!is_null($numGestionnaire)) {
            $this->numGestionnaire = $numGestionnaire;
            $this->nomGestionnaire = $nomGestionnaire;
            $this->prenomGestionnaire = $prenomGestionnaire;
            $this->mailGestionnaire = $mailGestionnaire;
            $this->mdpGestionnaire = $mdpGestionnaire;
        }
    }

    public function __toString(): string {
        $n = $this->nomGestionnaire;
        $p = $this->prenomGestionnaire;
        return "Gestionnaire $n $p";
    }

    public static function checkMDP($l, $m) {
        // écriture de la requête
        $classePreparee="GESTIONNAIRE";
        $requetePreparee = "SELECT * FROM GESTIONNAIRE WHERE mailGestionnaire = :mailClient_tag AND mdpGestionnaire = :mdp_tag;";
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
