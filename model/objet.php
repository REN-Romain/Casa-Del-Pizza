<?php
class objet {

    public function get($attribut){
        return $this ->$attribut;
    }
    public function set($attribut,$valeur) : void{
        $this->$attribut=$valeur;
    }

    public static function getAll(){
        $classeRecuperee = static::$classe;
        $requete = "SELECT * FROM $classeRecuperee;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }

    public static function getPizzaDuMoment(){
        $classeRecuperee = "PIZZA";
        $requete = "SELECT * FROM $classeRecuperee WHERE estDuMoment is TRUE;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    public static function getPizza(){
        $classeRecuperee = "PIZZA";
        $requete = "SELECT * FROM $classeRecuperee WHERE estDuMoment is FALSE;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }


    public static function getBoisson(){
        $classeRecuperee = "PRODUIT";
        $requete = "SELECT * FROM $classeRecuperee WHERE numCategorie='1';";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    public static function getDessert(){
        $classeRecuperee = "PRODUIT";
        $requete = "SELECT * FROM $classeRecuperee WHERE numCategorie='2';";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    
    public static function getIngredientPizz($id){
        //récupère et crée les ingredient de la pizza n°$id
        $classeRecuperee="INGREDIENT";
        $requete1="SELECT INGREDIENT.* FROM INGREDIENT ";
        $requete1=$requete1." INNER JOIN COMPOSITIONPIZZA ON COMPOSITIONPIZZA.numIngredient = INGREDIENT.numIngredient ";
        $requete1=$requete1." WHERE COMPOSITIONPIZZA.numPizza = :id_tag;";
        $resultat1 = connexion::pdo()->prepare($requete1);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tableau = $resultat1->fetchAll(PDO::FETCH_CLASS, $classeRecuperee);
        return $tableau;
    }


    public static function getSupplement($id){
        $classeRecuperee="INGREDIENT";
        $requete1 = "SELECT * FROM INGREDIENT WHERE prixSupplement IS NOT NULL ";
        $requete1 = $requete1." AND INGREDIENT.numIngredient NOT IN (SELECT COMPOSITIONPIZZA.numIngredient FROM COMPOSITIONPIZZA WHERE COMPOSITIONPIZZA.numPizza=:id_tag);";
        $resultat1 = connexion::pdo()->prepare($requete1);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tableau = $resultat1->fetchAll(PDO::FETCH_CLASS, $classeRecuperee);
        return $tableau;
    }
    
    public static function getAllergene($id){
        //récupère et crée les ingredient de la pizza n°$id
        $classeRecuperee="ALLERGENE";
        $requete1="SELECT DISTINCT(ALLERGENE.numAllergene), ALLERGENE.nomAllergene FROM ALLERGENE  ";
        $requete1=$requete1." INNER JOIN INGREDIENTALLERGENE ON INGREDIENTALLERGENE.numAllergene =ALLERGENE.numAllergene ";
        $requete1=$requete1." INNER JOIN INGREDIENT ON INGREDIENT.numIngredient =INGREDIENTALLERGENE.numIngredient ";
        $requete1=$requete1." INNER JOIN COMPOSITIONPIZZA ON COMPOSITIONPIZZA.numIngredient = INGREDIENT.numIngredient ";
        $requete1=$requete1." WHERE COMPOSITIONPIZZA.numPizza = :id_tag;";
        $resultat1 = connexion::pdo()->prepare($requete1);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tableau = $resultat1->fetchAll(PDO::FETCH_CLASS, $classeRecuperee);
        return $tableau;
    }

    public static function getPrixTaillePizza($id){

        $tabTaillesPrix=array();

      // recuperer le prix initial
        $req2="SELECT prixInitial FROM PIZZA WHERE numPizza = :id_tag;"; 
        $res2 = connexion::pdo()->prepare($req2);
        $res2->bindParam(':id_tag', $id);
        $res2->execute();
        $prixInitial = $res2->fetchColumn(); 
      // Création/ récupération des objets tailles        
        $classeRecuperee="TAILLEPIZZA";
        $requete1="SELECT * FROM TAILLEPIZZA";
        $resultat = connexion::pdo()->query($requete1);
        $resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
        $tabTailles = $resultat->fetchAll();
        foreach($tabTailles as $uneTaille) {
            $majoration=$uneTaille->get("majorationTaille");
            $prixMajoree=$prixInitial*$majoration;
            $tabTaillesPrix[]=array('taille'=>$uneTaille,'prixMajoree'=> $prixMajoree);
        }
        return $tabTaillesPrix;
    }

    public static function getUnePizza($id){
        $classeRecuperee = "PIZZA";
        $requete = "SELECT * FROM $classeRecuperee WHERE numPizza= :id_tag;";
        $resultat1 = connexion::pdo()->prepare($requete);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tableau = $resultat1->fetchAll(PDO::FETCH_CLASS,$classeRecuperee);
        return $tableau;
    }

    public static function getClient($id){
          // on récupère Le nom de la table 
          $classeRecuperee = "CLIENT";
          // on construit la requête préparée avec un tag qui
          // remplace la valeur de L'identifiant
          $requetePreparee = "SELECT * FROM CLIENT WHERE numClient = :id_tag;";
          $resultat = connexion::pdo()->prepare($requetePreparee);
          // on crée le tableau contenant le tag et sa valeur
          $tags = array("id_tag" => $id);
          try {
              // on execute la requête préparée 
              $resultat->execute($tags);
              // on interprète le résultat selon la classe récupérée 
              $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
              // on récupère L'élément (le seul du tableau en fait)
              $unClient = $resultat->fetch();
              // on Le retourne 
              return $unClient;
          } catch(PDOException $e) { 
              echo $e->getMessage();
          }
    }
    public static function getCommande($id) {
        require_once("model/commande.php");
        $classeRecuperee = "COMMANDE";
        $identifiant = "numCommande";
        $requetePreparee = "SELECT * FROM COMMANDE WHERE numStatutCommande ='8' AND numClient = :id_tag;";
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array("id_tag" => $id);
        try {
            $resultat->execute($tags);
            // Utilisez PDO::FETCH_CLASS pour récupérer les données dans un objet de la classe spécifiée
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classeRecuperee);
            // Utilisez fetch() pour récupérer une seule ligne de résultat sous forme d'un objet
            $uneCommande = $resultat->fetch();
            if($uneCommande==NULL){
                return self::CreateCommande();
            }
            return $uneCommande->get("numCommande");
        } catch(PDOException $e) { 
            echo $e->getMessage();
        }
    }

    public static function getProduitCom($id){
        $tabProduitCom=array();
        //récupèreles produits d'une commande
        $classeRecuperee = 'PRODUIT';
        $requete1="SELECT PRODUIT.* FROM PRODUIT ";
        $requete1=$requete1." INNER JOIN COMMANDEPRODUIT ON PRODUIT.numProduit = COMMANDEPRODUIT.numProduit ";
        $requete1=$requete1." WHERE COMMANDEPRODUIT.numCommande = :id_tag;";
        $resultat1 = connexion::pdo()->prepare($requete1);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tabProd = $resultat1->fetchAll(PDO::FETCH_CLASS, $classeRecuperee);
        

        //on récupère la quantité de chaques ingredients
        foreach($tabProd as $unProduit) {
            $idProd=$unProduit->get("numProduit");
            $req2="SELECT quantiteProduit FROM COMMANDEPRODUIT WHERE numCommande = :id_tag AND numProduit = :idProd_tag  ;"; 
            $res2 = connexion::pdo()->prepare($req2);
            $res2->bindParam(':id_tag', $id);
            $res2->bindParam(':idProd_tag', $idProd);
            $res2->execute();
            $qteProd = $res2->fetchColumn(); 
            $tabProduitCom[]=array('produit'=>$unProduit,'quantite'=> $qteProd);
        }
        return $tabProduitCom;
    }

    public static function getPizzaSpeCom($id){
        require_once("model/pizza.php");
        require_once("model/pizzaSpeciale.php");
        require_once("model/ingredient.php");
 
        $getPizzaSpeCom=array();
        $qtePizzaSpe = 15;
        $tabIngredientSpe=array();  // sous la forme objet Ingredient, quantite
        $tabIngredientBase; // sous la forme objet Ingredient, quantite 
        $classeIngredient = "INGREDIENT";
        //récupèreles produits d'une commande
        $classeRecuperee = 'PIZZASPECIALE';
        $requete1="SELECT PIZZASPECIALE.* FROM PIZZASPECIALE ";
        $requete1=$requete1." INNER JOIN SELECTION ON SELECTION.numPizzaSpeciale= PIZZASPECIALE.numPizzaSpeciale ";
        $requete1=$requete1." WHERE SELECTION.numCommande = :id_tag;";
        $resultat1 = connexion::pdo()->prepare($requete1);
        $resultat1->bindParam(':id_tag', $id);
        $resultat1->execute();
        $tabPizzspe = $resultat1->fetchAll(PDO::FETCH_CLASS, $classeRecuperee);
        $classePizza='PIZZA';
        //pour chaques pizzaspe récupérer le prix et les pizza
        foreach($tabPizzspe as $unePizzaSpe) {
            $idPizz=$unePizzaSpe->get("numPizza");
            $idPizzaSpe=$unePizzaSpe->get('numPizzaSpeciale');
            //on récupère le prix de la pizza spe
            $req1 = "SELECT prixPizzaSpeciale(:idPizzaSpe) AS prix";
            $stmt = connexion::pdo()->prepare($req1);
            $stmt->bindParam(':idPizzaSpe', $idPizzaSpe);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                // Récupération de la ligne de résultat
                $prix = $stmt->fetch(PDO::FETCH_ASSOC)['prix'];
                $prix = round($prix, 2);
             
            } else {
                $prix = 'Error';
            }
            //On recupère la pizza de base associé à la pizza spéciale
            $req2  = " SELECT * FROM PIZZA WHERE numPizza= :idPizz_tag ;";
            $resultat2 = connexion::pdo()->prepare($req2);
            $resultat2->bindParam(':idPizz_tag', $idPizz);
            $resultat2->execute(); //Normalement renvoi 1 seul valeur
            $Pizza = $resultat2->fetchAll(PDO::FETCH_CLASS, $classePizza);

            //on recupère les ingredients de base 
            $req4=" SELECT I.*
                    FROM PIZZASPECIALE PS
                    INNER JOIN TAILLEPIZZA TS ON TS.numTaille = PS.numTaille
                    INNER JOIN PIZZA P ON P.numPizza = PS.numPizza
                    INNER JOIN COMPOSITIONPIZZA CP ON CP.numPizza = P.numPizza
                    INNER JOIN INGREDIENT I ON I.numIngredient = CP.numIngredient
                    WHERE PS.numPizzaSpeciale = :numPizzaSpe_tag1 AND PS.numPizza = :numPizza1_tag
                    AND I.numIngredient NOT IN (SELECT CPS.numIngredient
                                        FROM PIZZASPECIALE PS
                                        INNER JOIN COMPOSITIONPIZZASPECIALE CPS ON CPS.numPizzaSpeciale = PS.numPizzaSpeciale
                                        WHERE PS.numPizzaSpeciale = :numPizzaSpe_tag  AND CPS.quantite <=0);";
            $res4 = connexion::pdo()->prepare($req4);
            $res4->bindParam(':numPizza1_tag', $idPizz);
            $res4->bindParam(':numPizzaSpe_tag1', $idPizzaSpe);
            $res4->bindParam(':numPizzaSpe_tag', $idPizzaSpe);
            $res4->execute();
            $tabIngredientBase = $res4->fetchAll(PDO::FETCH_CLASS, $classeIngredient);

            //on récupère les ingredients supplémentaire
            $req5=" SELECT I.* FROM PIZZASPECIALE PS ";
            $req5= $req5." INNER JOIN COMPOSITIONPIZZASPECIALE CPS ON CPS.numPizzaSpeciale=PS.numPizzaSpeciale ";
            $req5= $req5." INNER JOIN INGREDIENT I  ON I.numIngredient=CPS.numIngredient ";
            $req5= $req5." WHERE PS.numPizzaSpeciale= :numPizzaSpe_tag ";
            $req5= $req5." AND CPS.quantite>0; ";
            $res5= connexion::pdo()->prepare($req5);
            $res5->bindParam(':numPizzaSpe_tag', $idPizzaSpe);
            $res5->execute();
            $ingreSupp = $res5->fetchAll(PDO::FETCH_CLASS, $classeIngredient);
            foreach($ingreSupp as $unIngSupp) {
                $numIngrSpe=$unIngSupp->get("numIngredient");
                $req6= "SELECT quantite FROM COMPOSITIONPIZZASPECIALE WHERE numPizzaSpeciale = :idPizzSpe_tag AND numIngredient = :numIngr";
                $res6= connexion::pdo()->prepare($req6);
                $res6->bindParam(':idPizzSpe_tag', $idPizzaSpe);
                $res6->bindParam(':numIngr', $numIngrSpe);
                $res6->execute();
                $qteIngr = $res6->fetchColumn();
                $tabIngredientSpe[]=array('IngredientSup'=>$unIngSupp,'quantite'=>$qteIngr);
            }

            //voir ici pour la quantité pizza special
            $req3="SELECT quantitePizzaSpe AS quantite FROM SELECTION WHERE numPizzaSpeciale = :idPizzSpe_tag ;"; 
            $res3 = connexion::pdo()->prepare($req3);
            $res3->bindParam(':idPizzSpe_tag', $idPizzaSpe);
            $res3->execute();
            $qtePizzaSpe = $res3->fetchColumn();
            $getPizzaSpeCom[]=array('PizzaSpe'=>$unePizzaSpe,'Pizza'=> $Pizza,'prix'=>$prix,'quantite'=>$qtePizzaSpe,'ingredientBase'=>$tabIngredientBase,'ingredientIngr'=>$tabIngredientSpe);
        }
        return $getPizzaSpeCom;
    }

    public static function getPrixCommande($uneCommande){
        $req1 = "SELECT prixTotalCommande(:idPizzaSpe) AS prix";
            $stmt = connexion::pdo()->prepare($req1);
            $stmt->bindParam(':idPizzaSpe', $uneCommande);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                // Récupération de la ligne de résultat
                $prix = $stmt->fetch(PDO::FETCH_ASSOC)['prix'];
             
            } else {
                $prix = 'Error';
            }
        return $prix;
    }
    public static function getReduction(){
        require_once("model/session.php");
        $numClient= $_SESSION["numClient"];
        $promos = array();

        $req1=" SELECT nomReduction, DATE_FORMAT(dateFin, '%d/%m/%Y') AS expiration, CONCAT(IF(pourcentageReduction >= 0, '-', ''), ABS(pourcentageReduction) * 100, '%') AS promo, numReduction,
                         estUtilisee, numCommandeReduite, statutReduction
                FROM REDUCTION
                WHERE numClient = :numClient ;";
        $res1=connexion::pdo()->prepare($req1);
        $res1->bindParam(':numClient', $numClient);
        $res1->execute();
        $resultats = $res1->fetchAll(PDO::FETCH_ASSOC);

        foreach ($resultats as $resultat) {
            $reduction = array(
                'nom' => $resultat['nomReduction'],
                'expiration' => $resultat['expiration'],
                'promo' => $resultat['promo'],
                'codePromo' => $resultat['numReduction'],
                'estUtilisee' => $resultat['estUtilisee'],
                'numCommandeReduite' => $resultat['numCommandeReduite'],
                'statutReduction' => $resultat['statutReduction']
            );
            $promos[] = $reduction;
        }
        
        return $promos;
    }

    public static function getReducCommande($numCommande,$numClient){
        $req = "SELECT nomReduction fROM REDUCTION WHERE estUtilisee=0 
                AND numCommandeReduite = :numCommande AND numClient= :numClient;";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':numCommande', $numCommande);
        $res->bindParam(':numClient', $numClient);
        $res->execute();
        $result = $res->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            return NULL;
        }else{
        return $result['nomReduction'];
        }
    }

