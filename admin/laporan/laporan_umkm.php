<?php
include('../../config/database.php');
include('../check_login.php'); // keamanan login

// Ambil data jumlah UMKM per kategori
$data = mysqli_query($conn, "
  SELECT kategori.nama_kategori, COUNT(umkm.id_umkm) AS total_umkm
  FROM kategori
  LEFT JOIN umkm ON kategori.id_kategori = umkm.id_kategori
  GROUP BY kategori.id_kategori
");

// Hitung total keseluruhan UMKM
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM umkm"));
?>
<?php include('../../includes/header_admin.php'); ?>

<!-- konten halaman di sini -->
 <!DOCTYPE html>
<html>
<head>
  <title>Laporan Data UMKM</title>
</head>
<body>
  <h2>Laporan Data UMKM per Kategori</h2>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr>
      <th>No</th>
      <th>Kategori</th>
      <th>Jumlah UMKM</th>
    </tr>
    <?php $no=1; while($row = mysqli_fetch_assoc($data)) { ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= $row['nama_kategori'] ?></td>
      <td><?= $row['total_umkm'] ?></td>
    </tr>
    <?php } ?>
  </table>

  <h3>Total Keseluruhan UMKM: <?= $total['total'] ?></h3>

  <br>
  <a href="../index.php">← Kembali ke Dashboard</a>
  <!-- Opsional: Tombol Cetak -->
  <a href="cetak_laporan.php" target="_blank">🖨️ Cetak PDF</a>
</body>
</html>
 

<?php include('../../includes/footer_admin.php'); ?>