<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo isset($item) ? 'Edit Testimonial' : 'Add New Testimonial'; ?></h2>
        <a href="<?php echo site_url('admin/testimonials'); ?>" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger shadow-sm">', '</div>'); ?>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="mb-0">Testimonial Details</h5>
                </div>
                <div class="card-body p-4">
                    <?php echo form_open_multipart('admin/testimonials/save/' . (isset($item) ? $item->id : '')); ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Person Name <span class="text-danger">*</span></label>
                                <input type="text" name="person_name" class="form-control rounded-3" value="<?php echo isset($item) ? $item->person_name : ''; ?>" placeholder="e.g. Ahmed Ali" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Role / Title</label>
                                <input type="text" name="person_role" class="form-control rounded-3" value="<?php echo isset($item) ? $item->person_role : ''; ?>" placeholder="e.g. School Director">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Company Name</label>
                                <input type="text" name="company_name" class="form-control rounded-3" value="<?php echo isset($item) ? $item->company_name : ''; ?>" placeholder="e.g. Hoyga Xamar School">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Product Used</label>
                                <input type="text" name="product_used" class="form-control rounded-3" value="<?php echo isset($item) ? $item->product_used : ''; ?>" placeholder="e.g. Schoolly">
                            </div>

                            <div class="col-12 mt-4">
                                <label class="form-label fw-bold">Testimonial Message <span class="text-danger">*</span></label>
                                <textarea name="message" class="form-control rounded-3" rows="6" placeholder="Paste the feedback here..." required><?php echo isset($item) ? $item->message : ''; ?></textarea>
                            </div>

                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold">Rating (Stars)</label>
                                <select name="rating" class="form-select rounded-3">
                                    <?php for($i=5; $i>=1; $i--): ?>
                                        <option value="<?php echo $i; ?>" <?php echo (isset($item) && $item->rating == $i) ? 'selected' : ''; ?>>
                                            <?php echo $i; ?> Stars <?php echo ($i == 5) ? '(Best)' : ''; ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <div class="col-md-6 mt-4">
                                <label class="form-label fw-bold">Status</label>
                                <select name="status" class="form-select rounded-3">
                                    <option value="active" <?php echo (isset($item) && $item->status == 'active') ? 'selected' : ''; ?>>Active (Visible)</option>
                                    <option value="inactive" <?php echo (isset($item) && $item->status == 'inactive') ? 'selected' : ''; ?>>Inactive (Hidden)</option>
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <div class="form-check form-switch card p-3 border-light-subtle bg-light-subtle">
                                    <div class="ps-4">
                                        <input class="form-check-input ms-0" type="checkbox" name="is_featured" value="1" id="flexSwitchCheckDefault" <?php echo (isset($item) && $item->is_featured) ? 'checked' : ''; ?>>
                                        <label class="form-check-label ms-2 fw-bold" for="flexSwitchCheckDefault">Mark as Featured (Highlights this on homepage)</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 border-top pt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill">
                                <i class="fas fa-save me-1"></i> Save Testimonial
                            </button>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="mb-0">Media Uploads</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4 text-center">
                        <label class="form-label fw-bold d-block text-start mb-3">Person Image</label>
                        <div class="position-relative d-inline-block">
                            <div class="rounded-circle border overflow-hidden bg-light shadow-sm mb-3" style="width: 150px; height: 150px;">
                                <img id="personPreview" src="<?php echo (isset($item) && $item->person_image) ? base_url($item->person_image) : 'https://ui-avatars.com/api/?name=User&size=150'; ?>" class="w-100 h-100 object-fit-cover">
                            </div>
                            <label for="person_image_input" class="btn btn-light btn-sm rounded-circle position-absolute bottom-0 end-0 border shadow-sm">
                                <i class="fas fa-camera text-primary"></i>
                            </label>
                            <input type="file" name="person_image" id="person_image_input" class="d-none" onchange="previewImage(this, 'personPreview')">
                        </div>
                        <small class="text-muted d-block mt-2">Recommended: Square, JPG/PNG</small>
                    </div>

                    <hr class="my-4">

                    <div class="mb-3 text-center">
                        <label class="form-label fw-bold d-block text-start mb-3">Company Logo</label>
                        <div class="border rounded-3 p-3 bg-light-subtle text-center mb-3">
                            <img id="logoPreview" src="<?php echo (isset($item) && $item->company_logo) ? base_url($item->company_logo) : ''; ?>" class="mw-100" style="height: 60px; <?php echo (isset($item) && $item->company_logo) ? 'display: block;' : 'display: none;'; ?> margin: 0 auto;">
                            <?php if(!isset($item) || !$item->company_logo): ?>
                                <div id="logoPlaceholder" class="p-4 border border-dashed rounded-3">
                                    <i class="far fa-image fa-2x text-muted mb-2"></i>
                                    <div class="small text-muted">No logo uploaded</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <label for="company_logo_input" class="btn btn-outline-primary btn-sm rounded-pill w-100">
                            <i class="fas fa-upload me-1"></i> Choose Logo File
                        </label>
                        <input type="file" name="company_logo" id="company_logo_input" class="d-none" onchange="previewImage(this, 'logoPreview', 'logoPlaceholder')">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<script>
function previewImage(input, previewId, placeholderId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var preview = document.getElementById(previewId);
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholderId) {
                document.getElementById(placeholderId).style.display = 'none';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
