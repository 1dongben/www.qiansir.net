<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="/application/view/user/passport.css">
  <title>钱权博客 - 注册</title>
</head>
<body>
  <div class="main">
    <div id="content">
      <div class="passport-header">
          注册博客账号，开始写作
      </div>
      <div class="passport-content">
        <form action="/user/register" method="post">
          <div class="passport-input-box">
              <input type="text" name="username" placeholder="注册用户名">
          </div>
          <div class="passport-input-box">
              <input type="password" name="password" placeholder="6-20位注册密码">
          </div>
          <div class="remember-box">
            <a href="/user/login" id="passport-link">已有账号?</a>
          </div>
          <div class="passport-button-box">
              <input type="submit" name="submit" value="注册" id="passport-submit">
          </div>
        </form>
      </div>
      
 
    </div>
  </div>
</body>
</html>
