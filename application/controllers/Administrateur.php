<?php
class Administrateur extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('assets'); // helper 'assets' ajouté a Application
        $this->load->model('ModeleProduit');
        $this->load->model('ModeleClient');
        $this->load->model('ModeleMarque');
        $this->load->model('ModeleCategorie');
        $this->load->model('ModeleCommande');
        $this->load->model('ModeleLigne');
        $this->load->library("pagination");
        /* les méthodes du contrôleur Administrateur doivent n'être
        accessibles qu'à l'administrateur (Nota Bene : a chaque appel
        d'une méthode d'Administrateur on a appel d'abord du constructeur */
        $this->load->library('session');
        if ($this->session->statut=='client') // client : statut client
        {
            $this->load->helper('url'); // pour utiliser redirect
            redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
        }
    } // __construct

    public function afficherAccueil()
    {
        //lol 
        $this->load->view('templates/header');
        $this->load->view('administrateur/afficherAccueil');
        $this->load->view('templates/footer');
    }
    public function afficherCommande()
    {
        $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandeHistorique();
		$DonneesInjectees['TitreDeLaPage'] = 'Commande';
		$this->load->view('templates/header');
		$this->load->view('administrateur/afficherCommande', $DonneesInjectees);
		$this->load->view('templates/footer');
    }

    public function voirUneCommande($noCommande = NULL) // valeur par défaut de noProduit = NULL
    {
        $DonneesInjectees['uneCommande'] = $this->ModeleCommande->retournerCommande($noCommande);
        if (empty($DonneesInjectees['uneCommande']))
        {   // pas de produit correspondant au n°
        show_404();
        }
        $DonneesInjectees['lesLignes'] = $this->ModeleLigne->retournerHistoriqueLignes($noCommande);
        $this->load->view('templates/header');
        $this->load->view('administrateur/voirUneCommande', $DonneesInjectees);
        $this->load->view('templates/footer');
    }

    public function afficherCommandeParEtat($Etat = NULL)
    {
        if ($Etat=="NonTraitee")
        {
            $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandeEtat($Etat);
            $this->load->view('templates/header');
            $this->load->view('administrateur/afficherCommandeNonTraitee', $DonneesInjectees);
            $this->load->view('templates/footer');

        }
        elseif ($Etat=="EnCoursDeTraitement")
        {
            $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandeEtat($Etat);
            $this->load->view('templates/header');
            $this->load->view('administrateur/afficherCommandeEnCoursDeTraitement', $DonneesInjectees);
            $this->load->view('templates/footer');
        }    
        elseif ($Etat=="Traitee")
        {
            $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandeEtat($Etat);
            $this->load->view('templates/header');
            $this->load->view('administrateur/afficherCommandeTraitee', $DonneesInjectees);
            $this->load->view('templates/footer');
        }    
    }

    public function afficherBoutique() 
	{
		// les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('administrateur/afficherBoutique');
		$config["total_rows"] = $this->ModeleProduit->nombreDeProduitsAdmin();
		$config["per_page"] = 3; // nombre d'articles par page
		$config["uri_segment"] = 3; /* le n° de la page sera placé sur le segment n°3 de URI,
		pour la page 4 on aura : visiteur/listerLesArticlesAvecPagination/4   */
		$config['first_link'] = 'Premier';
		$config['last_link'] = 'Dernier';
		$config['next_link'] = 'Suivant';
		$config['prev_link'] = 'Précédent';
		$this->pagination->initialize($config);
		$noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		/* on récupère le n° de la page - segment 3 - si ce segment est vide, cas du premier appel
		de la méthode, on affecte 0 à $noPage */
        $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsLimiteAdmin($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("administrateur/afficherBoutique", $DonneesInjectees);
		$this->load->view('templates/footer');
  } // fin listerLesArticlesAvecPagination
  

    public function ajouterUnProduit()
    {
        $this->load->helper('form');
        $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un produit';
        $DonneesInjectees['lesMarques'] = $this->ModeleMarque->retournerMarque(); 
        $DonneesInjectees['lesCategories'] = $this->ModeleCategorie->retournerCategorie();
        if ($this->input->post('btnAjouterProduit')) // On test si le formulaire a été posté.
        {
            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
            $donneesAInserer = array(
                'LIBELLE' => $this->input->post('txtLibelle'),
                'DETAIL' => $this->input->post('txtDetail'),
                'PRIXHT' => $this->input->post('txtPrixHT'),
                'TAUXTVA' => $this->input->post('dpdnTauxTVA'),
                'NOMIMAGE' => $this->input->post('txtNomFichierImage'),
                'QUANTITEENSTOCK' => $this->input->post('txtQuantiteStock'),
                'DATEAJOUT' => $this->input->post('date'),
                'DISPONIBLE' => $this->input->post('dpdnDisponible'),
                'NOMARQUE'=>$this->input->post('dpdnNoMarque'),
                'NOCATEGORIE'=>$this->input->post('dpdnNoCategorie'),
            ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
            $this->ModeleProduit->insererUnProduit($donneesAInserer); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            $this->load->view('templates/header');
            redirect('administrateur/afficherBoutique');
            $this->load->view('templates/footer');
        }
        else
        {  
          /* si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire */
          $this->load->view('templates/header');
          $this->load->view('administrateur/ajouterUnProduit', $DonneesInjectees);
          $this->load->view('templates/footer');
        }
    } // ajouterUnProduit

    public function ajouterUnClient()
    {
        $this->load->helper('form');
        $DonneesInjectees['TitreDeLaPage'] = 'Ajouter un Client';
        if ($this->input->post('btnAjouterClient')) // On test si le formulaire a été posté.
        {
            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
            $donneesAInserer = array(
                'NOM' => $this->input->post('txtNom'),
                'PRENOM' => $this->input->post('txtPrenom'),
                'ADRESSE' => $this->input->post('txtAdresse'),
                'VILLE' => $this->input->post('txtVille'),
                'CODEPOSTAL' => $this->input->post('txtCodePostal'),
                'EMAIL' => $this->input->post('txtIdentifiant'),
                'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
                'PROFIL' => $this->input->post('txtProfil'),
            ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
            $this->ModeleClient->insererUnClient($donneesAInserer); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            $this->load->view('templates/header');
            redirect('administrateur/afficherClient');
            $this->load->view('templates/footer');
        }
        else
        {  
          /* si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire */
          $this->load->view('templates/header');
          $this->load->view('administrateur/ajouterUnClient', $DonneesInjectees);
          $this->load->view('templates/footer');
        }
    } // ajouterUnProduit

    public function modifierUnProduit($noProduit=NULL)
    {
        $this->load->helper('form');
        $this->load->helper('date');
        $DonneesInjectees['TitreDeLaPage']='Modifier un Produit';
        $DonneesInjectees['unProduit'] = $this->ModeleProduit->retournerProduitsAdmin($noProduit); 
        $DonneesInjectees['lesMarques'] = $this->ModeleMarque->retournerMarque(); 
        $DonneesInjectees['lesCategories'] = $this->ModeleCategorie->retournerCategorie();
        if (isset($DonnesInjectees['unProduit']))
        {
            show_404();
        }
        if ($this->input->post('btnModifierProduit')) // On test si le formulaire a été posté.
        {
            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
            $donneesAModifier = array(
                'LIBELLE' => $this->input->post('txtLibelle'),
                'DETAIL' => $this->input->post('txtDetail'),
                'PRIXHT' => $this->input->post('txtPrixHT'),
                'TAUXTVA' => $this->input->post('dpdnTauxTVA'),
                'NOMIMAGE' => $this->input->post('txtNomFichierImage'),
                'QUANTITEENSTOCK' => $this->input->post('txtQuantiteStock'),
                'DATEAJOUT' => $this->input->post('date'),
                'DISPONIBLE' => $this->input->post('dpdnDisponible'),
                'NOMARQUE'=>$this->input->post('dpdnNoMarque'),
                'NOCATEGORIE'=>$this->input->post('dpdnNoCategorie'),
            ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
            $this->ModeleProduit->modifierUnProduit($donneesAModifier,$noProduit); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            $this->load->view('templates/header');
            redirect('administrateur/afficherBoutique');
            $this->load->view('templates/footer');
        }
        else
        {  
          /* si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire */
          $this->load->view('templates/header');
          $this->load->view('administrateur/modifierUnProduit', $DonneesInjectees);
          $this->load->view('templates/footer');
        }
    } // modifierProduit

    public function modifierUnClient($noClient = NULL)
    {
        $this->load->helper('form');
        $DonneesInjectees['TitreDeLaPage']='Modifier un Client';
        $DonneesInjectees['unClient'] = $this->ModeleClient->retournerClients($noClient);
        if (isset($DonnesInjectees['unClient']))
        {
            show_404();
        }
        if ($this->input->post('boutonModifierClient')) // On test si le formulaire a été posté.
        {
            // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
            $donneesAModifier = array(
                'NOM' => $this->input->post('txtNom'),
                'PRENOM' => $this->input->post('txtPrenom'),
                'ADRESSE' => $this->input->post('txtAdresse'),
                'VILLE' => $this->input->post('txtVille'),
                'CODEPOSTAL' => $this->input->post('txtCodePostal'),
                'EMAIL' => $this->input->post('txtIdentifiant'),
                'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
                'PROFIL' =>  $this->input->post('txtProfil'),
            ); // cTitre, cTexte, cNomFichierImage : champs de la table tabarticle
            $this->ModeleClient->modifierUnClient($donneesAModifier,$noClient); // appel du modèle
            $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
            $this->load->view('templates/header');
            redirect('administrateur/afficherClient');
            $this->load->view('templates/footer');
        }
        else
        {  
          /* si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire */
          $this->load->view('templates/header');
          $this->load->view('administrateur/modifierUnClient', $DonneesInjectees);
          $this->load->view('templates/footer');
        }
    } // aj

    public function afficherBoutiqueRecherche($Recherche=NULL) // afficher l'accueil
	{
        $Recherche=$_GET['search'];
        $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsRechercheAdmin($Recherche);
		$DonneesInjectees['TitreDeLaPage'] = 'Résultat de votre recherche';
		$this->load->view('templates/header');
		$this->load->view('administrateur/afficherBoutiqueRecherche', $DonneesInjectees);
		$this->load->view('templates/footer');
    
    } // recherche du produit

    public function supprimerUnClient($noClient=NULL)
    {
        $DonneesInjectees['unClient'] = $this->ModeleClient->supprimerUnClient($noClient);
		redirect('administrateur/afficherClient');
    }
    public function voirUnProduit($noProduit = NULL) // valeur par défaut de noProduit = NULL
    {
        $DonneesInjectees['unProduit'] = $this->ModeleProduit->retournerProduitsAdmin($noProduit);
        if (empty($DonneesInjectees['unProduit']))
        {   // pas d'article correspondant au n°
        show_404();
        }
        $DonneesInjectees['TitreDeLaPage'] = 'Détails du produit';
        // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
        $this->load->view('templates/header');
        $this->load->view('administrateur/voirUnProduit', $DonneesInjectees);
        $this->load->view('templates/footer');
    } // voirUnProduit

    public function afficherCommandePagination() //FAIRE LA PAGINATION DES COMMANDES 
	{
		// les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('administrateur/afficherCommandePagination');
		$config["total_rows"] = $this->ModeleProduit->nombreDeCommandesAdmin();
		$config["per_page"] = 3; // nombre d'articles par page
		$config["uri_segment"] = 3; /* le n° de la page sera placé sur le segment n°3 de URI,
		pour la page 4 on aura : visiteur/listerLesArticlesAvecPagination/4   */
		$config['first_link'] = 'Premier';
		$config['last_link'] = 'Dernier';
		$config['next_link'] = 'Suivant';
		$config['prev_link'] = 'Précédent';
		$this->pagination->initialize($config);
		$noPage = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		/* on récupère le n° de la page - segment 3 - si ce segment est vide, cas du premier appel
		de la méthode, on affecte 0 à $noPage */
        $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsLimiteAdmin($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("administrateur/afficherBoutique", $DonneesInjectees);
		$this->load->view('templates/footer');
  } // fin listerLesArticlesAvecPagination

    public function afficherProfil() // afficher l'accueil
	{
    if (!is_null($this->session->identifiant)) // s'il y a une session ouverte
    {
      $Id=$this->session->id;
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Profil';
      $DonneesInjectees['UnClient'] = $this->ModeleClient->retournerClients($Id);
      if ($this->input->post('boutonModifierProfil')) // On test si le formulaire a été posté.
      {
        // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
        $donneesAModifier = array(
        'NOM' => $this->input->post('txtNom'),
        'PRENOM' => $this->input->post('txtPrenom'),
        'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
        ); 
        
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $Administrateur = array( // EMAIL, MOTDEPASSE : champs de la table Client
        'EMAIL' => $this->input->post('txtIdentifiant'),
        'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
        ); // on récupère les données du formulaire de connexion
        // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
        $AdministrateurtRetourne = $this->ModeleClient->retournerClient($Administrateur);
        $this->ModeleClient->modifierUnClient($donneesAModifier,$Id); // appel du modèle
        $this->load->view('templates/header');
        $this->load->view('visiteur/afficherAccueil', $DonneesInjectees);
        $this->load->view('templates/footer');
    }
    else
    {  
      // si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire 
      $this->load->view('templates/header');
      $this->load->view('administrateur/afficherProfil', $DonneesInjectees);
      $this->load->view('templates/footer');
    }
       
    }
    else
    {
      $this->load->helper('url'); // pour utiliser redirect
      redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
    }
    
    
  } // afficher l'acceuil
    public function afficherClient()
    {
        $DonneesInjectees['lesClients'] = $this->ModeleClient->retournerClients();
		$DonneesInjectees['TitreDeLaPage'] = 'Client';
		$this->load->view('templates/header');
		$this->load->view('administrateur/afficherClient', $DonneesInjectees);
		$this->load->view('templates/footer');
    }

    public function seDeconnecter() 
    {
        // destruction de la session = déconnexion
        $this->session->sess_destroy();
        $this->load->view('templates/header');
        $this->load->helper('url');
       redirect('visiteur/afficherAccueil');
        $this->load->view('templates/footer');
    }
}