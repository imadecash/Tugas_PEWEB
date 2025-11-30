<?php
include('../../config/database.php');

if (isset($_POST['simpan'])) {
    $nama        = $_POST['nama_umkm'];
    $pemilik     = $_POST['pemilik'];
    $id_kategori = $_POST['id_kategori'];
    $alamat      = $_POST['alamat'];
    $kontak      = $_POST['kontak'];
    $deskripsi   = $_POST['deskripsi'];
    $link_maps   = $_POST['link_maps'];

    // Upload foto
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        move_uploaded_file($tmp, "../../uploads/umkm/" . $foto);
    }

    $query = "INSERT INTO umkm (nama_umkm, pemilik, id_kategori, alamat, kontak, deskripsi, foto, link_maps)
              VALUES ('$nama', '$pemilik', '$id_kategori', '$alamat', '$kontak', '$deskripsi', '$foto', '$link_maps')";
    mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

    header("Location: data.php");
    exit;
}

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
include('../../includes/header_admin.php');
?>

<div class="container-fluid px-4 py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold text-primary mb-0">Tambah Data UMKM Baru</h5>
        </div>
        <div class="card-body p-4">
          <form method="post" enctype="multipart/form-data" class="form-umkm">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Nama UMKM</label>
                <input type="text" name="nama_umkm" class="form-control bg-light" placeholder="Contoh: Keripik Tempe Jaya" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Pemilik</label>
                <input type="text" name="pemilik" class="form-control bg-light" placeholder="Nama pemilik usaha" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Kategori Usaha</label>
                <select name="id_kategori" class="form-select bg-light" required>
                  <option value="">-- Pilih Kategori --</option>
                  <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                    <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Kontak (HP/WA)</label>
                <input type="text" name="kontak" class="form-control bg-light" placeholder="Contoh: 08123456789" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control bg-light" rows="2" placeholder="Alamat lokasi usaha" required></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Deskripsi Usaha</label>
              <textarea name="deskripsi" class="form-control bg-light" rows="3" placeholder="Jelaskan produk dan keunggulan usaha..." required></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Link Google Maps (Opsional)</label>
                <input type="url" name="link_maps" class="form-control bg-light" placeholder="https://maps.google.com/...">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Foto UMKM</label>
                <input type="file" name="foto" class="form-control bg-light">
                <div class="form-text text-muted small">Format: JPG, PNG, JPEG. Maks 2MB.</div>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="data.php" class="btn btn-light rounded-pill px-4 fw-bold">
                Batal
              </a>
              <button type="submit" name="simpan" class="btn btn-primary rounded-pill px-4 fw-bold">
                Simpan Data
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
