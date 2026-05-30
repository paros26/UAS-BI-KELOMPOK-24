<?php
require_once 'includes/db_connection.php';

echo "<h2>Data Migration Started...</h2>";

$csvFile = 'customer_purchase_analysis.csv';

if (!file_exists($csvFile)) {
    die("<p style='color:red;'>Error: File $csvFile tidak ditemukan!</p>");
}

try {
    // 1. Update Schema (Tambah kolom jika belum ada)
    $columnsToAdd = [
        'age_group' => 'VARCHAR(20)',
        'revenue_segment' => 'VARCHAR(20)',
        'frequency_score' => 'INT',
        'customer_segment' => 'VARCHAR(50)',
        'recommendation_category' => 'VARCHAR(100)',
        'recommendation_score' => 'INT'
    ];

    foreach ($columnsToAdd as $col => $type) {
        $check = $pdo->query("SHOW COLUMNS FROM shopping_trends LIKE '$col'");
        if ($check->rowCount() == 0) {
            $pdo->exec("ALTER TABLE shopping_trends ADD COLUMN $col $type");
            echo "<p>Kolom <b>$col</b> berhasil ditambahkan.</p>";
        }
    }

    // 2. Kosongkan tabel terlebih dahulu agar tidak duplikat jika dijalankan ulang
    $pdo->exec("TRUNCATE TABLE shopping_trends");
    echo "<p>Tabel dibersihkan (Truncated).</p>";

    if (($handle = fopen($csvFile, "r")) !== FALSE) {
        // Lewati baris header
        $headers = fgetcsv($handle, 1000, ",");
        
        $sql = "INSERT INTO shopping_trends (
                    customer_id, age, gender, item_purchased, category, 
                    purchase_amount_usd, location, size, color, season, 
                    review_rating, subscription_status, shipping_type, 
                    discount_applied, promo_code_used, previous_purchases, 
                    payment_method, frequency_of_purchases,
                    age_group, revenue_segment, frequency_score,
                    customer_segment, recommendation_category, recommendation_score
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )";
        
        $stmt = $pdo->prepare($sql);
        $count = 0;

        // Mulai transaksi untuk performa lebih cepat
        $pdo->beginTransaction();

        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if (count($row) >= 24) {
                // Ambil 24 kolom dari CSV
                $data = array_slice($row, 0, 24);
                $stmt->execute($data);
                $count++;
            }
        }

        $pdo->commit();
        fclose($handle);

        echo "<p style='color:green;'>Berhasil! <b>$count</b> baris data telah dimasukkan ke database.</p>";
        echo "<a href='dashboard.php'>Kembali ke Dashboard</a>";
    }
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    die("<p style='color:red;'>Error: " . $e->getMessage() . "</p>");
}
?>
