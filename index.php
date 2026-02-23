<?php
// if (session_status() === PHP_SESSION_NONE) {
session_name("APP1546443454655_SESSION");
session_start();
include __DIR__ . '/src/Core/security.php';

// }
// Charger le fichier de configuration une fois en ligne

// declare(strict_types=1);
// include 'config-production.php';
// include 'config-production-user.php';

// Activer le rapport d'erreurs (en développement uniquement)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\AbonnementController;
use App\Controllers\ApplicationController;
use App\Controllers\AvantageController;
use App\Controllers\CategorieController;
use App\Controllers\ClientController;
use App\Controllers\Controller;
use App\Controllers\ControllerException;
use App\Controllers\ControllerMailer;
use App\Controllers\FournisseurController;
use App\Controllers\UserController;
use App\Controllers\HomeController;
use App\Controllers\MarkController;
use App\Controllers\UniteController;
use App\Controllers\ProduitController;
use App\Controllers\PartnerController;
use App\Controllers\RoleController;
use App\Controllers\TypeAbonnementController;
use App\Core\Router;
use App\Middlewares\RouteMiddleWare;
use Phroute\Phroute\Dispatcher;

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$title = "";

$router = new Router();

/**
 * ************************************************
 * SEXION FILTER ROUTES 
 * ************************************************
 */

/* filter  for all routes*/
$router->filter('auth', [RouteMiddleWare::class, 'requireAuth']);

$router->filter('guest', [RouteMiddleWare::class, 'isLogged']);
// $router->filter('setting', [RouteMiddleWare::class, 'requireSetting']);
// $router->filter('gadmin-smartcode', [RouteMiddleWare::class, 'requireGesadmin-smartcode']);
// $router->filter('comptable', [RouteMiddleWare::class, 'requireComptable']);
// $router->filter('reception', [RouteMiddleWare::class, 'requireReception']);
// $router->filter('admin', [RouteMiddleWare::class, 'requireAdmin']);

/**
 * ************************************************
 * FIN SEXION FILTER ROUTES 
 * ************************************************
 */

$router->group(['before' => '', 'prefix' => 'admin-smartcode'], function ($router) {

    $router->get('/', [HomeController::class, 'acueil'],["before"=>"auth"]);
    // $router->get('admin-smartcode/', [UserController::class, 'acueil'], ['before' => 'auth'])->name('home');

    // Routes pour les utilisateurs
    $router->get('/user', [UserController::class, 'user']);
    $router->get('/user/profile/{code}', [UserController::class, 'profileUser']);
    
    // Routes pour les roles
    $router->get('/role', [Controller::class, 'role']);
    
    // Routes pour les partenaires
    $router->get('/partner', [PartnerController::class, 'partner']);
    $router->get('/compte-partner', [PartnerController::class, 'comptePartner']);
    $router->get('/paiement-partner', [PartnerController::class, 'paiementAbonnement']);
    
    // Routes pour les applications
    $router->get('/application', [ApplicationController::class, 'application']);
    $router->get('/application/detail/{code}', [ApplicationController::class, 'detail']);
    $router->get('/type-abonnement', [TypeAbonnementController::class, 'typeAbonnement']);
    $router->get('/type_abonnement/detail/{code}', [TypeAbonnementController::class, 'detail']);
    $router->get('/avantage', [AvantageController::class, 'avantage']);
    $router->get('/avantage/detail/{code}', [AvantageController::class, 'detail']);
    
    // Routes pour les abonnements
    // $router->get('/abonnement', [PartnerController::class, 'abonnement']);
    $router->get('/paiement-abonnement', [AbonnementController::class, 'paiementAbonnement']);
    
    // Routes pour les permissions
    $router->get('/client', [ClientController::class, 'client']);
    $router->get('/client/detail/{code}', [ClientController::class, 'detail']);
    $router->get('/abonnement', [AbonnementController::class, 'abonnement']);
    $router->get('/abonnement/detail/{code}', [AbonnementController::class, 'detail']);
    $router->get('/permission', [RoleController::class, 'liste']);
    
    // Routes pour les paramètres
    $router->get('/setting', [UserController::class, 'setting']);
//     get('client/:code', [controlleur, method])
// Url('client', ['code' => $code_client]) ...> voir</a>
// Public function voirClient(code){...}
    // Anciennes routes
    $router->get('/login',[UserController::class, 'login'],['before'=>"guest"]);
  
      $router->get('activation/{token}',[UserController::class, 'activationAccount'],['before' => 'guest'])->name('activation');
});

/**
 * ************************************************
 * SEXION ROUTE MAIL 
 * ************************************************
 */


$router->group(['before' => '', 'prefix' => 'admin-smartcode/email'], function ($router) {

    // $router->get('/',[ControllerMailer::class, 'acueil'],['before' => 'auth']);
});

/**
 * ************************************************
 * FIN SEXION ROUTE MAIL 
 * ************************************************
 */



/**
 * ************************************************
 * SEXION ROUTE PRINTER 
 * ************************************************
 */

$router->group(['before' => '', 'prefix' => 'admin-smartcode/print'], function ($router) {});



/**
 * ************************************************
 *  Routes SEXION admin-smartcode LISTE RECAP
 * ************************************************
 */

/**
 * ************************************************
 *  Routes SEXION admin-smartcode AUTRES
 * ************************************************
 */


// Route pour les utilisateurs connectés


// $router->get('admin-smartcode/', [UserController::class, 'acueil'], ['before' => 'auth'])->name('home');

// Route pour sexion admin



// Route pour les visiteurs
$router->group(["prefix" => 'admin-smartcode/welcome'], function ($router) {
    $router->get('/', [UserController::class, 'home']);
});

/*
je
*/
/**
 * Page for test
 */
$router->get('admin-smartcode/test', [Controller::class, 'testing']);


/*
je
*/
/**
 * Page not found
 */
$router->get('admin-smartcode/page-not-found', [ControllerException::class, 'notFound'])->name('page.notfound');

/**
 * ************************************************
 *  FIN Routes SEXION admin-smartcode AUTRES
 * ************************************************
 */


$dispatcher = new Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $path);

echo $response;

// var_dump($_SESSION);