<?php
include('../check_login.php');
?>

<?php
include('../../config/database.php');
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM umkm WHERE id_umkm=$id"));
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $nama        = $_POST['nama_umkm'];
    $pemilik     = $_POST['pemilik'];
    $id_kategori = $_POST['id_kategori'];
    $alamat      = $_POST['alamat'];
    $kontak      = $_POST['kontak'];
    $deskripsi   = $_POST['deskripsi'];
    $link_maps   = $_POST['link_maps'];

    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../uploads/umkm/" . $foto);
    } else {
        $foto = $data['foto'];
    }

    $query = "UPDATE umkm SET 
      nama_umkm='$nama',
      pemilik='$pemilik',
      id_kategori='$id_kategori',
      alamat='$alamat',
      kontak='$kontak',
      deskripsi='$deskripsi',
      foto='$foto',
      link_maps='$link_maps'
      WHERE id_umkm=$id";
    mysqli_query($koneksi, $query);
    header("Location: data.php");
}
?>

<?php include('../../includes/header_admin.php'); ?>

<div class="container-fluid px-4 py-4">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-bottom-0 pt-4 px-4">
          <h5 class="fw-bold text-primary mb-0">Edit Data UMKM</h5>
        </div>
        <div class="card-body p-4">
          <form method="post" enctype="multipart/form-data" class="form-umkm">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Nama UMKM</label>
                <input type="text" name="nama_umkm" class="form-control bg-light" value="<?= htmlspecialchars($data['nama_umkm']) ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Pemilik</label>
                <input type="text" name="pemilik" class="form-control bg-light" value="<?= htmlspecialchars($data['pemilik']) ?>" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Kategori Usaha</label>
                <select name="id_kategori" class="form-select bg-light" required>
                  <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                    <option value="<?= $row['id_kategori'] ?>" <?= ($row['id_kategori'] == $data['id_kategori']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($row['nama_kategori']) ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Kontak (HP/WA)</label>
                <input type="text" name="kontak" class="form-control bg-light" value="<?= htmlspecialchars($data['kontak']) ?>" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
              <textarea name="alamat" class="form-control bg-light" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
            </div>

            <div class="mb-3">
              <label class="form-label small fw-bold text-muted">Deskripsi Usaha</label>
              <textarea name="deskripsi" class="form-control bg-light" rows="3" required><?= htmlspecialchars($data['deskripsi']) ?></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Link Google Maps (Opsional)</label>
                <input type="url" name="link_maps" class="form-control bg-light" value="<?= htmlspecialchars($data['link_maps']) ?>">
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label small fw-bold text-muted">Foto UMKM</label>
                <input type="file" name="foto" class="form-control bg-light">
                <div class="form-text text-muted small">Biarkan kosong jika tidak ingin mengubah foto.</div>
                <?php if ($data['foto']) { ?>
                  <div class="mt-2">
                    <img src="../../uploads/umkm/<?= $data['foto'] ?>" class="img-thumbnail rounded-3" width="100">
                  </div>
                <?php } ?>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <a href="data.php" class="btn btn-light rounded-pill px-4 fw-bold">
                Batal
              </a>
              <button type="submit" name="update" class="btn btn-primary rounded-pill px-4 fw-bold">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
