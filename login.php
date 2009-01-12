<?
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
  if(isset($_SESSION['user'])){
    header("Location: ./myPlanets.php");
  }
	$title = "Login";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
?>

<div id="div_form" class='form form-register'>
  <form action="controllers/login.php" method="post" onSubmit="true || return validatesLogin();">
    <div id="div_datos_personales">
      <fieldset>
        <legend>Inicio de sesión</legend>
				<div class="fields">
					<div id="div_login">
						<label id="label_login" for="login">Login</label><br/>
						<input id="login" class="input_big" name="login" type="text"/>
					</div>

					<div id="div_password"> 
						<label id="label_password" for="password">Password</label><br/>
						<input id="password" name="password" type="password"/>
					</div>
				</div>
      </fieldset>
    </div>
    <div id="div_submit">
      <button id="submit">¡Entrar!</button>
    </div>
  </form>
</div>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
