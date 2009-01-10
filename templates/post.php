<div id="post_<?=$post['id']?>" class="post">
  <div class='post_head'>
    <div class="post_title">
      <?= $post['title']?>
    </div>
    <div class="post_date">
      <?= $post['published_at']?>
    </div>
  </div>
  <div class="post_content">
    <?= $post['content']?>
  </div>
</div>
