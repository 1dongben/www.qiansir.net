<?php require VIEW_PATH."/common/header.php";?>
<?php require VIEW_PATH."/common/siderbar.php";?>
  <div class="main">
    <div class="article">
      <h1 class="title"><?php echo $detail_data['title'];?></h1>
      <div class="status">发布于：<?php echo $detail_data['create_time'];?> | 阅读：<?php echo $detail_data['click_count'];?></div>
      <div class="content">
        <div><?php echo $detail_data['content']?></div>
      </div>   
    </div>
    <div class="comment">
      <form method="post" action="/article/detail/<?php echo $detail_data['id'];?>">
        <input id="submit-box" type="text" name="content" value="发表评论"><br>
        <input id="submit-button" type="submit" value="提交">
        
      </form>
    </div>
      <?php foreach($comment_data as $row): ?>
        <div class="comment">
          <p><?php echo $row['content'];?></p>
          <p id="message"><?php echo $row['user_name']?></p>
          <p id="message"><?php echo $row['create_time']?></p>
        </div>
      <?php endforeach; ?>
  </div>
<?php require VIEW_PATH."/common/footer.php";?>