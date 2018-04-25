<!DOCTYPE html>
<html>
    <head>
        <title> S'Inscrire </title>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <h2><?php echo $TitreDeLaPage ?></h2>
                    <br/>
                    <?php
            
                        echo form_open('visiteur/sInscrire');
           
                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('type'=>'text','name'=>'txtNom','required'=>'required','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('name'=>'txtPrenom','type'=>'text','title'=>'Lettres seulement','required'=>'required','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('name'=>'txtAdresse','type'=>'text','title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('name'=>'txtVille','type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('name'=>'txtCodePostal','type'=>'text','title'=>'Nombres seulement','class'=>'form-control','maxlength'=>'11','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('type'=>'email','name'=>'txtIdentifiant','required'=>'required','title'=>'Email seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un email')).'<BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_password(array('name'=>'txtMotDePasse','type'=>'pwd','title'=>'Nombres ou lettres seulement','required'=>'required','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'boutonAjouter','value'=> 'S\'Inscrire','class'=>'btn btn-info')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>