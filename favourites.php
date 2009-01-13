<?php
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");

  $title = "Viendo el planeta favoritos";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  
	$util = new Utilities();
  $util->loginRequired();
	//Página actual
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1; 

  //Num total de elementos
  $favourites = $conn->selectFromDB("all", "favourites", array("post_id"), array("user_id" => $_SESSION['user']));
  $num_favourites = count($favourites);

  //Paginamos
  $pagination = new Pagination($num_favourites, 10, $current_page, "SELECT * FROM posts WHERE id IN (SELECT post_id FROM favourites WHERE user_id =".$_SESSION['user']." ORDER BY created_at DESC)");

  //Elementos de esta página
  $posts = $pagination->getElements();
  //Números de página
  $pagination_links = $pagination->paginationLinks();

?>
<div id="planet">
	<div id="planet_data">
		<div id="planet_name" class="big">
			Planeta: <strong>de tus favoritos</strong>
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