    public static function getCommandePrixDateStatut(){
        require_once("model/session.php");

        $numClient= $_SESSION["numClient"];
            // Construction de la requête SQL pour récupérer les informations des commandes du client
        $sql = "SELECT numCommande,  DATE_FORMAT(dateDebutCommande, '%d/%m/%Y') AS dateCommande, numStatutCommande FROM COMMANDE WHERE numClient = $numClient";

        // Exécution de la requête SQL
        $result = connexion::pdo()->query($sql);

        // Tableau pour stocker les informations des commandes du client
        $commandes = array();

        // Vérification s'il y a des résultats
        if ($result->rowCount() > 0) {
            // Parcourir chaque ligne de résultat
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $numCommande = $row["numCommande"];
                $dateCommande = $row["dateCommande"];
                $numStatutCommande = $row["numStatutCommande"];
                //$date = substr($dateDebutCommande, 0, 10);
                // Récupérer le nom du statut de préparation à partir de la table STATUTPREPARATION
                $sql_statut = "SELECT nomStatutPreparation FROM STATUTPREPARATION WHERE numStatutPreparation = $numStatutCommande";
                $result_statut = connexion::pdo()->query($sql_statut);
                $row_statut = $result_statut->fetch(PDO::FETCH_ASSOC);
                $statut = $row_statut["nomStatutPreparation"];

                

                // Calculer le prix total de la commande en utilisant la fonction getPrixCommande
                $prixTotal = self::getPrixCommande($numCommande)-(self::getPrixCommande($numCommande) * self::getPourcentageReduction($numCommande));
                $prixTotal = round($prixTotal, 2);
                // Ajouter les informations de la commande au tableau
                $commandes[] = array(
                    'date' => $dateCommande,
                    'statut' => $statut,
                    'prix' => $prixTotal
                );
            }
        }

