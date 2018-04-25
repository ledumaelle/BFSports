<!DOCTYPE html>
<html>
    <head>
        <title> Détails du produit </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <h1 class="text-danger"><?php echo $TitreDeLaPage ?></h1>  
        <?php
            echo '<h3>'.$unProduit['LIBELLE'].'</h3>';
            echo ' <h5>Détails :</h5> '.$unProduit['DETAIL'];
            echo '<p> <br> Prix: ' .$unProduit['PRIXHT'].' </p>';   
            echo '<p><img  width="20%" src="'. img_url($unProduit['NOMIMAGE']) .'"/></p>'; 
            echo '<p> <br> Date de l\'ajout: ' .$unProduit['DATEAJOUT'].'</p>'; 
            echo '<p>En Stock: '. $unProduit['DISPONIBLE'].'</p>'; 
            // Nota Bene : img_url($unProduit['cNomFichierImage']) aurait retourne l'url de l'image (cf. assets)
            echo '<p>'.anchor('administrateur/afficherBoutique','Retour à la liste des Produits').'</p>';
        ?>
    </body>
</html>




