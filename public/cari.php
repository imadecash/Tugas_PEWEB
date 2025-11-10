<?php
include('../config/database.php');
$q = $_GET['q'];

$query = mysqli_query($conn, "
  SELECT umkm.*, kategori.nama_kategori 
  FROM umkm 
  JOIN kategori ON umkm.id_kategori = kategori.id_kategori
  WHERE umkm.nama_umkm LIKE '%$q%' 
     OR kategori.nama_kategori LIKE '%$q%'
");
?>

<?php include('../includes/header.php'); ?>
<h2>Data UMKM</h2>
<!-- isi konten -->
<?php include('../includes/footer.php'); ?>

<h1>Hasil Pencarian: "<?= htmlspecialchars($q) ?>"</h1>
<a href="index.php">← Kembali ke Daftar</a>
<hr>

<?php if (mysqli_num_rows($query) > 0) { ?>
  <?php while($row = mysqli_fetch_assoc($query)) { ?>
    <div style="margin-bottom:20px;">
      <img src="../uploads/umkm/<?= $row['foto'] ?>" width="150"><br>
      <strong><?= $row['nama_umkm'] ?></strong><br>
      <small>Kategori: <?= $row['nama_kategori'] ?></small><br>
      <a href="detail.php?id=<?= $row['id_umkm'] ?>">Lihat Detail</a>
    </div>
  <?php } ?>
<?php } else { ?>
  <p><em>Data tidak ditemukan.</em></p>
<?php } ?>
