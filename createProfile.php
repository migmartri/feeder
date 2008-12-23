<?php
session_start();
include ("templates/header.php");

$_SESSION[login] = "nordri";

?>
      <form action="controllers/insertProfile.php" method="post">
	  

        <div id="div_datos_personales">

          <fieldset>

            <legend>Crear Perfil</legend>

            <div id="div_name">
              <label id="label_name" for="name">Nombre:</label>
              <input id="name" name="name" type="text" />
            </div>

            <div id="div_surname">  
              <label id="label_surname" for="surname">Apellidos:</label>
               <input id="surname" name="surname" type="text" />
            </div>

            <div id="div_phone">  
              <label id="label_phone" for="phone">Teléfono:</label>
               <input id="phone" name="phone" type="text" />
            </div>

            <div id="div_city">  
              <label id="label_city" for="city">Ciudad:</label>
               <input id="city" name="city" type="text" />
            </div>
            
            <div id="flickr">  
              <label id="label_flickr" for="flickr">Flickr:</label>
               <input id="flickr" name="flickr" type="text" />
            </div>
            
            <div id="div_twitter">  
              <label id="label_twitter" for="twitter">Twitter:</label>
               <input id="twitter" name="twitter" type="text" />
            </div>
            
           <div id="div_web">  
              <label id="label_web" for="web">Sitio Web:</label>
               <input id="web" name="web" type="text" />
            </div>

          </fieldset>

        </div>
        <div id="div_submit">
          <button id="submit">Crear!</button>
        </div>
  <? include ("templates/footer.php"); ?>