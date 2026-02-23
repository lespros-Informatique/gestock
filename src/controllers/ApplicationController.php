<?php

namespace App\Controllers;

use App\Core\MainController;
use App\Models\Factory;
use App\Services\ApplicationService;
use App\Services\ImageApplicationService;
use TABLES;

class ApplicationController extends MainController
{

    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES VUES
     * SEXION POUR LES VUES
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    private $model;
    public function __construct()
    {
        $this->model = new Factory();
    }

    public function application()
    {
        return $this->view('applications/liste', ['title' => 'Applications']);
    }

    public function detail($code)
    {
        $application = (new Factory())->find(TABLES::APPLICATIONS, 'code_application', $code);
        
        // Récupérer les images de l'application
        $fc = new Factory();
        $images = $fc->raw(
            "SELECT * FROM " . TABLES::IMAGES_APPLICATIONS . " WHERE application_code = ? AND etat_image = 1",
            [$code],
            'fetchAll'
        );
        
        return $this->view('applications/detail', [
            'title' => 'Détails Application', 
            'application' => $application,
            'images' => $images
        ]);
    }


    /**
     * ------------------------------------------------------------------------
     * **********************************************************************
     * * SEXION POUR LES REQUESTS AJAX
     * SEXION POUR LES AJAX REQUESTS
     * **********************************************************************
     * --------------------------------------------------------------------------
     */

