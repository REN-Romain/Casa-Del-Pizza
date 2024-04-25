    <div class = ingredients-gest>
        <div class =title> Ingrédients </div>
    <form action ="gestionnaire.php?" method="get">
        <div class = group-ingredients>
            <input type = hidden name = page value = Pizza readonly>
    <?php
    $idPizza = $_GET['numPizza'];
    foreach($tableau as $ingredient){
        $id = $ingredient[0];
        echo "<div class =ingredient-gest>";
            echo "<div class =ingredient>";
            echo "{$ingredient[1]} ";
            echo "</div>";
        echo "<div class =quantite-gest>";
        $result = objet::verifyCompoPizza($idPizza, $id);
        $name = 'quantite'.$id;
        if (objet::verifyCompoPizza($idPizza, $id) == false){
            echo "<input type = 'textarea' name = $name value = 0 class='input-form-gest-quantite'>";
        }
        else {
            $quantite = objet::verifyCompoPizza($idPizza, $id);
            $poidsKg = $quantite[0][2] * 1000;
            echo "<input type = 'textarea' name = $name value = $poidsKg class='input-form-gest-quantite'>";
        }
        echo "</div>";
        echo "</div>";
    }
    echo "<button type ='submit'> Modifier </button>";
    ?>
    </div>
    </div>
