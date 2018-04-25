<!DOCTYPE html>
<html>
    <head>
        <title> Boutique </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
    <a href="<?php echo site_url('administrateur/ajouterUnProduit') ?> "><h3 class="text-success">Ajouter un produit</h3></a> 
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
                        <th>Modifications</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php foreach ($lesProduits as $unProduit):
                        // foreach ($lesMarques as $uneMarque):
                        echo '<tr>  
                            <td> <img  width="25%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h4>'.anchor('administrateur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h4></td>
                            <td>' .$unProduit['LIBELLE'].'</td>
                            <td>' .$unProduit['PRIXHT'].'</td>
                            <td>' .$unProduit['QUANTITEENSTOCK'].'</td>
                            <td>' .$unProduit['DISPONIBLE'].'</td>
                            <td>' .$unProduit['NOMARQUE'].'</td>
                            <td>' .$unProduit['NOCATEGORIE'].'</td>
                            <td> <a href="'.site_url('administrateur/modifierUnProduit/'.$unProduit['NOPRODUIT']).'">Modifier un produit</a></td>
                            </tr>';
                    // ; ferme le echo
                    endforeach ?>   
                </tbody>
            </table>
        </div>
            <p>Pour avoir afficher le détail d'un Produit, cliquer sur son titre</p> 
    </body>
</html>