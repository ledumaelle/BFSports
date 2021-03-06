<?php
class ModeleProduit extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }

    public function retournerProduits($pNoProduit = FALSE) //VISITEUR
    {   $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.NOPRODUIT', $pNoProduit); 
        $this->db->where('PRODUIT.DISPONIBLE', 1); 
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0); 
        $requete = $this->db->get();
        return $requete->row_array(); // retour d'un tableau associatif
    }
    
    public function retournerProduitsAdmin($pNoProduit = FALSE)  //ADMINISTRATEUR
    {
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.NOPRODUIT', $pNoProduit);                                    
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
        return $requete->row_array();
    }
    
    /*public function retournerProduitsRecherche($pRecherche=FALSE) //pb de cast 
    {
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->like('LIBELLE', $pRecherche);
        $this->db->where('PRODUIT.DISPONIBLE', 1);   
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    } 
    */

    public function nombreDeProduitsRecherche($pRecherche=FALSE) 
    { // méthode utilisée pour la pagination
        $this->db->from('PRODUIT'); 
        $this->db->like('LIBELLE', $pRecherche);
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);	
		return $this->db->count_all_results(); 
    } 

    public function retournerProduitsLimiteRecherche($nombreDeLignesARetourner, $noPremiereLigneARetourner,$pRecherche=FALSE)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->like('LIBELLE', $pRecherche);
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } 

    public function retournerProduitsRechercheAdmin($pRecherche=FALSE) //pb de cast 
    {
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->like('LIBELLE', $pRecherche);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    }

    /*public function retournerProduitsCategorie($pNoCategorie=FALSE)
    {
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('CATEGORIE.NOCATEGORIE', $pNoCategorie);
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    }
    */


    public function retournerProduitsNouveautes()
    {
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->order_by('NOPRODUIT', 'DESC');
        $this->db->limit(3);
        $requete = $this->db->get();
        return $requete->result_array(); // retour d'un tableau associatif
    } // fin retournerProduits

    public function retournerProduitsLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    }

    public function retournerProduitsLimiteAdmin($nombreDeLignesARetourner, $noPremiereLigneARetourner)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } 

    public function nombreDeProduitsAdmin() 
	{ // méthode utilisée pour la pagination	
		return $this->db->count_all("PRODUIT");
    }

    public function meilleurProduit()
    {
        $sql="SELECT Produit.noProduit as 'NOPRODUIT' ,SUM(QUANTITECOMMANDEE) FROM Ligne,Produit 
        WHERE produit.noProduit=ligne.noProduit Group By Produit.noProduit";
        $requete=$this->db->query($sql);
        $meilleurProduit="";
        foreach($requete->result_array() as $unProduit):
            $i=0;
            if ( $meilleurProduit == "")
            {
                $meilleurProduit=$unProduit;
            }
            else 
            {
                if ($meilleurProduit['SUM(QUANTITECOMMANDEE)'] < $unProduit['SUM(QUANTITECOMMANDEE)'])
                {
                    $meilleurProduit=$unProduit;
                }
            }
        endforeach;

        $meilleurProduit=$this->ModeleProduit->retournerProduits($meilleurProduit['NOPRODUIT']);

        return $meilleurProduit;
    }

    public function nombreDeProduits() 
    { // méthode utilisée pour la pagination
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);	
		return $this->db->count_all_results(); 
    }
    
    public function nombreDeProduitsEquipement() 
    { // méthode utilisée pour la pagination
        $this->db->from('PRODUIT'); 
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('CATEGORIE.NOCATEGORIE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);	
		return $this->db->count_all_results(); 
    } 

    public function retournerProduitsEquipementLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->where('CATEGORIE.NOCATEGORIE' , 1);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    }


    public function nombreDeProduitsTextile() 
    { // méthode utilisée pour la pagination
        $this->db->from('PRODUIT'); 
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.NOCATEGORIE', 2);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);	
		return $this->db->count_all_results(); 
    } 

    public function retournerProduitsTextileLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->where('CATEGORIE.NOCATEGORIE' , 2);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    }

    public function nombreDeProduitsAccessoireDeFrappe() 
    { // méthode utilisée pour la pagination
        $this->db->from('PRODUIT'); 
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.NOCATEGORIE', 3);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);	
		return $this->db->count_all_results(); 
    } 

    public function retournerProduitsAccessoireDeFrappeLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
	{// Nota Bene : surcharge non supportée par PHP
        $this->db->limit($nombreDeLignesARetourner, $noPremiereLigneARetourner);
        $this->db->from('PRODUIT'); 
        $this->db->join('MARQUE', 'MARQUE.NOMARQUE=PRODUIT.NOMARQUE', 'left');
        $this->db->join('CATEGORIE', 'CATEGORIE.NOCATEGORIE=PRODUIT.NOCATEGORIE', 'left');
        $this->db->where('PRODUIT.DISPONIBLE', 1);
        $this->db->where('PRODUIT.QUANTITEENSTOCK >', 0);
        $this->db->where('CATEGORIE.NOCATEGORIE' , 3);
        $this->db->order_by('PRODUIT.NOPRODUIT');
        $requete = $this->db->get();
		if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    }

    public function insererUnProduit($pDonnesAInserer)
    {
        return $this->db->insert('PRODUIT',$pDonnesAInserer);
    } // insérer un produit
    
    public function modifierQteProduit($pDonneeAModifier=FALSE,$pNoProduit=FALSE,$quantiteEnStock)
    {
        $this->db->set('QUANTITEENSTOCK', $quantiteEnStock-$pDonneeAModifier);
        $this->db->where('PRODUIT.NOPRODUIT',$pNoProduit);
        return $this->db->update('PRODUIT');
    } // modifier qté produit

    public function modifierUnProduit($pDonneesAModifier=FALSE,$pNoProduit=FALSE)
    {
        $this->db->where('PRODUIT.NOPRODUIT',$pNoProduit);
        return $this->db->update('PRODUIT',$pDonneesAModifier);
    } // modifier un produit

    

} // Fin Classe