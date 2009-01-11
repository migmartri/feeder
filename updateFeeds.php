<?
	$title = "Actualización de todos los feeds";
  include_once($_SERVER["DOCUMENT_ROOT"]."/templates/header.php"); 
?>
<h1>Actualización de todos los feeds</h1>
<?
  $feed = new Feed();
  $feed->refreshAllFeeds();
  include_once ($_SERVER["DOCUMENT_ROOT"]."/templates/footer.php");
?>
