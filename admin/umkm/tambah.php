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
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
      <i class="bi bi-plus-circle"></i> Tambah Data UMKM
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" class="form-umkm">
        <div class="mb-3">
          <label class="form-label">Nama UMKM</label>
          <input type="text" name="nama_umkm" class="form-control input-umkm" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Pemilik</label>
          <input type="text" name="pemilik" class="form-control input-umkm" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="id_kategori" class="form-select input-umkm" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
              <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control input-umkm" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Kontak</label>
          <input type="text" name="kontak" class="form-control input-umkm" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control input-umkm" required></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Link Google Maps (Opsional)</label>
          <input type="url" name="link_maps" class="form-control input-umkm" placeholder="https://www.google.com/maps?q=-7.983908,112.621391">
        </div>
        <div class="mb-3">
          <label class="form-label">Foto</label>
          <input type="file" name="foto" class="form-control input-umkm">
        </div>

        <div class="text-end">
          <a href="data.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
          <button type="submit" name="simpan" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
