<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Testimonials</h2>
        <a href="<?php echo site_url('admin/testimonials/add'); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> Add Testimonial
        </a>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Person</th>
                            <th>Company</th>
                            <th>Product</th>
                            <th class="text-center">Rating</th>
                            <th class="text-center">Featured</th>
                            <th class="text-center">Status</th>
                            <th class="text-center pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($testimonials)): ?>
                            <?php foreach($testimonials as $item): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <?php if($item->person_image): ?>
                                                    <img src="<?php echo base_url($item->person_image); ?>" alt="" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                                <?php else: ?>
                                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                <?php ?><?php endif; ?>
                                            </div>
                                            <div>
                                                <div class="fw-bold"><?php echo $item->person_name; ?></div>
                                                <small class="text-muted"><?php echo $item->person_role; ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <?php if($item->company_logo): ?>
                                                <img src="<?php echo base_url($item->company_logo); ?>" alt="" class="me-2 rounded shadow-sm" style="height: 20px; max-width: 40px; object-fit: contain;">
                                            <?php endif; ?>
                                            <span><?php echo $item->company_name; ?></span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border"><?php echo $item->product_used; ?></span></td>
                                    <td class="text-center">
                                        <div class="text-warning">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <i class="<?php echo ($i <= $item->rating) ? 'fas' : 'far'; ?> fa-star small"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if($item->is_featured): ?>
                                            <span class="badge bg-success-subtle text-success px-2 py-1">
                                                <i class="fas fa-check-circle me-1"></i> Featured
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($item->status == 'active'): ?>
                                            <span class="badge bg-primary px-3">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary px-3">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?php echo site_url('admin/testimonials/edit/'.$item->id); ?>" class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo site_url('admin/testimonials/delete/'.$item->id); ?>" class="btn btn-outline-danger" title="Delete" onclick="return confirm('Archive this testimonial?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3"><i class="far fa-comments fa-3x text-light"></i></div>
                                    <p class="text-muted">No testimonials found yet.</p>
                                    <a href="<?php echo site_url('admin/testimonials/add'); ?>" class="btn btn-sm btn-primary">Add first one</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
