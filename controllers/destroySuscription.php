<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start(); 
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();

  //Cargamos el planeta para verificar que tenemos acceso a borrar la suscripción
  $planets = $conn->selectFromDB("planets", array("*"), array('user_id' => $_SESSION['user'], 'id' => $_GET['planet_id']));
  if(count($planets)==0){
    $_SESSION['flash_error'] = "Acceso denegado!";
    header("Location: ../myPlanets");
  }

  //Borramos la suscripción
  $res = $conn->deleteFromDB("feeds_planets", array("feed_id" => $_GET['feed_id'], 'planet_id' => $planets[0]['id']));

  if ($res){
    //Decrementamos el contador de suscripciones del feed y lo eliminamos en caso de ser necesario

    $_SESSION["flash_notice"] = "Suscripción eliminada correctamente";
  } else {
    $_SESSION["flash_error"] = "Error al eliminar la suscripción, ésta no existe.";
  }
    header("Location: ../subscriptions.php?planet_id=".$_GET['planet_id']);
?>
