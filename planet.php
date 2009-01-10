<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  $planet = $conn->selectFromDB("first", "planets", array("*"), array("user_id" => $_SESSION["user"], "id" => $_REQUEST['id']));
  
  if(!$planet){
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../myPlanets.php");
  }

  //Cargamos las entradas, en principio solo las últimas 15 entradas
  $posts = $conn->findBySql("SELECT * FROM posts WHERE feed_id IN (SELECT feed_id FROM feeds_planets WHERE planet_id =".$planet['id'].") ORDER BY published_at DESC");
?>
  Mostrando las <?= count($posts)?> últimas entradas del planeta <?= $planet['name']?>
<?
  foreach($posts as $post){
    include($_SERVER["DOCUMENT_ROOT"]."/templates/post.php"); 
  }
?>
