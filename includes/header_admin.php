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

<div id="wrapper">

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        <div class="sidebar-header text-center mb-4">
            <h4>UMKM LOKAL</h4>
        </div>

        <div class="list-group list-group-flush">
            <a href="/TUGAS_PEWEB/admin/index.php" class="list-group-item">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="/TUGAS_PEWEB/admin/umkm/data.php" class="list-group-item">
                <i class="bi bi-shop"></i> Kelola Data UMKM
            </a>
            <a href="/TUGAS_PEWEB/admin/kategori/data.php" class="list-group-item">
                <i class="bi bi-tags"></i> Kelola Kategori
            </a>
            <a href="/TUGAS_PEWEB/admin/laporan/laporan_umkm.php" class="list-group-item">
                <i class="bi bi-graph-up"></i> Laporan UMKM
            </a>
            <a href="/TUGAS_PEWEB/admin/logout.php" class="list-group-item logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- Content Wrapper -->
    <div id="page-content-wrapper">

        <nav class="navbar navbar-light bg-white shadow-sm px-4 mb-4">
            <button class="btn" id="menu-toggle">
                <i class="bi bi-list fs-4"></i>
            </button>

            <h5 class="fw-bold text-primary m-0">
                <?= $title ?? 'Dashboard Admin' ?>
            </h5>
        </nav>

        <div class="container-fluid px-4 content-wrapper">
