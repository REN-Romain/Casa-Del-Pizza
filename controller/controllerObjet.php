<?php
require_once("model/objet.php");
class controllerObjet {

    public static function displayIndex(){
        require_once("model/pizza.php");
        require_once("model/produit.php");
        $isLogged=session::clientConnected();
        $tabPizzDuMoment = objet::getPizzaDuMoment();
        $tabPizz = objet::getPizza();
        $tabBoissons = objet::getBoisson();
        $tabDessert = objet::getDessert();
        include("view/index.php");
    }
    public static function displayCarte() {
        require_once("model/pizza.php");
        require_once("model/produit.php");
        //afficher les pizzas à la une
        $tabPizzDuMoment = objet::getPizzaDuMoment();
        //afficher les pizzas
        $tabPizz = objet::getPizza();
        //afficher les boissons
        $tabBoissons = objet::getBoisson();
        //afficher les dessertes
        $tabDessert = objet::getDessert();
        $isLogged=session::clientConnected();
        include("view/carte.php");
    }

    public static function showDetails(){
        require_once("model/pizza.php");
        require_once("model/ingredient.php");
        require_once("model/allegene.php");
        require_once("model/taillePizza.php");
        
        $classe = static::$classe; //classe pizza.php
        $identifiant = static::$identifiant; //numPizza
        $id = $_GET[$identifiant]; //l'identifient de la pizza
        
        //les elements utilisables pour le front
        $tabIngredients; //tab d'element ingredient qui sont les ingredients de bases
        $tabSupplements; // Tab des supplément ajoutables
        $tabSuppPizz = []; // tab ingredient qui sont de base sur la pizza et qui peuvent être enlever
        $tabAllergenes ;// tab des allergenes qui sont présent sur la pizza de base sans changement(eventuellement un traitement lorsqu'on enleve un ingr)
        $tabTaillePrix=array();// Tab [(objet)Taille,prixInitial*majorationTaille]
        $listeAll=''; // une chaine de caractère pour afficher dirrecte la liste d'ingredient
        $listeIngr=''; // une chaine de caractère pour afficher directement la liste des allergènes
        $tabPizz ; // récupère la pizza

        $tabPizz = objet::getUnePizza($id);
        //recupère un tableau d'ingredients
        $tabIngredients=objet::getIngredientPizz($id);

        foreach ($tabIngredients as $ingredient) {
        // Concaténer le nom de l'ingrédient à la chaîne
            $listeIngr .= $ingredient->get("nomIngredient").', ';

        //récupérer, si l'ingrédient est catégorisé comme suplément
            if ($ingredient->get("prixSupplement") !== null) {
                // Ajouter l'ingrédient au tableau des supplements
                $tabSuppPizz[] = $ingredient;
            }
        }
        
        $tabSupplements=objet::getSupplement($id);

        //recupère les ingredients
        
        //recupère un tableau d'allergènes
        $tabAllergenes=objet::getAllergene($id);

        foreach ($tabAllergenes as $allergene) {
            // Concaténer le nom de l'ingrédient à la chaîne
            $listeAll .= $allergene->get("nomAllergene").', ';
        }

        // Supprimer la virgule et l'espace en trop à la fin des deux chaîne
        $listeAll = rtrim($listeAll, ', ');
        $listeIngr = rtrim($listeIngr, ', ');

        //récuperer un tableau de taille ->prixInitial*majorationTaille
        
        $tabTaillePrix=objet::getPrixTaillePizza($id);
        $isLogged=session::clientConnected();
        //include("view/customiserTest.php");
        include("view/customiser.php");
    }

