<div class="content">
    <div class="mb-4">
        <h2 class="h3 mb-0 text-gray-800">Overview</h2>
    </div>
    
    <div class="row g-4">
        <!-- Projects Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card insight-card">
                <div>
                    <div class="insight-title">Total Projects</div>
                    <div class="insight-metric">
                        <?php echo $this->db->count_all('projects'); ?>
                    </div>
                    <div class="insight-context">
                        Showcased Work
                    </div>
                </div>
                <i class="fas fa-layer-group insight-icon"></i>
            </div>
        </div>

        <!-- Skills Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card insight-card">
                <div>
                    <div class="insight-title">Total Skills</div>
                    <div class="insight-metric">
                        <?php echo $this->db->count_all('skills'); ?>
                    </div>
                    <div class="insight-context">
                        Technical Competencies
                    </div>
                </div>
                <i class="fas fa-code insight-icon"></i>
            </div>
        </div>

        <!-- Experience Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card insight-card">
                <div>
                    <div class="insight-title">Experience Roles</div>
                    <div class="insight-metric">
                        <?php echo $this->db->count_all('experience'); ?>
                    </div>
                    <div class="insight-context">
                        Career History
                    </div>
                </div>
                <i class="fas fa-briefcase insight-icon"></i>
            </div>
        </div>

        <!-- Services Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card insight-card">
                <div>
                    <div class="insight-title">Active Services</div>
                    <div class="insight-metric">
                        <?php echo $this->db->count_all('services'); ?>
                    </div>
                    <div class="insight-context">
                        Client Offerings
                    </div>
                </div>
                <i class="fas fa-toolbox insight-icon"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions / Empty State Example -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title mb-3" style="font-size: 16px; font-weight: 600;">System Status</h5>
            <p class="text-muted mb-0">
                <i class="fas fa-check-circle text-success me-2"></i> All systems operational. Portfolio API is online.
            </p>
        </div>
    </div>
</div>
