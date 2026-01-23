<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Experience</h2>
        <a href="<?php echo site_url('admin/experience/create'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Role</th>
                            <th>Company</th>
                            <th>Duration</th>
                            <th>Featured</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($experience)): ?>
                            <?php foreach($experience as $exp): ?>
                                <tr>
                                    <td><?php echo $exp->role; ?></td>
                                    <td><?php echo $exp->company; ?></td>
                                    <td><?php echo $exp->start_date . ' - ' . $exp->end_date; ?></td>
                                    <td><?php echo ($exp->featured) ? '<i class="fas fa-star text-warning"></i>' : '-'; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/experience/edit/'.$exp->id); ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo site_url('admin/experience/delete/'.$exp->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center">No experience records found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
