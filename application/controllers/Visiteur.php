<?php
class Visiteur extends CI_Controller
{
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
    $this->load->library('pagination');
    $this->load->library('session');
    $this->load->library('cart');
    $this->load->helper('url'); // pour utiliser redirect
    if ($this->session->statut=='administrateur') // client : statut client
    {
      $this->load->helper('url'); // pour utiliser redirect
      redirect('/administrateur/afficherAccueil'); // pas les droits : redirection vers connexion
    }
   } // __construct

  public function afficherAccueil() // afficher l'accueil
	{
    $this->load->view('templates/header');
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsNouveautes();
    $this->load->view('visiteur/afficherAccueil',$DonneesInjectees);
    $this->load->view('templates/footer');
    
  } // afficher l'accueil

  public function afficherInfosSite() // afficher l'accueil
	{
    $this->load->view('templates/header');
    $DonneesInjectees['TitreDeLaPage'] = 'Qui sommes-nous ?';
    $this->load->view('visiteur/afficherInfosSite',$DonneesInjectees);
    $this->load->view('templates/footer');
    
  } // afficher l'accueil

  public function afficherBoutique() 
	{
		// les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('visiteur/afficherBoutique');
		$config["total_rows"] = $this->ModeleProduit->nombreDeProduits();
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
    $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsLimite($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("visiteur/afficherBoutique", $DonneesInjectees);
		$this->load->view('templates/footer');
  } // fin listerLesArticlesAvecPagination
  
  public function afficherBoutiqueRecherche($Recherche=NULL) // afficher la boutique par rapport à la recherche
	{
    $Recherche=$_GET['search'];
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsRecherche($Recherche);
		$DonneesInjectees['TitreDeLaPage'] = 'Résultat de votre recherche';
		$this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueRecherche', $DonneesInjectees);
		$this->load->view('templates/footer'); 
  }
// A REVOIR SI PAS MIEUX afficherBoutiqueParCatégorie ??? 
  public function afficherBoutiqueParEquipement($noCategorie=NULL)
  {
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsCategorie($noCategorie);
    $this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueParEquipement', $DonneesInjectees);
		$this->load->view('templates/footer');
  }

  public function afficherBoutiqueParTextile($noCategorie=NULL)
  {
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsCategorie($noCategorie);
    $this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueParTextile', $DonneesInjectees);
		$this->load->view('templates/footer');
  }

  public function afficherBoutiqueParAccessoire($noCategorie=NULL)
  {
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsCategorie($noCategorie);
    $this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueParAccessoire', $DonneesInjectees);
		$this->load->view('templates/footer');
  }

  public function afficherBoutiqueParNouveautes()
  {
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsNouveautes();
    $DonneesInjectees['TitreDeLaPage'] = 'Nouveautés';
    $this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueParNouveautes', $DonneesInjectees);
		$this->load->view('templates/footer');
  }

  public function voirUnProduit($noProduit = NULL) // valeur par défaut de noProduit = NULL
  {
    $this->load->helper('form');
    $DonneesInjectees['unProduit'] = $this->ModeleProduit->retournerProduits($noProduit);
    if (empty($DonneesInjectees['unProduit']))
    {   // pas de produit correspondant au n°
      show_404();
    }
    $this->load->view('templates/header');
    $this->load->view('visiteur/voirUnProduit', $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function voirUneCommande($noCommande = NULL) // valeur par défaut de noProduit = NULL
  {
    $NoClient=$this->session->id;
    $DonneesInjectees['uneCommande'] = $this->ModeleCommande->retournerCommande($noCommande);
    if (empty($DonneesInjectees['uneCommande']))
    {   // pas de produit correspondant au n°
      show_404();
    }
    $DonneesInjectees['lesLignes'] = $this->ModeleLigne->retournerHistoriqueLignes($noCommande);
    $this->load->view('templates/header');
    $this->load->view('visiteur/voirUneCommande', $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function afficherProfil() // afficher l'accueil
	{
    $this->load->library('session');
    if (!is_null($this->session->identifiant)) // s'il y a une session ouverte
    {
      $NoClient=$this->session->id;
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Profil';
      $Etat="Traitee";
      $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandes($NoClient,$Etat);  
      $DonneesInjectees['UnClient'] = $this->ModeleClient->retournerClients($NoClient);
      if ($this->input->post('boutonModifierProfil')) // On test si le formulaire a été posté.
      {
        // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
        $donneesAModifier = array(
        'NOM' => $this->input->post('txtNom'),
        'PRENOM' => $this->input->post('txtPrenom'),
        'ADRESSE'=>$this->input->post('txtAdresse'),
        'VILLE'=>$this->input->post('txtVille'),
        'CODEPOSTAL'=>$this->input->post('txtCodePostal'),
        'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
        'PROFIL'=> 'client'
        ); 
        
        $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
        $Client = array( // EMAIL, MOTDEPASSE : champs de la table Client
        'EMAIL' => $this->input->post('txtIdentifiant'),
        'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
        ); // on récupère les données du formulaire de connexion
        // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
        $ClientRetourne = $this->ModeleClient->retournerClient($Client);
        $this->ModeleClient->modifierUnClient($donneesAModifier,$NoClient); // appel du modèle
        redirect('visiteur/afficherAccueil', $DonneesInjectees);
      }
      else
      {  
        // si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire 
        $this->load->view('templates/header');
        $this->load->view('visiteur/afficherProfil', $DonneesInjectees);
        $this->load->view('templates/footer');
      }
    }
    else
    {
      $this->load->helper('url'); // pour utiliser redirect
      redirect('visiteur/seConnecter'); // pas les droits : redirection vers connexion
    }
  }

  public function seConnecter()
  {
    $this->load->helper('form'); //faire helper form à chaque qu'on fait appel à un formulaire
    $DonneesInjectees['TitreDeLaPage'] = 'Se connecter';
    
    $Client = array( // EMAIL, MOTDEPASSE : champs de la table Client
    'EMAIL' => $this->input->post('txtIdentifiant'),
    'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
    ); // on récupère les données du formulaire de connexion
    // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
    $ClientRetourne = $this->ModeleClient->retournerClient($Client);
    if (!($ClientRetourne == null))
    {    // on a trouvé, identifiant et statut (droit) sont stockés en session
      $this->load->library('session');
      $this->session->identifiant = $ClientRetourne->EMAIL;
      $this->session->statut = $ClientRetourne->PROFIL;
      $this->session->id = $ClientRetourne->NOCLIENT;
      $DonneesInjectees['Identifiant'] = $Client['EMAIL'];
      if ($this->session->statut=='administrateur') // client : statut client
      {
          $this->load->helper('url'); // pour utiliser redirect
          $this->load->view('templates/header');
          redirect('/administrateur/afficherAccueil',$DonneesInjectees); // pas les droits : redirection vers connexion
          $this->load->view('templates/footer');
      }
      else
      {
        $this->load->view('templates/header');
        $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsNouveautes();
        redirect('visiteur/afficherAccueil', $DonneesInjectees);
        $this->load->view('templates/footer');
      }
      
    }
    else
    {    // utilisateur non trouvé on renvoie le formulaire de connexion
      $this->load->view('templates/header');
      $this->load->view('visiteur/seConnecter', $DonneesInjectees);
      $this->load->view('templates/footer');
    }  
  
  } // fin seConnecter
 
  public function sInscrire()
  {
    $this->load->helper('form');
    $DonneesInjectees['TitreDeLaPage'] = 'S\'inscrire';
    if ($this->input->post('boutonAjouter')) // On test si le formulaire a été posté.
    {
      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
      $donneesAInserer = array(
      'NOM' => $this->input->post('txtNom'),
      'PRENOM' => $this->input->post('txtPrenom'),
      'ADRESSE'=>$this->input->post('txtAdresse'),
      'VILLE'=>$this->input->post('txtVille'),
      'CODEPOSTAL'=>$this->input->post('txtCodePostal'),
      'EMAIL' => $this->input->post('txtIdentifiant'),
      'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
      'PROFIL' => 'client'
      ); 
    
      $this->ModeleClient->insererUnClient($donneesAInserer); // appel du modèle
      $this->load->helper('url'); // helper chargé pour utilisation de site_url (dans la vue)
      $Client = array( // EMAIL, MOTDEPASSE : champs de la table Client
        'EMAIL' => $this->input->post('txtIdentifiant'),
        'MOTDEPASSE' => $this->input->post('txtMotDePasse'),
        ); // on récupère les données du formulaire de connexion
        // on va chercher l'utilisateur correspondant aux Id et MdPasse saisis
        $ClientRetourne = $this->ModeleClient->retournerClient($Client);
        if (!($ClientRetourne == null))
        {    // on a trouvé, identifiant et statut (droit) sont stockés en session
          $this->load->library('session');
          $this->session->identifiant = $ClientRetourne->EMAIL;
          $this->session->statut = $ClientRetourne->PROFIL;
          $this->session->id = $ClientRetourne->NOCLIENT;
          $DonneesInjectees['Identifiant'] = $Client['EMAIL'];
          $this->load->view('templates/header');
          $this->load->view('visiteur/afficherAccueil', $DonneesInjectees);
          $this->load->view('templates/footer');
        }
        else
        {    // utilisateur non trouvé on renvoie le formulaire de connexion
          $this->load->view('templates/header');
          $this->load->view('visiteur/sInscrire', $DonneesInjectees);
          $this->load->view('templates/footer');
        }  
    }
    else
    {  
      // si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire 
      $this->load->view('templates/header');
      $this->load->view('visiteur/sInscrire', $DonneesInjectees);
      $this->load->view('templates/footer');
    }
  } // s'inscrire

  public function ajouterPanier($NoProduit=NULL)
  {
    $this->load->helper('form');
    if ($this->input->post('btnAjouterPanier')) // On test si le formulaire a été posté.
    {
      $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
      $PrixProduit = $ProduitRetourne['PRIXHT']*(1+ ($ProduitRetourne['TAUXTVA']/100));
      $NomProduit = $ProduitRetourne['LIBELLE'];
      $ImageProduit=$ProduitRetourne['NOMIMAGE'];
      $MarqueProduit=$ProduitRetourne['NOMMARQUE'];
      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
      $donneesAInserer = array(
        'id' => $NoProduit,
        'qty' => $this->input->post('txtQuantite'),
        'price'=> $PrixProduit,
        'name'=> $NomProduit,
        'option'=> $ImageProduit
      ); 
      $this->cart->insert($donneesAInserer);
      redirect('visiteur/afficherPanier');
    }
    else
    {  
      // si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire 
      $this->load->view('templates/header');
      $this->load->view('visiteur/voirUnProduit', $DonneesInjectees);
      $this->load->view('templates/footer');
    }
  }

  public function diminuerQuantite($rowid=NULL,$quantite=NULL)
  {
    $qte=$quantite-1;
    $this->load->helper('form');
    $donneesAModifier = array(
    'rowid' => $rowid,
    'qty'   => $qte
    );

    $this->cart->update($donneesAModifier);
    var_dump($donneesAModifier);
    redirect('visiteur/afficherPanier');
  }

  public function augmenterQuantite($rowid=NULL,$quantite=NULL)
  {
    $qte=$quantite+1;
    $this->load->helper('form');
    $donneesAModifier = array(
    'rowid' => $rowid,
    'qty'   => $qte
    );

    $this->cart->update($donneesAModifier);
    var_dump($donneesAModifier);
    redirect('visiteur/afficherPanier');
  }

  public function afficherPanier()
  { 
    $this->load->helper('form');
    $DonneesInjectees['TitreDeLaPage'] = 'Panier';
    $this->load->view('templates/header');
    $this->load->view('visiteur/afficherPanier', $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function validerPanier()
  { 
    if(!is_null($this->session->identifiant))
    {
      $this->load->helper('form');

      $NoClient=$this->session->id;
      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
      $donneesAInsererCommande = array(
        'NOCLIENT' => $NoClient,
        'DATECOMMANDE' => date("Y-m-d H:i:s")
      ); 

      $this->ModeleCommande->insererUneCommande($donneesAInsererCommande); // appel du modèle
      $CommandeRetourne=$this->ModeleCommande->retournerCommandes($NoClient,$Etat);
      $NoCommande=$CommandeRetourne['NOCOMMANDE'];

      /*foreach $contents as $item
      {
        $donneesAInsererLigne = array(
          'NOCOMMANDE' => $NoCommande,
          'NOPRODUIT' => $NoProduit, 
          'QUANTITECOMMANDEE' => $this->input->post('txtQuantite'),
          );
      }
      */
        $this->ModeleLigne->insererUneLigne($donneesAInsererLigne); // appel du modèle
        //UPDATE sur la quantité en stock 
        $donnesAModifier= $this->input->post('txtQuantite');
        $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
        $quantiteEnStock=$ProduitRetourne['QUANTITEENSTOCK'];
        $this->ModeleProduit->modifierUnProduit($donnesAModifier,$NoProduit,$quantiteEnStock);



      redirect('visiteur/afficherProfil', $DonneesInjectees);
    }
    else
    {
      redirect('visiteur/seConnecter');
    }
    
  }

  /*public function supprimerPanier($NoCommande=NULL,$NoProduit=NULL)
  {
    //récupérer la quantité qui va se faire supprimer
    $LigneRetourne=$this->ModeleLigne->retournerLigne($NoCommande,$NoProduit);
    $quantite=$LigneRetourne["QUANTITECOMMANDEE"];

    //supprimer le produit du panier
    $this->ModeleLigne->supprimerPanier($NoProduit,$NoCommande);

    //remettre la quantité dans la base de données 
    $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
    $quantiteEnStock=$ProduitRetourne['QUANTITEENSTOCK'];
    $this->ModeleProduit->modifierUnProduitSuppPanier($quantite,$NoProduit,$quantiteEnStock);
		redirect('visiteur/afficherPanier');
  }
  
  public function modifierPanier($NoProduit=NULL,$NoCommande=NULL)
  {
    //FAIRE LA MODIFICATION DU PANIER 
  }

  public function ajouterPanier($NoProduit=NULL) // ajouter au panier, d'abord commande puis ligne
	{
    $this->load->helper('form');
    if ($this->input->post('btnAjouterPanier')) // On test si le formulaire a été posté.
    {
      $NoClient=$this->session->id;
      $Etat="PanierEnCours";
      
      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
      $donneesAInsererCommande = array(
        'NOCLIENT' => $this->session->id,
        'DATECOMMANDE' => date("Y-m-d H:i:s"),
        'ETAT'=> "PanierEnCours",
      ); 
      var_dump($Etat);
      var_dump($NoClient);
      $CommandeRetourne=$this->ModeleCommande->retournerCommandeHistorique($NoClient,$Etat);
      var_dump($CommandeRetourne);
      if (!($CommandeRetourne==null)) // la commande existe déjà 
      {
        $NoCommande=$CommandeRetourne['NOCOMMANDE'];
      }
      else 
      { 
        $this->ModeleCommande->insererUneCommande($donneesAInsererCommande); // appel du modèle
        $CommandeRetourne=$this->ModeleCommande->retournerCommandes($NoClient,$Etat);
        $NoCommande=$CommandeRetourne['NOCOMMANDE'];  
      }
      // AJOUT DANS LIGNE 
      $donneesAInsererLigne = array(
      'NOCOMMANDE' => $NoCommande,
      'NOPRODUIT' => $NoProduit, 
      'QUANTITECOMMANDEE' => $this->input->post('txtQuantite'),
      );
      $LigneRetourne=$this->ModeleLigne->retournerLigne($NoCommande,$NoProduit);
      if (!($LigneRetourne==null)) // la ligne existe déjà 
      {
        $this->load->view('templates/header');
        redirect('visiteur/afficherPanier');
        $this->load->view('templates/footer');
      }
      else 
      {
        $this->ModeleLigne->insererUneLigne($donneesAInsererLigne); // appel du modèle
        //UPDATE sur la quantité en stock 
        $donnesAModifier= $this->input->post('txtQuantite');
        $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
        $quantiteEnStock=$ProduitRetourne['QUANTITEENSTOCK'];
        $this->ModeleProduit->modifierUnProduit($donnesAModifier,$NoProduit,$quantiteEnStock);

        redirect('visiteur/afficherPanier');
      }
    }
    else
    {  
      si formulaire non posté = bouton 'submit' à NULL : on est jamais passé par le formulaire -> on envoie le formulaire 
      $this->load->view('templates/header');
      $this->load->view('visiteur/voirUnProuit', $DonneesInjectees);
      $this->load->view('templates/footer');
    }
  }// ajouterPanier


    public function afficherPanier() // afficher l'accueil
    {
      $NoClient=$this->session->id;
      $Etat="PanierEnCours";
      $CommandeRetourne=$this->ModeleCommande->retournerCommandeHistorique($NoClient,$Etat);
      $NoCommande=$CommandeRetourne['NOCOMMANDE'];  
      $DonneesInjectees['lesLignes'] = $this->ModeleLigne->retournerLignes($NoCommande);
      $DonneesInjectees['totalPanier']=$this->ModeleCommande->totalPanier($NoCommande);
      $DonneesInjectees['TitreDeLaPage'] = 'Panier';
      $this->load->view('templates/header');
      $this->load->view('visiteur/afficherPanier', $DonneesInjectees);
      $this->load->view('templates/footer');
      
    } // afficher panier
  */

  public function seDeconnecter() 
  {
    // destruction de la session = déconnexion
    $this->cart->destroy();
    $this->session->sess_destroy();
    $this->load->view('templates/header');
    redirect('visiteur/afficherAccueil');
    $this->load->view('templates/footer');
  }

}     