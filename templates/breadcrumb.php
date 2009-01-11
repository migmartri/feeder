<div id="breadcrumb">
>
<?
$conn = new Sgbd();
$url = $_SERVER['REQUEST_URI'];

switch (true){
  case(preg_match("/^\/myPlanets.php?/", $url)):
    $breadcrumb = "Mis planetas";
    break;

  case(preg_match("/^\/planet.php?/", $url)):
    $planet = $conn->selectFromDB("first", "planets", array("name"), array("id" => $_GET['id']));
    $breadcrumb = "<a href='myPlanets.php'>Mis planetas</a> > Planeta ".$planet['name'];
    break;

  case(preg_match("/^\/subscriptions.php?/", $url)):
    $planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $_GET['planet_id']));
    $breadcrumb = "<a href='myPlanets.php'>Mis planetas</a> > ";
    $breadcrumb .= "<a href='/planet.php?id=".$planet['id']."'>Planeta ".$planet['name']."</a> > ";
    $breadcrumb .= "Suscripciones";
    break;
}
print $breadcrumb;
?>

</div>
