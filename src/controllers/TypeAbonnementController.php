<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\Factory;
use App\Services\TypeAbonnementService;
use TABLES;

class TypeAbonnementController extends MainController
{

    private $model;
    
    public function __construct()
    {
        $this->model = new Factory();
    }

    public function typeAbonnement()
    {
        return $this->view('type_abonnement/liste', ['title' => 'Types d\'abonnements']);
    }

    public function detail($code)
    {
        $typeAbonnement = (new Factory())->find(TABLES::TYPE_ABONNEMENTS, 'code_type_abonnement', $code);
        
        // Récupérer l'application associée
        $application = null;
        if (!empty($typeAbonnement['application_code'])) {
            $application = (new Factory())->find(TABLES::APPLICATIONS, 'code_application', $typeAbonnement['application_code']);
        }
        
        return $this->view('type_abonnement/detail', [
            'title' => 'Détails Type Abonnement',
            'typeAbonnement' => $typeAbonnement,
            'application' => $application
        ]);
    }

    public function getListeTypeAbonnement()
    {
        extract($_POST);
        $output = "";
        $typeAbonnement = new Factory();

        $likeParams = [];
        $whereParams = ['etat_type_abonnement' => ETAT_ACTIF];
        $orderBy = ["libelle_type_abonnement" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';

        if (!empty($search)) {
            $likeParams = ['libelle_type_abonnement' => $search, 'periode_type_abonnement' => $search];
        }

        $total = $typeAbonnement->dataTbleCountTotalRow(TABLES::TYPE_ABONNEMENTS, $whereParams);
        $totalFiltered = $typeAbonnement->dataTbleCountTotalRow(TABLES::TYPE_ABONNEMENTS, $whereParams, $likeParams);
        $typeAbonnementList = $typeAbonnement->DataTableFetchAllListe(TABLES::TYPE_ABONNEMENTS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];
        $data = TypeAbonnementService::typeAbonnementDataService($typeAbonnementList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    public function aDeleteTypeAbonnement()
    {
        $_POST = sanitizePostData($_POST);
        $code_type_abonnement = $_POST['code_type_abonnement'] ?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        
        if ($code_type_abonnement != null) {
            $data_type_abonnement = [
                'etat_type_abonnement' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update(TABLES::TYPE_ABONNEMENTS, 'code_type_abonnement', $code_type_abonnement, $data_type_abonnement);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Type d'abonnement supprimé avec succès";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        
        echo json_encode($msg);
        return;
    }

    public function aModalUpdateTypeAbonnement()
    {
        $_POST = sanitizePostData($_POST);
        $code = $_POST['code'];
        $result['code'] = 400;
        $output = "";
        
        if ($code) {
            $fc = new Factory();
            $typeAbonnement = $fc->find(TABLES::TYPE_ABONNEMENTS, 'code_type_abonnement', $code);
            
            if (!empty($typeAbonnement)) {
                // Récupérer les applications pour le select
                $applications = (new Factory())->findForSelect(
                    TABLES::APPLICATIONS,
                    ['code_application', 'libelle_application'],
                    'etat_application',
                    ETAT_ACTIF,
                    'libelle_application'
                );
                $output = TypeAbonnementService::modalUpdateTypeAbonnement($typeAbonnement, $applications);
                $result['data'] = $output;
                $result['code'] = 200;
            } else {
                $result['data'] = "Erreur lors de la recuperation!";
                $result['code'] = 400;
            }
        } else {
            $result['data'] = "Type d'abonnement introuvable!";
            $result['code'] = 400;
        }
        
        echo json_encode($result);
        return;
    }

    public function updateTypeAbonnement()
    {
        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = $_POST['code_type_abonnement'];

        if (!empty($code)) {
            if (!empty($_POST['libelle_type_abonnement'])) {
                extract($_POST);
                $fc = new Factory();

                $data_type_abonnement = [
                    'libelle_type_abonnement' => $libelle_type_abonnement,
                    'application_code' => $application_code,
                    'prix_type_abonnement' => $prix_type_abonnement ?? null,
                    'periode_type_abonnement' => $periode_type_abonnement ?? null,
                ];

                $rest = $fc->update(TABLES::TYPE_ABONNEMENTS, 'code_type_abonnement', $code, $data_type_abonnement);

                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Type d'abonnement modifié avec succès";
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

    public function modalAddTypeAbonnement()
    {
        $fc = new Factory();
        $applications = (new Factory())->findForSelect(
            TABLES::APPLICATIONS,
            ['code_application', 'libelle_application'],
            'etat_application',
            ETAT_ACTIF,
            'libelle_application'
        );
        // var_dump($applications);return;
        $output = TypeAbonnementService::modalAddTypeAbonnement($applications);
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }

    public function ajouterTypeAbonnement()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_type_abonnement']) && !empty($_POST['application_code'])) {
            extract($_POST);

            $fc = new Factory();

            if (!$fc->verif(TABLES::TYPE_ABONNEMENTS, "libelle_type_abonnement", $libelle_type_abonnement)) {
                $code = $fc->generateCode(TABLES::TYPE_ABONNEMENTS, "code_type_abonnement", "TYPEAB-", 8);
                
                $data_type_abonnement = [
                    'libelle_type_abonnement' => $libelle_type_abonnement,
                    'code_type_abonnement' => $code,
                    'application_code' => $application_code,
                    'prix_type_abonnement' => $prix_type_abonnement ?? null,
                    'periode_type_abonnement' => $periode_type_abonnement ?? null,
                    'etat_type_abonnement' => 1
                ];
                
                if ($fc->create(TABLES::TYPE_ABONNEMENTS, $data_type_abonnement)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Type d'abonnement enregistré avec succès";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {
                $msg['type'] = "warning";
                $msg['message'] = "Désolé! Ce type d'abonnement existe déjà.";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplir tous les champs.";
        }
        
        echo json_encode($msg);
    }
}
