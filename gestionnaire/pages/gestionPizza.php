<div class = "navbar col-gest">
<?php
    $lienAjouter = "<a href='gestionnaire.php?page=Pizza&action=ajouter'><img width='40' height='40' src='gestionnaire/img/ajouter.svg' alt='ajouter' title='ajouter' class='button-primary selected small'></a>";
    echo "$lienAjouter";
    echo "<div class = 'navbar-categories-gest' id = 'categories'>";
    foreach($tableauPizza as $pizza){
        $id = $pizza[0];
        $lienDetails = "<a class = 'button-navbar' href='gestionnaire.php?page=Pizza&action=details&numPizza=$id'>
        <img width='40' height='40' src='gestionnaire/img/info.png' alt='détails' title='détails'>
        <p> {$pizza[1]} </p>
        </a>";
        $lienSupprimer = "<a href='gestionnaire.php?action=supprimer&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/poubelle.png' alt='supprimer' title='supprimer'></a>";
            
        echo $lienDetails;

        if ($pizza[3] == true){
            $lienFavori = "<a href = 'gestionnaire.php?action=mettreFavori&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/etoile.png' alt='Pizza du Moment' title='Pizza du Moment'></a>";
        }
        else {
            $lienFavori = "<a href = 'gestionnaire.php?action=mettreFavori&numPizza=$id'><img width='40' height='40' src='gestionnaire/img/etoile_vide.png' alt='Pas la Pizza du Moment' title='Pas la Pizza du Moment'></a>";
        }
    }
    echo "</div>";
?>
</div>
