<div class="sidebar sidebar-style-2" data-background-color="dark2">

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <!-- user connected -->
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <div class="name-user">
                        <span style="font-size: 16px; font-weight: bold;" class=""><?php //shortName(auth()->user('nom')) 
                                                                                    ?></span>
                    </div>
                </div>

                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <?php //(string) auth()->user("nom")
                            ?>
                            <span class="user-level text-success"><?php //(string) auth()->user("fonction")
                                                                    ?></span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a class="item-link" href="<?php
                                                            //  route('user.profile',['code' => auth()->user('id')])
                                                            ?>">
                                    <span class="link-collapse">Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="btn_deconnect" href="javascript:void();">
                                    <span class="link-collapse">Deconnexion</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- menu lateral -->
            
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a style="background: #8debfcf1;" class="" href="<?= url('') ?>">
                        <i class="fas fa-home"></i>
                        <p>ACCUEIL</p>
                    </a>
                </li>

                <!-- Administration: Users & Roles -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#administration">
                        <i class="fas fa-cogs"></i>
                        <p>ADMINISTRATION</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="administration">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('user') ?>">
                                    <span class="sub-item">Utilisateurs</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('role') ?>">
                                    <span class="sub-item">Rôles & Permissions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Partners: Gestion des partenaires -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#partners">
                        <i class="fas fa-handshake"></i>
                        <p>PARTENAIRES</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="partners">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('partner') ?>">
                                    <span class="sub-item">Liste Partenaires</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('compte-partner') ?>">
                                    <span class="sub-item">Comptes Partenaires</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('paiement-partner') ?>">
                                    <span class="sub-item">Paiements Partenaires</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Clients: Gestion des clients -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#clients">
                        <i class="fas fa-users"></i>
                        <p>CLIENTS</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="clients">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('client') ?>">
                                    <span class="sub-item">Liste Clients</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Applications: Gestion des applications -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#applications">
                        <i class="fas fa-rocket"></i>
                        <p>APPLICATIONS</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="applications">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('application') ?>">
                                    <span class="sub-item">Liste Applications</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('type-abonnement') ?>">
                                    <span class="sub-item">Types d'Abonnement</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('avantage') ?>">
                                    <span class="sub-item">Avantages</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Abonnements: Gestion des abonnements -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#abonnements">
                        <i class="fas fa-credit-card"></i>
                        <p>ABONNEMENTS</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="abonnements">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('abonnement') ?>">
                                    <span class="sub-item">Liste Abonnements</span>
                                </a>
                            </li>
                            <li>
                                <a class="item-link" href="<?= url('paiement-abonnement') ?>">
                                    <span class="sub-item">Paiements Abonnements</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Paramètres -->
                <li class="nav-item">
                    <a data-toggle="collapse" href="#parametres">
                        <i class="fas fa-sliders-h"></i>
                        <p>PARAMÈTRES</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="parametres">
                        <ul class="nav nav-collapse">
                            <li>
                                <a class="item-link" href="<?= url('setting') ?>">
                                    <span class="sub-item">Général</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>

            <!-- END ADMIN SEXION -->
        </div>
    </div>
</div>
