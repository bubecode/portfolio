        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-layer-group me-2"></i> Portfolio<span class="fw-light ms-1">Admin</span>
            </div>
            
            <div class="sidebar-nav">
                <div class="sidebar-label">Core</div>
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>

                <div class="sidebar-label mt-3">Content Management</div>
                <a href="<?php echo site_url('admin/profile'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="<?php echo site_url('admin/about'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'about') ? 'active' : ''; ?>">
                    <i class="fas fa-info-circle"></i> About
                </a>
                <a href="<?php echo site_url('admin/skills'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'skills') ? 'active' : ''; ?>">
                    <i class="fas fa-code"></i> Skills
                </a>
                <a href="<?php echo site_url('admin/projects'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'projects') ? 'active' : ''; ?>">
                    <i class="fas fa-project-diagram"></i> Projects
                </a>
                <a href="<?php echo site_url('admin/experience'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'experience') ? 'active' : ''; ?>">
                    <i class="fas fa-briefcase"></i> Experience
                </a>
                <a href="<?php echo site_url('admin/education'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'education') ? 'active' : ''; ?>">
                    <i class="fas fa-graduation-cap"></i> Education
                </a>
                <a href="<?php echo site_url('admin/awards'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'awards') ? 'active' : ''; ?>">
                    <i class="fas fa-trophy"></i> Awards
                </a>
                <a href="<?php echo site_url('admin/services'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'services') ? 'active' : ''; ?>">
                    <i class="fas fa-concierge-bell"></i> Services
                </a>

                <div class="sidebar-label mt-3">Settings</div>
                <a href="<?php echo site_url('admin/meta'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'meta') ? 'active' : ''; ?>">
                    <i class="fas fa-cog"></i> Meta & Nav
                </a>
            </div>
            
            <div class="sidebar-footer">
                <small class="text-muted d-block">Logged in as</small>
                <div class="text-white small text-truncate"><?php echo $this->session->userdata('email') ?: 'Admin'; ?></div>
            </div>
        </nav>

        <!-- Main Content Wrapper -->
        <div id="content" class="flex-grow-1 d-flex flex-column">
            <!-- Topbar (Now inside main content) -->
            <nav class="topbar">
                <h1 class="page-title"><?php echo isset($title) ? $title : 'Dashboard'; ?></h1>
                
                <div class="user-dropdown">
                    <a href="<?php echo site_url('admin/auth/logout'); ?>" class="btn btn-sm text-danger">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="p-4 flex-grow-1">
