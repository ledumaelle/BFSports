<!DOCTYPE html>
<html>
    <head>
        <title> Panier </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        
    <body>
    
        <div class="container-fluid">
        <h2 class="text-success"> <?php echo $TitreDeLaPage ?> </h2><br/>
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
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
                                    <th>Modifications</th>

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
                                        <td class="col-sm-2"> <script type="text/javascript" src="http://www.tondomaine.com/lien.js"></script>'
 
                                        .anchor('visiteur/supprimerPanier/'.$uneLigne['NOCOMMANDE'].'/'.$uneLigne['NOPRODUIT'], 'Supprimer le produit').'</td>
                                    </tr>';
                                    // .anchor('visiteur/modifierPanier/'.$uneLigne['NOCOMMANDE'].'/'.$uneLigne['NOPRODUIT'], 'Modifier la quantité').' <br/>'
                                endforeach ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-1">
                </div>   
            </div> 
            <div class="row">
                <div class="col-sm-8">
                </div> 
                <div class="col-sm-4">
                    <h3 class="text-primary">Somme total du panier: </h3> <?php echo $totalPanier['Total'] ; ?>
                </div>                      
            </div>
        </div>
    </body>
</html> 


