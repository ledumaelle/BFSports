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
    $this->load->library('email');
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
    $DonneesInjectees['meilleurProduit'] = $this->ModeleProduit->meilleurProduit();
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

  public function afficherBoutique($Erreur=NULL) 
	{
    if (!($Erreur===null))
        {
          $DonneesInjectees['Erreur']='oui';
        }
      else
        {
          $DonneesInjectees['Erreur']='non';
        }
		// les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('visiteur/afficherBoutique');
    $config["total_rows"] = $this->ModeleProduit->nombreDeProduits();
		$config["per_page"] = 5; // nombre d'articles par page
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
  } 
  
  /*public function afficherBoutiqueRecherche($Recherche=NULL) // afficher la boutique par rapport à la recherche
	{
    $Recherche=$_GET['search'];
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsLimiteRecherche($Recherche);
		$this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutiqueRecherche', $DonneesInjectees);
		$this->load->view('templates/footer'); 
  }
  */

  public function recherche()
  {
    $recherche=$this->input->post('search');
    redirect('visiteur/afficherBoutiqueRecherche/'.$recherche);
  }

  public function afficherBoutiqueRecherche($Recherche=NULL)
  { 
    if (!($Recherche==null) && !($Recherche==""))
    {
      // les noms des entrées dans $config doivent être respectés
      $config = array();
      $config["base_url"] = site_url('visiteur/afficherBoutiqueRecherche/'.$Recherche);
      $config["total_rows"] = $this->ModeleProduit->nombreDeProduitsRecherche($Recherche);
      $config["per_page"] = 5; // nombre d'articles par page
      $config["uri_segment"] = 4; /* le n° de la page sera placé sur le segment n°3 de URI,
      pour la page 4 on aura : visiteur/listerLesArticlesAvecPagination/4   */
      $config['first_link'] = 'Premier';
      $config['last_link'] = 'Dernier';
      $config['next_link'] = 'Suivant';
      $config['prev_link'] = 'Précédent';
      $this->pagination->initialize($config);
      $noPage = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
      /* on récupère le n° de la page - segment 3 - si ce segment est vide, cas du premier appel
      de la méthode, on affecte 0 à $noPage */
      $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsLimiteRecherche($config["per_page"], $noPage,$Recherche);
      $DonneesInjectees["liensPagination"] = $this->pagination->create_links();
      $this->load->view('templates/header');
      $this->load->view("visiteur/afficherBoutiqueRecherche", $DonneesInjectees);
      $this->load->view('templates/footer');
    }

    else
    {
      $Erreur="oui";
      redirect("visiteur/afficherBoutique/".$Erreur="oui");
    }
      
    
  }

  public function afficherBoutiqueParEquipement()
  {
    // les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('visiteur/afficherBoutiqueParEquipement');
    $config["total_rows"] = $this->ModeleProduit->nombreDeProduitsEquipement();
		$config["per_page"] = 5; // nombre d'articles par page
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
    $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsEquipementLimite($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("visiteur/afficherBoutiqueParEquipement", $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function afficherBoutiqueParTextile($noCategorie=NULL)
  {
    // les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('visiteur/afficherBoutiqueParTextile');
    $config["total_rows"] = $this->ModeleProduit->nombreDeProduitsTextile();
		$config["per_page"] = 5; // nombre d'articles par page
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
    $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsTextileLimite($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("visiteur/afficherBoutiqueParTextile", $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function afficherBoutiqueParAccessoire($noCategorie=NULL)
  {
    // les noms des entrées dans $config doivent être respectés
		$config = array();
		$config["base_url"] = site_url('visiteur/afficherBoutiqueParAccessoire');
    $config["total_rows"] = $this->ModeleProduit->nombreDeProduitsAccessoireDeFrappe();
		$config["per_page"] = 5; // nombre d'articles par page
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
    $DonneesInjectees["lesProduits"] = $this->ModeleProduit->retournerProduitsAccessoireDeFrappeLimite($config["per_page"], $noPage);
		$DonneesInjectees["liensPagination"] = $this->pagination->create_links();
		$this->load->view('templates/header');
		$this->load->view("visiteur/afficherBoutiqueParAccessoire", $DonneesInjectees);
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
    $DonneesInjectees['Erreur']='non';
    if (empty($DonneesInjectees['unProduit']))
    {   // pas de produit correspondant au n°
      show_404();
    }
    $this->load->view('templates/header');
    $this->load->view('visiteur/voirUnProduit', $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function voirUneCommande($NoCommande = NULL) // valeur par défaut de noProduit = NULL
  {
    $DonneesInjectees['uneCommande'] = $this->ModeleCommande->retournerCommandeHistorique($NoCommande);
    if (empty($DonneesInjectees['uneCommande']))
    {   // pas de produit correspondant au n°
      show_404();
    }
    $DonneesInjectees['lesLignes'] = $this->ModeleLigne->retournerHistoriqueLignes($NoCommande);
    $this->load->view('templates/header');
    $this->load->view('visiteur/voirUneCommande', $DonneesInjectees);
    $this->load->view('templates/footer');
  }

  public function afficherProfil($Erreur=NULL) // afficher l'accueil
	{
    $this->load->library('session');
    if (!is_null($this->session->identifiant)) // s'il y a une session ouverte
    {
      if (!($Erreur===null))
        {
          $DonneesInjectees['Erreur']='oui';
        }
      else
        {
          $DonneesInjectees['Erreur']='non';
        }
      $NoClient=$this->session->id;
      $this->load->helper('form');
      $DonneesInjectees['TitreDeLaPage'] = 'Profil';
      $DonneesInjectees['lesCommandes'] = $this->ModeleCommande->retournerCommandes($NoClient);  
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
        redirect('visiteur/afficherProfil', $DonneesInjectees);
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
          $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduitsNouveautes();
          redirect('visiteur/afficherAccueil', $DonneesInjectees);
        }
        else
        {    // utilisateur non trouvé on renvoie le formulaire de connexion
          $this->load->view('templates/header');
          $this->load->view('visiteur/seConnecter', $DonneesInjectees);
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
    $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
    $QuantiteProduit=$ProduitRetourne['QUANTITEENSTOCK'];
    if (($this->input->post('btnAjouterPanier')) && ( $this->input->post('txtQuantite') <= $QuantiteProduit )) // On test si le formulaire a été posté.
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
      $DonneesInjectees['unProduit'] = $this->ModeleProduit->retournerProduits($NoProduit);
      $DonneesInjectees['Erreur']='oui';
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
    foreach ($this->cart->contents() as $items): 
      if ($items['rowid']=$rowid):
        $NoProduit=$items['id'];
      endif;
    endforeach;
    $qte=$quantite+1;

    $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
    $qteRestante= $ProduitRetourne['QUANTITEENSTOCK'];
    if (!($qte>$qteRestante)):
      $this->load->helper('form');
      $donneesAModifier = array(
      'rowid' => $rowid,
      'qty'   => $qte
      );
      
    $this->cart->update($donneesAModifier);
    endif;

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
      $DateCommande=date("Y-m-d H:i:s");
      // le bouton 'submit', boutonAjouter est <> de NULL, on a posté quelque chose.
      $donneesAInsererCommande = array(
        'NOCLIENT' => $NoClient,
        'DATECOMMANDE' => date("Y-m-d H:i:s")
      ); 
      $CommandeRetourne=$this->ModeleCommande->retournerCommande($NoClient);
      if ($CommandeRetourne==null) 
      {
        $this->ModeleCommande->insererUneCommande($donneesAInsererCommande); // appel du modèle
        $CommandeRetourne=$this->ModeleCommande->retournerCommande($NoClient);
        $NoCommande=$CommandeRetourne['NOCOMMANDE'];  
      
        foreach ($this->cart->contents() as $items):
          $donneesAInsererLigne = array(
          'NOCOMMANDE' => $NoCommande,
          'NOPRODUIT' => $items['id'], 
          'QUANTITECOMMANDEE' => $items['qty'],
          );
          $NoProduit=$items['id'];
          $this->ModeleLigne->insererUneLigne($donneesAInsererLigne); // appel du modèle
          //UPDATE sur la quantité en stock 
          $donneeAModifier= $items['qty'];
          $ProduitRetourne=$this->ModeleProduit->retournerProduits($NoProduit);
          $quantiteEnStock=$ProduitRetourne['QUANTITEENSTOCK'];
          $this->ModeleProduit->modifierQteProduit($donneeAModifier,$NoProduit,$quantiteEnStock);

        endforeach;
        
        $ClientRetourne = $this->ModeleClient->retournerClients($NoClient);
        var_dump($ClientRetourne);
        
        if (!($ClientRetourne == null))
        {    // on a trouvé, identifiant et statut (droit) sont stockés en session
          $email = $ClientRetourne['EMAIL'];
          $adresse=$ClientRetourne['ADRESSE'];
          $ville=$ClientRetourne['VILLE'];
          $codepostal=$ClientRetourne['CODEPOSTAL'];
          $nom=$ClientRetourne['NOM'];
          $prenom=$ClientRetourne['PRENOM'];
          $dateCommande = new DateTime($uneCommande['DATECOMMANDE']);
          $date=$dateCommande->format('d/m/Y');  
          $this->email->from("maelle.lolitadu22@gmail.com", "BF Sports.com");
          $this->email->to(''.$email.'', ''.$nom.' '.$prenom.''); 
          $this->email->subject('Commande BFSports.com ');
          $this->email->message('Confirmation de commande, Numéro : '.$NoCommande.'
Date de commande : ' .$date.'
Adresse de livraison : ' .$adresse. ' ' .$codepostal. ' ' .$ville.  '

Bonjour ' .$prenom.',
merci de votre commande. Cela nous fait plaisir que vous ayez choisi BF Sports.
Nous avons bien reçu l\'intégralité de votre paiement. Votre commande sera traitée et expédiée le plus vite possible.

Cordialement, Votre équipe de BF Sports');
          if (!$this->email->send()){
            $this->email->print_debugger();
        }
        
          
        }
        $this->cart->destroy();
        redirect('visiteur/afficherProfil', $DonneesInjectees);

      }
      else
      {
        $Erreur="oui";
        $this->cart->destroy();
        redirect('visiteur/afficherProfil/'.$Erreur.'');
      }
      
    }
    else
    {
      redirect('visiteur/sInscrire');

    }
    
  }
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