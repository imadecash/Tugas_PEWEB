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
  <div class="card shadow-sm">
    <div class="card-header bg-warning text-dark fw-bold">
      <i class="bi bi-pencil-square"></i> Edit Data UMKM
    </div>
    <div class="card-body">
      <form method="post" enctype="multipart/form-data" class="form-umkm">
        <div class="mb-3">
          <label class="form-label">Nama UMKM</label>
          <input type="text" name="nama_umkm" class="form-control input-umkm" value="<?= $data['nama_umkm'] ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Pemilik</label>
          <input type="text" name="pemilik" class="form-control input-umkm" value="<?= $data['pemilik'] ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori</label>
          <select name="id_kategori" class="form-select input-umkm">
            <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
              <option value="<?= $row['id_kategori'] ?>" <?= ($row['id_kategori'] == $data['id_kategori']) ? 'selected' : '' ?>>
                <?= $row['nama_kategori'] ?>
              </option>
            <?php } ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="alamat" class="form-control input-umkm"><?= $data['alamat'] ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Kontak</label>
          <input type="text" name="kontak" class="form-control input-umkm" value="<?= $data['kontak'] ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi</label>
          <textarea name="deskripsi" class="form-control input-umkm"><?= $data['deskripsi'] ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Link Google Maps</label>
          <input type="url" name="link_maps" class="form-control input-umkm" value="<?= $data['link_maps'] ?>">
        </div>
        <div class="mb-3">
          <label class="form-label">Foto</label>
          <input type="file" name="foto" class="form-control input-umkm">
          <?php if ($data['foto']) { ?>
            <img src="../../uploads/umkm/<?= $data['foto'] ?>" class="img-thumbnail mt-2" width="120">
          <?php } ?>
        </div>

        <div class="text-end">
          <a href="data.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
          <button type="submit" name="update" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include('../../includes/footer_admin.php'); ?>
