<?php
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");

  $conn = new Sgbd();
  $planet = $conn->selectFromDB("first", "planets", array("*"), array("user_id" => $_SESSION["user"], "id" => $_REQUEST['id']));
  
  if(!$planet){ 
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../myPlanets.php");
  }

	$title = "Viendo el planeta ".$planet['name'];
  $header_custom_content = "<link rel='alternate' type='application/rss+xml' title='Rss del planeta' href='rssPlanet.php?id=".$_GET['id']."' />";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 

	$util = new Utilities();
  $util->loginRequired();

	//Página actual
  if(isset($_GET['page'])){
    $current_page = $_GET['page'];
  }else{
    $current_page = 1; 
  }

  //Num total de elementos
  $num_posts = $conn->findBySql("SELECT count(*) as num FROM posts WHERE feed_id IN (SELECT feed_id FROM feeds_planets WHERE planet_id =".$planet['id'].")");

  //Paginamos
  $pagination = new Pagination($num_posts[0]["num"], 10, $current_page, "SELECT * FROM posts WHERE feed_id IN (SELECT feed_id FROM feeds_planets WHERE planet_id =".$planet['id'].") ORDER BY published_at DESC");

	$count_feeds = $conn->countFromDB("feeds_planets", array("planet_id"), array("planet_id" => $planet['id']));
  //Elementos de esta página
  $posts = $pagination->getElements();
  //Números de página
  $pagination_links = $pagination->paginationLinks();
?>
<div id="planet">
	<div id="planet_data">
		<div id="planet_name" class="big">
			Planeta: <strong><?= $planet['name']?></strong>
			<a href="/rssPlanet.php?id=<?= $_GET['id'] ?>"><img src="/images/rss.png" alt="rss de este planeta"/></a>
		</div>
		<div id="planet_info">
			Tiene <?= $count_feeds ?> suscripcion<? if($count_feeds != 1){ print "es";}?>. <a href="/newSubscription.php" title="Añade una nueva suscripcion">¿Añadir otra?</a>
		</div>
	</div>
	<? echo($pagination_links); ?>
	
	<div id="planet_posts">	
		<? foreach($posts as $post){
  	  	 include($_SERVER["DOCUMENT_ROOT"]."/templates/post.php"); 
  		 } 
		?>
	</div>

	<? echo($pagination_links); ?>
</div>

<?
  include ($_SERVER['DOCUMENT_ROOT']."/templates/footer.php");
?>
