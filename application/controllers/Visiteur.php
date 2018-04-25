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
    $this->load->library('session');
        if ($this->session->statut=='administrateur') // client : statut client
        {
            $this->load->helper('url'); // pour utiliser redirect
            redirect('/administrateur/afficherAccueil'); // pas les droits : redirection vers connexion
        }
    
  } // __construct

  public function afficherAccueil() // afficher l'accueil
	{
		$this->load->view('templates/header');
    $this->load->view('visiteur/afficherAccueil');
    $this->load->view('templates/footer');
    
  } // afficher l'acceuil

  public function afficherBoutique() // afficher l'accueil
	{
    $DonneesInjectees['lesProduits'] = $this->ModeleProduit->retournerProduits();
    // $DonneesInjectees['lesMarques'] = $this->ModeleProduit->retournerMarque();
		$DonneesInjectees['TitreDeLaPage'] = 'Boutique';
		$this->load->view('templates/header');
		$this->load->view('visiteur/afficherBoutique', $DonneesInjectees);
		$this->load->view('templates/footer');
    
  } // afficher l'acceuil

  public function voirUnProduit($noProduit = NULL) // valeur par défaut de noProduit = NULL
  {
    $DonneesInjectees['unProduit'] = $this->ModeleProduit->retournerProduits($noProduit);
    if (empty($DonneesInjectees['unProduit']))
    {   // pas d'article correspondant au n°
      show_404();
    }
    $DonneesInjectees['TitreDeLaPage'] = 'Détails du produit';
    // ci-dessus, entrée ['cTitre'] de l'entrée ['unArticle'] de $DonneesInjectees
    $this->load->view('templates/header');
    $this->load->view('visiteur/voirUnProduit', $DonneesInjectees);
    $this->load->view('templates/footer');
  } // voirUnArticle

  public function afficherPanier() // afficher l'accueil
	{
    $DonneesInjectees['TitreDeLaPage'] = 'Panier';
    $this->load->view('templates/header');
    $this->load->view('visiteur/afficherPanier',$DonneesInjectees);
    $this->load->view('templates/footer');
    
  } // afficher l'acceuil

  public function afficherProfil() // afficher l'accueil
	{
    $this->load->library('session');
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
        $this->ModeleClient->modifierUnClient($donneesAModifier,$Id); // appel du modèle
        $this->load->view('templates/header');
        $this->load->view('visiteur/afficherAccueil', $DonneesInjectees);
        $this->load->view('templates/footer');
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
      redirect('/visiteur/seConnecter'); // pas les droits : redirection vers connexion
    }
    
    
  } // afficher l'acceuil

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
        $this->load->view('visiteur/afficherAccueil', $DonneesInjectees);
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

  public function seDeconnecter() 
  {
    // destruction de la session = déconnexion
    $this->session->sess_destroy();
    $this->load->view('templates/header');
    redirect('visiteur/afficherAccueil');
    $this->load->view('templates/footer');
  }

}     