<?php
session_start();
include('../config/database.php');

// Title untuk header
$title = "Daftar UMKM Lokal";

// --- 1. SETUP PAGINATION & FILTER ---
$limit = 9; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Ambil parameter filter dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'terbaru';

// --- 2. BUILD QUERY ---
$where_clauses = [];
if (!empty($search)) {
    $search_safe = mysqli_real_escape_string($koneksi, $search);
    $where_clauses[] = "nama_umkm LIKE '%$search_safe%'";
}
if (!empty($kategori_filter)) {
    $kategori_safe = mysqli_real_escape_string($koneksi, $kategori_filter);
    $where_clauses[] = "umkm.id_kategori = '$kategori_safe'";
}

$where_sql = "";
if (count($where_clauses) > 0) {
    $where_sql = "WHERE " . implode(" AND ", $where_clauses);
}

// Sorting
$order_sql = "ORDER BY id_umkm DESC"; // Default terbaru
if ($sort == 'rating') {
    // Note: Ini asumsi nanti ada kolom rating atau join ke tabel ulasan, 
    // untuk sekarang kita pakai id_umkm DESC dulu atau logic lain jika ada.
    // Jika belum ada kolom rating di tabel umkm, kita skip dulu atau join.
    // Untuk simpelnya saat ini kita anggap sort rating = terbaru dulu sampai fitur rating integrasi penuh.
    // Atau kita bisa join left dengan ulasan untuk hitung rata-rata (agak kompleks).
    // Kita pakai default dulu agar tidak error.
    $order_sql = "ORDER BY id_umkm DESC"; 
} elseif ($sort == 'terlama') {
    $order_sql = "ORDER BY id_umkm ASC";
}

// --- 3. HITUNG TOTAL DATA (Untuk Pagination) ---
$count_query = "SELECT COUNT(*) as total FROM umkm $where_sql";
$count_result = mysqli_query($koneksi, $count_query);
$total_data = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_data / $limit);

// --- 4. AMBIL DATA UTAMA ---
// --- 4. AMBIL DATA UTAMA ---
$query = "SELECT umkm.*, kategori.nama_kategori, AVG(ulasan.rating) as avg_rating, COUNT(ulasan.id_ulasan) as total_reviews
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori
          LEFT JOIN ulasan ON umkm.id_umkm = ulasan.id_umkm
          $where_sql
          GROUP BY umkm.id_umkm
          $order_sql
          LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);

// Ambil data kategori untuk dropdown
$cat_query = mysqli_query($koneksi, "SELECT * FROM kategori");

// Include header
include('../includes/header_public.php');
?>

<link rel="stylesheet" href="../assets/css/style_umkm.css">

