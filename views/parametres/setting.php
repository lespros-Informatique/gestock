<div class="row">
    <div class="col-md-12">

        <div class="row">
            <!-- Section logo et informations de l'application -->
            <div class="col-md-3 ">
                <div class="card">
                    <div class="card-header">
                        <h5 class="">Logo de l'application</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-12 mt-1 mb-3">
                                <img id="btn_trigger_input_file" class="previewImg logo_app" src="<?= ASSETS  ?>img/icon.png" alt="">
                            </div>
                            <div class="col-md-12 mt-2 mb-1">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <input accept="image/jpeg, image/png, image/jpg" hidden type="file" id="fileInput" class="form-control" name="image_logo">
                                <input type="hidden" name="action" value="btn_upload_logo">
                                <button disabled type="submit" form="uploadForm"  id="btn_update_logo"  class="btn btn-primary btn-sm"><i class="fa fa-camera fa-lg"></i> &nbsp;
                                    Changer</button>
                            </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-12 mt-2 mb-3">
                                <ul class="list-group">
                                    <li class="list-group-item text-bold">APPLICATION : <span class="badge bg-success"> SmartCode</span></li>
                                    <li class="list-group-item text-bold">ETAT : <span class="badge bg-success"> Active</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Section informations générales -->
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5 class="">Informations Générales</h5>
                    </div>
                    <form action="" method="post" id="form_update_app">
                        <div class="card-body">
                            <div class="row mx-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nom_application">Nom de l'application</label>
                                        <input type="text" class="form-control" name="nom_application" value="SmartCode" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email_app">Email de contact</label>
                                        <input type="email" class="form-control" name="email_app" value="contact@smartcode.com" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-1">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone_app">Téléphone 1</label>
                                        <input type="text" class="form-control" name="telephone_app" value="+225 00 000 000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telephone_app2">Téléphone 2</label>
                                        <input type="text" class="form-control" name="telephone_app2" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="adresse_app">Adresse</label>
                                        <textarea name="adresse_app" id="adresse_app" class="form-control" rows="3">Côte d'Ivoire, Abidjan</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row mx-1">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description_app">Description</label>
                                        <textarea name="description_app" id="description_app" class="form-control" rows="3">Plateforme de gestion des applications et abonnements</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row mx-3 my-2">
                                <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="update_app">
                                    <button disabled type="submit" id="form_update_app" class="btn btn-info btn_update_app"> <i class="fa fa-save"></i> &nbsp;
                                        Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div><!-- end row -->
        
        <!-- Section abonnements et statistiques rapides -->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="">Statistiques rapides</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-stats card-warning">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-users"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">Utilisateurs</p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-stats card-success">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-handshake"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">Partenaires</p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-stats card-primary">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-rocket"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">Applications</p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-stats card-info">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="icon-big text-center">
                                                    <i class="fa fa-credit-card"></i>
                                                </div>
                                            </div>
                                            <div class="col-7 d-flex align-items-center">
                                                <div class="numbers">
                                                    <p class="card-category">Abonnements</p>
                                                    <h4 class="card-title">0</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
