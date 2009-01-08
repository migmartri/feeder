<? 
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  //Filtro de acceso
  $util = new Utilities();
  $util->loginRequired();
?>

<form action="/controllers/createPlanet.php" method="post" onsubmit="return validatesPlanet()">
  <fieldset>
    <legend>Nuevo Planeta</legend>
    <div id="div_name">
      <label id="label_name" for="name">Nombre del planeta</label>
      <input id="name" name="name" type="text" value="<?=$util->formValue('name')?>"/>
    </div>
    <div id="div_description">
      <label id="label_description" for="description">Descripción del planeta</label>
      <textarea id="description" name="description" rows="3" cols="30"/><?=$util->formValue('description')?></textarea>
    </div>

  <button id="submit" >Enviar</button>
</form>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
