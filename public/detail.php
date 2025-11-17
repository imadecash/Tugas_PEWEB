<?php
include('../config/database.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$from = $_GET['from'] ?? 'index';

$id = intval($_GET['id']);
$query = "SELECT umkm.*, kategori.nama_kategori 
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori 
          WHERE id_umkm = $id";
$result = mysqli_query($koneksi, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("<div class='container mt-5'><div class='alert alert-danger'>Data UMKM tidak ditemukan.</div></div>");
}

$data = mysqli_fetch_assoc($result);
?>

<body class="bg-light d-flex flex-column min-vh-100">

<?php 
$title = "Detail UMKM Lokal";
include('../includes/header_public.php'); 
?>

<main class="flex-fill"> 
<div class="container my-5">
  <div class="card shadow-sm border-0">
    <div class="row g-0 align-items-center">
      <div class="col-md-5 text-center p-3">
        <img src="../uploads/umkm/<?= htmlspecialchars($data['foto']) ?>" class="img-fluid rounded shadow-sm" style="max-height:280px; object-fit:cover;">
      </div>

      <div class="col-md-7">
        <div class="card-body">
          <h3 class="card-title text-primary"><?= htmlspecialchars($data['nama_umkm']) ?></h3>
          <p><strong>Pemilik:</strong> <?= htmlspecialchars($data['pemilik']) ?></p>
          <p><strong>Kategori:</strong> <?= htmlspecialchars($data['nama_kategori']) ?></p>
          <p><strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?></p>
          <p><strong>Kontak:</strong> <?= htmlspecialchars($data['kontak']) ?></p>
          <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>

          <?php if (!empty($data['link_maps'])): ?>
            <a href="<?= htmlspecialchars($data['link_maps']) ?>" target="_blank" class="btn btn-outline-success mt-2">
              <i class="bi bi-geo-alt"></i> Lihat Lokasi
            </a>
          <?php endif; ?>

          <?php if ($from == 'daftar'): ?>
              <a href="daftar_umkm.php" class="btn btn-secondary mt-2">
                  <i class="bi bi-arrow-left"></i> Kembali
              </a>
          <?php else: ?>
              <a href="index.php" class="btn btn-secondary mt-2">
                  <i class="bi bi-arrow-left"></i> Kembali
              </a>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>
</div>
</main>

<?php include('../includes/footer_public.php'); ?>
</body>
