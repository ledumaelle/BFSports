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
                <div class="col-sm-8">
        <?php
            echo '<h3>'.$unProduit['LIBELLE'].'</h3>';
            echo ' <h5>Détails :</h5> '.$unProduit['DETAIL'];
            echo '<p> <br> Prix: ' .(($unProduit['PRIXHT'])*(1+ ($unProduit['TAUXTVA']/100))).' </p>';   
            echo '<p><img  width="25%" src="'. img_url($unProduit['NOMIMAGE']) .'"/></p>'; 
            echo '<p> <br> Date de l\'ajout: ' .$unProduit['DATEAJOUT'].'</p>'; 
            if ($unProduit['QUANTITEENSTOCK']<"10"):
            echo '<p><h5 class="text-danger">En Stock: '. $unProduit['QUANTITEENSTOCK'].'</h5></p>'; 
            endif;
        ?>
            </div>
                </div>
            <div class="row">
                <div class="col-sm-2">
        <?php
            echo form_open('visiteur/ajouterPanier/'.$unProduit['NOPRODUIT']);
            echo form_label('Quantité : ','lblQauntiteStock');
            echo form_input(array('name'=>'txtQuantite','type'=>'text','title'=>'Saisir une quantité','maxlength'=>'11','placeholder'=>'Entrez la quantité', 'class'=>'form-control','required'=>'required')).'<BR>';
            echo form_submit(array('type'=>'submit','name'=>'btnAjouterPanier','value'=> 'Ajouter au panier ','class'=>'btn btn-success')).'<BR>';
            echo form_close();
               
            echo '<p>'.anchor('visiteur/afficherBoutique','Retour à la liste des Produits').'</p>';
        ?>

                    </div>
                </div>
            </div>
    </body>
</html>




