<? include_once("header.php") ?>

<div id="div_form">
	<form action="checkLogin.php" method="post">
		<div id="div_datos_personales">
			<fieldset>
				<legend>Datos personales</legend>
				<div id="div_login">
				<label id="label_login" for="login">Login:</label>
				<input id="login" name="login" type="text"/>
				</div>

				<div id="div_password"> 
					<label id="label_password" for="password">Password:</label>
					<input id="password" name="password" type="password"/>
				</div>
			</fieldset>
		</div>
		<div id="div_submit">
			<button id="submit">¡Entrar!</button>
		</div>
	</form>
<? include_once("footer.php");?>
