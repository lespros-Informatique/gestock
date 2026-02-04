<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Catalogue;
use App\Models\Factory;
use App\Services\CatalogueService;
use Groupes;

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
            $rest = (new Factory())->update("produits", 'code_produit', $code_produit, $data_produit);
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
            $categorie = $this->model->aGetCatalogueByFields('categories', 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
            $mark = $this->model->aGetCatalogueByFields("marks", 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
            $unite = $this->model->aGetCatalogueByFields("unites", 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);

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
                        'libelle_produit' => strtoupper($libelle_produit),
                        'description_produit' => ucfirst($description_produit),
                    ];

                    $rest = $fc->update("produits", 'code_produit', $code, $data_produit);

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

        echo json_encode($msg);
        return;
    }

    public function aModalAddProduit()
    {
        $output = "";
        $categorie = $this->model->aGetCatalogueByFields('categories', 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        $mark = $this->model->aGetCatalogueByFields("marks", 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        $unite = $this->model->aGetCatalogueByFields("unites", 'compte_code', 'boutique_code', COMPTE_CODE, BOUTIQUE_CODE);
        $output = CatalogueService::aModalAddProduit($categorie, $mark, $unite);
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
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
                $description = !empty($description_produit) ?
                    ucfirst($description_produit) : null;
                $data_produit = [
                    'libelle_produit' => strtoupper($libelle_produit),
                    'code_produit' => $code,
                    'compte_code' => COMPTE_CODE,
                    'boutique_code' => BOUTIQUE_CODE,
                    'description_produit' => $description
                ];

                if ($fc->create('produits', $data_produit)) {
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
