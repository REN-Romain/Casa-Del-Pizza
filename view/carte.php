<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <script src="https://kit.fontawesome.com/55290364dd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="ressources/scripts/la-carte.js" defer></script>
    <script src="ressources/scripts/hamburger.js" defer></script>
    <title>Casa Del Pizza</title>
</head>
<body>
<div class="app" id="a-la-une">
    <div class="flex-la-carte">
        <div class="navbar col">
            <a class="navbar-logo" href="?">
                <img class="logo-svg" src="ressources/images/general/logo.svg" alt="logo"/>
            </a>
            <div class="navbar-categories" id="categories">
                <a class="button-navbar selected" id="btnALaUne" href="#a-la-une">
                    <i class="fa-solid fa-fire"></i>
                    <p>La pizza du moment</p>
                </a>
                <a class="button-navbar" id="btnPizzas" href="#pizzas">
                    <i class="fa-solid fa-pizza-slice"></i>
                    <p>Les pizzas</p>
                </a>
                <a class="button-navbar" id="btnBoissons" href="#boissons">
                    <i class="fa-solid fa-whiskey-glass"></i>
                    <p>Les boissons</p>
                </a>
                <a class="button-navbar" id="btnDesserts" href="#desserts">
                    <i class="fa-solid fa-ice-cream"></i>
                    <p>Les desserts</p>
                </a>
            </div>
        </div>
        <div class="overflow-la-carte">
            <div class="navbar">
                <a class="navbar-logo small" href="?">
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
                    if(!$isLogged==1){
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
                <h3 id="menu-link-2" style="visibility: inherit; opacity: 1;"><a>Notre histoire</a></h3>
                <h3 id="menu-link-3" style="visibility: inherit; opacity: 1;"><a>Nous contacter</a></h3>
            </div>
            <div class="navbar-categories row">
                <a class="button-navbar selected" id="btnALaUne" href="#a-la-une">
                    <i class="fa-solid fa-fire"></i>
                    <p>La pizza du moment</p>
                </a>
                <a class="button-navbar" id="btnPizzas" href="#pizzas">
                    <i class="fa-solid fa-pizza-slice"></i>
                    <p>Les pizzas</p>
                </a>
                <a class="button-navbar" id="btnBoissons" href="#boissons">
                    <i class="fa-solid fa-whiskey-glass"></i>
                    <p>Les boissons</p>
                </a>
                <a class="button-navbar" id="btnDesserts" href="#desserts">
                    <i class="fa-solid fa-ice-cream"></i>
                    <p>Les desserts</p>
                </a>
            </div>

            <div class="la-carte">
                <?php
                foreach($tabPizzDuMoment as $unePizz) {
                    echo('
                        <div class="a-la-une" style="background-image: url(\'ressources/images/pizzas/pizza-' . $unePizz->get('numPizza') . '.webp\')">
                            <div class="description">
                                <div class="group-description"></div>
                                <div class="title">'.$unePizz->get('nomPizza').'</div>
                                <div class="price">'.number_format($unePizz->get('prixInitial'), 2, ',', '').' €</div>
                                <div class="about">'.$unePizz->get('descriptionPizza').'</div>
                                <div class="buttons">
                                    <a href="?objet=pizza&action=customiser&numPizza='.$unePizz->get('numPizza').'" class="button-primary transparent selected small">En savoir plus</a>
                                    <a href="?objet=pizza&action=ajouterAuPanier&numPizza='.$unePizz->get('numPizza').'" class="button-primary selected small">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>');
                    }?>
                <div class="pizzas" id="pizzas">
                    <?php
                    foreach($tabPizz as $unePizz) {
                       echo('
                       <div class="pizza" style="background-image: url(\'ressources/images/pizzas/pizza-' . $unePizz->get('numPizza') . '.webp\')" data-objet="pizza" data-id="'.$unePizz->get('numPizza').'">
                            <div class="pupupinfo">
                                Personnaliser la pizza
                            </div>
                            <div class="description">
                                <div class="group-description">
                                    <div class="title">'.$unePizz->get('nomPizza').'</div>
                                    <div class="price">'.number_format($unePizz->get('prixInitial'), 2, ',', '').' €</div>
                                    <div class="about">'.$unePizz->get('descriptionPizza').'</div>
                                </div>
                                <div class="buttons">
                                    <a href="?objet=pizza&action=ajouterAuPanier&numPizza='.$unePizz->get('numPizza').'" class="button-primary selected little">Ajouter au panier</a>
                                </div>
                            </div>
                        </div>');
                    }
                    for($i = 0; $i < (3-(count($tabPizz)%3))%3; $i++){
                        echo('<div class="void"></div>');
                    }?>
                </div>
                <div class="boissons" id="boissons">
                    <?php
                    foreach($tabBoissons as $uneBoiss) {
                        echo('<div class="boisson" style="background-image: url(\'ressources/images/produits/produit-' . $uneBoiss->get('numProduit') . '.webp\')">
                        <div class="description">
                            <div class="group-description">
                                <div class="title">'.$uneBoiss->get('nomProduit').'</div>
                                <div class="price">'.number_format($uneBoiss->get('prixUnitaire'), 2, ',', '').' €</div>
                            </div>
                            <div class="buttons">
                                <a href="?objet=produit&action=ajouterAuPanier&numProduit='.$uneBoiss->get('numProduit').'" class="button-primary selected little">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>');
                    }

                    for($i = 0; $i < (3-(count($tabBoissons)%3))%3; $i++){
                        echo('<div class="void"></div>');
                    }?>
                </div>
                <div class="desserts" id="desserts">
                    <?php
                    foreach($tabDessert as $unDess) {
                        echo('<div class="boisson" style="background-image: url(\'ressources/images/produits/produit-' . $unDess->get('numProduit') . '.webp\')">
                        <div class="description">
                            <div class="group-description">
                                <div class="title">'.$unDess->get('nomProduit').'</div>
                                <div class="price">'.number_format($unDess->get('prixUnitaire'), 2, ',', '').' €</div>
                            </div>
                            <div class="buttons">
                                <a href="?objet=produit&action=ajouterAuPanier&numProduit='.$unDess->get('numProduit').'" class="button-primary selected little">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>');
                    }

                    for($i = 0; $i < (3-(count($tabDessert)%3))%3; $i++){
                        echo('<div class="void"></div>');
                    }?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>