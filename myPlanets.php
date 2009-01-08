<?
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
  //Cargamos los planetas del usuario
  $conn = new Sgbd();
  $planets = $conn->selectFromDB("planets", array("*"), array("user_id" => $_SESSION["user"]));
?>

<div id="div_planets">
<? if(count($planets) == 0){
  print("Aun no tienes ningún planeta. <a href=\"newPlanet.php\">Crear el primero!</a>");}
else
  print("<a href=\"newPlanet.php\">Nuevo Planeta</a>");
  foreach($planets as $planet){
    include($_SERVER["DOCUMENT_ROOT"]."/templates/planetIndex.php"); 
  }
?>
</div>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
