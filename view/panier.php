<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <script src="https://kit.fontawesome.com/55290364dd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
    <script src="ressources/scripts/panier.js" defer></script>
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
    <div class="panier-paiement">
        <div class="panier-produit">
            <div class="title">
                Mon panier
            </div>
            <div class="group-panier">
                <?php foreach($tabPizzaSpeCom as $unePizz) {
                    echo ('
                                    <div class="produit-element">
                    <div class="row-general">
                        <div class="img-produit" style="background-image: url(\'ressources/images/pizzas/pizza-' . $unePizz['Pizza'][0]->get('numPizza') . '.webp\');"></div>
                        <div class="group-produit-description">
                            <div class="produit-description">
                                <div class="title">'. $unePizz['Pizza'][0]->get('nomPizza') .'</div>
                                <div class="supp-price">'. number_format($unePizz['prix'], 2, ',', '').'€ l\'unité</div>
                                <div class="quantity">
                                    <div class="quanity-cursor">
                                        <a href="?action=modifierQuantite&objet=pizza&quantite='.($unePizz['quantite']-1).'&numPizzaSpeciale='.$unePizz['PizzaSpe']->get('numPizzaSpeciale').'&numCommande='.$uneCommande.'">
                                            <i class="fa-solid fa-minus" id="minus" data-id="total"></i>
                                        </a>
                                        <span id="numeric" data-id="total">'.$unePizz['quantite'].'</span>
                                        <a href="?action=modifierQuantite&objet=pizza&quantite='.($unePizz['quantite']+1).'&numPizzaSpeciale='.$unePizz['PizzaSpe']->get('numPizzaSpeciale').'&numCommande='.$uneCommande.'">
                                            <i class="fa-solid fa-plus" id="plus" data-id="total"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="group-produit-button">
                                <div class="price">
                                    <div class="label">PRIX</div>
                                    <div class="total">'. number_format($unePizz['prix']*$unePizz['quantite'], 2, ',', '').'€</div>
                                </div>
                                <a href="?action=supprimerDuPanier&objet=pizza&numPizzaSpaciale='.$unePizz['PizzaSpe']->get('numPizzaSpeciale').'&numCommande='.$uneCommande.'" class="button-delete" id="submit">Supprimer</a>
                                <div class="details" id="btn-details">Voir les détails</div>
                            </div>
                        </div>
                    </div>
                    <div class="row-details">
                        <div class="space-img-reserved"></div>
                        <div class="group-produit-description nospace">
                            <div class="ingredients-list">
                                <div class="title">Ingrédient(s)</div>
                                <div class="list">
                                ')?><?php
                                    foreach ($unePizz['ingredientBase'] as $ingredient){
                                        echo('<div class="element">'.$ingredient->get('nomIngredient').'</div>');
                                    } ?>
                            <?php echo ('
                                </div>
                            </div>
                            <div class="supp-ingredients-list">
                                <div class="title">Supplément(s)</div>
                                <div class="list">
                                    <div class="element">'); ?>
                                    <?php
                                    if(count($unePizz['ingredientIngr']) >= 1){
                                        foreach ($unePizz['ingredientIngr'] as $ingredient){
                                            echo('<div class="element">'.$ingredient['quantite'].'x '.$ingredient['IngredientSup']->get('nomIngredient').'</div>');
                                        }
                                    }else {
                                        echo('<div class="element">Aucun supplément</div>');
                                    }
                                     ?>
                                    <?php echo('
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>');
                } ?>
                <?php foreach($tabProduitCom as $unProduit) {
                    echo ('
                <div class="produit-element">
                    <div class="row-general">
                        <div class="img-produit" style="background-image: url(\'ressources/images/produits/produit-' . $unProduit['produit']->get('numProduit') . '.webp\');"></div>
                        <div class="group-produit-description">
                            <div class="produit-description">
                                <div class="title">'. $unProduit['produit']->get('nomProduit') .'</div>
                                <div class="supp-price">'. number_format($unProduit['produit']->get('prixUnitaire'), 2, ',', '').'€ l\'unité</div>
                                <div class="quantity">
                                    <div class="quanity-cursor">
                                        <a href="?action=modifierQuantite&objet=produit&quantite='.($unProduit['quantite']-1).'&numProduit='.$unProduit['produit']->get('numProduit').'&numCommande='.$uneCommande.'">
                                            <i class="fa-solid fa-minus" id="minus" data-id="total"></i>
                                        </a>
                                        <span id="numeric" data-id="total">'.$unProduit['quantite'].'</span>
                                        <a href="?action=modifierQuantite&objet=produit&quantite='.($unProduit['quantite']+1).'&numProduit='.$unProduit['produit']->get('numProduit').'&numCommande='.$uneCommande.'">
                                            <i class="fa-solid fa-plus" id="plus" data-id="total"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="group-produit-button">
                                <div class="price">
                                    <div class="label">PRIX</div>
                                    <div class="total">'. number_format($unProduit['produit']->get('prixUnitaire')*$unProduit['quantite'], 2, ',', '').'€</div>
                                </div>
                                <a href="?action=supprimerDuPanier&objet=produit&numProduit='.$unProduit['produit']->get('numProduit').'&numCommande='.$uneCommande.'" class="button-delete" id="submit">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>');
                } ?>

            </div>
        </div>
        <div class="paiement-form">
            <div class="title">
                Passer ma commande
            </div>
            <form action="">
                <div class="group-paiement">
                    <div class="group-adresse">
                        <div class="label">ADRESSE DE LIVRAISON</div>
                        <div class="group-rue">
                            <input type="text" name="numRueAdresseClient" id="" placeholder="NUMÉRO" class="input-adresse" value="<?php echo $client->get('numRueAdresseClient'); ?>">
                            <input type="text" name="nomAdresseClient" id="" placeholder="VOIE" class="input-adresse" value="<?php echo $client->get('nomAdresseClient'); ?>">
                        </div>
                        <div class="group-ville">
                            <input type="text" name="villeAdresseClient" id="" placeholder="VILLE" class="input-adresse" value="<?php echo $client->get('villeAdresseClient'); ?>">
                            <input type="text" name="codePostalAdresseClient" id="" placeholder="CODE POSTAL" class="input-adresse" value="<?php echo $client->get('codePostalAdresseClient'); ?>">
                        </div>
                        <input type="text" name="infoComplementAdresseClient" id="" placeholder="INFORMATIONS COMPLÉMENTAIRES" class="input-adresse" value="<?php echo $client->get('infoComplementAdresseClient'); ?>">
                    </div>
                    <div class="group-mode-paiement">
                        <div class="label">MODE DE PAIEMENT</div>
                        <input type="text" name="numCarteBleu" id="" placeholder="NUMÉRO DE CARTE" class="input-paiement" maxlength="16">
                        <div class="group-cb">
                            <input type="text" name="dateMoisExpiration" id="" placeholder="MOIS" class="input-paiement" maxlength="2">
                            <input type="text" name="dateAnneeExpiration" id="" placeholder="ANNÉE" class="input-paiement" maxlength="2">
                            <input type="text" name="cryptoCarteBleu" id="" placeholder="CRYPTO" class="input-paiement" maxlength="3">
                        </div>
                    </div>
                        <div class="group-mode-paiement">
                            <div class="label">RÉDUCTION</div>
                            <div class="group-promo">
                                <input type="text" name="nomReduction" id="inputPromo" placeholder="CODE PROMO" class="input-paiement" value="<?php echo $nomReduc;?>">
                                <a href="?action=appliquerPromo&numCommande=<?php echo($uneCommande); ?>&nomReduction=<?php echo($nomReduc); ?>" class="button-promo" id="btnPromo">Appliquer la promotion</a>

                            </div>
                        </div>
                    <div class="group-paiement-total">
                        <div class="price">
                            <div class="label">TOTAL</div>
                            <div class="total"><?php echo(number_format($prixTotCommande, 2, ',', '')); ?>€</div>
                        </div>
                        <input type="hidden" name="action" value="validerPaiement">
                        <input type="hidden" name="numCommande" value="<?php echo($uneCommande); ?>">
                        <input href="" type="submit" class="button-paiement" id="submit" value="Payer ma commande">
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>
<script>
    var monInput = document.getElementById('inputPromo');
    var monBouton = document.getElementById('btnPromo');

    function mettreAJourHref() {
        monBouton.href = "?action=appliquerPromo&numCommande=<?php echo($uneCommande); ?>&nomReduction="+monInput.value;
    }
    monInput.addEventListener('input', mettreAJourHref);
</script>
</html>
