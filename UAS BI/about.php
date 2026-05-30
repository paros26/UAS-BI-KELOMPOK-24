<?php 
    $pageTitle = "About Project";
    $activePage = "about";
    include 'includes/header.php';
    include 'includes/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-5">
            <h2 class="fw-bold text-dark">About This Project</h2>
            <p class="text-muted">Detail latar belakang, teknologi, dan metodologi yang digunakan dalam pengembangan aplikasi.</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3">Latar Belakang</h5>
                    <p class="text-muted">Proyek ini dikembangkan untuk menjawab tantangan dalam industri retail modern yang memiliki volume data transaksi sangat besar namun seringkali minim wawasan (insights). Dengan memanfaatkan dataset "Shopping Trends", aplikasi ini mengintegrasikan konsep Business Intelligence (BI) dan Decision Support System (DSS) untuk membantu pemilik bisnis mengambil keputusan strategis yang didasarkan pada data faktual, bukan sekadar intuisi.</p>
                </div>

                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-3">Tujuan Aplikasi</h5>
                    <ul class="text-muted">
                        <li class="mb-2">Memberikan visualisasi performa bisnis yang komprehensif melalui Executive Dashboard.</li>
                        <li class="mb-2">Menyediakan sistem pendukung keputusan (DSS) untuk rekomendasi produk yang personal bagi pelanggan.</li>
                        <li class="mb-2">Menganalisis pola perilaku pelanggan (customer segmentation) untuk optimasi strategi pemasaran.</li>
                        <li class="mb-2">Mengimplementasikan pengolahan data yang efisien melalui proses ETL & Analytical Data Preparation.</li>
                    </ul>
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-3">Metodologi Analytics</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-primary text-uppercase">1. Preprocessing</h6>
                            <p class="small text-muted">Data cleaning menggunakan Python/Pandas, penanganan outlier, dan feature engineering untuk menjamin kualitas data.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-primary text-uppercase">2. ETL & Architecture</h6>
                            <p class="small text-muted">Transformasi data menjadi format Single Table Analytical Schema karena dataset berasal dari satu sumber data utama.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-primary text-uppercase">3. Segmentation</h6>
                            <p class="small text-muted">Pengelompokan pelanggan otomatis berdasarkan Revenue Segment (High, Medium, Low) dan Purchase Frequency score.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold small text-primary text-uppercase">4. Recommendation</h6>
                            <p class="small text-muted">Sistem DSS menggunakan pembobotan berbasis Recommendation Score yang dihasilkan dari profil historis pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold mb-4">Teknologi & Tooling</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-3"><i class="bi bi-code-slash fs-5"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0">Python & Pandas</h6>
                            <p class="small text-muted mb-0">Data Processing & ETL</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-3"><i class="bi bi-database fs-5"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0">MySQL / SQL Server</h6>
                            <p class="small text-muted mb-0">Data Warehousing</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-3"><i class="bi bi-pie-chart fs-5"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0">Chart.js</h6>
                            <p class="small text-muted mb-0">Data Visualization</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-3"><i class="bi bi-bootstrap fs-5"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0">Bootstrap 5</h6>
                            <p class="small text-muted mb-0">Front-end Framework</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-2 me-3"><i class="bi bi-google fs-5"></i></div>
                        <div>
                            <h6 class="fw-bold mb-0">Google Colab</h6>
                            <p class="small text-muted mb-0">Development & Analysis</p>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-4 bg-light">
                    <h6 class="fw-bold mb-3">Dataset Info</h6>
                    <div class="small text-muted">
                        <p class="mb-2"><strong>Name:</strong> Consumer Shopping Trends</p>
                        <p class="mb-2"><strong>Rows:</strong> 3,900</p>
                        <p class="mb-0"><strong>Attributes:</strong> 18 columns including Gender, Item, Category, Location, Season, Rating, and more.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
