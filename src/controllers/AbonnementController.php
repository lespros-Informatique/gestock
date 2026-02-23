<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Core\Model;
use App\Models\Factory;
use App\Services\AbonnementService;
use App\Services\PaiementAbonnementService;
use TABLES;

class AbonnementController extends MainController
{
    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * SEXION POUR LES VIEWS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function abonnement()
    {
        return $this->view('abonnements/liste', ['title' => 'Abonnements']);
    }

    public function paiementAbonnement()
    {
        return $this->view('paiement_abonnement/liste', ['title' => 'Paiements des abonnements']);
    }

    public function detail($code)
    {
        $abonnement = new Factory();
        $abonnementData = $abonnement->find(TABLES::ABONNEMENTS, 'code_abonnement', $code);
        
        if (!$abonnementData) {
            return $this->view('errors/404', ['title' => 'Erreur 404']);
        }
        
        return $this->view('abonnements/detail', ['title' => 'Détails de l\'abonnement', 'abonnement' => $abonnementData]);
    }


    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function aGetListeAbonnement()
    {
        extract($_POST);
        $output = "";
        $abonnement = new Factory();

        $likeParams = [];
        $whereParams = ['etat_abonnement' => ETAT_ACTIF];
        $orderBy = ["date_debut" => "DESC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['code_abonnement' => $search, 'compte_code' => $search];
        }

        // 🔢 Total
        $total = $abonnement->dataTbleCountTotalRow(TABLES::ABONNEMENTS, $whereParams);

        // 🔢 Total filtré
        $totalFiltered = $abonnement->dataTbleCountTotalRow(TABLES::ABONNEMENTS, $whereParams, $likeParams);

        // 📄 Données
        $abonnementList = $abonnement->DataTableFetchAllListe(TABLES::ABONNEMENTS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = AbonnementService::abonnementDataService($abonnementList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    public function aGetListePaiementAbonnement()
    {
        extract($_POST);
        $output = "";
        $paiement = new Factory();

        $likeParams = [];
        $whereParams = [];
        $orderBy = ["date_paiement_abonnement" => "DESC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['code_paiement_abonnement' => $search, 'abonnement_code' => $search];
        }

        // 🔢 Total
        $total = $paiement->dataTbleCountTotalRow(TABLES::PAIEMENT_ABONNEMENTS, $whereParams);

        // 🔢 Total filtré
        $totalFiltered = $paiement->dataTbleCountTotalRow(TABLES::PAIEMENT_ABONNEMENTS, $whereParams, $likeParams);

        // 📄 Données
        $paiementList = $paiement->DataTableFetchAllListe(TABLES::PAIEMENT_ABONNEMENTS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = PaiementAbonnementService::paiementAbonnementDataService($paiementList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }
}
