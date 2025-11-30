<?php
include('../../config/database.php');
include('../check_login.php');

// Ambil data jumlah UMKM per kategori
$data = mysqli_query($koneksi, "
  SELECT kategori.nama_kategori, COUNT(umkm.id_umkm) AS total_umkm
  FROM kategori
  LEFT JOIN umkm ON kategori.id_kategori = umkm.id_kategori
  GROUP BY kategori.id_kategori
");

// Hitung total keseluruhan UMKM
$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM umkm"));
?>

<?php include('../../includes/header_admin.php'); ?>

<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark mb-1">Laporan UMKM</h4>
      <p class="text-muted small mb-0">Statistik jumlah UMKM berdasarkan kategori</p>
    </div>
    <a href="cetak_laporan.php" target="_blank" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
      <i class="bi bi-printer me-2"></i> Cetak PDF
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
      <h5 class="fw-bold text-primary mb-0">Data Statistik</h5>
    </div>
    
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-secondary small fw-bold text-uppercase" width="10%">No</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Kategori Usaha</th>
              <th class="px-4 py-3 text-center text-secondary small fw-bold text-uppercase" width="20%">Jumlah UMKM</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
              <tr>
                <td class="px-4 py-3 text-center fw-bold text-muted"><?= $no++ ?></td>
                <td class="py-3">
                  <span class="fw-medium text-dark"><?= htmlspecialchars($row['nama_kategori']) ?></span>
                </td>
                <td class="px-4 py-3 text-center">
                  <span class="badge bg-primary rounded-pill px-3"><?= $row['total_umkm'] ?> Unit</span>
                </td>
              </tr>
            <?php } ?>
          </tbody>
          <tfoot class="bg-light">
            <tr>
              <td colspan="2" class="px-4 py-3 text-end fw-bold text-dark">Total Keseluruhan</td>
              <td class="px-4 py-3 text-center fw-bold text-primary fs-5"><?= $total['total'] ?> Unit</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
    <div class="card-footer bg-white border-top-0 py-4 px-4 text-end">
      <a href="../index.php" class="btn btn-light rounded-pill px-4 fw-bold text-muted">
        <i class="bi bi-arrow-left me-2"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
