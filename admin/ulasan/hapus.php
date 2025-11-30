<?php
include('../../config/database.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $delete = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id_ulasan=$id");
    
    if ($delete) {
        echo "<script>alert('Ulasan berhasil dihapus!'); window.location='data.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus ulasan!'); window.location='data.php';</script>";
    }
} else {
    header("Location: data.php");
}
?>
