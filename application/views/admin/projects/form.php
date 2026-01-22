<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?php echo isset($project) ? 'Edit Project' : 'Add New Project'; ?></h2>
        <a href="<?php echo site_url('admin/projects'); ?>" class="btn btn-secondary">Back</a>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('admin/projects/save/' . (isset($project) ? $project->id : '')); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo isset($project) ? $project->name : ''; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon Class (e.g. fas fa-code)</label>
                        <input type="text" name="icon" class="form-control" value="<?php echo isset($project) ? $project->icon : ''; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?php echo isset($project) ? $project->description : ''; ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Impact Line</label>
                    <input type="text" name="impact_line" class="form-control" value="<?php echo isset($project) ? $project->impact_line : ''; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tech Stack (Comma separated)</label>
                    <input type="text" name="tech_stack" class="form-control" value="<?php 
                        if(isset($project) && $project->tech_stack_json) {
                            $stack = json_decode($project->tech_stack_json, true) ?: [];
                            echo implode(', ', $stack);
                        }
                    ?>">
                    <div class="form-text">Example: PHP, CodeIgniter, MySQL, Bootstrap</div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" <?php echo (isset($project) && $project->is_featured) ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="isFeatured">Mark as Featured Project</label>
                </div>

                <button type="submit" class="btn btn-primary">Save Project</button>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
