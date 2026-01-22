<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Meta & Navigation</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Global Meta Settings</div>
                <div class="card-body">
                    <?php echo form_open('admin/meta/update'); ?>
                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control" value="<?php echo isset($meta->brand_name) ? $meta->brand_name : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Copyright Year</label>
                            <input type="text" name="copyright_year" class="form-control" value="<?php echo isset($meta->copyright_year) ? $meta->copyright_year : date('Y'); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Meta</button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Navigation Links</div>
                <div class="card-body">
                    <?php echo form_open('admin/meta/add_nav'); ?>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Label (e.g. Home)" required>
                            </div>
                            <div class="col">
                                <input type="text" name="href" class="form-control" placeholder="Link (e.g. #home)" required>
                            </div>
                            <div class="col-auto">
                                <input type="number" name="order_index" class="form-control" placeholder="Order" value="0" style="width: 70px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-3">Add Link</button>
                    <?php echo form_close(); ?>

                    <ul class="list-group">
                        <?php if(!empty($nav_links)): ?>
                            <?php foreach($nav_links as $link): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><?php echo $link->name; ?> <small class="text-muted">(<?php echo $link->href; ?>)</small></span>
                                    <span class="badge bg-secondary rounded-pill me-2"><?php echo $link->order_index; ?></span>
                                    <a href="<?php echo site_url('admin/meta/delete_nav/'.$link->id); ?>" class="text-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted">No navigation links.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
