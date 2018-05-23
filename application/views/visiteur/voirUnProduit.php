<!DOCTYPE html>
<html>
    <head>
        <title> Détails du produit </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
    <?php
        if ($Erreur=='oui') : ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="alert alert-warning">
                        <strong>Erreur !</strong> La quantité est trop grande, Reste : <?php echo $unProduit['QUANTITEENSTOCK'] ;?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4"><?php

                    echo '<h3 class="text-success">'.$unProduit['LIBELLE'].'</h3></br>';
                    echo $unProduit['DETAIL'];
                    echo '</br></br><h4 class="text-danger">' .(($unProduit['PRIXHT'])*(1+ ($unProduit['TAUXTVA']/100))).'€</h4>';   
                    echo '<p></br><img  width="60%" src="'. img_url($unProduit['NOMIMAGE']) .'"/></p>';  
                    if ($unProduit['QUANTITEENSTOCK']<"15"):
                        echo '<p><h5 class="text-danger">En Stock: '. $unProduit['QUANTITEENSTOCK'].'</h5></p>'; 
                    endif; ?>
                </div>
                <div class="col-sm-7">
                    </br></br></br>
                    <img src="<?php echo img_url('voirUnProduit.jpg') ?>" alt="voirUnProduit" width="85%" class="img-rounded" align="right">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
        <?php
            echo form_open('visiteur/ajouterPanier/'.$unProduit['NOPRODUIT']);
            echo form_label('Quantité : ','lblQauntiteStock');
            echo form_input(array('pattern'=>'^[1-9][0-9]*$','name'=>'txtQuantite','type'=>'text','title'=>'Saisir une quantité','maxlength'=>'3','placeholder'=>'Entrez la quantité', 'class'=>'form-control','required'=>'required')).'<BR>';
            echo form_submit(array('type'=>'submit','name'=>'btnAjouterPanier','value'=> 'Ajouter au panier ','class'=>'btn btn-success')).'<BR>';
            echo form_close();
               
            echo '<BR><p>'.anchor('visiteur/afficherBoutique','Retour à la liste des Produits').'</p>';
        ?>

                </div>
            </div>
        </div>
    </body>
</html>




