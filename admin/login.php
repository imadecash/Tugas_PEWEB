<?php
session_start();
include('../config/database.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;

        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}

$title = "Login Admin";
$login_page = true;

// Header login
include '../includes/header_login.php';
?>

<div class="login-container">
  <div class="login-card">

    <h3 class="login-title">Login Admin</h3>
    <p class="login-subtitle">Masuk ke dashboard admin</p>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger py-2"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="input-group-custom">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>

        <div class="input-group-custom">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn-login">Masuk</button>
    </form>
  </div>
</div>