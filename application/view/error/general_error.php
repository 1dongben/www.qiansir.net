<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css">
  <style>
    body{
    background: #454545;
    /* set background tensile */
    background-size: 100% 100%;
    -moz-background-size: 100% 100%;
    margin: 0;
    padding: 0;
}

#content{
    width: 420px;
    background: #FFF;
    padding: 30px;
    margin-top: 15%;
    margin-left: auto;
    margin-right: auto;
    display: block;
}


#error-submit{
    text-align: center;
    text-decoration: none;
    padding: 10px;
    display: block;
    background-color: #454545;
    color: #ffffff;
    font-size: 16px;
    width: 100%;
    border: 1px solid #454545;
}

#error-submit:hover{
    cursor: pointer;
}


  </style>
  <title>出错啦！</title>
</head>
<body>
  <div class="main">
    <div id="content">
      <h1>出错啦~</h1>
      <p><?php echo $message;?></p>
      <a href="<?php if($link):?><?php echo $link;?><?php else:?>javascript:history.go(-1);<?php endif;?>" id="error-submit">朕知道了</a> 
    </div>
  </div>
</body>
</html>
