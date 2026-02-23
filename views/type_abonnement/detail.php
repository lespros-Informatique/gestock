<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-tags"></i> &nbsp; Détail du type d'abonnement</h4>
            </div>
            <div class="table_row_header_right">
                <a href="<?= url('type-abonnement') ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> &nbsp; <span class=" text-uppercase">Retour</span></a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Code:</strong></label>
                    <p><?= $typeAbonnement['code_type_abonnement'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Libellé:</strong></label>
                    <p><?= $typeAbonnement['libelle_type_abonnement'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Application:</strong></label>
                    <p><?= $application['libelle_application'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Prix:</strong></label>
                    <p>
                        <?php if (!empty($typeAbonnement['prix_type_abonnement'])): ?>
                            <?= number_format($typeAbonnement['prix_type_abonnement'], 0, ',', ' ') ?> CFA
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Période:</strong></label>
                    <p><?= $typeAbonnement['periode_type_abonnement'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>État:</strong></label>
                    <p>
                        <?php if (isset($typeAbonnement['etat_type_abonnement'])): ?>
                            <?= $typeAbonnement['etat_type_abonnement'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
