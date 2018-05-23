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
            
                        echo form_open('administrateur/afficherProfil');
                        
                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('required'=>'required','pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','type'=>'text','value'=>$UnClient["NOM"],'name'=>'txtNom','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','name'=>'txtPrenom','value'=>$UnClient["PRENOM"],'type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('readonly'=>'readonly','type'=>'email','value'=>$UnClient["EMAIL"],'name'=>'txtIdentifiant','title'=>'Email seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>$this->session->identifiant)).'<BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','name'=>'txtMotDePasse','value'=>$UnClient["MOTDEPASSE"],'type'=>'pwd','title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_submit(array('type'=>'submit','name'=>'boutonModifierProfil','value'=> 'Modifier','class'=>'btn btn-info')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>