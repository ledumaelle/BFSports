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
                        echo form_input(array('type'=>'text','name'=>'txtNom','required'=>'required','title'=>'Lettres seulement','pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtPrenom','type'=>'text','title'=>'Lettres seulement','required'=>'required','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtAdresse','type'=>'text','title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';

                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('pattern'=>'[0-9]{5}','name'=>'txtCodePostal','type'=>'text','title'=>'Nombres seulement','class'=>'form-control','minlength'=>'5','maxlength'=>'5','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtVille','type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('type'=>'email','name'=>'txtIdentifiant','required'=>'required','title'=>'Email seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un email')).'<BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_password(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtMotDePasse','type'=>'pwd','title'=>'Nombres ou lettres seulement','required'=>'required','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'boutonAjouter','value'=> 'S\'Inscrire','class'=>'btn btn-info')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>