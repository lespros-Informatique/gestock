<?php

namespace App\Services;

use App\Core\Auth;
use DateTime;
use IntlDateFormatter;
use Roles;

class CatalogueService
{
 public static function amodalAddCategorie()
    {
        return '
        <form action="" id="frmAddCategorie" method="POST">
                  <div class="form-group">
                      <label for="libelle_categorie">Libelle <span class="text-danger">*</span> </label>
                      <input name="libelle_categorie" type="text" class="form-control"  id="libelle_categorie" >
                  </div>

                  <div class="form-group">
                  <input value="btn_ajouter_categorie" name="action" type="hidden">
                    <label for="description_categorie">Description (200 Caractères)</label>
                    <textarea name="description_categorie" value="" rows="4"  maxlength="250" class="form-control"></textarea>
                  </div>
                    <button type="submit" id="btn_add_categorie" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>
              </form>
        ';
    }

    
    public static function modalUpdateCategorie($categorie)
    {
        return '
        <form action="" id="frmAddCategorie" method="POST">
                <div class="form-group">
                    <label for="libelle_categorie">Libelle <span class="text-danger">*</span>  </label>
                    <input name="libelle_categorie" type="text" class="form-control" value="' . $categorie['libelle_categorie'] . '" id="libelle_categorie" >
                </div>

                <div class="form-group">
                    <label for="description_categorie">Description (200 Caractères)</label>
                    <textarea name="description_categorie" rows="4"  maxlength="250" class="form-control">' . $categorie['description_categorie'] . '</textarea>
                    <input name="code_categorie" value="' . ($categorie['code_categorie']) . '" type="hidden">
                    <input name="action" value="btn_modifier_categorie" type="hidden">
                </div>
                        <button type="submit" id="btn_add_categorie" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>

            </form>
        ';
    }
}