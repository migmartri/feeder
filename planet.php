<?php
	$title = "Viendo el planeta número " . $_REQUEST['id'];
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
	include ($_SERVER['DOCUMENT_ROOT']."/lib/pagination.php");

	$util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();

  $planet = $conn->selectFromDB("first", "planets", array("*"), array("user_id" => $_SESSION["user"], "id" => $_REQUEST['id']));
  
  if(!$planet){ //FIXME, puede que no funcione con otras versiones de PHP
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../myPlanets.php");
  }
	

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

  //Elementos de esta página
  $posts = $pagination->getElements();
  //Números de página
  $pagination_links = $pagination->paginationLinks();
?>
  <h1>Planeta <?= $planet['name']?></h1>
<?
  echo($pagination_links);

  foreach($posts as $post){
    include($_SERVER["DOCUMENT_ROOT"]."/templates/post.php"); 
  }

  echo($pagination_links);
  include ($_SERVER['DOCUMENT_ROOT']."/templates/footer.php");
?>
