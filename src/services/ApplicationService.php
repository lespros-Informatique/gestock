<?php

namespace App\Services;


class ApplicationService
{

    public static function applicationDataService($applications)
    {
        $data = [];

        $i = 0;
        foreach ($applications as $application) :
            $i++;
            
            // Rendre le lien cliquable
            $linkApplication = !empty($application['link_application']) 
                ? '<a href="'.$application['link_application'].'" target="_blank" class="btn btn-sm btn-success"><i class="fa fa-external-link-alt"></i> Ouvrir</a>'
                : 'N/A';
            
            // Afficher l'icône FontAwesome
            $iconApplication = !empty($application['icon_application']) 
                ? '<i class="fa fa-'.$application['icon_application'].'"></i>'
                : 'N/A';
            
            $data[] = [
                $i,
                $application['code_application'],
                $application['libelle_application'],
                $application['slug_application'],
                $iconApplication,
                $linkApplication,
                $application['etat_application'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>',
                '
                <div class="table_button">
                    <button
                        id="frmModifierApplication' . $i . '"
                        type="button"
                        class="btn btn-primary btn-sm mr-2 frmModifierApplication"
                        data-application="' . ($application['code_application']) . '">
                        <i class="fa fa-edit"></i> Modifier
                    </button>

                    <a href="'.url('application/detail', ['code' => $application['code_application']]).'"
                        id="applicationDetailApplication' . $i . '"
                        type="button"
                        class="btn btn-info btn-sm mr-2 applicationDetailApplication"
                        data-application="' . $application['code_application'] . '">
                        <i class="fa fa-eye"></i> Détail
                    </a>

                    <button
                        id="applicationDeleteApplication' . $i . '"
                        type="button"
                        class="btn btn-danger btn-sm applicationDeleteApplication"
                        data-application="' . $application['code_application'] . '">
                        <i class="fa fa-trash"></i> Supprimer
                    </button>
                </div>
               '
            ];

        endforeach;

        return $data;
    }

    public static function modalAddApplication()
    {
        return '
        <form action="" id="frmAddApplication" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_application" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" name="slug_application" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Icône (classe FontAwesome)</label>
                        <input type="text" class="form-control" name="icon_application" placeholder="Ex: fa-rocket">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image_application" accept="image/*">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lien</label>
                        <input type="text" class="form-control" name="link_application">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lien Vidéo</label>
                        <input type="text" class="form-control" name="link_video_application" placeholder="Ex: https://youtube.com/...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description_application"></textarea>
                    </div>
                </div>
            </div>
            <input value="btn_ajouter_application" name="action" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_ajouter_application" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }

    public static function modalUpdateApplication($application)
    {
        return '
        <form id="formUpdateApplication" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_application" value="'.$application['libelle_application'].'" required>
                        <input type="hidden" name="code_application" value="'.$application['code_application'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" name="slug_application" value="'.$application['slug_application'].'" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Icône (classe FontAwesome)</label>
                        <input type="text" class="form-control" name="icon_application" value="'.$application['icon_application'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image_application" accept="image/*">
                        ' . (!empty($application['image_application']) ? '<img src="'. url('public/'.$application['image_application']) .'" alt="'. $application['libelle_application'].'" class="img-fluid" style="max-height: 150px;">' : 'Aucune image') . '
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lien</label>
                        <input type="text" class="form-control" name="link_application" value="'.$application['link_application'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Lien Vidéo</label>
                        <input type="text" class="form-control" name="link_video_application" value="'.$application['link_video_application'].'" placeholder="Ex: https://youtube.com/...">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description_application">'.$application['description_application'].'</textarea>
                    </div>
                </div>
            </div>
            <input name="action" value="btn_modifier_application" type="hidden">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }
}
