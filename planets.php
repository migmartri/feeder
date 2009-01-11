<?php
  include ($_SERVER['DOCUMENT_ROOT']."/lib/pagination.php");
  include ($_SERVER['DOCUMENT_ROOT']."/templates/header.php");
  
  $conn = new Sgbd();
  $planets = $conn->findBySql("select p.name, u.login, p.created_at, p.id from users u, planets p where u.id = p.user_id order by p.created_at");
  
     //Página actual
    if(isset($_GET['page'])){
      $current_page = $_GET['page'];
    }else{
      $current_page = 1; 
    }
    //Num total de elementos
    $num_planets = $conn->countFromDB("planets", array("name"), array());
    
    //Paginamos
    $pagination = new Pagination($num_planets[0]["num"], 10, $current_page, "select count(*) as num from users u, planets p where u.id = p.user_id");

    //Elementos de esta página
    $nplanets = $pagination->getElements();
    //Números de página
    $pagination_links = $pagination->paginationLinks();
    print_r($num_planets);
    echo($pagination_links);
?>
  <div id="planets_list">
  <table border="1" align="center">
    <tr>
      <th>Planeta</th>
      <th>Usuario</th>
      <th>Creado</th>
    </tr>
    <?    
    foreach($planets as $row) {
        print "<tr>";
          print "<td><a href=\"planet.php?id=".$row[3]."\">".$row[0]."</a></td>";
          print "<td>".$row[1]."</td>";
          print "<td>".$row[2]."</td>";
        print "</tr>";
      }
    ?>
    </tr>
  </table>
<?
  echo($pagination_links);
  include ($_SERVER['DOCUMENT_ROOT']."/templates/footer.php");
?>