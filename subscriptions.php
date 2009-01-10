<?
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
  $util = new Utilities();
  $util->loginRequired();
  $conn = new Sgbd();

  //Cargamos el planeta, forzando que debe ser del usuario actual y verificamos que tenemos acceso
  $planets = $conn->selectFromDB("planets", array("*"), array('user_id' => $_SESSION['user'], 'id' => $_GET['planet_id']));
  if(count($planets)==0){
    $_SESSION['flash_error'] = "Acceso denegado!";
    header("Location: myPlanets.php");
  }

  //Suscripciones
  $subscriptions = $conn->findBySql("SELECT * FROM feeds inner join feeds_planets on feeds_planets.feed_id = feeds.id where feeds_planets.planet_id=".$planets[0]['id']);
?>

<?
  if(count($subscriptions)==0){
    print("Este planeta todavía no tienen <b>ningúna</b> suscripción");
  }
?>
<div id="suscriptions">
  <table>
    <tr>
      <th>Nombre</th>
      <th>Url</th>
      <th>Opciones </th>
    </tr>
    <?
      foreach($subscriptions as $subscription){
        include($_SERVER["DOCUMENT_ROOT"]."/templates/subscriptionIndex.php"); 
      }
    ?>
  </table>
</div>


<p><a href="/newSubscription.php?planet_id=<?=$_GET['planet_id']?>">Nueva suscripción </a></p>
<? include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php"); ?>
