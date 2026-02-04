<?php

namespace App\Services;

use App\Core\Auth;
use DateTime;
use IntlDateFormatter;
use Roles;

class PersonneService
{

    public static function bClientAddModalService()
    {
        $output = "";
        $output .= '
             <form method="post" id="frmAddClientData">
                 <div class="row mb-3 px-3 ">
                     <input type="hidden" value="btn_add_client_data" name="action">

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
                         <input type="email" class="form-control" name="email_client" id="email_client">
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
               
                 <div class="col-md-12">
                 <button type="submit" class="btn btn-primary modal_footer" id="btnAddClient"><i class="fa fa-save"></i> &nbsp;
                         Enregistrer le client</button>
                 </div>
                
             </form> ';

        return $output;
    }

    public static function bClientUpdateModalService($data)
    {
        $output = "";
        $output .= '
             <form method="post" id="frmUpdateClientData">
                 <div class="row mb-3 px-3 ">
                 <input type="hidden" name="csrf_token" value="' . csrfToken()::token() . '"> 

                     <input type="hidden" value="btn_modifier_client_data" name="action">
                     <input type="hidden" value="' . $data['code_client'] . '" name="code_client">

                     <label for="nom_client" class="form-label">Nom & prénoms <strong
                             class="text-danger">*</strong></label>
                     <input type="text" class="form-control" id="nom_client" name="nom_client" value="' . $data['nom_client'] . '" required>
                 </div>

                 <div class="row mb-3 px-3">
                     <label for="telephone_client" class="form-label">Téléphone <strong
                             class="text-danger">*</strong></label>
                     <input type="text" class="form-control" id="telephone_client" name="telephone_client" value="' . $data['telephone_client'] . '" required>
                 </div>

                 <div class="row mb-3 px-3">
                    
                         <label for="email_client" class="form-label">Email </label>
                         <input type="email" class="form-control" name="email_client" id="email_client" value="' . $data['email_client'] . '">
                 </div>
                    <div class="row mb-3 px-3">
                        <label for="sexe" class="form-label">Civilé <strong class="text-danger">*</strong></label>
                        <select name="sexe" class="form-control" id="sexe" required>
                            <option value="">--- CHOISIR ---</option>
                            ';

        foreach (SEXEP as $sx) {
            $output .= '<option value="' . $sx . '" ' . selected($data['sexe_client'], $sx) . '>' . $sx . '</option>';
        }

        $output .= '
                     </select>

                 </div>
               
                 <div class="col-md-12">
                 <button type="submit" class="btn btn-primary modal_footer" id="btnUpdateClient"><i class="fa fa-edit"></i> &nbsp;
                         Modifier le client</button>
                 </div>
                
             </form> ';

        return $output;
    }

    public static function clientDataService($clients)
    {
        $data = [];

        $i = 0;
        foreach ($clients as $client) :
            $i++;
            $data[] = [
                $i,
                $client['nom_client'],
                $client['telephone_client'],
                $client['sexe_client'],
                date_formater($client['client_created_at']),
                '
                <div class="table_button">
                 <button type="button" data-client="' . $client["code_client"] . '" class="btn btn-primary btn-sm mr-2 frmModifierClientData" > <i class="fa fa-edit"></i> &nbsp; Modifier </button>
                <a class="btn btn-info btn-sm mr-2" href=" ' . url('profile-client', ['code' => $client['code_client']]) . ' "> <i
                        class="fa fa-eye"></i> &nbsp; Info </a> 
                </div>
               '
            ];

        endforeach;

        return $data;
    }
}
