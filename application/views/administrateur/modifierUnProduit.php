<!DOCTYPE html>
<html>
    <head>
        <title> Modifier un produit </title>
        
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" /> <!-- pour l'icone-->

        <!-- Bootstrap Date-Picker Plugin -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="text-warning"><?php echo $TitreDeLaPage ?></h2><br/>
                    <?php

                        echo form_open('administrateur/modifierUnProduit/'.$unProduit['NOPRODUIT']);

                        echo form_label("Libellé du produit : ", 'lblLibelle');
                        echo form_input(array('name'=>'txtLibelle','value'=>$unProduit["LIBELLE"],'class'=>'form-control','type'=>'text','required'=>'required', 'title'=>'Saisir un libellé')).'<BR>';

                        echo form_label("Détail du produit : ", 'lblDetail');
                        echo form_textarea(array('required'=>'required','value'=>$unProduit["DETAIL"],'class'=>'form-control','name'=>'txtDetail','type'=>'text','title'=>'Saisir le détail du produit')).'<BR>';

                        echo form_label('Prix HT : ','lblPrixHT');
                        echo form_input(array('name'=>'txtPrixHT', 'type'=>'text','value'=>$unProduit["PRIXHT"],'class'=>'form-control','title'=>'Saisir un prix', 'required'=>'required')).'<BR>';

                        echo form_label('Taux TVA : ','lblTauxTVA');
                        if ($unProduit["TAUXTVA"]=="20.00") : $optionsTVA= "Taux 20% "; elseif ($unProduit["TAUXTVA"]=="5.5"): $optionsTVA ="Taux 5,5 %"; else : $optionsTVA="Taux de 10%"; endif;
                        $optionsTaux=array($unProduit["TAUXTVA"]=>$optionsTVA,'20.00'=> 'Taux 20%','5.5'=> 'Taux 5,5%','10.00'=> 'Taux 10%'); 
                        echo form_dropdown(array('name'=>'dpdnTauxTVA','value'=>$unProduit["TAUXTVA"],'class'=>'form-control','title'=>'Saisir le taux de TVA','required'=>'required'),$optionsTaux).'<BR>';

                        echo form_label('Nom du fichier image : ','lblNomFichierImage');
                        echo form_input(array('value'=>$unProduit["NOMIMAGE"],'pattern'=>'[a-zA-Z0-9.]+$','class'=>'form-control','type'=>'text')).'<BR>';
                         
                        echo form_label('Quantité en stock : ','lblQuantiteStock');
                        echo form_input(array('class'=>'form-control','type'=>'text','value'=>$unProduit["QUANTITEENSTOCK"],'name'=>'txtQuantiteStock','title'=>'Saisir une quantité', 'required'=>'required')).'<BR>';

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
                                        <input type='text' class="form-control" placeholder="AAAA/MM/JJ" name="date" id="datepicker" value=" <?php echo $unProduit["DATEAJOUT"] ?>" />
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
                        if ($unProduit["DISPONIBLE"]=="1") : $optionsDisponible= "Oui"; else : $optionsDisponible ="Non"; endif;
                        $optionsDisponible=array($unProduit['DISPONIBLE']=> $optionsDisponible,'0'=> 'Non','1'=>'Oui'); 
                        echo form_dropdown(array('name'=>'dpdnDisponible','title'=>'Disponible','class'=>'form-control','required'=>'required'),$optionsDisponible).'<BR>';
                        
                        echo form_label('Nom de la marque: ','lblNoMarque');
                        foreach ($lesMarques as $uneMarque):  
                            $optionsMarque[$unProduit['NOMARQUE']]=$unProduit['NOMMARQUE'];
                            $optionsMarque[$uneMarque['NOMARQUE']]=$uneMarque['NOMMARQUE'];
                        endforeach;
                        echo form_dropdown(array('name'=>'dpdnNoMarque','title'=>'Nom de marque','class'=>'form-control', 'required'=>'required'),$optionsMarque).'<BR>';

                        echo form_label('Nom de la catégorie: ','lblNoCategorie');
                        foreach ($lesCategories as $uneCategorie):  
                            $optionsCategorie[$unProduit['NOCATEGORIE']]=$unProduit['LIBELLECATEGORIE'];
                            $optionsCategorie[$uneCategorie['NOCATEGORIE']]=$uneCategorie['LIBELLECATEGORIE'];
                        endforeach;
                        echo form_dropdown(array('name'=>'dpdnNoCategorie','title'=>'Nom de catégorie','class'=>'form-control', 'required'=>'required'),$optionsCategorie).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'btnModifierProduit','value'=> 'Modifier','class'=>'btn btn-success')).'<BR>';

                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>