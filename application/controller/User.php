<?php

class User{
	public function register(){
		if ($_POST) {
			$username = isset($_POST['username'])?clean($_POST['username']):'';
			$password = isset($_POST['password'])?clean($_POST['password']):'';
			if (empty($username)) {
				error_page("请输入用户名",'');
			}
			if (!isset($password[5]) || isset($password[20])) {
				error_page("密码长度不符合要求",'');
			}
			$user = load_model('user_model');
			$user_info = $user->get_user_by_username($username);

			if (!empty($user_info)){
				error_page("用户名已经被注册过",'');
			}else{
				$uid = $user->add_user($username,$password);
				$user->save_login($uid, $username);
				//var_dump($password);die;
				header("location:/article/index");
			}
		}else{
			load_view('user/register');
		}
	}
	public function login(){
		if ($_POST) {
			$username = isset($_POST['username'])?clean($_POST['username']):'';
			$password = isset($_POST['password'])?clean($_POST['password']):'';
			if (empty($username) || empty($password)) {
				error_page("请输入用户名或密码",'');
			}
			$user = load_model('user_model');
			$user_info = $user->get_user_by_username($username);
			$user_ip = $user->get_ip();
			if (empty($user_info)) {
				error_page("用户名输入有误，请检查",'');
			}
			if (md5($password) == $user_info['password']) {
				$user->save_login($user_info['id'], $username);
				header("location:/article/index");
			}else{
				error_page("密码输入有误，请检查",'');
			}
		}else{
			load_view('user/login');
		}
	}
	
	public function logout(){
		$user = load_model('user_model');
		$user->logout();
		header("location:/article/index");
	}


	public function register_git(){
		$register_git = load_model('user_model');
		$code = urlencode($_GET['code']);
		$url = "https://github.com/login/oauth/access_token?client_id=44ec4ada6fcfbdab1668&client_secret=12e72b1c1a9c6a173f0f4d7faaf9b4654ebfa53c&code=".$code."&redirect_uri=http://blog.com/user/register_git";
		$ret = file_get_contents($url,true);
		$token = explode('&',$ret);
		$access_token = explode('=',$token[0]);
		$get_message_url = "https://api.github.com/user?access_token=".$access_token[1];
		//header("location:$get_message_url");
		ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
		$message = json_decode(file_get_contents($get_message_url));
		d($message);
		
		//为什么这里写json_decode(file_get_contents($url),true)时无法吧文件写入到字符串
	}
	
		/*
		V1.0版本注册和登录
			过滤和验证应该写在控制器里面，然后再调用模型的方法，模型不负责验证数据的可靠性
		if(isset($_POST['submit'])){
			$user = load_model('user_model');
			$user->check($_POST['username'],$_POST['password'],__FUNCTION__);
						var_dump(1);die;
			$args = $user->sql_injection($_POST['username'],$_POST['password']);
			$user->register($args[0],$args[1]);
			header("location:/?c=article&m=index");
		}else{
			load_page('user/register');
		}
	
	public function login(){
		if(isset($_POST['submit'])){
			$user = load_model('user_model');
			$user->check($_POST['username'],$_POST['password'],__FUNCTION__);
			//$args = $user->sql_injection($_POST['username'],$_POST['password']);
			$user->login($args[0],$args[1]);
			$user->login_status($args[0],$_POST['login_status']);
			header("location:/?c=article&m=index");				
		}else{
			load_page('user/login');
			var_dump($_POST);
		}
	}*/
}

?>
