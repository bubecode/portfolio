<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Profile</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/profile/update'); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo isset($profile->name) ? $profile->name : ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Job Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo isset($profile->title) ? $profile->title : ''; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hero Text (Main Heading)</label>
                    <textarea name="hero_text" class="form-control" rows="2"><?php echo isset($profile->hero_text) ? $profile->hero_text : ''; ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Hero Subtext</label>
                    <textarea name="hero_subtext" class="form-control" rows="2"><?php echo isset($profile->hero_subtext) ? $profile->hero_subtext : ''; ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="<?php echo isset($profile->location) ? $profile->location : ''; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Timezone</label>
                        <input type="text" name="timezone" class="form-control" value="<?php echo isset($profile->timezone) ? $profile->timezone : ''; ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo isset($profile->email) ? $profile->email : ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status (e.g. Open to work)</label>
                        <select name="status" class="form-control">
                            <option value="Open to work" <?php echo (isset($profile->status) && $profile->status == 'Open to work') ? 'selected' : ''; ?>>Open to work</option>
                            <option value="Busy" <?php echo (isset($profile->status) && $profile->status == 'Busy') ? 'selected' : ''; ?>>Busy</option>
                            <option value="Not Available" <?php echo (isset($profile->status) && $profile->status == 'Not Available') ? 'selected' : ''; ?>>Not Available</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin" class="form-control" value="<?php echo isset($profile->linkedin) ? $profile->linkedin : ''; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">GitHub URL</label>
                        <input type="url" name="github" class="form-control" value="<?php echo isset($profile->github) ? $profile->github : ''; ?>">
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
