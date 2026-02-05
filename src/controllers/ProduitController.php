<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Catalogue;
use App\Models\Factory;
use App\Services\CatalogueService;
use Groupes;
use TABLES;

class ProduitController extends MainController
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
        $this->model = new Catalogue();
    }

    public function produit()
    {
        return $this->view('catalogues/produit', ['title' => 'Produits']);
    }


    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

       public function aGetListeProduit()
    {

        extract($_POST);
        $output = "";
        $produit = new Catalogue();

        $likeParams = [];
        $whereParams = ['compte_code' => COMPTE_CODE,'compte_code' => COMPTE_CODE, 'etat_produit' => ETAT_ACTIF];
        $orderBy = ["libelle_produit" => "ASC","stock_produit" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['libelle_produit' => $search,'stock_produit' => $search,'prix_achat' => $search,'prix_vente' => $search];
        }

        // 🔢 Total
        $total = $produit->dataTbleCountTotalRow(TABLES::PRODUITS, $whereParams);
        // 🔢 Total filtré

        $totalFiltered = $produit->dataTbleCountTotalRow(TABLES::PRODUITS, $whereParams, $likeParams);
        // 📄 Données

        $produitList = $produit->DataTableFetchAllListe(TABLES::PRODUITS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];


        $data = CatalogueService::produitDataService($produitList);
        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
            // "data"            => $data
        ]);
        // echo json_encode(['data' => $total, 'code' => 200]);
        return;
    }

    public function aDeleteProduit()
    {

        $_POST = sanitizePostData($_POST);
        $code_produit = $_POST['code_produit'] ?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ($code_produit != null) {

            $data_produit = [
                'etat_produit' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update(TABLES::PRODUITS, 'code_produit', $code_produit, $data_produit);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "produit produit Supprimée avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

    public function aModalUpdateProduit()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $produit = $this->model->aGetproduitByField("code_produit", $code);
            $categorie = $this->model->aGetCatalogueByFields(TABLES::CATEGORIES, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
            $mark = $this->model->aGetCatalogueByFields(TABLES::MARKS, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
            $unite = $this->model->aGetCatalogueByFields(TABLES::UNITES, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);

            if (!empty($produit)) {
                $output = CatalogueService::modalUpdateProduit($produit, $categorie, $mark, $unite);
                $result['data'] = $output;
                $result['code'] = 200;
            } else {
                $result['data'] = "Erreur lors de la recuperation!";
                $result['code'] = 400;
            }
        } else {
            $result['data'] = "produit introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);
        return;
    }

    public function aUpdateProduit()
    {
        // echo json_encode("domps");return;

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_produit']);

        if (!empty($code)) {

            if (!empty($_POST['libelle_produit'])) {
                extract($_POST);
                $fc = new Factory();

                $produit = $this->model->aGetProduitByField("libelle_produit", $libelle_produit);

                if (empty($produit) || ($code == $produit['code_produit'])) {

                    $data_produit = [
                    'libelle_produit'     => strtoupper(trim($libelle_produit)),
                    'description_produit' => !empty($description_produit) ? ucfirst(trim($description_produit)) : null,

                    'code_bar'            => !empty($code_bar) ? $code_bar : null,
                    'categorie_code'      => !empty($categorie_code) ? $categorie_code : null,
                    'mark_code'           => !empty($mark_code) ? $mark_code : null,
                    'unite_code'          => !empty($unite_code) ? $unite_code : null,

                    'prix_achat'          => ($prix_achat !== '') ? $prix_achat : null,
                    'prix_vente'          => ($prix_vente !== '') ? $prix_vente : null,

                    'garantie_produit'    => ($garantie_produit !== '') ? $garantie_produit : null,
                    'stock_produit'       => ($stock_produit !== '') ? $stock_produit : null,
                ];


                    $rest = $fc->update(TABLES::PRODUITS, 'code_produit', $code, $data_produit);

                    if ($rest) {
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['message'] = "produit produit modifiée avec succes";
                    } else {
                        $msg['message'] = "Echec d'enregistrement!";
                    }
                } else {
                    $msg['message'] = "Desolé! Cette produit existe déjà. ";
                }
            } else {
                $msg['message'] = "Veuillez remplire tous les champs. ";
            }
        } else {
            $msg['message'] = "Erreur de donnée, vueillez ressayer plus tard. ";
        }

        echo json_encode($msg);return;
    }

    public function aModalAddProduits()
    {
        $output = "";
        $categories = $this->model->aGetCatalogueByFields(TABLES::CATEGORIES, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        $marks = $this->model->aGetCatalogueByFields(TABLES::MARKS, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        $unites = $this->model->aGetCatalogueByFields(TABLES::UNITES, 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        // echo json_encode([$categories]);return;
        $output = CatalogueService::aModalAddProduit($categories,$marks,$unites);

        echo json_encode(['data' => $output, 'code' => 200]);return;
    }


    public function aAjouterProduit()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_produit'])) {
            extract($_POST);

            $fc = new Factory();


            if (!$fc->verif("produits", "libelle_produit", $libelle_produit)) {
                $code = $fc->generateCode("produits", "code_produit", "CAT-", 8);
                    
               $data_produit = [
                'code_produit'        => $code,               // ex: PRD_0001
                'code_bar'            => !empty($code_bar) ? $code_bar : null,

                'boutique_code'       => BOUTIQUE_CODE,
                'compte_code'         => COMPTE_CODE,

                'categorie_code'      => !empty($categorie_code) ? $categorie_code : null,
                'mark_code'           => !empty($mark_code) ? $mark_code : null,
                'unite_code'          => !empty($unite_code) ? $unite_code : null,

                'libelle_produit'     => strtoupper(trim($libelle_produit)),
                'description_produit' => !empty($description) ? ucfirst($description) : null,

                'prix_achat'          => !empty($prix_achat) ? $prix_achat : null,
                'prix_vente'          => !empty($prix_vente) ? $prix_vente : null,

                'garantie_produit'    => !empty($garantie_produit) ? $garantie_produit : null,
                'stock_produit'       => !empty($stock_produit) ? $stock_produit : 0

            ];

                if ($fc->create(TABLES::PRODUITS, $data_produit)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "produit enregistré avec succes";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cette produit existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }
}
