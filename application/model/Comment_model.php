<?php

class Comment_model{
	private $db;
	public function __construct(){
		$this->db = load_database();
	}

	public function post_comment($user_name,$article_id,$content){
		$create_time = date("Y-m-d H:i:s");
		$sql = "insert into comment (user_name,article_id,content,create_time) values ('$user_name','$article_id','$content','$create_time')";
		return $this->db->query($sql);
	}

	public function comment_list($article_id){
		$sql = "select * from comment where article_id='$article_id' order by id desc";
		return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
	}
}


?>