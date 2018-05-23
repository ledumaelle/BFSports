<!DOCTYPE html>
<html>
    <head>
        <title> Ajouter un produit </title>
        
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" /> <!-- pour l'icone-->

        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="text-success"><?php echo $TitreDeLaPage ?></h2><br/>
                    <?php

                        echo form_open('administrateur/ajouterUnProduit');

                        echo form_label("Libellé du produit : ", 'lblLibelle');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtLibelle','type'=>'text','required'=>'required','class'=>'form-control', 'title'=>'Saisir un libellé','maxlength'=>'128','placeholder'=>'Entrez un libellé')).'<BR>';

                        echo form_label("Détail du produit : ", 'lblDetail');
                        echo form_textarea(array('required'=>'required','name'=>'txtDetail','type'=>'text','class'=>'form-control','title'=>'Saisir le détail du produit','placeholder'=>'Entrez le détail')).'<BR>';

                        echo form_label('Prix HT : ','lblPrixHT');
                        echo form_input(array('pattern'=>'^[0-9,]+$','name'=>'txtPrixHT', 'type'=>'text','title'=>'Saisir un prix','class'=>'form-control','placeholder'=>'Entrez le prix HT', 'required'=>'required')).'<BR>';

                        echo form_label('Taux TVA : ','lblTauxTVA');
                        $optionsTaux=array('20'=> 'Taux 20%','5.5'=> 'Taux 5,5%','10'=> 'Taux 10%');
                        echo form_dropdown(array('name'=>'dpdnTauxTVA','class'=>'form-control','title'=>'Saisir le taux de TVA','required'=>'required'),$optionsTaux).'<BR>';

                        echo form_label('Nom du fichier image : ','lblNomFichierImage');
                        echo form_upload(array('name'=>'txtNomFichierImage','type'=>'file','title'=>'Sélectionnez le fichier')).'<BR>';
                        
                        echo form_label('Quantité en stock : ','lblQauntiteStock');
                        echo form_input(array('pattern'=>'^[1-9][0-9]*$','name'=>'txtQuantiteStock','type'=>'text','title'=>'Saisir une quantité','maxlength'=>'11','placeholder'=>'Entrez la quantité en stock', 'class'=>'form-control','required'=>'required')).'<BR>';

                        echo form_label('Date ajout du produit: ','lblDateAjout');
?>
               <div class="bootstrap-iso">
                    <div class="container-fluid">
                        <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class='input-group date'>
                                        <span class="input-group-addon">
                                            <span class="fa fa-calendar"></span>
                                        </span>
                                        <input type='text' class="form-control" placeholder="AAAA/MM/JJ" id="datepicker" name="date" required pattern="^[0-9-]+$"/>
                                    </div>
                                </div>
                            </div>

                        <script>
                        //paramètres pour mettre la date picker en français
                            $.fn.datepicker.dates['fr'] = {
                            days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
                            daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Dim"],
                            daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
                            months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
                            monthsShort: ["Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Juil", "Auo", "Sep", "Oct", "Nov", "Dec"],
                            format: "yyyy-mm-dd",
                            weekStart: 1,
                            firstDay: 1,
                           
                            };
                            
                        $('#datepicker').datepicker({
                            language: 'fr',
                            todayHighlight: true
                        });

                        </script> 
                        </div>
                    </div>  
                </div>
<?php
                       
                        echo form_label('Disponible ? ','lblDisponible');
                        $optionsDisponible=array('1'=> 'Oui','0'=> 'Non');
                        echo form_dropdown(array('name'=>'dpdnDisponible','title'=>'Disponible','class'=>'form-control','required'=>'required'),$optionsDisponible).'<BR>';
                                                
                        echo form_label('Nom de la marque : ','lblNoMarque');
                        foreach ($lesMarques as $uneMarque):  
                            $optionsMarque[$uneMarque['NOMARQUE']]=$uneMarque['NOMMARQUE'];
                        endforeach;

                        echo form_dropdown(array('name'=>'dpdnNoMarque','title'=>'Nom de marque','class'=>'form-control', 'required'=>'required'),$optionsMarque).'<BR>';
                        
                        echo form_label('Nom de la catégorie : ','lblNoCategorie');
                        foreach ($lesCategories as $uneCategorie):  
                            $optionsCategorie[$uneCategorie['NOCATEGORIE']]=$uneCategorie['LIBELLECATEGORIE'];
                        endforeach;
                        echo form_dropdown(array('name'=>'dpdnNoCategorie','title'=>'Nom de catégorie','class'=>'form-control', 'required'=>'required'),$optionsCategorie).'<BR>';
                        
                        echo form_submit(array('type'=>'submit','name'=>'btnAjouterProduit','value'=> 'Ajouter','class'=>'btn btn-success')).'<BR>';

                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>