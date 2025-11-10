<?php
include('../../config/database.php');
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM umkm WHERE id_umkm=$id");
header("Location: data.php");
?>
