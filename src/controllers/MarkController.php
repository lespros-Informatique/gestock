<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Catalogue;
use App\Models\Factory;
use App\Services\CatalogueService;
use Groupes;

class MarkController extends MainController
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

       public function mark()
     {
          return $this->view('catalogues/mark', ['title' => 'Marque']);
     }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */
    
    public function aDeleteMark()
    {

        $_POST = sanitizePostData($_POST);
        $code_mark = $_POST['code_mark']?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ( $code_mark != null) {

            $data_mark = [
                'etat_mark' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update("marks", 'code_mark', $code_mark, $data_mark);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "mark mark Supprimée avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

public function aModalUpdateMark()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $mark = $this->model->aGetMarkByField("code_mark",$code);
            if (!empty($mark)) {
                $output = CatalogueService::modalUpdateMark($mark);
                $result['data'] = $output;
                $result['code'] = 200;
             }else{
            $result['data'] = "Erreur lors de la recuperation!";
            $result['code'] = 400;
        }

            
        }else{
            $result['data'] = "mark introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);return;
    }
 
    public function aUpdateMark()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_mark']);
        if (!empty($code)) {

            if (!empty($_POST['libelle_mark'])) {
                extract($_POST);
                $fc = new Factory();

                $mark = $this->model->aGetMarkByField("libelle_mark",$libelle_mark);

                if (empty($mark) || ($code == $mark['code_mark'])) {

                    $data_mark = [
                        'libelle_mark' => strtoupper($libelle_mark),
                    ];

                    $rest = $fc->update("marks", 'code_mark', $code, $data_mark);

                    if ($rest) {
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['message'] = "mark mark modifiée avec succes";
                    } else {
                        $msg['message'] = "Echec d'enregistrement!";
                    }
                } else {
                    $msg['message'] = "Desolé! Cette mark existe déjà. ";
                }
            } else {
                $msg['message'] = "Veuillez remplire tous les champs. ";
            }
        } else {
            $msg['message'] = "Erreur de donnée, vueillez ressayer plus tard. ";
        }

        echo json_encode($msg);return;
    }

        public function aModalAddMark()
    {
        $output = "";

        $output = CatalogueService::aModalAddmark();
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


        public function aAjouterMark()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_mark'])) {
            extract($_POST);

            $fc = new Factory();


            if (!$fc->verif("marks","libelle_mark",$libelle_mark)) {
                $code = $fc->generateCode("marks", "code_mark","CAT-",8);
                $data_mark = [
                    'libelle_mark' => strtoupper($libelle_mark),
                    'code_mark' => $code,
                    'compte_code' => COMPTE_CODE,
                    'boutique_code' => BOUTIQUE_CODE
                ];
                if ($fc->create('marks', $data_mark)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "mark enregistré avec succes";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cette mark existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }
}
