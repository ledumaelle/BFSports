<!DOCTYPE html>
<html>
    <head>
        <title> Boutique </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h2><?php echo $TitreDeLaPage ?></h2>
                    <br/>
                    <?php
            
                        echo form_open('visiteur/afficherProfil');

                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('type'=>'text','name'=>'txtNom','value'=>$UnClient["NOM"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('name'=>'txtPrenom','type'=>'text','value'=>$UnClient["PRENOM"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('name'=>'txtAdresse','type'=>'text','value'=>$UnClient["ADRESSE"],'title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('name'=>'txtVille','type'=>'text','value'=>$UnClient["VILLE"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('name'=>'txtCodePostal','type'=>'text','value'=>$UnClient["CODEPOSTAL"],'title'=>'Nombres seulement','class'=>'form-control','maxlength'=>'11','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('type'=>'email','name'=>'txtIdentifiant','readonly'=>'readonly','value'=>$UnClient["EMAIL"],'title'=>'Email seulement','class'=>'form-control','maxlength'=>'30')).' <BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_input(array('name'=>'txtMotDePasse','type'=>'pwd','value'=>$UnClient["MOTDEPASSE"],'title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';
                        
                        echo form_submit(array('type'=>'submit','name'=>'boutonModifierProfil','value'=> 'Modifier','class'=>'btn btn-info')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
                <div class="col-sm-1">  
                </div>
                <div class="col-sm-5">
                    <h2> Historique de vos commandes </h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Numéro commande</th>
                                    <th>Date</th>
                                    <th> Total Commande </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesCommandes as $uneCommande):
                                $date = new DateTime($uneCommande['DATECOMMANDE']);
                                    echo  '<tr>  
                                        <td class="col-sm-2">' .anchor('visiteur/voirUneCommande/'.$uneCommande['NOCOMMANDE'], "Numéro : ".$uneCommande['NOCOMMANDE']).'</td>
                                        <td class="col-sm-2">' .$date->format('d/m/Y').'</td>
                                        <td class="col-sm-2">' .$uneCommande['Total']. '</td>
                                    </tr>';
                                endforeach ?>   
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>