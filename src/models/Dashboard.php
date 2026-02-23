<?php

namespace App\Models;

use App\Core\Model;
use TABLES;

class Dashboard extends Model
{
    protected string $table = "abonnements";
    public string $id = 'id_abonnement';

    /**
     * Nombre total d'applications actives
     */
    public function countApplications()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM " . TABLES::APPLICATIONS . " WHERE etat_application = " . ETAT_ACTIF;
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans countApplications: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Nombre total de partenaires actifs
     */
    public function countPartenaires()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM " . TABLES::PARTNERS . " WHERE etat_partner = " . ETAT_ACTIF;
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans countPartenaires: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Nombre total de clients
     */
    public function countClients()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM " . TABLES::CLIENTS . " WHERE etat_client = " . ETAT_ACTIF;
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans countClients: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Nombre total d'abonnements actifs
     */
    public function countAbonnements()
    {
        try {
            $sql = "SELECT COUNT(*) as total FROM " . TABLES::ABONNEMENTS . " WHERE etat_abonnement = " . ETAT_ACTIF;
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans countAbonnements: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Revenu total des abonnements
     */
    public function sumRevenuTotal()
    {
        try {
            $sql = "SELECT COALESCE(SUM(montant_paiement_abonnement), 0) as total FROM " . TABLES::PAIEMENT_ABONNEMENTS . " WHERE etat_paiement_abonnement = " . ETAT_ACTIF;
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans sumRevenuTotal: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Revenu du mois en cours
     */
    public function sumRevenuMoisEnCours()
    {
        try {
            $premierJourMois = date('Y-m-01');
            $dernierJourMois = date('Y-m-t');
            
            $sql = "SELECT COALESCE(SUM(montant_paiement_abonnement), 0) as total FROM " . TABLES::PAIEMENT_ABONNEMENTS . " 
            WHERE etat_paiement_abonnement = " . ETAT_ACTIF . " 
            AND date_paiement_abonnement BETWEEN '" . $premierJourMois . "' AND '" . $dernierJourMois . " 23:59:59'";
            
            $stmt = $this->db->query($sql);
            $result = $stmt->fetch();
            return $result['total'] ?? 0;
        } catch (\Exception $e) {
            error_log("Erreur dans sumRevenuMoisEnCours: " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Abonnements par mois pour une année donnée
     */
    public function getAbonnementsParMois($annee = null)
    {
        try {
            $annee = $annee ?? date('Y');
            
            $sql = "SELECT MONTH(date_debut) as mois, COUNT(*) as total 
            FROM " . TABLES::ABONNEMENTS . " 
            WHERE etat_abonnement = " . ETAT_ACTIF . " 
            AND YEAR(date_debut) = " . $annee . "
            GROUP BY MONTH(date_debut)
            ORDER BY mois";
            
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll();

            // Formatage pour le graphique (12 mois)
            $data = array_fill(0, 12, 0);
            foreach ($result as $row) {
                $data[(int)$row['mois'] - 1] = (int) $row['total'];
            }

            return $data;
        } catch (\Exception $e) {
            error_log("Erreur dans getAbonnementsParMois: " . $e->getMessage());
            return array_fill(0, 12, 0);
        }
    }

    /**
     * Revenus par mois pour une année donnée
     */
    public function getRevenusParMois($annee = null)
    {
        try {
            $annee = $annee ?? date('Y');
            
            $sql = "SELECT MONTH(date_paiement_abonnement) as mois, COALESCE(SUM(montant_paiement_abonnement), 0) as total 
            FROM " . TABLES::PAIEMENT_ABONNEMENTS . " 
            WHERE etat_paiement_abonnement = " . ETAT_ACTIF . " 
            AND YEAR(date_paiement_abonnement) = " . $annee . "
            GROUP BY MONTH(date_paiement_abonnement)
            ORDER BY mois";
            
            $stmt = $this->db->query($sql);
            $result = $stmt->fetchAll();

            // Formatage pour le graphique (12 mois)
            $data = array_fill(0, 12, 0);
            foreach ($result as $row) {
                $data[(int)$row['mois'] - 1] = (float) $row['total'];
            }

            return $data;
        } catch (\Exception $e) {
            error_log("Erreur dans getRevenusParMois: " . $e->getMessage());
            return array_fill(0, 12, 0);
        }
    }

    /**
     * Derniers abonnements
     */
    public function getDerniersAbonnements($limit = 5)
    {
        try {
            $sql = "SELECT a.*, ta.libelle_type_abonnement, ta.prix_type_abonnement, p.nom_partner, p.prenom_partner, p.email_partner
            FROM " . TABLES::ABONNEMENTS . " a
            LEFT JOIN " . TABLES::TYPE_ABONNEMENTS . " ta ON ta.code_type_abonnement = a.type_abonnement_code
            LEFT JOIN " . TABLES::PARTNERS . " p ON p.code_partner = a.compte_code
            ORDER BY a.id_abonnement DESC
            LIMIT " . (int)$limit;
            
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            error_log("Erreur dans getDerniersAbonnements: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Partenaires récents
     */
    public function getPartenairesRecents($limit = 5)
    {
        try {
            $sql = "SELECT * FROM " . TABLES::PARTNERS . " 
            ORDER BY id_partner DESC 
            LIMIT " . (int)$limit;
            
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            error_log("Erreur dans getPartenairesRecents: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Types d'abonnements les plus populaires
     */
    public function getTypesAbonnementsPopulaires()
    {
        try {
            $sql = "SELECT ta.libelle_type_abonnement, COUNT(a.id_abonnement) as total
            FROM " . TABLES::ABONNEMENTS . " a
            JOIN " . TABLES::TYPE_ABONNEMENTS . " ta ON ta.code_type_abonnement = a.type_abonnement_code
            WHERE a.etat_abonnement = " . ETAT_ACTIF . "
            GROUP BY ta.code_type_abonnement, ta.libelle_type_abonnement
            ORDER BY total DESC
            LIMIT 5";
            
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            error_log("Erreur dans getTypesAbonnementsPopulaires: " . $e->getMessage());
            return [];
        }
    }
}
