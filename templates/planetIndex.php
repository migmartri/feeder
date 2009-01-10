<div id="planet_<?=$planet['id']?>" class="planet">
  <div class='planet_name'>
		<img src="/images/planet.png" />
    <a href="/planet.php?id=<?=$planet['id']?>"> <?=$planet['name']?></a> 
  </div>
	<div class='planet_description'>
		<p>
			<?= $util->truncate(strip_tags($planet['description']), 100) ?>
		</p>
	</div>
  <div class='planet_options'>
		<img src="/images/link.png" />
	  <a href="/subscriptions.php?planet_id=<?=$planet['id']?>">Suscripciones</a>
		<img src="/images/delete.png" />
    <a href="/controllers/destroyPlanet.php?id=<?=$planet['id']?>" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Eliminar</a>
  </div>
</div>
