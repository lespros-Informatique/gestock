<?php

namespace App\Services;

class ImageApplicationService
{

    public static function imageApplicationDataService($images)
    {
        $data = [];

        $i = 0;
        foreach ($images as $image) :
            $i++;
            
            // Afficher l'image
            $imagePreview = '<img src="'. url('public/'.$image['link_image']) .'" alt="Image" style="height: 50px; object-fit: cover;">';
            
            $data[] = [
                $i,
                $image['id_image'],
                $imagePreview,
                '<button type="button" class="btn btn-danger btn-sm imageApplicationDelete" data-imageapplication="'.$image['id_image'].'"><i class="fa fa-trash"></i> Supprimer</button>'
            ];

        endforeach;

        return $data;
    }

    public static function modalAddImageApplication($application_code)
    {
        return '
        <form action="" id="frmAddImageApplication" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image_file" accept="image/*" required>
                        <input type="hidden" name="application_code" value="'.$application_code.'">
                    </div>
                </div>
            </div>
            <input value="btn_ajouter_image_application" name="action" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_ajouter_image_application" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }

    public static function modalUpdateImageApplication($image)
    {
        return '
        <form id="formUpdateImageApplication" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="'. url('public/'.$image['link_image']) .'" alt="Image" class="img-fluid mb-3" style="max-height: 200px;">
                    <input type="hidden" name="id_image" value="'.$image['id_image'].'">
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nouvelle image (remplace l\'actuelle)</label>
                        <input type="file" class="form-control" name="image_file" accept="image/*">
                    </div>
                </div>
            </div>
            <input name="action" value="btn_modifier_image_application" type="hidden">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }
}
