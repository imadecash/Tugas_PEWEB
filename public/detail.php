<?php
session_start();
include('../config/database.php');

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$from = $_GET['from'] ?? 'index';
$back_link = ($from == 'daftar') ? 'daftar_umkm.php' : 'index.php';

$id = intval($_GET['id']);
$query = "SELECT umkm.*, kategori.nama_kategori, AVG(ulasan.rating) as avg_rating, COUNT(ulasan.id_ulasan) as total_reviews
          FROM umkm 
          LEFT JOIN kategori ON umkm.id_kategori = kategori.id_kategori 
          LEFT JOIN ulasan ON umkm.id_umkm = ulasan.id_umkm
          WHERE umkm.id_umkm = $id
          GROUP BY umkm.id_umkm";
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
<div class="container py-4 page-container-spacer">
  
  <!-- Header Section with Back Button -->
  <div class="position-relative mb-5 text-center">
    <!-- Back Button (Absolute Left) -->
    <a href="<?= $back_link ?>" class="btn btn-light text-primary rounded-circle shadow-sm position-absolute start-0 top-50 translate-middle-y d-none d-md-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border: 1px solid #eee;" title="Kembali">
      <i class="bi bi-arrow-left fs-4"></i>
    </a>
    
    <!-- Mobile Back Button -->
    <div class="d-md-none text-start mb-3">
       <a href="<?= $back_link ?>" class="btn btn-light text-primary rounded-circle shadow-sm" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
        <i class="bi bi-arrow-left"></i>
      </a>
    </div>

    <!-- Title & Subtitle -->
    <div class="d-inline-block position-relative">
      <h2 class="fw-bold mb-2 display-6">Detail UMKM</h2>
      <div class="d-flex justify-content-center mb-3">
        <div style="height: 4px; width: 60px; background: var(--primary-color); border-radius: 2px;"></div>
      </div>
      <p class="text-muted mx-auto" style="max-width: 600px; font-size: 1.05rem;">
        Informasi lengkap mengenai produk dan layanan UMKM.
      </p>
    </div>
  </div>

  <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
    <div class="row g-0 align-items-center">
      <div class="col-md-5 text-center p-4 bg-light">
        <img src="../uploads/umkm/<?= htmlspecialchars($data['foto']) ?>" class="img-fluid rounded-4 shadow-sm" style="max-height:350px; object-fit:cover; width: 100%;">
      </div>

      <div class="col-md-7">
        <div class="card-body p-4 p-lg-5">
          <div class="d-flex align-items-center mb-3">
            <span class="badge bg-primary rounded-pill px-3 py-2 me-2"><?= htmlspecialchars($data['nama_kategori']) ?></span>
            <div class="text-warning small">
              <?php 
              $rating = $data['avg_rating'] ? round($data['avg_rating'], 1) : 0;
              $reviews = $data['total_reviews'];
              
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
          </div>

          <h2 class="card-title fw-bold text-dark mb-3"><?= htmlspecialchars($data['nama_umkm']) ?></h2>
          
          <div class="mb-4">
            <p class="mb-2 text-muted"><i class="bi bi-person-circle me-2 text-primary"></i> <strong>Pemilik:</strong> <?= htmlspecialchars($data['pemilik']) ?></p>
            <p class="mb-2 text-muted"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> <strong>Alamat:</strong> <?= htmlspecialchars($data['alamat']) ?></p>
            <p class="mb-2 text-muted"><i class="bi bi-telephone-fill me-2 text-primary"></i> <strong>Kontak:</strong> <?= htmlspecialchars($data['kontak']) ?></p>
          </div>

          <div class="mb-4">
            <h6 class="fw-bold text-dark">Deskripsi:</h6>
            <p class="text-muted" style="line-height: 1.8;"><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>
          </div>

          <?php if (!empty($data['link_maps'])): ?>
            <a href="<?= htmlspecialchars($data['link_maps']) ?>" target="_blank" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">
              <i class="bi bi-map me-2"></i> Lihat Lokasi di Maps
            </a>
          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>

  <!-- Bagian Ulasan -->
  <div class="row mt-4 mb-5">
    <div class="col-md-8 mx-auto">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h4 class="fw-bold mb-4 text-primary">Ulasan Pengunjung</h4>

          <!-- Form Ulasan (Hanya jika login) -->
          <?php if (isset($_SESSION['user_logged_in'])): ?>
            <?php
            // Proses simpan ulasan
            if (isset($_POST['kirim_ulasan'])) {
                $rating = intval($_POST['rating']);
                $komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);
                $id_user = $_SESSION['user_id'];
                
                $insert = mysqli_query($koneksi, "INSERT INTO ulasan (id_umkm, id_user, rating, komentar) VALUES ('$id', '$id_user', '$rating', '$komentar')");
                
                if ($insert) {
                    echo "<div class='alert alert-success'>Terima kasih atas ulasan Anda!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Gagal mengirim ulasan.</div>";
                }
            }
            ?>

            <form method="POST" class="mb-5 p-4 rounded-4" style="background-color: #eafaf1; border: 1px dashed var(--primary-color);">
              <h6 class="fw-bold mb-3 text-primary">Tulis Ulasan Anda</h6>
              <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Rating</label>
                <select name="rating" class="form-select border-0 shadow-sm" required>
                  <option value="5">⭐⭐⭐⭐⭐ (Sangat Bagus)</option>
                  <option value="4">⭐⭐⭐⭐ (Bagus)</option>
                  <option value="3">⭐⭐⭐ (Cukup)</option>
                  <option value="2">⭐⭐ (Kurang)</option>
                  <option value="1">⭐ (Sangat Kurang)</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label small fw-bold text-muted">Komentar</label>
                <textarea name="komentar" class="form-control border-0 shadow-sm" rows="3" required placeholder="Ceritakan pengalaman Anda..."></textarea>
              </div>
              <button type="submit" name="kirim_ulasan" class="btn btn-primary btn-sm rounded-pill px-4 fw-bold">Kirim Ulasan</button>
            </form>
          <?php else: ?>
            <div class="alert alert-success border-0 shadow-sm d-flex align-items-center" role="alert" style="background-color: #eafaf1; color: var(--secondary-color);">
              <i class="bi bi-info-circle-fill me-2 fs-5"></i>
              <div>
                Silakan <a href="login.php" class="fw-bold text-decoration-underline" style="color: var(--secondary-color);">Login</a> untuk memberikan ulasan.
              </div>
            </div>
          <?php endif; ?>

          <!-- Daftar Ulasan -->
          <?php
          $query_ulasan = mysqli_query($koneksi, "SELECT ulasan.*, users.nama_lengkap FROM ulasan JOIN users ON ulasan.id_user = users.id_user WHERE id_umkm = '$id' ORDER BY tanggal DESC");
          
          if (mysqli_num_rows($query_ulasan) > 0):
            while ($row = mysqli_fetch_assoc($query_ulasan)):
          ?>
            <div class="border-bottom pb-3 mb-3">
              <div class="d-flex justify-content-between">
                <h6 class="fw-bold mb-1"><?= htmlspecialchars($row['nama_lengkap']) ?></h6>
                <small class="text-muted"><?= date('d M Y', strtotime($row['tanggal'])) ?></small>
              </div>
              <div class="text-warning mb-2">
                <?php for($i=0; $i<$row['rating']; $i++) echo "★"; ?>
                <?php for($i=0; $i<(5-$row['rating']); $i++) echo "☆"; ?>
              </div>
              <p class="mb-0 text-muted"><?= nl2br(htmlspecialchars($row['komentar'])) ?></p>
            </div>
          <?php endwhile; else: ?>
            <p class="text-center text-muted py-3">Belum ada ulasan untuk UMKM ini.</p>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>

</div>
</main>

<?php include('../includes/footer_public.php'); ?>
</body>
