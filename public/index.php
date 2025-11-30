<?php 
session_start();
include('../config/database.php'); // Moved to top
$title = "UMKM Center - Solusi Digital Bisnis Lokal";
include('../includes/header_public.php'); 
?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-bg-shape"></div>
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
        <span class="text-primary fw-bold letter-spacing-1 mb-2 d-block">KATALOG DIGITAL UMKM</span>
        <h1 class="hero-title">Temukan Berbagai <br> <span class="text-primary">UMKM Terbaik</span> Disini</h1>
        <p class="hero-subtitle">
          Jelajahi ribuan produk dan jasa dari pelaku usaha lokal. Dukung ekonomi kerakyatan dengan membeli produk asli buatan anak bangsa.
        </p>
        <div class="d-flex gap-3">
          <a href="daftar_umkm.php" class="btn btn-primary rounded-pill px-4 py-3 fw-bold shadow-sm">
            Lihat Daftar UMKM
          </a>
          <a href="https://wa.me/6285242384100" class="btn btn-light rounded-pill px-4 py-3 fw-bold text-primary shadow-sm">
            <i class="bi bi-whatsapp me-2"></i> Gabung Mitra
          </a>
        </div>
      </div>
      <div class="col-lg-6 text-center">
        <div class="hero-img-container">
          <!-- Placeholder for 3D Illustration -->
          <img src="../assets/img/hero-umkm-removebg-preview.png" 
               alt="UMKM Illustration" class="hero-img rounded-4">
          
          <!-- Floating Badges -->
          <div class="floating-badge" style="top: 10%; left: -20px;">
            <div class="badge-icon"><i class="bi bi-shop"></i></div>
            <div>
              <small class="d-block text-muted">Total UMKM</small>
              <strong>500+ Terdaftar</strong>
            </div>
          </div>

          <div class="floating-badge" style="bottom: 20%; right: -20px; animation-delay: 1s;">
            <div class="badge-icon"><i class="bi bi-check-circle-fill text-success"></i></div>
            <div>
              <small class="d-block text-muted">Status</small>
              <strong>Terverifikasi</strong>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Info Cards Section -->
<section class="info-cards-section">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3 col-sm-6">
        <div class="info-card primary">
          <div class="icon-box"><i class="bi bi-search"></i></div>
          <h5 class="fw-bold mb-2">Cari Mudah</h5>
          <p class="small opacity-75 mb-3">Temukan UMKM berdasarkan kategori atau lokasi dengan cepat.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="info-card">
          <div class="icon-box"><i class="bi bi-shop-window"></i></div>
          <h5 class="fw-bold mb-2">Profil Lengkap</h5>
          <p class="small text-muted mb-3">Lihat detail produk, kontak, dan lokasi setiap UMKM.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="info-card">
          <div class="icon-box"><i class="bi bi-shield-check"></i></div>
          <h5 class="fw-bold mb-2">Terpercaya</h5>
          <p class="small text-muted mb-3">Data UMKM telah diverifikasi oleh admin kami.</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="info-card">
          <div class="icon-box"><i class="bi bi-person-plus"></i></div>
          <h5 class="fw-bold mb-2">Ingin Bergabung?</h5>
          <p class="small text-muted mb-3">Hubungi admin untuk mendaftarkan usaha Anda disini.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- About Section -->
<section id="tentang" class="section-padding bg-white">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <img src="https://img.freepik.com/free-vector/local-shop-concept-illustration_114360-6836.jpg" 
             alt="Tentang UMKM Center" class="img-fluid rounded-4 shadow-sm">
      </div>
      <div class="col-lg-6">
        <span class="section-sub">TENTANG KAMI</span>
        <h2 class="section-head-title mb-4">Wadah Digital untuk UMKM Lokal</h2>
        <p class="text-muted mb-4">
          Website ini didedikasikan khusus untuk menampilkan profil usaha mikro, kecil, dan menengah (UMKM). Pengunjung dapat dengan mudah mencari informasi mengenai berbagai usaha lokal yang ada.
        </p>
        <p class="text-muted mb-4">
          <strong>Catatan:</strong> Website ini hanya berfungsi sebagai katalog informasi. Kami tidak melayani pendaftaran mandiri. Jika Anda pemilik UMKM dan ingin usaha Anda ditampilkan, silakan hubungi admin kami untuk proses verifikasi dan pendaftaran.
        </p>
        
        <ul class="list-unstyled mb-4">
          <li class="d-flex align-items-center mb-3">
            <i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i>
            <span>Informasi UMKM Terpusat</span>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i>
            <span>Membantu Promosi Usaha Lokal</span>
          </li>
          <li class="d-flex align-items-center mb-3">
            <i class="bi bi-check-circle-fill text-primary me-3 fs-5"></i>
            <span>Gratis untuk Pengunjung</span>
          </li>
        </ul>

        <a href="https://wa.me/6281234567890" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">Hubungi Admin</a>
      </div>
    </div>
  </div>
</section>

