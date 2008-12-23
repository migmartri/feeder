<?php
	
	include ("../lib/util.php");
	include ("../lib/sgbd.php");
	session_start();
       
   $login = $_REQUEST['login'];
   $password = codificaPasswd($_REQUEST['password']);
    
   $conn = new Sgbd();
   $result = $conn->selectFromDB("users", array("login","password"), array("login", "'".$login."'"));      
   
   if ($password == $result[0][password]) {
		$_SESSION['flash_notice'] = "Bienvenido!";
		header("Location: ../myPlanets.php");
   } else {
		$_SESSION['flash_error'] = "Nombre de usuario o contraseña incorrectos";
		header("Location: ../login.php");      
   } 
?>
