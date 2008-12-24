<?
$login = $_COOKIE['login'];
if (count($login) == 0) {
  $_SESSION['flash_error'] = "Sesión inválida";
  header("Location: index.php");
}
include_once("templates/header.php");
?>

<div id="div_login">
  <? print "<a href=\"profile.php\">".$login."</a>"; ?>
</div>
<div id="div_planets">
  Aun no tienes ningún planeta. <a href="newPlanet.php">Crear el primero.</a>
</div>

<? include_once("templates/footer.php"); ?>
