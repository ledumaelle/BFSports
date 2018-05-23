<!DOCTYPE html>
<html>
    <head>
        <title> Détails du produit </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4"><?php

                    if ($unProduit["DISPONIBLE"]=="1") : $disponiblite= "En Stock"; else : $disponiblite ="Non disponible"; endif;
                    $dateCommande = new DateTime($unProduit['DATEAJOUT']);

                    echo '<h3 class="text-success">'.$unProduit['LIBELLE'].'</h3>';
                    echo $unProduit['DETAIL'];
                    echo '</br></br><h4 class="text-danger">' .(($unProduit['PRIXHT'])*(1+ ($unProduit['TAUXTVA']/100))).'€</h4>';   
                    echo '<p></br><img  width="60%" src="'. img_url($unProduit['NOMIMAGE']) .'"/></p>';  
                    echo '<p> <br> Ajouté le : ' .$dateCommande->format('d/m/Y').'</p>'; 
                    echo '<p><h5 class="text-danger">'.$disponiblite.'</h5></br></p>'; 
                    echo '<p> <h4 class="text-warning"> Quantité : '.$unProduit['QUANTITEENSTOCK'].'</h4></p></br>'; ?>
                </div>
                <div class="col-sm-7">
                    </br></br></br>
                    <img src="<?php echo img_url('voirUnProduit.jpg') ?>" alt="voirUnProduit" width="85%" class="img-rounded" align="right">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <?php echo '<p>'.anchor('administrateur/afficherBoutique','Retour à la liste des Produits').'</p>'; ?>
        
                </div>
            </div>
        </div>
    </body>
</html>




