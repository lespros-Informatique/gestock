<?php

namespace App\Services;

use App\Core\Auth;
use App\Models\Catalogue;
use App\Models\Factory;
use DateTime;
use IntlDateFormatter;
use Roles;

class CatalogueService
{

public static function categorieDataService($categories)
    {
        $data = [];

        $i = 0;
        foreach ($categories as $categorie) :
            $i++;
            $data[] = [
                $i,
                $categorie['libelle_categorie'],
                $categorie['description_categorie'],
                '
                <div class="table_button">

                <button
            id="frmModifierCategorie'. $i .'"
            type="button"
            class="btn btn-primary btn-sm mr-2 frmModifierCategorie"
            data-categorie="'. ($categorie['code_categorie']) .'">
            <i class="fa fa-edit"></i> Modifier
          </button>

          <button
            id="categorieDeleteCategorie'. $i .'"
            type="button"
            class="btn btn-danger btn-sm categorieDeleteCategorie"
            data-categorie="'.$categorie['code_categorie'] .'">
            <i class="fa fa-trash"></i> Supprimer
          </button>

                </div>
               '
            ];

        endforeach;

        return $data;
    }


    public static function aModalAddCategorie()
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

    public static function aModalAddMark()
    {
        return '
        <form action="" id="frmAddMark" method="POST">
                  <div class="form-group">
                      <label for="libelle_mark">Libelle <span class="text-danger">*</span> </label>
                      <input name="libelle_mark" type="text" class="form-control"  id="libelle_mark" >
                  </div>

                  <div class="form-group">
                  <input value="btn_ajouter_mark" name="action" type="hidden">
                  </div>
                    <button type="submit" id="btn_add_mark" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>
              </form>
        ';
    }

    public static function modalUpdateMark($mark)
    {
        return '
        <form action="" id="frmAddMark" method="POST">
                <div class="form-group">
                    <label for="libelle_mark">Libelle <span class="text-danger">*</span>  </label>
                    <input name="libelle_mark" type="text" class="form-control" value="' . $mark['libelle_mark'] . '" id="libelle_mark" >
                </div>

                <div class="form-group">
                    <input name="code_mark" value="' . ($mark['code_mark']) . '" type="hidden">
                    <input name="action" value="btn_modifier_mark" type="hidden">
                </div>
                        <button type="submit" id="btn_add_mark" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>

            </form>
        ';
    }
    public static function aModalAddUnite()
    {
        return '
        <form action="" id="frmAddUnite" method="POST">
                  <div class="form-group">
                      <label for="libelle_unite">Libelle <span class="text-danger">*</span> </label>
                      <input name="libelle_unite" type="text" class="form-control"  id="libelle_unite" >
                  </div>

                  <div class="form-group">
                  <input value="btn_ajouter_unite" name="action" type="hidden">
                  </div>
                    <button type="submit" id="btn_add_unite" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>
              </form>
        ';
    }

    public static function modalUpdateUnite($unite)
    {
        return '
        <form action="" id="frmAddUnite" method="POST">
                <div class="form-group">
                    <label for="libelle_unite">Libelle <span class="text-danger">*</span>  </label>
                    <input name="libelle_unite" type="text" class="form-control" value="' . $unite['libelle_unite'] . '" id="libelle_unite" >
                </div>

                <div class="form-group">
                    <input name="code_unite" value="' . ($unite['code_unite']) . '" type="hidden">
                    <input name="action" value="btn_modifier_unite" type="hidden">
                </div>
                        <button type="submit" id="btn_add_unite" class="btn btn-primary modal_footer"> <i class="fa fa-check-circle"></i> Enregistrer </button>

            </form>
        ';
    }

    public static function aModalAddProduit($categories, $marks, $unites)
    {
        // $cl = (new Factory())->verifyParam("fournisseurs","etat_fournieur",);
        //  $categorie = (new Catalogue())->aGetCatalogueByFields('categories', 'compte_code', 'categorie_code', COMPTE_CODE, categorie_CODE);
var_dump($categories);return;
       
    }


}
