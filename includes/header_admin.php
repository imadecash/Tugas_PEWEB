<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - UMKM Lokal</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Custom Admin Style -->
  <link rel="stylesheet" href="/UMKM_Lokal/assets/css/style_admin.css">
</head>
<body>
<div class="d-flex" id="wrapper">

  <!-- SIDEBAR -->
  <div class="bg-primary border-end text-white" id="sidebar-wrapper">
    <div class="sidebar-heading fw-bold text-center py-3 border-bottom">UMKM LOKAL</div>
    <div class="list-group list-group-flush">
      <a href="/UMKM_Lokal/admin/index.php" class="list-group-item list-group-item-action bg-primary text-white"><i class="bi bi-speedometer2"></i> Dashboard</a>
      <a href="/UMKM_Lokal/admin/umkm/data.php" class="list-group-item list-group-item-action bg-primary text-white"><i class="bi bi-shop"></i> Kelola Data UMKM</a>
      <a href="/UMKM_Lokal/admin/kategori/data.php" class="list-group-item list-group-item-action bg-primary text-white"><i class="bi bi-tags"></i> Kelola Kategori</a>
      <a href="/UMKM_Lokal/admin/laporan/laporan_umkm.php" class="list-group-item list-group-item-action bg-primary text-white"><i class="bi bi-graph-up"></i> Laporan UMKM</a>
      <a href="/UMKM_Lokal/admin/logout.php" class="list-group-item list-group-item-action bg-danger text-white"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>

  <!-- PAGE CONTENT -->
  <div id="page-content-wrapper" class="flex-grow-1">
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
      <div class="container-fluid">
        <button class="btn btn-outline-primary" id="menu-toggle"><i class="bi bi-list"></i></button>
        <h5 class="ms-3 mt-1 fw-semibold text-primary">Dashboard Admin</h5>
      </div>
    </nav>

    <div class="container-fluid px-4 py-4">
