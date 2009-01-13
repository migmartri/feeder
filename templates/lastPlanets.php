<?
  $conn = new Sgbd();
  $planets = $conn = $conn->findBySql("Select * from planets order by created_at desc limit 6");
?>
<div id="last_planets">
  <div id="last_planets_header">
    Últimos planetas creados:
  </div>
  <div id="last_planets_planets">
    <? foreach($planets as $planet){
      print("<div class='planet_item'>");
      print("<a href='/planet.php?id=".$planet['id']."'>".$planet['name']."</a>");
      print("</div>");
    }
  ?>
  </div>
  <div class="clear"></div>
  <div id="more">
    <a href="/planets.php" title="Ver todos los planetas">Ver todos</a>
  </div>
</div>
