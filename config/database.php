<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_umkm");

// cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
