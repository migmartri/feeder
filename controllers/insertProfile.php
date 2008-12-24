<?php
	include ("../lib/util.php");
  include ("../lib/sgbd.php");
  session_start();
  
  $login = $_SESSION['login'];
  $conn = new Sgbd();
  $validator = new Utilities();
    
  $name = "'".$_REQUEST['name']."'";
  $surname = "'".$_REQUEST['surname']."'";
  $phone = "'".$_REQUEST['phone']."'";
  $city = "'".$_REQUEST['city']."'";
  $flickr = "'".$_REQUEST['flickr']."'";
  $twitter = "'".$_REQUEST['twitter']."'";
  $web = "'".$_REQUEST['web']."'";
   
  $errors = array();
  $valid = 1;
    
  if (!$validator->isEmpty($name)) {
    $valid = 0;
    array_push($errors, "No puede dejar el nombre en blanco");
  }
  if (!$validator->isEmpty($surname)) {
    $valid = 0;
    array_push($errors, "No puede dejar el apellido en blanco");
  }
  if (!$validator->isEmpty($phone)) {
    $valid = 0;
    array_push($errors, "No puede dejar el teléfono en blanco");
  }
  if (!$validator->isEmpty($city)) {
    $valid = 0;
    array_push($errors, "No puede dejar la ciudad en blanco");
  }
  if ($validator->isEmpty($flickr) && $validator->isURL($flickr)) {
    $valid = 0;
    array_push($errors, "La URL de Flickr no es correcta.");
  }
  if ($validator->isEmpty($twitter) && $validator->isURL($twitter)) {
    $valid = 0;
    array_push($errors, "La URL de Twitter no es correcta.");
  }
  if ($validator->isEmpty($web) && $validator->isURL($web)) {
    $valid = 0;
    array_push($errors, "La URL de tu página web no es correcta.");
  }
  
  if ($valid) {
    $login_id = $conn->selectFromDB("users", array("id"), array("login", "'".$login."'"));
    $id = "'".$login_id[0][id]."'";
    $res = $conn->insert2DB("profiles", array("name", "surname", "phone", "city", "flickr", "twitter", "web", "user_id"), array($name, $surname, $phone, $city, $flickr, $twitter, $web, $id));
      
    if ($res) {
      header("Location: ../profile.php");
    } else {
      print "Falló la inserción";
    }
  } else {
    $_SESSION['flash_error'] = implode(", ", $errors);
      header("Location: ../createProfile.php");
  }
?>