
<?php
session_name("APP1546443454655_SESSION");


session_start();
include __DIR__ . '/../../src/Core/security.php';

use App\Controllers\ApplicationController;
use App\Controllers\AvantageController;
use App\Controllers\ClientController;
use App\Controllers\PartnerController;
use App\Controllers\TypeAbonnementController;
use App\Controllers\AbonnementController;
use App\Controllers\Controller;
use App\Controllers\UserController;
use App\Controllers\DashboardController;

require __DIR__ . '/../../vendor/autoload.php';



if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
    exit;
}
// var_dump($_POST);

$controller = $_POST['controller'] ?? null;
$action = $_POST['action'] ?? null;

// Si un controller est spécifié, l'utiliser
if ($controller) {
    switch ($controller) {
        case 'Dashboard':
            $ajx = new DashboardController();
            switch ($action) {
                case 'getStatistiques':
                    $ajx->getStatistiques();
                    break;
                case 'getAbonnementsChart':
                    $ajx->getAbonnementsChart();
                    break;
                case 'getRevenusChart':
                    $ajx->getRevenusChart();
                    break;
                case 'getTypesPopulaires':
                    $ajx->getTypesPopulaires();
                    break;
                case 'getDerniersAbonnements':
                    $ajx->getDerniersAbonnements();
                    break;
                case 'getPartenairesRecents':
                    $ajx->getPartenairesRecents();
                    break;
                default:
                    echo json_encode(['status' => 'error', 'message' => 'Action inconnue']);
            }
            exit;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Controller inconnu']);
            exit;
    }
}

// Ancien système d'actions directes
$action = $_POST['action'] ?? null;
// var_dump($_POST);
// return;

