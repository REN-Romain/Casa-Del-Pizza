<?php
class session {
    
    public static function clientConnected() {
       // $bool=isset($_SESSION['numClient']);
        //echo"$bool";
        return isset($_SESSION["numClient"]);
    }

    public static function clientConnecting() {
        return isset($_GET["action"]) && $_GET["action"] == "connexion";
    }

    public static function urlMenu() {
        $isLogged=self::clientConnected();
        header('Location: ?');

    }

}

?>