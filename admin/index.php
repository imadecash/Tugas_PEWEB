<?php
include('check_login.php'); // pastikan admin sudah login
?>

<?php
include('../includes/header_admin.php');
?>

<div class="row mb-4">
  <div class="col-md-12">
    <div class="alert alert-info shadow-sm">
      <h5 class="mb-2"><i class="bi bi-person-circle"></i> Selamat Datang, <strong><?= $_SESSION['admin'] ?></strong>!</h5>
      <p class="mb-0">Anda dapat mengelola data UMKM, kategori usaha, serta melihat laporan aktivitas UMKM melalui panel ini.</p>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-md-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body text-center">
        <i class="bi bi-shop display-4 text-primary"></i>
        <h5 class="mt-3">Kelola Data UMKM</h5>
        <p class="text-muted">Tambah, ubah, dan hapus data UMKM yang terdaftar.</p>
        <a href="umkm/data.php" class="btn btn-primary btn-sm">Kelola</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body text-center">
        <i class="bi bi-tags display-4 text-success"></i>
        <h5 class="mt-3">Kelola Kategori</h5>
        <p class="text-muted">Atur kategori usaha yang tersedia di sistem.</p>
        <a href="kategori/data.php" class="btn btn-success btn-sm">Kelola</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-body text-center">
        <i class="bi bi-graph-up display-4 text-warning"></i>
        <h5 class="mt-3">Laporan UMKM</h5>
        <p class="text-muted">Lihat data statistik dan laporan aktivitas UMKM.</p>
        <a href="laporan/laporan_umkm.php" class="btn btn-warning btn-sm text-white">Lihat</a>
      </div>
    </div>
  </div>
</div>

<?php
include('../includes/footer_admin.php');
?>


