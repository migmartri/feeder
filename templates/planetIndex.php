<div id="planet_<?=$planet['id']?>" class="planet">
  <div class='planet_name'>
		<img src="/images/planet.png" alt="Planetita"/>
		<a href="/planet.php?id=<?=$planet['id']?>" title="<?= $planet['name']?>"> <?=$planet['name']?></a> 
  </div>
	<div class='planet_description'>
		<p>
			<?= $util->truncate(strip_tags($planet['description']), 100) ?>
		</p>
	</div>
  <div class='planet_options'>
		<img src="/images/link.png" alt="Accede a las suscripciones"/>
    <a href="/subscriptions.php?planet_id=<?=$planet['id']?>" title="Accede a las suscripciones">Suscripciones</a> (<?=$planet['feeds_count']?>)
		<img src="/images/delete.png" alt="Elimina este planeta" />
    <a href="/controllers/destroyPlanet.php?id=<?=$planet['id']?>" title="Elimina este planeta" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Eliminar</a>
  </div>
</div>
