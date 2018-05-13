<!DOCTYPE html>
<html>
    <head>
        <title> Commande </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> Type d'état 
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo site_url('administrateur/afficherCommande') ?> ">Toutes</a></li>
                                <li><a href="<?php echo site_url('administrateur/afficherCommandeParEtat/NonTraitee') ?> "> Non traitée </a></li>
                                <li><a href="<?php echo site_url('administrateur/afficherCommandeParEtat/EnCoursDeTraitement') ?> "> En cours de traitement </a></li> 
                                <li><a href="<?php echo site_url('administrateur/afficherCommandeParEtat/Traitee') ?> "> Traitée </a></li>
                            </ul>
                    </div>
                </div>
                <div class="col-sm-1">
                <a href="<?php echo site_url('administrateur/ajouterUneCommande') ?> " class="btn btn-primary dropdown-toggle" role="button"> Ajouter une commande</a>
                </div>
            </div>
        </div>
    <div class="container-fluid">
        <div class="row">
        <div class="col-sm-7">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Numéro commande</th>
                        <th>Nom du client</th>
                        <th>Prénom du client</th>
                        <th>Date de la commande </th>
                        <th>Date de traitement </th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($lesCommandes as $uneCommande):
                    $dateCommande = new DateTime($uneCommande['DATECOMMANDE']);
                    if ($uneCommande['DATETRAITEMENT']==null) : $traitement="Non traitée"; else: 
                        $dateTraitement = new DateTime($uneCommande['DATETRAITEMENT']); $traitement=$dateTraitement->format('d/m/Y');  endif;
                        echo '<tr>  
                        <td class="col-sm-2">' .anchor('administrateur/voirUneCommande/'.$uneCommande['NOCOMMANDE'], "Numéro : ".$uneCommande['NOCOMMANDE']).'</td>
                            <td>'.$uneCommande['NOM'].'</td>
                            <td>'.$uneCommande['PRENOM'].'</td>
                            <td>' .$dateCommande->format('d/m/Y').'</td>
                            <td>' .$traitement.'</td>
                            <td>' .$uneCommande['Total']. '</td>
                        </tr>';
                    // ; ferme le echo
                    endforeach ?>   
                </tbody>
            </table>
            </div>
            </div>
            </div>
        </div>
    </body>
</html>

