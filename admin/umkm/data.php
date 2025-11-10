<?php
include('../../config/database.php');
$result = mysqli_query($conn, "SELECT umkm.*, kategori.nama_kategori 
                               FROM umkm 
                               JOIN kategori ON umkm.id_kategori = kategori.id_kategori");
?>

<?php include('../../includes/header_admin.php'); ?>

<!-- konten halaman di sini -->
 <h2>Data UMKM</h2>
<a href="tambah.php">+ Tambah Data</a>
<table border="1" cellpadding="8">
  <tr>
    <th>No</th>
    <th>Nama UMKM</th>
    <th>Pemilik</th>
    <th>Kategori</th>
    <th>Kontak</th>
    <th>Aksi</th>
  </tr>
  <?php $no = 1; while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $row['nama_umkm'] ?></td>
    <td><?= $row['pemilik'] ?></td>
    <td><?= $row['nama_kategori'] ?></td>
    <td><?= $row['kontak'] ?></td>
    <td>
      <a href="edit.php?id=<?= $row['id_umkm'] ?>">Edit</a> | 
      <a href="hapus.php?id=<?= $row['id_umkm'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
  </tr>
  <?php } ?>
</table>

<?php include('../../includes/footer_admin.php'); ?>