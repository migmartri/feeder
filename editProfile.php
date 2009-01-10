<?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  $profile = $conn->selectFromDB("profiles", array("*"), array("user_id" => $_SESSION["user"]));
  //FIXME, permitir la peticion a la base de datos de un solo elemento
  $profile = $profile[0];
?>

<form action="controllers/updateProfile.php" method="post" onsubmit="return validatesProfile();">
  <div id="div_datos_personales" class="form form-profile">
    <fieldset>
      <legend>Editar Perfil</legend>
			<div class="fields">
				<div class="left">
					<div id="div_name">
						<label id="label_name" for="name">Nombre</label><br/>
						<input id="name" name="name" type="text" value="<?=$profile['name']?>"/>
					</div>
					<div id="div_surname">  
						<label id="label_surname" for="surname">Apellidos</label><br/>
						<input id="surname" name="surname" type="text" value="<?=$profile['surname']?>"/>
					</div>
					<div id="div_phone">  
						<label id="label_phone" for="phone">Teléfono</label><br/>
						<input id="phone" name="phone" type="text" value="<?=$profile['phone']?>"/>
					</div>
					<div id="div_city">  
						<label id="label_city" for="city">Ciudad</label><br/>
						 <input id="city" name="city" type="text" value="<?=$profile['city']?>"/>
					</div>
				</div>
				<div class="right">
					<div id="div_flickr">  
						<label id="label_flickr" for="flickr">Flickr</label><br/>
						<input id="flickr" name="flickr" type="text" value="<?=$profile['flickr']?>"/>
					</div>
					<div id="div_twitter">  
						<label id="label_twitter" for="twitter">Twitter</label><br/>
						<input id="twitter" name="twitter" type="text" value="<?=$profile['twitter']?>"/>
					</div>
					<div id="div_web">  
						<label id="label_web" for="web">Sitio Web</label><br/>
						<input id="web" name="web" type="text" value="<?=$profile['web']?>"/>
					</div>
				</div>
			</div>
    </fieldset>
	  <div id="div_submit">
 		  <button id="submit">Guardar</button>
 		</div>
  </div>
</form>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
