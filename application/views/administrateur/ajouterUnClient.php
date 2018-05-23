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
                        if ($unClient==null):
                            $unClient['NOM']=null;
                            $unClient['PRENOM']=null;
                            $unClient['ADRESSE']=null;
                            $unClient['CODEPOSTAL']=null;
                            $unClient['VILLE']=null;
                            $unClient['EMAIL']=null;
                            $unClient['MOTDEPASSE']=null;
                            $unClient['PROFIL']=null;
                        else:?>
                            <div class="container">
                                <div class="alert alert-warning">
                                    <strong>Erreur !</strong> Le login existe déjà veuillez en choisir un autre svp !
                                </div>
                            </div>
                        <?php endif;
                        echo form_open('administrateur/ajouterUnClient');

                        echo form_label('Nom ','lblNom'); // creation d'un label devant la zone de saisie
                        echo form_input(array('required'=>'required','pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','type'=>'text','value'=>$unClient['NOM'],'name'=>'txtNom','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un nom')).'<BR>';

                        echo form_label('Prénom ','lblPrenom');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','value'=>$unClient['PRENOM'],'name'=>'txtPrenom','type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez un prénom')).'<BR>';

                        echo form_label('Adresse ','lblAdresse');
                        echo form_input(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtAdresse','value'=>$unClient['ADRESSE'],'type'=>'text','title'=>'Lettres et nombres seulement','class'=>'form-control','maxlength'=>'128','placeholder'=>'Entrez une adresse')).'<BR>';
                        
                        echo form_label('Code Postal ','lblCodePostal');
                        echo form_input(array('pattern'=>'[0-9]{5}','name'=>'txtCodePostal','type'=>'text','title'=>'Nombres seulement','value'=>$unClient['CODEPOSTAL'],'class'=>'form-control','maxlength'=>'5','placeholder'=>'Entrez un code postal')).'<BR>';

                        echo form_label('Ville ','lblVille');
                        echo form_input(array('pattern'=>'^[a-zA-Z][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','name'=>'txtVille','value'=>$unClient['VILLE'],'type'=>'text','title'=>'Lettres seulement','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une ville')).'<BR>';

                        echo form_label('Identifiant ','lblIdentifiant'); 
                        echo form_input(array('required'=>'required','type'=>'email','name'=>'txtIdentifiant','title'=>'Email seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un email')).' <BR>';

                        echo form_label('Mot de passe ','lblMotDePasse');
                        echo form_password(array('pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','required'=>'required','value'=>$unClient['MOTDEPASSE'],'name'=>'txtMotDePasse','type'=>'pwd','title'=>'Nombres ou lettres seulement','class'=>'form-control','maxlength'=>'30','placeholder'=>'Entrez un mot de passe')).'<BR>';

                        echo form_label('Profil ','lblProfil');
                        echo form_input(array('pattern'=>'^[a-z]+$','required'=>'required','name'=>'txtProfil','type'=>'text','value'=>$unClient['PROFIL'],'title'=>'(client/administrateur))','class'=>'form-control','maxlength'=>'14','placeholder'=>'(client/administrateur)')).'<BR>';
                        
                        echo form_submit(array('type'=>'submit','name'=>'btnAjouterClient','value'=> 'Ajouter','class'=>'btn btn-success')).'<BR>';

                        echo form_close();

                    ?>
                </div> 
            </div>
        </div>
    </body>
</html>