<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Services\DashboardService;

class DashboardController extends MainController
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    /**
     * ------------------------------------------------------------------------
     * * SEXION POUR LES VUES
     * ------------------------------------------------------------------------
     */

    /**
     * Page d'accueil - Dashboard
     */
    public function index()
    {
        return $this->view('welcome', ['title' => 'Tableau de bord']);
    }

    /**
     * ------------------------------------------------------------------------
     * * SEXION POUR LES REQUÊTES AJAX
     * ------------------------------------------------------------------------
     */

    /**
     * Récupérer les statistiques du dashboard
     */
    public function getStatistiques()
    {
        $statistiques = $this->dashboardService->getStatistiques();
        
        echo json_encode([
            'code' => 200,
            'data' => $statistiques
        ]);
        return;
    }

    /**
     * Récupérer les données du graphique des abonnements par mois
     */
    public function getAbonnementsChart()
    {
        $annee = $_POST['annee'] ?? date('Y');
        $data = $this->dashboardService->getAbonnementsParMois($annee);
        
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        
        echo json_encode([
            'code' => 200,
            'labels' => $labels,
            'data' => $data
        ]);
        return;
    }

    /**
     * Récupérer les données du graphique des revenus par mois
     */
    public function getRevenusChart()
    {
        $annee = $_POST['annee'] ?? date('Y');
        $data = $this->dashboardService->getRevenusParMois($annee);
        
        $labels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
        
        echo json_encode([
            'code' => 200,
            'labels' => $labels,
            'data' => $data
        ]);
        return;
    }

    /**
     * Récupérer les derniers abonnements
     */
    public function getDerniersAbonnements()
    {
        $limit = $_POST['limit'] ?? 5;
        $abonnes = $this->dashboardService->getDerniersAbonnements($limit);
        
        $html = '';
        foreach ($abonnes as $abonne) {
            $nom = $abonne['nom_partner'] . ' ' . $abonne['prenom_partner'];
            $type = $abonne['libelle_type_abonnement'] ?? 'N/A';
            $date = date('d/m/Y', strtotime($abonne['date_debut']));
            $etat = $abonne['etat_abonnement'] == 1 
                ? '<span class="badge badge-success">Actif</span>' 
                : '<span class="badge badge-danger">Inactif</span>';
            
            $html .= '
            <div class="d-flex align-items-center mb-3">
                <div class="avatar avatar-sm bg-primary rounded-circle mr-3">
                    <span class="avatar-initials">' . strtoupper(substr($abonne['nom_partner'] ?? 'U', 0, 1)) . '</span>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0">' . htmlspecialchars($nom) . '</h6>
                    <small class="text-muted">' . htmlspecialchars($type) . ' - ' . $date . '</small>
                </div>
                ' . $etat . '
            </div>';
        }
        
        if (empty($abonnes)) {
            $html = '<p class="text-muted text-center">Aucun abonnement récent</p>';
        }
        
        echo json_encode([
            'code' => 200,
            'data' => $html
        ]);
        return;
    }

    /**
     * Récupérer les partenaires récents
     */
    public function getPartenairesRecents()
    {
        $limit = $_POST['limit'] ?? 5;
        $partenaires = $this->dashboardService->getPartenairesRecents($limit);
        
        $html = '';
        foreach ($partenaires as $partner) {
            $nom = $partner['nom_partner'] . ' ' . $partner['prenom_partner'];
            $email = $partner['email_partner'] ?? 'N/A';
            $tel = $partner['telephone_partner'] ?? 'N/A';
            $etat = $partner['etat_partner'] == 1 
                ? '<span class="badge badge-success">Actif</span>' 
                : '<span class="badge badge-warning">Inactif</span>';
            
            $html .= '
            <div class="d-flex align-items-center mb-3">
                <div class="avatar avatar-sm bg-info rounded-circle mr-3">
                    <span class="avatar-initials">' . strtoupper(substr($partner['nom_partner'] ?? 'P', 0, 1)) . '</span>
                </div>
                <div class="flex-grow-1">
                    <h6 class="mb-0">' . htmlspecialchars($nom) . '</h6>
                    <small class="text-muted">' . htmlspecialchars($tel) . '</small>
                </div>
                ' . $etat . '
            </div>';
        }
        
        if (empty($partenaires)) {
            $html = '<p class="text-muted text-center">Aucun partenaire récent</p>';
        }
        
        echo json_encode([
            'code' => 200,
            'data' => $html
        ]);
        return;
    }

    /**
     * Récupérer les types d'abonnements populaires
     */
    public function getTypesPopulaires()
    {
        $types = $this->dashboardService->getTypesAbonnementsPopulaires();
        
        $html = '';
        foreach ($types as $type) {
            $pourcentage = $type['total'] > 0 ? ($type['total'] / array_sum(array_column($types, 'total')) * 100) : 0;
            
            $html .= '
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-1">
                    <span>' . htmlspecialchars($type['libelle_type_abonnement']) . '</span>
                    <span class="font-weight-bold">' . $type['total'] . '</span>
                </div>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: ' . $pourcentage . '%"></div>
                </div>
            </div>';
        }
        
        if (empty($types)) {
            $html = '<p class="text-muted text-center">Aucune donnée disponible</p>';
        }
        
        echo json_encode([
            'code' => 200,
            'data' => $html
        ]);
        return;
    }
}
