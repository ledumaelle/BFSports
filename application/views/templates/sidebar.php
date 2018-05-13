<!DOCTYPE html>
<html>
    <head>
        <title> Nouveautés </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
        <div class="sidebar">
            <table class="table">
                <h3>Nouveautés: </h3>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Libellé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lesProduits as $unProduit):
                        echo  '<tr>  
                            <td class="col-sm-2"> <img  width="50%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h5>'.anchor('visiteur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h5></td>
                            <td class="col-sm-2">' .$unProduit['LIBELLE'].'</td>
                        </tr>';
                    endforeach ?>  
                </tbody>
            </table>
        </div>
    <body>
    </body>
</html>