    public static function showPanier(){
        require_once("model/client.php");
        require_once("model/commande.php");
        require_once("model/pizzaSpeciale.php");
        require_once("model/pizza.php");
        require_once("model/produit.php");
        require_once("model/objet.php");
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        
        $numClient=$_SESSION["numClient"];//récuperer le numClient
        $tabProduitCom; // Tab [(objet)Produit,quantite]
        $tabPizzaSpeCom; //Forme ['PizzaSpe'->unepizzaSpe, 'Pizza'->laPizzaDeBase,'ingredientBase'=>$tabIngredientBase,'ingredientIngr'=>$tabIngredientSpe,'prixUnitaire'->prix d'une pizzaSpecial]
        $client; // objet client

        //pour recuperer l'adresse
        $client =objet::getClient($numClient);        
        //Recuperer le numCommande qui n'a pas un statut terminée.
        $uneCommande=objet::getCommande($numClient);//on est censé pour les tests récupérer la commande 7
        $prixTotCommande=objet::getPrixCommande($uneCommande);
        
        $prixTotCommande=$prixTotCommande-($prixTotCommande*objet::getPourcentageReduction($uneCommande));
        $prixTotCommande = round($prixTotCommande, 2);
        $nomReduc=objet::getReducCommande($uneCommande,$numClient);
        //Get produits
        $tabProduitCom=objet::getProduitCom($uneCommande);

        //getPizzaCommande($numCommande) //Montrer si custom?
        $tabPizzaSpeCom=objet::getPizzaSpeCom($uneCommande);
        
        //regarder si connécté, si utilisateur sur place, ou si pas connécté, 
        /*echo '<pre>';
        print_r($tabProduitCom);
        echo '</pre>';
        echo '<pre>';
        print_r($tabPizzaSpeCom);
        echo '</pre>';
        echo $client;
        echo $prixTotCommande;*/
        $isLogged=session::clientConnected();
        include("view/panier.php");
        //include("view/panierTest.php");
    }

    

    public static function addProduit($id){
        require_once("model/session.php");
        require_once("model/commande.php");
        $idClient=$_SESSION["numClient"];
        $numCommande=objet::getCommande($idClient);//on est censé pour les tests récupérer la commande 7
        //echo "<p>$idClient</p> ";
        if ($numCommande == null){
            $numCommande=objet::CreateCommande();
        }
        //echo "<p>$numCommande</p>";
        $numProduit=$_GET["numProduit"];
        objet::addProduit($numCommande,$numProduit);
        $isLogged=session::clientConnected();
        self::displayCarte();
    }
  
    public static function addPizza($id){
        require_once("model/session.php");
        require_once("model/commande.php");
        $idClient=$_SESSION["numClient"];
        $numCommande=objet::getCommande($idClient);//on est censé pour les tests récupérer la commande 7
        //echo "<p>$idClient</p> ";
        if ($numCommande == null){
            $numCommande=objet::CreateCommande();
        }
        $numPizza=$_GET["numPizza"];
        objet::addPizz($numCommande,$numPizza);
        $isLogged=session::clientConnected();
        self::displayCarte();
    }

    

    public static function addPizzaSpe(){
        require_once("model/session.php");
        require_once("model/commande.php");
        require_once("model/compositionPizzaSpeciale.php");
        $idClient=$_SESSION["numClient"];
        
        $numPizza = $_GET['numPizza'];
        $numTaille = $_GET['numTaille'];
        $totalQuantity = $_GET['totalQuantity'];


        $ingredients = array();
        foreach ($_GET as $key => $value) {
            // Vérifie si le paramètre commence par "numIngredient-"
            if (strpos($key, 'numIngredient-') === 0) {
                // Extrait le numéro de l'ingrédient et la quantité
                $numIngredient = substr($key, strlen('numIngredient-'));
                $quantite = $value;
        
                // Ajoute les informations à l'array d'ingrédients
                $ingredients[] = array(
                    'numIngredient' => $numIngredient,
                    'quantite' => $quantite
                );
            }
        }


        $numCommande=objet::getCommande($idClient);//on est censé pour les tests récupérer la commande 7
        if ($numCommande == null){
            $numCommande=objet::CreateCommande();
        }

        $numPizzaSpe=objet::addPizzaspe($numCommande,$numPizza,$numTaille,$totalQuantity );
      //echo "Numéro de PizzaSpee: $numPizzaSpe<br>";
        foreach ($ingredients as $ingredient) {
            $numIngredient = $ingredient['numIngredient'];
            $quantite = $ingredient['quantite'];
            //echo "Numéro de PizzaSpee: $numPizzaSpe<br>";
            
            objet::addIngredientSpe($numIngredient, $numPizzaSpe, $quantite);
        }
        /*
        echo "Numéro de Commande: $numCommande<br>";
        echo "Numéro de Pizza: $numPizza<br>";
        echo "Numéro de Taille: $numTaille<br>";
        echo "Quantité Totale: $totalQuantity<br>";
        echo "Ingrédients:<pre>";
        print_r($ingredients);
        echo "</pre>";
        */
        $isLogged=session::clientConnected();
        self::displayCarte();
    }

