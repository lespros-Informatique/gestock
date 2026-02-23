<?php
namespace App\Controllers;

use App\Core\MainController;
use App\Models\Factory;
use TABLES;

class RoleController extends MainController
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

      public function role()
      {
           return $this->view('admins/role', ['title' => 'Rôles']);
      }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

          public function aGetListeRole()
    {

        extract($_POST);
        $output = "";
        $role = new Factory();

        $likeParams = [];
        $whereParams = [];
        $orderBy = ["libelle_role" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['libelle_role' => $search, 'code_role' => $search];
        }

        // 🔢 Total
        $total = $role->dataTbleCountTotalRow(TABLES::ROLES, $whereParams);
        // 🔢 Total filtré

        $totalFiltered = $role->dataTbleCountTotalRow(TABLES::ROLES, $whereParams, $likeParams);
        // 📄 Données

        $roleList = $role->DataTableFetchAllListe(TABLES::ROLES, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        if (!empty($roleList)) {
            $i = 1;
            foreach ($roleList as $value) {
                $nestedData = [];
                $nestedData[] = $i++;
                $nestedData[] = $value['code_role'];
                $nestedData[] = $value['libelle_role'];
                $nestedData[] = '<button class="btn btn-primary btn-sm" onclick="editRole(\'' . $value['code_role'] . '\')"><i class="fa fa-edit"></i></button>';
                $data[] = $nestedData;
            }
        }

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }

    
    public function aDeleteRole()
    {

        $_POST = sanitizePostData($_POST);
        $code_role = $_POST['code_role']?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ( $code_role != null) {

            $rest = (new Factory())->delete(TABLES::ROLES, 'code_role', $code_role);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Rôle supprimé avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

public function aModalUpdateRole()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $role = $fc->find(TABLES::ROLES, 'code_role', $code);
            if (!empty($role)) {
                $output = $this->modalUpdateRole($role);
                $result['data'] = $output;
                $result['code'] = 200;
             }else{
             $result['data'] = "Erreur lors de la recuperation!";
             $result['code'] = 400;
         }

             
        }else{
            $result['data'] = "Rôle introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);return;
    }
 
    private function modalUpdateRole($role)
    {
        $output = '
        <form id="formUpdateRole">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_role" value="'.$role['libelle_role'].'" required>
                        <input type="hidden" name="code_role" value="'.$role['code_role'].'">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
        return $output;
    }

    public function aUpdateRole()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_role']);

        if (!empty($code)) {

            if (!empty($_POST['libelle_role'])) {
                extract($_POST);
                $fc = new Factory();

                $data_role = [
                    'libelle_role' => $libelle_role,
                ];

                $rest = $fc->update(TABLES::ROLES, 'code_role', $code, $data_role);

                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Rôle modifié avec succes";
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

        public function amodalAddRole()
    {
        $output = '
        <form id="formAddRole">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_role" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


        public function aAjouterRole()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_role'])) {
            extract($_POST);

            $fc = new Factory();

            $code = $fc->generateCode(TABLES::ROLES, "code_role","ROLE-",8);
            $data_role = [
                'libelle_role' => $libelle_role,
                'code_role' => $code,
            ];
            
            if ($fc->create(TABLES::ROLES, $data_role)) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Rôle enregistré avec succes";
            } else {
                $msg['type'] = "warning";
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }
}
