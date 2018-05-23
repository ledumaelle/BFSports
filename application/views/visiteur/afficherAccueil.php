<!DOCTYPE html>
<html>
    <head>
        <title> Accueil </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo img_url('carousel1.jpg') ?>"  alt="carousel1" width="100%">
                    <div class="carousel-caption">
                        <h3>Bienvenue sur BFSports.com </h3>
                        <p>Faites-vous plaisir !</p>
                    </div>
                </div>
<!-- href="<?php echo site_url('visiteur/voirUnProduit/'.$meilleurProduit['NOPRODUIT']) ?>" -->
                <div class="item">
                    <div class="item active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-7">
                                    <img src="<?php echo img_url($meilleurProduit["NOMIMAGE"]) ?>"  alt="MeilleurProduitVendu" width="47%"  align="middle">
                                    <div class="carousel-caption">
                                        <h3> <?php echo $meilleurProduit["LIBELLE"] ?></h3>
                                        <p>Meilleur Produit Vendu</p>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <div class="item active">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-2">
                                </div>
                                <div class="col-sm-8">
                                    <img src="<?php echo img_url('carousel3.jpg') ?>" alt="carousel3" width="100%" >
                                    <div class="carousel-caption">
                                        <h3>La boxe française au féminin</h3>
                                        <p> Et oui ce n'est pas réservé qu'aux hommes ! </p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container-fluid">
            <div class="row">
            </br> </br>
                <div class="col-sm-1">
                    
                </div>
                <div class="col-sm-5">
                    <img src=" <?php echo img_url('boxeFrancaiseAccueil.jpg') ?>" class="img-rounded" width="75%"/> 
                </div>
                <div class="col-sm-6">
                    <div class="sidebar">
                    <h3 class="text-danger"> Nouveautés: </h3> <br/>
                    <table>
                        <?php foreach ($lesProduits as $unProduit):
                            echo  '<tr>  
                                <td class="col-sm-1"> <img  width="25%" src="'. img_url($unProduit['NOMIMAGE']) .'"/> <h5>'.anchor('visiteur/voirUnProduit/'.$unProduit['NOPRODUIT'],$unProduit['LIBELLE']).'</h5></td>
                            </tr>';
                        endforeach ?>  
                    </table>
                </div>
            </div>
        </div> 
    </body>
</html>