<?php

require_once __DIR__ . '/db_connection.php';

/**
 * DataHelper - Handles analytical data preparation and retrieval.
 * Based on Single Table Analytical Schema (customer_purchase_analysis).
 */
class DataHelper {
    private $pdo;
    private $data = [];

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
        $this->loadData();
    }

    private function loadData() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM shopping_trends");
            $this->data = $stmt->fetchAll();
            
            // If database is empty, try to seed from CSV automatically
            if (empty($this->data)) {
                $this->seedFromCSV();
                $stmt = $this->pdo->query("SELECT * FROM shopping_trends");
                $this->data = $stmt->fetchAll();
            }

            // Post-process data
            foreach ($this->data as &$item) {
                $item['age'] = (int)$item['age'];
                $item['purchase_amount_usd'] = (float)$item['purchase_amount_usd'];
                $item['review_rating'] = (float)$item['review_rating'];
                // Use pre-calculated fields from database if they exist
                $item['age_group'] = $item['age_group'] ?? $this->categorizeAge($item['age']);
                $item['revenue_segment'] = $item['revenue_segment'] ?? $this->categorizeRevenue($item['purchase_amount_usd']);
            }
        } catch (PDOException $e) {
            // Silently fail or log error
        }
    }

    private function seedFromCSV() {
        $csvFile = 'customer_purchase_analysis.csv';
        if (!file_exists($csvFile)) return;

        if (($handle = fopen($csvFile, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 1000, ",");
            
            $sql = "INSERT INTO shopping_trends (
                        customer_id, age, gender, item_purchased, category, 
                        purchase_amount_usd, location, size, color, season, 
                        review_rating, subscription_status, shipping_type, 
                        discount_applied, promo_code_used, previous_purchases, 
                        payment_method, frequency_of_purchases,
                        age_group, revenue_segment, frequency_score,
                        customer_segment, recommendation_category, recommendation_score
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($row) >= 24) {
                    $data = array_slice($row, 0, 24);
                    $stmt->execute($data);
                }
            }
            fclose($handle);
        }
    }

    public function categorizeAge($age) {
        if ($age < 18) return 'Teen';
        if ($age < 26) return 'Young Adult';
        if ($age < 40) return 'Adult';
        if ($age < 55) return 'Middle Age';
        return 'Senior';
    }

    public function categorizeRevenue($amount) {
        if ($amount < 30) return 'Low';
        if ($amount <= 70) return 'Medium';
        return 'High';
    }

    public function getData() {
        return $this->data;
    }

    // CRUD Methods
    public function create($data) {
        $sql = "INSERT INTO shopping_trends (customer_id, age, gender, item_purchased, category, purchase_amount_usd, location, size, color, season, review_rating, subscription_status, shipping_type, discount_applied, promo_code_used, previous_purchases, payment_method, frequency_of_purchases, age_group, revenue_segment, frequency_score, customer_segment, recommendation_category, recommendation_score) 
                VALUES (:customer_id, :age, :gender, :item_purchased, :category, :purchase_amount_usd, :location, :size, :color, :season, :review_rating, :subscription_status, :shipping_type, :discount_applied, :promo_code_used, :previous_purchases, :payment_method, :frequency_of_purchases, :age_group, :revenue_segment, :frequency_score, :customer_segment, :recommendation_category, :recommendation_score)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $fields .= "$key = :$key, ";
            }
        }
        $fields = rtrim($fields, ", ");
        
        $sql = "UPDATE shopping_trends SET $fields WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM shopping_trends WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM shopping_trends WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getLastCustomerId() {
        $stmt = $this->pdo->query("SELECT MAX(customer_id) as max_id FROM shopping_trends");
        $result = $stmt->fetch();
        return (int)($result['max_id'] ?? 0);
    }

    public function getUniqueValues($column) {
        $stmt = $this->pdo->prepare("SELECT DISTINCT $column FROM shopping_trends WHERE $column IS NOT NULL AND $column != '' ORDER BY $column ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function applyFilters($filters) {
        if (empty($filters)) return;

        $this->data = array_filter($this->data, function($row) use ($filters) {
            foreach ($filters as $key => $value) {
                if ($value !== '' && $value !== 'Semua' && $value !== 'Metode Bayar') {
                    if (isset($row[$key]) && $row[$key] != $value) {
                        return false;
                    }
                }
            }
            return true;
        });
    }

    public function getKPIs() {
        // Hitung langsung dari data database ($this->data) agar dinamis
        $totalTransactions = count($this->data);
        
        // Mengambil semua customer_id unik
        $customerIds = array_column($this->data, 'customer_id');
        $totalCustomers = count(array_unique($customerIds));
        
        // Menghitung total revenue
        $totalRevenue = array_sum(array_column($this->data, 'purchase_amount_usd'));
        
        // Menghitung rata-rata rating
        $avgRating = $totalTransactions > 0 ? array_sum(array_column($this->data, 'review_rating')) / $totalTransactions : 0;

        return [
            'total_customers' => number_format($totalCustomers),
            'total_revenue' => '$' . number_format($totalRevenue),
            'avg_rating' => number_format($avgRating, 2),
            'total_transactions' => number_format($totalTransactions)
        ];
    }

    public function getCategoryDistribution() {
        $dist = [];
        foreach ($this->data as $row) {
            $cat = $row['category'];
            $dist[$cat] = ($dist[$cat] ?? 0) + $row['purchase_amount_usd'];
        }
        arsort($dist);
        return $dist;
    }

    public function getGenderDistribution() {
        $dist = ['Male' => 0, 'Female' => 0];
        foreach ($this->data as $row) {
            $gender = $row['gender'];
            if (isset($dist[$gender])) $dist[$gender]++;
        }
        return $dist;
    }

    public function getAgeDistribution() {
        $groups = ['Teen' => 0, 'Young Adult' => 0, 'Adult' => 0, 'Middle Age' => 0, 'Senior' => 0];
        foreach ($this->data as $row) {
            $group = $row['age_group'];
            if (isset($groups[$group])) $groups[$group]++;
        }
        return $groups;
    }

    public function getPaymentDistribution() {
        $dist = [];
        foreach ($this->data as $row) {
            $method = $row['payment_method'];
            $dist[$method] = ($dist[$method] ?? 0) + 1;
        }
        return $dist;
    }

    public function getRecentTransactions($limit = 5) {
        return array_slice(array_reverse($this->data), 0, $limit);
    }

    public function getRecommendations($filters) {
        $results = [];
        foreach ($this->data as $row) {
            $score = 0;
            
            // If we have a pre-calculated recommendation score for this row/customer, use it as a base
            if (isset($row['recommendation_score'])) {
                $score = (int)$row['recommendation_score'];
            } else {
                // Fallback to manual matching
                if (isset($filters['gender']) && $row['gender'] == $filters['gender']) $score += 30;
                if (isset($filters['category']) && $row['category'] == $filters['category']) $score += 40;
                if (isset($filters['season']) && $row['season'] == $filters['season']) $score += 30;
            }
            
            // Filter by requested category/gender/season if provided in form
            if (!empty($filters['gender']) && $row['gender'] != $filters['gender']) continue;
            if (!empty($filters['category']) && $row['category'] != $filters['category']) continue;
            if (!empty($filters['season']) && $row['season'] != $filters['season']) continue;

            if ($score >= 50) {
                $row['match_score'] = $score;
                $results[] = $row;
            }
        }
        
        $uniqueResults = [];
        foreach ($results as $r) {
            $key = $r['item_purchased'];
            // If recommendation_category is available, we might want to highlight those
            if (!isset($uniqueResults[$key]) || $r['match_score'] > $uniqueResults[$key]['match_score']) {
                $uniqueResults[$key] = $r;
            }
        }
        
        usort($uniqueResults, function($a, $b) {
            return $b['match_score'] <=> $a['match_score'];
        });

        return array_slice($uniqueResults, 0, 4);
    }

    public function getRevenueSegmentation() {
        $segments = ['High' => 0, 'Medium' => 0, 'Low' => 0];
        foreach ($this->data as $row) {
            $seg = $row['revenue_segment'];
            
            // Cek apakah mengandung kata kunci High, Medium, atau Low
            if (stripos($seg, 'High') !== false) {
                $segments['High']++;
            } elseif (stripos($seg, 'Medium') !== false) {
                $segments['Medium']++;
            } elseif (stripos($seg, 'Low') !== false) {
                $segments['Low']++;
            }
        }
        return $segments;
    }

    public function getRepeatPurchaseDistribution() {
        $dist = ['0' => 0, '1-5' => 0, '6-15' => 0, '16-30' => 0, '31+' => 0];
        foreach ($this->data as $row) {
            $prev = (int)($row['previous_purchases'] ?? 0);
            if ($prev == 0) $dist['0']++;
            elseif ($prev <= 5) $dist['1-5']++;
            elseif ($prev <= 15) $dist['6-15']++;
            elseif ($prev <= 30) $dist['16-30']++;
            else $dist['31+']++;
        }
        return $dist;
    }

    public function getFrequencyDistribution() {
        $dist = [];
        foreach ($this->data as $row) {
            $freq = $row['frequency_of_purchases'];
            $dist[$freq] = ($dist[$freq] ?? 0) + 1;
        }
        return $dist;
    }
}
