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
		<img src="images/feed.png" alt="Feed Logo"/>
	</div>
	<div id="text">
		<p>
			<span class="medium">
				Bienvenido a Feeder, un lector de noticias social. 
			</span>
		</p>
		<p class="centered">
			<span class="big"><a href="register.php" title="Formulario de registro!">Regístrate</a></span><br/>
			<span class="big">
				<span class='underline'>crea</span> tu planeta
				<br/>
				<span class="underline">comparte</span> noticias con tus amigos
			</span>
		</p>
    <?include_once ($_SERVER['DOCUMENT_ROOT']."/templates/lastPlanets.php");?>
	</div>
</div>
<div class="clear"></div>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
