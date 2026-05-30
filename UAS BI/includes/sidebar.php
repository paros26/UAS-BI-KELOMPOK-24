<div class="sidebar d-none d-lg-block">
    <div class="mb-5">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <i class="bi bi-bar-chart-fill text-primary me-2 fs-3"></i>
            <span class="text-dark">Retail</span><span class="text-primary">BI</span>
        </a>
    </div>

    <div class="nav flex-column">
        <p class="text-muted small fw-bold text-uppercase mb-2" style="font-size: 0.7rem;">Main Menu</p>
        <a href="dashboard.php" class="nav-link <?php echo ($activePage == 'dashboard') ? 'active' : ''; ?>">
            <i class="bi bi-grid-1x2-fill"></i> Executive Dashboard
        </a>
        <a href="recommendation.php" class="nav-link <?php echo ($activePage == 'recommendation') ? 'active' : ''; ?>">
            <i class="bi bi-magic"></i> Product DSS
        </a>
        <a href="analysis.php" class="nav-link <?php echo ($activePage == 'analysis') ? 'active' : ''; ?>">
            <i class="bi bi-graph-up-arrow"></i> Purchase Patterns
        </a>
        <a href="insights.php" class="nav-link <?php echo ($activePage == 'insights') ? 'active' : ''; ?>">
            <i class="bi bi-lightbulb-fill"></i> BI Insights
        </a>
        <a href="manage_data.php" class="nav-link <?php echo ($activePage == 'manage_data') ? 'active' : ''; ?>">
            <i class="bi bi-pencil-square"></i> Manage Data
        </a>

        <p class="text-muted small fw-bold text-uppercase mt-4 mb-2" style="font-size: 0.7rem;">Technical</p>
        <a href="etl.php" class="nav-link <?php echo ($activePage == 'etl') ? 'active' : ''; ?>">
            <i class="bi bi-database-fill-gear"></i> ETL & Data Preparation
        </a>
        <a href="about.php" class="nav-link <?php echo ($activePage == 'about') ? 'active' : ''; ?>">
            <i class="bi bi-info-circle-fill"></i> About Project
        </a>
    </div>

    <div class="mt-auto pt-5">
        <div class="p-3 bg-light rounded-3">
            <div class="d-flex align-items-center mb-2">
                <div class="bg-primary rounded-circle me-2" style="width: 10px; height: 10px;"></div>
                <span class="small fw-bold">System Status</span>
            </div>
            <p class="small text-muted mb-0">Database Connected</p>
            <p class="small text-muted">Last Update: Today</p>
        </div>
    </div>
</div>

<!-- Mobile Toggle (Simplified) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white d-lg-none sticky-top shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">RetailBI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mobileNav">
            <ul class="navbar-nav py-3">
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="recommendation.php">Rekomendasi</a></li>
                <li class="nav-item"><a class="nav-link" href="analysis.php">Analisis</a></li>
                <li class="nav-item"><a class="nav-link" href="etl.php">ETL</a></li>
            </ul>
        </div>
    </div>
</nav>
