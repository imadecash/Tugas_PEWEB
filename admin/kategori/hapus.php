<?php
include('../../config/database.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori=$id");
header("Location: data.php");
?>
