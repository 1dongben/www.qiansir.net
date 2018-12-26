<?php

class User_model{
	private $db;
	public function __construct(){
		$this->db = load_database();
	}

	public function add_user($username,$password){
		$register_time = time();
		$password = md5($password);
		$sql = "INSERT INTO user (username,password,register_time) VALUES ('$username','$password','$register_time')";
		//一般来说   insert操作最后返回的都是 last_insert_id 
		return  $this->db->insert_id;
	}

	public function get_user_by_username($username){
                $sql = "select * from user where username = '$username'";
                return $this->db->query($sql)->fetch_array(MYSQLI_ASSOC);
        }

	public function save_login($uid,$username){
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $username;
	}

	public function logout(){
		session_destroy();
	}

	public function check_statu($username){
		if (!$username) {
			error_page("请登录后再进行操作",'/user/login');
		}
	}

	public function get_ip(){
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
	$ip = getenv("HTTP_CLIENT_IP");
	else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip = getenv("HTTP_X_FORWARDED_FOR");
	else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip = getenv("REMOTE_ADDR");
	else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = "unknown";
	return $ip;
	}
}


?>
