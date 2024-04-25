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
            <a class="button-navbar selected" href="?action=identifier">
                <i class="fa-solid fa-user"></i>
                <p>S'identifier</p>
            </a>

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
    <div class="login-flexbox">
        <form action="">
            <div class="login-form">
                <div class="title">Se connecter</div>
                <div class="group-login-form">
                    <div class="label">ADRESSE EMAIL</div>
                    <input type="email" class="input-form-login" placeholder="Casa@DelPizza.com" name="mailClient">
                    <div class="label">MOT DE PASSE</div>
                    <input type="password" class="input-form-login" placeholder="• • •"  name="mdpClient">
                    <input type="hidden" value="connexion" name="action">
                </div>
                <input href="" type="submit" class="button-login" id="submit" value="Se connecter">
        </form>
    </div>
    <form action="">
        <div class="signin-form">
            <div class="title">S'inscrire</div>
            <div class="group-login-form">
                <div class="label">NOM</div>
                <input type="text" class="input-form-login" placeholder="CASA"  name="nomClient">
                <div class="label">PRÉNOM</div>
                <input type="text" class="input-form-login" placeholder="DEL PIZZA" name="prenomClient">
                <div class="label">TÉLÉPHONE</div>
                <input type="tel" class="input-form-login" placeholder="0123456789" name="telClient">
                <div class="label">ADRESSE EMAIL</div>
                <input type="email" class="input-form-login" placeholder="Casa@DelPizza.com" name="mailClient">
                <div class="label">MOT DE PASSE</div>
                <input type="password" class="input-form-login" placeholder="• • •" name="mdpClient">
                <input type="hidden" value="inscription" name="action">
            </div>
            <input href="" type="submit" class="button-login" id="submit" value="S'inscrire">
        </div>
    </form>
</div>
</body>
</html