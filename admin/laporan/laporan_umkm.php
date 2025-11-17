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
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
      <i class="bi bi-graph-up"></i> Laporan Data UMKM per Kategori
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle laporan-table">
          <thead class="table-primary text-center">
            <tr>
              <th width="10%">No</th>
              <th>Kategori</th>
              <th>Jumlah UMKM</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td class="text-center fw-bold text-primary"><?= $row['total_umkm'] ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="mt-4">
        <h5 class="fw-bold text-end text-dark">
          Total Keseluruhan UMKM:
          <span class="text-primary"><?= $total['total'] ?></span>
        </h5>
      </div>

      <div class="mt-4 laporan-actions">
        <a href="../index.php" class="btn btn-secondary">
          <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
        <a href="cetak_laporan.php" target="_blank" class="btn btn-success">
          <i class="bi bi-printer"></i> Cetak PDF
        </a>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
