<?php
class Redis_model{
	private $redis;
	private $db;
	private $article_expire = 10;
	public function __construct(){
		$this->redis = new redis();
		if(!($this->redis->connect('127.0.0.1',6379))){
			error_page('连接Redis服务失败','');
		}
		if (!$this->db = load_database()) {
			error_page("连接数据库失败",'');
		}
	}

	public function set_hash($article,$arr_one=array()){
		$this->redis->hMset($article,$arr_one);
		$this->redis->expire($article,$this->article_expire);
	}


	public function get_article_redis($key){
		return $this->redis->hMget($key,array('id','title','content','click_count','create_time','category'));
	}

	public function get_comment_redis($key){
		return $this->redis->hMget($key,array('id','content','user_name','article_id','create_time'));
	}

	public function set_article_expire($key,$value){
		$this->redis->setex($key,$this->article_expire,$value);
	}

	public function get_str($name){
		 return $this->redis->get($name);
	}

	public function get_expire($key){
		return $this->redis->exists($key);
	}
	
//	public function set_list($name,$arr = array()){
//		//这个地方一直有一个警告：提示$arr不是一个数组
//		var_dump(gettype($arr));
//		$len = count($arr);
//		if($len!=0){
//			for ($i=0; $i < $len; $i++) {
//				$this->redis->lpush($name,$arr[$i]);
//			}
//		}
//		$this->redis->setTimeout($name,10);
//	}
//	

	public function get_list($name){
		$i = 0;
		$arr = array();
		for($i = 0;$this->redis->lsize($name)>0;$i++) {
			$arr[$i] = $this->redis->rpop($name);
		}
		return $arr;
	}

	public function set_expire(){
		$this->redis->setex('time',10,'time');
	}

	public function __destructor(){
		$this->redis->close();
	}


}
?>