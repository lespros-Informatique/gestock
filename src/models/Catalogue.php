<?php

namespace App\Models;

use App\Core\Auth;
use App\Core\Model;
use Exception;
use Roles;
use TABLES;

class Catalogue extends Model
{
    protected string $table = "hotels";
    public string $id = 'code_hotel';


public function getAllCategorieByCompteBoutique($compte, $boutique,$etat_actif): ?array
{
    $data = [];

    try {
        $sql = "
            SELECT *
            FROM " . TABLES::CATEGORIES . "
            WHERE compte_code = :compte_code
              AND boutique_code = :boutique_code
              AND etat_categorie = :etat_actif
            ORDER BY libelle_categorie ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'compte_code'   => $compte,
            'boutique_code' => $boutique,
            'etat_actif'    => $etat_actif
        ]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll();
        }

    } catch (Exception $e) {
        die($e->getMessage());
    }

    return $data;
}

public function aGetCategorieByField($field, $valeur)
{
    $allowedFields = ['code_categorie','libelle_categorie', 'id_categorie'];

    if (!in_array($field, $allowedFields)) {
        return false;
    }

    try {
        $sql = "SELECT * FROM categories WHERE {$field} = :valeur LIMIT 1";
        $stm = $this->db->prepare($sql);
        $stm->execute([
            ':valeur' => $valeur
        ]);
        return $stm->fetch();
    } catch (Exception $e) {
        return false;
    }
}
public function getAllmarkByCompteBoutique($compte, $boutique,$etat_actif): ?array
{
    $data = [];

    try {
        $sql = "
            SELECT *
            FROM " . TABLES::MARKS . "
            WHERE compte_code = :compte_code
              AND boutique_code = :boutique_code
              AND etat_mark = :etat_actif
            ORDER BY libelle_mark ASC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'compte_code'   => $compte,
            'boutique_code' => $boutique,
            'etat_actif'    => $etat_actif
        ]);

        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetchAll();
        }

    } catch (Exception $e) {
        die($e->getMessage());
    }

    return $data;
}

public function aGetMarkByField($field, $valeur)
{
    $allowedFields = ['code_mark','libelle_mark', 'id_mark'];

    if (!in_array($field, $allowedFields)) {
        return false;
    }

    try {
        $sql = "SELECT * FROM marks WHERE {$field} = :valeur LIMIT 1";
        $stm = $this->db->prepare($sql);
        $stm->execute([
            ':valeur' => $valeur
        ]);
        return $stm->fetch();
    } catch (Exception $e) {
        return false;
    }
}



}