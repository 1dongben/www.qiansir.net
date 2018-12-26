<?php

class Oauth_model{
	private $db;
	public function __construct(){
		$this->db = load_database();
	}

	public function get_code($client_id,$callbakc_url){
		$url = "https://github.com/login/oauth/authorize?client_id=".$client_id."&state=2018&redirect_uri=".$callbakc_url;
		return $url;
	}

	public function get_access_token($client_id,$client_secret,$code,$callbakc_url){
		$url = "https://github.com/login/oauth/access_token?client_id=".$client_id."&client_secret=".$client_secret."&code=".$code."&redirect_uri=".$callbakc_url;
		$token = file_get_contents($url);
		return $token;
	}

	public function get_visitor_message($token){
		$url = "https://api.github.com/user?access_token=".$token;
		ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; GreenBrowser)');
		$user_message = file_get_contents($url);
		return $user_message;
	}

	public function search_visitor_by_id($id){
		$sql = "select name from visitor where git_id='$id'";
		return $this->db->query($sql)->fetch_array(MYSQL_ASSOC);
	}

	public function save_visitor_message($name,$git_id){
		$sql = "insert into visitor (name,git_id) values('$name','$git_id')";
		return $this->db->query($sql);
	}
}
?>
