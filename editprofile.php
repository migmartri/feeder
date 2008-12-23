<?php
session_start();
include ("header.php");

/* Actualizamos las variables */
$name = $_SESSION[name2];
$surname = $_SESSION[surname2];
$phone = $_SESSION[phone2];
$flickr = $_SESSION[flickr2];
$twitter = $_SESSION[twitter2];
$city = $_SESSION[city2];
$web = $_SESSION[web2];
?>
      <form action="updateprofile.php" method="post">
	  

        <div id="div_datos_personales">

          <fieldset>

            <legend>Editar Perfil</legend>

            <div id="div_name">
              <label id="label_name" for="name">Nombre:</label>
              <? echo "<input id=\"name\" name=\"name\" type=\"text\" value=\"".$name."\"/>"; ?>
            </div>

            <div id="div_surname">  
              <label id="label_surname" for="surname">Apellidos:</label>
              <? echo "<input id=\"surname\" name=\"surname\" type=\"text\" value=\"".$surname."\"/>";?>
            </div>

            <div id="div_phone">  
              <label id="label_phone" for="phone">Teléfono:</label>
              <? echo "<input id=\"phone\" name=\"phone\" type=\"text\" value=\"".$phone."\"/>";?>
            </div>

            <div id="div_city">  
              <label id="label_city" for="city">Ciudad:</label>
              <? echo "<input id=\"city\" name=\"city\" type=\"text\" value=\"".$city."\"/>"; ?>
            </div>
            
            <div id="flickr">  
              <label id="label_flickr" for="flickr">Flickr:</label>
              <? echo "<input id=\"flickr\" name=\"flickr\" type=\"text\" value=\"".$flickr."\"/>"; ?>
            </div>
            
            <div id="div_twitter">  
              <label id="label_twitter" for="twitter">Twitter:</label>
              <? echo "<input id=\"twitter\" name=\"twitter\" type=\"text\" value=\"".$twitter."\"/>"; ?>
            </div>
            
           <div id="div_web">  
              <label id="label_web" for="web">Sitio Web:</label>
              <? echo "<input id=\"web\" name=\"web\" type=\"text\" value=\"".$web."\"/>"; ?>
            </div>

          </fieldset>

        </div>
        <div id="div_submit">
          <button id="submit">Actualizar!</button>
        </div>
  <? include ("footer.php"); ?>