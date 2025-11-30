<?php if (!isset($hide_footer) || !$hide_footer): ?>
<footer class="mt-auto" id="contact">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <a href="index.php" class="footer-brand"><i class="bi bi-shop-window"></i> UMKM Center</a>
        <p class="text-muted">
          Platform digital yang menghubungkan pelaku usaha mikro, kecil, dan menengah dengan pasar yang lebih luas.
        </p>
        <div class="d-flex gap-2 mt-3">
          <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-facebook"></i></a>
          <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-instagram"></i></a>
          <a href="#" class="btn btn-sm btn-outline-primary rounded-circle"><i class="bi bi-twitter-x"></i></a>
        </div>
      </div>
      
      <div class="col-md-2 mb-4">
        <h5 class="footer-title">Navigasi</h5>
        <ul class="list-unstyled footer-links">
          <li><a href="index.php">Beranda</a></li>
          <li><a href="daftar_umkm.php">Jelajahi</a></li>
          <li><a href="index.php#tentang">Tentang Kami</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </div>
      
      <div class="col-md-2 mb-4">
        <h5 class="footer-title">Kategori</h5>
        <ul class="list-unstyled footer-links">
          <?php
          if (isset($koneksi)) {
            $cat_footer_query = mysqli_query($koneksi, "SELECT * FROM kategori LIMIT 4");
            while ($cat_footer = mysqli_fetch_assoc($cat_footer_query)) {
              echo '<li><a href="daftar_umkm.php?kategori=' . $cat_footer['id_kategori'] . '">' . htmlspecialchars($cat_footer['nama_kategori']) . '</a></li>';
            }
          } else {
            echo '<li><a href="#">Kuliner</a></li>';
            echo '<li><a href="#">Fashion</a></li>';
            echo '<li><a href="#">Kerajinan</a></li>';
            echo '<li><a href="#">Jasa</a></li>';
          }
          ?>
        </ul>
      </div>
      
      <div class="col-md-4 mb-4">
        <h5 class="footer-title">KONTAK</h5>
        <ul class="list-unstyled footer-links">
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-geo-alt text-primary"></i>
            <span class="text-muted">Jl. Sudirman No. 123, Jakarta Pusat</span>
          </li>
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-envelope text-primary"></i>
            <span class="text-muted">support@umkmcenter.com</span>
          </li>
          <li class="d-flex align-items-center gap-2">
            <i class="bi bi-telephone text-primary"></i>
            <span class="text-muted">+62 812 3456 7890</span>
          </li>
        </ul>
      </div>
    </div>
    
    <hr class="my-4">
    
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start">
        <p class="text-muted mb-0">&copy; 2025 UMKM Center. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <a href="#" class="text-muted text-decoration-none small me-3">Privacy Policy</a>
        <a href="#" class="text-muted text-decoration-none small">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="../assets/js/script.js?v=<?= time(); ?>"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    const currentUrl = window.location.href;

    // Function to set active class based on URL
    function setActiveState() {
      let foundActive = false;
      
      navLinks.forEach(link => {
        // Remove active class from all
        link.classList.remove('active');

        // Check exact match (including hash)
        if (link.href === window.location.href) {
          link.classList.add('active');
          foundActive = true;
        }
      });

      // Fallback: If no exact match found (e.g. root url / vs index.php), 
      // or if we are on index.php without hash, highlight Beranda.
      if (!foundActive) {
        navLinks.forEach(link => {
          if (window.location.pathname.endsWith('index.php') && link.getAttribute('href') === 'index.php' && !window.location.hash) {
             link.classList.add('active');
          }
        });
      }
    }

    // Set initial state
    setActiveState();

    // Update on click
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        // Allow time for hash to update if it's an anchor link
        setTimeout(() => {
            setActiveState();
        }, 50);
        
        // Immediate visual feedback
        navLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });
    
    // Update on hash change (e.g. back button)
    window.addEventListener('hashchange', setActiveState);
  });
</script>
</body>
</html>