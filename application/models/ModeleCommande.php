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

    public function retournerCommande($pNoCommande=FALSE)
    {
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",CLIENT.NOCLIENT,COMMANDE.NOCOMMANDE,NOM,PRENOM,ADRESSE,VILLE,CODEPOSTAL,COMMANDE.NOCOMMANDE
        FROM produit,commande,ligne,client
        WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
        and commande.nocommande='.$pNoCommande.' Group by commande.nocommande';
        $requete = $this->db->query($sql);
        return $requete->row_array();
    }

    public function retournerCommandeEtat($pEtat = FALSE) 
    {
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
        , CLIENT.NOCLIENT,DATECOMMANDE,ETAT,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
        FROM produit,commande,ligne,client
        WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
        and commande.etat="'.$pEtat.'" Group by commande.nocommande';
        $requete = $this->db->query($sql);
        return $requete->result_array();
    }

    public function retournerCommandes($pNoClient = FALSE, $pEtat = FALSE) // etat --> traitée 
    {
        if ($pNoClient === FALSE && $pEtat === FALSE ) // admin
        {  
            $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
            , CLIENT.NOCLIENT,DATECOMMANDE,ETAT,QUANTITECOMMANDEE,DATETRAITEMENT,CLIENT.NOM,CLIENT.PRENOM
            FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and commande.etat NOT IN (SELECT commande.nocommande FROM commande WHERE commande.etat= "PanierEnCours") Group by commande.nocommande';
            $requete = $this->db->query($sql);
            return $requete->result_array();
        }
            $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
            , CLIENT.NOCLIENT,DATECOMMANDE,ETAT,QUANTITECOMMANDEE
            FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and client.noclient='.$pNoClient.' and commande.etat="'.$pEtat.'" Group by commande.nocommande';
            $requete = $this->db->query($sql);
            return $requete->result_array();
        
    } 

    public function retournerCommandeHistorique($pNoClient = FALSE, $pEtat = FALSE) // voir un commande.php
    {
        $sql = 'SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100)))) AS "Total",PRODUIT.NOPRODUIT,LIBELLE,PRIXHT,TAUXTVA,NOMIMAGE,COMMANDE.NOCOMMANDE
            , CLIENT.NOCLIENT,DATECOMMANDE,ETAT,QUANTITECOMMANDEE
            FROM produit,commande,ligne,client
            WHERE produit.noproduit=ligne.noproduit and commande.noclient=client.noclient and commande.nocommande=ligne.nocommande 
            and client.noclient='.$pNoClient.' and commande.etat="'.$pEtat.'" Group by commande.nocommande';
            $requete = $this->db->query($sql);
            return $requete->row_array();
    }


    public function totalPanier($pNoCommande=FALSE) 
    {
        // SELECT SUM(`QUANTITECOMMANDEE`*(`PRIXHT`*(1+(`TAUXTVA` / 100 )))),libelle FROM `ligne`,`produit` WHERE `PRODUIT`.NOPRODUIT=`LIGNE`.NOPRODUIT AND `LIGNE`.NOCOMMANDE=1 GROUP BY libelle
             
        $this->db->select('(SELECT SUM(QUANTITECOMMANDEE*(PRIXHT*(1+(TAUXTVA/100))))) AS Total ');
        $this->db->from('LIGNE');
        $this->db->join('PRODUIT', 'PRODUIT.NOPRODUIT=LIGNE.NOPRODUIT', 'left');
        $this->db->where('LIGNE.NOCOMMANDE',$pNoCommande);
        $requete = $this->db->get(); 
        return $requete->row_array(); // retour d'un tableau associatif
    }

    public function insererUneCommande($pDonnesAInserer)
    {
        return $this->db->insert('COMMANDE',$pDonnesAInserer);
    } // insérer un produit
    
    public function modifierUneCommande($pDonnesAModifier,$noCommande)
    {
        return $this->db->update('COMMANDE',$pDonnesAModifier,'NOCOMMANDE='.$noCommande);
    } // modifier un produit
} // Fin Classe