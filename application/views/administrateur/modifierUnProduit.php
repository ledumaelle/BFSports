<!DOCTYPE html>
<html>
    <head>
        <title> Modifier un produit </title>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="text-warning"><?php echo $TitreDeLaPage ?></h2><br/>
                    <?php

                        echo form_open('administrateur/modifierUnProduit');

                        echo form_label("Libellé du produit : ", 'lblLibelle');
                        echo form_input(array('name'=>'txtLibelle','value'=>$unProduit["LIBELLE"],'type'=>'text','required'=>'required', 'title'=>'Saisir un libellé')).'<BR>';

                        echo form_label("Détail du produit : ", 'lblDetail');
                        echo form_textarea(array('required'=>'required','value'=>$unProduit["DETAIL"],'name'=>'txtDetail','type'=>'text','title'=>'Saisir le détail du produit')).'<BR>';

                        echo form_label('Prix HT : ','lblPrixHT');
                        echo form_input(array('name'=>'txtPrixHT', 'type'=>'text','value'=>$unProduit["PRIXHT"],'title'=>'Saisir un prix', 'required'=>'required')).'<BR>';

                        echo form_label('Taux TVA : ','lblTauxTVA');
                        echo form_input(array('name'=>'txtTauxTVA','value'=>$unProduit["TAUXTVA"], 'type'=>'text','title'=>'Saisir le taux de TVA', 'required'=>'required')).'<BR>';

                        echo form_label('Nom du fichier image : ','lblNomFichierImage');
                        echo form_input(array('name'=>'txtNomFichierImage','value'=>$unProduit["NOMIMAGE"],'type'=>'text','title'=>'Saisir nom de l\'image')).'<BR>';

                        echo form_label('Quantité en stock : ','lblQauntiteStock');
                        echo form_input(array('name'=>'txtQuantiteStock','value'=>$unProduit["QUANTITEENSTOCK"],'type'=>'text','title'=>'Saisir une quantité', 'required'=>'required')).'<BR>';

                        echo form_label('Date ajout du produit: ','lblDateAjout');
                        echo form_input(array('name'=>'txtDateAjout','value'=>$unProduit["DATEAJOUT"],'type'=>'text','title'=>'Saisir une date', 'required'=>'required')).'<BR>';

                        echo form_label('Disponible: ','lblPrixHT');
                        echo form_input(array('type'=>'text','name'=>'txtDisponible','value'=>$unProduit["DISPONIBLE"],'title'=>'1 dispo / 0 plus en stock', 'required'=>'required')).'<BR>';

                        echo form_label('Numéro Marque: ','lblNoMarque');
                        echo form_input(array('type'=>'text','name'=>'txtNoMarque','value'=>$unProduit["NOMARQUE"],'title'=>'Numéro marque', 'required'=>'required')).'<BR>';

                        echo form_label('Numéro Catégorie: ','lblNoCategorie');
                        echo form_input(array('type'=>'text','name'=>'txtNoCategorie','value'=>$unProduit["NOCATEGORIE"],'title'=>'Numéro catégorie', 'required'=>'required')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'btnModifierProduit','value'=> 'Modifier','class'=>'btn btn-success')).'<BR>';

                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>