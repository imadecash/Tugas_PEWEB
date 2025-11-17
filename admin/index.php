<?php
include('check_login.php');
include('../includes/header_admin.php');
?>

<div class="dashboard-welcome alert shadow-sm p-4">
  <h4 class="fw-bold mb-2"><i class="bi bi-person-circle"></i> Selamat Datang, Admin!</h4>
  <p class="m-0">Gunakan menu di samping kiri untuk mengelola data UMKM, kategori, dan laporan.</p>
</div>

<div class="row g-4 mt-3">

  <!-- CARD 1 -->
  <div class="col-md-4 col-sm-6">
    <div class="dash-card shadow-sm">
      <div class="dash-icon bg-primary bg-opacity-10 text-primary">
        <i class="bi bi-shop"></i>
      </div>

      <h5 class="mt-3">Kelola Data UMKM</h5>
      <p class="text-muted">Tambah, ubah, dan hapus data UMKM.</p>

      <a href="umkm/data.php" class="btn btn-primary w-100 mt-auto">Kelola</a>
    </div>
  </div>

  <!-- CARD 2 -->
  <div class="col-md-4 col-sm-6">
    <div class="dash-card shadow-sm">
      <div class="dash-icon bg-success bg-opacity-10 text-success">
        <i class="bi bi-tags"></i>
      </div>

      <h5 class="mt-3">Kelola Kategori</h5>
      <p class="text-muted">Atur kategori usaha.</p>

      <a href="kategori/data.php" class="btn btn-success w-100 mt-auto">Kelola</a>
    </div>
  </div>

  <!-- CARD 3 -->
  <div class="col-md-4 col-sm-6">
    <div class="dash-card shadow-sm">
      <div class="dash-icon bg-warning bg-opacity-10 text-warning">
        <i class="bi bi-graph-up"></i>
      </div>

      <h5 class="mt-3">Laporan UMKM</h5>
      <p class="text-muted">Lihat laporan kegiatan UMKM.</p>

      <a href="laporan/laporan_umkm.php" class="btn btn-warning text-white w-100 mt-auto">Lihat</a>
    </div>
  </div>

</div>

<?php
include('../includes/footer_admin.php');
?>
