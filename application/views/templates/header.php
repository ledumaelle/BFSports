<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo css_url('style') ?>"> <!-- css -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    <header>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <!-- Afficher un logo <a class="navbar-brand" ><img src=" <?php echo img_url('logo.jpg') ?>" class="img-rounded" width="3%"/></a> -->
                    <a class="navbar-brand" href="<?php echo site_url('visiteur/afficherInfosSite') ?>"> BF SPORTS </a> <!-- lien sur l'entrep -->
                </div>
                <ul class="nav navbar-nav">
                    <?php if ($this->session->statut=="administrateur") : ?>
                        <li class="active"><a href=" <?php echo site_url('visiteur/afficherAccueil') ?> "> Accueil</a></li> 
                        <li><a href=" <?php echo site_url('administrateur/afficherBoutique') ?> ">Boutique</a></li>
                        <li><a href="<?php echo site_url('administrateur/afficherClient') ?>">Client</a></li>
                        <li><a href="<?php echo site_url('administrateur/afficherCommande') ?>">Commande</a></li>
                        <form class="navbar-form navbar-left" action="<?php echo site_url('administrateur/afficherBoutiqueRecherche') ?>" method="GET" accept-charset="UTF-8" name="SearchWords">
                            <div class="form-group">
                                <input type="keywords" class="form-control" autocomplete="off" placeholder="Rechercher un produit" name="search">
                                <input type="submit" class="btn btn-warning">
                            </div>
                        </form>
                    <?php else : ?>    
                        <li class="active"><a href=" <?php echo site_url('visiteur/afficherAccueil') ?> "> Accueil</a></li> 
                        <li><a href=" <?php echo site_url('visiteur/afficherBoutique') ?>">Boutique</a></li>
                        <li><a href="<?php echo site_url('visiteur/afficherPanier') ?> ">Panier</a></li>
                        <form class="navbar-form navbar-left" action="<?php echo site_url('visiteur/afficherBoutiqueRecherche') ?>" method="GET" accept-charset="UTF-8" name="SearchWords">
                            <div class="form-group">
                                <input type="keywords" class="form-control" autocomplete="off" placeholder="RECHERCHER" name="search">
                                <input type="submit" class="btn btn-warning" value="Rechercher">
                            </div>
                        </form>
                    <?php endif; ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if(!is_null($this->session->identifiant)) : ?>
                        <?php if ($this->session->statut=="client") : ?>
                            <li><a href="<?php echo site_url('visiteur/afficherProfil') ?>"><?php echo 'Utilisateur connecté : '.$this->session->identifiant ?></a></li> <!-- pour avoir la couleur mettre balise <a> -->
                            <li><a href="<?php echo site_url('visiteur/seDeconnecter') ?>"><span class="glyphicon glyphicon-log-in"></span> Se Déconnecter</a></li>
                        <?php elseif ($this->session->statut=="administrateur") : ?>
                            <li><a href="<?php echo site_url('administrateur/afficherProfil') ?>"><?php echo 'Utilisateur connecté : '.$this->session->identifiant ?></a></li> <!-- pour avoir la couleur mettre balise <a> -->
                            <li><a href="<?php echo site_url('administrateur/seDeconnecter') ?>"><span class="glyphicon glyphicon-log-in"></span> Se Déconnecter</a></li>
                        <?php endif; ?>
                    <?php else : ?>
                        <li><a href=" <?php echo site_url('visiteur/sInscrire') ?>"><span class="glyphicon glyphicon-user"></span> S'Inscrire</a></li>
                        <li><a href="<?php echo site_url('visiteur/seConnecter') ?>"><span class="glyphicon glyphicon-log-in"></span> Se Connecter</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav> 
    </header>
    <body>
    </body>
</html>   