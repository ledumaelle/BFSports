<?php
class ModeleClient extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    } // __construct

    public function existe($pClient) // non utilisée retour 1 si connecté, 0 sinon
    {
       $this->db->where($pClient);
       $this->db->from('CLIENT');
       return $this->db->count_all_results(); // nombre de ligne retournées par la requeête
    } // existe

    public function retournerClient($pClient)
    {
       $requete = $this->db->get_where('CLIENT',$pClient);
       return $requete->row(); // retour d'une seule ligne !
       // retour sous forme d'objets
    } // retournerClient

    public function retournerClients($pNoClient = FALSE) //afficher tous les clients
    {
        if ($pNoClient === FALSE) // pas de n° d'Client en paramètre
        {  // on retourne tous les Clients
             $requete = $this->db->get('CLIENT');
             return $requete->result_array(); // retour d'un tableau associatif
        }
        // ici on va chercher l'Client dont l'id est $pNoClient
        $this->db->where('NOCLIENT',$pNoClient);
        $requete = $this->db->get('CLIENT');
        return $requete->row_array(); // retour d'un tableau associatif
    } // fin retournerClients

    public function retournerClientsLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {// Nota Bene : surcharge non supportée par PHP
        
        $requete = $this->db->get('CLIENT');
        return $requete->result_array(); // retour d'un tableau associatif
           if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } // retournerArticlesLimite


    public function insererUnClient($pDonnesAInserer)
    {
        return $this->db->insert('CLIENT',$pDonnesAInserer);
    } // modifier un produit
 
    public function modifierUnClient($pDonnesAModifier,$pNoClient)
    {
        return $this->db->update('CLIENT',$pDonnesAModifier,'NOCLIENT='.$pNoClient);
    } // modifier un client

    public function nombreDeClients() 
	{ // méthode utilisée pour la pagination	
		return $this->db->count_all("CLIENT");
    } // nombreDArticles
 
} // Fin Classe