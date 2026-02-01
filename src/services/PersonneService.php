<?php

namespace App\Services;

use App\Core\Auth;
use DateTime;
use IntlDateFormatter;
use Roles;

class PersonneService
{

    public static function bClientddModalService()
    {
        $output = "";
        $output .= '
             <form action="#" method="post" id="frmAddClient">
                 <div class="row mb-3 px-3 ">
                     <input type="hidden" value="btn_add_client" name="action">

                     <label for="nom_client" class="form-label">Nom & prénoms <strong
                             class="text-danger">*</strong></label>
                     <input type="text" class="form-control" id="nom_client" name="nom_client" required>
                 </div>

                 <div class="row mb-3 px-3">
                     <label for="telephone_client" class="form-label">Téléphone <strong
                             class="text-danger">*</strong></label>
                     <input type="text" class="form-control" id="telephone_client" name="telephone_client" required>
                 </div>

                 <div class="row mb-3 px-3">
                    
                         <label for="email_client" class="form-label">Email </label>
                         <input type="email" class="form-control" name="email_client" id="email_client" required>
                 </div>


                 <div class="row mb-3 px-3">
                     <label for="sexe" class="form-label">Civilé <strong class="text-danger">*</strong></label>
                     <select name="sexe" class="form-control" id="sexe" required>
                         <option value="">--- CHOISIR ---</option>
                         ';

        foreach (SEXEP as $sx) {
            $output .= '<option value="' . $sx . '">' . $sx . '</option>';
        }

        $output .= '
                     </select>

                 </div>
                 <div class="modal-footer">
                     
                     <button type="submit" class="btn btn-primary" id="btnAddClient"><i class="fa fa-save"></i> &nbsp;
                         Enregistrer le client</button>
                 </div>
             </form> ';

        return $output;
    }
}
