<?php
include('../../config/database.php');
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>

<?php include('../../includes/header_admin.php'); ?>

<!-- konten halaman di sini -->
 <h2>Data Kategori UMKM</h2>
<a href="tambah.php">+ Tambah Kategori</a>
<table border="1" cellpadding="8">
  <tr>
    <th>No</th>
    <th>Nama Kategori</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while($row = mysqli_fetch_assoc($kategori)) { ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama_kategori'] ?></td>
    <td>
      <a href="hapus.php?id=<?= $row['id_kategori'] ?>" onclick="return confirm('Hapus kategori ini?')">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>


<?php include('../../includes/footer_admin.php'); ?>