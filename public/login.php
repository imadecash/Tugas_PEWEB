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

if (isset($_POST['login'])) {
    $identity = mysqli_real_escape_string($koneksi, $_POST['identity']); // Bisa username atau email
    $password = $_POST['password'];

    // 1. Cek Login Admin (Username)
    $stmt_admin = mysqli_prepare($koneksi, "SELECT * FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt_admin, "s", $identity);
    mysqli_stmt_execute($stmt_admin);
    $result_admin = mysqli_stmt_get_result($stmt_admin);

    if ($row_admin = mysqli_fetch_assoc($result_admin)) {
        if (password_verify($password, $row_admin['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $row_admin['username'];
            session_regenerate_id(true);
            header("Location: ../admin/index.php");
            exit;
        }
    }

    // 2. Cek Login User (Email)
    if (!isset($_SESSION['admin_logged_in'])) {
        $stmt_user = mysqli_prepare($koneksi, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt_user, "s", $identity);
        mysqli_stmt_execute($stmt_user);
        $result_user = mysqli_stmt_get_result($stmt_user);

        if ($row_user = mysqli_fetch_assoc($result_user)) {
            if (password_verify($password, $row_user['password'])) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $row_user['id_user'];
                $_SESSION['user_name'] = $row_user['nama_lengkap'];
                session_regenerate_id(true);
                header("Location: index.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username atau Email tidak ditemukan!";
        }
    }
}

$title = "Login - UMKM Center";
include('../includes/header_public.php');
?>

<div class="container d-flex flex-column justify-content-center min-vh-100" style="padding-top: 100px; padding-bottom: 50px;">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-5">
      <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-5">
          <div class="text-center mb-4">
            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
              <i class="bi bi-person-fill fs-3"></i>
            </div>
            <h3 class="fw-bold text-dark">Selamat Datang</h3>
            <p class="text-muted small">Silakan login untuk melanjutkan</p>
          </div>

          <?php if (isset($error)): ?>
            <div class="alert alert-danger py-2 rounded-3 small text-center">
              <i class="bi bi-exclamation-circle me-1"></i> <?= $error ?>
            </div>
          <?php endif; ?>

          <form method="POST">
            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Email</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-person"></i></span>
                <input type="text" name="identity" class="form-control bg-light border-start-0 ps-0" placeholder="Masukkan email atau username" required>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold text-muted">Password</label>
              <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="loginPassword" class="form-control bg-light border-start-0 border-end-0 ps-0" placeholder="Masukkan password" required>
                <button class="btn btn-light border border-start-0 text-muted" type="button" onclick="togglePassword('loginPassword', 'loginPassIcon')">
                  <i class="bi bi-eye" id="loginPassIcon"></i>
                </button>
              </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill fw-bold py-2 mb-3 shadow-sm">
              Masuk Sekarang
            </button>
          </form>

          <div class="text-center">
            <p class="text-muted small mb-0">
              Belum punya akun? <a href="register.php" class="text-primary fw-bold text-decoration-none">Daftar disini</a>
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