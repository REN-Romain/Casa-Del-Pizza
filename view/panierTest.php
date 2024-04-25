
<main>
    <ul>
        <li><?php echo $uneCommande; ?></li>
    </ul>
    <?php

// Affichage du tableau
echo "<table border='1'>";
echo "<tr><th>PizzaSpéciale</th><th>Pizza</th><th>Prix</th><th>Quantité</th></tr>";

foreach ($tabPizzaSpeCom as $pizzaSpeCom) {
    echo "<tr>";
    echo "<td>" . $pizzaSpeCom['PizzaSpe'] . "</td>";
    echo "<td>" . $pizzaSpeCom['Pizza'] . "</td>";
    echo "<td>" . $pizzaSpeCom['prix'] . "</td>";
    echo "<td>" . $pizzaSpeCom['quantite'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<p>Client $client</p>";
?>
</main>   