<?php
include('check_login.php');
include('../config/database.php');

$username = $_SESSION['admin_username'];
$success_msg = "";
$error_msg = "";

// Handle Ganti Password
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ambil password lama dari DB
    $stmt = mysqli_prepare($koneksi, "SELECT password FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $admin_data = mysqli_fetch_assoc($result);

    if (password_verify($current_password, $admin_data['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = mysqli_prepare($koneksi, "UPDATE admin SET password = ? WHERE username = ?");
            mysqli_stmt_bind_param($update_stmt, "ss", $hashed_password, $username);
            
            if (mysqli_stmt_execute($update_stmt)) {
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

include('../includes/header_admin.php');
?>

<div class="container-fluid px-4 py-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold text-primary"><i class="bi bi-gear-fill me-2"></i> Pengaturan Akun Admin</h5>
        </div>
        <div class="card-body p-4">
          
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

          <form method="POST">
            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Username</label>
              <input type="text" class="form-control bg-light" value="<?= htmlspecialchars($username) ?>" readonly disabled>
              <div class="form-text">Username tidak dapat diubah.</div>
            </div>

            <h6 class="fw-bold text-dark mb-3">Ganti Password</h6>
            
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Password Saat Ini</label>
              <div class="input-group">
                <input type="password" name="current_password" id="currentPass" class="form-control border-end-0" required>
                <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('currentPass', 'currentIcon')">
                  <i class="bi bi-eye" id="currentIcon"></i>
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Password Baru</label>
                <div class="input-group">
                  <input type="password" name="new_password" id="newPass" class="form-control border-end-0" required>
                  <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('newPass', 'newIcon')">
                    <i class="bi bi-eye" id="newIcon"></i>
                  </button>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Konfirmasi Password Baru</label>
                <div class="input-group">
                  <input type="password" name="confirm_password" id="confirmPass" class="form-control border-end-0" required>
                  <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePassword('confirmPass', 'confirmIcon')">
                    <i class="bi bi-eye" id="confirmIcon"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="text-end mt-3">
              <button type="submit" name="change_password" class="btn btn-primary rounded-pill px-4 fw-bold">
                <i class="bi bi-save me-1"></i> Simpan Perubahan
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

<?php include('../includes/footer_admin.php'); ?>
