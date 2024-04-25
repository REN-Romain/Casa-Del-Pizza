<main>
    <table id="liste">
        <tr>
            <th>type</th><th>identifiant</th><th></th><th></th>
        </tr>
    <?php
        echo"<p>-----liste des ingredients----</p>";
        echo"<p>$listeIngr</p>";
        echo"<p>----liste des Allergènes----</p>";
        echo "<p> $listeAll </p>";
        echo"<tr><td>----</td><td>Affichage des ingredients de base</td><td>----</td><td></td></tr>";
        foreach($tabIngredients as $unElement) {
            $id = $unElement->get("numIngredient");
            $nom =$unElement->get("nomIngredient");
            $prix =$unElement->get("prixInitial");
            $qt =$unElement->get("quantiteStock");
            echo "<tr><td> {$nom} </td><td>{$id}</td><td>{$prix}</td><td>{$qt}</td></tr>";
        }
        echo"<tr><td>----</td><td>tableau des prix par taille de pizza</td><td>----</td><td></td></tr>";
        foreach ($tabTaillePrix as $element) {
            $taille = $element['taille'];
            $prixMajoree = $element['prixMajoree'];
            echo "<tr><td>{$taille->get("nomTaille")}</td><td>{$prixMajoree}</td></tr>";
        }
        echo"<tr><td>----</td><td>tableau des ingredients de la pizza qui sont suppléments</td><td>----</td><td></td></tr>";
        foreach ($tabSuppPizz as $suppPizz) {
            $id = $suppPizz->get("numIngredient");
            $nom = $suppPizz->get("nomIngredient");
            $prix = $suppPizz->get("prixInitial");
            $qt = $suppPizz->get("quantiteStock");
            echo "<tr><td>{$nom}</td><td>{$id}</td><td>{$prix}</td><td>{$qt}</td></tr>";
        }

        echo"<tr><td>----</td><td>tableau des suppléments</td><td>----</td><td></td></tr>";
        foreach ($tabSupplements as $supplement) {
            $id = $supplement->get("numIngredient");
            $nom = $supplement->get("nomIngredient");
            $prix = $supplement->get("prixInitial");
            $qt = $supplement->get("quantiteStock");
            echo "<tr><td>{$nom}</td><td>{$id}</td><td>{$prix}</td><td>{$qt}</td></tr>";
        }
        echo"<tr><td>----</td><td>Tableau des Allergenes </td><td>----</td><td></td></tr>";
        foreach ($tabAllergenes as $allergene) {
            $id = $allergene->get("numAllergene");
            $nom = $allergene->get("nomAllergene");
            echo "<tr><td>{$nom}</td><td>{$id}</td></tr>";
        }
        echo"<tr><td>----</td><td>Tableau des Allergenes </td><td>----</td><td></td></tr>";
        foreach ($tabPizz  as $Pizz) {
            $id = $Pizz->get("nomPizza");
            $nom = $Pizz->get("descriptionPizza");
            echo "<tr><td>{$nom}</td><td>{$id}</td></tr>";
        }
    ?>
    </table>
</main>   