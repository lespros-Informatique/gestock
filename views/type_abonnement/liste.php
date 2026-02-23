<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-tags"></i> &nbsp; Liste des types d'abonnements</h4>
            </div>
            <div class="table_row_header_right">
                <button class="btn btn-primary "> <i class="fa fa-print"></i> &nbsp; <span class=" text-uppercase">Imprimer</span></button>
                <button type="button" class="btn btn-info " id="TypeAbonnementAddModal"> <i class="fa fa-plus-circle fa-2"></i> &nbsp; <span class=" text-uppercase">Nouveau type</span></button>

            </div>

        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive table-responsive-md" id="sexion_type_abonnement">

            <table id="data-table-type_abonnement" class="table table-striped table-bordered  table-hover table-sm table-data">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Application</th>
                        <th>Libellé</th>
                        <th>Prix</th>
                        <th>Période</th>
                        <th>État</th>
                        <th width="6%">Options</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="type_abonnement-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="typeAbonnementModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="position: relative;" class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="typeAbonnementModalLabel"><i class="fa fa-tags"></i> &nbsp; <span class="text-uppercase">Type d'Abonnement</span> </h5>
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
