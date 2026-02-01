<?php
namespace App\Controllers;

use App\Core\Auth;
use App\Core\MainController;
use App\Models\Factory;
use App\Services\Service;
use Groupes;

class Controller extends MainController
{

     /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * SEXION POUR LES VIEWS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

        public function testing()
    {
        $fc = new Factory();
        $users = $fc->getAllReservationsArrive('2025-11-22 23:59:59','2025-12-25 23:59:59');

        return $this->view('trash/test', ["users" => $users, 'title' => 'Gestion des roles']);
    }


     public function role()
    {
        if (Auth::hasGroupe(Groupes::SUPER)) {
            $user = (new Factory())->getSupUserWithFoction();
            
            $this->view('admins/role', ["users" => $user, 'title' => 'Gestion des roles']);

            return;
        }
        
        $user = (new Factory())->getUserWithFoction();

        return $this->view('admins/role', ["users" => $user, 'title' => 'Gestion des roles']);
    }


      /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */
    
    

    public function loadDataRole()
    {

        $output = "";
        $_POST = sanitizePostData($_POST);
        $code_role = $_POST['code_role'];
        $code_user = $_POST['code_user'];

        $factory = new Factory();

        
        $roles = $factory->select('roles')->where('groupe', $code_role)->all();
        $userPermissions = $factory->getAllPermissionForUser($code_user);

        $userRolesPermissions = $this->resolveTablePermission($userPermissions);
        // $output = $userRolesPermissions;

        if ($roles) {

            foreach ($roles as $data) {
                $equal = $this->checkIfExistRole($userRolesPermissions, $data);

                $c = $equal['create'] ? 'checked' : '';
                $s = $equal['show'] ? 'checked' : '';
                $e = $equal['edit'] ? 'checked' : '';
                $d = $equal['delete'] ? 'checked' : '';

                $output .= '
                <tr data-id="' . $data['code_role'] . '" >
                    <td> &nbsp; &nbsp;' . $data['name'] . '</td>
                    <td><input id="create' . $data['code_role'] . '" ' . $c . ' class="perm" data-type="create" type="checkbox"></td>
                    <td><input id="show' . $data['code_role'] . '" ' . $s . ' class="perm" data-type="show" type="checkbox"></td>
                    <td><input id="edit' . $data['code_role'] . '" ' . $e . ' class="perm" data-type="edit" type="checkbox"></td>
                    <td><input id="delete' . $data['code_role'] . '" ' . $d . ' class="perm" data-type="delete" type="checkbox"></td>
                </tr>
                ';
            }
        }

        // echo json_encode(['data' => $userRolesPermissions,'code' => 200]);
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


    public function ajouterPermissionRole()
    {

        $output = "";
        $msg['code'] = 400;
        $userCode = $_POST['codeuser'];

        $rolesData = json_decode($_POST["roles"], true);

        if ($rolesData) {


            foreach ($rolesData as $role) {

                if ($role["create"] || $role["show"] || $role["edit"] || $role["delete"]) {
                    $dataPermissions = [
                    ':user_id' => $userCode,
                    ':role_id' => $role["role"],
                    ':create_permission' => $role["create"],
                    ':show_permission' => $role["show"],
                    ':edit_permission' => $role["edit"],
                    ':delete_permission' => $role["delete"]
                ];
                    $role = (new Factory())->createPermission($dataPermissions);

                } else {
                    $role = (new Factory())->deletePermission($userCode, $role["role"]);
                }
               

            }


            $msg['type'] = "success";
            $msg['code'] = 200;
            $msg['message'] = "Operation effectuée avec succes. ";
        } else {

            $msg['type'] = "warning";
            $msg['message'] = "Erreur de validation. ";
        }

        echo json_encode($msg);

        return;
    }


    public function modalAddPermission()
    {

        $code = $_POST['code_user'];
        $html = "";

        $user = (new Factory())->find('users','code_user',$code);
       
    

        $fullName = $user['nom'] . ' ' . $user['prenom'];
        $groupes = (new Factory())->groupes();

        if (!empty($groupes)) {
        $html = Service::rolesDataGroupes($groupes, $code);
        }

        echo json_encode(['user' => $fullName, 'data' => $html, 'code' => 200]);
        return;
    }

  

    public function resolveTablePermission($UserPermission)
    {

        $permissions = [];

        if (empty($UserPermission)) return [];

        foreach ($UserPermission as $key => $value) {

            $permissions[$value['role_id']] = [
                'create' => $value['create_permission'],
                'edit'   => $value['edit_permission'],
                'show'   => $value['show_permission'],
                'delete' => $value['delete_permission'],
            ];
        }

        return $permissions;
    }

    public function checkIfExistRole($user_permissions, $role)
    {
        return $user_permissions[$role['code_role']] ?? ['create' => 0, 'show' => 0, 'edit' => 0, 'delete' => 0];
    }

 
}
