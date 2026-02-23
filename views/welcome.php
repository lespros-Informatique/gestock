<div class="content">
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Tableau de bord</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Accueil</a>
                </li>
            </ul>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="<?= url('application') ?>">

                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small bg-primary rounded-circle">
                                    <i class="fas fa-rocket text-light"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Applications</p>
                                    <h4 class="card-title" id="total-applications">0</h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="<?= url('partner') ?>">

                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small bg-info rounded-circle">
                                    <i class="fas fa-handshake text-light"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Partenaires</p>
                                    <h4 class="card-title" id="total-partenaires">0</h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="<?= url('client') ?>">
                        
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small bg-success rounded-circle">
                                    <i class="fas fa-users text-light"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Clients</p>
                                    <h4 class="card-title" id="total-clients">0</h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <a href="<?= url('abonnement') ?>">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center bubble-shadow-small bg-warning rounded-circle">
                                    <i class="fas fa-credit-card text-light"></i>
                                </div>
                            </div>
                            <div class="col col-stats ml-3 ml-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Abonnements</p>
                                    <h4 class="card-title" id="total-abonnements">0</h4>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistiques financières -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Revenus du mois</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <h2 class="text-center mb-4" id="revenu-mois">0</h2>
                            <p class="text-muted text-center">FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Revenus totaux</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <h2 class="text-center mb-4" id="revenu-total">0</h2>
                            <p class="text-muted text-center">FCFA</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Abonnements mensuels</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="abonementsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Types d'abonnements</div>
                    </div>
                    <div class="card-body" id="types-abonnements">
                        <!-- Chargé via AJAX -->
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Chargement...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenus et abonnements récents -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Revenus mensuels</div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Derniers abonnements</div>
                    </div>
                    <div class="card-body" id="derniers-abonnements">
                        <!-- Chargé via AJAX -->
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Chargement...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partenaires récents -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Partenaires récents</div>
                    </div>
                    <div class="card-body" id="partenaires-recents">
                        <!-- Chargé via AJAX -->
                        <div class="text-center">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Chargement...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
