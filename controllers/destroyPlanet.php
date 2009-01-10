<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start(); 
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  
  $res = $conn->deleteFromDB("planets", array("id" => $_GET['id'], 'user_id' => $_SESSION['user']));

  if ($res){
    $_SESSION["flash_notice"] = "Planeta eliminado correctamente";
    //Borramos las suscripciones relacionadas con ese planeta
    $conn->deleteFromDB("feeds_planets", array("planet_id" => $_GET['id']));
  } else {
    $_SESSION["flash_error"] = "Error al eliminar el planeta, no existe.";
  }
    header("Location: ../myPlanets.php");
?>