<!-- Categories Section -->
<section id="kategori" class="section-padding">
  <div class="container">
    <div class="section-header">
      <span class="section-sub">Kategori Produk</span>
      <h2 class="section-head-title">Jelajahi Berdasarkan Kategori</h2>
    </div>

    <div class="row g-4 justify-content-center">
      <?php
      // Query Kategori berdasarkan jumlah UMKM terbanyak
      $kategori_query = mysqli_query($koneksi, "SELECT k.*, COUNT(u.id_umkm) as jumlah_umkm 
                                              FROM kategori k 
                                              LEFT JOIN umkm u ON k.id_kategori = u.id_kategori 
                                              GROUP BY k.id_kategori 
                                              ORDER BY jumlah_umkm DESC LIMIT 5");
      
      while ($kat = mysqli_fetch_assoc($kategori_query)):
        // Mapping Icon berdasarkan nama kategori (Case Insensitive)
        $icon = 'bi-grid'; // Default icon
        $nama_kat = strtolower($kat['nama_kategori']);
        
        if (strpos($nama_kat, 'kuliner') !== false || strpos($nama_kat, 'makan') !== false) {
            $icon = 'bi-cup-hot';
        } elseif (strpos($nama_kat, 'fashion') !== false || strpos($nama_kat, 'baju') !== false) {
            $icon = 'bi-gem';
        } elseif (strpos($nama_kat, 'kerajinan') !== false || strpos($nama_kat, 'craft') !== false) {
            $icon = 'bi-scissors';
        } elseif (strpos($nama_kat, 'jasa') !== false || strpos($nama_kat, 'service') !== false) {
            $icon = 'bi-laptop';
        } elseif (strpos($nama_kat, 'tani') !== false || strpos($nama_kat, 'agro') !== false) {
            $icon = 'bi-flower1';
        }
      ?>
      <div class="col-lg-2 col-md-4 col-6">
        <a href="daftar_umkm.php?kategori=<?= $kat['id_kategori'] ?>" class="text-decoration-none text-dark">
          <div class="service-card">
            <div class="service-icon"><i class="bi <?= $icon ?>"></i></div>
            <h6 class="fw-bold"><?= htmlspecialchars($kat['nama_kategori']) ?></h6>
            <small class="text-muted"><?= $kat['jumlah_umkm'] ?> UMKM</small>
          </div>
        </a>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
</section>

<!-- Features Banner -->
<section class="container">
  <div class="features-banner">
    <div class="row align-items-center">
      <div class="col-md-7">
        <h2>Punya Usaha UMKM?</h2>
        <p class="mb-4 opacity-75">
          Mari bergabung bersama kami agar usaha Anda lebih dikenal luas. Hubungi admin kami sekarang juga untuk mendaftarkan profil usaha Anda ke dalam website ini.
        </p>
        <a href="https://wa.me/6281234567890" class="btn btn-light text-primary rounded-pill px-4 py-2 fw-bold">
          <i class="bi bi-whatsapp me-2"></i> Hubungi Admin
        </a>
      </div>
      <div class="col-md-5 text-center d-none d-md-block">
        <i class="bi bi-megaphone-fill" style="font-size: 8rem; opacity: 0.8;"></i>
      </div>
    </div>
  </div>
</section>

<!-- Latest UMKM Section -->
<section class="section-padding bg-light">
  <div class="container">
    <div class="section-header">
      <span class="section-sub">Mitra Terbaru</span>
      <h2 class="section-head-title">UMKM Pilihan Kami</h2>
    </div>

    <div class="row g-4">
      <?php
      // include('../config/database.php'); // Already included at top
      $query = mysqli_query($koneksi, "SELECT umkm.*, kategori.nama_kategori, AVG(ulasan.rating) as avg_rating 
                                     FROM umkm 
                                     LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori 
                                     LEFT JOIN ulasan ON umkm.id_umkm = ulasan.id_umkm 
                                     GROUP BY umkm.id_umkm 
                                     ORDER BY id_umkm DESC LIMIT 3");

      if (mysqli_num_rows($query) > 0):
        while ($row = mysqli_fetch_assoc($query)):
      ?>
      <div class="col-md-4">
        <div class="umkm-card">
          <div class="umkm-img-wrapper">
            <img src="../uploads/umkm/<?= $row['foto'] ?>" alt="<?= $row['nama_umkm'] ?>" class="umkm-img">
          </div>
          <h5 class="umkm-name"><?= $row['nama_umkm'] ?></h5>
          <p class="umkm-category"><?= htmlspecialchars($row['nama_kategori'] ?? 'Umum') ?></p>
          
          <!-- Rating Bintang -->
          <div class="mb-3 text-warning small">
            <?php 
            $rating = $row['avg_rating'] ? round($row['avg_rating'], 1) : 0;
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    echo '<i class="bi bi-star-fill"></i>';
                } elseif ($i - 0.5 <= $rating) {
                    echo '<i class="bi bi-star-half"></i>';
                } else {
                    echo '<i class="bi bi-star"></i>';
                }
            }
            ?>
            <span class="text-muted ms-1">(<?= $rating ?>)</span>
          </div>

          <div class="d-flex justify-content-center gap-2 mb-4">
            <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="bi bi-instagram"></i></a>
            <a href="#" class="btn btn-sm btn-light rounded-circle"><i class="bi bi-whatsapp"></i></a>
          </div>
          <a href="detail.php?id=<?= $row['id_umkm'] ?>&from=index" class="btn btn-outline-custom mb-4">Lihat Detail</a>
        </div>
      </div>
      <?php endwhile; else: ?>
      <div class="col-12 text-center">
        <p class="text-muted">Belum ada data UMKM.</p>
      </div>
      <?php endif; ?>
    </div>
    
    <div class="text-center mt-5">
      <a href="daftar_umkm.php" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">Lihat Semua UMKM</a>
    </div>
  </div>
</section>

<?php include('../includes/footer_public.php'); ?>
