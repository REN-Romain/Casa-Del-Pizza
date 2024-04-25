<div class = alerte>
        <div class = title> Alertes </div>
        <div class = "group-allergens">
    <?php
        foreach($tableau as $element){
            echo "<div class = 'allegern'>";
            echo "{$element[0]} : Alerte du {$element[1]} concernant l'ingrédient {$element[2]}";
            echo "</div>";
        }
    ?>
    </div>
</div>
