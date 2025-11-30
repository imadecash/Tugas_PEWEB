<?php
include('../check_login.php');
include('../../config/database.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    
    $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id'");
    
    if ($update) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal update data!');</script>";
    }
}

include('../../includes/header_admin.php');
?>

<div class="container-fluid px-4 py-4">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold text-primary mb-0">Edit Kategori</h5>
        </div>
        <div class="card-body p-4">
          <form method="POST">
            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Nama Kategori</label>
              <input type="text" name="nama_kategori" class="form-control bg-light" value="<?= htmlspecialchars($data['nama_kategori']) ?>" required>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
              <a href="data.php" class="btn btn-light rounded-pill px-4 fw-bold">Batal</a>
              <button type="submit" name="update" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
