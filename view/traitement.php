<?php
// Inclure le fichier contenant les fonctions de cryptage
include_once 'cryptage.php';
require_once 'cryptage.php';
$key = "MaCleSecrete123";
// Récupérer les données soumises par le formulaire
$numCarteBleu = $_POST['numCarteBleu'];
$dateMoisExpiration = $_POST['dateMoisExpiration'];
$dateAnneeExpiration = $_POST['dateAnneeExpiration'];
$cryptoCarteBleu = $_POST['cryptoCarteBleu'];
echo "$numCarteBleu";
echo "$dateMoisExpiration";
echo "$dateAnneeExpiration";
echo "$cryptoCarteBleu";
// Crypter les données sensibles
$numCarteBleuCrypted = encrypt($numCarteBleu,$key);
$dateExpirationCrypted = encrypt($dateMoisExpiration . $dateAnneeExpiration,$key);
$cryptoCarteBleuCrypted = encrypt($cryptoCarteBleu,$key);

// Afficher ou utiliser les données cryptées
echo "Numéro de carte bleue crypté : $numCarteBleuCrypted <br>";
echo "Date d'expiration cryptée : $dateExpirationCrypted <br>";
echo "Cryptogramme visuel crypté : $cryptoCarteBleuCrypted <br>";

// Vous pouvez également enregistrer ces données cryptées dans une base de données ou effectuer d'autres traitements nécessaires
?>