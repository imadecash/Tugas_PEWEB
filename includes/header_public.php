<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? $title : 'UMKM Center'; ?></title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- CSS Kamu -->
  <link rel="stylesheet" href="../assets/css/style.css?v=<?= time(); ?>">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="../public/index.php">
      <i class="bi bi-shop-window"></i> UMKM Center
    </a>
    <div class="collapse navbar-collapse d-none d-lg-block">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="daftar_umkm.php">Jelajahi</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#kategori">Kategori</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#tentang">Tentang</a></li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        <?php if (isset($_SESSION['user_logged_in'])): ?>
          <div class="dropdown">
            <a class="btn btn-outline-primary dropdown-toggle rounded-pill px-4" href="#" role="button" data-bs-toggle="dropdown">
              <?= htmlspecialchars($_SESSION['user_name']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
              <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php elseif (isset($_SESSION['admin_logged_in'])): ?>
          <div class="dropdown">
            <a class="btn btn-outline-danger dropdown-toggle rounded-pill px-4" href="#" role="button" data-bs-toggle="dropdown">
              <i class="bi bi-shield-lock me-1"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm mt-2">
              <li><a class="dropdown-item" href="../admin/index.php">Dashboard Admin</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a href="login.php" class="text-decoration-none text-dark fw-bold me-3">Login</a>
          <a href="https://wa.me/6281234567890" class="btn btn-nav-cta">
            <i class="bi bi-whatsapp me-1"></i> Hubungi Admin
          </a>
        <?php endif; ?>
      </div>
    </div>

    <button class="navbar-toggler border-0 shadow-none d-lg-none" type="button" id="public-menu-toggle">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<!-- Public Sidebar (Custom like Admin) -->
<div class="public-sidebar" id="public-sidebar">
  <div class="sidebar-header text-center mb-4 pt-4">
    <h5 class="fw-bold text-white">
      <i class="bi bi-shop-window me-2"></i> UMKM Center
    </h5>
  </div>
  <div class="list-group list-group-flush px-3">
    <a href="index.php" class="list-group-item list-group-item-action bg-transparent text-white border-0">
      <i class="bi bi-house-door me-2"></i> Beranda
    </a>
    <a href="daftar_umkm.php" class="list-group-item list-group-item-action bg-transparent text-white border-0">
      <i class="bi bi-grid me-2"></i> Jelajahi
    </a>
    <a href="index.php#kategori" class="list-group-item list-group-item-action bg-transparent text-white border-0">
      <i class="bi bi-tags me-2"></i> Kategori
    </a>
    <a href="index.php#tentang" class="list-group-item list-group-item-action bg-transparent text-white border-0">
      <i class="bi bi-info-circle me-2"></i> Tentang
    </a>
    
    <hr class="border-white opacity-25 my-3">
    
    <?php if (isset($_SESSION['user_logged_in'])): ?>
      <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent text-white border-0">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
      </a>
      <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger border-0 fw-bold">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
      </a>
    <?php elseif (isset($_SESSION['admin_logged_in'])): ?>
      <a href="../admin/index.php" class="list-group-item list-group-item-action bg-transparent text-white border-0">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
      </a>
      <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger border-0 fw-bold">
        <i class="bi bi-box-arrow-right me-2"></i> Logout
      </a>
    <?php else: ?>
      <a href="login.php" class="list-group-item list-group-item-action bg-transparent text-white border-0">
        <i class="bi bi-box-arrow-in-right me-2"></i> Login
      </a>
      <a href="https://wa.me/6281234567890" class="btn btn-light text-primary w-100 mt-3 fw-bold rounded-pill">
        <i class="bi bi-whatsapp me-1"></i> Hubungi Admin
      </a>
    <?php endif; ?>
  </div>
</div>

