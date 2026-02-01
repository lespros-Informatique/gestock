<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Factory;
use App\Services\CatalogueService;
use Groupes;

class CategorieController extends MainController
{

     /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * SEXION POUR LES VIEWS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

       public function categorie()
     {
          return $this->view('catalogues/categorie', ['title' => 'Catégorie']);
     }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */
    
    public function adeleteCategorie()
    {

        $_POST = sanitizePostData($_POST);
        $code_categorie = $_POST['code_categorie']?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ( $code_categorie != null) {

            $data_categorie = [
                'etat_categorie' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update("categories", 'code_categorie', $code_categorie, $data_categorie);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Categorie chambre Supprimée avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

public function amodalUpdateCategorie()
    {

        $_POST = sanitizePostData($_POST);

        $code = decrypter($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $categorie = $fc->verifyParam('type_chambres', 'code_typechambre', $code);
            if (!empty($categorie)) {
                $output = Service::modalUpdateTypeCategorie($categorie);
                $result['data'] = $output;
                $result['code'] = 200;
            }

            echo json_encode($result);
            return;
        }
    }
 
    public function aupdateCategorie()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['id_categorie']);

        if (!empty($code)) {

            if (!empty($_POST['libelle_categorie'])) {
                extract($_POST);

                $fc = new Factory();

                $categorie = $fc->verifTypechambreLibelle($libelle_categorie);

                if (empty($categorie) || ($code == $categorie['code_typechambre'])) {

                    $data_categorie = [
                        'libelle_typechambre' => strtoupper($libelle_categorie),
                        'description_typechambre' => ucfirst($description_categorie),
                    ];

                    $rest = $fc->update("type_chambres", 'code_typechambre', $code, $data_categorie);

                    if ($rest) {
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['message'] = "Categorie chambre modifiée avec succes";
                    } else {
                        $msg['message'] = "Echec d'enregistrement!";
                    }
                } else {
                    $msg['message'] = "Desolé! Cette categorie existe déjà. ";
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

        public function amodalAddCategorie()
    {
        $output = "";

        $output = CatalogueService::amodalAddCategorie();
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


        public function aajouterCategorie()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_categorie'])) {
            extract($_POST);

            $fc = new Factory();


            if (!$fc->verif("categories","libelle_categorie",$libelle_categorie)) {
                $code = $fc->generateCode("categories", "code_categorie","CAT-",8);
                $description = !empty($description_categorie) ?
                    ucfirst($description_categorie) : null;
                $data_categorie = [
                    'libelle_categorie' => strtoupper($libelle_categorie),
                    'code_categorie' => $code,
                    'compte_code' => COMPTE_CODE,
                    'boutique_code' => BOUTIQUE_CODE,
                    'description_categorie' => $description
                ];
                
                if ($fc->create('categories', $data_categorie)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Categorie enregistré avec succes";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cette categorie existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }
}
