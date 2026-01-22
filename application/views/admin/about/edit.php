<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage About Section</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">Main Content</div>
                <div class="card-body">
                    <?php echo form_open('admin/about/update'); ?>
                        <div class="mb-3">
                            <label class="form-label">Section Label (e.g., About Me)</label>
                            <input type="text" name="section_label" class="form-control" value="<?php echo isset($about->section_label) ? $about->section_label : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo isset($about->title) ? $about->title : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="<?php echo isset($about->subtitle) ? $about->subtitle : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About Text (Markdown supported)</label>
                            <textarea name="about_text" class="form-control" rows="5"><?php echo isset($about->about_text) ? $about->about_text : ''; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal Statement / Quote</label>
                            <textarea name="personal_statement" class="form-control" rows="3"><?php echo isset($about->personal_statement) ? $about->personal_statement : ''; ?></textarea>
                        </div>
                        
                        <hr>
                        <h5>Add Feature</h5>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <input type="text" name="new_feature_label" class="form-control" placeholder="Feature Label">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="new_feature_icon" class="form-control" placeholder="Icon Class (e.g. fas fa-user)">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Existing Features</div>
                <ul class="list-group list-group-flush">
                    <?php if(!empty($features)): ?>
                        <?php foreach($features as $feature): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="<?php echo $feature->icon; ?> me-2"></i> <?php echo $feature->label; ?>
                                </div>
                                <a href="<?php echo site_url('admin/about/delete_feature/'.$feature->id); ?>" class="text-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted">No features added yet.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
