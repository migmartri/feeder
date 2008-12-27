<?
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  loginRequired();
?>

<div id="div_login">
  <? print "<a href=\"profile.php\">".$login."</a>"; ?>
</div>
<div id="div_planets">
  Aun no tienes ningún planeta. <a href="newPlanet.php">Crear el primero.</a>
</div>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
