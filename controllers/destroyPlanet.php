<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start(); 
  loginRequired();
  $conn = new Sgbd();
  
  $res = $conn->deleteFromDB("planets", array("id" => $_GET['id'], 'user_id' => $_SESSION['user']));

  if ($res){
    $_SESSION["flash_notice"] = "Planeta eliminado correctamente";
  } else {
    $_SESSION["flash_error"] = "Error al eliminar el planeta, no existe.";
  }
    header("Location: ../myPlanets.php");
?>