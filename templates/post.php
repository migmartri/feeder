<div id="post_<?=$post['id']?>" class="post">
  <div class='post_head'>
    <div class="post_title">
      <a href="<?=$post['url']?>" target="_blank"><?= $post['title']?></a>
    </div>
    <div class="post_date">
      <?= $post['published_at']?>
    </div>
  </div>
  <div class="post_content">
    <?= $post['content']?>
  </div>
</div>
