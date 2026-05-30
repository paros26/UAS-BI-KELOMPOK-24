<?php 
    $pageTitle = "Product Recommendation DSS";
    $activePage = "recommendation";
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/data_helper.php';

    $dh = new DataHelper();
    
    // Get distinct values for filters
    $allData = $dh->getData();
    $categories = array_unique(array_column($allData, 'category'));
    $seasons = array_unique(array_column($allData, 'season'));
    $frequencies = array_unique(array_column($allData, 'frequency_of_purchases'));

    // Handle Recommendations
    $filters = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $filters = [
            'gender' => $_POST['gender'] ?? '',
            'category' => $_POST['category'] ?? '',
            'season' => $_POST['season'] ?? ''
        ];
    }
    
    $recommendations = $dh->getRecommendations($filters);
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Product Recommendation System</h2>
            <p class="text-muted">Decision Support System (DSS) untuk merekomendasikan produk berdasarkan preferensi dan pola pembelian.</p>
        </div>

        <div class="row g-4">
            <!-- Filter/Form Section -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Input Preferensi Pelanggan</h5>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Gender</label>
                                <select name="gender" class="form-select border-light bg-light">
                                    <option value="">Pilih Gender</option>
                                    <option value="Male" <?php echo (isset($filters['gender']) && $filters['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="Female" <?php echo (isset($filters['gender']) && $filters['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Kategori Favorit</label>
                                <select name="category" class="form-select border-light bg-light">
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat; ?>" <?php echo (isset($filters['category']) && $filters['category'] == $cat) ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Season Saat Ini</label>
                                <select name="season" class="form-select border-light bg-light">
                                    <option value="">Pilih Season</option>
                                    <?php foreach ($seasons as $s): ?>
                                    <option value="<?php echo $s; ?>" <?php echo (isset($filters['season']) && $filters['season'] == $s) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Budget Range</label>
                                <input type="range" class="form-range" min="10" max="100" step="10" value="50">
                                <div class="d-flex justify-content-between small text-muted">
                                    <span>$10</span>
                                    <span>$100</span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Dapatkan Rekomendasi <i class="bi bi-stars ms-2"></i></button>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm mt-4 bg-primary text-white">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-2">DSS Insight</h6>
                        <p class="small mb-0 opacity-75">Sistem menggunakan algoritma pembobotan (weighting) berdasarkan kesesuaian profil pelanggan dengan tren transaksi historis di dataset.</p>
                    </div>
                </div>
            </div>

            <!-- Recommendations Result -->
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Rekomendasi Untuk Anda</h5>
                    <span class="small text-muted">Ditemukan <?php echo count($recommendations); ?> produk yang sesuai</span>
                </div>

                <div class="row g-4">
                    <?php if (empty($recommendations)): ?>
                    <div class="col-12">
                        <div class="card border-0 shadow-sm p-5 text-center">
                            <i class="bi bi-search fs-1 text-muted mb-3"></i>
                            <h5 class="text-muted">Silakan isi form untuk mendapatkan rekomendasi</h5>
                        </div>
                    </div>
                    <?php else: ?>
                    <?php foreach ($recommendations as $rec): ?>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm recommend-card">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="badge bg-primary-subtle text-primary mb-2 text-uppercase"><?php echo $rec['category']; ?></span>
                                        <h5 class="fw-bold mb-1"><?php echo $rec['item_purchased']; ?></h5>
                                    </div>
                                    <div class="score-badge"><?php echo $rec['match_score']; ?>% Match</div>
                                </div>
                                <p class="text-muted small mb-4">Produk ini sering dibeli oleh pelanggan <?php echo $rec['gender']; ?> selama musim <?php echo $rec['season']; ?> dengan rating kepuasan yang tinggi.</p>
                                <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                    <span class="fw-bold text-primary fs-5">$<?php echo number_format($rec['purchase_amount_usd'], 2); ?></span>
                                    <button class="btn btn-sm btn-outline-primary px-3">Lihat Detail</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <div class="mt-4 p-4 rounded-3 border-0 shadow-sm bg-white">
                    <h6 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i> Mengapa Rekomendasi Ini?</h6>
                    <div class="row g-3 small">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Segmentasi Loyalitas</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Tren Kategori Musiman</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check2-circle text-success me-2"></i>
                                <span>Analisis Rating Global</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
