<? 
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php");
  $conn = new Sgbd();
  $util = new Utilities();
  //cargamos planet id, puede venir de dos fuentes
  if(isset($_GET['planet_id']))
    $planet_id = $_GET['planet_id'];
  else
    $planet_id = $util->formValue('planet_id');
  
  $planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $planet_id));
?>

<form action="/controllers/createSubscription.php" method="post" onsubmit="return validatesSubscription()">
  <fieldset>
  <legend>Nueva Suscripción para el planeta <?= $planet['name']?></legend>
    <div id="div_name">
      <label id="label_name" for="name">Nombre</label>
      <input id="name" name="name" type="text" size=30 value="<?=$util->formValue('name')?>"/>
    </div>
    <div id="div_url">
      <label id="label_url" for="url">Dirección</label>
      <input id="url" name="url" size=30 type="text" value="<?=$util->formValue('url')?>"/>
    </div>
  <div id="div_planet_id">
    <input id="planet_id" name="planet_id" size=30 type="hidden" value="<?= $planet_id ?>"/>
  </div>
  <button id="submit" >Crear</button>
</form>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
