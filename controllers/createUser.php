<?php
	include ("../lib/util.php");
  include ("../lib/sgbd.php");
  session_start();
    
    $login = "'".$_REQUEST['login']."'";
    $password = "'".codificaPasswd($_REQUEST['password'])."'";
    $email = "'".$_REQUEST['email']."'";
    $fecha = "'".date("Y-n-j H:i:s")."'";
    
    $conn = new Sgbd();
    $exist = $conn->selectFromDB("users", array("login"), array("login", $login));
    
    if (count($exist) == 0) {
      $res = $conn->insert2DB("users", array("login", "password", "email", "created_at"), array($login, $password, $email, $fecha));
    } else {
      $_SESSION['flash_error'] = "El nombre de usuario ya está en uso, intente otro.";
      header("Location: ../login.php");
    }
    
    if ($res) {
    	header("Location: ../myPlanets.php");
    } else {
   		echo "El vector con indice $c tiene el valor $v<br/>";
	 }

?>
