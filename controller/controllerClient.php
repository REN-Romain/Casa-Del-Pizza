<?php
require_once("model/client.php");

class controllerClient extends controllerObjet {
    
    protected static string $classe = "client";
    protected static string $identifiant = "numClient";
    
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
        require_once("model/client.php");

        $l = $_GET["mailClient"];
        $m = $_GET["mdpClient"];
        $b = client::checkMDP($l, $m);
        if ($b==1
        ) {
            $element = client::getClientEmail($l);
            if ($element==null) { 
                self::displayConnectionForm();
            }else {
                $_SESSION["numClient"] = $element;
                $isLogged=session::clientConnected();
                include(session::urlMenu());
                header('Location: /?');
            }
          
              
            //}else{
              //self::displayConnectionForm();
            //}
            
        } else {
            self::displayConnectionForm();
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
