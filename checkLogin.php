<?php
	
	include ("include/tareas.php");
	include ("include/sgbd.php");
	session_start();
       
   $login = $_REQUEST['login'];
   $password = codificaPasswd($_REQUEST['password']);
    
   $conn = new Sgbd();
   $result = $conn->selectFromDB("users", array("login","password"), array("login", "'".$login."'"));      
   
   if ($password == $result[0][password]) {
		header("Location: misplanetas.php");
   } else {
		$_SESSION['error_login'] = "No tiene cuenta!";
		header("Location: index.php");      
   } 
?>