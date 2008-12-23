<?php
	include ("../lib/tareas.php");
  include ("../lib/sgbd.php");
    
$name = "'".$_REQUEST['name']."'";
$surname = "'".$_REQUEST['surname']."'";
$phone = "'".$_REQUEST['phone']."'";
$city = "'".$_REQUEST['city']."'";
$flickr = "'".$_REQUEST['flickr']."'";
$twitter = "'".$_REQUEST['twitter']."'";
$web = "'".$_REQUEST['web']."'";
    
    $conn = new Sgbd();
    $res = $conn->insert2DB("profiles", array("name", "surname", "phone", "city", "flickr", "twitter", "web"), array($name, $surname, $phone, $city, $flickr, $twitter, $web));
    
    if ($res) {
    	header("Location: ../myPlanets.php");
    } else {
    	print "Falló la inserción";
	 }

?>