<?php
session_start();
include('../config/database.php');

if (isset($_SESSION['user_logged_in'])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: ../admin/index.php");
    exit;
}

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak sesuai!";
    } else {
        // Cek email sudah ada atau belum
        $check = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email sudah terdaftar!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama', '$email', '$hashed_password')";
            
            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
                exit;
            } else {
                $error = "Terjadi kesalahan: " . mysqli_error($koneksi);
            }
        }
    }
}

$title = "Daftar Akun - UMKM Center";
include('../includes/header_public.php');
?>

<div class="container d-flex flex-column justify-content-center min-vh-100" style="padding-top: 100px; padding-bottom: 50px;">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6 col-lg-5">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
              <i class="bi bi-person-plus-fill fs-3"></i>
            </div>
            <h3 class="fw-bold text-dark">Buat Akun Baru</h3>
            <p class="text-muted small">Bergabunglah dengan komunitas UMKM kami</p>
          </div>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger py-2 rounded-3 small text-center">
              <i class="bi bi-exclamation-circle me-1"></i> <?= $error ?>
            </div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                <input type="text" name="nama" class="form-control bg-light border-start-0 ps-0" placeholder="Nama lengkap Anda" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Email</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control bg-light border-start-0 ps-0" placeholder="Alamat email aktif" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="regPassword" class="form-control bg-light border-start-0 border-end-0 ps-0" placeholder="Buat password" required>
                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('regPassword', 'regPassIcon')">
                  <i class="bi bi-eye" id="regPassIcon"></i>
                </button>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Konfirmasi Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-check-circle"></i></span>
                <input type="password" name="confirm_password" id="regConfirmPassword" class="form-control bg-light border-start-0 border-end-0 ps-0" placeholder="Ulangi password" required>
                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('regConfirmPassword', 'regConfirmPassIcon')">
                  <i class="bi bi-eye" id="regConfirmPassIcon"></i>
                </button>
              </div>
            </div>

            <button type="submit" name="register" class="btn btn-primary w-100 rounded-pill fw-bold py-2 mb-3 shadow-sm">
              Daftar Sekarang
            </button>
          </form>
          <div class="text-center">
            <p class="text-muted small mb-0">
              Sudah punya akun? <a href="login.php" class="text-primary fw-bold text-decoration-none">Login disini</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
$hide_footer = true;
include('../includes/footer_public.php'); 
?>
