<!DOCTYPE html>
<html>
    <head>
        <title> Ajouter une marque </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
    <?php
        if ($Erreur=='oui') : ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <div class="alert alert-warning">
                        <strong>Erreur !</strong> La marque existe déjà
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="text-success">Liste des marques</h2></br>
                    <ul class="list-group">
                        <?php
                        foreach ($lesMarques as $uneMarque) :
                            echo '<li class="list-group-item">'.$uneMarque['NOMMARQUE']. '</li>' ;
                        endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        </br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">            
                <?php echo form_open('administrateur/ajouterUneMarque');
                        
                echo form_label('Nom de la marque :  ','lblNomMarque'); // creation d'un label devant la zone de saisie
                echo form_input(array('required'=>'required','pattern'=>'^[a-zA-Z0-9][a-z A-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','type'=>'text','name'=>'txtNomMarque','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une nouvelle marque')).'<BR>';

                echo form_submit(array('type'=>'submit','name'=>'boutonAjouterMarque','value'=> 'Ajouter','class'=>'btn btn-info')).'<BR>';
                echo form_close();
                ?>
                </div>
            </div>
        </div>
        <?php echo '<p>'.anchor('administrateur/afficherBoutique','Retour à la liste des Produits').'</p>'; ?>
    </body>
</html>