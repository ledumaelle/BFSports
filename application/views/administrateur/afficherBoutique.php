<!DOCTYPE html>
<html>
    <head>
        <title> Boutique </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
    <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ajouter
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('administrateur/ajouterUnProduit') ?> ">Un produit</a></li>
                                    <li><a href="<?php echo site_url('administrateur/ajouterUneMarque') ?> ">Une marque</a></li>
                                    <li><a href="<?php echo site_url('administrateur/ajouterUneCategorie') ?> ">Une catégorie</a></li>
                                </ul>
                        </div>
                    
                </div>
            </div>
        </div>
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1">
                </div>
                <div class="col-sm-10">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>    
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Disponible</th>
                                    <th>Marque</th>
                                    <th>Catégorie</th>
                                    <th>Modifications</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lesProduits as $unProduit) :
                                $unProduit = json_decode(json_encode($unProduit), True);
                                if ($unProduit["DISPONIBLE"]=="1") : $disponiblite= "En Stock"; else : $disponiblite ="Non disponible"; endif;
                                echo '<tr>  
                                    <td class="col-sm-2"> <img  width="50%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h4>'.anchor('administrateur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h4></td>
                                    <td class="col-sm-1">' .(($unProduit['PRIXHT'])*(1+ ($unProduit['TAUXTVA']/100))).'€</td>
                                    <td class="col-sm-1">' .$unProduit['QUANTITEENSTOCK']./*$quantite */'</td>
                                    <td class="col-sm-1">' .$disponiblite. '</td>
                                    <td class="col-sm-1">' .$unProduit['NOMMARQUE'].'</td>
                                    <td class="col-sm-1">' .$unProduit['LIBELLECATEGORIE'].'</td>
                                    <td class="col-sm-1"> <a href="'.site_url('administrateur/modifierUnProduit/'.$unProduit['NOPRODUIT']).'">Modifier un produit</a></td>
                                </tr>';
                                endforeach ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-1">
                </div>
            </div>
        </div>
            <p>Pour avoir afficher le détail d'un Produit, cliquer sur son titre</p> 
            <p><?php echo $liensPagination; ?></p>
    </body>
</html>