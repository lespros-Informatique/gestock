<?php

namespace App\Services;


class PaiementAbonnementService
{

    public static function paiementAbonnementDataService($paiements)
    {
        $data = [];

        $i = 0;
        foreach ($paiements as $paiement) :
            $i++;
            
            $data[] = [
                $i,
                $paiement['code_paiement_abonnement'],
                $paiement['abonnement_code'] ?? 'N/A',
                number_format($paiement['montant_paiement_abonnement'], 0, ',', ' ') . ' CFA',
                $paiement['date_paiement_abonnement'] ?? 'N/A',
                $paiement['etat_paiement_abonnement'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'
            ];

        endforeach;

        return $data;
    }
}