        return $commandes;
 

    }

    public static function getPourcentageReduction($numCommande) {
        // Préparation de la requête SQL pour récupérer le pourcentage de réduction
        $sql = "SELECT pourcentageReduction FROM REDUCTION WHERE numCommandeReduite = :numCommande ;";
        // Préparation de la requête SQL avec un statement préparé pour éviter les injections SQL
        $stmt = connexion::pdo()->prepare($sql);
        $stmt->bindParam(':numCommande', $numCommande);
            // Exécution de la requête
        $stmt->execute();
            // Liaison des résultats
        
            // Récupération du résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if(!$result){
            return 0;
        }else{
             // Retour du pourcentage de réduction
        return $result['pourcentageReduction'];
        }
       
    }
    public static function getClientEmail($l){
       // on récupère Le nom de la table 
       $classeRecuperee = "CLIENT";
       // on construit la requête préparée avec un tag qui
       // remplace la valeur de L'identifiant
       $requetePreparee = "SELECT * FROM CLIENT WHERE mailClient = :mail_tag;";
       $resultat = connexion::pdo()->prepare($requetePreparee);
       // on crée le tableau contenant le tag et sa valeur
       $tags = array("mail_tag" => $l);
       try {
           // on execute la requête préparée 
           $resultat->execute($tags);
           // on interprète le résultat selon la classe récupérée 
           $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
           // on récupère L'élément (le seul du tableau en fait)
           $unClient = $resultat->fetch();
           // on Le retourne 
           if (!$unClient){
                return null;
           }else { return $unClient->get("numClient");}           
       } catch(PDOException $e) { 
           echo $e->getMessage();
       } 
    }

    public static function create($nom,$prenom,$tel,$mail,$mdp ){
        require_once("model/client.php");
        // on récupère Le nom de la table 
        $classeRecuperee = "CLIENT";
        // on construit la requête préparée avec un tag qui
        // remplace la valeur de L'identifiant
        $requetePreparee = "INSERT INTO $classeRecuperee (nomClient, prenomClient, telClient, mailClient, mdpClient) VALUES (:nom, :prenom, :tel, :mail, :mdp);";
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        $resultat->bindParam(':nom', $nom);
        $resultat->bindParam(':prenom', $prenom);
        $resultat->bindParam(':tel', $tel);
        $resultat->bindParam(':mail', $mail);
        $resultat->bindParam(':mdp', $mdp);
        $resultat->execute();
        return connexion::pdo()->lastInsertId();
    }

    public static function modifiercompte($nom,$prenom,$tel,$mail/*,$mdp*/ ){
        require_once("model/client.php");
        $idClient=$_SESSION["numClient"];
        $classeRecuperee = "CLIENT";
        $requetePreparee = "UPDATE $classeRecuperee SET nomClient = :nomClient, prenomClient = :prenomClient, mailClient = :mailClient, telClient = :telClient WHERE CLIENT.numClient = :idClient;";
        //$requetePreparee = "UPDATE $classeRecuperee SET nomClient = :nomlient, `prenomClient` = :prenomClient, `mailClient` = :mailCLient, `telClient` = :telClient, `mdpClient` = :mdpClient WHERE CLIENT.numClient = :idClient;";
        $resultat = connexion::pdo()->prepare($requetePreparee); 

        $resultat->bindParam(':nomClient', $nom);
        $resultat->bindParam(':prenomClient', $prenom);
        $resultat->bindParam(':mailClient', $mail);
        $resultat->bindParam(':telClient', $tel);
        $resultat->bindParam(':idClient', $idClient);
        $resultat->execute();

    }   
    public static function CreateCommande(){
        require_once("model/session.php");
        require_once("model/commande.php");
        $idClient=$_SESSION["numClient"];
        $classeRecuperee = "COMMANDE";
        // on construit la requête préparée avec un tag qui
        // remplace la valeur de L'identifiant
        $requetePreparee = "INSERT INTO $classeRecuperee (numClient, numStatutCommande, dateDebutCommande) VALUES (:numClient, '8', NOW());";
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        $resultat->bindParam(':numClient', $idClient);
        $resultat->execute();
        return connexion::pdo()->lastInsertId();
    }

    public static function addProduit($numCommande, $numProduit) {
        require_once("model/commandeProduit.php"); 
        $classeRecuperee = "COMMANDEPRODUIT";
        // on construit la requête préparée avec un tag qui
        // remplace la valeur de L'identifiant
        
        $requetePreparee = "INSERT INTO $classeRecuperee (numCommande, numProduit, quantiteProduit) VALUES (:numCommande, :numProduit, '1') ON DUPLICATE KEY UPDATE quantiteProduit=quantiteProduit+1;";
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        $resultat->bindParam(':numCommande', $numCommande);
        $resultat->bindParam(':numProduit', $numProduit);
        $resultat->execute();
    }

    public static function addPizz($numCommande, $numPizza){
        require_once("model/selection.php"); 
        require_once("model/pizzaSpeciale.php"); 
        $classeRecuperee = "SELECTION";
        // on construit la requête préparée avec un tag qui
        // remplace la valeur de L'identifiant
        //Faire une vérif
        $res1;
        $req1="SELECT PS.numPizzaSpeciale AS numPizzaSpe FROM SELECTION S
                INNER JOIN PIZZASPECIALE PS ON PS.numPizzaSpeciale=S.numPizzaSpeciale
                left join COMPOSITIONPIZZASPECIALE CPS  ON CPS.numPizzaSpeciale=PS.numPizzaSpeciale  
                WHERE PS.numTaille=2  AND PS.numPizza= :numPizza AND PS.numStatutPizzaSpeciale=1  AND S.numCommande=:numCommande 
                AND CPS.numPizzaSpeciale IS NULL;";
        $res1 = connexion::pdo()->prepare($req1); 
        $res1->bindParam(':numPizza', $numPizza);
        $res1->bindParam(':numCommande', $numCommande);
        $res1->execute();
        $selection=$res1->fetch(PDO::FETCH_ASSOC);
        

        if($selection==null){
            $classeRecuperee = "PIZZASPECIALE"; 
            $requetePreparee = "INSERT INTO $classeRecuperee (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (:numPizza, '2', '8');";
            $resultat = connexion::pdo()->prepare($requetePreparee); 
            $resultat->bindParam(':numPizza', $numPizza);
            $resultat->execute();
            $numPizzaSpe=connexion::pdo()->lastInsertId();
            $classeRecuperee = "SELECTION";
            $req2="INSERT INTO $classeRecuperee (numPizzaSpeciale, numCommande, quantitePizzaSpe) VALUES (:numPizzaSpe,:numCommande, '1') ON DUPLICATE KEY UPDATE quantitePizzaSpe=quantitePizzaSpe+1;";
            $res2= connexion::pdo()->prepare($req2); 
            $res2->bindParam(':numPizzaSpe', $numPizzaSpe);
            $res2->bindParam(':numCommande', $numCommande);
            $res2->execute();
        }else{
            $numPizzaSpe = $selection["numPizzaSpe"];
            $classeRecuperee = "SELECTION";
            $req2="INSERT INTO $classeRecuperee (numPizzaSpeciale, numCommande, quantitePizzaSpe) VALUES (:numPizzaSpe,:numCommande, '1') ON DUPLICATE KEY UPDATE quantitePizzaSpe=quantitePizzaSpe+1;";
            $res2= connexion::pdo()->prepare($req2); 
            $res2->bindParam(':numPizzaSpe', $numPizzaSpe);
            $res2->bindParam(':numCommande', $numCommande);
            $res2->execute();
        }
        
            

    }

    public static function addPizzaSpe($numCommande,$numPizza,$numTaille,$totalQuantity){
        require_once("model/selection.php"); 
        require_once("model/pizzaSpeciale.php"); 
        $classeRecuperee = "PIZZASPECIALE";
        $requetePreparee = "INSERT INTO $classeRecuperee (numPizza, numTaille, numStatutPizzaSpeciale) VALUES (:numPizza, :numTaille, '8');";
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        $resultat->bindParam(':numPizza', $numPizza);
        $resultat->bindParam(':numTaille', $numTaille);
        $resultat->execute();
        $numPizzaSpe=connexion::pdo()->lastInsertId();
        $classeRecuperee = "SELECTION";
        $req2="INSERT INTO $classeRecuperee (numPizzaSpeciale, numCommande, quantitePizzaSpe) VALUES (:numPizzaSpe,:numCommande, :quantite);";
        $res2= connexion::pdo()->prepare($req2); 
        $res2->bindParam(':numPizzaSpe', $numPizzaSpe);
        $res2->bindParam(':numCommande', $numCommande);
        $res2->bindParam(':quantite', $totalQuantity);
        $res2->execute();
        return $numPizzaSpe;
    }

    public static function addIngredientSpe($numIngredient,$numPizzaSpeciale,$quantite){
        require_once("model/compositionPizzaSpeciale.php"); 
        $classeRecuperee = "COMPOSITIONPIZZASPECIALE";
        $req = "INSERT INTO COMPOSITIONPIZZASPECIALE (numPizzaSpeciale, numIngredient, quantite) VALUES (:numPizzaSpeciale, :numIngredient, :quantite)";
        $res1 = connexion::pdo()->prepare($req); 
        $res1->bindParam(':numPizzaSpeciale', $numPizzaSpeciale);
        $res1->bindParam(':numIngredient', $numIngredient);
        $res1->bindParam(':quantite', $quantite);
        $res1->execute();
    }

    public static function updateAdresse($idClient,$numRueAdresseClient,$nomAdresseClient,$villeAdresseClient,$codePostalAdresseClient,$infoComplementAdresseClient){
        require_once("model/client.php");
        $classeRecuperee="CLIENT";
        $requetePreparee = "UPDATE $classeRecuperee SET numRueAdresseClient = :numRueAdresseClient, 
                                        nomAdresseClient = :nomAdresseClient, villeAdresseClient = :villeAdresseClient, 
                                        codePostalAdresseClient = :codePostalAdresseClient, infoComplementAdresseClient=:infoComplementAdresseClient 
                            WHERE numClient = :idClient;";
        //$requetePreparee = "UPDATE $classeRecuperee SET nomClient = :nomlient, `prenomClient` = :prenomClient, `mailClient` = :mailCLient, `telClient` = :telClient, `mdpClient` = :mdpClient WHERE CLIENT.numClient = :idClient;";
        $resultat = connexion::pdo()->prepare($requetePreparee); 

        $resultat->bindParam(':numRueAdresseClient', $numRueAdresseClient);
        $resultat->bindParam(':nomAdresseClient', $nomAdresseClient);
        $resultat->bindParam(':villeAdresseClient', $villeAdresseClient);
        $resultat->bindParam(':codePostalAdresseClient', $codePostalAdresseClient);
        $resultat->bindParam(':infoComplementAdresseClient', $infoComplementAdresseClient);
        $resultat->bindParam(':idClient', $idClient);
        $resultat->execute();

    }

    public static function addPaiement($idClient,$numCommande,$numCarteBleu,$cryptoCarteBleu,$expiration){
        $req = "INSERT INTO PAIEMENT (numClient, numCommande, numCarteBleu,cryptoCarteBleu,dateExpiration,datePaiement) 
                VALUES (:idClient, :numCommande, :numCarteBleu,:cryptoCarteBleu,:expiration,NOW())";
        $res1 = connexion::pdo()->prepare($req); 
        $res1->bindParam(':idClient', $idClient);
        $res1->bindParam(':numCommande', $numCommande);
        $res1->bindParam(':numCarteBleu', $numCarteBleu);
        $res1->bindParam(':cryptoCarteBleu', $cryptoCarteBleu);
        $res1->bindParam(':expiration', $expiration);
        $res1->execute();

    }

    public static function commandePaie($idClient,$numCommande){
        $req = "UPDATE COMMANDE SET numStatutCommande = 7  WHERE numCommande = :numCommande AND numClient = :idClient ; ";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':idClient', $idClient);
        $res->bindParam(':numCommande', $numCommande);
        $res->execute();

    }
    public static function updateReduc($numClient,$numCommande,$nomReduction){
        $req = "UPDATE REDUCTION
                    SET estUtilisee = 1 AND numCommandeReduite = :numCommande AND statutReduction='Utilise'
                    WHERE numClient = :numClient
                    AND statutReduction='Disponible'
                    AND nomReduction=:nomReduction AND numCommandeReduite = :numCommande1; ";
            $res = connexion::pdo()->prepare($req);
            $res->bindParam(':numClient', $numClient);
            $res->bindParam(':numCommande', $numCommande);
            $res->bindParam(':numCommande1', $numCommande);
            $res->bindParam(':nomReduction', $nomReduction);
            $res->execute();
    }
    
    public static function supprimerPizzDuPanier($numPizzaSpaciale,$numCommande){
        $req = "DELETE FROM PIZZASPECIALE WHERE numPizzaSpeciale = :numPizzaSpeciale";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':numPizzaSpeciale', $numPizzaSpaciale);
        $res->execute();
    }

    public static function supprimerProdDuPanier($numProduit,$numCommande){
        $req = "DELETE FROM COMMANDEPRODUIT WHERE numCommande = :numCommande AND numProduit =:numProduit ";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':numProduit', $numProduit);
        $res->bindParam(':numCommande', $numCommande);
        $res->execute();
    }


    public static function modifierPizzQuantite($numPizzaSpaciale,$numCommande,$quantite){
        $req = "UPDATE SELECTION SET quantitePizzaSpe =:quantite WHERE numCommande = :numCommande AND numPizzaSpeciale = :numPizzaSpaciale ; ";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':numPizzaSpaciale', $numPizzaSpaciale);
        $res->bindParam(':numCommande', $numCommande);
        $res->bindParam(':quantite', $quantite);
        $res->execute();
    }

    public static function modifierProdQuantite($numProduit,$numCommande,$quantite){
        $req = "UPDATE COMMANDEPRODUIT SET quantiteProduit =:quantite WHERE numCommande = :numCommande AND numProduit = :numProduit ; ";
        $res = connexion::pdo()->prepare($req);
        $res->bindParam(':numProduit', $numProduit);
        $res->bindParam(':numCommande', $numCommande);
        $res->bindParam(':quantite', $quantite);
        $res->execute();
    }


    public static function updatePromo($nomReduction,$numCommande){
        $numClient= $_SESSION["numClient"];
        
        if($nomReduction!==NULL){
            $req = "UPDATE REDUCTION
                    SET numCommandeReduite = :numCommande
                    WHERE numClient = :numClient
                    AND estUtilisee = 0 AND statutReduction='Disponible'
                    AND nomReduction=:nomReduction; ";
            $res = connexion::pdo()->prepare($req);
            $res->bindParam(':numClient', $numClient);
            $res->bindParam(':numCommande', $numCommande);
            $res->bindParam(':nomReduction', $nomReduction);
            $res->execute();
        }else{
            $req1 = "UPDATE REDUCTION SET numCommandeReduite = NULL 
                    WHERE numClient = :numClient 
                    AND numCommandeReduite =:numCommande
                    AND estUtilisee = 0 AND statutReduction='Disponible'; ";
            $res1 = connexion::pdo()->prepare($req1);
            $res1->bindParam(':numClient', $numClient);
            $res1->bindParam(':numCommande', $numCommande);
            $res1->execute();
        }
        
        
    }

    

    public static function getone($id) {
        // on récupère Le nom de la table 
        $classeRecuperee = static::$classe;
        // on récupère le nom de L'identifiant 
        $identifiant = static::$identifiant;
        // on construit la requête préparée avec un tag qui
        // remplace la valeur de L'identifiant
        $requetePreparee = "SELECT * FROM $classeRecuperee WHERE $identifiant = :id_tag;";
        // on Lance la méthode "prepare" et on récupére te résultat
        // (qui n'est pas du tout exploitable puisque le tag n'a pas été remplacé)
        $resultat = connexion::pdo()->prepare($requetePreparee);
        // on crée le tableau contenant le tag et sa valeur
        $tags = array("id_tag" => $id);
        try {
            // on execute la requête préparée 
            $resultat->execute($tags);
            // on interprète le résultat selon la classe récupérée 
            $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
            // on récupère L'élément (le seul du tableau en fait)
            $element = $resultat->fetch();
            // on Le retourne 
            return $element;
        } catch(PDOException $e) { 
            echo $e->getMessage();
        }
    }

    
    public static function delete($id){
        // on récupère Le nom de la table 
        $classeRecuperee= static::$classe;
        // on récupère le nom de L'identifiant 
        $identifiant = static::$identifiant;
          $requetePreparee = "DELETE FROM $classeRecuperee WHERE $identifiant=:id_tag; ";
        $resultat = connexion::pdo()->prepare($requetePreparee);
          // on crée le tableau contenant le tag et sa valeur
        $tags = array("id_tag" => $id);
        try {
            // on execute la requête préparée 
            $resultat->execute($tags);
           // on interprète le résultat selon la classe récupérée 
            $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
            // on récupère L'élément (le seul du tableau en fait)
            $element = $resultat->fetch();
          // on Le retourne               return $element;
        } catch(PDOException $e) { 
              echo $e->getMessage();
          }  
        }

        public static function getVenteMois($n){
            // requête pour la date actuelle
            $requete = "SELECT venteMensuel(MONTH(NOW())-$n,YEAR(NOW()))" ;
            
            $resultat = connexion::pdo()->prepare($requete);
    
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $element = $resultat->fetch();
                return $element;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public static function getVenteSemaine($n){
            // requête pour la date actuelle
            $requete = "SELECT venteJournal($n)" ;
            
            $resultat = connexion::pdo()->prepare($requete);
    
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $element = $resultat->fetch();
                return $element;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public static function getVenteJour($n){
            // requête pour la date actuelle
            $requete = "SELECT venteQuotidienne($n)" ;
    
            $resultat = connexion::pdo()->prepare($requete);
    
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $element = $resultat->fetch();
                return $element;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public static function getPizzaGestionnaire(){
            $classeRecuperee = "PIZZA";
            $requete = "SELECT * FROM $classeRecuperee;";
            $resultat = connexion::pdo()->query($requete);
            $resultat->setFetchmode(PDO::FETCH_NUM);
            $tableau = $resultat->fetchAll();
            return $tableau;
        }
    
        public static function createPizza($donnees){
        // on récupère le nom de la table
        $classeRecuperee = "PIZZA";
        // on commence à construire la requête
        $requetePreparee = "INSERT INTO $classeRecuperee(";
        // on récupère le tableau des clés de $donnees
        $cles = array_keys($donnees);
        // on récupère le nombre de clés, ce sera utile
        $nbCles = count($cles);
        // pour chaque clé de $donnees (sauf la dernière), 
        // on concatère la chaîne "`$cle`," au bout de $requetePreparee. 
        for($i = 0; $i < $nbCles - 1; $i++) {
          $cle = $cles[$i];   
          $requetePreparee .= "`$cle`,";
        }
        // Attention, pour la dernière clé, on concatènera 
        // la chaîne "`$cle`) VALUES(" : pas la dernière virgule, 
        // mais le début des values 
        $cle = $cles[$nbCles - 1];
        $requetePreparee .= "`$cle`) VALUES(";
        // on ajoute maintenant les values. ATTENTION : des TAGS !!!
        for($i = 0; $i < $nbCles - 1; $i++) {
          $cle = $cles[$i]; 
          if ($cle == 'on'){
            $cle == true;
          }
          $requetePreparee .= ":$cle,"; // le tag aura pour nom le même que la clé
        }
        $cle = $cles[$nbCles - 1];
        $requetePreparee .= ":$cle);";
        // on finit le travail classiquement
        $resultat = connexion::pdo()->prepare($requetePreparee);
        try {
          // on exécute la requête préparée
          $resultat->execute($donnees);
        } catch(PDOException $e) {
          echo $e->getMessage();
        }
        }
    
        public static function deletePizza($id){
            // on récupère Le nom de la table 
            $classeRecuperee= "PIZZA";
            // on récupère le nom de L'identifiant 
            $identifiant = static::$identifiant;
              $requetePreparee = "DELETE FROM $classeRecuperee WHERE $identifiant=:id_tag; ";
            $resultat = connexion::pdo()->prepare($requetePreparee);
              // on crée le tableau contenant le tag et sa valeur
            $tags = array("id_tag" => $id);
            try {
                // on execute la requête préparée 
                $resultat->execute($tags);
               // on interprète le résultat selon la classe récupérée 
                $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
                // on récupère L'élément (le seul du tableau en fait)
                $element = $resultat->fetch();
              // on Le retourne               return $element;
            } catch(PDOException $e) { 
                  echo $e->getMessage();
              }  
            }  
    
        public static function getOnePizzaGestionnaire($id) {
            // on récupère Le nom de la table 
            $classeRecuperee = "PIZZA";
            // on récupère le nom de L'identifiant 
            $identifiant = static::$identifiant;
            // on construit la requête préparée avec un tag qui
            // remplace la valeur de L'identifiant
            $requetePreparee = "SELECT * FROM $classeRecuperee WHERE $identifiant = :id_tag;";
            // on Lance la méthode "prepare" et on récupére te résultat
            // (qui n'est pas du tout exploitable puisque le tag n'a pas été remplacé)
            $resultat = connexion::pdo()->prepare($requetePreparee);
            // on crée le tableau contenant le tag et sa valeur
            $tags = array("id_tag" => $id);
            try {
                // on execute la requête préparée 
                $resultat->execute($tags);
                // on interprète le résultat selon la classe récupérée 
                $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
                // on récupère L'élément (le seul du tableau en fait)
                $element = $resultat->fetch();
                // on Le retourne 
                return $element;
            } catch(PDOException $e) { 
                echo $e->getMessage();
            }
        }
    
        public static function modifierPizza($donnees, $id){
            $classeRecuperee = "PIZZA";
            // on commence à construire la requête
            $requetePreparee = "UPDATE $classeRecuperee SET ";
            // on récupère le tableau des clés de $donnees
            $cles = array_keys($donnees);
            // on récupère le nombre de clés, ce sera utile
            $nbCles = count($cles);
            // pour chaque clé de $donnees, on concatère la chaîne "`$cle` = :$cle," au bout de $requetePreparee.
            for($i = 0; $i < $nbCles; $i++) {
                $cle = $cles[$i];   
                $requetePreparee .= "$cle = :$cle,";    
            }
            // Suppression de la dernière virgule
            $requetePreparee = rtrim($requetePreparee, ",");
            // Ajout de la condition WHERE
            $requetePreparee .= " WHERE numPizza = $id;";
            // on finit le travail classiquement
            $resultat = connexion::pdo()->prepare($requetePreparee);
            try {
                // on exécute la requête préparée
                $resultat->execute($donnees);
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public static function setPizzaDuMoment($id){
            $classe = "PIZZA";
            $identifiant = static::$identifiant;
            $requete1 = "UPDATE $classe SET estDuMoment = false WHERE estDuMoment = true;";
            $requete2 = "UPDATE $classe SET estDuMoment = true WHERE numPizza = $id;"; 
            $resultat1 = connexion::pdo()->prepare($requete1);
            $resultat2 = connexion::pdo()->prepare($requete2);
    
            try {
                $resultat1->execute();
                $resultat1->setFetchmode(PDO::FETCH_NUM);
                $resultat2->execute();
                $resultat2->setFetchmode(PDO::FETCH_NUM);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    
        public static function getIngredientPizza(){
            $requete = "SELECT * FROM INGREDIENT;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $tableau = $resultat->fetchAll();
                return $tableau;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function getCompoPizza($id){
            $requete = "SELECT * FROM COMPOSITIONPIZZA WHERE numPizza = $id;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $tableau = $resultat->fetchAll();
                return $tableau;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function verifyCompoPizza($idPizza, $idIngredient){
            $requete = "SELECT * FROM COMPOSITIONPIZZA WHERE numPizza=$idPizza AND numIngredient=$idIngredient  ;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $rows = $resultat->fetchAll();
                if (count($rows) == 0){
                    return false;
                }
                else {
                    return $rows;
                }
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function deleteCompoPizza($idPizza, $idIngredient){
            $requete = "SELECT * FROM COMPOSITIONPIZZA WHERE numPizza=$idPizza AND numIngredient=$idIngredient;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $rows = $resultat->fetchAll();
                if (count($rows) == 0){
                    return false;
                }
                else {
                    $requete = "DELETE FROM COMPOSITIONPIZZA WHERE numPizza=$idPizza AND numIngredient=$idIngredient;";
                    $resultat = connexion::pdo()->prepare($requete);
                    $resultat->execute();
                    $resultat->setFetchmode(PDO::FETCH_NUM);    
                    $rows = $resultat->fetchAll();
                }
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function addCompoPizza($idPizza, $idIngredient, $quantite){
            $requete = "SELECT * FROM COMPOSITIONPIZZA WHERE numPizza=$idPizza AND numIngredient=$idIngredient;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $rows = $resultat->fetchAll();
                if (count($rows) == 0){
                    $requete = "INSERT INTO COMPOSITIONPIZZA VALUES ($idPizza, $idIngredient, $quantite);";
                }
                else {
                    $requete = "UPDATE COMPOSITIONPIZZA SET quantiteIngredient = $quantite WHERE numPizza = $idPizza AND numIngredient = $idIngredient;";
                }
                $resultat = connexion::pdo()->prepare($requete);
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);    
                $rows = $resultat->fetchAll();
                return $rows;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function displayAllergene($idPizza){
            $requete = "SELECT DISTINCT nomAllergene FROM ALLERGENE A INNER JOIN INGREDIENTALLERGENE IA ON IA.numAllergene = A.numAllergene
            INNER JOIN COMPOSITIONPIZZA CP ON CP.numIngredient = IA.numIngredient WHERE numPizza = $idPizza;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $tableau = $resultat->fetchAll();
                return $tableau;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function getStockGestionnaire(){
            $requete = "SELECT numIngredient, nomIngredient, quantiteStock, quantiteAlerte FROM INGREDIENT;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $tableau = $resultat->fetchAll();
                return $tableau;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    
        public static function modifyStock($id, $qttStock, $qttAlerte){
            $requete = "UPDATE INGREDIENT SET quantiteStock = $qttStock, quantiteAlerte = $qttAlerte WHERE numIngredient = $id;";
            $resultat = connexion::pdo()->prepare($requete);
            try {
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $rows = $resultat->fetchAll();
                return $rows;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }


        public static function getGestionnaireEmail($l){
            // on récupère Le nom de la table 
            $classeRecuperee = "GESTIONNAIRE";
            // on construit la requête préparée avec un tag qui
            // remplace la valeur de L'identifiant
            $requetePreparee = "SELECT * FROM GESTIONNAIRE WHERE mailGestionnaire = :mail_tag;";
            $resultat = connexion::pdo()->prepare($requetePreparee);
            // on crée le tableau contenant le tag et sa valeur
            $tags = array("mail_tag" => $l);
            try {
                // on execute la requête préparée 
                $resultat->execute($tags);
                // on interprète le résultat selon la classe récupérée 
                $resultat->setFetchmode (PDO::FETCH_CLASS, $classeRecuperee);
                // on récupère L'élément (le seul du tableau en fait)
                $unClient = $resultat->fetch();
                // on Le retourne 
                if (!$unClient){
                     return null;
                }else { return $unClient->get("numGestionnaire");}           
            } catch(PDOException $e) { 
                echo $e->getMessage();
            } 
         }

         public static function getAlerte(){
            $requete =  "SELECT * FROM ALERTE ORDER BY dateAlerte DESC;";
            $resultat = connexion::pdo()->prepare($requete);
            try{
                $resultat->execute();
                $resultat->setFetchmode(PDO::FETCH_NUM);
                $rows = $resultat->fetchAll();
                return $rows;
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
}
?>