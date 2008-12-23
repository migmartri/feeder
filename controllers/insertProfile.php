<?php
	include ("../lib/tareas.php");
  include ("../lib/sgbd.php");
  session_start();
  
  $login = $_SESSION['login'];
    
$name = "'".$_REQUEST['name']."'";
$surname = "'".$_REQUEST['surname']."'";
$phone = "'".$_REQUEST['phone']."'";
$city = "'".$_REQUEST['city']."'";
$flickr = "'".$_REQUEST['flickr']."'";
$twitter = "'".$_REQUEST['twitter']."'";
$web = "'".$_REQUEST['web']."'";
    
    $conn = new Sgbd();
    $login_id = $conn->selectFromDB("users", array("id"), array("login", "'".$login."'"));
    $id = "'".$login_id[0][id]."'";
    $res = $conn->insert2DB("profiles", array("name", "surname", "phone", "city", "flickr", "twitter", "web", "user_id"), array($name, $surname, $phone, $city, $flickr, $twitter, $web, $id));
    
    if ($res) {
    	header("Location: ../myPlanets.php");
    } else {
    	print "Falló la inserción";
	 }
?>