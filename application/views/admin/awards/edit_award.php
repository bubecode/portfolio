<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Award</h2>
        <a href="<?php echo site_url('admin/awards'); ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/awards/update/' . $award->id); ?>
                <div class="mb-3">
                    <label class="form-label">Award Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $award->title; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Organization</label>
                    <input type="text" name="organization" class="form-control" value="<?php echo $award->organization; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo $award->description; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="text" name="year" class="form-control" value="<?php echo $award->year; ?>" placeholder="e.g. 2023">
                </div>
                <button type="submit" class="btn btn-primary">Update Award</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
