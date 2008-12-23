<? include_once("templates/header.php"); ?>

<p>Bienvenido a Feeder, un lector de noticias social. <a href="register">Registrate</a>, crea tu planeta y comparte noticias con tus amigos.</p>
<?
 foreach(PDO::getAvailableDrivers() as $driver)
 {
 echo $driver.'';
 }
?>

<? include_once("templates/footer.php"); ?>
