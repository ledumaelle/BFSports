<?php
class ModeleCommande extends CI_Model 
{
    public function __construct()
    {
        $this->load->database();
        /* chargement database.php (dans config), obligatoirement dans le constructeur */
    }
    public function existe($pCommande) 
    {
       $this->db->where($pCommande);
       $this->db->from('COMMANDE');
       return $this->db->count_all_results(); // nombre de ligne retournées par la requeête
    } // existe

    /*public function retournerCommandes($pNoClient = FALSE, $pEtat = FALSE) 
    {

        if ($pNoClient === FALSE && $pEtat === FALSE ) // admin
        {  
            $this->db->from('COMMANDE'); 
            $this->db->join('CLIENT', 'COMMANDE.NOCLIENT=CLIENT.NOCLIENT', 'left');
            $this->db->order_by('CLIENT.NOCLIENT');
            $this->db->where('COMMANDE.ETAT',$pEtat); // etat --> panier validé 
            $requete = $this->db->get();
            return $requete->result_array(); // retour d'un tableau associatif
        }
        $this->db->from('COMMANDE'); 
        $this->db->join('CLIENT', 'COMMANDE.NOCLIENT=CLIENT.NOCLIENT', 'left');
        $this->db->where('CLIENT.NOCLIENT',$pNoClient);
        $this->db->where('COMMANDE.ETAT',$pEtat);
        $requete = $this->db->get(); // --> afficherPanier.php : client
        return $requete->row_array(); // retour d'un tableau associatif
    }
    */

    public function retournerUneCommande($pNoCommande=FALSE)
    {
        $sql ='SELECT COMMANDE.NOCOMMANDE as "NOCOMMANDE",CLIENT.NOCLIENT,DATECOMMANDE,DATETRAITEMENT
        FROM commande,client
        WHERE commande.noclient=client.noclient
        and commande.nocommande='.$pNoCommande.' and commande.DATETRAITEMENT is null';
        $requete = $this->db->query($sql);
        return $requete->row_array();
    }
    

    public function retournerCommande($pNoClient = FALSE) 
    {
        $sql = 'SELECT COMMANDE.NOCOMMANDE as "NOCOMMANDE",CLIENT.NOCLIENT,DATECOMMANDE,DATETRAITEMENT
        FROM commande,client
        WHERE commande.noclient=client.noclient
        and client.noclient='.$pNoClient.' and commande.DATETRAITEMENT is null';
        $requete = $this->db->query($sql);
        return $requete->row_array();
    }
    
    public function retournerCommandesLimite($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {// Nota Bene : surcharge non supportée par PHP
        
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
        , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
        FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            Group by COMMANDE.NOCOMMANDE order by DATECOMMANDE limit '.$noPremiereLigneARetourner.','.$nombreDeLignesARetourner.'';
            $requete = $this->db->query($sql);
           if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } // retournerArticlesLimite

    public function retournerCommandesLimiteNonTraitee($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {// Nota Bene : surcharge non supportée par PHP
        
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
        , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
        FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and commande.datetraitement is null 
            Group by COMMANDE.NOCOMMANDE order by DATECOMMANDE limit '.$noPremiereLigneARetourner.','.$nombreDeLignesARetourner.'';
            $requete = $this->db->query($sql);
           if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } // retournerArticlesLimite

    public function retournerCommandesLimiteTraitee($nombreDeLignesARetourner, $noPremiereLigneARetourner)
    {// Nota Bene : surcharge non supportée par PHP
        
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
        , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
        FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and commande.datetraitement is not null 
            Group by COMMANDE.NOCOMMANDE order by DATECOMMANDE limit '.$noPremiereLigneARetourner.','.$nombreDeLignesARetourner.'';
            $requete = $this->db->query($sql);
           if ($requete->num_rows() > 0) { // si nombre de lignes > 0
			foreach ($requete->result() as $ligne) {
				$jeuDEnregsitrements[] = $ligne;
			}
			return $jeuDEnregsitrements;
		} // fin if
		return false;
    } // retournerArticlesLimite


    public function retournerCommandes($pNoClient = FALSE) // etat --> traitée 
    {
        if ($pNoClient === FALSE)
        {
            $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
            , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
            FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            Group by COMMANDE.NOCOMMANDE order by DATECOMMANDE';
            $requete = $this->db->query($sql);
            return $requete->result_array(); 
        }

        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
        , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
        FROM produit,commande,ligne,client
        WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
        and client.noclient='.$pNoClient.' Group by COMMANDE.NOCOMMANDE order by DATECOMMANDE';
        $requete = $this->db->query($sql);
        return $requete->result_array();
        
    } 

    public function retournerCommandeHistorique($pNoCommande = FALSE) // voir un commande.php
    {
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
            , CLIENT.NOCLIENT,DATECOMMANDE,QUANTITECOMMANDEE,CLIENT.NOM,CLIENT.PRENOM,CLIENT.ADRESSE,CLIENT.VILLE,CLIENT.CODEPOSTAL
            FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and commande.nocommande='.$pNoCommande.'  Group by commande.nocommande order by DATECOMMANDE';
            $requete = $this->db->query($sql);
            return $requete->row_array();
    }

    public function insererUneCommande($pDonnesAInserer)
    {
        return $this->db->insert('COMMANDE',$pDonnesAInserer);
    } // insérer un produit
    
    public function nombreDeCommandesNonTraitees() 
    { // méthode utilisée pour la pagination
        $this->db->from('COMMANDE'); 
        $this->db->where('DATETRAITEMENT', null);
		return $this->db->count_all_results(); 
    } 

    public function nombreDeCommandesTraitees() 
	{
        $this->db->from('COMMANDE'); 
        $this->db->where('DATETRAITEMENT', 'not null');
		return $this->db->count_all_results(); 
    }

    public function nombreDeCommandes() 
	{ // méthode utilisée pour la pagination	
		return $this->db->count_all("COMMANDE");
    }


    public function modifierUneCommande($pDonnesAModifier,$pNoCommande)
    {
        $this->db->set('DATETRAITEMENT', $pDonnesAModifier);
        $this->db->where('NOCOMMANDE',$pNoCommande);
        return $this->db->update('COMMANDE');
    } // modifier un produit


} // Fin Classe