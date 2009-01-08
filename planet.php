<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  $planet = $conn->selectFromDB("planets", array("*"), array("user_id" => $_SESSION["user"], "id" => $_REQUEST['id']));
  
  if(count($planet)>0){
    $planet = $planet[0]; //FIXME, permitir traer primer elemento en selectFromDB
  }else{
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../myPlanets.php");
  }
?>
  Mostrando el planeta <?= $planet['name']?>
