<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Gqr;
use App\Core\MainController;
use App\Models\Factory;
use App\Services\PersonneService;
use App\Services\Service;
use Roles;

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

        if (Auth::user('caisse') != null) {

            if (!empty($_POST['nom_client']) && !empty($_POST['telephone_client']) && !empty($_POST['genre_client'])) {
                extract($_POST);
                $telephone = removeSpace($telephone_client);
                $telephone = str_replace('(+225)', '', $telephone);

                if (ctype_digit($telephone) && mb_strlen($telephone) == 10) {

                    $fc = new Factory();

                    $client = $fc->verifyParam('clients', 'telephone_client', $telephone);

                    if ($client) {
                        $output = Service::lookForClientExist($client);
                        $msg['code'] = 200;
                        $msg['type'] = "success";
                        $msg['data'] = $output;
                        $msg['message'] = "Ce client existe déjà ";
                    } else {


                        if (!empty($type_piece) && empty($piece_client)) {
                            $msg['message'] = "Veuillez renseiller la piece. ";
                        } else {

                            $date = date("Y-m-d H:i:s");
                            $codeCient = $fc->generatorCode("clients", "code_client");

                            $data_client = [
                                'nom_client' => strtoupper($nom_client),
                                'telephone_client' => $telephone,
                                'code_client' => $codeCient,
                                'hotel_id' => Auth::user("hotel_id"),
                                'genre_client' => $genre_client,
                                'type_piece' => $type_piece ?? null,
                                'piece_client' => $piece_client ?? null,
                                'created_client' => $date
                            ];

                            if ($fc->create('clients', $data_client)) {

                                $output = Service::lookForClientExist($data_client);


                                // $chambre = Auth::getData(RESERVATION, 'chambre');
                                // $montant = Auth::getData(RESERVATION, 'montant');
                                // $debut = Auth::getData(PERIODE, 'date_debut');
                                // $fin = Auth::getData(PERIODE, 'date_fin');
                                // $days = daysBetweenDates($debut, $fin);
                                // $totalMontant = $montant * $days;


                                // Auth::clean(RESERVATION);
                                // Auth::clean(PERIODE);

                                // $output = Service::chargerFactureForReservation($codeResevation, $totalMontant);


                                $msg['code'] = 200;
                                $msg['type'] = "success";
                                $msg['data'] = $output;
                                $msg['message'] = "Client enregistré avec succès";
                            } else {
                                $msg['message'] = "Désolé, erreur d'enregistrement du client";
                            }
                        }
                    }
                } else {
                    $msg['message'] = "Numero de telephone invalide.";
                }
            } else {
                $msg['message'] = "Veuillez remplire tous les champs.";
            }
        } else {
            $msg['message'] = "Veuillez D'abord ouvrir votre caisse!";
        }
        echo json_encode($msg);
    }
}
