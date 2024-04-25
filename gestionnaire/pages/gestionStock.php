<div class = ingredients-gest-stock>
<form action ="gestionnaire.php?" method="get">
<input type="hidden" name="action" value="modifierStock">
<?php
echo "<div class =titres>";
echo "<div class =title> Nom</div>";
echo "<div class =title> Quantité en Stock</div>";
echo "<div class =title> Quantité Alerte</div>";
echo "</div>";
foreach($tableauStock as $ingredient){
    $id = $ingredient[0];
    echo "<div class =ingredient-gest-stock>";
    echo "{$ingredient[1]} ";
    $name1 = 'quantiteStock'.$id;
    $name2 = 'quantiteAlerte'.$id;
    echo "<div class =quantite-gest-stock>";
    echo "<input type = 'textarea' name = $name1 value = $ingredient[2] class='input-form-gest-quantite'>";
    echo "</div>";
    echo "<div class =quantite-gest-alerte>";
    echo "<input type = 'textarea' name = $name2 value = $ingredient[3] class='input-form-gest-quantite'>";
    echo "</div>";
    echo "</div>";
}
echo "<button type ='submit'> Modifier </button>";
?>
</div>