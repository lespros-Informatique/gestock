<?php

define('root', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
define('ASSETS', root . '/gestock/assets/');
define('LINK', root . '/gestock/');
define('HOME', root . '/gestock');
define('APP_NAME', 'G-STOCK');
define('TWO_PIP', '/../../');
define('THREE_PIP', '/../../');

// const etat and status
define('ETAT_INACTIF', "0");
define('ETAT_ACTIF', "1");
define('ETAT_ATTENTE', "2");
define('BOUTIQUE_CODE', "BTQ_001");
define('COMPTE_CODE', "CMP_001");


class TABLES
{
    // Comptes & abonnements
    public const COMPTES               = 'comptes';
    public const ABONNEMENTS           = 'abonnements';
    public const TYPE_ABONEMENTS       = 'type_abonements';
    public const AVANTAGES             = 'avantages';
    public const PAIEMENT_ABONNEMENTS  = 'paiement_abonnements';

    // Boutiques & organisation
    public const BOUTIQUES             = 'boutiques';
    public const CAISSES               = 'caisses';
    public const VERSEMENTS            = 'versement_ventes';

    // Utilisateurs & rôles
    public const USERS                 = 'users';
    public const ROLES                 = 'roles';
    public const USER_ROLES            = 'user_roles';
    public const FONCTIONS             = 'fonctions';

    // Produits & catalogues
    public const PRODUITS              = 'produits';
    public const CATEGORIES            = 'categories';
    public const MARKS                 = 'marks';
    public const UNITES                = 'unites';

    // Clients & fournisseurs
    public const CLIENTS               = 'clients';
    public const FOURNISSEURS           = 'fournisseurs';

    // Achats
    public const ACHATS                = 'achats';
    public const LIGNE_ACHATS           = 'ligne_achats';

    // Ventes
    public const VENTES                = 'ventes';
    public const LIGNE_VENTES           = 'ligne_ventes';
    public const VERSEMENTS_VENTES     = 'versements_ventes';

    // Dépenses
    public const DEPENSES              = 'depenses';
    public const TYPE_DEPENSES         = 'type_depenses';
}

class Permissionsss
{
    const CREATE = 'create_permission';
    const EDIT = 'edit_permission';
    const VIEW = 'show_permission';
    const DELETE = 'delete_permission';
}

class Rolesss
{
    const ADMIN = 'ga';
    const DIRECTEUR = 'g1ad1';
    const ENSEIGNANT = 'g2pe2';
    const ECONOME = 'g1ad2';
    const EDUCATEUR = 'g2pe1';
    const ASSITANT = 'g1ad3';
    const SUPERVISOR = 'supervisor';
    const BIBLIOTHECAIRE = 'librarian';
    const STUDENT = 'student';
    const SECRETARY = 'secretary';
    const PARENT = 'parent';
}

class Groupesss
{
    const SUPER = 'ga';
    const ADMIN = 'g1';
    const PEDAGOGIE = 'g2';
}


// $sideBarData = [
//                 'test' =>[]
//             ];

const STATUT_CHAMBRE = ['Libre', 'Occupee', 'En nettoyage', 'Maintenance'];
const STATUT_RESERVATION = ['En cour', 'Confirmee', 'Annulee', 'Checkout'];
const PAIEMENT = ['Especes', 'Carte', 'Mobile money'];
const SEXEP = ['Mr', 'Mlle', 'Mme'];
const PIECES_DATA = ["CNI" => "CNI", "PASSEPORT" => "PASSEPORT", "CMU" => "CMU", "PERMIS" => "PERMIS", "CARTE CONSLAIRE" => "CARTE CONSLAIRE", "AUTRES" => "AUTRES"];

const EXTENSION = ["jpg", "png", "jpeg", "jfif", "webp", "svg", "gif", "bmp", "ico", "heic", "heif"];
const PERIODE = "periode";
const RESERVATION = "reservation";
const OLD_URL = "old_url";
// CONST SEXE = ['G','F'];

const DAYS = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];


const MONTHS = [
    'Janvier',
    'Février',
    'Mars',
    'Avril',
    'Mai',
    'Juin',
    'Juillet',
    'Août',
    'Septembre',
    'Octobre',
    'Novembre',
    'Décembre'
];
