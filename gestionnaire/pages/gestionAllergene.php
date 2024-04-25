    <div class = allergens>
        <div class = title> Allergènes </div>
        <div class = "group-allergens">
    <?php
        foreach($tableau as $element){
            echo "<div class = 'allegern'>";
            echo $element[0];
            echo "</div>";
        }
    ?>
    </div>
    </div>
