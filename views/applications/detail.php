<div class="card mt-2 bg_light">

    <div class="card-header">
        <div class="table_row_header">
            <div class="table_row_header_left">
                <h4 class=" text-upper"> <i class="fa fa-rocket"></i> &nbsp; Détail de l'application</h4>
            </div>
            <div class="table_row_header_right">
                <a href="<?= url('application') ?>" class="btn btn-secondary"> <i class="fa fa-arrow-left"></i> &nbsp; <span class=" text-uppercase">Retour</span></a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="form-group">
                    <label><strong>Icône</strong></label>
                    <div style="font-size: 48px;">
                        <?php if (!empty($application['icon_application'])): ?>
                            <i class="fa fa-<?= $application['icon_application'] ?>"></i>
                        <?php else: ?>
                            <span class="text-muted">N/A</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="form-group">
                    <label><strong>Image</strong></label>
                    <div>
                        <?php if (!empty($application['image_application'])): ?>
                            <img src="<?= url('public/'.$application['image_application']) ?>" alt="<?= $application['libelle_application'] ?>" class="img-fluid" style="max-height: 150px;">
                        <?php else: ?>
                            <span class="text-muted">Pas d'image</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="form-group">
                    <label><strong>État</strong></label>
                    <div>
                        <?php if (isset($application['etat_application'])): ?>
                            <?= $application['etat_application'] == 1 ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-danger">Inactif</span>' ?>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Code:</strong></label>
                    <p><?= $application['code_application'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Libellé:</strong></label>
                    <p><?= $application['libelle_application'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Slug:</strong></label>
                    <p><?= $application['slug_application'] ?? 'N/A' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Lien:</strong></label>
                    <p>
                        <?php if (!empty($application['link_application'])): ?>
                            <a href="<?= $application['link_application'] ?>" target="_blank" class="btn btn-sm btn-success">
                                <i class="fa fa-external-link-alt"></i> Ouvrir le lien
                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Lien Vidéo:</strong></label>
                    <p>
                        <?php if (!empty($application['link_video_application'])): ?>
                            <a href="<?= $application['link_video_application'] ?>" target="_blank" class="btn btn-sm btn-info">
                                <i class="fa fa-video"></i> Voir la vidéo
                            </a>
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label><strong>Description:</strong></label>
                    <p><?= $application['description_application'] ?? 'N/A' ?></p>
                </div>
            </div>
        </div>
        
        <hr>
        
        <!-- Section Images de l'application -->
        <div class="row mt-4">
            <div class="col-md-12">
                <h5><i class="fa fa-images"></i> Images de l'application</h5>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="button" class="btn btn-info" id="ImageApplicationAddModal" data-code-application="<?= $application['code_application'] ?>"> <i class="fa fa-plus-circle"></i> &nbsp; <span class="text-uppercase">Ajouter une image</span></button>
            </div>
        </div>
        
        <!-- Galerie d'images -->
        <div class="row mt-3" id="imagesGallery">
            <?php if (!empty($images)): ?>
                <?php foreach ($images as $image): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card h-100">
                            <img src="<?= url('public/'.$image['link_image']) ?>" class="card-img-top img-lightbox" alt="Image" style="height: 150px; object-fit: cover; cursor: pointer;" data-full-image="<?= url('public/'.$image['link_image']) ?>">
                            <div class="card-body p-2 text-center">
                                <button type="button" class="btn btn-danger btn-sm imageApplicationDelete" data-imageapplication="<?= $image['id_image'] ?>">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-12 text-center text-muted">
                    <p>Aucune image ajoutée pour cette application</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<!-- Modal pour les images -->
<div class="modal fade" id="image_application-modal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="imageApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div style="position: relative;" class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="imageApplicationModalLabel"><i class="fa fa-images"></i> &nbsp; <span class="text-uppercase">Image Application</span> </h5>
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
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Lightbox modal for images -->
<div class="modal fade" id="imageLightboxModal" tabindex="-1" role="dialog" aria-labelledby="imageLightboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 text-center">
                <img src="" id="lightboxImage" class="img-fluid" style="max-height: 80vh; margin: auto; display: block;">
            </div>
            <button type="button" class="close lightbox-close" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 20px; right: 30px; color: white; font-size: 40px; opacity: 0.8; text-shadow: 2px 2px 4px #000;">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
