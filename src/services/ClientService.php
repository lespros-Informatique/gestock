<?php

namespace App\Services;


class ClientService
{

    public static function clientDataService($clients)
    {
        $data = [];

        $i = 0;
        foreach ($clients as $client) :
            $i++;
            
            $data[] = [
                $i,
                strtoupper($client['nom_client']),
                $client['telephone_client'],
                $client['email_client'] ?? 'N/A',
                $client['sexe_client'] == 'M' ? 'Masculin' : 'Féminin',
                $client['etat_client'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>',
                $client['created_at_client'],
                '<a href="'.url('client/detail/'.$client['code_client']).'" class="btn btn-info btn-sm" title="Détails">\n                                    <i class="fa fa-eye"></i>\n                                </a>'
            ];

        endforeach;

        return $data;
    }
}
