<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Marquee Text</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMarqueeModal">
            <i class="fas fa-plus"></i> Add New Text
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
                            <th>Text Content</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($marquee)): ?>
                            <?php foreach($marquee as $m): ?>
                                <tr>
                                    <td><?php echo $m->text; ?></td>
                                    <td><?php echo $m->sort_order; ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info text-white edit-btn" 
                                                data-id="<?php echo $m->id; ?>"
                                                data-text="<?php echo $m->text; ?>"
                                                data-sort="<?php echo $m->sort_order; ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#addMarqueeModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?php echo site_url('admin/marquee/delete/'.$m->id); ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Delete this marquee text?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="3" class="text-center">No marquee text found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMarqueeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Marquee Text</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?php echo form_open('admin/marquee/save', ['id' => 'marqueeForm']); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Marquee Text</label>
                        <input type="text" name="text" id="marqueeText" class="form-control" placeholder="e.g. ERP Systems Expert" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" id="marqueeSort" class="form-control" value="0">
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
        document.getElementById('modalTitle').innerText = 'Edit Marquee Text';
        document.getElementById('marqueeForm').action = '<?php echo site_url('admin/marquee/save/'); ?>' + id;
        document.getElementById('marqueeText').value = this.getAttribute('data-text');
        document.getElementById('marqueeSort').value = this.getAttribute('data-sort');
    });
});

document.getElementById('addMarqueeModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalTitle').innerText = 'Add Marquee Text';
    document.getElementById('marqueeForm').action = '<?php echo site_url('admin/marquee/save'); ?>';
    document.getElementById('marqueeForm').reset();
});
</script>
