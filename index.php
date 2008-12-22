<? include_once("header.php"); ?>
<div id="error">
			<?if (strlen($_SESSION['error_login']) !=0) {
				print($_SESSION['error_login']);
			}?>		
		</div>
		<div id="content">
			Bienvenido a Feeder, un lector de noticias social. <a href="register.php">Registrate</a>, crea tu planeta
			y comparte noticias con tus amigos.
		</div>
<? include_once("footer.php"); ?>
