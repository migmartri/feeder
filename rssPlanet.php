<?
  include ($_SERVER['DOCUMENT_ROOT']."/lib/sgbd.php");
  $conn = new Sgbd();
  $planet = $conn->selectFromDB("first", "planets", array("*"), array("id" => $_GET['id'])) ;

  if(!$planet){
    $_SESSION['flash_error'] = "No existe el planeta al que quiere acceder o no tiene permisos para verlo.";
    header("Location: ../index.php");
  }

  $posts = $conn->findBySql("SELECT * FROM posts WHERE feed_id IN (SELECT feed_id FROM feeds_planets WHERE planet_id =".$planet['id'].") ORDER BY published_at DESC LIMIT 10"); 

  header('Content-type: text/xml; charset="UTF-8"', true);
  echo '<?xml version="1.0" encoding="UTF-8"?>';
  echo
  '<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
      <channel>
           <docs>http://github.com/N3uro5i5/feeder/tree/master</docs>
           <title>Planeta'.$planet['name'].'</title>
           <link>'.$_SERVER['SERVER_NAME'].'/planet?id='.$planet['id'].'</link>
           <description>'.$planet['description'].'</description>
           <language>es</language>
           <webMaster>admin@feeder.com</webMaster>
  ';
  foreach($posts as $post) {
    $description=substr($post['content'],0,300)."...";
    echo "<item>" ;
    echo "<title><![CDATA[".$post['title']."]]></title>" ;
    /* echo "<pubDate>".$post["created_at"]."</pubDate>"; */
    echo "<link>".$post['url']."</link>";
    echo "<description><![CDATA[".$description."]]></description>";
    echo "<content:encoded><![CDATA[".$post['content']."]]></content:encoded>";
    echo "</item>";
  }
  echo "</channel>";
  echo "</rss>";   
?>

