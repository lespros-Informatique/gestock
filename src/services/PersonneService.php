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


    public static function clientDataService($clients)
    {
        $output = "";

        $i = 0;
        foreach ($clients as $data) :
            $i++;

            $output .= '
            
            <tr>
            <th scope="row">
                
                ' . $i . '</th>
            <td> ' . $data["nom_client"] . '</td>
            <td> ' . $data['telephone_client'] . '</td>
            <td> ' . $data['sexe_client'] . '</td>
            <td> ' . date_formater($data['client_created_at']) . '</td>
            <td class="table_button">
            <span hidden>  ' . $data["code_client"] . ' </span>
            <button class="btn btn-primary btn-sm mr-2 btnUpdateClient" > <i class="fa fa-edit"></i> &nbsp; Modifier </button>
                <a class="btn btn-info btn-sm mr-2" href=" ' . url('profile-client', ['code' => $data['code_client']]) . ' "> <i
                    class="fa fa-eye"></i> &nbsp; Info </a>
            </td>
            </tr> ';
        endforeach;

        return $output;
    }
}
