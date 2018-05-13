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
        $requete = $this->db->get_where('MARQUE', array('NOMARQUE' => $pNoMarque)); // --> voirUnProduit.php
        return $requete->row_array(); // retour d'un tableau associatif
    } // fin retournerProduits

    
} // Fin Classe