<?
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/imports.php");
  include_once ($_SERVER['DOCUMENT_ROOT']."/templates/header.php");

  $conn = new Sgbd();
  $total = $conn->findBySql("SELECT count(*) as num FROM planets");
  #Paginación
	//Página actual
  if(isset($_GET['page'])){
    $current_page = $_GET['page'];
  }else{
    $current_page = 1; 
  }
  $pagination = new Pagination($total[0]['num'], 5, $current_page, "select p.name, p.description, u.login, p.feeds_count, p.id from users u, planets p where u.id = p.user_id order by p.created_at desc");
  //Elementos de esta página
  $planets = $pagination->getElements();
  //Números de página
  $pagination_links = $pagination->paginationLinks();

?>
<div id="planet_name" class="big">
  Todos los planetas
</div>

<table class="table_center">
  <tr>
    <th>Nombre del Planeta</th>
    <th>Descripción</th>
    <th>Creador</th>
    <th>Nº de feeds</th>
  </tr>
  <?foreach($planets as $planet) {
    print "<tr>";
      print "<td class='large'><a href='/planet.php?id=".$planet[4]."' title='Acceder al planeta'>".$planet[0]."</a></td>";
      print "<td class='large'>".$planet[1]."</td>";
      print "<td class='large'>".$planet[2]."</td>";
      print "<td class='centered'>".$planet[3]."</td>";
    print "</tr>";
        }
      ?>
  </tr>
</table>
<?
  echo($pagination_links);
  include ($_SERVER['DOCUMENT_ROOT']."/templates/footer.php");
?>
 
