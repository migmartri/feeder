<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start();
  
  $errors = array();
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  
  $phone = $_POST['phone'];
  $flickr = $_POST['flickr'];
  $twitter = $_POST['twitter'];
  $web = $_POST['web'];
  
  // Validaciones en servidor.
  $util->validatesNumericalityOf($phone, "El número de teléfono no es válido");
  $util->validatesLengthOf($phone, 9, "El teléfono debe tener tamaño 9");
  $util->validatesUrlFormatOf($twitter, "La url de Twitter no es válida");
  $util->validatesUrlFormatOf($flickr, "La url de Flickr no es válida");
  $util->validatesUrlFormatOf($web, "La url de tu página web no es válida");
  
  if (count($errors) == 0) {
    //updateTableFromDB(tabla, valores a actualizar, condiciones)
    $result = $conn->updateTableFromDB("profiles", $_POST, array("user_id" => $_SESSION['user']));
    if ($result) {
      $_SESSION["flash_notice"] = "Perfil actualizado con éxito";
      header("Location: ../myPlanets.php");
    } else {
      print "Falló la inserción";
    }
  } else {
    //Cargamos los atributos para cargarlos en el formulario
    $_SESSION['form_values'] = $_REQUEST;
    $_SESSION['flash_error'] = implode("<br/>", $errors);
    header("Location: ../editProfile.php");
  }
?>
