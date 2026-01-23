<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Projects</h2>
        <a href="<?php echo site_url('admin/projects/create'); ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
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
                            <th>Title</th>
                            <th>Description</th>
                            <th>Featured</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($projects)): ?>
                            <?php foreach($projects as $p): ?>
                                <tr>
                                    <td><?php echo $p->title; ?></td>
                                    <td><?php echo word_limiter($p->description, 10); ?></td>
                                    <td><?php echo ($p->featured) ? '<i class="fas fa-star text-warning"></i>' : '-'; ?></td>
                                    <td>
                                        <a href="<?php echo site_url('admin/projects/edit/'.$p->id); ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-edit"></i></a>
                                        <a href="<?php echo site_url('admin/projects/delete/'.$p->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No projects found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
