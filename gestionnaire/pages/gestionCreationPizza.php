    <div class = "pizza-gest-create">
        <div class = "pizza-gest-info">
    <div class ="title"> Création d'une nouvelle pizza </div>
    <form action="gestionnaire.php" method="get">
        <input type="hidden" name="objet" value="<?php echo "pizza"; ?>">
        <input type="hidden" name="action" value="create">
        <?php
        foreach($champs as $champ => $details) {
            echo "<div class =text-gest>";
            echo "<label for=\"$champ\">$details[1]</label>";
            echo "</div>";
            echo "<div class =text-gest>";
            echo "<input type=\"$details[0]\" class='input-form-gest-create' name=\"$champ\" placeholder=\"$details[1]\">";
            echo "</div>";
        }
        ?>
        <button type="submit">créer</button>
    </form>
    </div>
    </div>  
