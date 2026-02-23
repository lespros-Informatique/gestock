<?php

namespace App\Services;


class ComptePartnerService
{

    public static function comptePartnerDataService($comptes)
    {
        $data = [];

        $i = 0;
        foreach ($comptes as $compte) :
            $i++;
            
            $data[] = [
                $i,
                $compte['code_compte_partner'],
                number_format($compte['montant_compte'], 0, ',', ' ') . ' CFA',
                number_format($compte['sous_compte'], 0, ',', ' ') . ' CFA',
                $compte['etat_compte'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>'
            ];

        endforeach;

        return $data;
    }
}
