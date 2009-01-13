<?
$conn = new Sgbd();
$util = new Utilities();
$url = $_SERVER['REQUEST_URI'];
$breadcrumb = '';

if(!$util->loggedIn()){
  return;
}

switch (true){
  case(preg_match("/^\/myPlanets.php?/", $url)):
    $breadcrumb .= "Mis planetas";
    break;

  case(preg_match("/^\/planet.php?/", $url)):
    if(!isset($planet))$planet = $conn->selectFromDB("first", "planets", array("name"), array("id" => $_GET['id']));
    $breadcrumb .= "<a href='myPlanets.php' title='Accede a tus planetas'>Mis planetas</a> » ".$planet['name'];
    break;

  case(preg_match("/^\/subscriptions.php?/", $url)):
    if(!isset($planet))$planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $_GET['planet_id']));
    $breadcrumb .= "<a href='myPlanets.php' title='Accede a tus planetas'>Mis planetas</a> » ";
    $breadcrumb .= "<a href='/planet.php?id=".$planet['id']."' title='". $planet['name'] ."'> ".$planet['name']."</a> » ";
    $breadcrumb .= "Suscripciones";
    break;

  case(preg_match("/^\/newSubscription.php?/", $url)):
    //FIXME ESTO nos pasa por no devolver el parametro por la url en el caso de error de validación.
    if(isset($_GET['planet_id'])){
      $planet_id = $_GET['planet_id'];
    }else{
      $planet_id = $_SESSION['form_values']['planet_id'];
    }
    $planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $planet_id));
    $breadcrumb .= "<a href='myPlanets.php' title='Accede a tus planetas'>Mis planetas</a> » ";
    $breadcrumb .= "<a href='/planet.php?id=".$planet['id']."' title='". $planet['name'] ."'> ".$planet['name']."</a> » ";
    $breadcrumb .= "<a href='/subscriptions.php?planet_id=".$planet['id']."' title='Accede a las suscripciones'> Suscripciones </a> » ";
    $breadcrumb .= "Nueva suscripción";
    break;

  case(preg_match("/^\/newPlanet.php?/", $url)):
    $breadcrumb .= "<a href='myPlanets.php' title='Accede a tus planetas'>Mis planetas</a> » ";
    $breadcrumb .= "Nuevo planeta";
    break;
}

if($breadcrumb != ""){
  print('<div id="breadcrumb">');
  print $breadcrumb;
  print('</div>');
}

?>

