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
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold text-primary mb-0">Tambah Kategori Baru</h5>
        </div>
        <div class="card-body p-4">
          <form method="post" class="form-kategori">
            <div class="mb-4">
              <label for="nama_kategori" class="form-label small fw-bold text-muted">Nama Kategori</label>
              <input type="text" name="nama_kategori" id="nama_kategori" 
                     class="form-control bg-light" placeholder="Masukkan nama kategori" required>
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="data.php" class="btn btn-light rounded-pill px-4 fw-bold">
                Batal
              </a>
              <button type="submit" name="simpan" class="btn btn-primary rounded-pill px-4 fw-bold">
                Simpan Data
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
