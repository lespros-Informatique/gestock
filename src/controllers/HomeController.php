<?php

namespace App\Controllers;

use App\Core\MainController;

class HomeController extends MainController
{

    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES RENDUS
     * SEXION POUR LES VUES 
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function acueil()
    {
        return $this->view('welcome', ['title' => "Tableau de bord"]);
    }

}