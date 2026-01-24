<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo isset($item) ? 'Edit Experience' : 'Add New Experience'; ?></h2>
        <a href="<?php echo site_url('admin/experience'); ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/experience/save/' . (isset($item) ? $item->id : '')); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role / Job Title</label>
                        <input type="text" name="role" class="form-control" value="<?php echo isset($item) ? $item->role : ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Company</label>
                        <input type="text" name="company" class="form-control" value="<?php echo isset($item) ? $item->company : ''; ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="text" name="start_date" class="form-control" value="<?php echo isset($item) ? $item->start_date : ''; ?>" placeholder="e.g. Jan 2023">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Date</label>
                        <input type="text" name="end_date" class="form-control" value="<?php echo isset($item) ? $item->end_date : ''; ?>" placeholder="e.g. Present">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="<?php echo isset($item) ? $item->location : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description (Summary)</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo isset($item) ? $item->description : ''; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Highlights (Bullet points, one per line)</label>
                    <textarea name="highlights" class="form-control" rows="5"><?php 
                        if(isset($highlights) && !empty($highlights)) {
                            $highlight_texts = array_column($highlights, 'highlight');
                            echo implode("\n", $highlight_texts);
                        }
                    ?></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="featured" class="form-check-input" id="isFeatured" <?php echo (isset($item) && $item->featured) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="isFeatured">Featured Role?</label>
                </div>

                <button type="submit" class="btn btn-primary">Save Experience</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
