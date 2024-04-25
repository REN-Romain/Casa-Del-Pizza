<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <script src="https://kit.fontawesome.com/55290364dd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="ressources/scripts/customiser.js" defer></script>
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
            if(!$isLogged){
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
    <div class="infos-product">
        <div class="product">
            <img src="ressources/images/pizzas/pizza-<?php echo $id; ?>.webp" alt="img-pizza">
            <div class="product-description">
                <div class="group-product-description">
                    <div class="title"><?php echo $tabPizz[0]->get("nomPizza") ?></div>
                    <div class="about"><?php echo $tabPizz[0]->get("descriptionPizza") ?></div>
                </div>
                <div class="group-product-size">
                    <div class="label">Taille de votre pizza</div>
                    <div class="sizes">
                        <div class="small b" id="small" id-price="<?php echo $tabTaillePrix[0]['prixMajoree'];?>" data-id="1">Petite</div>
                        <div class="medium selected" id="medium" id-price="<?php echo $tabTaillePrix[1]['prixMajoree'];?>" data-id="2">Moyenne</div>
                        <div class="large b" id="large" id-price="<?php echo $tabTaillePrix[2]['prixMajoree'];?>" data-id="3">Grande</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ingredients">
            <div class="title">Ingrédients</div>
            <div class="group-ingredients">
                <?php
                foreach($tabIngredients as $unElement) {
                    echo ('<div class="ingredient">'.$unElement->get("nomIngredient").'</div>');
                }
                ?>
            </div>
        </div>
        <div class="allergens">
            <div class="title">Allergènes</div>
            <div class="group-allergens">
                <?php
                foreach($tabAllergenes as $allergene) {
                    echo ('<div class="allegern">'.$allergene->get("nomAllergene").'</div>');
                }
                ?>
            </div>
        </div>
    </div>
    <div class="customise-pizza">
        <div class="customise">
            <div class="title">Customiser votre pizza</div>
            <div class="group-customise">
                <?php
                foreach($tabIngredients as $unElement) {
                    if(!is_null($unElement->get("prixSupplement"))){
                    echo ('
                <div class="customise-ingredient customise-base">
                    <div class="group-customise-ingredient">
                        <img src="ressources/images/ingredients/ingredient-1.webp" alt="img-ingredient" class="ingredient">
                        <div class="group-description-ingredient">
                            <div class="title">'.$unElement->get("nomIngredient").'</div>
                            <div class="supp-price">+ '.number_format($unElement->get("prixSupplement"), 2, ',', '').' €</div>
                        </div>
                    </div>
                    <div class="cursor-group">
                        <i class="fa-solid fa-minus" id="minus" data-id="'.$unElement->get("numIngredient").'"></i>
                        <span id="numeric" data-id="'.$unElement->get("numIngredient").'" data-price="'.$unElement->get("prixSupplement").'">1</span>
                        <i class="fa-solid fa-plus" id="plus" data-id="'.$unElement->get("numIngredient").'"></i>
                    </div>
                </div>                
                ');
                }
                }
                ?>
            </div>
        </div>
        <div class="customise">
            <div class="title">Ajouter des suppléments</div>
            <div class="group-customise">
                <?php
                foreach ($tabSupplements as $supplement) {
                    echo('
                    <div class="customise-ingredient customise-extra">
                    <div class="group-customise-ingredient">
                        <img src="ressources/images/ingredients/ingredient-1.webp" alt="img-ingredient" class="ingredient">
                        <div class="group-description-ingredient">
                            <div class="title">'.$supplement->get("nomIngredient").'</div>
                            <div class="supp-price">+ '.number_format($supplement->get("prixSupplement"), 2, ',', '').' €</div>
                        </div>
                    </div>
                    <div class="cursor-group">
                        <i class="fa-solid fa-minus" id="minus" data-id="'.$supplement->get("numIngredient").'"></i>
                        <span id="numeric" data-id="'.$supplement->get("numIngredient").'" data-price="'.$supplement->get("prixSupplement").'">0</span>
                        <i class="fa-solid fa-plus" id="plus" data-id="'.$supplement->get("numIngredient").'"></i>
                    </div>
                </div>
                ');
                }
                ?>
            </div>
        </div>
    </div>
    <div class="final-pizza">
        <div class="price-quantity">
            <div class="price">
                <div class="label">TOTAL</div>
                <div class="total">14.99€</div>
            </div>
            <div class="quantity">
                <div class="label">QUANTITÉ</div>
                <div class="quanity-cursor">
                    <i class="fa-solid fa-minus" id="minus" data-id="total"></i>
                    <span id="numeric" data-id="total">1</span>
                    <i class="fa-solid fa-plus" id="plus" data-id="total"></i>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="?action=displayCarte" class="button-cancel">Annuler</a>
            <a href="" class="button-submit" id="submit">Ajouter au panier</a>
        </div>
    </div>
</body>
</html