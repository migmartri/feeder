<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start(); 

  loginRequired();
  $conn = new Sgbd();
  //updateTableFromDB(tabla, valores a actualizar, condiciones)
  $result = $conn->updateTableFromDB("profiles", $_POST, array("user_id" => $_SESSION['user']));
   if ($result) {
      $_SESSION["flash_notice"] = "Perfil actualizado con éxito";
      header("Location: ../myPlanets.php");
  } else {
      print "Falló la inserción";
  }
?>
