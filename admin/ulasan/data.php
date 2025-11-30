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
$total_result = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM ulasan");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_pages = ceil($total_data / $limit);

// Query Data Ulasan
$query = "SELECT ulasan.*, users.nama_lengkap, umkm.nama_umkm 
          FROM ulasan 
          JOIN users ON ulasan.id_user = users.id_user 
          JOIN umkm ON ulasan.id_umkm = umkm.id_umkm 
          ORDER BY tanggal DESC 
          LIMIT $start, $limit";
$result = mysqli_query($koneksi, $query);
?>

<div class="container-fluid px-4 py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="fw-bold text-dark mb-1">Data Ulasan</h4>
      <p class="text-muted small mb-0">Kelola ulasan yang masuk</p>
    </div>
  </div>

  <div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
      <h5 class="fw-bold text-primary mb-0">Daftar Ulasan</h5>
    </div>
    
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="bg-light">
            <tr>
              <th class="px-4 py-3 text-secondary small fw-bold text-uppercase" width="5%">No</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Pengguna</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">UMKM</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase">Rating</th>
              <th class="py-3 text-secondary small fw-bold text-uppercase" width="30%">Komentar</th>
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
                  <span class="fw-bold text-dark"><?= htmlspecialchars($row['nama_lengkap']) ?></span>
                  <br>
                  <small class="text-muted"><?= date('d M Y', strtotime($row['tanggal'])) ?></small>
                </td>
                <td class="py-3">
                  <span class="badge bg-light text-dark border"><?= htmlspecialchars($row['nama_umkm']) ?></span>
                </td>
                <td class="py-3">
                  <div class="text-warning small">
                    <?php for($i=0; $i<$row['rating']; $i++) echo "<i class='bi bi-star-fill'></i>"; ?>
                  </div>
                </td>
                <td class="py-3 text-muted small">
                  <?= htmlspecialchars(substr($row['komentar'], 0, 100)) ?>...
                </td>
                <td class="px-4 py-3 text-end">
                  <a href="hapus.php?id=<?= $row['id_ulasan'] ?>" 
                     class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                     onclick="return confirm('Hapus ulasan ini?')">
                     <i class="bi bi-trash"></i> Hapus
                  </a>
                  <button type="button" 
                          class="btn btn-sm btn-outline-info rounded-pill px-3 ms-1" 
                          data-bs-toggle="modal" 
                          data-bs-target="#detailModal"
                          data-nama="<?= htmlspecialchars($row['nama_lengkap']) ?>"
                          data-umkm="<?= htmlspecialchars($row['nama_umkm']) ?>"
                          data-rating="<?= $row['rating'] ?>"
                          data-tanggal="<?= date('d M Y', strtotime($row['tanggal'])) ?>"
                          data-komentar="<?= htmlspecialchars($row['komentar']) ?>">
                     <i class="bi bi-eye"></i> Detail
                  </button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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

<!-- Modal Detail Ulasan -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0 shadow">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold" id="detailModalLabel">Detail Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-4 pb-4">
        <div class="mb-3">
          <label class="small text-muted text-uppercase fw-bold">Pengguna</label>
          <p class="fw-bold text-dark mb-0" id="modalNama"></p>
        </div>
        <div class="mb-3">
          <label class="small text-muted text-uppercase fw-bold">UMKM</label>
          <p class="fw-bold text-dark mb-0" id="modalUmkm"></p>
        </div>
        <div class="mb-3">
          <label class="small text-muted text-uppercase fw-bold">Tanggal</label>
          <p class="text-dark mb-0" id="modalTanggal"></p>
        </div>
        <div class="mb-3">
          <label class="small text-muted text-uppercase fw-bold">Rating</label>
          <div class="text-warning" id="modalRating"></div>
        </div>
        <div class="mb-0">
          <label class="small text-muted text-uppercase fw-bold">Komentar</label>
          <div class="p-3 bg-light rounded-3 mt-1">
            <p class="mb-0 text-secondary" id="modalKomentar"></p>
          </div>
        </div>
      </div>
      <div class="modal-footer border-top-0 px-4 pb-4">
        <button type="button" class="btn btn-primary rounded-pill px-4 w-100" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var detailModal = document.getElementById('detailModal');
  detailModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var nama = button.getAttribute('data-nama');
    var umkm = button.getAttribute('data-umkm');
    var rating = button.getAttribute('data-rating');
    var tanggal = button.getAttribute('data-tanggal');
    var komentar = button.getAttribute('data-komentar');

    var modalNama = detailModal.querySelector('#modalNama');
    var modalUmkm = detailModal.querySelector('#modalUmkm');
    var modalTanggal = detailModal.querySelector('#modalTanggal');
    var modalRating = detailModal.querySelector('#modalRating');
    var modalKomentar = detailModal.querySelector('#modalKomentar');

    modalNama.textContent = nama;
    modalUmkm.textContent = umkm;
    modalTanggal.textContent = tanggal;
    modalKomentar.textContent = komentar;

    // Generate stars
    var starsHtml = '';
    for (var i = 0; i < rating; i++) {
      starsHtml += '<i class="bi bi-star-fill"></i> ';
    }
    modalRating.innerHTML = starsHtml;
  });
});
</script>



<?php include('../../includes/footer_admin.php'); ?>
