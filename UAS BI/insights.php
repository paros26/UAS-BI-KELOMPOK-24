<?php 
    $pageTitle = "BI Business Insights";
    $activePage = "insights";
    include 'includes/header.php';
    include 'includes/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Business Intelligence Insights</h2>
            <p class="text-muted">Rangkuman temuan strategis dan rekomendasi manajerial berdasarkan hasil analisis data.</p>
        </div>

        <div class="row g-4 mb-4">
            <!-- Strategic Recommendations -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4">
                    <h5 class="fw-bold mb-4">Strategic Recommendations</h5>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                    <i class="bi bi-tag-fill fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Dynamic Pricing for Clothing</h6>
                                    <p class="small text-muted">Terapkan kenaikan harga minor (5-10%) pada kategori Clothing selama musim Summer di Montana, karena inelastisitas permintaan yang tinggi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                    <i class="bi bi-person-heart fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Loyalty Program Extension</h6>
                                    <p class="small text-muted">Fokuskan program loyalitas pada segmen 'Middle Age' (40-60 thn) karena mereka memiliki CLV (Customer Lifetime Value) tertinggi.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                    <i class="bi bi-calendar-check fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Seasonal Inventory Shift</h6>
                                    <p class="small text-muted">Stok Accessories harus dikurangi 20% pada musim Winter dan dialokasikan untuk Outerwear yang memiliki demand 3x lebih besar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 me-3">
                                    <i class="bi bi-credit-card-2-back fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold">Payment Promo Strategy</h6>
                                    <p class="small text-muted">Tingkatkan kerjasama promo dengan PayPal dan Venmo karena merupakan metode favorit bagi segmen 'Young Adult'.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Executive Summary Cards -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm bg-primary text-white p-4 mb-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-lightning-fill me-2"></i> Quick Insight</h6>
                    <p class="small opacity-75">Customer Retention Rate meningkat 15% pada pelanggan yang menggunakan promo code dibandingkan pelanggan reguler.</p>
                    <hr class="opacity-25">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small">Confidence Score</span>
                        <span class="fw-bold text-warning">94%</span>
                    </div>
                </div>

                <div class="card border-0 shadow-sm p-4">
                    <h6 class="fw-bold mb-3 text-dark">Revenue Optimization</h6>
                    <ul class="list-unstyled mb-0 small text-muted">
                        <li class="mb-3 d-flex justify-content-between">
                            <span>Upselling Potential</span>
                            <span class="text-success fw-bold">+$12.4K</span>
                        </li>
                        <li class="mb-3 d-flex justify-content-between">
                            <span>Cross-selling Goal</span>
                            <span class="text-success fw-bold">+18%</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            <span>Churn Prevention</span>
                            <span class="text-danger fw-bold">-5.2%</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Seasonal Trends Summary -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Seasonal Purchasing Trends Summary</h5>
                <div class="row g-4">
                    <div class="col-md-3 border-end">
                        <div class="text-center p-3">
                            <i class="bi bi-flower1 text-success fs-3 mb-2"></i>
                            <h6 class="fw-bold">Spring</h6>
                            <p class="small text-muted">Peningkatan pada Footwear (+12%) dan Accessories pastel.</p>
                        </div>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="text-center p-3">
                            <i class="bi bi-sun-fill text-warning fs-3 mb-2"></i>
                            <h6 class="fw-bold">Summer</h6>
                            <p class="small text-muted">Peak season untuk Clothing. Blouse & Dress terjual habis.</p>
                        </div>
                    </div>
                    <div class="col-md-3 border-end">
                        <div class="text-center p-3">
                            <div class="d-flex justify-content-center gap-2 mb-2">
                                <i class="bi bi-leaf-fill text-danger fs-3"></i>
                                <i class="bi bi-tree-fill text-warning fs-3"></i>
                            </div>
                            <h6 class="fw-bold">Fall</h6>
                            <p class="small text-muted">Transisi ke Outerwear ringan & Jeans denim gelap.</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center p-3">
                            <i class="bi bi-snow2 text-info fs-3 mb-2"></i>
                            <h6 class="fw-bold">Winter</h6>
                            <p class="small text-muted">Dominasi Outerwear tebal & Boots. Demand tertinggi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
