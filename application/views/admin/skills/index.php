<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Skills</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add New Skill</div>
                <div class="card-body">
                    <?php echo form_open('admin/skills/add'); ?>
                        <div class="mb-3">
                            <label class="form-label">Skill Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-control">
                                <?php foreach($categories as $category): ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_primary" class="form-check-input" id="isPrimary">
                            <label class="form-check-label" for="isPrimary">Is Primary Skill?</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Skill</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Skills</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Primary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($skills)): ?>
                                    <?php foreach($skills as $skill): ?>
                                        <tr>
                                            <td><?php echo $skill->name; ?></td>
                                            <td><span class="badge bg-secondary"><?php echo ucfirst($skill->category_name); ?></span></td>
                                            <td><?php echo ($skill->is_primary) ? '<i class="fas fa-check text-success"></i>' : '-'; ?></td>
                                            <td>
                                                <a href="<?php echo site_url('admin/skills/delete/'.$skill->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center">No skills added yet.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
