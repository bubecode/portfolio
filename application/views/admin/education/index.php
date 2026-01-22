<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Education</h2>
        <a href="<?php echo site_url('admin/education/create'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                            <th>Degree</th>
                            <th>Institution</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($education)): ?>
                            <?php foreach($education as $edu): ?>
                                <tr>
                                    <td><?php echo $edu->degree; ?> <small class="text-muted d-block"><?php echo $edu->field; ?></small></td>
                                    <td><?php echo $edu->institution; ?></td>
                                    <td><?php echo $edu->year; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/education/edit/'.$edu->id); ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo site_url('admin/education/delete/'.$edu->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No education records found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
