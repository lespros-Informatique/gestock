<?php

namespace App\Models;

use PDO;
use TABLES;
use Exception;
use App\Core\Model;

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

    function buildWhereClause(string $search = ''): array
    {
        $where  = 'WHERE etat_client = 1';
        $params = [];

        if (!empty($search)) {
            $where .= ' AND (nom LIKE :search OR email LIKE :search)';
            $params['search'] = "%$search%";
        }

        return [$where, $params];
    }

    function dataTbleCountTotalRow($table, array $whereParams, $likeParams = [])
    {

        $where = '';
        if (!empty($whereParams)) {
            $where = 'WHERE ';
            $where .=  implode(
                ' AND ',
                array_map(fn($f) => "$f = :$f ", array_keys($whereParams))
            );
        }

        if (!empty($likeParams)) {
            $where .= empty($where) ? ' WHERE ' : ' AND ';
            $likes = [];
            foreach ($likeParams as $field => $search) {
                // $key = "$field";
                $likes[] = "$field LIKE :$field";
                $likeParams[$field] = "%$search%";
            }
            // return $likeParams;
            $where .= '(' . implode(' OR ', $likes) . ')';
        }

        $sql = "SELECT COUNT(*) FROM $table $where";
        $stmt = $this->db->prepare($sql);
        // return $sql;
        $stmt->execute(array_merge($whereParams, $likeParams));
        return (int) $stmt->fetchColumn();
    }

    function countFilteredClients(string $where, array $params): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM " . TABLES::CLIENTS . " $where");
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }


    function DataTableFetchAllListe(string $table, array $whereParams,  array $likeParams, array $orderBy = [], int $start = 0, int $limit = 10)
    {

        $where = '';
        if (!empty($whereParams)) {
            $where = 'WHERE ';
            $where .=  implode(
                ' AND ',
                array_map(fn($f) => "$f = :$f ", array_keys($whereParams))
            );
        }

        if (!empty($likeParams)) {
            $where .= empty($where) ? ' WHERE ' : ' AND ';
            $likes = [];
            foreach ($likeParams as $field => $search) {
                $likes[] = "$field LIKE :$field";
                $likeParams[$field] = "%$search%";
            }
            $where .= '(' . implode(' OR ', $likes) . ')';
        }

        $orders = '';

        if (!empty($orderBy)) {
            $orders = 'ORDER BY ' . implode(', ', array_map(fn($f) => "$f " . $orderBy[$f], array_keys($orderBy)));
        }

        $sql = "SELECT * FROM $table $where $orders LIMIT :start, :limit";

        $stmt = $this->db->prepare($sql);

        // Bind WHERE params
        if (!empty($whereParams)) {
            foreach ($whereParams as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        if (!empty($likeParams)) {
            foreach ($likeParams as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
        }

        // ✅ Bind LIMIT params correctement
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);


        // return $sql;

        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getDataTableResponse(string $table, array $searchableFields, ?string $statusField, array $request)
    {

        // 1️⃣ Paramètres DataTables
        $limit  = (int) ($request['length'] ?? 10);
        $start  = (int) ($request['start'] ?? 0);
        $draw   = (int) ($request['draw'] ?? 1);
        $search = $request['search']['value'] ?? '';

        // 2️⃣ WHERE + PARAMS
        $where  = [];
        $params = [];

        // Soft delete
        if ($statusField !== null) {
            $where[] = "$statusField = 1";
        }

        // Recherche
        if (!empty($search)) {
            $likes = [];
            foreach ($searchableFields as $i => $field) {
                $key = "search_$i";
                $likes[] = "$field LIKE :$key";
                $params[$key] = "%$search%";
            }
            $where[] = '(' . implode(' OR ', $likes) . ')';
        }

        $whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        // 3️⃣ TOTAL (sans recherche)
        $sqlTotal = "SELECT COUNT(*) FROM $table";
        if ($statusField !== null) {
            $sqlTotal .= " WHERE $statusField = 1";
        }
        $total = (int) $this->db->query($sqlTotal)->fetchColumn();

        // 4️⃣ TOTAL FILTRÉ
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM $table $whereSql");
        $stmt->execute($params);
        $totalFiltered = (int) $stmt->fetchColumn();

        // 5️⃣ DONNÉES
        $sqlData = " SELECT * FROM $table $whereSql  LIMIT :start, :limit ";

        $stmt = $this->db->prepare($sqlData);

        foreach ($params as $key => $value) {
            $stmt->bindValue(":$key", $value, PDO::PARAM_STR);
        }

        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 6️⃣ Réponse DataTables
        return [
            'draw'            => $draw,
            'recordsTotal'    => $total,
            'recordsFiltered' => $totalFiltered,
            'data'            => $data
        ];
    }
}
