<?php
include('../config/database.php');

// Ambil semua data UMKM + kategori
$query = mysqli_query($conn, "
  SELECT umkm.*, kategori.nama_kategori 
  FROM umkm 
  JOIN kategori ON umkm.id_kategori = kategori.id_kategori
");
?>

<?php include('../includes/header.php'); ?>
<h2 class="text-center mb-4">Daftar UMKM Lokal</h2>
<div class="row">
  <?php while($row = mysqli_fetch_assoc($query)) { ?>
  <div class="col-md-3 mb-4">
    <div class="card umkm-card h-100">
      <img src="../uploads/umkm/<?= $row['foto'] ?>" class="card-img-top" alt="<?= $row['nama_umkm'] ?>">
      <div class="card-body text-center">
        <h5 class="card-title"><?= $row['nama_umkm'] ?></h5>
        <p class="text-muted small"><?= $row['nama_kategori'] ?></p>
        <a href="detail.php?id=<?= $row['id_umkm'] ?>" class="btn btn-sm btn-primary">Lihat Detail</a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<?php include('../includes/footer.php'); ?>

