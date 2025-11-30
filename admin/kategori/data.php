<?php
include('../check_login.php');
?>

<?php
include('../../config/database.php');

// Handle Update Kategori
if (isset($_POST['update_kategori'])) {
    $id_kategori = intval($_POST['id_kategori']);
    $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
    
    $update = mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'");
    
    if ($update) {
        echo "<script>alert('Kategori berhasil diperbarui!'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui kategori!');</script>";
    }
}

// Pagination Logic
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Hitung total data
$total_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM kategori");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Query dengan Limit
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori LIMIT $start, $limit");
?>

<?php include('../../includes/header_admin.php'); ?>

<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark mb-1">Data Kategori</h4>
      <p class="text-muted small mb-0">Kelola kategori usaha UMKM</p>
    </div>
    <a href="tambah.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
      <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
      <h5 class="fw-bold text-primary mb-0">Daftar Kategori</h5>
    </div>
    
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-secondary small fw-bold text-uppercase" width="10%">No</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Nama Kategori</th>
              <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase" width="20%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = $start + 1; 
            while($row = mysqli_fetch_assoc($kategori)) { 
            ?>
              <tr>
                <td class="px-4 py-3 text-center fw-bold text-muted"><?= $no++ ?></td>
                <td class="py-3">
                  <span class="fw-medium text-dark"><?= htmlspecialchars($row['nama_kategori']) ?></span>
                </td>
                <td class="px-4 py-3 text-end">
                  <button class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1"
                          data-bs-toggle="modal" 
                          data-bs-target="#editKategoriModal" 
                          data-id="<?= $row['id_kategori'] ?>"
                          data-nama="<?= htmlspecialchars($row['nama_kategori']) ?>">
                    <i class="bi bi-pencil-square"></i> Edit
                  </button>
                  <a href="hapus.php?id=<?= $row['id_kategori'] ?>" 
                     class="btn btn-sm btn-outline-danger rounded-pill px-3"
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
    <div class="card-footer bg-white border-top-0 py-3 px-4">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-end mb-0">
          <!-- Previous Link -->
          <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $page - 1 ?>"><i class="bi bi-chevron-left"></i></a>
          </li>
          
          <!-- Page Numbers -->
          <?php for($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
              <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          
          <!-- Next Link -->
          <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $page + 1 ?>"><i class="bi bi-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Edit Kategori Modal -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold text-primary">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_kategori" id="edit_id_kategori">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="edit_nama_kategori" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer border-top-0">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="update_kategori" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const editModal = document.getElementById('editKategoriModal');
  if (editModal) {
    editModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const nama = button.getAttribute('data-nama');

      document.getElementById('edit_id_kategori').value = id;
      document.getElementById('edit_nama_kategori').value = nama;
    });
  }
});
</script>

<?php include('../../includes/footer_admin.php'); ?>
