<?php
class ModeleCategorie extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

    public function retournerCategorie($pNoCategorie = FALSE) 
    {
        if ($pNoCategorie === FALSE) // pas de n° d'Produit en paramètre
        {  // on retourne tous les Produits
            $this->db->from('CATEGORIE'); 
            $this->db->order_by('CATEGORIE.NOCATEGORIE');
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('CATEGORIE', array('NOCATEGORIE' => $pNoCategorie)); // --> voirUnProduit.php
        return $requete->row_array(); // retour d'un tableau associatif
    }

    public function retournerUneCategorie($pNomCategorie = FALSE) 
    {
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('CATEGORIE', array('LIBELLECATEGORIE' => $pNomCategorie)); 
        return $requete->row_array(); // retour d'un tableau associatif
    } 

    public function insererUneCategorie($pDonnesAInserer)
    {
        return $this->db->insert('CATEGORIE',$pDonnesAInserer);
    } // insérer un produit

    
} // Fin Classe