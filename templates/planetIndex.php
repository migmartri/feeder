<div id="planet_<?=$planet['id']?>" class="planet">

  <div class='options'>
    <a href="#">Editar</a> |
    <a href="/controllers/destroyPlanet.php?id=<?=$planet['id']?>" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Borrar</a>
  </div>

  <div class='planet_info'>
    <div class='planet_name'>
      <a href="/planet?id=<?=$planet['id']?>"> <?=$planet['name']?></a> 
    </div>
    <div class='planet_description'>
      <p>
        <?= $planet['description']?>
      </p>
    </div>
  </div>



</div>