    public static function validerPaiement(){
        require_once("model/session.php");
        require_once("model/client.php");
        require_once("model/commande.php");
        $idClient=$_SESSION["numClient"];
        $numCommande = $_GET['numCommande'];
        
        $numRueAdresseClient = $_GET['numRueAdresseClient'] ;
        $nomAdresseClient =  $_GET['nomAdresseClient'] ;
        $villeAdresseClient =  $_GET['villeAdresseClient'] ;
        $codePostalAdresseClient = $_GET['codePostalAdresseClient'];
        $infoComplementAdresseClient =  $_GET['infoComplementAdresseClient'] ;
        objet::updateAdresse($idClient,$numRueAdresseClient,$nomAdresseClient,$villeAdresseClient,$codePostalAdresseClient,$infoComplementAdresseClient);
        
        $chaineAleatoire="Z_B5";
        $numCarteBleu = $_GET['numCarteBleu']; 
        $cryptoCarteBleu = $_GET['cryptoCarteBleu'];    
        $dateMoisExpiration = $_GET['dateMoisExpiration'] ;
        $dateAnneeExpiration = $_GET['dateAnneeExpiration'] ;
        $cryptoCarteBleu = $_GET['cryptoCarteBleu'];
        $expiration= $dateMoisExpiration."/".$dateAnneeExpiration;

        $numCarteHache = hash('sha256', $chaineAleatoire . $numCarteBleu);
        $cryptoCarteHache = hash('sha256', $chaineAleatoire . $cryptoCarteBleu);
        $expirationHache = hash('sha256', $chaineAleatoire . $expiration);
        objet::addPaiement($idClient,$numCommande,$numCarteHache,$cryptoCarteHache,$expirationHache);

        //Update commande changer le statut
        
        $nomReduction = $_GET['nomReduction'];
        //faire update de la réduc si elle est active
        objet::updateReduc($idClient,$numCommande,$nomReduction);
        objet::commandePaie($idClient,$numCommande);
        self::displayCompte();
        

    }

    
    public static function appliquerPromo(){
        require_once("model/session.php");
        require_once("model/commande.php");
        $numCommande = $_GET['numCommande'] ;
        if( $_GET['nomReduction']!=="" ){
            
            $nomReduction =$_GET['nomReduction'] ;
            echo"$nomReduction";
            objet::updatePromo($nomReduction,$numCommande);
            self::showPanier();
        }else{
            $nomReduction=NULL;
            objet::updatePromo($nomReduction,$numCommande);
            self::showPanier();
        }

    }

    public static function supprimerPizzDuPanier(){
        $numPizzaSpaciale =  $_GET['numPizzaSpaciale'] ;
        $numCommande = $_GET['numCommande'];
        objet::supprimerPizzDuPanier($numPizzaSpaciale,$numCommande);
        self::showPanier();
    }

