<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ressources/styles/main.css">
    <script src="https://kit.fontawesome.com/55290364dd.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
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
    <div class="infocompte-codepromos">
        <form class="signin-form" action="?" method="get">
            <div class="title">Mon compte</div>
            <div class="group-login-form">
                <div class="label">NOM</div>
                <input type="text" class="input-form-login" name="nomClient" value="<?php echo $client->get('nomClient'); ?>">
                <div class="label">PRÉNOM</div>
                <input type="text" class="input-form-login" placeholder="DEL PIZZA" name="prenomClient" value="<?php echo $client->get('prenomClient'); ?>">
                <div class="label">TÉLÉPHONE</div>
                <input type="tel" class="input-form-login" placeholder="0123456789" name="telClient" value="<?php echo $client->get('telClient'); ?>">
                <div class="label">ADRESSE EMAIL</div>
                <input type="email" class="input-form-login" placeholder="Casa@DelPizza.com" name="mailClient" value="<?php echo $client->get('mailClient'); ?>">
                <input type="hidden" name="action" value="modifier">
            </div>
            <div class="group-button">
                <a class="button-disconnect" href="?action=deconnexion">Se deconnecter</a>
                <input type="submit" class="button-change" value="Modifier">
            </div>
        </form>
        <div class="codepromos">
            <div class="title">Mes codes promos</div>
            <div class="group-codespromos">
                <?php
                foreach ($promo as $unePromo){
                    $dateExp = DateTime::createFromFormat('d/m/Y', $unePromo["expiration"]);
                    $sysDate = new DateTime();
                    $diffDate = $dateExp->diff($sysDate);

                    if($unePromo['estUtilisee'] == 0 and $diffDate->invert != 0){
                        echo('
                        <div class="promo">
                            <div class="promo-description">
                                <div class="group-promo-description">
                                    <div class="promo-nom">'.$unePromo['nom'].'</div>
                                    <div class="promo-status disponible">Disponible</div>
                                </div>
                                <div class="date-expi">Expiration : '.$unePromo['expiration'].'</div>
                            </div>
                            <div class="promo-reduction">
                                <div class="label">RÉDUCTION</div>
                                <div class="promo-pourcent">'.$unePromo['promo'].'</div>
                            </div>
                        </div>
                        ');
                    }else if($unePromo['estUtilisee'] == 1){
                    echo('
                        <div class="promo">
                            <div class="promo-description">
                                <div class="group-promo-description">
                                    <div class="promo-nom">'.$unePromo['nom'].'</div>
                                    <div class="promo-status deja_utilise">Déjà utilisé</div>
                                </div>
                                <div class="date-expi">Expiration : '.$unePromo['expiration'].'</div>
                            </div>
                            <div class="promo-reduction">
                                <div class="label">RÉDUCTION</div>
                                <div class="promo-pourcent">'.$unePromo['promo'].'</div>
                            </div>
                        </div>
                    ');
                } else {
                     echo('
                        <div class="promo">
                            <div class="promo-description">
                                <div class="group-promo-description">
                                    <div class="promo-nom">'.$unePromo['nom'].'</div>
                                    <div class="promo-status expire">Expiré</div>
                                </div>
                                <div class="date-expi">Expiration : '.$unePromo['expiration'].'</div>
                            </div>
                            <div class="promo-reduction">
                                <div class="label">RÉDUCTION</div>
                                <div class="promo-pourcent">'.$unePromo['promo'].'</div>
                            </div>
                        </div>
                     ');
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="commandes">
        <div class="title">Mes commandes</div>
        <div class="group-commandes">
            
            <?php
            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["En cours de commande"])){
                    echo ('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status en_cours">En cours</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>
                    ');
                }
            }            
            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["Payé"])){
                    echo('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status paye">Payée</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>
                    ');
                }
            }
            
            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["En cours de livraison", "En cours de préparation"])){
                    echo ('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status en_cours">En préparation</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>
                    ');
                }
            }
            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["Prêt à être livré"])){
                    echo ('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status en_cours">Prête à être livrée</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>
                    ');
                }
            }
            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["Livré"])){
                    echo('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status livre">Livrée</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>');
                }
            }
            

            foreach ($commandes as $commande){
                if(in_array($commande["statut"], ["Annulé"])){
                    echo ('
                    <div class="commande">
                        <div class="commande-description">
                            <div class="group-commande-description">
                                <div class="commande-nom">Commande du '.$commande['date'].'</div>
                                <div class="commande-status annule">Annulée</div>
                            </div>
                        </div>
                        <div class="commande-prix">
                            <div class="label">TOTAL</div>
                            <div class="commande-tarif">'.$commande['prix'].'€</div>
                        </div>
                    </div>
                    ');
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>