<?php 
    $pageTitle = "Executive Dashboard";
    $activePage = "dashboard";
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/data_helper.php';

    $dh = new DataHelper();
    
    // Capture Filters
    $filters = [
        'gender' => $_GET['gender'] ?? '',
        'category' => $_GET['category'] ?? '',
        'season' => $_GET['season'] ?? '',
        'payment_method' => $_GET['payment_method'] ?? ''
    ];
    $dh->applyFilters($filters);

    $kpis = $dh->getKPIs();
    $recentTrx = $dh->getRecentTransactions(8);
    $catDist = $dh->getCategoryDistribution();
    $genderDist = $dh->getGenderDistribution();
    $ageDist = $dh->getAgeDistribution();
    $paymentDist = $dh->getPaymentDistribution();
    $freqDist = $dh->getFrequencyDistribution();

    // Get dynamic filter options from raw data (before filtering)
    $rawDH = new DataHelper();
    $allData = $rawDH->getData();
    $categories = array_unique(array_column($allData, 'category'));
    sort($categories);
    $seasons = array_unique(array_column($allData, 'season'));
    sort($seasons);
    $payments = array_unique(array_column($allData, 'payment_method'));
    sort($payments);
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold text-dark">Executive Analytics Dashboard</h2>
                <p class="text-muted">Business Intelligence & DSS untuk memantau performa retail secara komprehensif.</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-white bg-white shadow-sm border-0 px-3"><i class="bi bi-calendar-event me-2"></i> Last 30 Days</button>
                <button class="btn btn-primary shadow-sm"><i class="bi bi-download me-2"></i> Export Report</button>
            </div>
        </div>

        <?php if (empty($dh->getData())): ?>
        <div class="alert alert-warning border-0 shadow-sm mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Database Kosong atau Tabel Tidak Ditemukan!</strong> Silakan pastikan Anda telah menjalankan <code>database.sql</code> dan melakukan <a href="migrate_data.php" class="fw-bold">Migrasi Data</a> untuk mengisi tabel <code>shopping_trends</code>.
        </div>
        <?php endif; ?>

        <!-- KPI Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card kpi-card">
                    <div class="kpi-label">Total Pelanggan</div>
                    <div class="d-flex align-items-end">
                        <div class="kpi-value"><?php echo $kpis['total_customers']; ?></div>
                        <div class="ms-auto text-success small fw-bold mb-2"><i class="bi bi-arrow-up"></i> 12%</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card" style="border-left-color: #10B981;">
                    <div class="kpi-label">Total Revenue</div>
                    <div class="d-flex align-items-end">
                        <div class="kpi-value"><?php echo $kpis['total_revenue']; ?></div>
                        <div class="ms-auto text-success small fw-bold mb-2"><i class="bi bi-arrow-up"></i> 8.4%</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card" style="border-left-color: #F59E0B;">
                    <div class="kpi-label">Rating Rata-rata</div>
                    <div class="d-flex align-items-end">
                        <div class="kpi-value"><?php echo $kpis['avg_rating']; ?></div>
                        <div class="ms-auto text-muted small mb-2">/ 5.0</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card kpi-card" style="border-left-color: #8B5CF6;">
                    <div class="kpi-label">Total Transaksi</div>
                    <div class="d-flex align-items-end">
                        <div class="kpi-value"><?php echo $kpis['total_transactions']; ?></div>
                        <div class="ms-auto text-muted small mb-2">Orders</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Row -->
        <div class="card border-0 shadow-sm p-3 mb-4">
            <form method="GET" class="row g-3 align-items-center">
                <div class="col-md-auto">
                    <span class="fw-bold text-muted small text-uppercase">Filter Data:</span>
                </div>
                <div class="col-md-2">
                    <select name="gender" class="form-select form-select-sm border-light bg-light">
                        <option value="">Semua Gender</option>
                        <option value="Male" <?php echo ($filters['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($filters['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select form-select-sm border-light bg-light">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo ($filters['category'] == $cat) ? 'selected' : ''; ?>><?php echo $cat; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="season" class="form-select form-select-sm border-light bg-light">
                        <option value="">Semua Season</option>
                        <?php foreach ($seasons as $s): ?>
                        <option value="<?php echo $s; ?>" <?php echo ($filters['season'] == $s) ? 'selected' : ''; ?>><?php echo $s; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="payment_method" class="form-select form-select-sm border-light bg-light">
                        <option value="">Metode Bayar</option>
                        <?php foreach ($payments as $p): ?>
                        <option value="<?php echo $p; ?>" <?php echo ($filters['payment_method'] == $p) ? 'selected' : ''; ?>><?php echo $p; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-auto ms-auto d-flex gap-2">
                    <a href="dashboard.php" class="btn btn-sm btn-light px-3">Reset</a>
                    <button type="submit" class="btn btn-sm btn-outline-primary px-3">Terapkan Filter</button>
                </div>
            </form>
        </div>

        <!-- Charts Row 1 -->
        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Revenue berdasarkan Kategori</h5>
                            <i class="bi bi-three-dots text-muted"></i>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Pembelian by Gender</h5>
                            <i class="bi bi-three-dots text-muted"></i>
                        </div>
                        <div style="height: 300px;">
                            <canvas id="genderChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Distribusi Umur Pelanggan</h5>
                        <div style="height: 250px;">
                            <canvas id="ageDistChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Payment Methods</h5>
                        <div style="height: 250px;">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Purchase Frequency</h5>
                        <div style="height: 250px;">
                            <canvas id="frequencyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Table -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Transaksi Pelanggan Terbaru</h5>
                    <a href="manage_data.php?all=1" class="btn btn-sm btn-link text-decoration-none">Lihat Semua <i class="bi bi-chevron-right small"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0">ID</th>
                                <th class="border-0">Pelanggan</th>
                                <th class="border-0">Segment</th>
                                <th class="border-0">Item</th>
                                <th class="border-0">Kategori</th>
                                <th class="border-0">Amount</th>
                                <th class="border-0">Rating</th>
                            </tr>
                        </thead>
                        <tbody class="small">
                            <?php foreach ($recentTrx as $trx): ?>
                            <tr>
                                <td>#<?php echo str_pad($trx['customer_id'], 4, '0', STR_PAD_LEFT); ?></td>
                                <td>
                                    <div class="fw-bold">Customer <?php echo $trx['customer_id']; ?></div>
                                    <span class="text-muted" style="font-size: 0.7rem;"><?php echo $trx['gender']; ?>, <?php echo $trx['age']; ?> y.o</span>
                                </td>
                                <td><span class="badge bg-info-subtle text-info"><?php echo $trx['customer_segment'] ?? 'Regular'; ?></span></td>
                                <td><?php echo $trx['item_purchased']; ?></td>
                                <td><?php echo $trx['category']; ?></td>
                                <td class="fw-bold">$<?php echo number_format($trx['purchase_amount_usd'], 2); ?></td>
                                <td><span class="text-warning"><i class="bi bi-star-fill"></i> <?php echo $trx['review_rating']; ?></span></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Data for Charts
    const catDist = <?php echo json_encode($catDist); ?>;
    const genderDist = <?php echo json_encode($genderDist); ?>;
    const ageDist = <?php echo json_encode($ageDist); ?>;
    const paymentDist = <?php echo json_encode($paymentDist); ?>;
    const freqDist = <?php echo json_encode($freqDist); ?>;
</script>
<script src="assets/js/dashboard.js"></script>

<?php include 'includes/footer.php'; ?>
