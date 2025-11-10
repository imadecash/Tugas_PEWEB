<?php
include('../../config/database.php');

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama_umkm'];
    $pemilik    = $_POST['pemilik'];
    $id_kategori = $_POST['id_kategori'];
    $alamat     = $_POST['alamat'];
    $kontak     = $_POST['kontak'];
    $deskripsi  = $_POST['deskripsi'];

    // Upload foto
    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    move_uploaded_file($tmp, "../../uploads/umkm/" . $foto);

    $query = "INSERT INTO umkm (nama_umkm, pemilik, id_kategori, alamat, kontak, deskripsi, foto)
              VALUES ('$nama', '$pemilik', '$id_kategori', '$alamat', '$kontak', '$deskripsi', '$foto')";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    header("Location: data.php");
    exit;
}

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
?>
<?php include('../includes/header.php'); ?>
<h2>Data UMKM</h2>
<!-- isi konten -->
<?php include('../includes/footer.php'); ?>

<h2>Tambah Data UMKM</h2>
<form method="post" enctype="multipart/form-data">
  Nama UMKM: <input type="text" name="nama_umkm" required><br>
  Pemilik: <input type="text" name="pemilik" required><br>
  Kategori:
  <select name="id_kategori" required>
    <option value="">--Pilih Kategori--</option>
    <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
      <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
    <?php } ?>
  </select><br>
  Alamat: <textarea name="alamat" required></textarea><br>
  Kontak: <input type="text" name="kontak" required><br>
  Deskripsi: <textarea name="deskripsi" required></textarea><br>
  Foto: <input type="file" name="foto"><br>
  <button type="submit" name="simpan">Simpan</button>
</form>
