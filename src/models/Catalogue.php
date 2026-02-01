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

public function averifTypechambreLibelle($libelle, $etat = ETAT_ACTIF)
    {
        $result = [];
        try {
            $sql = "SELECT * FROM categories  WHERE boutique_code = :boutique AND description_categorie = :libelle AND etat_categorie = :etat LIMIT 1";
            $stm = $this->db->prepare($sql);
            $stm->execute([
                'hotel_id' => Auth::user('hotel_id'),
                'libelle' => $libelle,
                'etat' => $etat
            ]);
            $result = $stm->fetch();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $result;
    }


}