<div class="container py-4 page-container-spacer"> <!-- Adjusted spacing -->

  <!-- Header Section with Back Button -->
  <div class="position-relative mb-5 text-center">
    <!-- Back Button (Absolute Left) -->
    <a href="../public/index.php" class="btn btn-light text-primary rounded-circle shadow-sm position-absolute start-0 top-50 translate-middle-y d-none d-md-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border: 1px solid #eee;" title="Kembali ke Beranda">
      <i class="bi bi-arrow-left fs-4"></i>
    </a>
    
    <!-- Mobile Back Button (Visible only on small screens) -->
    <div class="d-md-none text-start mb-3">
       <a href="../public/index.php" class="btn btn-light text-primary rounded-circle shadow-sm" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
      </a>
    </div>

    <!-- Title & Subtitle -->
    <div class="d-inline-block position-relative">
      <h2 class="fw-bold mb-2 display-6">Daftar UMKM Lokal</h2>
      <div class="d-flex justify-content-center mb-3">
        <div style="height: 4px; width: 60px; background: var(--primary-color); border-radius: 2px;"></div>
      </div>
      <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.05rem;">
        Temukan berbagai UMKM lokal dengan produk berkualitas. <br class="d-none d-md-block"> Dukung ekonomi lokal dengan berbelanja di UMKM sekitar Anda.
      </p>
    </div>
  </div>

  <!-- FILTER & SEARCH BAR -->
  <div class="card border-0 shadow-sm mb-5 p-3 bg-light rounded-4">
    <form method="GET" action="">
      <div class="row g-2 align-items-center">
        
        <!-- Search -->
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari nama UMKM..." value="<?= htmlspecialchars($search) ?>">
          </div>
        </div>

        <!-- Kategori -->
        <div class="col-md-3">
          <select name="kategori" class="form-select">
            <option value="">Semua Kategori</option>
            <?php while($cat = mysqli_fetch_assoc($cat_query)): ?>
              <option value="<?= $cat['id_kategori'] ?>" <?= $kategori_filter == $cat['id_kategori'] ? 'selected' : '' ?>>
                <?= $cat['nama_kategori'] ?>
              </option>
            <?php endwhile; ?>
          </select>
        </div>

        <!-- Sort -->
        <div class="col-md-3">
          <select name="sort" class="form-select">
            <option value="terbaru" <?= $sort == 'terbaru' ? 'selected' : '' ?>>Paling Baru</option>
            <option value="terlama" <?= $sort == 'terlama' ? 'selected' : '' ?>>Paling Lama</option>
          </select>
        </div>

        <!-- Tombol Filter -->
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100 fw-bold">Terapkan</button>
        </div>

      </div>
    </form>
  </div>

  <!-- LIST UMKM -->
  <div class="row g-4">

    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>

        <div class="col-md-4 col-sm-6">
          <div class="card h-100 border-0 shadow-sm umkm-card">
            
            <!-- Foto UMKM -->
            <div class="position-relative overflow-hidden">
                <?php if (!empty($row['foto'])): ?>
                <img src="../uploads/umkm/<?= htmlspecialchars($row['foto']) ?>" 
                    class="card-img-top umkm-img">
                <?php else: ?>
                <img src="../assets/img/no-image.png" 
                    class="card-img-top umkm-img">
                <?php endif; ?>
                
                <!-- Badge Kategori -->
                <span class="position-absolute top-0 start-0 bg-primary text-white px-3 py-1 m-2 rounded-pill small fw-bold shadow-sm">
                    <?= htmlspecialchars($row['nama_kategori'] ?? 'Umum') ?>
                </span>
            </div>

            <div class="card-body text-center p-4">
              <h5 class="card-title fw-bold text-dark mb-1">
                <?= htmlspecialchars($row['nama_umkm']) ?>
              </h5>
              
              <!-- Rating Bintang (Dummy Static dulu atau ambil dari DB jika ada) -->
              <!-- Rating Bintang Dinamis -->
              <div class="mb-3 text-warning small">
                <?php 
                $rating = $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
                $reviews = $row['total_reviews'];
                
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        echo '<i class="bi bi-star-fill"></i>';
                    } elseif ($i - 0.5 <= $rating) {
                        echo '<i class="bi bi-star-half"></i>';
                    } else {
                        echo '<i class="bi bi-star"></i>';
                    }
                }
                ?>
                <span class="text-muted ms-1">(<?= $rating ?>)</span>
              </div>

              <a href="detail.php?id=<?= $row['id_umkm'] ?>&from=daftar" 
                 class="btn btn-outline-primary rounded-pill px-4 fw-bold stretched-link">
                Lihat Detail
              </a>
            </div>
          </div>
        </div>

      <?php endwhile; ?>

    <?php else: ?>
      <!-- Jika data kosong -->
      <div class="col-12 text-center py-5">
        <img src="../assets/img/empty.svg" alt="Kosong" style="width: 150px; opacity: 0.5;" class="mb-3">
        <h5 class="text-muted">Tidak ada UMKM yang ditemukan.</h5>
        <a href="daftar_umkm.php" class="btn btn-link text-decoration-none">Reset Filter</a>
      </div>
    <?php endif; ?>

  </div>

  <!-- PAGINATION -->
  <?php if ($total_pages > 1): ?>
  <nav class="mt-5">
    <ul class="pagination justify-content-center">
      
      <!-- Prev -->
      <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
        <a class="page-link rounded-circle mx-1" href="?page=<?= $page - 1 ?>&search=<?= $search ?>&kategori=<?= $kategori_filter ?>&sort=<?= $sort ?>">
          <i class="bi bi-chevron-left"></i>
        </a>
      </li>

      <!-- Numbers -->
      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li class="page-item <?= $page == $i ? 'active' : '' ?>">
          <a class="page-link rounded-circle mx-1" href="?page=<?= $i ?>&search=<?= $search ?>&kategori=<?= $kategori_filter ?>&sort=<?= $sort ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>

      <!-- Next -->
      <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
        <a class="page-link rounded-circle mx-1" href="?page=<?= $page + 1 ?>&search=<?= $search ?>&kategori=<?= $kategori_filter ?>&sort=<?= $sort ?>">
          <i class="bi bi-chevron-right"></i>
        </a>
      </li>

    </ul>
  </nav>
  <?php endif; ?>

</div>

<?php include('../includes/footer_public.php'); ?>
