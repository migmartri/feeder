<?php
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
   
   $conn = new Sgbd();
   $validator = new Utilities();
   $login = $_REQUEST['login'];
   $password = $validator->codificaPasswd($_REQUEST['password']);
   $user = $conn->selectFromDB("first", "users", array("id", "login","password"), array("login" => $login));      
   
   if ($password == $user["password"]) {
		$_SESSION['flash_notice'] = "Bienvenido, ¡estos son tus planetas!";
    $_SESSION['user'] = $user["id"];
		header("Location: ../myPlanets.php");
   } else {
		$_SESSION['flash_error'] = "Nombre de usuario o contraseña incorrectos";
		header("Location: ../login.php");      
   } 
?>
