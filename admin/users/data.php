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
$total_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Query Data Users
$query = "SELECT * FROM users ORDER BY id_user DESC LIMIT $start, $limit";
$result = mysqli_query($koneksi, $query);
?>

<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark mb-1">Data Pengguna</h4>
      <p class="text-muted small mb-0">Kelola data pengguna terdaftar</p>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
      <h5 class="fw-bold text-primary mb-0">Daftar Pengguna</h5>
    </div>
    
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-secondary small fw-bold text-uppercase" width="5%">No</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Nama Lengkap</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Email</th>
              <th class="px-4 py-3 text-end text-secondary small fw-bold text-uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = $start + 1;
            while ($row = mysqli_fetch_assoc($result)) { 
            ?>
              <tr>
                <td class="px-4 py-3 text-center fw-bold text-muted"><?= $no++ ?></td>
                <td class="py-3">
                  <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                      <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="fw-bold text-dark"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                  </div>
                </td>
                <td class="py-3 text-muted"><?= htmlspecialchars($row['email']) ?></td>
                <td class="px-4 py-3 text-end">
                  <a href="hapus.php?id=<?= $row['id_user'] ?>" 
                     class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                     onclick="return confirm('Yakin hapus pengguna ini? Semua ulasan mereka juga akan terhapus.')">
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
          <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $page - 1 ?>"><i class="bi bi-chevron-left"></i></a>
          </li>
          <?php for($i = 1; $i <= $total_pages; $i++) : ?>
            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
              <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
          <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link border-0 rounded-circle mx-1" href="?page=<?= $page + 1 ?>"><i class="bi bi-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
