<?
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
  if(isset($_SESSION['user'])){
    header("Location: ./myPlanets.php");
  }
  $title = "Inicio";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  $util = new Utilities();
?>

<div id="home">
	<div id="image">
		<img src="images/feed.png" alt="Feed Logo">
	</div>
	<div id="text">
		<p>
			<span class="medium">
				Bienvenido a Feeder, un lector de noticias social. 
			</span>
		</p>
		<p class="centered">
			<a href="register.php" title="Formulario de registro!">Registrate</a><br/>
			<span class="big">
				<u>crea</u> tu planeta
				<br/>
				<u>comparte</u> noticias con tus amigos
			</span>
		</p>
	</div>
</div>
<div class="clear"></div>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
