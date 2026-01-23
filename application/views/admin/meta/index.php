<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Meta & Navigation</h2>
    </div>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <div class="row">
        <!-- Global Meta Settings -->
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

        <!-- Navigation Links -->
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
                                <input type="number" name="sort_order" class="form-control" placeholder="Order" value="0" style="width: 70px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-3">Add Link</button>
                    <?php echo form_close(); ?>

                    <ul class="list-group">
                        <?php if(!empty($nav_links)): ?>
                            <?php foreach($nav_links as $link): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><?php echo $link->name; ?> <small class="text-muted">(<?php echo $link->href; ?>)</small></span>
                                    <span class="badge bg-secondary rounded-pill me-2"><?php echo $link->sort_order; ?></span>
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

        <!-- Social Links -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Social Links</div>
                <div class="card-body">
                    <?php echo form_open('admin/meta/add_social'); ?>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <input type="text" name="platform" class="form-control" placeholder="Platform" required>
                            </div>
                            <div class="col">
                                <input type="text" name="url" class="form-control" placeholder="URL" required>
                            </div>
                            <div class="col-auto">
                                <input type="number" name="sort_order" class="form-control" placeholder="Order" value="0" style="width: 70px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-3">Add Social Link</button>
                    <?php echo form_close(); ?>

                    <ul class="list-group">
                        <?php if(!empty($social_links)): ?>
                            <?php foreach($social_links as $link): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><strong><?php echo $link->platform; ?></strong></span>
                                    <div>
                                        <span class="badge bg-secondary rounded-pill me-2"><?php echo $link->sort_order; ?></span>
                                        <a href="<?php echo site_url('admin/meta/delete_social/'.$link->id); ?>" class="text-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Marquee Text -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">Marquee Text</div>
                <div class="card-body">
                    <?php echo form_open('admin/meta/add_marquee'); ?>
                        <div class="row g-2 mb-3">
                            <div class="col">
                                <input type="text" name="text" class="form-control" placeholder="Marquee Text (e.g. Frappe Developer)" required>
                            </div>
                            <div class="col-auto">
                                <input type="number" name="sort_order" class="form-control" placeholder="Order" value="0" style="width: 70px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm w-100 mb-3">Add Marquee Item</button>
                    <?php echo form_close(); ?>

                    <ul class="list-group">
                        <?php if(!empty($marquee)): ?>
                            <?php foreach($marquee as $m): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span><?php echo $m->text; ?></span>
                                    <div>
                                        <span class="badge bg-secondary rounded-pill me-2"><?php echo $m->sort_order; ?></span>
                                        <a href="<?php echo site_url('admin/meta/delete_marquee/'.$m->id); ?>" class="text-danger" onclick="return confirm('Delete?');"><i class="fas fa-trash"></i></a>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item text-muted">No marquee text added.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
