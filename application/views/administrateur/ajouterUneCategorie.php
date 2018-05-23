<!DOCTYPE html>
<html>
    <head>
        <title> Ajouter une catégorie </title>
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
                        <strong>Erreur !</strong> La catégorie existe déjà
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <h2 class="text-success">Liste des catégories</h2></br>
                    <ul class="list-group">
                        <?php
                        foreach ($lesCategories as $uneCategorie) :
                            echo '<li class="list-group-item">'.$uneCategorie['LIBELLECATEGORIE']. '</li>' ;
                        endforeach ?>
                    </ul>
                </div>
            </div>
        </div>
        </br>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">            
                <?php echo form_open('administrateur/ajouterUneCategorie');
                        
                echo form_label('Nom de la catégorie :  ','lblNomCategoriee'); // creation d'un label devant la zone de saisie
                echo form_input(array('required'=>'required','pattern'=>'^[a-zA-Z0][a-z A-Záàâäãåçéèêëíìîïñóòôöõúùûüýÿ_-]+$','type'=>'text','name'=>'txtNomCategorie','class'=>'form-control','maxlength'=>'40','placeholder'=>'Entrez une nouvelle catégorie')).'<BR>';

                echo form_submit(array('type'=>'submit','name'=>'boutonAjouterCategorie','value'=> 'Ajouter','class'=>'btn btn-info')).'<BR>';
                echo form_close();
                ?>
                </div>
            </div>
        </div>
        <?php echo '<p>'.anchor('administrateur/afficherBoutique','Retour à la liste des Produits').'</p>'; ?>
    </body>
</html>