<!DOCTYPE html>
<html>
    <head>
        <title> Boutique </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
    <a href="<?php echo site_url('administrateur/ajouterUnClient') ?> "><h3 class="text-success">Ajouter un client</h3></a> 
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Email</th>
                        <th>Mot De Passe</th>
                        <th>Profil</th>
                        <th>Modifications</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($lesClients as $unClient):
                        // foreach ($lesMarques as $uneMarque):
                        echo '<tr>  
                            <td>'.$unClient['NOM'].'</td>
                            <td>' .$unClient['PRENOM'].'</td>
                            <td>' .$unClient['ADRESSE'].'</td>
                            <td>' .$unClient['VILLE'].'</td>
                            <td>' .$unClient['CODEPOSTAL'].'</td>
                            <td>' .$unClient['EMAIL'].'</td>
                            <td>' .$unClient['MOTDEPASSE'].'</td>
                            <td>' .$unClient['PROFIL'].'</td>
                             <td>'.anchor('administrateur/modifierUnClient/'.$unClient['NOCLIENT'], 'Modifier un client').'</td>
                        </tr>';
                    // ; ferme le echo
                    endforeach ?>   
                </tbody>
            </table>
        </div>
    </body>
    <!-- <td> <a href="'.site_url('administrateur/modifierUnClient/'.$unClient['NOCLIENT']).'">Modifier un Client</a></td>  -->
</html>

