<?
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
  //Cargamos los planetas del usuario
  $conn = new Sgbd();
  $planets = $conn->selectFromDB("all", "planets", array("*"), array("user_id" => $_SESSION["user"]));
?>

<div id="div_planets">
	<? if(count($planets) == 0){ ?>
		<div id="first_planet">
			<span class="big">Aun no tienes ningún planeta ;-(</span><br/>
			<span class="biggest">
				<a href="newPlanet.php">Crea el primero!</a>
			</span><br/>
			<a href="newPlanet.php"><img src="/images/add_big.png" /></a>
		</div>
	<? } else { ?>
		<div id="new_planet">
			<a href="newPlanet.php"><img src="/images/add.png" /></a>
			<a href="newPlanet.php">Nuevo Planeta</a>
		</div>
	<? } ?>
	<? foreach($planets as $planet){
			include($_SERVER["DOCUMENT_ROOT"]."/templates/planetIndex.php"); 
		 }		
	?>	
</div>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
