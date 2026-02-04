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

<!-- Modal -->
<div class="modal fade" id="produit-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="produitModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="produitModalLabel"><i class="fa fa-user-circle"></i> &nbsp; <span class="text-uppercase">produit</span>  </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row ">
            <div class="col-md-12 data-modal">
              
            </div>
        </div>
      </div>
        <!-- .modal-footer -->
        <div class="modal-footer">
        
      </div><!-- /.modal-footer -->
    </div>
  </div>
</div>
