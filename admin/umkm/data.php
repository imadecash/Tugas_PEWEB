<?php
include('../check_login.php');
?>

<?php
include('../../config/database.php');
include('../../includes/header_admin.php');

// jalankan query ambil data UMKM
$query = "SELECT umkm.*, kategori.nama_kategori 
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori";

$result = mysqli_query($koneksi, $query);

// cek apakah query berhasil
if (!$result) {
    die("<div class='alert alert-danger mt-3'>Query gagal: " . mysqli_error($koneksi) . "</div>");
}
?>

<div class="d-flex justify-content-between align-items-center mb-4 page-header">
  <h4 class="fw-semibold text-primary"><i class="bi bi-shop"></i> Data UMKM</h4>
  <a href="tambah.php" class="btn btn-sm btn-primary shadow-sm">
    <i class="bi bi-plus-circle"></i> Tambah Data
  </a>
</div>

<div class="table-responsive custom-table-wrapper">
<table class="table table-bordered table-striped align-middle mb-0 custom-table">
  <thead class="text-center">
    <tr>
      <th>No</th>
      <th>Nama UMKM</th>
      <th>Pemilik</th>
      <th>Kategori</th>
      <th>Kontak</th>
      <th>Foto</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_umkm']) ?></td>
        <td><?= htmlspecialchars($row['pemilik']) ?></td>
        <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
        <td><?= htmlspecialchars($row['kontak']) ?></td>
        <td class="text-center">
          <?php if ($row['foto']) { ?>
            <img src="../../uploads/umkm/<?= $row['foto'] ?>" class="umkm-img">
          <?php } else { ?>
            <span class="text-muted">-</span>
          <?php } ?>
        </td>
        <td class="text-center">
          <a href="edit.php?id=<?= $row['id_umkm'] ?>" class="btn btn-sm btn-warning text-white">
            <i class="bi bi-pencil-square"></i>
          </a>
          <a href="hapus.php?id=<?= $row['id_umkm'] ?>" 
             class="btn btn-sm btn-danger" 
             onclick="return confirm('Yakin hapus data ini?')">
             <i class="bi bi-trash"></i>
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>

<?php include('../../includes/footer_admin.php'); ?>
