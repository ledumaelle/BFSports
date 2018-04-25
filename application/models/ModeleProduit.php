<?php
class ModeleProduit extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

    public function existe($pProduit) // non utilisée retour 1 si connecté, 0 sinon
    {
       $this->db->where($pProduit);
       $this->db->from('PRODUIT');
       return $this->db->count_all_results(); // nombre de ligne retournées par la requeête
    } // existe

    public function retournerProduit($pProduit)
    {
       $requete = $this->db->get_where('PRODUIT',$pProduit);
       return $requete->row(); // retour d'une seule ligne !
       // retour sous forme d'objets
    } // retournerClient

    public function retournerProduits($pNoProduit = FALSE)
    {
        if ($pNoProduit === FALSE) // pas de n° d'Produit en paramètre
        {  // on retourne tous les Produits
             $requete = $this->db->get('PRODUIT');
             return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('PRODUIT', array('NOPRODUIT' => $pNoProduit));
        return $requete->row_array(); // retour d'un tableau associatif
    } // fin retournerProduits

    /* public function retournerMarque($pNoMarque = FALSE)
    {
        if ($pNoMarque === FALSE) // pas de n° d'Produit en paramètre
        {  // on retourne tous les Produits
             $requete = $this->db->get('marque');
             return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'Produit dont l'id est $pNoProduit
        $requete = $this->db->get_where('marque', array('NOMARQUE' => $pNoMarque));
        return $requete->row_array(); // retour d'un tableau associatif
    } // fin retournerProduits 
    */

    public function insererUnProduit($pDonnesAInserer)
    {
        return $this->db->insert('PRODUIT',$pDonnesAInserer);
    } // insérer un produit
    
    public function modifierUnProduit($pDonnesAModifier,$pId)
    {
        return $this->db->update('PRODUIT',$pDonnesAModifier,'NOPRODUIT='.$pId);
    } // modifier un produit
    

} // Fin Classe