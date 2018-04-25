<!DOCTYPE html>
<html>
    <head>
        <title> Se Connecter </title>
    </head>
    <body>   
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h2><?php echo $TitreDeLaPage ?></h2>
                    <br/>
                    <?php
            
                        echo form_open('visiteur/seConnecter');
           
                        echo form_label('Identifiant ','lblIdentifiant'); // creation d'un label devant la zone de saisie
                        echo form_input(array('type'=>'email','name'=>'txtIdentifiant','required'=>'required','title'=>'Saisir un email svp','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un email')).'<BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_password(array('name'=>'txtMotDePasse','type'=>'pwd','title'=>'Nombres ou lettres seulement','required'=>'required','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_submit(array('type'=>'submit','value'=> 'Se connecter','class'=>'btn btn-success')).'<BR>';
                        echo form_close();
                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>