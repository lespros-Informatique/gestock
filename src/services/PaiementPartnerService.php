<?php

namespace App\Services;


class PaiementPartnerService
{

    public static function paiementPartnerDataService($paiements)
    {
        $data = [];

        $i = 0;
        foreach ($paiements as $paiement) :
            $i++;
            
            $data[] = [
                $i,
                $paiement['code_paiement_partner'],
                number_format($paiement['montant_paiement_partner'], 0, ',', ' ') . ' CFA',
                $paiement['telephone_paiement_partner'] ?? 'N/A',
                $paiement['user_code'] ?? 'N/A',
                $paiement['created_at_paiement_partner'] ?? 'N/A',
                $paiement['etat_paiement_partner'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'
            ];

        endforeach;

        return $data;
    }
}
