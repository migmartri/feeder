<?
include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  $conn = new Sgbd();
  $planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $_GET['id']));

  if(!$planet){
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../index.php");
  }

  $posts = $conn->findBySql("SELECT * FROM posts WHERE feed_id IN (SELECT feed_id FROM feeds_planets WHERE planet_id =".$planet['id'].") ORDER BY published_at DESC LIMIT 10"); 

header('Content-type: text/xml; charset="UTF-8"', true);
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo
'<rss version="0.92">
    <channel>
         <docs>http://github.com/N3uro5i5/feeder/tree/master</docs>
         <title>Planeta'.$planet['name'].'</title>
         <link>'.$_SERVER['SERVER_NAME'].'/planet?id='.$planet['id'].'</link>
         <description>'.$planet['description'].'</description>
         <language>es</language>
         <managingEditor></managingEditor>
         <webMaster>admin@feeder.com</webMaster>
';
foreach($posts as $post) {
  echo "<item>" ;
  echo "<title><![CDATA[".$post['title']."]]></title>" ;
  echo "<link>".$post['url']."</link>";
  echo "<description><![CDATA[".$post['content']."]]></description>";
  echo "</item>";
}
echo "</channel>";
echo "</rss>";   
?>

