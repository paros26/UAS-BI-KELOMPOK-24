<?php 
    $pageTitle = "Manage Data";
    $activePage = "manage_data";
    include 'includes/header.php';
    include 'includes/sidebar.php';
    include 'includes/data_helper.php';

    $dh = new DataHelper();
    $message = "";

    // Handle Delete
    if (isset($_GET['delete'])) {
        if ($dh->delete($_GET['delete'])) {
            header("Location: manage_data.php?msg=deleted");
            exit;
        }
    }

    // Handle Add/Edit
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = [
            'age' => $_POST['age'],
            'gender' => $_POST['gender'],
            'item_purchased' => $_POST['item_purchased'],
            'category' => $_POST['category'],
            'purchase_amount_usd' => $_POST['purchase_amount_usd'],
            'location' => $_POST['location'] ?? '',
            'size' => $_POST['size'] ?? '',
            'color' => $_POST['color'] ?? '',
            'season' => $_POST['season'],
            'review_rating' => $_POST['review_rating'],
            'subscription_status' => $_POST['subscription_status'],
            'shipping_type' => $_POST['shipping_type'] ?? '',
            'discount_applied' => $_POST['discount_applied'] ?? '',
            'promo_code_used' => $_POST['promo_code_used'],
            'previous_purchases' => $_POST['previous_purchases'],
            'payment_method' => $_POST['payment_method'],
            'frequency_of_purchases' => $_POST['frequency_of_purchases'],
            'age_group' => $_POST['age_group'] ?? '',
            'revenue_segment' => $_POST['revenue_segment'] ?? '',
            'frequency_score' => $_POST['frequency_score'] ?? 0,
            'customer_segment' => $_POST['customer_segment'] ?? '',
            'recommendation_category' => $_POST['recommendation_category'] ?? '',
            'recommendation_score' => $_POST['recommendation_score'] ?? 0
        ];

        if (!empty($_POST['id'])) {
            if ($dh->update($_POST['id'], $data)) {
                header("Location: manage_data.php?msg=updated");
                exit;
            }
        } else {
            // Auto-generate customer_id
            $data['customer_id'] = $dh->getLastCustomerId() + 1;
            if ($dh->create($data)) {
                header("Location: manage_data.php?msg=added");
                exit;
            }
        }
    }

    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == 'added') $message = "<div class='alert alert-success'>Data berhasil ditambahkan!</div>";
        if ($_GET['msg'] == 'updated') $message = "<div class='alert alert-success'>Data berhasil diperbarui!</div>";
        if ($_GET['msg'] == 'deleted') $message = "<div class='alert alert-success'>Data berhasil dihapus!</div>";
    }

    $allData = $dh->getData();
    $editItem = null;
    if (isset($_GET['edit'])) {
        $editItem = $dh->find($_GET['edit']);
    }

    // Get unique values for dropdowns
    $items = $dh->getUniqueValues('item_purchased');
    $categories = $dh->getUniqueValues('category');
    $locations = $dh->getUniqueValues('location');
    $paymentMethods = $dh->getUniqueValues('payment_method');
    $shippingTypes = $dh->getUniqueValues('shipping_type');
    $seasons = $dh->getUniqueValues('season');
    $frequencies = $dh->getUniqueValues('frequency_of_purchases');

    // Analytical dropdown options
    $ageGroups = ['Teen', 'Young Adult', 'Adult', 'Middle Age', 'Senior'];
    $revSegments = ['Low Revenue', 'Medium Revenue', 'High Revenue'];
    $custSegments = ['Potential Customer', 'Loyal Customer', 'Regular Customer', 'High Value Customer'];
    $recCategories = [
        'Clothing Recommendation', 
        'Winter Clothing Recommendation', 
        'Footwear Recommendation', 
        'Outerwear Recommendation', 
        'Accessories Recommendation'
    ];
?>

