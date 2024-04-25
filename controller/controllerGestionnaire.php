<?php
require_once("model/gestionnaire.php");

class controllerGestionnaire extends controllerObjet {
    
    protected static string $classe = "client";
    protected static string $identifiant = "numGestionnaire";
    
    protected static $champs = array(
        "nomClient"             => ["text", "Nom du client"],
        "prenomClient"          => ["text", "Prénom du client"],
        "mailClient"            => ["email", "Adresse email"],
        "telClient"             => ["tel", "Numéro de téléphone"],
        "mdpClient"             => ["password", "Mot de passe"],
        "numRueAdresseClient"   => ["text", "Numéro de rue"],
        "nomAdresseClient"      => ["text", "Nom de la rue"],
        "villeAdresseClient"    => ["text", "Ville"],
        "codePostalAdresseClient"=> ["text", "Code postal"],
        "infoComplementAdresseClient" => ["textarea", "Informations complémentaires"]
    );

    public static function displayConnectionForm() {
        include("view/login.php");
    }

    public static function connect(){
        require_once("model/gestionnaire.php");

        $l = $_GET["mailClient"];
        $m = $_GET["mdpClient"];
        $b = gestionnaire::checkMDP($l, $m);
        if ($b==1
        ) {
            $element = gestionnaire::getGestionnaireEmail($l);
            if ($element==null) { 
                return 0;
            }else {
                $_SESSION["numClient"] = $element;
                $isLogged=session::clientConnected();
                header('Location: gestionnaire.php');
                return 1;
            }
        }
    }
    public static function disconnect(){
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-1);
        self::displayConnectionForm();
    }
    public static function firstConnect($l){
        require_once("model/client.php");
            $_SESSION["numClient"] = $l;
            $element = client::getClientEmail($l);
            $isLogged=session::clientConnected();
            include(session::urlMenu());
            self::displayConnectionForm();


    }

}
?>
