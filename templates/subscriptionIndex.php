<tr>
  <td><?= $subscription['name']?></td>
  <td><?= $subscription['url'] ?> </td>
  <td>
  <a href="/controllers/destroySuscription.php?planet_id=<?=$_GET['planet_id']?>&feed_id=<?= $subscription['id']?>" onclick="if (!confirm('¿Estás seguro?')) {return false;}">Eliminar</a>
  </td>
</tr>
