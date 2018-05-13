<?php
class ModeleLigne extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

   public function retournerLignes($pNoCommande=FALSE) //
    {
        if ($pNoCommande=== FALSE) // pas de n° d'Client en paramètre  --> ADMINISTRATEUR
        {  // on retourne tous les lignes de commandes
            $this->db->from('LIGNE'); 
            $this->db->join('PRODUIT', 'PRODUIT.NOPRODUIT=LIGNE.NOPRODUIT', 'left');
            $this->db->join('COMMANDE', 'LIGNE.NOCOMMANDE=COMMANDE.NOCOMMANDE', 'left');
            $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
            $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
            $this->db->order_by('COMMANDE.NOCOMMANDE');
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher la (les) lignes dont le numéro de client est $pNoClient
        $this->db->from('LIGNE'); 
        $this->db->join('PRODUIT', 'PRODUIT.NOPRODUIT=LIGNE.NOPRODUIT', 'left');
        $this->db->join('COMMANDE', 'LIGNE.NOCOMMANDE=COMMANDE.NOCOMMANDE', 'left');
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('COMMANDE.NOCOMMANDE',$pNoCommande);
        $this->db->where('COMMANDE.ETAT',"PanierEnCours");
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    } // fin retournerProduits

    public function retournerHistoriqueLignes($pNoCommande=FALSE) //
    {
        $this->db->from('LIGNE'); 
        $this->db->join('PRODUIT', 'PRODUIT.NOPRODUIT=LIGNE.NOPRODUIT', 'left');
        $this->db->join('COMMANDE', 'LIGNE.NOCOMMANDE=COMMANDE.NOCOMMANDE', 'left');
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('COMMANDE.NOCOMMANDE',$pNoCommande);
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    }


    public function retournerLigne($pNoCommande=FALSE,$pNoProduit=FALSE) 
    {
        $this->db->from('LIGNE');
        $this->db->where('NOPRODUIT',$pNoProduit,'NOCOMMANDE',$pNoCommande);
        $requete = $this->db->get(); 
        return $requete->row_array(); // retour d'un tableau associatif
    } // fin retournerProduits

    public function insererUneLigne($pDonnesAInserer)
    {
        return $this->db->insert('LIGNE',$pDonnesAInserer);
    } // insérer une ligne
    
    public function modifierUneLigne($pDonnesAModifier,$pNoCommande,$pNoProduit)
    {
        return $this->db->update('LIGNE',$pDonnesAModifier,'NOCOMMANDE='.$pNoCommande,'NOPRODUIT='.$pNoProduit);
    } // modifier une ligne

    public function supprimerPanier($pNoProduit,$pNoCommande)
    {
        $this->db->where('NOCOMMANDE', $pNoCommande);
        $this->db->where('NOPRODUIT='.$pNoProduit);
        return $this->db->delete('LIGNE');
    } // supprimer un client

    public function quantitePanier($pNoCommande,$pNoProduit)
    {
        //SELECT SUM(`QUANTITECOMMANDEE`),`produit`.libelle FROM `ligne`,`produit` WHERE `produit`.noproduit=`ligne`.noproduit GROUP BY libelle
        $this->db->select('(Select SUM(QUANTITECOMMANDEE))  AS Quantite'); 
        $this->db->from('PRODUIT'); 
        $this->db->join('LIGNE', 'LIGNE.NOPRODUIT=PRODUIT.NOPRODUIT', 'left');
        $this->db->where('LIGNE.NOCOMMANDE',$pNoCommande);
        $this->db->where('LIGNE.NOPRODUIT',$pNoProduit);
        $requete = $this->db->get();
        return $requete->row_array();
    }    

} // Fin Classe