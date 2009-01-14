<?php
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
  $errors = array();
  $conn = new Sgbd();
  $util = new Utilities();
  $util->loginRequired();

  $name = $_REQUEST['name'];
  $description = $_REQUEST['description'];
  $util->validatesPresenceOf($name, "El planeta debe tener un nombre");
  $util->validatesPresenceOf($description, "Debes poner una descripción");
  $util->validatesUniquenessOf("planets", array("name" => $name), "Ya existe un planeta con ese nombre, por favor elige otro");

  if(count($errors) == 0) {
    $planet_id = $conn->insert2DB("planets", array("name" => $name, "description" => $description, "user_id" => $_SESSION["user"]));
    $_SESSION['flash_notice'] = "Planeta creado. ¡Momento para los feeds!";
    header("Location: ../subscriptions.php?planet_id=$planet_id");
  }else{
    $_SESSION['form_values'] = $_REQUEST;
    $_SESSION['flash_error'] = implode("<br/>", $errors);
    header("Location: ../newPlanet.php");
  }
?>
