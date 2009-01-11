<?php
session_start();
session_unset();
session_destroy();

$_SESSION['flash_notice'] = "Hasta la próxima!";
header("Location: ../index.php");
?>
