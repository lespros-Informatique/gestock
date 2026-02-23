<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-user"></i> &nbsp; Détails du client</h4>
            </div>
            <div class="table_row_header_right">
                <a href="<?= url('client') ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> &nbsp; <span class=" text-uppercase">Retour</span></a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Code:</strong></label>
                    <p><?= $client['code_client'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Nom:</strong></label>
                    <p><?= strtoupper($client['nom_client'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Téléphone:</strong></label>
                    <p><?= $client['telephone_client'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Email:</strong></label>
                    <p><?= $client['email_client'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Genre:</strong></label>
                    <p><?= ($client['sexe_client'] ?? 'N/A') == 'M' ? 'Masculin' : 'Féminin' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>État:</strong></label>
                    <p>
                        <?php if (isset($client['etat_client'])): ?>
                            <?= $client['etat_client'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Date de création:</strong></label>
                    <p><?= $client['created_at_client'] ?? 'N/A' ?></p>
                </div>
            </div>
            <?php if (!empty($client['partner_code'])): ?>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Partner:</strong></label>
                    <p><?= $client['partner_code'] ?></p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
