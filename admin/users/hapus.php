<?php
include('../../config/database.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Hapus user (ulasan akan terhapus otomatis jika ada constraint CASCADE, tapi kita hapus manual untuk aman)
    mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_user=$id");
    $delete = mysqli_query($koneksi, "DELETE FROM users WHERE id_user=$id");
    
    if ($delete) {
        echo "<script>alert('Pengguna berhasil dihapus!'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pengguna!'); window.location='data.php';</script>";
    }
} else {
    header("Location: data.php");
}
?>
