<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?></title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/TUGAS_PEWEB/assets/css/admin.css">
</head>

<body>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-header mb-4">
            <div class="d-flex align-items-center gap-2 px-3">
                <i class="bi bi-shop-window fs-4 text-white"></i>
                <h5 class="fw-bold m-0 text-nowrap">UMKM Center</h5>
            </div>
        </div>

        <div class="list-group list-group-flush">
            <a href="/TUGAS_PEWEB/admin/index.php" class="list-group-item list-group-item-action <?= basename($_SERVER['PHP_SELF']) == 'index.php' && dirname($_SERVER['PHP_SELF']) == '/TUGAS_PEWEB/admin' ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2 me-3"></i> Dashboard
            </a>
            <a href="/TUGAS_PEWEB/admin/umkm/data.php" class="list-group-item list-group-item-action <?= strpos($_SERVER['PHP_SELF'], '/umkm/') !== false ? 'active' : '' ?>">
                <i class="bi bi-shop me-3"></i> Data UMKM
            </a>
            <a href="/TUGAS_PEWEB/admin/kategori/data.php" class="list-group-item list-group-item-action <?= strpos($_SERVER['PHP_SELF'], '/kategori/') !== false ? 'active' : '' ?>">
                <i class="bi bi-tags me-3"></i> Kategori
            </a>
            <a href="/TUGAS_PEWEB/admin/laporan/laporan_umkm.php" class="list-group-item list-group-item-action <?= strpos($_SERVER['PHP_SELF'], '/laporan/') !== false ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-text me-3"></i> Laporan
            </a>
            <a href="/TUGAS_PEWEB/admin/users/data.php" class="list-group-item list-group-item-action <?= strpos($_SERVER['PHP_SELF'], '/users/') !== false ? 'active' : '' ?>">
                <i class="bi bi-people me-3"></i> Data Pengguna
            </a>
            <a href="/TUGAS_PEWEB/admin/ulasan/data.php" class="list-group-item list-group-item-action <?= strpos($_SERVER['PHP_SELF'], '/ulasan/') !== false ? 'active' : '' ?>">
                <i class="bi bi-chat-left-text me-3"></i> Data Ulasan
            </a>
            
            <div class="mt-4 px-3">
                <p class="text-white small fw-bold mb-2">AKUN</p>
            </div>
            
            <a href="/TUGAS_PEWEB/admin/logout.php" class="list-group-item list-group-item-action text-white">
                <i class="bi bi-box-arrow-right me-3"></i> Logout
            </a>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div id="page-content-wrapper">
        <div class="main-content">
            <!-- Top Header inside Content -->
            <div class="d-flex justify-content-between align-items-center mb-4 pt-2">
                <h4 class="fw-bold text-dark m-0"><?= $title ?? 'Dashboard' ?></h4>
                
                <div class="d-flex align-items-center gap-3">
                    <!-- Search bar removed -->
                    
                    <div class="bg-white rounded-circle p-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="bi bi-bell text-muted"></i>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2 bg-white rounded-pill pe-3 p-1 shadow-sm">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="small fw-bold text-dark">Admin</span>
                    </div>
                </div>
            </div>
