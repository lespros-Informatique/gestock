<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-credit-card"></i> &nbsp; Détails de l'abonnement</h4>
            </div>
            <div class="table_row_header_right">
                <a href="<?= url('abonnement') ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> &nbsp; <span class=" text-uppercase">Retour</span></a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Code abonnement:</strong></label>
                    <p><?= $abonnement['code_abonnement'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Compte:</strong></label>
                    <p><?= $abonnement['compte_code'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Type d'abonnement:</strong></label>
                    <p><?= $abonnement['type_abonnement_code'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Date de début:</strong></label>
                    <p><?= $abonnement['date_debut'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Date de fin:</strong></label>
                    <p><?= $abonnement['date_fin'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>État:</strong></label>
                    <p>
                        <?php if (isset($abonnement['etat_abonnement'])): ?>
                            <?php 
                                $etatBadge = '';
                                if ($abonnement['etat_abonnement'] == 1) {
                                    if (!empty($abonnement['date_fin'])) {
                                        $dateFin = new \DateTime($abonnement['date_fin']);
                                        $aujourdhui = new \DateTime();
                                        if ($dateFin < $aujourdhui) {
                                            $etatBadge = '<span class="badge badge-warning">Expiré</span>';
                                        } else {
                                            $etatBadge = '<span class="badge badge-success">Actif</span>';
                                        }
                                    } else {
                                        $etatBadge = '<span class="badge badge-success">Actif</span>';
                                    }
                                } else {
                                    $etatBadge = '<span class="badge badge-danger">Inactif</span>';
                                }
                                echo $etatBadge;
                            ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
