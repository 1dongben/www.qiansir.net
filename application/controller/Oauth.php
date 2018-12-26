<?php

class Oauth{
	private $client_id;
	private $client_secret;
	private $callback_url;

	public function __construct(){
		$this->client_id = '44ec4ada6fcfbdab1668';
		$this->client_secret = '12e72b1c1a9c6a173f0f4d7faaf9b4654ebfa53c';
		$this->callback_url = 'http://www.qiansir.net/oauth/get_message/';
	}

	public function get_code(){
		$oauth = load_model('oauth_model');
		$url = $oauth->get_code($this->client_id,$this->callback_url);
		header("location:$url");
	}

	public function get_message(){
		$code = clean($_GET['code']);
		$oauth = load_model('oauth_model');
		$visitor = load_model('user_model');
		$token = $oauth->get_access_token($this->client_id,$this->client_secret,$code,$this->callback_url);
		parse_str($token,$token);
		$access_token = $token['access_token'];
		$user_message = substr($oauth->get_visitor_message($access_token),1,33);
		//处理获取到的用户信息可能还有简单的办法，但是我不知道。。。
		$user_message = str_replace(':','=',$user_message);
		$user_message = str_replace(',','&',$user_message);
		parse_str(str_replace('"','',$user_message),$user_message);

		$visitor_name = $user_message['login'];
		$visitor_id = $user_message['id'];
		if(!$oauth->search_visitor_by_id($visitor_id)){
			$oauth->save_visitor_message($visitor_name,$visitor_id);
		}
		$visitor->save_login($visitor_id,$visitor_name);
		header("location:/article/index");

	}
}
//这是获取到的用户信息：{"login":"1dongben","id":41467496,"node_id":"MDQ6VXNlcjQxNDY3NDk2","avatar_url":"https://avatars1.githubusercontent.com/u/41467496?v=4","gravatar_id":"","url":"https://api.github.com/users/1dongben","html_url":"https://github.com/1dongben","followers_url":"https://api.github.com/users/1dongben/followers","following_url":"https://api.github.com/users/1dongben/following{/other_user}","gists_url":"https://api.github.com/users/1dongben/gists{/gist_id}","starred_url":"https://api.github.com/users/1dongben/starred{/owner}{/repo}","subscriptions_url":"https://api.github.com/users/1dongben/subscriptions","organizations_url":"https://api.github.com/users/1dongben/orgs","repos_url":"https://api.github.com/users/1dongben/repos","events_url":"https://api.github.com/users/1dongben/events{/privacy}","received_events_url":"https://api.github.com/users/1dongben/received_events","type":"User","site_admin":false,"name":null,"company":null,"blog":"","location":null,"email":null,"hireable":null,"bio":null,"public_repos":2,"public_gists":0,"followers":0,"following":0,"created_at":"2018-07-20T08:04:14Z","updated_at":"2018-08-20T03:10:03Z"}

?>
