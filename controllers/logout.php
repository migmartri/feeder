<?php
session_start();
session_unset();
session_destroy();

//Hacen falta cookies?
setcookie("login", "", time() - 3600, "/");
setcookie("PHPSESSID", "", time() - 3600, "/");
$_SESSION['flash_notice'] = "Hasta la próxima!";
header("Location: ../index.php");
?>
