<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <link rel="stylesheet" href="ressources/styles/gest.css">
    <title>Gestion - Casa Del Pizza</title>
    <style>
</style>   
    </head>
    <body>
    <div class ="navbar">
        <a class ="navbar-logo" href="?">
            <img class = "logo-svg" src = "ressources/images/general/logo.svg" alt="logo"/>   
        </a>
        <div class = "navbar-nav">
            <a class ="button-navbar" href="gestionnaire.php?page=Pizza">Pizzas</a></li>
            <a class ="button-navbar" href="gestionnaire.php?page=Stock">Stocks</a></li>
            <a class ="button-navbar" href="gestionnaire.php?page=Vente">Ventes</a></li>
            <a class ="button-navbar" href="#">Support</a></li>
        </nav>
        </div>
    </div>
    <?php 
    $objet = null;
    
    $objets = ["pizza", "Vente"];   

    $page = null;

    $pages = ["Pizza", "Vente", "Stock"];

    if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)){
        $objet = $_GET['objet'];
    }

    if (isset($_GET["page"]) && in_array($_GET["page"], $pages)){
        $page = $_GET['page'];
    }

    // Insertion des contrôleurs
    require_once("controller/controllerObjet.php");
    require_once("controller/controllerPizza.php");
    require_once("controller/controllerIngredient.php");
    require_once("controller/controllerAllergene.php");

    // Méthode de connexion
    require_once("config/connexion.php");
    connexion::connect();

    echo "<div class ='page'>";
    if ($page == "Vente"){
        controllerObjet::gestionDisplayVente();
    }
    else if ($page == "Pizza"){
        controllerObjet::gestionDisplayPizza();
    }
    else if ($page == "Stock"){
        controllerObjet::gestionDisplayStock();
        controllerObjet::displayAlerte();
    }
    $action = null;

    $actions = ["ajouter", "details", "supprimer", "create", "modifierPizza", "modifierStock", "mettreFavori"];

    if (isset($_GET["action"]) && in_array($_GET["action"], $actions)){
        $action = $_GET['action'];
    }


    if ($action == "ajouter"){
        controllerPizza::gestionPizzaAjouter();
    }
    else if ($action == "details"){
        echo "<div class = 'details-pizza'>";
        echo "<div class = 'container-gest1'>";
        controllerPizza::gestionPizzaModifier();
        echo "<div class = 'container-gest2'>";
        controllerIngredient::gestionDisplayIngredient();
        controllerAllergene::displayAllergene();
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    else if ($action == "supprimer"){
        controllerPizza::gestionPizzaSupprimer();
    }
    else if ($action == "create"){
        controllerPizza::createPizza();
    }
    else if ($action == "modifierPizza"){
        controllerPizza::modifier();
        controllerIngredient::modifierCompoPizza();
    }
    else if ($action == "mettreFavori"){
        controllerPizza::setPizzaDuMoment();
    }
    else if ($action == "modifierStock"){
        controllerIngredient::modifierStock();
    }
    echo "</div>";
    ?> 

    </body>
</html>
