<!DOCTYPE html>
<html>
    <head>
        <title> Ajouter un produit </title>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="text-success"><?php echo $TitreDeLaPage ?></h2>
                    <?php

                        echo form_open('administrateur/ajouterUnProduit');

                        echo form_label("Libellé du produit : ", 'lblLibelle');
                        echo form_input(array('name'=>'txtLibelle','type'=>'text','required'=>'required', 'title'=>'Saisir un libellé')).'<BR>';

                        echo form_label("Détail du produit : ", 'lblDetail');
                        echo form_textarea(array('required'=>'required','name'=>'txtDetail','type'=>'text','title'=>'Saisir le détail du produit')).'<BR>';

                        echo form_label('Prix HT : ','lblPrixHT');
                        echo form_input(array('name'=>'txtPrixHT', 'type'=>'text','title'=>'Saisir un prix', 'required'=>'required')).'<BR>';

                        echo form_label('Taux TVA : ','lblTauxTVA');
                        echo form_input(array('name'=>'txtTauxTVA', 'type'=>'text','title'=>'Saisir le taux de TVA', 'required'=>'required')).'<BR>';

                        echo form_label('Nom du fichier image : ','lblNomFichierImage');
                        echo form_input(array('name'=>'txtNomFichierImage','type'=>'file','title'=>'Saisir nom de l\'image')).'<BR>';

                        echo form_label('Quantité en stock : ','lblQauntiteStock');
                        echo form_input(array('name'=>'txtQuantiteStock','type'=>'text','title'=>'Saisir une quantité', 'required'=>'required')).'<BR>';

                        echo form_label('Date ajout du produit: ','lblDateAjout');
                        echo form_input(array('name'=>'txtDateAjout','type'=>'text','title'=>'Saisir une date', 'required'=>'required')).'<BR>';
// type => file
                        echo form_label('Disponible: ','lblPrixHT');
                        echo form_input(array('type'=>'text','name'=>'txtDisponible','title'=>'1 dispo / 0 plus en stock', 'required'=>'required')).'<BR>';

                        echo form_label('Numéro Marque: ','lblNoMarque');
                        echo form_input(array('type'=>'text','name'=>'txtNoMarque','title'=>'Numéro marque', 'required'=>'required')).'<BR>';

                        echo form_label('Numéro Catégorie: ','lblNoCategorie');
                        echo form_input(array('type'=>'text','name'=>'txtNoCategorie','title'=>'Numéro catégorie', 'required'=>'required')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'btnAjouterProduit','value'=> 'Ajouter','class'=>'btn btn-success')).'<BR>';

                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>