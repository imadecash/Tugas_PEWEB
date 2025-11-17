<?php
include('../check_login.php');
?>

<?php
include('../../config/database.php');
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
?>

<?php include('../../includes/header_admin.php'); ?>

<div class="container-fluid px-4 py-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
      <i class="bi bi-tags"></i> Data Kategori UMKM
    </div>
    <div class="card-body">
      <div class="mb-3 text-end">
        <a href="tambah.php" class="btn btn-primary">
          <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center kategori-table">
          <thead class="table-primary">
            <tr>
              <th width="10%">No</th>
              <th>Nama Kategori</th>
              <th width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($kategori)) { ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                <td>
                  <a href="hapus.php?id=<?= $row['id_kategori'] ?>" 
                     class="btn btn-sm btn-danger"
                     onclick="return confirm('Hapus kategori ini?')">
                     <i class="bi bi-trash"></i> Hapus
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
