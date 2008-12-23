<?php
include_once("templates/header.php");
session_start(); 

	include ("lib/tareas.php");
  include ("lib/sgbd.php");
  
  $login = $_SESSION['login'];
  
  $conn = new Sgbd();
  $login_id = $conn->selectFromDB("users", array("id"), array("login", "'".$login."'"));
  $id = $login_id[0][id];
  $result = $conn->selectFromDB("profiles", array("name", "surname", "phone", "city", "flickr", "twitter", "web"), array("user_id", "'".$id."'"));

  if (count($result) == 0) {
    print "Sin registros";
  } else {
    echo "<div id=\"profile\"><p>";
    echo "<label>Nombre: </label>".$result[0][name]."<br/>";
    echo "<label>Apellidos: </label>".$result[0][surname]."<br/>";
    echo "<label>Teléfono: </label>".$result[0][phone]."<br/>";
    echo "<label>Ciudad: </label>".$result[0][city]."<br/>";
    echo "<label>Flickr: </label>".$result[0][flickr]."<br/>";
    echo "<label>Twitter: </label>".$result[0][twitter]."<br/>";
    echo "<label>Home Page: </label>".$result[0][web]."<br/></p>";
    echo "<p><a href=\"editprofile.php\">Editar!</a></p>";
    echo "</div>";
    
    $_SESSION[name2] = $result[0][name];
    $_SESSION[surname2] = $result[0][surname];
    $_SESSION[phone2] = $result[0][phone];
    $_SESSION[city2] = $result[0][city];
    $_SESSION[flickr2] = $result[0][flickr];
    $_SESSION[twitter2] = $result[0][twitter];
    $_SESSION[web2] = $result[0][web];
  }
	include_once("templates/footer.php");
?>
