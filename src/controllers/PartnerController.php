<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Core\Model;
use App\Models\Factory;
use App\Services\PartnerService;
use App\Services\ComptePartnerService;
use App\Services\PaiementPartnerService;
use TABLES;

class PartnerController extends MainController
{

     /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * SEXION POUR LES VIEWS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

      private $model;
      public function __construct()
      {
         $this->model = new Factory();
      }

      public function partner()
      {
           return $this->view('partners/liste', ['title' => 'Partenaires']);
      }

      public function comptePartner()
      {
           return $this->view('compte_partner/liste', ['title' => 'Comptes partenaires']);
      }

      public function paiementPartner()
      {
           return $this->view('paiement_partner/liste', ['title' => 'Paiements partenaires']);
      }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

        public function aGetListePartner()
    {
        extract($_POST);
        $output = "";
        $partner = new Factory();

        $likeParams = [];
        $whereParams = ['etat_partner' => ETAT_ACTIF];
        $orderBy = ["nom_partner" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['nom_partner' => $search, 'prenom_partner' => $search, 'email_partner' => $search];
        }

        // 🔢 Total
        $total = $partner->dataTbleCountTotalRow(TABLES::PARTNERS, $whereParams);
        // 🔢 Total filtré

        $totalFiltered = $partner->dataTbleCountTotalRow(TABLES::PARTNERS, $whereParams, $likeParams);
        // 📄 Données

        $partnerList = $partner->DataTableFetchAllListe(TABLES::PARTNERS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = PartnerService::partnerDataService($partnerList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    
    public function aDeletePartner()
    {

        $_POST = sanitizePostData($_POST);
        $code_partner = $_POST['code_partner']?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ( $code_partner != null) {

            $data_partner = [
                'etat_partner' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update(TABLES::PARTNERS, 'code_partner', $code_partner, $data_partner);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Partenaire supprimé avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

    public function aModalUpdatePartner()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $partner = $fc->find(TABLES::PARTNERS, 'code_partner', $code);
            if (!empty($partner)) {
                $output = PartnerService::modalUpdatePartner($partner);
                $result['data'] = $output;
                $result['code'] = 200;
             }else{
             $result['data'] = "Erreur lors de la recuperation!";
             $result['code'] = 400;
         }

             
        }else{
            $result['data'] = "Partenaire introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);return;
    }

    public function aUpdatePartner()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_partner']);

        if (!empty($code)) {

            if (!empty($_POST['nom_partner']) && !empty($_POST['email_partner'])) {
                extract($_POST);
                $fc = new Factory();

                $data_partner = [
                    'nom_partner' => strtoupper($nom_partner),
                    'prenom_partner' => ucfirst($prenom_partner),
                    'email_partner' => strtolower($email_partner),
                    'telephone_partner' => $telephone_partner,
                ];

                $rest = $fc->update(TABLES::PARTNERS, 'code_partner', $code, $data_partner);

                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Partenaire modifié avec succes";
                } else {
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {
                $msg['message'] = "Veuillez remplire tous les champs. ";
            }
        } else {
            $msg['message'] = "Erreur de donnée, vueillez ressayer plus tard. ";
        }

        echo json_encode($msg);
        return;
    }

        public function amodalAddPartner()
    {
        $output = PartnerService::modalAddPartner();
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


        public function aAjouterPartner()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['nom_partner']) && !empty($_POST['email_partner'])) {
            extract($_POST);

            $fc = new Factory();


            if (!$fc->verif(TABLES::PARTNERS,"email_partner",$email_partner)) {
                $code = $fc->generateCode(TABLES::PARTNERS, "code_partner","PART-",8);
                $data_partner = [
                    'nom_partner' => strtoupper($nom_partner),
                    'prenom_partner' => ucfirst($prenom_partner),
                    'email_partner' => strtolower($email_partner),
                    'telephone_partner' => $telephone_partner,
                    'code_partner' => $code,
                    'etat_partner' => 1,
                    'created_at_partner' => Model::dateActuelle()
                ];
                
                if ($fc->create(TABLES::PARTNERS, $data_partner)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Partenaire enregistré avec succes";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cet email existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }

    public function aGetListeComptePartner()
    {
        extract($_POST);
        $output = "";
        $compte = new Factory();

        $likeParams = [];
        $whereParams = [];
        $orderBy = ["id_compte" => "DESC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['code_compte_partner' => $search];
        }

        // 🔢 Total
        $total = $compte->dataTbleCountTotalRow(TABLES::COMPTE_PARTNER, $whereParams);

        // 🔢 Total filtré
        $totalFiltered = $compte->dataTbleCountTotalRow(TABLES::COMPTE_PARTNER, $whereParams, $likeParams);

        // 📄 Données
        $compteList = $compte->DataTableFetchAllListe(TABLES::COMPTE_PARTNER, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = ComptePartnerService::comptePartnerDataService($compteList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    public function aGetListePaiementPartner()
    {
        extract($_POST);
        $output = "";
        $paiement = new Factory();

        $likeParams = [];
        $whereParams = [];
        $orderBy = ["created_at_paiement_partner" => "DESC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['code_paiement_partner' => $search, 'user_code' => $search];
        }

        // 🔢 Total
        $total = $paiement->dataTbleCountTotalRow(TABLES::PAIEMENT_PARTNER, $whereParams);

        // 🔢 Total filtré
        $totalFiltered = $paiement->dataTbleCountTotalRow(TABLES::PAIEMENT_PARTNER, $whereParams, $likeParams);

        // 📄 Données
        $paiementList = $paiement->DataTableFetchAllListe(TABLES::PAIEMENT_PARTNER, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = PaiementPartnerService::paiementPartnerDataService($paiementList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }
}
