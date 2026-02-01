<?php

namespace App\Models;

use App\Core\Auth;
use App\Core\Model;
use Exception;
use Roles;
use TABLES;

class Personne extends Model
{
    protected string $table = "users";
    public string $id = 'code_user';


    public function bGetAllClients($codeBoutique)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM " . TABLES::CLIENTS . " c WHERE c.boutique_code = :boutique ORDER BY c.nom_client ASC";


            $stmt = $this->db->prepare($sql);

            $stmt->execute(['boutique' => $codeBoutique]);

            if ($stmt->rowCount() > 0)
                $result = $stmt->fetchAll();
            $data = $result ?? [];
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function bGetClient($idclient, $codeBoutique)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM " . TABLES::CLIENTS . " c WHERE c.code_client = :client AND c.boutique_code = :boutique LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['client' => $idclient, 'boutique' => $codeBoutique]);
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }
    public function bGetAllFournisseurs($codeBoutique)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM " . TABLES::FOURNISSEURS . " f WHERE f.boutique_code = :boutique ORDER BY f.nom_fournisseur ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['boutique' => $codeBoutique]);
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }

    public function bGetFournisseur($idFournisseur, $codeBoutique)
    {
        $data = [];
        try {
            $sql = "SELECT * FROM " . TABLES::FOURNISSEURS . " f WHERE f.code_fournisseur = :fournisseur AND f.boutique_code = :boutique LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(['fournisseur' => $idFournisseur, 'boutique' => $codeBoutique]);
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $data;
    }
}
