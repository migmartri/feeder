<? 
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
?>

<form action="ACCION AQUI" method="post">
  <label id="label_planeta" for="planeta">Nombre del planeta</label>
  <input id="planeta" name="planeta" type="text"/>
  <button id="submit" >Enviar</button>
</form>

<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
