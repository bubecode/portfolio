<div class="content">
    <div class="mb-4">
        <h2 class="h3 mb-0 text-gray-800">Dashboard Overview</h2>
    </div>
    
    <div class="alert alert-light border-0 shadow-sm mb-4">
        <i class="fas fa-info-circle text-primary me-2"></i> Welcome back! Use the sidebar to manage your portfolio content.
    </div>
    
    <div class="row g-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100 border-start border-4 border-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Projects</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <?php echo $this->db->count_all('projects'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-project-diagram fa-2x text-gray-300 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100 border-start border-4 border-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Skills</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <?php echo $this->db->count_all('skills'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-code fa-2x text-gray-300 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100 border-start border-4 border-info">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Experience</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <?php echo $this->db->count_all('experience'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card h-100 border-start border-4 border-warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Services</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">
                                <?php echo $this->db->count_all('services'); ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-concierge-bell fa-2x text-gray-300 text-muted opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
