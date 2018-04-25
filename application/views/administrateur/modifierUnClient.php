<!DOCTYPE html>
<html>
    <head>
        <title> Modifier un client </title>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                <h2 class="text-warning"><?php echo $TitreDeLaPage ?></h2>
                    <?php

                        echo form_open('administrateur/modifierUnClient/'.$unClient['NOCLIENT']);

                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('type'=>'text','name'=>'txtNom','value'=>$unClient["NOM"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('name'=>'txtPrenom','type'=>'text','value'=>$unClient["PRENOM"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('name'=>'txtAdresse','type'=>'text','value'=>$unClient["ADRESSE"],'title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('name'=>'txtVille','type'=>'text','value'=>$unClient["VILLE"],'title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('name'=>'txtCodePostal','type'=>'text','value'=>$unClient["CODEPOSTAL"],'title'=>'Nombres seulement','class'=>'form-control','maxlength'=>'11','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('type'=>'email','name'=>'txtIdentifiant','value'=>$unClient["EMAIL"],'title'=>'Email seulement','class'=>'form-control','maxlength'=>'30')).' <BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_password(array('name'=>'txtMotDePasse','type'=>'pwd','value'=>$unClient["MOTDEPASSE"],'title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_label('Profil ','lblProfil');
                        echo form_input(array('name'=>'txtProfil','type'=>'text','value'=>$unClient["PROFIL"],'title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'14','placeholder'=>'(client/administrateur)')).'<BR>';
                        
                        echo form_submit(array('type'=>'submit','name'=>'boutonModifierClient','value'=> 'Modifier','class'=>'btn btn-info')).'<BR>';
                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>