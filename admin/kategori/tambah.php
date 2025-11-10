<?php
include('../../config/database.php');

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_kategori'];
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    header("Location: data.php");
}
?>
<h2>Tambah Kategori UMKM</h2>
<form method="post">
  Nama Kategori: <input type="text" name="nama_kategori" required>
  <button type="submit" name="simpan">Simpan</button>
</form>
