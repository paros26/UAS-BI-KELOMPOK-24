<?php 
    $pageTitle = "Purchase Pattern Analysis";
    $activePage = "analysis";
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/data_helper.php';

    $dh = new DataHelper();
    $segments = $dh->getRevenueSegmentation();
    $total = array_sum($segments);
    
    $highPct = $total > 0 ? round(($segments['High'] / $total) * 100) : 0;
    $medPct = $total > 0 ? round(($segments['Medium'] / $total) * 100) : 0;
    $lowPct = $total > 0 ? round(($segments['Low'] / $total) * 100) : 0;

    $repeatDist = $dh->getRepeatPurchaseDistribution();
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Customer Purchase Patterns</h2>
            <p class="text-muted">Analisis mendalam terhadap perilaku belanja, loyalitas, dan segmentasi pelanggan.</p>
        </div>

        <!-- Segmentation Row -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="mb-3"><span class="badge bg-success-subtle text-success px-3 py-2">HIGH REVENUE</span></div>
                    <h3 class="fw-bold mb-1"><?php echo number_format($segments['High']); ?></h3>
                    <p class="text-muted small">Pelanggan dengan spending > $70 per transaksi.</p>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: <?php echo $highPct; ?>%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="mb-3"><span class="badge bg-primary-subtle text-primary px-3 py-2">MEDIUM REVENUE</span></div>
                    <h3 class="fw-bold mb-1"><?php echo number_format($segments['Medium']); ?></h3>
                    <p class="text-muted small">Pelanggan dengan spending $30 - $70 per transaksi.</p>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: <?php echo $medPct; ?>%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="mb-3"><span class="badge bg-warning-subtle text-warning px-3 py-2">LOW REVENUE</span></div>
                    <h3 class="fw-bold mb-1"><?php echo number_format($segments['Low']); ?></h3>
                    <p class="text-muted small">Pelanggan dengan spending < $30 per transaksi.</p>
                    <div class="progress mt-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: <?php echo $lowPct; ?>%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <!-- Loyalty Analysis -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Repeat Purchase Trends</h5>
                        <div style="height: 300px;">
                            <canvas id="repeatPurchaseChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Business Insights -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Customer Loyalty Insights</h5>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small fw-medium">Subscription Rate</span>
                                <span class="small fw-bold">27%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-primary" style="width: 27%"></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="small fw-medium">Discount Utilization</span>
                                <span class="small fw-bold">43%</span>
                            </div>
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: 43%"></div>
                            </div>
                        </div>
                        
                        <div class="bg-light p-3 rounded-3 mt-4">
                            <h6 class="fw-bold small mb-2"><i class="bi bi-lightbulb text-primary me-2"></i> Key Finding:</h6>
                            <p class="small text-muted mb-0">Pelanggan di lokasi 'Montana' dan 'California' memiliki frekuensi pembelian 'Weekly' tertinggi, terutama pada kategori 'Clothing'.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchasing Heatmap (Simulated) -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Purchase Intent Heatmap: Category vs Season</h5>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle small mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Category \ Season</th>
                                <th>Spring</th>
                                <th>Summer</th>
                                <th>Fall</th>
                                <th>Winter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-start">Clothing</td>
                                <td style="background-color: rgba(59, 130, 246, 0.6);">High</td>
                                <td style="background-color: rgba(59, 130, 246, 0.9); color: white;">Critical</td>
                                <td style="background-color: rgba(59, 130, 246, 0.7); color: white;">Very High</td>
                                <td style="background-color: rgba(59, 130, 246, 0.5);">Medium</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-start">Accessories</td>
                                <td style="background-color: rgba(59, 130, 246, 0.4);">Medium</td>
                                <td style="background-color: rgba(59, 130, 246, 0.3);">Low</td>
                                <td style="background-color: rgba(59, 130, 246, 0.5);">Medium</td>
                                <td style="background-color: rgba(59, 130, 246, 0.2);">Very Low</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-start">Footwear</td>
                                <td style="background-color: rgba(59, 130, 246, 0.3);">Low</td>
                                <td style="background-color: rgba(59, 130, 246, 0.6);">High</td>
                                <td style="background-color: rgba(59, 130, 246, 0.4);">Medium</td>
                                <td style="background-color: rgba(59, 130, 246, 0.7); color: white;">Very High</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-start">Outerwear</td>
                                <td style="background-color: rgba(59, 130, 246, 0.2);">Very Low</td>
                                <td style="background-color: rgba(59, 130, 246, 0.1);">None</td>
                                <td style="background-color: rgba(59, 130, 246, 0.6);">High</td>
                                <td style="background-color: rgba(59, 130, 246, 1.0); color: white;">Maximum</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 d-flex gap-4 small text-muted justify-content-center">
                    <div class="d-flex align-items-center"><div class="me-1" style="width:12px; height:12px; background:rgba(59, 130, 246, 0.1)"></div> Low Interest</div>
                    <div class="d-flex align-items-center"><div class="me-1" style="width:12px; height:12px; background:rgba(59, 130, 246, 0.5)"></div> Medium</div>
                    <div class="d-flex align-items-center"><div class="me-1" style="width:12px; height:12px; background:rgba(59, 130, 246, 1.0)"></div> High Interest</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const repeatData = <?php echo json_encode(array_values($repeatDist)); ?>;
    const repeatLabels = <?php echo json_encode(array_keys($repeatDist)); ?>;

    const ctxRepeat = document.getElementById('repeatPurchaseChart').getContext('2d');
    new Chart(ctxRepeat, {
        type: 'bar',
        data: {
            labels: repeatLabels,
            datasets: [{
                label: 'Number of Customers',
                data: repeatData,
                backgroundColor: '#3B82F6',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { display: false } },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>
