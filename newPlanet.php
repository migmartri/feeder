<? 
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
	$title = "Nuevo planeta";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
?>
<div class="clear"></div>
<form action="/controllers/createPlanet.php" method="post" onsubmit="return validatesPlanet()">
	<div id="div_nuevo_planeta" class="form form-planet">
		<fieldset>
			<legend>Nuevo Planeta</legend>
			<div class="fields">
				<div id="div_name">
					<label id="label_name" for="name">Nombre del planeta</label><br/>
					<input id="name" name="name" type="text" value="<?=$util->formValue('name')?>" tabindex="1" />
				</div>
				<div id="div_description">
					<label id="label_description" for="description">Descripción del planeta</label><br/>
					<textarea id="description" name="description" rows="3" cols="30" tabindex="2" ><?=$util->formValue('description')?></textarea>
				</div>
			</div>
		</fieldset>
		<div id="div_submit">
      <input type="submit" value="Enviar" tabindex="3" />
		</div>
	</div>
</form>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
