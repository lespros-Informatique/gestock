<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-gift"></i> &nbsp; Détail de l'avantage</h4>
            </div>
            <div class="table_row_header_right">
                <a href="<?= url('avantage') ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> &nbsp; <span class=" text-uppercase">Retour</span></a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Code:</strong></label>
                    <p><?= $avantage['code_avantage'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Type Abonnement:</strong></label>
                    <p><?= $typeAbonnement['libelle_type_abonnement'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Description:</strong></label>
                    <p><?= $avantage['description_avantage'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Valeur:</strong></label>
                    <p><?= $avantage['valeur_avantage'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>État:</strong></label>
                    <p>
                        <?php if (isset($avantage['etat_avantage'])): ?>
                            <?= $avantage['etat_avantage'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
