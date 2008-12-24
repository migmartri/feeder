<?php
session_unset();
session_destroy();
  
setcookie("login", "", time() - 3600, "/");
setcookie("PHPSESSID", "", time() - 3600, "/");
header("Location: ../index.php");
?>