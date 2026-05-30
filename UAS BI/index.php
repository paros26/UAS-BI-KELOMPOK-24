<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSS Produk Rekomendasi | Business Intelligence</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <i class="bi bi-bar-chart-fill text-primary me-2 fs-3"></i>
                <span class="text-dark">Retail</span><span class="text-primary">Analytics</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-medium">
                    <li class="nav-item mx-2"><a class="nav-link active" href="index.php">Beranda</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="recommendation.php">Rekomendasi</a></li>
                    <li class="nav-item mx-2"><a class="nav-link btn btn-primary text-white ms-3 px-4" href="dashboard.php">Mulai Analisis</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="hero-title mb-3">
                        Aplikasi Rekomendasi Produk Berdasarkan Pola Pembelian Pelanggan (DSS)
                    </h1>
                    <p class="hero-subtitle mb-4">
                        Platform Business Intelligence dan Decision Support System modern untuk mengoptimalkan strategi retail melalui analisis perilaku pelanggan dan sistem rekomendasi berbasis data.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="dashboard.php" class="btn btn-primary btn-lg px-5">Mulai Analisis <i class="bi bi-arrow-right ms-2"></i></a>
                        <a href="about.php" class="btn btn-outline-secondary btn-lg px-4">Tentang Project</a>
                    </div>
                    
                    <div class="mt-5 pt-4">
                        <div class="row g-4">
                            <div class="col-6 col-md-3">
                                <div class="stats-item">
                                    <h3 class="fw-bold text-dark mb-0">3.900+</h3>
                                    <p class="text-muted small mb-0">Total Pelanggan</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stats-item">
                                    <h3 class="fw-bold text-dark mb-0">$233K</h3>
                                    <p class="text-muted small mb-0">Total Revenue</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stats-item">
                                    <h3 class="fw-bold text-dark mb-0">25</h3>
                                    <p class="text-muted small mb-0">Kategori Produk</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="stats-item">
                                    <h3 class="fw-bold text-dark mb-0">4.7/5</h3>
                                    <p class="text-muted small mb-0">Avg. Rating</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <img src="https://img.freepik.com/free-vector/data-extraction-concept-illustration_114360-4766.jpg" alt="Analytics Hero" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <div class="text-center mb-5">
                <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-3">FITUR UTAMA</span>
                <h2 class="fw-bold">Decision Support & Business Intelligence</h2>
                <p class="text-muted mx-auto" style="max-width: 600px;">Optimalkan keputusan bisnis Anda dengan rangkaian alat analisis data canggih yang dirancang khusus untuk industri retail.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 p-4 shadow-sm border-0">
                        <div class="icon-box mb-4 bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3">
                            <i class="bi bi-speedometer2 text-primary fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Executive Dashboard</h4>
                        <p class="text-muted">Visualisasi KPI real-time untuk memantau performa penjualan, tren kategori, dan profil pelanggan secara komprehensif.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 p-4 shadow-sm border-0">
                        <div class="icon-box mb-4 bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3">
                            <i class="bi bi-magic text-primary fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Product Recommendation</h4>
                        <p class="text-muted">Sistem pendukung keputusan yang memberikan rekomendasi produk akurat berdasarkan pola pembelian dan preferensi pelanggan.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 p-4 shadow-sm border-0">
                        <div class="icon-box mb-4 bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3">
                            <i class="bi bi-diagram-3 text-primary fs-3"></i>
                        </div>
                        <h4 class="fw-bold">Purchase Analytics</h4>
                        <p class="text-muted">Analisis mendalam terhadap perilaku pelanggan, segmentasi pasar, dan pola loyalitas untuk strategi pemasaran yang tepat sasaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="bi bi-bar-chart-fill text-primary me-2"></i> RetailAnalytics
                    </h5>
                    <p class="text-secondary small">Project Business Intelligence & Decision Support System (DSS) untuk analisis pola pembelian pelanggan di industri retail.</p>
                </div>
                <div class="col-lg-2 offset-lg-2 col-md-4 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><a href="dashboard.php" class="text-decoration-none text-secondary">Dashboard BI</a></li>
                        <li class="mb-2"><a href="recommendation.php" class="text-decoration-none text-secondary">Rekomendasi DSS</a></li>
                        <li class="mb-2"><a href="analysis.php" class="text-decoration-none text-secondary">Analisis Pola</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <h6 class="fw-bold mb-3">Teknis</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2"><a href="etl.php" class="text-decoration-none text-secondary">ETL Process</a></li>
                        <li class="mb-2"><a href="insights.php" class="text-decoration-none text-secondary">Business Insights</a></li>
                        <li class="mb-2"><a href="about.php" class="text-decoration-none text-secondary">Tentang Project</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h6 class="fw-bold mb-3">Teknologi</h6>
                    <ul class="list-unstyled small text-secondary">
                        <li class="mb-2">Python & Pandas</li>
                        <li class="mb-2">MySQL / DWH</li>
                        <li class="mb-2">Chart.js</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary opacity-25">
            <div class="text-center text-secondary small">
                &copy; 2026 Aplikasi DSS Rekomendasi Produk. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
