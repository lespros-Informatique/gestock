<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\Factory;
use App\Services\AvantageService;
use TABLES;

class AvantageController extends MainController
{

    private $model;
    
    public function __construct()
    {
        $this->model = new Factory();
    }

    public function avantage()
    {
        return $this->view('avantages/liste', ['title' => 'Avantages']);
    }

    public function detail($code)
    {
        $avantage = (new Factory())->find(TABLES::AVANTAGES, 'code_avantage', $code);
        
        // Récupérer le type d'abonnement associé
        $typeAbonnement = null;
        if (!empty($avantage['type_abonnement_code'])) {
            $typeAbonnement = (new Factory())->find(TABLES::TYPE_ABONNEMENTS, 'code_type_abonnement', $avantage['type_abonnement_code']);
        }
        
        return $this->view('avantages/detail', [
            'title' => 'Détails Avantage',
            'avantage' => $avantage,
            'typeAbonnement' => $typeAbonnement
        ]);
    }

    public function getListeAvantage()
    {
        extract($_POST);
        $output = "";
        $avantage = new Factory();

        $likeParams = [];
        $whereParams = ['etat_avantage' => ETAT_ACTIF];
        $orderBy = ["description_avantage" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';

        if (!empty($search)) {
            $likeParams = ['description_avantage' => $search, 'valeur_avantage' => $search];
        }

        $total = $avantage->dataTbleCountTotalRow(TABLES::AVANTAGES, $whereParams);
        $totalFiltered = $avantage->dataTbleCountTotalRow(TABLES::AVANTAGES, $whereParams, $likeParams);
        $avantageList = $avantage->DataTableFetchAllListe(TABLES::AVANTAGES, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];
        $data = AvantageService::avantageDataService($avantageList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    public function aDeleteAvantage()
    {
        $_POST = sanitizePostData($_POST);
        $code_avantage = $_POST['code_avantage'] ?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        
        if ($code_avantage != null) {
            $data_avantage = [
                'etat_avantage' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update(TABLES::AVANTAGES, 'code_avantage', $code_avantage, $data_avantage);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Avantage supprimé avec succès";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        
        echo json_encode($msg);
        return;
    }

    public function modalUpdateAvantage()
    {
        $_POST = sanitizePostData($_POST);
        $code = $_POST['code'];
        $result['code'] = 400;
        $output = "";
        
        if ($code) {
            $fc = new Factory();
            $avantage = $fc->find(TABLES::AVANTAGES, 'code_avantage', $code);
            
            if (!empty($avantage)) {
                // Récupérer les types d'abonnements pour le select
                $typeAbonnements = (new Factory())->findForSelect(
                    TABLES::TYPE_ABONNEMENTS,
                    ['code_type_abonnement', 'libelle_type_abonnement'],
                    'etat_type_abonnement',
                    ETAT_ACTIF,
                    'libelle_type_abonnement'
                );
                $output = AvantageService::modalUpdateAvantage($avantage, $typeAbonnements);
                $result['data'] = $output;
                $result['code'] = 200;
            } else {
                $result['data'] = "Erreur lors de la recuperation!";
                $result['code'] = 400;
            }
        } else {
            $result['data'] = "Avantage introuvable!";
            $result['code'] = 400;
        }
        
        echo json_encode($result);
        return;
    }

    public function updateAvantage()
    {
        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = $_POST['code_avantage'];

        if (!empty($code)) {
            if (!empty($_POST['description_avantage'])) {
                extract($_POST);
                $fc = new Factory();

                $data_avantage = [
                    'description_avantage' => $description_avantage,
                    'type_abonnement_code' => $type_abonnement_code,
                    'valeur_avantage' => $valeur_avantage ?? null,
                ];

                $rest = $fc->update(TABLES::AVANTAGES, 'code_avantage', $code, $data_avantage);

                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Avantage modifié avec succès";
                } else {
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {
                $msg['message'] = "Veuillez remplir tous les champs.";
            }
        } else {
            $msg['message'] = "Erreur de donnée, veuiller ressayer plus tard.";
        }

        echo json_encode($msg);
        return;
    }

    public function modalAddAvantage()
    {
        $fc = new Factory();
        $typeAbonnements = (new Factory())->findForSelect(
            TABLES::TYPE_ABONNEMENTS,
            ['code_type_abonnement', 'libelle_type_abonnement'],
            'etat_type_abonnement',
            ETAT_ACTIF,
            'libelle_type_abonnement'
        );
        $output = AvantageService::modalAddAvantage($typeAbonnements);
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }

    public function ajouterAvantage()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['description_avantage']) && !empty($_POST['type_abonnement_code'])) {
            extract($_POST);

            $fc = new Factory();

            if (!$fc->verif(TABLES::AVANTAGES, "description_avantage", $description_avantage)) {
                $code = $fc->generateCode(TABLES::AVANTAGES, "code_avantage", "AVTG-", 8);
                
                $data_avantage = [
                    'description_avantage' => $description_avantage,
                    'code_avantage' => $code,
                    'type_abonnement_code' => $type_abonnement_code,
                    'valeur_avantage' => $valeur_avantage ?? null,
                    'etat_avantage' => 1
                ];
                
                if ($fc->create(TABLES::AVANTAGES, $data_avantage)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Avantage enregistré avec succès";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {
                $msg['type'] = "warning";
                $msg['message'] = "Désolé! Cet avantage existe déjà.";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplir tous les champs.";
        }
        
        echo json_encode($msg);
    }
}
