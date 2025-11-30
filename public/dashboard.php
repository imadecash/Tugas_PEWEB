<?php
session_start();
include('../config/database.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['user_id'];
$success_msg = "";
$error_msg = "";

// Handle Update Profil
if (isset($_POST['update_profile'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    
    $query = "UPDATE users SET nama_lengkap = '$nama' WHERE id_user = '$id_user'";
    if (mysqli_query($koneksi, $query)) {
        $_SESSION['user_name'] = $nama; // Update session
        $success_msg = "Profil berhasil diperbarui!";
    } else {
        $error_msg = "Gagal memperbarui profil: " . mysqli_error($koneksi);
    }
}

// Handle Ganti Password
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari DB
    $query_user = mysqli_query($koneksi, "SELECT password FROM users WHERE id_user = '$id_user'");
    $user_data = mysqli_fetch_assoc($query_user);

    if (password_verify($current_password, $user_data['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_pass = mysqli_query($koneksi, "UPDATE users SET password = '$hashed_password' WHERE id_user = '$id_user'");
            
            if ($update_pass) {
                $success_msg = "Password berhasil diubah!";
            } else {
                $error_msg = "Gagal mengubah password.";
            }
        } else {
            $error_msg = "Konfirmasi password baru tidak sesuai.";
        }
    } else {
        $error_msg = "Password saat ini salah.";
    }
}

// Handle Update Ulasan
if (isset($_POST['update_review'])) {
    $id_ulasan = intval($_POST['id_ulasan']);
    $rating = intval($_POST['rating']);
    $komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);

    // Pastikan ulasan ini milik user yang login
    $check_owner = mysqli_query($koneksi, "SELECT * FROM ulasan WHERE id_ulasan = '$id_ulasan' AND id_user = '$id_user'");
    if (mysqli_num_rows($check_owner) > 0) {
        $update = mysqli_query($koneksi, "UPDATE ulasan SET rating = '$rating', komentar = '$komentar', tanggal = NOW() WHERE id_ulasan = '$id_ulasan'");
        if ($update) {
            $success_msg = "Ulasan berhasil diperbarui!";
        } else {
            $error_msg = "Gagal memperbarui ulasan: " . mysqli_error($koneksi);
        }
    } else {
        $error_msg = "Anda tidak memiliki akses untuk mengedit ulasan ini.";
    }
}

// Ambil data user terbaru
$query_view = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
$data = mysqli_fetch_assoc($query_view);

$title = "Dashboard User - UMKM Center";
include('../includes/header_public.php');
?>

<div class="container py-5 page-container-spacer">
  <div class="row justify-content-center">
    <div class="col-md-8">
      
      <div class="d-flex align-items-center mb-4">
        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px; font-size: 1.5rem;">
          <i class="bi bi-person"></i>
        </div>
        <div>
          <h2 class="fw-bold mb-0">Dashboard Saya</h2>
          <p class="text-muted mb-0">Kelola informasi akun Anda</p>
        </div>
      </div>

      <?php if ($success_msg): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="bi bi-check-circle-fill me-2"></i> <?= $success_msg ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if ($error_msg): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="bi bi-exclamation-circle-fill me-2"></i> <?= $error_msg ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold mb-0 text-primary">Edit Profil</h5>
        </div>
        <div class="card-body p-4">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Email (Tidak dapat diubah)</label>
              <input type="email" class="form-control bg-light" value="<?= htmlspecialchars($data['email']) ?>" readonly disabled>
            </div>
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_lengkap']) ?>" required>
            </div>
            <div class="text-end">
              <button type="submit" name="update_profile" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Perubahan</button>
            </div>
          </form>
        </div>
      </div>

      <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold mb-0 text-primary">Ganti Password</h5>
        </div>
        <div class="card-body p-4">
          <form method="POST">
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Password Saat Ini</label>
              <div class="input-group">
                <input type="password" name="current_password" id="dashCurrentPass" class="form-control border-end-0" required>
                <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('dashCurrentPass', 'dashCurrentIcon')">
                  <i class="bi bi-eye" id="dashCurrentIcon"></i>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Password Baru</label>
                <div class="input-group">
                  <input type="password" name="new_password" id="dashNewPass" class="form-control border-end-0" required>
                  <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('dashNewPass', 'dashNewIcon')">
                    <i class="bi bi-eye" id="dashNewIcon"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                <div class="input-group">
                  <input type="password" name="confirm_password" id="dashConfirmPass" class="form-control border-end-0" required>
                  <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('dashConfirmPass', 'dashConfirmIcon')">
                    <i class="bi bi-eye" id="dashConfirmIcon"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="text-end">
              <button type="submit" name="change_password" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Update Password</button>
            </div>
          </form>
        </div>
      </div>

      <!-- Riwayat Ulasan Section -->
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold mb-0 text-primary">Riwayat Ulasan Saya</h5>
        </div>
        <div class="card-body p-4">
          <?php
          $query_ulasan = mysqli_query($koneksi, "SELECT ulasan.*, umkm.nama_umkm FROM ulasan JOIN umkm ON ulasan.id_umkm = umkm.id_umkm WHERE ulasan.id_user = '$id_user' ORDER BY ulasan.tanggal DESC");
          
          if (mysqli_num_rows($query_ulasan) > 0):
            while ($row = mysqli_fetch_assoc($query_ulasan)):
          ?>
            <div class="border rounded-3 p-3 mb-3 bg-light">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <h6 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($row['nama_umkm']) ?></h6>
                  <small class="text-muted"><?= date('d M Y, H:i', strtotime($row['tanggal'])) ?></small>
                </div>
                <button class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editReviewModal" 
                        data-id="<?= $row['id_ulasan'] ?>"
                        data-rating="<?= $row['rating'] ?>"
                        data-komentar="<?= htmlspecialchars($row['komentar']) ?>">
                  <i class="bi bi-pencil-square me-1"></i> Edit
                </button>
              </div>
              <div class="text-warning mb-2 small">
                <?php for($i=0; $i<$row['rating']; $i++) echo "★"; ?>
                <?php for($i=0; $i<(5-$row['rating']); $i++) echo "☆"; ?>
              </div>
              <p class="mb-0 text-muted small"><?= nl2br(htmlspecialchars($row['komentar'])) ?></p>
            </div>
          <?php endwhile; else: ?>
            <div class="text-center py-4">
              <div class="text-muted mb-2"><i class="bi bi-chat-square-text fs-1 opacity-25"></i></div>
              <p class="text-muted small">Anda belum memberikan ulasan apapun.</p>
              <a href="daftar_umkm.php" class="btn btn-sm btn-primary rounded-pill px-3">Mulai Menjelajah</a>
            </div>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Edit Review Modal -->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom-0">
        <h5 class="modal-title fw-bold text-primary">Edit Ulasan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_ulasan" id="edit_id_ulasan">
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Rating</label>
            <select name="rating" id="edit_rating" class="form-select" required>
              <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
              <option value="4">⭐⭐⭐⭐ (Bagus)</option>
              <option value="3">⭐⭐⭐ (Cukup)</option>
              <option value="2">⭐⭐ (Kurang)</option>
              <option value="1">⭐ (Sangat Kurang)</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Komentar</label>
            <textarea name="komentar" id="edit_komentar" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer border-top-0">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="update_review" class="btn btn-primary rounded-pill px-4 fw-bold">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const editModal = document.getElementById('editReviewModal');
  if (editModal) {
    editModal.addEventListener('show.bs.modal', function(event) {
      const button = event.relatedTarget;
      const id = button.getAttribute('data-id');
      const rating = button.getAttribute('data-rating');
      const komentar = button.getAttribute('data-komentar');

      document.getElementById('edit_id_ulasan').value = id;
      document.getElementById('edit_rating').value = rating;
      document.getElementById('edit_komentar').value = komentar;
    });
  }
});
</script>

    </div>
  </div>
</div>

<?php include('../includes/footer_public.php'); ?>
