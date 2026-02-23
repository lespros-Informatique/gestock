<?php

namespace App\Services;

class AvantageService
{

    public static function avantageDataService($avantages)
    {
        $data = [];

        $i = 0;
        foreach ($avantages as $avantage) :
            $i++;
            
            $data[] = [
                $i,
                $avantage['code_avantage'],
                $avantage['type_abonnement_code'],
                $avantage['description_avantage'],
                $avantage['valeur_avantage'] ?? 'N/A',
                $avantage['etat_avantage'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>',
                '
                <div class="table_button">
                    <a href="'.url('avantage/detail', ['code' => $avantage['code_avantage']]).'"
                        id="avantageDetail' . $i . '"
                        type="button"
                        class="btn btn-info btn-sm mr-2 avantageDetail"
                        data-avantage="' . $avantage['code_avantage'] . '">
                        <i class="fa fa-eye"></i> Détail
                    </a>

                    <button
                        id="frmModifierAvantage' . $i . '"
                        type="button"
                        class="btn btn-primary btn-sm mr-2 frmModifierAvantage"
                        data-avantage="' . ($avantage['code_avantage']) . '">
                        <i class="fa fa-edit"></i> Modifier
                    </button>

                    <button
                        id="avantageDelete' . $i . '"
                        type="button"
                        class="btn btn-danger btn-sm avantageDelete"
                        data-avantage="' . $avantage['code_avantage'] . '">
                        <i class="fa fa-trash"></i> Supprimer
                    </button>
                </div>
               '
            ];

        endforeach;

        return $data;
    }

    public static function modalAddAvantage($typeAbonnements)
    {
        $form = '<form action="" id="frmAddAvantage" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type Abonnement</label>
                        <select class="form-control" name="type_abonnement_code" required>
                            <option value="">-- Sélectionner --</option>';
        
        if (!empty($typeAbonnements)) {
            foreach ($typeAbonnements as $type) {
                $form .= '<option value="'.$type['code_type_abonnement'].'">'.$type['libelle_type_abonnement'].'</option>';
            }
        }

        $form .= '</select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description_avantage" required placeholder="Ex: Accès illimité">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Valeur</label>
                        <input type="text" class="form-control" name="valeur_avantage" placeholder="Ex: 100, Illimité, etc.">
                    </div>
                </div>
            </div>
            <input value="btn_ajouter_avantage" name="action" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_ajouter_avantage" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';

        return $form;
    }

    public static function modalUpdateAvantage($avantage, $typeAbonnements)
    {
        $form = '<form id="formUpdateAvantage" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type Abonnement</label>
                        <select class="form-control" name="type_abonnement_code" required>
                            <option value="">-- Sélectionner --</option>';
        
        if (!empty($typeAbonnements)) {
            foreach ($typeAbonnements as $type) {
                $selected = ($type['code_type_abonnement'] == $avantage['type_abonnement_code']) ? 'selected' : '';
                $form .= '<option value="'.$type['code_type_abonnement'].'" '.$selected.'>'.$type['libelle_type_abonnement'].'</option>';
            }
        }

        $form .= '</select>
                        <input type="hidden" name="code_avantage" value="'.$avantage['code_avantage'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description_avantage" value="'.$avantage['description_avantage'].'" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Valeur</label>
                        <input type="text" class="form-control" name="valeur_avantage" value="'.$avantage['valeur_avantage'].'" placeholder="Ex: 100, Illimité, etc.">
                    </div>
                </div>
            </div>
            <input name="action" value="btn_modifier_avantage" type="hidden">
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';

        return $form;
    }
}
