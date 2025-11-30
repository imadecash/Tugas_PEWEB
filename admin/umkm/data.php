<?php
include('../check_login.php');
?>

<?php
include('../../config/database.php');
include('../../includes/header_admin.php');

// Pagination Logic
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Hitung total data
$total_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM umkm");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Query dengan Limit
$query = "SELECT umkm.*, kategori.nama_kategori 
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori
          ORDER BY id_umkm DESC
          LIMIT $start, $limit";

$result = mysqli_query($koneksi, $query);

// cek apakah query berhasil
if (!$result) {
    die("<div class='alert alert-danger mt-3'>Query gagal: " . mysqli_error($koneksi) . "</div>");
}
?>

<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark mb-1">Data UMKM</h4>
      <p class="text-muted small mb-0">Kelola data UMKM yang terdaftar</p>
    </div>
    <a href="tambah.php" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
      <i class="bi bi-plus-lg me-2"></i> Tambah UMKM
    </a>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4 d-flex justify-content-between align-items-center">
      <h5 class="fw-bold text-primary mb-0">Daftar UMKM</h5>
      <!-- Search bar removed -->
    </div>
    
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-secondary small fw-bold text-uppercase">UMKM</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Kategori</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Pemilik</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Kontak</th>
              <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
              <tr>
                <td class="px-4 py-3">
                  <div class="d-flex align-items-center">
                    <?php if ($row['foto']) { ?>
                      <img src="../../uploads/umkm/<?= $row['foto'] ?>" class="rounded-3 object-fit-cover me-3" width="48" height="48">
                    <?php } else { ?>
                      <div class="bg-light rounded-3 d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                        <i class="bi bi-shop text-muted"></i>
                      </div>
                    <?php } ?>
                    <div>
                      <h6 class="fw-bold text-dark mb-0"><?= htmlspecialchars($row['nama_umkm']) ?></h6>
                      <small class="text-muted">ID: #<?= $row['id_umkm'] ?></small>
                    </div>
                  </div>
                </td>
                <td class="py-3">
                  <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                    <?= htmlspecialchars($row['nama_kategori']) ?>
                  </span>
                </td>
                <td class="py-3">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                      <i class="bi bi-person-fill small"></i>
                    </div>
                    <span class="fw-medium text-dark"><?= htmlspecialchars($row['pemilik']) ?></span>
                  </div>
                </td>
                <td class="py-3">
                  <span class="text-muted"><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($row['kontak']) ?></span>
                </td>
                <td class="px-4 py-3 text-end">
                  <a href="edit.php?id=<?= $row['id_umkm'] ?>" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                  <a href="hapus.php?id=<?= $row['id_umkm'] ?>" 
                     class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                     onclick="return confirm('Yakin hapus data ini?')">
                     <i class="bi bi-trash"></i>
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

<?php include('../../includes/footer_admin.php'); ?>
