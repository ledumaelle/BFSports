<!DOCTYPE html>
<html>
    <head>
        <title> Détails de la commande </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <?php
                        echo '<h3> Numéro : '.$uneCommande['NOCOMMANDE'].'</h3></br>';
                        echo '<h4> Nom du client : </h4> '.$uneCommande['NOM'];
                        echo '<h4> Prénom du client : </h4>'.$uneCommande['PRENOM'];
                        echo ' <h4>Adresse de livraison :</h4> '.$uneCommande['ADRESSE']. ' </br>' .$uneCommande['VILLE']. ' </br>' .$uneCommande['CODEPOSTAL'];
                    ?>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Libellé</th>
                                    <th> Marque </th>
                                    <th> Catégorie </th>
                                    <th>Prix unité</th>
                                    <th>Quantité</th>
                                    <th>Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesLignes as $uneLigne):
                                    echo  '<tr>  
                                    <td class="col-sm-2"> <img  width="50%" src="'. img_url($uneLigne['NOMIMAGE']) .'"/></td>
                                    <td class="col-sm-2">' .$uneLigne['LIBELLE'].' </td>
                                    <td class="col-sm-1">' .$uneLigne['NOMMARQUE'].' </td>
                                    <td class="col-sm-1">' .$uneLigne['LIBELLECATEGORIE'].' </td>
                                    <td class="col-sm-1">' .(($uneLigne['PRIXHT'])*(1+ ($uneLigne['TAUXTVA']/100))).'€</td>
                                    <td class="col-sm-1">' .$uneLigne['QUANTITECOMMANDEE'].' </td>
                                    <td class="col-sm-1">' .(($uneLigne['PRIXHT'])*(1+ ($uneLigne['TAUXTVA']/100))) * $uneLigne['QUANTITECOMMANDEE'] .'€</td>
                                    </tr>';
                                endforeach ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                </div> 
                <div class="col-sm-4">
                    <h3 class="text-primary">Somme total du panier: </h3> <?php echo $uneCommande['Total'] ; ?>
                </div>                      
            </div>
                <?php
                    echo '<p>'.anchor('visiteur/afficherProfil','Retour à l\'historique des commandes').'</p>';
                ?>
        </div>
    </body>
</html>







