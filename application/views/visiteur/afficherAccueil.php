<!DOCTYPE html>
<html>
    <head>
        <title> Accueil </title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
            <h3>Bienvenue sur notre site marchand, faites-vous plaisir ! </h3> </br>
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