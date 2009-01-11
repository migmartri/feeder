<?php
  include ($_SERVER['DOCUMENT_ROOT']."/templates/header.php");
  
  $conn = new Sgbd();
  $planets = $conn->findBySql("select p.name, u.login, p.created_at from users u, planets p where u.id = p.user_id order by p.created_at");
  
  
?>
  <div id="planets_list">
  <table border="1" align="center">
    <tr>
      <th>Usuario</th>
      <th>Planeta</th>
      <th>Creado</th>
    </tr>
    <?foreach($planets as $row) {
        print "<tr>";
          print "<td>".$row[0]."</td>";
          print "<td>".$row[1]."</td>";
          print "<td>".$row[2]."</td>";
        print "</tr>";
      }
    ?>
    </tr>
  </table>
<?
  include ($_SERVER['DOCUMENT_ROOT']."/templates/footer.php");
?>