<?php
include('../../config/database.php');

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_kategori'];
    mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: data.php");
    exit;
}

include('../../includes/header_admin.php');
?>

<div class="container-fluid px-4 py-4">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
      <i class="bi bi-plus-circle"></i> Tambah Kategori UMKM
    </div>
    <div class="card-body">
      <form method="post" class="form-kategori">
        <div class="mb-3">
          <label for="nama_kategori" class="form-label">Nama Kategori</label>
          <input type="text" name="nama_kategori" id="nama_kategori" 
                 class="form-control input-kategori" placeholder="Masukkan nama kategori" required>
        </div>

        <div class="text-end">
          <a href="data.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
          </a>
          <button type="submit" name="simpan" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
