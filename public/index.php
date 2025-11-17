<?php 
$title = "Dashboard UMKM Lokal";
include('../includes/header_public.php'); 
?>

<section class="hero-fullscreen" style="background-image: url('../assets/img/download.jpeg');">
  <div class="hero-content">
    <h1 class="fw-bold mb-3">Selamat Datang di UMKM Lokal</h1>
    <p class="lead mb-4" style="max-width:700px; margin:auto;">
      Temukan berbagai UMKM terbaik di sekitar Anda. Dukung inovasi dan kreativitas pelaku usaha lokal
      untuk meningkatkan perekonomian masyarakat.
    </p>
    <a href="daftar_umkm.php" class="btn btn-primary btn-lg rounded-pill px-4">
      <i class="bi bi-shop"></i> Jelajahi UMKM
    </a>
  </div>
</section>


<section class="py-5 fade-top fit-screen">
  <div class="container">
    <h2 class="text-center fw-bold mb-5">Mengapa Memilih UMKM Lokal?</h2>
    
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <i class="bi bi-people fs-1 text-primary mb-3"></i>
          <h5 class="fw-bold mb-2">Mendukung Ekonomi Masyarakat</h5>
          <p class="text-muted">Setiap transaksi Anda berkontribusi langsung pada perkembangan usaha kecil di sekitar Anda.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <i class="bi bi-bag-check fs-1 text-primary mb-3"></i>
          <h5 class="fw-bold mb-2">Produk Asli & Berkualitas</h5>
          <p class="text-muted">UMKM lokal menawarkan berbagai produk kreatif, unik, dan terjamin kualitasnya.</p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <i class="bi bi-geo-alt fs-1 text-primary mb-3"></i>
          <h5 class="fw-bold mb-2">Dekat & Mudah Diakses</h5>
          <p class="text-muted">Cari UMKM terdekat dan dapatkan produk dengan cepat tanpa harus menunggu lama.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Daftar UMKM Terbaru -->
<section class="full-screen-section bg-light">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h3 class="fw-bold">UMKM Terbaru</h3>
      <a href="daftar_umkm.php" class="text-primary">Lihat Semua <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="row g-4">

      <?php
      include('../config/database.php');
      $query = mysqli_query($koneksi, "SELECT * FROM umkm ORDER BY id_umkm DESC LIMIT 3");

      if (mysqli_num_rows($query) > 0):
        while ($row = mysqli_fetch_assoc($query)):
      ?>

      <div class="col-md-4 col-sm-6">
        <div class="card border-0 shadow-sm h-100">
          <img src="../uploads/umkm/<?= $row['foto'] ?>" 
               class="card-img-top" 
               alt="<?= $row['nama_umkm'] ?>"
               style="height:200px; object-fit:cover;">

          <div class="card-body text-center">
            <h5 class="fw-bold text-primary"><?= $row['nama_umkm'] ?></h5>
            <a href="detail.php?id=<?= $row['id_umkm'] ?>&from=index" class="btn btn-outline-primary btn-sm mt-2">Lihat Detail</a>
          </div>
        </div>
      </div>

      <?php endwhile; else: ?>

      <div class="col-12 text-center">
        <div class="alert alert-warning">Belum ada UMKM yang ditambahkan.</div>
      </div>

      <?php endif; ?>

    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-fullscreen d-flex align-items-center text-center">
  <div class="container">
    <h3 class="fw-bold mb-3">Punya UMKM dan Ingin Ditampilkan?</h3>

    <p class="text-muted mb-2 contact-text">
      Hubungi Admin: <strong>+6208665544</strong>
    </p>

    <p class="text-muted mb-3 desc-text">
      Tingkatkan visibilitas usaha Anda dan buat lebih banyak orang mengenal produk lokal Anda.
    </p>

    <p class="text-muted mb-4 desc-text">
      Bergabunglah bersama ratusan UMKM yang sudah memanfaatkan platform ini untuk mempromosikan produk mereka secara gratis.
      Daftarkan UMKM Anda sekarang dan jadikan bisnis Anda semakin berkembang.
    </p>
  </div>
</section>

<?php include('../includes/footer_public.php'); ?>
