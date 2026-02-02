<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Gqr;
use App\Core\MainController;
use App\Models\Factory;
use App\Models\Personne;
use App\Services\PersonneService;
use App\Services\Service;
use Roles;
use TABLES;

class ClientController extends MainController
{
    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES RENDUS
     * SEXION POUR LES VUES 
     * **********************************************************************
     * --------------------------------------------------------------------------
     */


    public  function client()
    {
        return $this->view('clients/liste', ['title' => "Clients"]);
    }



    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function modalAddClient()
    {

        extract($_POST);


        $output = PersonneService::bClientddModalService();

        // $output = Service::frmUpdateReservation($code_reservation);
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }

    public function addNewClient()
    {
        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        if (!empty($_POST['nom_client']) && !empty($_POST['telephone_client']) && !empty($_POST['sexe'])) {
            extract($_POST);
            $telephone = removeSpace($telephone_client);
            $telephone = str_replace('(+225)', '', $telephone);

            if (ctype_digit($telephone) && mb_strlen($telephone) == 10) {

                $personne = new Personne();

                $client = $personne->getFieldsForParams(TABLES::CLIENTS, ['boutique_code' => BOUTIQUE_CODE, 'telephone_client' => $telephone]);

                if (empty($client)) {
                    $date = date("Y-m-d H:i:s");
                    $codeCient = $personne->generatorCode(TABLES::CLIENTS, "code_client");

                    $data_client = [
                        'nom_client' => strtoupper($nom_client),
                        'telephone_client' => $telephone,
                        'code_client' => $codeCient,
                        'boutique_code' => BOUTIQUE_CODE,
                        'compte_code' => COMPTE_CODE,
                        'sexe_client' => $sexe,
                        'client_created_at' => $date
                    ];

                    if ($personne->create(TABLES::CLIENTS, $data_client)) {
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['message'] = "Client enregistré avec succès";
                    } else {
                        $msg['message'] = "Désolé, erreur d'enregistrement du client";
                    }
                } else {
                    $msg['message'] = "Desolé, ce numéro de telephone existe déjà.";
                }
            } else {
                $msg['message'] = "Numero de telephone invalide.";
            }
        } else {
            $msg['message'] = "Veuillez remplire tous les champs.";
        }

        echo json_encode($msg);
        return;
    }
}
