<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Service</h2>
        <a href="<?php echo site_url('admin/services'); ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/services/update/' . $service->id); ?>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="<?php echo $service->title; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon (e.g. fas fa-code)</label>
                    <input type="text" name="icon" class="form-control" value="<?php echo $service->icon; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo $service->description; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?php echo $service->sort_order; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Update Service</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
