<?php
include('../../config/database.php');
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM umkm WHERE id_umkm=$id"));
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

if(isset($_POST['update'])){
    $nama = $_POST['nama_umkm'];
    $pemilik = $_POST['pemilik'];
    $id_kategori = $_POST['id_kategori'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];
    $deskripsi = $_POST['deskripsi'];

    if($_FILES['foto']['name'] != ""){
        $foto = $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../../uploads/umkm/".$foto);
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
        foto='$foto'
        WHERE id_umkm=$id";

    mysqli_query($conn, $query);
    header("Location: data.php");
}
?>
<?php include('../../includes/header_admin.php'); ?>

<!-- konten halaman di sini -->
 <h2>Edit Data UMKM</h2>
<form method="post" enctype="multipart/form-data">
  Nama UMKM: <input type="text" name="nama_umkm" value="<?= $data['nama_umkm'] ?>"><br>
  Pemilik: <input type="text" name="pemilik" value="<?= $data['pemilik'] ?>"><br>
  Kategori:
  <select name="id_kategori">
    <?php while($row = mysqli_fetch_assoc($kategori)) { ?>
      <option value="<?= $row['id_kategori'] ?>" <?= ($row['id_kategori']==$data['id_kategori'])?'selected':'' ?>>
        <?= $row['nama_kategori'] ?>
      </option>
    <?php } ?>
  </select><br>
  Alamat: <textarea name="alamat"><?= $data['alamat'] ?></textarea><br>
  Kontak: <input type="text" name="kontak" value="<?= $data['kontak'] ?>"><br>
  Deskripsi: <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>
  Foto: <input type="file" name="foto"><br>
  <button type="submit" name="update">Update</button>
</form>

<?php include('../../includes/footer_admin.php'); ?>