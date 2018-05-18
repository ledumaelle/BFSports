<!DOCTYPE html>
<html>
    <head>
        <title> Accessoire de frappe </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                    <div class="col-sm-1">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Catégories
                            <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('visiteur/afficherBoutique') ?> ">Tous</a></li>
                                    <li><a href="<?php echo site_url('visiteur/afficherBoutiqueParEquipement/1') ?> ">Equipement</a></li>
                                    <li><a href="<?php echo site_url('visiteur/afficherBoutiqueParTextile/2') ?> "> Textile</a></li> 
                                    <li><a href="<?php echo site_url('visiteur/afficherBoutiqueParAccessoire/3') ?> ">Accessoire de frappe </a></li>
                                </ul>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <a href="<?php echo site_url('visiteur/afficherBoutiqueParNouveautes') ?>" class="btn btn-primary" >Nouveautés</a>
                    </div>
               
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    
                </div>
                <div class="col-sm-6">
                    <img src=" <?php echo img_url('accessoireDeFrappe.jpg') ?>" width="100%" height="35%"/>
                </div>
                <div class="col-sm-3">
                    
                </div>
            </div>
        </div>
        <br/>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <img src=" <?php echo img_url('logo.jpg') ?>" height="25%"/></a>
                </div>
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Marque</th>
                                </tr>
                            </thead>
                            <tbody>
                
                            <?php foreach ($lesProduits as $unProduit):
                                    echo  '<tr>  
                                        <td class="col-sm-2"> <img  width="35%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h5>'.anchor('visiteur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h5></td>
                                        <td class="col-sm-1">' .(($unProduit['PRIXHT'])*(1+ ($unProduit['TAUXTVA']/100))).'€</td>
                                        <td class="col-sm-1">' .$unProduit['NOMMARQUE'].'</td>
                                    </tr>';
                                endforeach ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-2">
                    <img src=" <?php echo img_url('boutiqueCoteDroit.jpg') ?>" height="50%"/></a>
                </div>
            </div>
        </div>
            <p>Pour avoir afficher le détail d'un produit, cliquer sur son titre</p> 
    </body>
</html>
