<?php
/**
 *  类名为啥要加  _model ？ 因为 controller也是class  model也是class  就她两容易重名  
 */
class Article_model{
	private $db;
	public function __construct(){
		$this->db = load_database();
	}

	public function lists($page = 1, $limit = 20){
		$sql = "select * from article order by id desc limit ".($page - 1).",".$limit;
		return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
	}

	public function details($a){
		$sql = "select * from article where id = '$a'";
		return $this->db->query($sql)->fetch_array(MYSQLI_ASSOC);
	}

	public function click($id){
		$sql = "update article set click_count=click_count+1 where id='$id'";
		return $this->db->query($sql);
	}

	public function publish($title,$content,$category){
		$create_timetamp = time();
		$create_time = date("Y-m-d H:i:s");
		$sql = "insert into article (title,content,category,create_time,create_timetamp,click_count) values ('$title','$content','$category','$create_time
		','$create_timetamp','0')";
		return $this->db->query($sql);
	}

	public function get_category(){
		$sql = "select category from article_category";
		return $this->db->query($sql)->fetch_all(MYSQLI_NUM);
	}
}
?>