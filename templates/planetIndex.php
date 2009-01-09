<div id="planet_<?=$planet['id']?>" class="planet">

  <div class='options'>
  <a href="/subscriptions.php?planet_id=<?=$planet['id']?>">Suscripciones</a> |
    <a href="/controllers/destroyPlanet.php?id=<?=$planet['id']?>" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Borrar</a>
  </div>

  <div class='planet_info'>
    <div class='planet_name'>
      <a href="/planet.php?id=<?=$planet['id']?>"> <?=$planet['name']?></a> 
    </div>
    <div class='planet_description'>
      <p>
        <?= $planet['description']?>
      </p>
    </div>
  </div>



</div>
