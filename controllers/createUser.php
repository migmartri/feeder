<?php
	include ("../lib/util.php");
  include ("../lib/sgbd.php");
  session_start();
    
    $validator = new Utilities();
    $conn = new Sgbd();
    
    $login = "'".$_REQUEST['login']."'";
    $password = "'".$validator->codificaPasswd($_REQUEST['password'])."'";
    $email = "'".$_REQUEST['email']."'";
    $fecha = "'".date("Y-n-j H:i:s")."'";
    $errors = array();
    
    validatesPresenceOf($login, "No se puede dejar vacío el login");
    validatesPresenceOf($password, "No se puede dejar vacío el password");
    validatesPresenceOf($email, "No se puede dejar vacío el email");
    validatesUniquenessOf("users", array("login", $login), "El usuario ya existe");

    if(count($errors) == 0) {
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
    } else {
      $_SESSION['flash_error'] = implode("<br/>", $errors);
      header("Location: ../register.php");
    }
?>