    public static function supprimerProdDuPanier(){
        $numProduit = $_GET['numProduit'];
        $numCommande =  $_GET['numCommande'];
        objet::supprimerProdDuPanier($numProduit,$numCommande);
        self::showPanier();
    }


    public static function modifierPizzQuantite(){
        $numPizzaSpeciale = $_GET['numPizzaSpeciale'];
        $numCommande =  $_GET['numCommande'];
        $quantite =  $_GET['quantite'];
        if($quantite==0){
            objet::supprimerPizzDuPanier($numPizzaSpeciale,$numCommande);
            self::showPanier();
        }else{
            objet::modifierPizzQuantite($numPizzaSpeciale,$numCommande,$quantite);
            self::showPanier();
        }
        
    }
    public static function modifierProdQuantite(){
        $numProduit = $_GET['numProduit'];
        $numCommande =  $_GET['numCommande'];
        $quantite =  $_GET['quantite'];
        if($quantite==0){
            objet::supprimerProdDuPanier($numProduit,$numCommande);
        }else{
            objet::modifierProdQuantite($numProduit,$numCommande,$quantite);
        }
        
        self::showPanier();
    }





    public static function displayConnectionForm() {
        include("view/login.php");
    }

    public static function inscription(){
       $nom = $_GET["nomClient"];
        $prenom = $_GET["prenomClient"];
        $tel = $_GET["telClient"];
        $mail = $_GET["mailClient"];
        $mdp = $_GET["mdpClient"];
        require_once("model/client.php");
        require_once("controllerClient.php");
        $idClient=client::create($nom,$prenom,$tel,$mail,$mdp );
        controllerClient::firstConnect($idClient);
        $isLogged=session::clientConnected();
    }
    public static function modifiercompte(){
        require_once("model/client.php");
        require_once("controllerClient.php");
        $nomClient = $_GET['nomClient'];
        $prenomClient = $_GET['prenomClient'];
        $telClient =$_GET['telClient'];
        $mailClient = $_GET['mailClient'] ;
        //$mdp = $_GET['mdpClient'] ;
        client::modifiercompte($nomClient,$prenomClient,$telClient,$mailClient/*,$mdp*/ );
        $isLogged=session::clientConnected();
        self::displayCompte();
    }

    public static function displayCompte(){
        require_once("model/session.php");
        require_once("model/commande.php");
        require_once("model/client.php");
        $idClient=$_SESSION["numClient"];
        $promo;
        $commandes; // sous formes ('commande'=>uneCommande,'prixCommande'liste d'objet commande, champs utilisables
        $promo = objet::getReduction();
        $client =objet::getClient($idClient); 
        //récupèrer le tableau CommandesduCLient, avec la date, le prix réduit si oui, et l'etat
        $commandes=objet::getCommandePrixDateStatut();
       /* echo '<pre>';
        print_r($commandes);
        echo '</pre>';
        echo '<pre>';
        print_r($promo);
        echo '</pre>';
        echo '<pre>';
        print_r($client);
        echo '</pre>';
        */
        $isLogged=session::clientConnected();
        //

        include("view/mon-compte.php");
    }


    public static function connect(){}

