<?php
  // valeur par défaut de l'objet
  $objet = "pizza";
  // les objets possibles
  $objets = ["pizza","commande","produit"];

  $identifiant =NULL;
  $identifiants=["numPizza","numProduit"];

  // valeur par défaut de l'action
  $action = null;
  // les actions possibles
  $actions = ["displayCarte", "displayOne","customiser","ajouterAuPanier","viewPanier", "displayConnectionForm", "identifier","connexion","inscription","ajouterAuPanierCustom","deconnexion","moncompte","modifier","validerPaiement","supprimerDuPanier","modifierQuantite","appliquerPromo"];
  require_once("model/session.php");
 
  // test pour savoir si un objet correct est passé dans l'url
  if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)) {
    // si c'est le cas, récupération de l'objet passé dans l'url
    $objet = $_GET['objet'];
  }
  
   // test pour savoir si une action correcte est passée dans l'url
    if (isset($_GET["action"]) && in_array($_GET["action"], $actions)) {
      // si c'est le cas, récupération de l'action passés dans l'url
      $action = $_GET['action'];
      if ($action == "customiser" || $action == "ajouterAuPanier"){
        for ($i = 0; $i < sizeof($identifiants); $i++){
          if (isset($_GET[$identifiants[$i]])){
            $identifiant = $_GET[$identifiants[$i]];
          }
      }
    }
    
}


  // calcul du bon contrôleur
  $controller = "controller".ucfirst($objet);
  
  // insertion du contrôleur 
  require_once("controller/controllerObjet.php");
  require_once("controller/controllerObjet.php");
  //require_once("controller/$controller.php");
  require_once("controller/controllerClient.php");
  // appel de la méthode de connexion
  require_once("config/connexion.php");
  connexion::connect();
  $isLogged=session::clientConnected();
  //echo '<pre>';
 // print_r($isLogged." routeur ligne 50; action get: ".$action);
 // echo '</pre>';
    if ($action == null) {//Action de Base
      $isLogged=session::clientConnected();
      controllerObjet::displayIndex();
    } else if($action == "displayCarte"){ // Action afficher la carte
      
      require_once("controller/controllerPizza.php");
      require_once("controller/controllerProduit.php");
      $isLogged=session::clientConnected();
      controllerObjet::displayCarte();
    } else if($action == "identifier"){ // Action qui permet d'afficher la page d'identification
      controllerObjet::displayConnectionForm();
      $isLogged=session::clientConnected();
    }else if($action == "connexion"){ // Action qui gère la connexion
      require_once("controller/controllerClient.php");
      require_once("controller/controllerGestionnaire.php");
      $testGest = controllerGestionnaire::connect();
      if ($testGest == 0){
        controllerClient::connect();
      }
      $isLogged=session::clientConnected();  
    }else if($action == "inscription"){ // Action inscription, création de compte, puis connexion
        require_once("controller/controllerClient.php");
        controllerObjet::inscription();
        $isLogged=session::clientConnected();
    }else if($action == "deconnexion"){ // Action Deconnexion du compte
      require_once("controller/controllerClient.php");
      controllerClient::disconnect();
      $isLogged=session::clientConnected();
    }else if($action == "moncompte"){ // Action d'affichage du compte
      if (session::clientConnected()) {
        require_once("controller/controllerClient.php");
        controllerClient::displayCompte();
      }else{
        controllerObjet::displayConnectionForm();
      }
    }else if($action == "modifier"){ // Action modifier son compte
      require_once("controller/controllerClient.php");
      controllerClient::modifiercompte();
      $isLogged=session::clientConnected();
    }else if ($action == "customiser"){ // Action afficher l'ecran de personalisation
      if($objet=="pizza"){
        require_once("controller/$controller.php");
        $controller::showDetails();
      }
    }else if ($action == "viewPanier"){ // Action afficher le panier
      if (session::clientConnected()) {
          if($objet=="commande"){
          require_once("controller/$controller.php");
          $controller::showPanier();
        }
      }else{

        controllerObjet::displayConnectionForm();
      }
    } else if($action == "ajouterAuPanier"){ // Action  Ajouter au panier à partire de la carte
      $isLogged=session::clientConnected();
      if (session::clientConnected()) {
        if($objet=="pizza"){
          require_once("controller/controllerCommande.php");
          require_once("controller/controllerPizza.php");
          require_once("controller/controllerProduit.php");
          controllerObjet::addPizza($identifiant);        
        }else if($objet=="produit"){
          require_once("controller/controllerCommande.php");
          require_once("controller/controllerPizza.php");
          require_once("controller/controllerProduit.php");
          controllerObjet::addProduit($identifiant); 
        }else{
          controllerObjet::displayConnectionForm();
        }
      }else{
        controllerObjet::displayConnectionForm();
      }
    }else if($action == "ajouterAuPanierCustom"){ // Action  ajouter une pizza Special au panier
      $isLogged=session::clientConnected();
      if (session::clientConnected()) {
          require_once("controller/controllerCommande.php");
          require_once("controller/controllerPizza.php");
          
          controllerObjet::addPizzaSpe();
      }else{
        controllerObjet::displayConnectionForm();
      }
    }else if($action == "validerPaiement"){ // Action valider le panier
          require_once("controller/controllerCommande.php");
          require_once("controller/controllerPizza.php");
          $isLogged=session::clientConnected();
          controllerObjet::validerPaiement(); 
          
    }else if($action == "supprimerDuPanier"){ // Action  supprimer element du panier
      if($objet=="pizza"){
        require_once("controller/controllerCommande.php");
        require_once("controller/controllerPizza.php");
        $isLogged=session::clientConnected();
        controllerPizza::supprimerPizzDuPanier(); 
      }else if($objet=="produit"){
        require_once("controller/controllerCommande.php");
        require_once("controller/controllerProduit.php");
        $isLogged=session::clientConnected();
        controllerProduit::supprimerProdDuPanier(); 
      } 
    }else if($action == "modifierQuantite"){ // Action  modifier quantite dans panier
      if($objet=="pizza"){
        require_once("controller/controllerCommande.php");
        require_once("controller/controllerPizza.php");
        $isLogged=session::clientConnected();
        controllerPizza::modifierPizzQuantite(); 
      }else if($objet=="produit"){
        
        require_once("controller/controllerCommande.php");
        require_once("controller/controllerProduit.php");
        
        $isLogged=session::clientConnected();
        controllerProduit::modifierProdQuantite(); 
      }
    }else if($action == "appliquerPromo"){ // Action appliquer code Promo/verifreduc
      require_once("controller/controllerCommande.php");
      require_once("controller/controllerPizza.php");
      require_once("controller/controllerProduit.php");
      
      $isLogged=session::clientConnected();
      controllerCommande::appliquerPromo(); 
      
    }else{ // Action sinon
      $isLogged=session::clientConnected();
      controllerObjet::displayConnectionForm();
    }
 
?>