<? include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php");
  $conn = new Sgbd();
  $util = new Utilities();
  $planets = $conn->selectFromDB("planets", array("*"), array("id" => $_GET["planet_id"]));
  $planet = $planets[0] #FIXME
?>

<form action="/controllers/createSubscription.php" method="post" onsubmit="return validatesSubscription()">
	<div id="id_nueva_suscripcion">
		<fieldset>
		<legend>Nueva Suscripción para el planeta <?= $planet['name']?></legend>
			<div id="div_name">
				<label id="label_name" for="name">Nombre</label>
				<input id="name" name="name" type="text" size=30 value="<?=$util->formValue('name')?>"/>
			</div>
			<div id="div_url">
				<label id="label_url" for="url">Dirección</label>
				<input id="url" name="url" size=30 type="text" value="<?=$util->formValue('url')?>"/>
			</div>
		<? //Cargamos el planet_id en un hidden field
			if(isset($_GET['planet_id']))
				$planet_id = $_GET['planet_id'];
			else
				$planet_id = $util->formValue('planet_id');
		?>
		<div id="div_planet_id">
			<input id="planet_id" name="planet_id" size=30 type="hidden" value="<?= $planet_id ?>"/>
		</div>
		<div id="id_submit">
			<button id="submit" >Crear</button>
		</div>
	</div>
</form>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
