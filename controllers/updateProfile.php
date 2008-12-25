<?php
include_once("../lib/sgbd.php");
include ("../lib/util.php");
session_start(); 
  
  $login = $_COOKIE['login'];
  
  $conn = new Sgbd();
  $login_id = $conn->selectFromDB("users", array("id"), array("login", "'".$login."'"));
  $id = $login_id[0][id];
  $res = array();
  
  
  /* verificamos las variables que han cambiado */
  if ($_REQUEST[name] != $_SESSION[name2] )
     array_push($res, "name", $_REQUEST[name]);
  if ($_REQUEST[surname] != $_SESSION[surname2] )
     array_push($res, "surname", $_REQUEST[surname]);
  if ($_REQUEST[phone] != $_SESSION[phone2] )
     array_push($res, "phone", $_REQUEST[phone]);
  if ($_REQUEST[city] != $_SESSION[city2] )
     array_push($res, "city", $_REQUEST[city]);
  if ($_REQUEST[flickr] != $_SESSION[flickr2]) 
     array_push($res, "flickr", $_REQUEST[flickr]);
  if ($_REQUEST[twitter] != $_SESSION[twitter2]) 
     array_push($res, "twitter", $_REQUEST[twitter]);
  if ($_REQUEST[web] != $_SESSION[web2] )
     array_push($res, "web", $_REQUEST[web]);
     
  $result = $conn->updateTableFromDB("profiles", $res, array("user_id", "'".$id."'"));
     if ($result) {
        header("Location: ../myPlanets.php");
    } else {
        print "Falló la inserción";
    }
?>
