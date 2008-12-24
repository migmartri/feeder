<?php
	
	include ("../lib/util.php");
	include ("../lib/sgbd.php");
  session_start();
   
   $conn = new Sgbd();
   $validator = new Utilities();
   $login = $_REQUEST['login'];
   $password = $validator->codificaPasswd($_REQUEST['password']);
   $result = $conn->selectFromDB("users", array("login","password"), array("login", "'".$login."'"));      
   
   if ($password == $result[0][password]) {
		$_SESSION['flash_notice'] = "Bienvenido!";
    setcookie("login", $login, time()+36000, "/");
		header("Location: ../myPlanets.php");
   } else {
		$_SESSION['flash_error'] = "Nombre de usuario o contraseña incorrectos";
		header("Location: ../login.php");      
   } 
?>
