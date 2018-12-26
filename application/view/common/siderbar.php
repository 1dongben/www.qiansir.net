  <div class="side-bar">
    <div class="header">
      <a href="/article/index" class="logo">一路向北</a>
      <div class="intro">当一切看起来无可挽回之时，我跑去看石匠重复捶击他面前的岩石一百次，而那块石头连一个裂缝都没有露出来。接下来的第一百零一次捶击之时，此石一分为二。不是因为这一次捶击，而是因为你的始终如一。</div>
    </div>
    <div class="nav">
      <a href="/" class="item">文章列表</a>
      <a href="javascript:void(0);" class="item">关于我们</a>
    </div>
    <div class="tag-list">
      <?php if(isset($_SESSION['uid'])):?>
        <?php echo $_SESSION['username'];?> (UID: <?php echo $_SESSION['uid'];?>) <a href="/user/logout">退出</a>
      <?php else:?>
       <a href="/user/login" class="item">登录</a>
       <!-- <a href="/?c=user&m=register" class="item">注册</a> -->
      <?php endif;?>
      <a href="/article/publish">发布</a>    
      <a href="#" class="item"># 随笔感想</a>
      <a href="#" class="item"># 技术学习</a>
      <a href="#" class="item"># 羽毛球</a>
    </div>
  </div>
