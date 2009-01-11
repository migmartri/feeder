<tr>
	<td class="large">
		<a href="<?= $subscription['url']?>"><?= $subscription['name']?></a>
	</td>
  <td class="centered">
	  <a href="/controllers/destroySuscription.php?planet_id=<?=$_GET['planet_id']?>&feed_id=<?= $subscription['id']?>" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Eliminar</a>
  </td>
</tr>