switch ($action) {


    // Debut Actions pour les roles & permissions
    case 'btn_load_data_role':
        $ajx = new Controller();
        $ajx->loadDataRole();
        break;
    case 'btn_add_permission':
        $ajx = new Controller();
        $ajx->ajouterPermissionRole();
        break;
    case 'frm_modal_add_permission':
        $ajx = new Controller();
        $ajx->modalAddPermission();
        break;
    // ajouter utlisateur
    case 'frm_modal_user':
        $ajx = new UserController();
        $ajx->modalAddUser();
        break;
    case 'btn_add_user':
        $ajx = new UserController();
        $ajx->addUser();
        break;
    case 'charger_data_user':
        $ajx = new UserController();
        $ajx->getListeUser();
        break;

    case 'btn_disable_user':
        $ajx = new UserController();
        $ajx->disableUser();
        break;

    case 'btn_enable_user':
        $ajx = new UserController();
        $ajx->enableUser();
        break;
    case 'btn_send_mail_activation':
        $ajx = new UserController();
        $ajx->sendMailActivation();
        break;

    case 'btnLogin':
        $ajx = new UserController();
        $ajx->loginUser();
        break;
    case 'btnRegister':
        $ajx = new UserController();
        $ajx->registerUser();
        break;
    case 'btn_update_user':
        $ajx = new UserController();
        $ajx->updateUser();
        break;
    case 'btn_reset_password':
        $ajx = new UserController();
        $ajx->resetPasswordUser();
        break;
    case 'btn_user_Deconnect':
        $ajx = new UserController();
        $ajx->deconnexion();
        break;

    case 'changer_password':
        $ajx = new UserController();
        $ajx->changePasswordUser();
        break;


case 'charger_data_applications':
        $ajx = new ApplicationController();
        $ajx->getListeApplication();
    break;

    case 'btn_showmodal_application':
        $ajx = new ApplicationController();
        $ajx->modalAddApplication();
    break;

    case 'btn_ajouter_application':
        $ajx = new ApplicationController();
        $ajx->ajouterApplication();
    break;

    case 'modal_modifier_application':
        $ajx = new ApplicationController();
        $ajx->modalUpdateApplication();
    break;

    case 'btn_modifier_application':
        $ajx = new ApplicationController();
        $ajx->updateApplication();
    break;

    case 'btn_delete_application':
        $ajx = new ApplicationController();
        $ajx->deleteApplication();
    break;
    // section image
    case 'upload_image_application':
        $ajx = new ApplicationController();
        $ajx->uploadImageApplication();
    break;

    case 'btn_ajouter_image_application':
        $ajx = new ApplicationController();
        $ajx->ajouterImageApplication();
    break;

    case 'supprimer_image_application':
        $ajx = new ApplicationController();
        $ajx->supprimerImageApplication();
    break;

    case 'charger_data_image_application':
        $ajx = new ApplicationController();
        $ajx->getListeImagesApplication();
    break;

    case 'btn_showmodal_image_application':
        $ajx = new ApplicationController();
        $ajx->modalAddImageApplication();
    break;

    case 'modal_modifier_image_application':
        $ajx = new ApplicationController();
        $ajx->modalUpdateImageApplication();
    break;

    // Type Abonnement
    case 'charger_data_type_abonnements':
        $ajx = new TypeAbonnementController();
        $ajx->getListeTypeAbonnement();
    break;

    case 'btn_showmodal_type_abonnement':
        $ajx = new TypeAbonnementController();
        $ajx->modalAddTypeAbonnement();
    break;

    case 'btn_ajouter_type_abonnement':
        $ajx = new TypeAbonnementController();
        $ajx->ajouterTypeAbonnement();
    break;

    case 'modal_modifier_type_abonnement':
        $ajx = new TypeAbonnementController();
        $ajx->aModalUpdateTypeAbonnement();
    break;

    case 'btn_modifier_type_abonnement':
        $ajx = new TypeAbonnementController();
        $ajx->updateTypeAbonnement();
    break;

    case 'btn_delete_type_abonnement':
        $ajx = new TypeAbonnementController();
        $ajx->aDeleteTypeAbonnement();
    break;

    // Avantages
    case 'charger_data_avantage':
        $ajx = new AvantageController();
        $ajx->getListeAvantage();
    break;

    case 'btn_showmodal_avantage':
        $ajx = new AvantageController();
        $ajx->modalAddAvantage();
    break;

    case 'btn_ajouter_avantage':
        $ajx = new AvantageController();
        $ajx->ajouterAvantage();
    break;

    case 'modal_modifier_avantage':
        $ajx = new AvantageController();
        $ajx->modalUpdateAvantage();
    break;

    case 'btn_modifier_avantage':
        $ajx = new AvantageController();
        $ajx->updateAvantage();
    break;

    case 'btn_delete_avantage':
        $ajx = new AvantageController();
        $ajx->aDeleteAvantage();
    break;

    // Fin Avantages

    // Partners
    case 'charger_data_partner':
        $ajx = new PartnerController();
        $ajx->aGetListePartner();
    break;

    case 'btn_showmodal_partner':
        $ajx = new PartnerController();
        $ajx->amodalAddPartner();
    break;

    case 'btn_ajouter_partner':
        $ajx = new PartnerController();
        $ajx->aAjouterPartner();
    break;

    case 'modal_modifier_partner':
        $ajx = new PartnerController();
        $ajx->aModalUpdatePartner();
    break;

    case 'btn_modifier_partner':
        $ajx = new PartnerController();
        $ajx->aUpdatePartner();
    break;

    case 'btn_delete_partner':
        $ajx = new PartnerController();
        $ajx->aDeletePartner();
    break;
    // Fin Partners

    // Clients
    case 'charger_data_client':
        $ajx = new ClientController();
        $ajx->aGetListeClient();
    break;
    // Fin Clients

    // Abonnements
    case 'charger_data_abonnement':
        $ajx = new AbonnementController();
        $ajx->aGetListeAbonnement();
    break;

    case 'charger_data_paiement_abonnement':
        $ajx = new AbonnementController();
        $ajx->aGetListePaiementAbonnement();
    break;
    // Fin Abonnements

    // Compte Partner
    case 'charger_data_compte_partner':
        $ajx = new PartnerController();
        $ajx->aGetListeComptePartner();
    break;

    case 'charger_data_paiement_partner':
        $ajx = new PartnerController();
        $ajx->aGetListePaiementPartner();
    break;
    // Fin Compte Partner
    
    /**
     * SEXION data configuration
     */
    // Autres cas...
    default:
        echo json_encode(['status' => 'error', 'message' => 'Action inconnue']);
        break;
}
