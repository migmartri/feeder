<?php
	include ($_SERVER['DOCUMENT_ROOT']."/lib/util.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  include ($_SERVER['DOCUMENT_ROOT']."/lib/feed.php");
  session_start();
  $errors = array();
  $util = new Utilities();
  $util->loginRequired();

  $url = $_POST['url'];
  $planet_id = $_POST['planet_id'];

  $util->validatesPresenceOf($url, "Debes poner una descripción");
  $util->validatesUrlFormatOf($url, "Formato de url incorrecto");
  $name = $util->validatesFeed($url, "Feed inválido");

  if(count($errors) == 0) {
    checkAndCreateFeed($name, $url, $planet_id);
    $_SESSION['flash_notice'] = "Suscripción creada!";
    header("Location: ../planet.php?id=$planet_id");
  }else{
    $_SESSION['form_values'] = $_REQUEST;
    $_SESSION['flash_error'] = implode("<br/>", $errors);
    header("Location: ../newSubscription.php");
  }

  //Creamos la suscripción y el feed en caso de ser necesario
  function checkAndCreateFeed($name, $url, $planet_id){
    $conn = new Sgbd();
    $feed = $conn->selectFromDB("first", "feeds", array("*"), array("url" => $url));
 
    /*Comprobamos si existe el feed en la base de datos, si no es así, lo creamos*/
    if($feed) {
      $feed_id = $feed['id'];
    }else{
      $feed_id = $conn->insert2DB("feeds", array("name" => $name, "url" => $url));
      //Nos traemos sus feeds y los guardamos
      $feed = new Feed();
      $feed->refreshFeed($feed_id);
    }
    //Creamos la suscripción
    $subscription_id = $conn->insert2DB("feeds_planets", array("feed_id" => $feed_id, "planet_id" => $planet_id));
    //Actualizamos el númer de suscritos
    $conn->updateTableFromDB("feeds", array('subscriptions_count' => count($feeds) + 1), array("id" => $feed_id));
  }
?>
