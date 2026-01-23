<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Navigation Links</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLinkModal">
            <i class="fas fa-plus"></i> Add New Link
        </button>
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
                            <th>Name</th>
                            <th>HREF</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($nav_links)): ?>
                            <?php foreach($nav_links as $link): ?>
                                <tr>
                                    <td><?php echo $link->name; ?></td>
                                    <td><code><?php echo $link->href; ?></code></td>
                                    <td><?php echo $link->sort_order; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white edit-btn" 
                                                data-id="<?php echo $link->id; ?>"
                                                data-name="<?php echo $link->name; ?>"
                                                data-href="<?php echo $link->href; ?>"
                                                data-sort="<?php echo $link->sort_order; ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#addLinkModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?php echo site_url('admin/navlinks/delete/'.$link->id); ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Delete this link?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center">No links found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addLinkModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Navigation Link</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?php echo form_open('admin/navlinks/save', ['id' => 'linkForm']); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Link Name</label>
                        <input type="text" name="name" id="linkName" class="form-control" placeholder="e.g. About" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">HREF (URL or Anchor)</label>
                        <input type="text" name="href" id="linkHref" class="form-control" placeholder="e.g. #about or /blog" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" id="linkSort" class="form-control" value="0">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        document.getElementById('modalTitle').innerText = 'Edit Navigation Link';
        document.getElementById('linkForm').action = '<?php echo site_url('admin/navlinks/save/'); ?>' + id;
        document.getElementById('linkName').value = this.getAttribute('data-name');
        document.getElementById('linkHref').value = this.getAttribute('data-href');
        document.getElementById('linkSort').value = this.getAttribute('data-sort');
    });
});

document.getElementById('addLinkModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalTitle').innerText = 'Add Navigation Link';
    document.getElementById('linkForm').action = '<?php echo site_url('admin/navlinks/save'); ?>';
    document.getElementById('linkForm').reset();
});
</script>
