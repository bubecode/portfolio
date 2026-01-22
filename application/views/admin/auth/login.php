<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
</head>
<body class="login-page">

<div class="login-card">
    <div class="login-brand">
        <i class="fas fa-layer-group text-primary me-2"></i> Portfolio Admin
    </div>
    
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger mb-4"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <?php echo validation_errors('<div class="alert alert-danger mb-4">', '</div>'); ?>

    <?php echo form_open('admin/auth/login'); ?>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" required autofocus placeholder="admin@example.com">
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required placeholder="••••••••">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
        </div>
    <?php echo form_close(); ?>
</div>

</body>
</html>
