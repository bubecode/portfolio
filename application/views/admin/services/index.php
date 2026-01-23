<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Services</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Service</div>
                <div class="card-body">
                    <?php echo form_open('admin/services/add'); ?>
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon (e.g. fas fa-code)</label>
                            <input type="text" name="icon" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Service</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($services)): ?>
                                <?php foreach($services as $s): ?>
                                    <tr>
                                        <td><i class="<?php echo $s->icon; ?>"></i></td>
                                        <td><?php echo $s->title; ?></td>
                                        <td><?php echo $s->sort_order; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/services/edit/'.$s->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo site_url('admin/services/delete/'.$s->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center">No services found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
