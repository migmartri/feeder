<?
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
  //Cargamos el planeta, forzando que debe ser del usuario actual y verificamos que tenemos acceso
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();
  $planet = $conn->selectFromDB("first", "planets", array("*"), array('user_id' => $_SESSION['user'], 'id' => $_GET['planet_id']));
  if(!$planet){
    $_SESSION['flash_error'] = "Acceso denegado!";
    header("Location: myPlanets.php");
  }
	$title = "Suscripciones";

  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  $util = new Utilities();
  $util->loginRequired();

  //Suscripciones
  $subscriptions = $conn->findBySql("SELECT * FROM feeds inner join feeds_planets on feeds_planets.feed_id = feeds.id where feeds_planets.planet_id=".$planet['id']);
?>

<? if(count($subscriptions)==0) { ?>
	<div id="first_subscription">
		<span class="big">
		  Este planeta todavía no tiene <b>ninguna</b> suscripción
		</span><br/>
		<span class="biggest">		
			<a href="/newSubscription.php?planet_id=<?=$_GET['planet_id']?>" title="Añade una nueva suscripción">Crea una nueva</a>
		</span><br/>
		<a href="/newSubscription.php?planet_id=<?=$_GET['planet_id']?>" title="Añade una nueva suscripción">
			<img src="/images/add_big.png" alt="Añade una nueva suscripción" />
		</a>
	</div>
<? } else { ?>
	<div id="new_subscription">
		<a href="/newSubscription.php?planet_id=<?=$_GET['planet_id']?>" title="Añade una nueva suscripción">
			<img src="/images/feed_add.png" alt="Añade una nueva suscripción"/>
		</a>
		<a href="/newSubscription.php?planet_id=<?=$_GET['planet_id']?>" title="Añade una nueva suscripción">Nueva suscripción </a>
	</div>
	<div id="suscriptions">
		<table class="table_center">
			<tr>
				<th><img src="/images/feed_little.png" alt="Logo feed" /> Feed</th>
				<th><img src="/images/feed_delete.png" alt="Logo feed delete" /> Opciones</th>
			</tr>
			<?
				foreach($subscriptions as $subscription){
					include($_SERVER["DOCUMENT_ROOT"]."/templates/subscriptionIndex.php"); 
				}
			?>
		</table>
	</div>
<?}?>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
