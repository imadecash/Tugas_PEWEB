<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: /TUGAS_PEWEB/public/login.php");
    exit;
} else {
    // Regenerasi session secara berkala (opsional, tapi baik untuk keamanan)
    // session_regenerate_id(true); 
}
?>