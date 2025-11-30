<?php
session_start();
session_unset();
session_destroy();
header("Location: /TUGAS_PEWEB/public/login.php");
exit;
?>

