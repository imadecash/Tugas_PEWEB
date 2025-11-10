<?php
include_once('../config/database.php');

// fungsi untuk keamanan input
function sanitize($data) {
    global $conn;
    return mysqli_real_escape_string($conn, htmlspecialchars($data));
}
?>
