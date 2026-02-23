<?php

namespace App\Services;


class PartnerService
{

    public static function partnerDataService($partners)
    {
        $data = [];

        $i = 0;
        foreach ($partners as $partner) :
            $i++;
            
            $data[] = [
                $i,
                $partner['code_partner'],
                strtoupper($partner['nom_partner']) . ' ' . ucfirst($partner['prenom_partner']),
                $partner['email_partner'],
                $partner['telephone_partner'],
                $partner['etat_partner'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>',
                $partner['created_at_partner'],
                '
                <div class="table_button">
                    <button
                        id="btn_edit_partner_' . $i . '"
                        type="button"
                        class="btn btn-primary btn-sm mr-2 frmModifierPartner"
                        data-partner="' . ($partner['code_partner']) . '">
                        <i class="fa fa-edit"></i> Modifier
                    </button>

                    <button
                        id="btn_delete_partner_' . $i . '"
                        type="button"
                        class="btn btn-danger btn-sm partnerDelete"
                        data-partner="' . $partner['code_partner'] . '">
                        <i class="fa fa-trash"></i> Supprimer
                    </button>
                </div>
               '
            ];

        endforeach;

        return $data;
    }

    public static function modalAddPartner()
    {
        return '
        <form id="formAddPartner" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="nom_partner" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" class="form-control" name="prenom_partner" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_partner" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" class="form-control" name="telephone_partner" required>
                    </div>
                </div>
            </div>
            <input value="btn_ajouter_partner" name="action" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_ajouter_partner" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }

    public static function modalUpdatePartner($partner)
    {
        return '
        <form id="formUpdatePartner" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control" name="nom_partner" value="'.strtoupper($partner['nom_partner']).'" required>
                        <input type="hidden" name="code_partner" value="'.$partner['code_partner'].'">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Prénom</label>
                        <input type="text" class="form-control" name="prenom_partner" value="'.ucfirst($partner['prenom_partner']).'" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email_partner" value="'.$partner['email_partner'].'" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Téléphone</label>
                        <input type="text" class="form-control" name="telephone_partner" value="'.$partner['telephone_partner'].'" required>
                    </div>
                </div>
            </div>
            <input name="action" value="btn_modifier_partner" type="hidden">
            <div class="modal-footer">
                <button type="submit" id="btn_modifier_partner" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>';
    }
}