    public static function disconnect(){ session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-1);
        include("view/login.php");
    }


    
    public static function displayAll() {
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "les {$classe}s";
        $tableau = $classe::getAll();
        include("view/.php");
        include("view/menu.html");
        include("view/list.php");
        include("view/fin.php");
    }

    public static function displayOne() {
        $classe = static::$classe;
        $title = "un(e) {$classe}";
        $identifiant = static::$identifiant;
        $id = $_GET[$identifiant];
        $element = $classe::getOne($id);
        include("view/debut.php");
        include("view/menu.html");
        include("view/details.php");
        include("view/fin.php");
    }

    public static function delete() {
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $title = "supprimer un(e) {$classe}";
        $id = $_GET[$identifiant];
        $classe::delete($id);
        self::displayAll();
    }

    public static function create() {
        $classe = static::$classe;
        $donnees = array();
        foreach($_GET as $cle => $valeur)
            if ($cle != "objet" && $cle != "action")
                $donnees[$cle] = $valeur;
        $classe::create($donnees);
        self::displayAll();
    }

    public static function createPizza() {
        $classe = static::$classe;
        $donnees = array();
        foreach($_GET as $cle => $valeur)
            if ($cle != "objet" && $cle != "action")
                $donnees[$cle] = $valeur;
        $classe::createPizza($donnees);
    }
    
    public static function gestionDisplayVente(){
        $VenteMensuel = objet::getVenteMois(0);
        $VenteMensuelDernier = objet::getVenteMois(1);
        $VenteSemaine = objet::getVenteSemaine(0);
        $VenteSemaineDerniere = objet::getVenteSemaine(1);
        $venteJour = objet::getVenteJour(0);
        $venteJourDernier = objet::getVenteJour(1);
        include("gestionnaire/pages/gestionFinance.php");
    }

    public static function gestionDisplayPizza(){
        $tableauPizza = objet::getPizzaGestionnaire();
        include("gestionnaire/pages/gestionPizza.php");  
    }

    public static function gestionDisplayStock(){
        $tableauStock = objet::getStockGestionnaire();
        include("gestionnaire/pages/gestionStock.php");
    }

    public static function gestionPizzaAjouter(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $champs = static::$champs;
        include("gestionnaire/pages/gestionCreationPizza.php");
    }


    public static function gestionPizzaSupprimer(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $classe::deletePizza($_GET["numPizza"]);
    }

    public static function gestionPizzaModifier(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $champs = static::$champs;
        $id = $_GET["numPizza"];
        $pizza = $classe::getOnePizzaGestionnaire($id);
        include("gestionnaire/pages/gestionModificationPizza.php");
    }

    public static function modifier(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $donnees = array();
        foreach($_GET as $cle => $valeur){
            $cle = str_replace(["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"], "", $cle);
            if ($cle == "numPizza"){
                $id = $valeur;
            }
            else if ($cle != "objet" && $cle != "action" && $cle != "quantite" && $cle != "page"){
                $donnees[$cle] = $valeur;
            }
        }
        $classe::modifierPizza($donnees, $id);
    }

    public static function setPizzaDuMoment(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $classe::setPizzaDuMoment($_GET["numPizza"]);
    }         
    
    public static function gestionDisplayIngredient(){
        $id = $_GET["numPizza"];
        $tableau = objet::getIngredientPizza();
        $tableauCP = objet::getCompoPizza($id);
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $champs = static::$champs;
        include("gestionnaire/pages/gestionAjoutIngredient.php");
    }

    public static function modifierCompoPizza(){
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $donnees = array();
        $i = 1;
        $idPizza = $_GET['numPizza'];
        foreach($_GET as $cle => $valeur){
            if ($cle == 'quantite'.$i){
                if ($valeur == 0){
                    objet::deleteCompoPizza($idPizza, $i);
                }
                else{
                    $quantiteGramme = $valeur/1000;
                    objet::addCompoPizza($idPizza, $i, $quantiteGramme);
                }
                $i += 1;
            }   
        }
    }

    public static function displayAllergene(){
        $id = $_GET["numPizza"];
        $tableau = objet::displayAllergene($id);
        include("gestionnaire/pages/gestionAllergene.php");
    }

    public static function modifierStock(){
        $donnees = array();
        $i = 1;
        foreach($_GET as $cle => $valeur){
            if ($i < 18){
                objet::modifyStock($i, $_GET['quantiteStock'.$i], $_GET['quantiteAlerte'.$i]);
            }
            else {
                return null;
            }
            $i +=1;
        }
    }

    public static function displayAlerte(){
        $tableau = objet::getAlerte();
        include("gestionnaire/pages/gestionAlerte.php");
    }

}
?>
