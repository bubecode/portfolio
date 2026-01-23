<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Account Settings</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <?php echo form_open('admin/settings/change_password'); ?>
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" required minlength="6">
                            <small class="text-muted">Minimum 6 characters</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card bg-light border-0">
                <div class="card-body text-center p-5">
                    <i class="fas fa-shield-halved fa-5x text-primary mb-4"></i>
                    <h4>Security Tips</h4>
                    <p class="text-muted">Keep your account secure by using a strong password that you don't use for other websites.</p>
                </div>
            </div>
        </div>
    </div>
</div>
