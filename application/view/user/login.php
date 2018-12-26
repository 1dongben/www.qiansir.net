<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="/application/view/user/passport.css">
  <title>钱权博客 - 登录</title>
</head>
<body>
  <div class="main">
    <div id="content">
      <div class="passport-header">
          登录博客账号，开始写作
      </div>
      <div class="passport-content">
        <form action="/user/login" method="post">
          <div class="passport-input-box">
              <input type="text" name="username" placeholder="用户名">
          </div>
          <div class="passport-input-box">
              <input type="password" name="password" placeholder="登陆密码">
          </div>

          <div class="remember-box">
            <label>
                <input name="login_status" type="checkbox" value="login">&nbsp;一周免登录
            </label>
            <a href="/user/register" id="passport-link">注册账号</a>
          </div>
          <div class="passport-button-box">
              <input type="submit" name="submit" value="登录" id="passport-submit">
          </div>
          <div class="login_by_git">
            <a href="/oauth/get_code" id="login-git"><p>第三方登录</p></a>
          </div>
        </form>
      </div>
      
 
    </div>
  </div>
</body>
</html>
