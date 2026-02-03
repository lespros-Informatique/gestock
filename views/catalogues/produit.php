<div class="card mt-2 bg_light">
  <div class="card-header">
    <h5 class="card-title text-upper">
      <i class="fa fa-list"></i> &nbsp;Liste Produits
    </h5>

    <button class="btn btn-info pull-right" id="produitAddModal">
      <i class="fa fa-plus-circle"></i>&nbsp; &nbsp; Ajouter
    </button>
  </div>

  <div class="card-body">
    <div class="table-responsive table-responsive-md" id="section_produit">

      <table class="table table-striped table-bordered table-hover table-sm table-data">
        <thead>
          <tr>
            <th class="text-center" width="2px">#</th>
            <th class="text-center">Produit</th>
            <th class="text-center">Prix Achat</th>
            <th class="text-center">Prix Vente</th>
            <th class="text-center">Stock</th>
            <th class="text-center" width="25px">Options</th>
          </tr>
        </thead>

        <tbody>
          <?= aChargerListeProduits() ?>
        </tbody>

      </table>
    </div>
  </div>
</div>
