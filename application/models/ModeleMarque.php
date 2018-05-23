<?php
class ModeleMarque extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }


    public function retournerMarque($pNoMarque = FALSE) 
    {
        if ($pNoMarque === FALSE) // pas de n° d'Produit en paramètre
        {  // on retourne tous les Produits
            $this->db->from('MARQUE'); 
            $this->db->order_by('MARQUE.NOMARQUE');
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('MARQUE', array('NOMARQUE' => $pNoMarque)); 
        return $requete->row_array(); // retour d'un tableau associatif
    } 

    public function retournerUneMarque($pNomMarque = FALSE) 
    {
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('MARQUE', array('NOMMARQUE' => $pNomMarque)); 
        return $requete->row_array(); // retour d'un tableau associatif
    } 

    public function insererUneMarque($pDonnesAInserer)
    {
        return $this->db->insert('Marque',$pDonnesAInserer);
    } // insérer un produit
    

    
} // Fin Classe