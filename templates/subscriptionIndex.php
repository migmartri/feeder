<tr>
	<td class="large">
		<a href="<?= $subscription['url']?>" title="ir a la web"><?= $subscription['name']?></a>
	</td>
  <td class="centered">
	  <a href="/controllers/destroySuscription.php?planet_id=<?=$_GET['planet_id']?>&amp;feed_id=<?= $subscription['id']?>" title="Elimina la suscripción" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Eliminar</a>
  </td>
</tr>
