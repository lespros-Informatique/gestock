<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Core\Model;
use App\Models\Factory;
use App\Services\ClientService;
use TABLES;

class ClientController extends MainController
{
    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function client()
    {
        return $this->view('clients/liste', ['title' => 'Clients']);
    }

    public function detail($code)
    {
        $client = new Factory();
        $clientData = $client->find(TABLES::CLIENTS, 'code_client', $code);
        
        if (!$clientData) {
            return $this->view('errors/404', ['title' => 'Erreur 404']);
        }
        
        return $this->view('clients/detail', ['title' => 'Détails du client', 'client' => $clientData]);
    }


    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function aGetListeClient()
    {
        extract($_POST);
        $output = "";
        $client = new Factory();

        $likeParams = [];
        $whereParams = ['etat_client' => ETAT_ACTIF];
        $orderBy = ["nom_client" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['nom_client' => $search, 'telephone_client' => $search, 'email_client' => $search];
        }

        // 🔢 Total
        $total = $client->dataTbleCountTotalRow(TABLES::CLIENTS, $whereParams);

        // 🔢 Total filtré
        $totalFiltered = $client->dataTbleCountTotalRow(TABLES::CLIENTS, $whereParams, $likeParams);

        // 📄 Données
        $clientList = $client->DataTableFetchAllListe(TABLES::CLIENTS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = ClientService::clientDataService($clientList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }
}