<div class="main-content">
    <div class="container-fluid">
        <div class="mb-4">
            <h2 class="fw-bold text-dark">Kelola Data Tren Belanja</h2>
            <p class="text-muted">Tambah, Lihat, Ubah, dan Hapus data transaksi dari database dengan skema Single Table Analytical.</p>
        </div>

        <?php echo $message; ?>

        <!-- Form Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4"><?php echo $editItem ? "Ubah Data" : "Tambah Data Baru"; ?></h5>
                <form method="POST" class="row g-3">
                    <input type="hidden" name="id" value="<?php echo $editItem['id'] ?? ''; ?>">
                    
                    <!-- Basic Info Section -->
                    <div class="col-12"><h6 class="fw-bold text-primary mb-0">Informasi Dasar</h6><hr class="mt-2"></div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Umur</label>
                        <input type="number" name="age" class="form-control form-control-sm" value="<?php echo $editItem['age'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Jenis Kelamin</label>
                        <select name="gender" class="form-select form-select-sm" required>
                            <option value="Male" <?php echo (isset($editItem['gender']) && $editItem['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo (isset($editItem['gender']) && $editItem['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Produk</label>
                        <select name="item_purchased" class="form-select form-select-sm" required>
                            <option value="">Pilih Produk</option>
                            <?php foreach ($items as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['item_purchased']) && $editItem['item_purchased'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Kategori</label>
                        <select name="category" class="form-select form-select-sm" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['category']) && $editItem['category'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Total Harga (USD)</label>
                        <input type="number" step="0.01" name="purchase_amount_usd" class="form-control form-control-sm" value="<?php echo $editItem['purchase_amount_usd'] ?? ''; ?>" required>
                    </div>
                    
                    <!-- Transaction Details Section -->
                    <div class="col-12 mt-4"><h6 class="fw-bold text-primary mb-0">Detail Transaksi</h6><hr class="mt-2"></div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Lokasi</label>
                        <select name="location" class="form-select form-select-sm">
                            <option value="">Pilih Lokasi</option>
                            <?php foreach ($locations as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['location']) && $editItem['location'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Size</label>
                        <input type="text" name="size" class="form-control form-control-sm" value="<?php echo $editItem['size'] ?? ''; ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Warna</label>
                        <input type="text" name="color" class="form-control form-control-sm" value="<?php echo $editItem['color'] ?? ''; ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Season</label>
                        <select name="season" class="form-select form-select-sm" required>
                            <option value="">Pilih Season</option>
                            <?php foreach ($seasons as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['season']) && $editItem['season'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Rating</label>
                        <input type="number" step="0.1" name="review_rating" class="form-control form-control-sm" value="<?php echo $editItem['review_rating'] ?? ''; ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Subscription</label>
                        <select name="subscription_status" class="form-select form-select-sm">
                            <option value="Yes" <?php echo (isset($editItem['subscription_status']) && $editItem['subscription_status'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo (isset($editItem['subscription_status']) && $editItem['subscription_status'] == 'No') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>

                    <!-- Payment & Shipping Section -->
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Shipping</label>
                        <select name="shipping_type" class="form-select form-select-sm">
                            <?php foreach ($shippingTypes as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['shipping_type']) && $editItem['shipping_type'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Payment Method</label>
                        <select name="payment_method" class="form-select form-select-sm">
                            <?php foreach ($paymentMethods as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['payment_method']) && $editItem['payment_method'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Frequency</label>
                        <select name="frequency_of_purchases" class="form-select form-select-sm">
                            <?php foreach ($frequencies as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['frequency_of_purchases']) && $editItem['frequency_of_purchases'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Discount Applied</label>
                        <select name="discount_applied" class="form-select form-select-sm">
                            <option value="Yes" <?php echo (isset($editItem['discount_applied']) && $editItem['discount_applied'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo (isset($editItem['discount_applied']) && $editItem['discount_applied'] == 'No') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Previous Purchases</label>
                        <input type="number" name="previous_purchases" class="form-control form-control-sm" value="<?php echo $editItem['previous_purchases'] ?? ''; ?>">
                    </div>

                    <!-- Analytical Fields Section (New) -->
                    <div class="col-12 mt-4"><h6 class="fw-bold text-primary mb-0">Analytical Data (Processed)</h6><hr class="mt-2"></div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Age Group</label>
                        <select name="age_group" class="form-select form-select-sm">
                            <option value="">Pilih</option>
                            <?php foreach ($ageGroups as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['age_group']) && $editItem['age_group'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Revenue Segment</label>
                        <select name="revenue_segment" class="form-select form-select-sm">
                            <option value="">Pilih</option>
                            <?php foreach ($revSegments as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['revenue_segment']) && $editItem['revenue_segment'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Frequency Score</label>
                        <input type="number" name="frequency_score" class="form-control form-control-sm" value="<?php echo $editItem['frequency_score'] ?? ''; ?>">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Customer Segment</label>
                        <select name="customer_segment" class="form-select form-select-sm">
                            <option value="">Pilih</option>
                            <?php foreach ($custSegments as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['customer_segment']) && $editItem['customer_segment'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Rec Category</label>
                        <select name="recommendation_category" class="form-select form-select-sm">
                            <option value="">Pilih</option>
                            <?php foreach ($recCategories as $val): ?>
                            <option value="<?php echo $val; ?>" <?php echo (isset($editItem['recommendation_category']) && $editItem['recommendation_category'] == $val) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Rec Score</label>
                        <input type="number" name="recommendation_score" class="form-control form-control-sm" value="<?php echo $editItem['recommendation_score'] ?? ''; ?>">
                    </div>

                    <div class="col-12 d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-sm px-4 py-2 fw-bold"><?php echo $editItem ? "Simpan Perubahan" : "Tambah Data Transaksi"; ?></button>
                        <?php if ($editItem): ?>
                            <a href="manage_data.php" class="btn btn-light btn-sm px-4 py-2">Batal</a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Daftar Transaksi <?php echo isset($_GET['all']) ? '(Semua)' : '(100 Terakhir)'; ?></h5>
                    <?php if (!isset($_GET['all']) && count($allData) > 100): ?>
                        <a href="manage_data.php?all=1" class="btn btn-sm btn-outline-primary">Tampilkan Semua</a>
                    <?php elseif (isset($_GET['all'])): ?>
                        <a href="manage_data.php" class="btn btn-sm btn-outline-secondary">Tampilkan 100 Terakhir</a>
                    <?php endif; ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle small">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>ID Pelanggan</th>
                                <th>Umur/Gender</th>
                                <th>Produk</th>
                                <th>Total</th>
                                <th>Segment</th>
                                <th>Rec Category</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $displayData = isset($_GET['all']) ? array_reverse($allData) : array_slice(array_reverse($allData), 0, 100);
                            foreach ($displayData as $row): 
                            ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['customer_id']; ?></td>
                                <td><?php echo $row['age'] . " / " . ($row['gender'] == 'Male' ? 'L' : 'P'); ?></td>
                                <td><?php echo $row['item_purchased']; ?></td>
                                <td>$<?php echo $row['purchase_amount_usd']; ?></td>
                                <td><span class="badge bg-info-subtle text-info small"><?php echo $row['customer_segment'] ?? '-'; ?></span></td>
                                <td class="small"><?php echo $row['recommendation_category'] ?? '-'; ?></td>
                                <td>
                                    <a href="manage_data.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-info py-0 px-2"><i class="bi bi-pencil"></i></a>
                                    <a href="manage_data.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger py-0 px-2" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
