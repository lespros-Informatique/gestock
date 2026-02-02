<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Gqr;
use App\Core\MainController;
use App\Models\Factory;
use App\Services\Service;
use Roles;

class ClientControllerdd extends MainController
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
        $this->ajaxOnly();
        $data = [];
        try {
            $data['title'] = "Ajouter un client";
            $html = $this->view->getView('clients/modals/add_client', $data);
            $this->sendAjaxResponse(200, "Modal chargé avec succès", $html);
        } catch (\Exception $e) {
            $this->sendAjaxResponse(500, $e->getMessage());
        }
    }
}
