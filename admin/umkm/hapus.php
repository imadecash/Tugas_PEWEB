<?php
include('../../config/database.php');
$id = intval($_GET['id']);

// Ambil nama file foto sebelum dihapus
$query = mysqli_query($koneksi, "SELECT foto FROM umkm WHERE id_umkm = $id");
$data = mysqli_fetch_assoc($query);

// Hapus file foto jika ada
if ($data && !empty($data['foto'])) {
    $file_path = "../../uploads/umkm/" . $data['foto'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

// Hapus data dari database
mysqli_query($koneksi, "DELETE FROM umkm WHERE id_umkm=$id");
header("Location: data.php");
?>