    public function getListeApplication()
    {
        extract($_POST);
        $output = "";
        $application = new Factory();

        $likeParams = [];
        $whereParams = ['etat_application' => ETAT_ACTIF];
        $orderBy = ["libelle_application" => "ASC"];
        $limit  = $_POST['length'];
        $start  = $_POST['start'];
        $search = $_POST['search']['value'] ?? '';


        // 🔎 Recherche
        if (!empty($search)) {
            $likeParams = ['libelle_application' => $search, 'slug_application' => $search];
        }

        // 🔢 Total
        $total = $application->dataTbleCountTotalRow(TABLES::APPLICATIONS, $whereParams);
        // 🔢 Total filtré

        $totalFiltered = $application->dataTbleCountTotalRow(TABLES::APPLICATIONS, $whereParams, $likeParams);
        // 📄 Données

        $applicationList = $application->DataTableFetchAllListe(TABLES::APPLICATIONS, $whereParams, $likeParams, $orderBy, $start, $limit);

        $data = [];

        $data = ApplicationService::applicationDataService($applicationList);

        echo json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $total,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        ]);
        return;
    }


    public function deleteApplication()
    {

        $_POST = sanitizePostData($_POST);
        $code_application = $_POST['code_application'] ?? null;
        $msg['code'] = 400;
        $msg['type'] = "warning";
        if ($code_application != null) {

            $data_application = [
                'etat_application' => ETAT_INACTIF
            ];
            $rest = (new Factory())->update(TABLES::APPLICATIONS, 'code_application', $code_application, $data_application);
            if ($rest) {
                $msg['code'] = 200;
                $msg['type'] = "success";
                $msg['message'] = "Application supprimée avec succes";
            } else {
                $msg['message'] = "Echec d'enregistrement!";
            }
        } else {
            $msg['message'] = "Impossible d'effectuer cette operation!";
        }
        echo json_encode($msg);
        return;
    }

    public function modalUpdateApplication()
    {

        $_POST = sanitizePostData($_POST);

        $code = ($_POST['code']);
        $result['code'] = 400;
        $output = "";
        if ($code) {
            $fc = new Factory();
            $application = $fc->find(TABLES::APPLICATIONS, 'code_application', $code);
            if (!empty($application)) {
                $output = ApplicationService::modalUpdateApplication($application);
                $result['data'] = $output;
                $result['code'] = 200;
            } else {
                $result['data'] = "Erreur lors de la recuperation!";
                $result['code'] = 400;
            }
        } else {
            $result['data'] = "Application introuvable!";
            $result['code'] = 400;
        }
        echo json_encode($result);
        return;
    }

    public function updateApplication()
    {

        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $code = ($_POST['code_application']);

        if (!empty($code)) {

            if (!empty($_POST['libelle_application'])) {
                extract($_POST);
                $fc = new Factory();

                // Gestion de l'upload d'image
                $image_application = null;
                if (isset($_FILES['image_application']) && $_FILES['image_application']['error'] === 0) {
                    $image_application = self::handleImageUpload($_FILES['image_application']);
                }

                $data_application = [
                    'libelle_application' => $libelle_application,
                    'slug_application' => $slug_application,
                    'icon_application' => $icon_application ?? null,
                    'link_application' => $link_application ?? null,
                    'link_video_application' => $link_video_application ?? null,
                    'description_application' => $description_application ?? null,
                ];

                // Si une nouvelle image est uploadée, on met à jour
                if ($image_application) {
                    $data_application['image_application'] = $image_application;
                }

                $rest = $fc->update(TABLES::APPLICATIONS, 'code_application', $code, $data_application);

                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Application modifiée avec succes";
                } else {
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {
                $msg['message'] = "Veuillez remplire tous les champs. ";
            }
        } else {
            $msg['message'] = "Erreur de donnée, vueillez ressayer plus tard. ";
        }

        echo json_encode($msg);
        return;
    }

    public function modalAddApplication()
    {
        $output = ApplicationService::modalAddApplication();
        echo json_encode(['data' => $output, 'code' => 200]);
        return;
    }


    public function ajouterApplication()
    {
        $msg['code'] = 400;
        $_POST = sanitizePostData($_POST);

        if (!empty($_POST['libelle_application']) && !empty($_POST['slug_application'])) {
            extract($_POST);

            $fc = new Factory();

            if (!$fc->verif(TABLES::APPLICATIONS, "libelle_application", $libelle_application)) {
                $code = $fc->generateCode(TABLES::APPLICATIONS, "code_application", "APP-", 8);

                // Gestion de l'upload d'image
                $image_application = null;
                if (isset($_FILES['image_application']) && $_FILES['image_application']['error'] === 0) {
                    $image_application = self::handleImageUpload($_FILES['image_application']);
                }
                // echo json_encode(["image_uploaded"=>$_FILES,"image_application"=>$image_application]);return;
                $data_application = [
                    'libelle_application' => $libelle_application,
                    'slug_application' => $slug_application,
                    'code_application' => $code,
                    'icon_application' => $icon_application ?? null,
                    'image_application' => $image_application,
                    'link_application' => $link_application ?? null,
                    'link_video_application' => $link_video_application ?? null,
                    'description_application' => $description_application ?? null,
                    'etat_application' => 1
                ];

                if ($fc->create(TABLES::APPLICATIONS, $data_application)) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Application enregistrée avec succès";
                } else {
                    $msg['type'] = "warning";
                    $msg['message'] = "Echec d'enregistrement!";
                }
            } else {

                $msg['type'] = "warning";
                $msg['message'] = "Desolé! Cette application existe déjà. ";
            }
        } else {
            $msg['type'] = "warning";
            $msg['message'] = "Veuillez remplire tous les champs. ";
        }
        echo json_encode($msg);
    }

    private static function handleImageUpload($file)
    {
        if ($file && $file['error'] === 0 && $file['size'] > 0) {
            if (verifyExt($file['name'])) {
                if ($file['size'] <= 2000000) {
                    $cheminDossier = __DIR__ . '/../../public/uploads/applications/';

                    if (creerDossierSiNonExistant($cheminDossier)) {
                        $extension = getExt($file['name']);
                        $nomFichier = uniqid('app_') . '.' . $extension;
                        $filePath = $cheminDossier . $nomFichier;

                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            return 'uploads/applications/' . $nomFichier;
                        }
                    }
                }
            }
        }
        return null;
    }

    public function uploadImageApplication()
    {
        header('Content-Type: application/json');
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $file = $_FILES['image_application'] ?? null;

        if ($file && $file['error'] === 0 && $file['size'] > 0) {
            if (verifyExt($file['name'])) {
                if ($file['size'] <= 2000000) {
                    $cheminDossier = __DIR__ . '/../../public/uploads/applications/';

                    if (creerDossierSiNonExistant($cheminDossier)) {
                        $extension = getExt($file['name']);
                        $nomFichier = uniqid('app_') . '.' . $extension;
                        $filePath = $cheminDossier . $nomFichier;

                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            $msg['code'] = 200;
                            $msg['type'] = "success";
                            $msg['message'] = "Image enregistrée avec succès";
                            $msg['file'] = 'uploads/applications/' . $nomFichier;
                        } else {
                            $msg['message'] = "Erreur lors du téléchargement du fichier";
                        }
                    } else {
                        $msg['message'] = "Impossible de créer le dossier de destination";
                    }
                } else {
                    $msg['message'] = "La taille maximum du fichier est de 2Mo";
                }
            } else {
                $msg['message'] = "Le fichier n'est pas une image valide (jpg, png, gif)";
            }
        } else {
            $msg['message'] = "Aucune image sélectionnée ou erreur lors de l'envoi";
        }

        echo json_encode($msg);
        return;
    }

    /**
     * ---------------------------------------------------
     * GESTION DES IMAGES DE L'APPLICATION
     * ---------------------------------------------------
     */

    /**
     * Ajouter une image à une application
     */
    public function ajouterImageApplication()
    {
        header('Content-Type: application/json');
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $application_code = $_POST['application_code'] ?? null;
        $file = $_FILES['image_file'] ?? null;

        if (!$application_code) {
            $msg['message'] = "Code application manquant";
            echo json_encode($msg);
            return;
        }

        if ($file && $file['error'] === 0 && $file['size'] > 0) {
            if (verifyExt($file['name'])) {
                if ($file['size'] <= 2000000) {
                    $cheminDossier = __DIR__ . '/../../public/uploads/applications/';

                    if (creerDossierSiNonExistant($cheminDossier)) {
                        $extension = getExt($file['name']);
                        $nomFichier = uniqid('app_img_') . '.' . $extension;
                        $filePath = $cheminDossier . $nomFichier;

                        if (move_uploaded_file($file['tmp_name'], $filePath)) {
                            $imagePath = 'uploads/applications/' . $nomFichier;
                            
                            // Enregistrer dans la base de données
                            $fc = new Factory();
                            $data_image = [
                                'link_image' => $imagePath,
                                'application_code' => $application_code,
                                'etat_image' => 1
                            ];
                            
                            if ($fc->create(TABLES::IMAGES_APPLICATIONS, $data_image)) {
                                $msg['code'] = 200;
                                $msg['type'] = "success";
                                $msg['message'] = "Image ajoutée avec succès";
                            } else {
                                $msg['message'] = "Erreur lors de l'enregistrement dans la base de données";
                            }
                        } else {
                            $msg['message'] = "Erreur lors du téléchargement du fichier";
                        }
                    } else {
                        $msg['message'] = "Impossible de créer le dossier de destination";
                    }
                } else {
                    $msg['message'] = "La taille maximum du fichier est de 2Mo";
                }
            } else {
                $msg['message'] = "Le fichier n'est pas une image valide (jpg, png, gif)";
            }
        } else {
            $msg['message'] = "Aucune image sélectionnée ou erreur lors de l'envoi";
        }

        echo json_encode($msg);
        return;
    }

    /**
     * Supprimer une image d'une application
     */
    public function supprimerImageApplication()
    {
        $_POST = sanitizePostData($_POST);
        $msg['code'] = 400;
        $msg['type'] = "warning";

        $id_image = $_POST['id_image'] ?? null;

        if ($id_image) {
            $fc = new Factory();
            
            // Récupérer l'image pour supprimer le fichier
            $image = $fc->find(TABLES::IMAGES_APPLICATIONS, 'id_image', $id_image);
            
            if ($image) {
                // Supprimer le fichier physique
                $filePath = __DIR__ . '/../../public/' . $image['link_image'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                
                // Supprimer de la base de données
                $data_image = ['etat_image' => 0];
                $rest = $fc->update(TABLES::IMAGES_APPLICATIONS, 'id_image', $id_image, $data_image);
                
                if ($rest) {
                    $msg['code'] = 200;
                    $msg['type'] = "success";
                    $msg['message'] = "Image supprimée avec succès";
                } else {
                    $msg['message'] = "Erreur lors de la suppression";
                }
            } else {
                $msg['message'] = "Image introuvable";
            }
        } else {
            $msg['message'] = "Identifiant de l'image manquant";
        }

        echo json_encode($msg);
        return;
    }

    /**
     * Liste des images d'une application
     */
    public function getListeImagesApplication()
    {
        $application_code = $_POST['application_code'] ?? null;
        $images = [];

        if ($application_code) {
            $fc = new Factory();
            $images = $fc->raw(
                "SELECT * FROM " . TABLES::IMAGES_APPLICATIONS . " WHERE application_code = ? AND etat_image = 1",
                [$application_code],
                'fetchAll'
            );
        }

        $data = ImageApplicationService::imageApplicationDataService($images);

        echo json_encode([
            "data" => $data
        ]);
        return;
    }

    /**
     * Modal d'ajout d'image
     */
    public function modalAddImageApplication()
    {
        // $_POST = sanitizePostData($_POST);
        $application_code = $_POST['code_application'] ?? null;
        $result['code'] = 400;
        
        if ($application_code) {
            $output = ImageApplicationService::modalAddImageApplication($application_code);
            $result['data'] = $output;
            $result['code'] = 200;
        }
        echo json_encode($result);
        return;
    }


    /**
     * Modal de modification d'image
     */
    public function modalUpdateImageApplication()
    {
        $_POST = sanitizePostData($_POST);
        $id_image = $_POST['code'] ?? null;
        $result['code'] = 400;
        
        if ($id_image) {
            $fc = new Factory();
            $image = $fc->find(TABLES::IMAGES_APPLICATIONS, 'id_image', $id_image);
            
            if ($image) {
                $output = ImageApplicationService::modalUpdateImageApplication($image);
                $result['data'] = $output;
                $result['code'] = 200;
            }
        }
        
        echo json_encode($result);
        return;
    }
}
