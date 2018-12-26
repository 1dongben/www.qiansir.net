<?php
class Comment{
	public function post_comment(){
		$comment = load_model('post_comment');
		if($_POST){
			if(!$_SESSION['id']){
				error_page("请登录后发表评论",'/user/login');
			}
			if(!$_POST['content']){
				error_page("请输入内容",'');
			}
			$content = clean($_POST['content']);
			$url_arr = array_filter(explode("/",$_SERVER['REQUEST_URI']));
			$article_id = intval($url_arr[3]);
			$user_id = $_SESSION['id'];

			$comment->post_comment();
		}
	}

	public function comment_list(){
		
	}

}
?>