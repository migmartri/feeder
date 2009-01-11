<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  session_start(); 
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();

  $feed = $conn->selectFromDB("first", "feeds", array("*"), array('id' => $_GET['feed_id']));
  //Cargamos el planeta para verificar que tenemos acceso a borrar la suscripción
  $planet = $conn->selectFromDB("first", "planets", array("*"), array('user_id' => $_SESSION['user'], 'id' => $_GET['planet_id']));

  if(!$planet){
    $_SESSION['flash_error'] = "Acceso denegado!";
    header("Location: ../myPlanets");
  }

  //Borramos la suscripción
  $res = $conn->deleteFromDB("feeds_planets", array("feed_id" => $_GET['feed_id'], 'planet_id' => $planet['id']));

  if ($res){
    //Decrementamos el contador de suscripciones del feed y lo eliminamos en caso de ser necesario
    if($feed["subscriptions_count"] > 1){
      $conn->incrDecrFromDb("-1", "feeds", "subscriptions_count", array("id" => $feed_id));
    }else{ //Borramos el feed y sus entradas
      $conn->deleteFromDB("feeds", array("id" => $feed['id']));
      $conn->deleteFromDB("posts", array("feed_id" => $feed['id']));
    }
    //Decrementar el número de feeds del planeta
    $conn->incrDecrFromDb("-1", "planets", "feeds_count", array("id" => $planet['id']));

    $_SESSION["flash_notice"] = "Suscripción eliminada correctamente";
  } else {
    $_SESSION["flash_error"] = "Error al eliminar la suscripción, ésta no existe.";
  }
    header("Location: ../subscriptions.php?planet_id=".$_GET['planet_id']);
?>
