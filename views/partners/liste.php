<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-handshake"></i> &nbsp; Liste des partenaires</h4>
            </div>
            <div class="table_row_header_right">
                <button class="btn btn-primary "> <i class="fa fa-print"></i> &nbsp; <span class=" text-uppercase">Imprimer</span></button>
                <button type="button" class="btn btn-info " id="PartnerAddModal"> <i class="fa fa-plus-circle fa-2"></i> &nbsp; <span class=" text-uppercase">Enregistrer partenaire</span></button>

            </div>

        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive table-responsive-md" id="sexion_partner">

            <table id="data-table-partner" class="table table-striped table-bordered  table-hover table-sm table-data">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Nom & prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>État</th>
                        <th>Date création</th>
                        <th width="6%">Options</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="partner-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="partnerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="position: relative;" class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="partnerModalLabel"><i class="fa fa-handshake"></i> &nbsp; <span class="text-uppercase">Partenaire</span> </h5>
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
