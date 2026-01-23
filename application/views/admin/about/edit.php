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
                            <label class="form-label">Role / Title</label>
                            <input type="text" name="role" class="form-control" value="<?php echo isset($about->role) ? $about->role : ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">About Text</label>
                            <textarea name="about_text" class="form-control" rows="5"><?php echo isset($about->about_text) ? $about->about_text : ''; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Personal Statement</label>
                            <textarea name="personal_statement" class="form-control" rows="2"><?php echo isset($about->personal_statement) ? $about->personal_statement : ''; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Professional Quote</label>
                            <textarea name="quote" class="form-control" rows="2" placeholder="e.g. I approach software as systems..."><?php echo isset($about->quote) ? $about->quote : ''; ?></textarea>
                        </div>
                        
                        <hr>
                        <h5>Add Core Expertise</h5>
                        <div class="row g-2">
                            <div class="col-md-12">
                                <input type="text" name="new_expertise" class="form-control" placeholder="Expertise (e.g. ERP Systems)">
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
                <div class="card-header">Core Expertise</div>
                <ul class="list-group list-group-flush">
                    <?php if(!empty($expertise)): ?>
                        <?php foreach($expertise as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <?php echo $item->expertise; ?>
                                </div>
                                <a href="<?php echo site_url('admin/about/delete_expertise/'.$item->id); ?>" class="text-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted">No expertise added yet.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
