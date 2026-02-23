<?php

namespace App\Services;


class AbonnementService
{

    public static function abonnementDataService($abonnements)
    {
        $data = [];

        $i = 0;
        foreach ($abonnements as $abonnement) :
            $i++;
            
            // Déterminer l'état de l'abonnement
            $etatBadge = '';
            if ($abonnement['etat_abonnement'] == 1) {
                // Vérifier si expire
                if (!empty($abonnement['date_fin'])) {
                    $dateFin = new \DateTime($abonnement['date_fin']);
                    $aujourdhui = new \DateTime();
                    if ($dateFin < $aujourdhui) {
                        $etatBadge = '<span class="badge badge-warning">Expiré</span>';
                    } else {
                        $etatBadge = '<span class="badge badge-success">Actif</span>';
                    }
                } else {
                    $etatBadge = '<span class="badge badge-success">Actif</span>';
                }
            } else {
                $etatBadge = '<span class="badge badge-danger">Inactif</span>';
            }
            
            $data[] = [
                $i,
                $abonnement['code_abonnement'],
                $abonnement['compte_code'],
                $abonnement['type_abonnement_code'],
                $abonnement['date_debut'] ?? 'N/A',
                $abonnement['date_fin'] ?? 'N/A',
                $etatBadge,
                '<a href="'.url('abonnement/detail/'.$abonnement['code_abonnement']).'" class="btn btn-info btn-sm" title="Détails"> <i class="fa fa-eye"></i> Détails</a>'
            ];

        endforeach;

        return $data;
    }
}
