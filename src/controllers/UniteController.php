<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Catalogue;
use App\Models\Factory;
use App\Services\CatalogueService;
use Groupes;

class UniteController extends MainController
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

       public function unite()
     {
          return $this->view('catalogues/unite', ['title' => 'Unité']);
     }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */
    
    public function aDeleteUnite()
    {

        $_POST = sanitizePostData($_POST);
        $code_unite = $_POST['code_unite']?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ( $code_unite != null) {

            $data_unite = [
                'etat_unite' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update("unites", 'code_unite', $code_unite, $data_unite);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "unite unite Supprimée avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

public function aModalUpdateUnite()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $unite = $this->model->aGetUniteByField("code_unite",$code);
            if (!empty($unite)) {
                $output = CatalogueService::modalUpdateUnite($unite);
                $result['data'] = $output;
                $result['code'] = 200;
             }else{
            $result['data'] = "Erreur lors de la recuperation!";
            $result['code'] = 400;
        }

            
        }else{
            $result['data'] = "unite introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);return;
    }
 
    public function aUpdateUnite()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_unite']);

        if (!empty($code)) {

            if (!empty($_POST['libelle_unite'])) {
                extract($_POST);
                $fc = new Factory();

                $unite = $this->model->aGetUniteByField("libelle_unite",$libelle_unite);

                if (empty($unite) || ($code == $unite['code_unite'])) {

                    $data_unite = [
                        'libelle_unite' => strtoupper($libelle_unite),
                    ];

                    $rest = $fc->update("unites", 'code_unite', $code, $data_unite);

                    if ($rest) {
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['message'] = "unite unite modifiée avec succes";
                    } else {
                        $msg['message'] = "Echec d'enregistrement!";
                    }
                } else {
                    $msg['message'] = "Desolé! Cette unite existe déjà. ";
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

        public function aModalAddUnite()
    {
        $output = "";

        $output = CatalogueService::aModalAddUnite();
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


        public function aAjouterUnite()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_unite'])) {
            extract($_POST);

            $fc = new Factory();


            if (!$fc->verif("unites","libelle_unite",$libelle_unite)) {
                $code = $fc->generateCode("unites", "code_unite","CAT-",8);
                $data_unite = [
                    'libelle_unite' => strtoupper($libelle_unite),
                    'code_unite' => $code,
                    'compte_code' => COMPTE_CODE,
                    'boutique_code' => BOUTIQUE_CODE
                ];
                if ($fc->create('unites', $data_unite)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "unite enregistré avec succes";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cette unite existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }
}
