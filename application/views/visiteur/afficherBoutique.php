<!DOCTYPE html>
<html>
    <head>
        <title> Boutique </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <header>
        <div class="container-fluid">
                    <ul class="list-inline">
                        <li><a href=" <?php echo site_url('administrateur/afficherBoutiqueParCategorie') ?> "><h2 class="text-warning">Catégorie</h2></a></li>
                        <li><a href="<?php echo site_url('administrateur/afficherBoutiqueParNouveautes') ?> "><h2 class="text-warning">Nouveautés</h2></a></li>
                        <li><a href="<?php echo site_url('administrateur/afficherBoutiqueParMarque') ?> "><h2 class="text-warning">Marque</h2></a></li>
                    </ul>
        </div>
    </div>
    </header>
    <body>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Disponible</th>
                        <th>Marque</th>
                        <th>Catégorie</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($lesProduits as $unProduit):
                        // foreach ($lesMarques as $uneMarque):
                       echo  '<tr>  
                            <td> <img  width="25%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h4>'.anchor('visiteur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h4></td>
                            <td>' .$unProduit['LIBELLE'].'</td>
                            <td>' .$unProduit['PRIXHT'].'</td>
                            <td>' .$unProduit['QUANTITEENSTOCK'].'</td>
                            <td>' .$unProduit['DISPONIBLE'].'</td>
                            <td>' .$unProduit['NOMARQUE'].'</td>
                            <td>' .$unProduit['NOCATEGORIE'].'</td>
                        </tr>';
                    // ; ferme le echo
                    endforeach ?>   
                </tbody>
            </table>
        </div>
            <p>Pour avoir afficher le détail d'un produit, cliquer sur son titre</p> 
    </body>
</html>





