<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <script src="https://kit.fontawesome.com/55290364dd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="ressources/scripts/index.js" defer></script>
    <script src="ressources/scripts/hamburger.js" defer></script>
    <title>Casa Del Pizza</title>
</head>
<body>
<div class="app">
    <div class="navbar">
        <a class="navbar-logo" href="?">
            <img class="logo-svg" src="ressources/images/general/logo.svg" alt="logo"/>
        </a>
        <div class="navbar-nav">
            <a class="button-navbar" href="?action=displayCarte">La carte</a>
            <a class="button-navbar">Notre histoire</a>
            <a class="button-navbar">Nous contacter</a>
            <a class="button-navbar selected" href="?action=viewPanier&objet=commande">
                <i class="fa-solid fa-basket-shopping"></i>
                <p>Mon panier</p>
            </a>
            <?php
            if($isLogged==0){
                echo('
                        <a class="button-navbar selected" href="?action=identifier">
                            <i class="fa-solid fa-user"></i>
                            <p>S\'identifier</p>
                        </a>
                        ');
            }else{
                echo('
                        <a class="button-navbar selected" href="?action=moncompte">
                            <i class="fa-solid fa-user"></i>
                            <p>Mon compte</p>
                        </a>
                        ');
            }
            ?>

            <a class="button-navbar phone" href="?action=viewPanier&objet=commande">
                <i class="fa-solid fa-basket-shopping"></i>
            </a>
            <a class="button-navbar phone" href="?action=moncompte">
                <i class="fa-solid fa-user"></i>
            </a>
            <a class="button-navbar menu phone" id="equal" onclick="displayMenu()">
                <i class="fa-solid fa-equals"></i>
            </a>
            <a class="button-navbar menu phone" id="cross" onclick="hideMenu()()">
                <i class="fa-solid fa-xmark"></i>
            </a>
        </div>
    </div>
    <div class="menu-res" id="menu">
        <h3 id="menu-link-1" style="visibility: inherit; opacity: 1;"><a href="?action=displayCarte">La carte</a></h3>
        <h3 id="menu-link-2" style="visibility: inherit; opacity: 1;"><a href="ourstory.html">Notre histoire</a></h3>
        <h3 id="menu-link-3" style="visibility: inherit; opacity: 1;"><a href="fleet.html">Nous contacter</a></h3>
    </div>
    <div class="section">
        <div class="banner">
            <div class="banner-description">
                <div class="banner-left">
                    <h1>Nouvelle pizza du moment !</h1>
                    <h3>Découvrez les saveurs de la pizza <?php echo $tabPizzDuMoment[0]->get('nomPizza'); ?></h3>
                    <div class="banner-buttons">
                        <a href="<?php echo "?objet=pizza&action=ajouterAuPanier&numPizza=".$tabPizzDuMoment[0]->get('numPizza'); ?>" class="button-primary selected">
                            Ajouter au panier
                        </a>
                        <a href="<?php echo "?objet=pizza&action=customiser&numPizza=".$tabPizzDuMoment[0]->get('numPizza'); ?>" class="button-primary transparent">
                            En savoir plus
                        </a>
                    </div>
                </div>
                <div class="banner-right">
                    <img src="ressources/images/general/pizza-banner.webp"/>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="panel left">
            <div class="panel-title">
                <h2>Nos pizzas</h2>
            </div>
            <div class="headband">
                <div class="boxes">
                    <?php
                    foreach($tabPizzDuMoment as $unePizz) {
                        echo ('<a class="box" href="?action=displayCarte" style="background-image: url(\'ressources/images/pizzas/pizza-' . $unePizz->get('numPizza') . '.webp\')"></a>');
                    }
                    ?>
                    <?php
                    foreach($tabPizz as $unePizz) {
                        echo ('<a class="box" href="?action=displayCarte" style="background-image: url(\'ressources/images/pizzas/pizza-' . $unePizz->get('numPizza') . '.webp\')"></a>');
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="panel right">
            <div class="panel-title">
                <h2>Nos produits</h2>
            </div>
            <div class="mini-boxes">
                <div class="shelf">
                    <?php
                    foreach($tabBoissons as $uneBoiss) {
                        echo ('<a href="?action=displayCarte#boissons" class="mini-box _20" style="background-image: url(\'ressources/images/boissons-alt/boisson-' . $uneBoiss->get('numProduit') . '.png\'); background-size: cover; "></a>');
                    }
                    ?>
                    <div class="mini-box _20"></div>
                    <div class="mini-box _20"></div>
                    <div class="mini-box _20"></div>
                    <div class="mini-box _20"></div>
                    <div class="mini-box _20"></div>
                </div>
                <div class="shelf">
                    <?php
                    foreach($tabDessert as $unDess) {
                        echo ('<a href="?action=displayCarte#desserts" class="mini-box _50" style="background-image: url(\'ressources/images/desserts-alt/dessert-' . $unDess->get('numProduit') . '.png\'); background-size: cover; "></a>');
                    }
                    ?>
                    <div class="mini-box _50"></div>
                    <div class="mini-box _50"></div>
                    <div class="mini-box _50"></div>
                    <div class="mini-box _50"></div>
                    <div class="mini-box _50"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-logo">
            <img class="logo-svg-footer" src="ressources/images/general/logo.svg" alt="logo"/>
        </div>
        <div class="footer-pages">
            <h6>Accéder à</h6>
            <span>La carte</span>
            <span>Notre histoire</span>
            <span>Nous contacter</span>
        </div>
        <div class="footer-pages">
            <h6>Mon compte</h6>
            <span>Mon panier</span>
            <span>S'identifier</span>
        </div>
    </div>
</div>
</body>
</html>