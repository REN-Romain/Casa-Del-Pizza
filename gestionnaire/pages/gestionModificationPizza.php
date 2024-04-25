<div class = "pizza-gest">
    <div class ="pizza-gest-info">
    <div class ="title"> Informations </div>
<form action ="gestionnaire.php" method="get">
<input type="hidden" name="action" value="modifierPizza">
<?php  
$id = $pizza->get('numPizza');
echo "<div class =text-gest>";
echo "Identifiant";
echo "</div>";
echo "<input type='text' class='input-form-gest' name='numPizza' value=$id readonly>";
echo "<br>";
foreach($champs as $champ => $details) {
echo "<div class =text-gest>";
echo "<label for=\"$champ\">$details[1]</label>";
echo "</div>";
echo "<input type=\"$details[0]\" class='input-form-gest' name=\"$champ\" value=\"{$pizza->get($champ)}\">";
echo "<br>";
}
if ($pizza->get('estDuMoment') == 1){
    $estDuMoment = 1;
}
else {
    $estDuMoment = 0;
}
echo "<input type='hidden' name='estDuMoment' value=$estDuMoment readonly>";
$lienSupprimer = "<a class = 'button-supp-gest' href='gestionnaire.php?action=supprimer&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/poubelle.png' alt='supprimer' title='supprimer'> Supprimer </a>";
if ($pizza->get('estDuMoment')== true){
    $lienFavori = "<a class = 'button-fav-gest' href = 'gestionnaire.php?page=Pizza&action=mettreFavori&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/etoile.png' alt='Pizza du Moment' title='Pizza du Moment'>Mettre en Pizza du moment</a>";
}
else {
    $lienFavori = "<a class = 'button-fav-gest' href = 'gestionnaire.php?page=Pizza&action=mettreFavori&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/etoile_vide.png' alt='Pas la Pizza du Moment' title='Pas la Pizza du Moment'>Mettre en Pizza du moment</a>";
}
echo "</div>";
echo "$lienSupprimer";
echo "$lienFavori";
?>
</div>
