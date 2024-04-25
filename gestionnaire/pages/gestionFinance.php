<div class = "finance-gest">

<?php 
$val1 = $VenteMensuel[0];
echo"<div class = text-gest-finance>Vente de ce mois :<input class = 'input-form-gest' type='textarea' name='' value=$val1 readonly></div>";
$val2 = $VenteMensuelDernier[0];
echo"<div class = text-gest-finance>Vente du mois dernier : <input class = 'input-form-gest' type='textarea' name='' value=$val2 readonly></div>";
$val3 = $VenteSemaine[0];
echo"<div class = text-gest-finance>Vente de cette semaine : <input class = 'input-form-gest' type='textarea' name='' value=$val3 readonly></div>";
$val4 = $VenteSemaineDerniere[0];
echo"<div class = text-gest-finance>Vente de la semaine dernière : <input class = 'input-form-gest' type='textarea' name='' value=$val4 readonly></div>\n";
$val5 = $venteJour[0];
echo"<div class = text-gest-finance>Vente d'aujourd'hui : <input class = 'input-form-gest' type='textarea' name='' value=$val5 readonly></div>";
$val6 = $venteJourDernier[0];
echo"<div class = text-gest-finance>Vente d'hier : <input class = 'input-form-gest' type='textarea' name='' value=$val6 readonly></div>";
?>

</div>