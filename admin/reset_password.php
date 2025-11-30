<?php
include('../config/database.php');

$message = "";

if (isset($_POST['reset'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah user ada
    $check = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        // Update password
        $query = "UPDATE admin SET password = '$hashed_password' WHERE username = '$username'";
        if (mysqli_query($koneksi, $query)) {
            $message = "<div class='alert alert-success'>Password berhasil diupdate! Silakan <a href='login.php'>Login disini</a>.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal update: " . mysqli_error($koneksi) . "</div>";
        }
    } else {
        // Buat user baru jika tidak ada
        $query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
        if (mysqli_query($koneksi, $query)) {
            $message = "<div class='alert alert-success'>User admin baru berhasil dibuat! Silakan <a href='login.php'>Login disini</a>.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Gagal membuat user: " . mysqli_error($koneksi) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header bg-warning text-dark fw-bold">
                Reset / Buat Password Admin
            </div>
            <div class="card-body">
                <p class="small text-muted">
                    Karena sistem keamanan baru, password lama (teks biasa) tidak akan berfungsi. 
                    Gunakan form ini untuk memperbarui password Anda menjadi format aman (hashed).
                </p>
                
                <?= $message ?>

                <form method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="admin" required>
                    </div>
                    <div class="mb-3">
                        <label>Password Baru</label>
                        <input type="text" name="password" class="form-control" placeholder="Masukkan password baru" required>
                    </div>
                    <button type="submit" name="reset" class="btn btn-primary w-100">Simpan Password Baru</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
