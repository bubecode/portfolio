<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Awards</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add Award</div>
                <div class="card-body">
                    <?php echo form_open('admin/awards/add'); ?>
                        <div class="mb-3">
                            <label class="form-label">Award Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Organization</label>
                            <input type="text" name="organization" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <input type="text" name="year" class="form-control" placeholder="e.g. 2023">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="set_order" class="form-control" value="0">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Add Award</button>
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
                                <th>Title</th>
                                <th>Organization</th>
                                <th>Year</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($awards)): ?>
                                <?php foreach($awards as $a): ?>
                                    <tr>
                                        <td><?php echo $a->title; ?></td>
                                        <td><?php echo $a->organization; ?></td>
                                        <td><?php echo $a->year; ?></td>
                                        <td><?php echo $a->set_order; ?></td>
                                        <td>
                                            <a href="<?php echo site_url('admin/awards/edit/'.$a->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                            <a href="<?php echo site_url('admin/awards/delete/'.$a->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center">No awards found.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
