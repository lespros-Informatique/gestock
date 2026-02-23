<?php

namespace App\Services;


class TypeAbonnementService
{

    public static function typeAbonnementDataService($typeAbonnements)
    {
        $data = [];

        $i = 0;
        foreach ($typeAbonnements as $type) :
            $i++;
            
            // Afficher le prix formaté
            $prix = !empty($type['prix_type_abonnement']) 
                ? number_format($type['prix_type_abonnement'], 0, ',', ' ') . ' CFA'
                : 'N/A';
            
            $data[] = [
                $i,
                $type['code_type_abonnement'],
                $type['application_code'],
                $type['libelle_type_abonnement'],
                $prix,
                $type['periode_type_abonnement'] ?? 'N/A',
                $type['etat_type_abonnement'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>',
                '
                <div class="table_button">
                    <button
                        id="frmModifierTypeAbonnement' . $i . '"
                        type="button"
                        class="btn btn-primary btn-sm mr-2 frmModifierTypeAbonnement"
                        data-typeabonnement="' . ($type['code_type_abonnement']) . '">
                        <i class="fa fa-edit"></i> Modifier
                    </button>

                    <a href="'.url('type_abonnement/detail', ['code' => $type['code_type_abonnement']]).'"
                        id="typeAbonnementDetail' . $i . '"
                        type="button"
                        class="btn btn-info btn-sm mr-2 typeAbonnementDetail"
                        data-typeabonnement="' . $type['code_type_abonnement'] . '">
                        <i class="fa fa-eye"></i> Détail
                    </a>

                    <button
                        id="typeAbonnementDelete' . $i . '"
                        type="button"
                        class="btn btn-danger btn-sm typeAbonnementDelete"
                        data-typeabonnement="' . $type['code_type_abonnement'] . '">
                        <i class="fa fa-trash"></i> Supprimer
                    </button>
                </div>
               '
            ];

        endforeach;

        return $data;
    }

    public static function modalAddTypeAbonnement($applications)
    {
        $form = '<form action="" id="frmAddTypeAbonnement" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_type_abonnement" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Application</label>
                        <select class="form-control" name="application_code" required>
                            <option value="">-- Sélectionner --</option>';
        
        if (!empty($applications)) {
            foreach ($applications as $app) {
                $form .= '<option value="'.$app['code_application'].'">'.$app['libelle_application'].'</option>';
            }
        }

        $form .= '</select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prix (CFA)</label>
                        <input type="number" class="form-control" name="prix_type_abonnement" placeholder="Ex: 5000">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Période</label>
                        <input type="text" class="form-control" name="periode_type_abonnement" placeholder="Ex: 30 jours">
                    </div>
                </div>
            </div>
            <input value="btn_ajouter_type_abonnement" name="action" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_ajouter_type_abonnement" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';

        return $form;
    }

    public static function modalUpdateTypeAbonnement($typeAbonnement, $applications)
    {
        $form = '<form id="formUpdateTypeAbonnement" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Libellé</label>
                        <input type="text" class="form-control" name="libelle_type_abonnement" value="'.$typeAbonnement['libelle_type_abonnement'].'" required>
                        <input type="hidden" name="code_type_abonnement" value="'.$typeAbonnement['code_type_abonnement'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Application</label>
                        <select class="form-control" name="application_code" required>
                            <option value="">-- Sélectionner --</option>';
        
        if (!empty($applications)) {
            foreach ($applications as $app) {
                $selected = ($app['code_application'] == $typeAbonnement['application_code']) ? 'selected' : '';
                $form .= '<option value="'.$app['code_application'].'" '.$selected.'>'.$app['libelle_application'].'</option>';
            }
        }

        $form .= '</select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prix (CFA)</label>
                        <input type="number" class="form-control" name="prix_type_abonnement" value="'.$typeAbonnement['prix_type_abonnement'].'" placeholder="Ex: 5000">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Période</label>
                        <input type="text" class="form-control" name="periode_type_abonnement" value="'.$typeAbonnement['periode_type_abonnement'].'" placeholder="Ex: 30 jours">
                    </div>
                </div>
            </div>
            <input name="action" value="btn_modifier_type_abonnement" type="hidden">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';

        return $form;
    }
}
