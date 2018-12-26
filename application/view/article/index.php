<?php require VIEW_PATH."/common/header.php";?>
<?php require VIEW_PATH."/common/siderbar.php";?>
  <div class="main">
    <div class="article-list">
      <div class="item">
      <?php foreach($article_list as $row):?>
        <a href="/article/detail/<?php echo $row['id'];?>" class="title"><?php echo $row['title'];?></a>
        <div class="status">发布于：<?php echo $row['create_time'];?> | 阅读：<?php echo $row['click_count'];?></div>
        <div class="content">
          <?php if (mb_strlen(strip_tags($row['content']))<200) :?>
              <?php echo strip_tags($row['content']);?>
          <?php else:?>
              <?php echo strip_tags(mb_substr($row['content'],0,200,'utf-8')).'...';?>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    </div>
  </div>
<?php require VIEW_PATH."/common/footer.php";?>