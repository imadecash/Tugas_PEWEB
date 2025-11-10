<?php
include('../config/database.php');
$id = $_GET['id'];
$query = mysqli_query($conn, "
  SELECT umkm.*, kategori.nama_kategori 
  FROM umkm 
  JOIN kategori ON umkm.id_kategori = kategori.id_kategori
  WHERE id_umkm = '$id'
");
$data = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html>
<head>
  <title>Detail UMKM - <?= $data['nama_umkm'] ?></title>
  <?php include('../includes/header.php'); ?>
<h2>Data UMKM</h2>
</head>
<body>
  <a href="index.php">← Kembali</a>
  <h1><?= $data['nama_umkm'] ?></h1>
  <img src="../uploads/umkm/<?= $data['foto'] ?>" width="250"><br>
  <strong>Pemilik:</strong> <?= $data['pemilik'] ?><br>
  <strong>Kategori:</strong> <?= $data['nama_kategori'] ?><br>
  <strong>Alamat:</strong> <?= $data['alamat'] ?><br>
  <strong>Kontak:</strong> <?= $data['kontak'] ?><br>
  <p><strong>Deskripsi:</strong> <?= $data['deskripsi'] ?></p>

  <!-- isi konten -->
<?php include('../includes/footer.php'); ?>
</body>
</html>

