<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="/static/css/main.css">

  <title>一路向北</title>
</head>

<body>
<?php require VIEW_PATH."/common/siderbar.php";?>
  <div class="main">
    <div class="article">
      <form action="" method="post">
        标题:<input name="title" type="text"><br />
        内容:<textarea id="editor" name="content" type="text/plain"></textarea>
        <script src="../article/ueditor/ueditor.config.js">/*引入配置文件*/</script>
        <script src="../srticle/ueditor/ueditor.all.js">/*引入源码文件*/</script> 
        <script type="text/javascript">
          var ue = UE.getEditor('editor', {
          initialFrameHeight: 300,
          initialFrameWeight: 300});
        </script><br />
        <select name="category">
        <option value=''>请选择</option>
        <?php foreach($category as $row):?>
          <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
        <?php endforeach;?></select>
        <input type="submit" value="发布">
      </form>
    </div>
  </div>
<?php require VIEW_PATH."/common/footer.php";?>