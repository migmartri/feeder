<div id="post_<?=$post['id']?>" class="post">
  <div class='post_head'>
    <div class="post_title">
      <a href="<?=$post['url']?>" target="_blank" title="Ver post en su web original"><?= $post['title']?></a>
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
    <? if($post["content"] != '')
    {
      print($post['content']);
    }else{
      print($post['description']);
    }
    ?>
  </div>
</div>
