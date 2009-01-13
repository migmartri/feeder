<div id="post_<?=$post['id']?>" class="post">
  <div class='post_head'>
    <div class="post_title">
			<a href="<?=$post['url']?>" title="<?= $post['title'] ?>"><?= $util->truncate($post['title'], 50); ?></a>
    </div>
		<div class="post_date">
			En
			<? $feed = $conn->findBySQL("SELECT name, url FROM feeds WHERE id = ". $post['feed_id']);	$feed = $feed[0];	?>
			<a href="<?= $feed['url'] ?>"><?= $feed['name']; ?></a>
			<?= strftime("el %A %d de %B del %Y", strtotime($post['published_at'])); ?>
    </div>
  </div>
	<div class="clear"></div>
  <div class="post_content" id="post_content_<?= $post['id'] ?>">
      <?
      //Si tenemos contenido y descripción
      if($post["content"] != '' && $post['description'] != '')
      {
        print($post['description']);
        print('<div class="post_more" id="post_more_'.$post['id'].'"><img src="/images/open.png" alt="Ver completo" /> <a href="#" onclick="getPostContent('.$post['id'].');return false" title="Ver el contenido completo del feed">Ver completo </a></div>');
      //Solo descripción
      }else if($post['description']){
        print($post['description']);
      //Contenido y no descripción, simulamos una descripción
      }else if($post["content"] != '' && $post["description"] == ''){
        print($util->truncate($post['content'], 300, " ", " [...]"));
				
        print('<div class="post_more" id="post_more_'.$post['id'].'"><img src="/images/open.png" alt="Ver completo" /> <a href="#" onclick="getPostContent('.$post['id'].');return false" title="Ver el contenido completo del feed">Ver completo </a></div>');
      }


if($util->loggedIn()){
  //FIXME, preparamos el array de ids para buscar luego, no me gusta
  $favourites_array = array(0);
  foreach($favourites as $favourite){
    array_push($favourites_array, $favourite['post_id']);
  }
  print("<div id='favourite_".$post['id']."' class='favourite'>");
  //Comprobams si ese favorito existe ya
  if(array_search($post['id'], $favourites_array) == null){
		print("<img src='/images/star_grey.png' alt='No favorito' /> ");
    print("<a href='#' onclick='setFavourite(".$post['id']."); return false;' title='Añadir a favoritos este post'>Favoritos </a>");
  }else{
		print("<img src='/images/star.png' alt='favorito' /> ");
    print("<a href='#' onclick='destroyFavourite(".$post['id']."); return false;' title='Quitar de favoritos'>Favoritos </a>");
  }
  print("</div>");
}
?>
  </div>
</div>
