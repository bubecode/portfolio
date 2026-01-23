        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <span class="brand-text">PortfolioAdmin</span>
            </div>
            
            <div class="sidebar-content">
                <div class="sidebar-section-label">Core</div>
                <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>

                <div class="sidebar-section-label">Portfolio Content</div>
                <a href="<?php echo site_url('admin/profile'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'profile') ? 'active' : ''; ?>">
                    <i class="fas fa-user-circle"></i> Profile
                </a>
                <a href="<?php echo site_url('admin/about'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'about') ? 'active' : ''; ?>">
                    <i class="fas fa-address-card"></i> About
                </a>
                <a href="<?php echo site_url('admin/skills'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'skills') ? 'active' : ''; ?>">
                    <i class="fas fa-code"></i> Skills
                </a>
                <a href="<?php echo site_url('admin/projects'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'projects') ? 'active' : ''; ?>">
                    <i class="fas fa-layer-group"></i> Projects
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
                    <i class="fas fa-toolbox"></i> Services
                </a>

                <div class="sidebar-section-label">System</div>
                <a href="<?php echo site_url('admin/meta'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'meta') ? 'active' : ''; ?>">
                    <i class="fas fa-sliders-h"></i> General Settings
                </a>
                <a href="<?php echo site_url('admin/settings'); ?>" class="nav-link <?php echo ($this->uri->segment(2) == 'settings') ? 'active' : ''; ?>">
                    <i class="fas fa-shield-halved"></i> Account Security
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
                <div>
                    <h1 class="page-title"><?php echo isset($title) ? $title : 'Dashboard'; ?></h1>
                    <?php if(isset($subtitle)): ?>
                        <p class="page-subtitle"><?php echo $subtitle; ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="user-dropdown">
                    <a href="<?php echo site_url('admin/profile'); ?>" class="btn-topbar me-2">
                        <i class="fas fa-user-circle"></i> Profile
                    </a>
                    <a href="<?php echo site_url('admin/settings'); ?>" class="btn-topbar me-2">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <a href="<?php echo site_url('admin/auth/logout'); ?>" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </a>
                </div>
            </nav>
            
            <!-- Page Content -->
            <div class="main-content">
