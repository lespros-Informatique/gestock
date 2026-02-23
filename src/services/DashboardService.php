<?php

namespace App\Services;

use App\Models\Dashboard;

class DashboardService
{
    private Dashboard $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new Dashboard();
    }

    /**
     * Récupérer les statistiques générales du dashboard
     */
    public function getStatistiques()
    {
        return [
            'totalApplications' => $this->dashboardModel->countApplications(),
            'totalPartenaires' => $this->dashboardModel->countPartenaires(),
            'totalClients' => $this->dashboardModel->countClients(),
            'totalAbonnements' => $this->dashboardModel->countAbonnements(),
            'revenuTotal' => $this->dashboardModel->sumRevenuTotal(),
            'revenuMoisEnCours' => $this->dashboardModel->sumRevenuMoisEnCours()
        ];
    }

    /**
     * Récupérer les données pour le graphique des abonnements par mois
     */
    public function getAbonnementsParMois($annee = null)
    {
        return $this->dashboardModel->getAbonnementsParMois($annee);
    }

    /**
     * Récupérer les données pour le graphique des revenus par mois
     */
    public function getRevenusParMois($annee = null)
    {
        return $this->dashboardModel->getRevenusParMois($annee);
    }

    /**
     * Récupérer les derniers abonnements
     */
    public function getDerniersAbonnements($limit = 5)
    {
        return $this->dashboardModel->getDerniersAbonnements($limit);
    }

    /**
     * Récupérer les partenaires récents
     */
    public function getPartenairesRecents($limit = 5)
    {
        return $this->dashboardModel->getPartenairesRecents($limit);
    }

    /**
     * Récupérer les types d'abonnements les plus populaires
     */
    public function getTypesAbonnementsPopulaires()
    {
        return $this->dashboardModel->getTypesAbonnementsPopulaires();
    }

    /**
     * Formater les données pour le graphique Chart.js
     */
    public static function formatChartData($labels, $data, $label = 'Données')
    {
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $label,
                    'data' => $data,
                    'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                    'borderColor' => 'rgba(54, 162, 235, 1)',
                    'borderWidth' => 1,
                    'borderRadius' => 5
                ]
            ]
        ];
    }
}
