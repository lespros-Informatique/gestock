<?php

namespace App\Models;

use App\Core\Auth;
use App\Core\Model;
use Exception;
use TABLES;

class User extends Model
{
    protected string $table = "users";
    public string $id = 'code_user';

    // get all fonction
    public function getAllFonctions(): array
    {
        $data = [];
        try {
            $sql = "SELECT * FROM fonctions AS fn WHERE fn.hotel_id = :hotel AND etat_fonction = 1 ORDER BY libelle_fonction";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['hotel' => Auth::user('hotel_id')]);
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getUserGroups(string $userCode): array
    {
        $data = [];
        try {
            $sql = "SELECT r.groupe FROM " . TABLES::ROLES . " AS r 
            JOIN " . TABLES::USER_ROLES . " ur ON r.code_role = ur.role_code WHERE ur.user_code = :userCode GROUP BY r.groupe";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode]);
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getUserRoles(string $userCode): array
    {
        $data = [];
        try {
            $sql = "SELECT r.code_role, r.libelle_role, r.description, ur.* FROM " . TABLES::ROLES . " AS r 
            JOIN " . TABLES::USER_ROLES . " ur ON r.code_role = ur.role_code WHERE ur.user_code = :userCode GROUP BY r.code_role";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['userCode' => $userCode]);
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getUserDataForLogin(string $login, $value)
    {
        $data = [];
        try {
            $sql = "SELECT bt.etat_boutique, code_user,password_user,nom_user,prenom_user ,f.libelle_fonction, f.code_fonction, u.boutique_code  FROM " . TABLES::USERS . " AS u
            JOIN " . TABLES::FONCTIONS . " AS f ON f.code_fonction = u.fonction_code
            JOIN " . TABLES::BOUTIQUES . " AS bt ON bt.code_boutique = u.boutique_code 
        WHERE {$login} = :login AND etat_user = 1  LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute(['login' => $value]);
            $data = $stmt->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getUserByCodeWithFoction($codeUser): ?array
    {
        $data = [];
        try {
            $sql = "SELECT us.*, fn.libelle_fonction FROM users AS us JOIN fonctions fn ON fn.code_fonction = us.fonction_id 
            WHERE us.hotel_id = :hotel_id AND us.code_user = :code LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'code' => $codeUser,
                'hotel_id' => Auth::user('hotel_id')
            ]);
            if ($stmt->rowCount() > 0)
                $data = $stmt->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getUserWithFoction($etat = 1): ?array
    {
        $data = [];
        try {
            $sql = "SELECT us.*, fn.libelle_fonction FROM users AS us JOIN fonctions fn ON fn.code_fonction = us.fonction_id AND etat_fonction = :etat 
            WHERE us.hotel_id = :hotel_id  ORDER BY etat_user DESC, us.nom";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'etat' => $etat,
                'hotel_id' => Auth::user('hotel_id')
            ]);
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getSupUserWithFoction(): ?array
    {
        $data = [];
        try {
            $sql = "SELECT us.*, fn.libelle_fonction FROM users AS us 
            JOIN fonctions fn ON fn.code_fonction = us.fonction_id
            WHERE us.hotel_id = :hotel_id ORDER BY us.nom";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['hotel_id' => Auth::user('hotel_id')]);
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function getGroupesAndRolesUser($code): ?array
    {
        $data = [];
        try {
            $sql = "SELECT r.groupe,ur.role_id FROM roles r 
            JOIN user_roles ur ON r.code_role = ur.role_id
            JOIN users u ON u.code_user = ur.user_id
            WHERE u.hotel_id = :hotel_id AND ur.user_id = :user_id ORDER BY r.groupe";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                "hotel_id" => Auth::user("hotel_id"),
                "user_id" => $code
            ]);
            if ($stmt->rowCount() > 0)
                $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function groupes(): ?array
    {
        $data = [];
        try {
            $sql = "SELECT * FROM roles r WHERE r.etat_role = 1 GROUP BY r.groupe";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }
    public function createPermission(array $rolePermissions): ?String
    {

        $data = "";
        try {
            $sql = "INSERT INTO user_roles (user_id , role_id, create_permission, edit_permission, show_permission, delete_permission)
                    VALUES (:user_id, :role_id, :create_permission, :edit_permission, :show_permission, :delete_permission)
                    ON DUPLICATE KEY UPDATE 
                    create_permission = VALUES(create_permission), 
                    edit_permission = VALUES(edit_permission), 
                    show_permission = VALUES(show_permission), 
                    delete_permission = VALUES(delete_permission)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($rolePermissions);
            $data = $this->db->lastInsertId() ?: $stmt->rowCount();;
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }
    public function deletePermission(string $userId, string $roleId): ?bool
    {
        $data = false;
        try {
            $sql = "DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'user_id' => $userId,
                'role_id' => $roleId
            ]);
            $data = $stmt->rowCount() > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }
    public function getAllPermissionForUser(string $userId)
    {
        $data = [];
        $sql = "SELECT * FROM  user_roles ur WHERE ur.user_id =:user_id ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $data =  $stmt->fetchAll();
        return $data;
    }
}
