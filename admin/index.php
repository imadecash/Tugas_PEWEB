<?php
include('../config/database.php');
include('check_login.php');
include('../includes/header_admin.php');
?>

<?php
// Hitung Total UMKM
$query_umkm = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM umkm");
$data_umkm = mysqli_fetch_assoc($query_umkm);
$total_umkm = $data_umkm['total'];

// Hitung Total Kategori
$query_kategori = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kategori");
$data_kategori = mysqli_fetch_assoc($query_kategori);
$total_kategori = $data_kategori['total'];

// Hitung Total Ulasan (Laporan Masuk)
$query_ulasan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM ulasan");
$data_ulasan = mysqli_fetch_assoc($query_ulasan);
$total_ulasan = $data_ulasan['total'];
?>
<div class="row g-4 mb-4">
  <!-- CREDIT CARD WIDGET (Total UMKM) -->
  <div class="col-lg-6">
    <div class="credit-card">
      <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="card-chip"></div>
            <i class="bi bi-wifi fs-4 opacity-50"></i>
        </div>
        <div class="card-number"><?= $total_umkm ?> Mitra</div>
      </div>
      
      <div class="d-flex justify-content-between align-items-end">
        <div>
          <div class="card-label">Total UMKM</div>
          <div class="card-value">Terdaftar</div>
        </div>
        <div>
           <i class="bi bi-shop fs-1 opacity-25"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- STATS CARDS -->
  <div class="col-lg-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon-wrapper blue">
        <i class="bi bi-tags"></i>
      </div>
      <div class="stat-value"><?= $total_kategori ?></div>
      <div class="stat-label">Kategori Usaha</div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6">
    <div class="stat-card">
      <div class="stat-icon-wrapper orange">
        <i class="bi bi-file-earmark-bar-graph"></i>
      </div>
      <div class="stat-value"><?= $total_ulasan ?></div>
      <div class="stat-label">Laporan Masuk</div>
    </div>
  </div>
</div>

<!-- QUICK ACTIONS -->
<div class="mb-4">
  <h5 class="section-title">Aksi Cepat</h5>
  <div class="row g-3">
    <div class="col-6 col-md-3">
      <a href="umkm/data.php" class="action-btn">
        <div class="action-icon"><i class="bi bi-plus-lg"></i></div>
        <span class="action-text">Tambah UMKM</span>
      </a>
    </div>
    <div class="col-6 col-md-3">
      <a href="kategori/data.php" class="action-btn">
        <div class="action-icon"><i class="bi bi-grid"></i></div>
        <span class="action-text">Kategori</span>
      </a>
    </div>
    <div class="col-6 col-md-3">
      <a href="laporan/laporan_umkm.php" class="action-btn">
        <div class="action-icon"><i class="bi bi-printer"></i></div>
        <span class="action-text">Cetak Laporan</span>
      </a>
    </div>
    <div class="col-6 col-md-3">
      <a href="pengaturan.php" class="action-btn">
        <div class="action-icon"><i class="bi bi-gear"></i></div>
        <span class="action-text">Pengaturan</span>
      </a>
    </div>
  </div>
</div>

<?php
// Ambil UMKM Terbaru (Limit 1)
$query_new_umkm = mysqli_query($koneksi, "SELECT nama_umkm FROM umkm ORDER BY id_umkm DESC LIMIT 1");
$new_umkm = mysqli_fetch_assoc($query_new_umkm);

// Ambil User Terbaru (Limit 1)
$query_new_user = mysqli_query($koneksi, "SELECT nama_lengkap FROM users ORDER BY id_user DESC LIMIT 1");
$new_user = mysqli_fetch_assoc($query_new_user);
?>

<!-- RECENT ACTIVITY -->
<div>
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="section-title m-0">Aktivitas Terbaru</h5>
    <a href="#" class="text-decoration-none small fw-bold text-primary">Lihat Semua</a>
  </div>
  
  <div class="activity-list">
    <!-- Item 1: UMKM Baru -->
    <?php if ($new_umkm): ?>
    <div class="activity-item">
      <div class="activity-icon icon-box-primary">
        <i class="bi bi-shop"></i>
      </div>
      <div class="activity-details">
        <span class="activity-title">UMKM Baru Terdaftar</span>
        <span class="activity-time"><?= htmlspecialchars($new_umkm['nama_umkm']) ?></span>
      </div>
      <span class="activity-status status-success">Baru</span>
    </div>
    <?php endif; ?>

    <!-- Item 2: Laporan (Static for now as placeholder) -->
    <div class="activity-item">
      <div class="activity-icon icon-box-warning">
        <i class="bi bi-file-earmark-text"></i>
      </div>
      <div class="activity-details">
        <span class="activity-title">Laporan Bulanan</span>
        <span class="activity-time">Diunduh oleh Admin</span>
      </div>
      <span class="activity-status status-pending">Pending</span>
    </div>
    
    <!-- Item 3: User Baru -->
    <?php if ($new_user): ?>
    <div class="activity-item">
      <div class="activity-icon icon-box-info">
        <i class="bi bi-person-plus"></i>
      </div>
      <div class="activity-details">
        <span class="activity-title">User Baru</span>
        <span class="activity-time"><?= htmlspecialchars($new_user['nama_lengkap']) ?> bergabung</span>
      </div>
      <span class="activity-status status-muted">Baru saja</span>
    </div>
    <?php endif; ?>
  </div>
</div>

<?php
include('../includes/footer_admin.php');
?>
