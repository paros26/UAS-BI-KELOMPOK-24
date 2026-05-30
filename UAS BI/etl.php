<?php 
    $pageTitle = "ETL & Data Preparation";
    $activePage = "etl";
    include 'includes/header.php';
    include 'includes/sidebar.php';
?>

<div class="main-content">
    <div class="container-fluid">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold text-dark">ETL Process & Data Preparation</h2>
            <p class="text-muted">Dokumentasi teknis alur data dari sumber mentah hingga menjadi Single Table Analytical Schema untuk Dashboard BI & DSS.</p>
        </div>

        <!-- ETL Workflow -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">ETL (Extract, Transform, Load) Pipeline</h5>
                <div class="row g-4 align-items-center text-center">
                    <div class="col-md-3">
                        <div class="etl-node shadow-sm">
                            <i class="bi bi-filetype-csv text-primary fs-2 mb-2"></i>
                            <h6 class="fw-bold">Extract</h6>
                            <p class="small text-muted mb-0">shopping_trends.csv</p>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <i class="bi bi-arrow-right etl-arrow d-none d-md-block"></i>
                        <i class="bi bi-arrow-down etl-arrow d-md-none mb-3"></i>
                    </div>
                    <div class="col-md-4">
                        <div class="etl-node shadow-sm" style="border-color: #3B82F6; background: rgba(59, 130, 246, 0.05);">
                            <i class="bi bi-gear-fill text-primary fs-2 mb-2 spin"></i>
                            <h6 class="fw-bold">Transform & Engineering</h6>
                            <ul class="text-start small text-muted mb-0">
                                <li>Data Cleaning & Validation</li>
                                <li>Customer Segmentation</li>
                                <li>Recommendation Scoring</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <i class="bi bi-arrow-right etl-arrow d-none d-md-block"></i>
                        <i class="bi bi-arrow-down etl-arrow d-md-none mb-3"></i>
                    </div>
                    <div class="col-md-3">
                        <div class="etl-node shadow-sm">
                            <i class="bi bi-database-fill-check text-primary fs-2 mb-2"></i>
                            <h6 class="fw-bold">Load</h6>
                            <p class="small text-muted mb-0">customer_purchase_analysis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Schema Visualization -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-5 text-start">Analytical Data Workflow (Single Table Schema)</h5>
                        
                        <div class="d-flex flex-column align-items-center">
                            <div class="row w-100 justify-content-center">
                                <!-- Raw Stage -->
                                <div class="col-md-4">
                                    <div class="p-3 bg-light shadow-sm rounded-3 border-start border-4 border-info mb-4">
                                        <h6 class="fw-bold mb-2">Raw Dataset</h6>
                                        <ul class="list-unstyled small text-muted mb-0 text-start">
                                            <li>Shopping Trends CSV</li>
                                            <li>Initial Attributes</li>
                                        </ul>
                                    </div>
                                    <!-- Processing Stage -->
                                    <div class="p-3 bg-light shadow-sm rounded-3 border-start border-4 border-success">
                                        <h6 class="fw-bold mb-2">Processing Steps</h6>
                                        <ul class="list-unstyled small text-muted mb-0 text-start">
                                            <li>Missing Value Check</li>
                                            <li>Duplicate Checking</li>
                                            <li>Data Type Casting</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Result Table -->
                                <div class="col-md-4 d-flex align-items-center">
                                    <div class="p-4 bg-white shadow-sm rounded-3 border-4 border-primary w-100">
                                        <h6 class="fw-bold mb-3">customer_purchase_analysis</h6>
                                        <ul class="list-unstyled small text-muted mb-0 text-start">
                                            <li class="text-primary fw-bold">Analytical Columns:</li>
                                            <li>age_group</li>
                                            <li>revenue_segment</li>
                                            <li>frequency_score</li>
                                            <li>customer_segment</li>
                                            <li>recommendation_category</li>
                                            <li>recommendation_score</li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Output -->
                                <div class="col-md-4">
                                    <div class="p-3 bg-light shadow-sm rounded-3 border-start border-4 border-warning mb-4">
                                        <h6 class="fw-bold mb-2">Dashboard BI</h6>
                                        <ul class="list-unstyled small text-muted mb-0 text-start">
                                            <li>Interactive KPI Cards</li>
                                            <li>Analytical Charts</li>
                                        </ul>
                                    </div>
                                    <div class="p-3 bg-light shadow-sm rounded-3 border-start border-4 border-danger">
                                        <h6 class="fw-bold mb-2">DSS System</h6>
                                        <ul class="list-unstyled small text-muted mb-0 text-start">
                                            <li>Product Recommendation</li>
                                            <li>Matching Score Engine</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="small text-muted mt-4">Project ini menggunakan proses ETL dengan pendekatan Single Table Analytical Schema karena dataset berasal dari satu sumber data yang telah diperkaya melalui tahap Feature Engineering.</p>
                    </div>
                </div>
            </div>

            <!-- Preprocessing Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Analytical Preparation Steps</h5>
                        <div class="timeline small">
                            <div class="d-flex mb-4">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 me-3" style="width:32px; height:32px; flex-shrink:0;">1</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Data Cleaning</h6>
                                    <p class="text-muted mb-0">Missing value & duplicate checking untuk menjamin kualitas data.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 me-3" style="width:32px; height:32px; flex-shrink:0;">2</div>
                                <div>
                                    <h6 class="fw-bold mb-1">Feature Engineering</h6>
                                    <p class="text-muted mb-0">Pembuatan kolom analitik: Age Group & Revenue Segmentation.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="bg-primary-subtle text-primary rounded-circle p-2 me-3" style="width:32px; height:32px; flex-shrink:0;">3</div>
                                <div>
                                    <h6 class="fw-bold mb-1">DSS Scoring</h6>
                                    <p class="text-muted mb-0">Kalkulasi Recommendation Category & Score berdasarkan pola pembelian.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
