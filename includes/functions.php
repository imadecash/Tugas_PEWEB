<?php
include_once('../config/database.php');

// fungsi untuk keamanan input
function sanitize($data) {
    global $koneksi;
    return mysqli_real_escape_string($koneksi, htmlspecialchars($data));
}
?>
