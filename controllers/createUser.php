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
    validatesPresenceOf($password, "No se puede dejar vacía la contraseña");
    validatesPresenceOf($email, "No se puede dejar vacío el email");
    validatesUniquenessOf("users", array("login", $login), "El usuario ya existe");
    validatesUniquenessOf("users", array("email", $email), "El email ya existe, elije otro");
    validatesConfirmationOff($_REQUEST['password'], $_REQUEST['repassword'], "La contraseña no coincide");
    validatesEmailFormatOf($email, "Formato de email incorrecto");

    if(count($errors) == 0) {
        $res = $conn->insert2DB("users", array("login", "password", "email", "created_at"), array($login, $password, $email, $fecha));
      $_SESSION['flash_notice'] = "Usuario creado!";
      header("Location: ../myPlanets.php");
    }else{
      $_SESSION['flash_error'] = implode("<br/>", $errors);
      header("Location: ../register.php");
    }
?>
