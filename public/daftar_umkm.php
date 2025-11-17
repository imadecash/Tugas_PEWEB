<?php
include('../config/database.php');

// Title untuk header
$title = "Daftar UMKM Lokal";

// Ambil semua data UMKM + kategori
$query = "SELECT umkm.*, kategori.nama_kategori 
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori";
$result = mysqli_query($koneksi, $query);

// Include header
include('../includes/header_public.php');
?>

<link rel="stylesheet" href="../assets/css/style_umkm.css">

<div class="container my-5">

  <!-- Judul halaman -->
  <h2 class="text-center fw-bold mb-2">Daftar UMKM Lokal</h2>

  <!-- Deskripsi pembuka -->
  <p class="text-center text-muted mb-4">
    Temukan berbagai UMKM lokal dengan produk berkualitas yang siap Anda jelajahi.  
    Jelajahi usaha terbaik dari para pelaku UMKM di daerah Anda dan dukung perkembangan ekonomi lokal!
  </p>

  <!-- Tombol kembali -->
  <div class="text-center mb-4">
    <a href="../public/index.php" class="btn btn-primary btn-sm px-4">
      ← Kembali ke Beranda
    </a>
  </div>

  <div class="row g-4">

    <?php if (mysqli_num_rows($result) > 0): ?>
      <?php while ($row = mysqli_fetch_assoc($result)): ?>

        <div class="col-md-4 col-sm-6">
          <div class="card h-100 border-0 shadow-sm text-center umkm-card">

            <!-- Foto UMKM -->
            <?php if (!empty($row['foto'])): ?>
              <img src="../uploads/umkm/<?= htmlspecialchars($row['foto']) ?>" 
                   class="card-img-top umkm-img">
            <?php else: ?>
              <img src="../assets/img/no-image.png" 
                   class="card-img-top umkm-img">
            <?php endif; ?>

            <div class="card-body">
              <h5 class="card-title fw-bold text-primary">
                <?= htmlspecialchars($row['nama_umkm']) ?>
              </h5>

              <p class="text-muted small mb-3">
                Kategori: <?= htmlspecialchars($row['nama_kategori'] ?? 'Tidak ada kategori') ?>
              </p>

              <a href="detail.php?id=<?= $row['id_umkm'] ?>&from=daftar" 
                 class="btn btn-outline-primary btn-sm">
                Lihat Detail
              </a>
            </div>
          </div>
        </div>

      <?php endwhile; ?>

    <?php else: ?>
      <!-- Jika data kosong -->
      <div class="col-12 text-center">
        <div class="alert alert-warning">Belum ada data UMKM yang tersedia.</div>
      </div>
    <?php endif; ?>

  </div>
</div>

<?php include('../includes/footer_public.php'); ?>
