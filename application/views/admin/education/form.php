<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo isset($item) ? 'Edit Education' : 'Add Education'; ?></h2>
        <a href="<?php echo site_url('admin/education'); ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/education/save/' . (isset($item) ? $item->id : '')); ?>
                <div class="mb-3">
                    <label class="form-label">Degree / Qualification</label>
                    <input type="text" name="degree" class="form-control" value="<?php echo isset($item) ? $item->degree : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Field of Study</label>
                    <input type="text" name="field" class="form-control" value="<?php echo isset($item) ? $item->field : ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Institution / University</label>
                    <input type="text" name="institution" class="form-control" value="<?php echo isset($item) ? $item->institution : ''; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Year / Duration</label>
                    <input type="text" name="year" class="form-control" value="<?php echo isset($item) ? $item->year : ''; ?>" placeholder="e.g. 2018 - 2022">
                </div>
                <button type="submit" class="btn btn-primary">Save Education</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
