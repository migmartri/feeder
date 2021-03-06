<?php

  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
  $title = "Edición de perfil";
  // Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 

  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  $profile = $conn->selectFromDB("first", "profiles", array("*"), array("user_id" => $_SESSION["user"]));
?>

<form action="controllers/updateProfile.php" method="post" onsubmit="return validatesProfile();">
  <div id="div_datos_personales" class="form form-profile">
    <fieldset>
      <legend>Editar Perfil</legend>
			<div class="fields">
				<div class="left">
					<div id="div_name">
						<label id="label_name" for="name">Nombre</label><br/>
						<input id="name" name="name" type="text" value="<?=$profile['name']?>" tabindex="1" />
					</div>
					<div id="div_surname">  
						<label id="label_surname" for="surname">Apellidos</label><br/>
						<input id="surname" name="surname" type="text" value="<?=$profile['surname']?>" tabindex="2" />
					</div>
					<div id="div_phone">  
						<label id="label_phone" for="phone">Teléfono</label><br/>
						<input id="phone" name="phone" type="text" value="<?=$profile['phone']?>" tabindex="3" />
					</div>
					<div id="div_city">  
						<label id="label_city" for="city">Ciudad</label><br/>
						 <input id="city" name="city" type="text" value="<?=$profile['city']?>" tabindex="4" />
					</div>
				</div>
				<div class="right">
					<div id="div_flickr">  
						<label id="label_flickr" for="flickr">Flickr</label><br/>
						<input id="flickr" name="flickr" type="text" value="<?=$profile['flickr']?>" tabindex="5" />
					</div>
					<div id="div_twitter">  
						<label id="label_twitter" for="twitter">Twitter</label><br/>
						<input id="twitter" name="twitter" type="text" value="<?=$profile['twitter']?>" tabindex="6" />
					</div>
					<div id="div_web">  
						<label id="label_web" for="web">Sitio Web</label><br/>
						<input id="web" name="web" type="text" value="<?=$profile['web']?>" tabindex="7" />
					</div>
				</div>
			</div>
    </fieldset>
	  <div id="div_submit">
      <input type="submit" value="Guardar" tabindex="8" />
 		</div>
  </div>
</form>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
