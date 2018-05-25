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
                <?php
                        if ($Erreur=='oui') :
                          ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="alert alert-warning">
                                            <strong>Erreur !</strong> Vous avez déjà une commande en cours
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif;  

                   ?> <h2><?php echo $TitreDeLaPage ?></h2>
                    <br/><?php
                    
                        echo form_open('visiteur/afficherProfil');

                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('required'=>'required','pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','type'=>'text','value'=>$UnClient['NOM'],'name'=>'txtNom','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','value'=>$UnClient['PRENOM'],'name'=>'txtPrenom','type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtAdresse','value'=>$UnClient['ADRESSE'],'type'=>'text','title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';
                        
                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('pattern'=>'[0-9]{5}','name'=>'txtCodePostal','type'=>'text','title'=>'Nombres seulement','value'=>$UnClient['CODEPOSTAL'],'class'=>'form-control','maxlength'=>'5','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtVille','value'=>$UnClient['VILLE'],'type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('readonly'=>'readonly','required'=>'required','type'=>'email','name'=>'txtIdentifiant','title'=>'Email seulement','value'=>$UnClient['EMAIL'],'class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un email')).' <BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','value'=>$UnClient['MOTDEPASSE'],'name'=>'txtMotDePasse','type'=>'pwd','title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'boutonModifierProfil','value'=> 'Modifier','class'=>'btn btn-info')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
                <div class="col-sm-1">  
                </div>
                <div class="col-sm-6">
                    <h2> Historique de vos commandes </h2>
                        </br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Numéro commande</th>
                                    <th>Date</th>
                                    <th> Etat </th>
                                    <th> Total Commande </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesCommandes as $uneCommande):
                                $date = new DateTime($uneCommande['DATECOMMANDE']);
                                if ($uneCommande['DATETRAITEMENT']==null): $etat="En Cours"; else: $etat="Commande traitée"; endif;
                                    echo  '<tr>  
                                        <td class="col-sm-2">' .anchor('visiteur/voirUneCommande/'.$uneCommande['NOCOMMANDE'], "Numéro : ".$uneCommande['NOCOMMANDE']).'</td>
                                        <td class="col-sm-2">' .$date->format('d/m/Y').'</td>
                                        <td class="col-sm-2">' .$etat. '</td>
                                        <td class="col-sm-2">' .$uneCommande['Total']. ' €</td>
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