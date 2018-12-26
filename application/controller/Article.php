<?php

class Article{
	public function index(){
		$article_model = load_model('article_model');
		$user=load_model('user_model');
		$redis = load_model('redis_model');

		$expire = $redis->get_expire('article_amount');
		if (!$expire) {
			$data['article_list'] = $article_model->lists();
			//把每一篇文章缓存
			for ($i = 0; $i < count($data['article_list']); $i++) { 
				$redis->set_hash('article_'.$i,$data['article_list'][$i]);
			}
			$redis->set_article_expire('article_amount',count($data['article_list']));//存储下文章的数量,记得发布后数量要加一
		}else{
			//从缓存读数据
			$article_amount = $redis->get_str('article_amount');
			for ($i=0; $i < $article_amount; $i++) { 
				$data['article_list'][$i] = $redis->get_article_redis('article_'.$i);
			}
		}
		load_view('article/index', $data);
	}

	public function detail(){
		//获取文章id
		$url_arr = array_filter(explode("/",$_SERVER['REQUEST_URI']));
		$article_id = intval($url_arr[2]);
		$comment = load_model('comment_model');
		$article = load_model('article_model');
		$redis = load_model('redis_model');
		if($_POST){
			if(!isset($_SESSION['uid'])){
				error_page("请登录后发表评论",'/user/login');
			}
			if(!$_POST['content']){
				error_page("请输入评论内容",'');
			}
			$content = clean($_POST['content']);
			$user_name = $_SESSION['username'];
			$comment->post_comment($user_name,$article_id,$content);
			$expire = $redis->get_expire('comment_amount_'.$article_id);
			if ($expire) {
				$redis->delete('comment_amount_'.$article_id);
			}
		}else{
			//文章阅读数加一
			$article->click($article_id);
		}
		$expire = $redis->get_expire('comment_amount_'.$article_id);
		//获取文章和评论
		if($expire){
			//从redis中读取数据
			$detail_data['detail_data'] = $redis->get_article_redis($article_id);
			$comment_amount = $redis->get_str('comment_amount_'.$article_id);
			for ($i=0; $i < $comment_amount; $i++) { 
				$comment_data['comment_data'][$i] = $redis->get_comment_redis('comment_'.$article_id.'_'.$i);
			}
		}else{
			//查询数据，然后存到redis
			$detail_data['detail_data'] = $article->details($article_id);
			$comment_data['comment_data'] = $comment->comment_list($article_id);
			$redis->set_hash($article_id,$detail_data['detail_data']);
			$redis->set_article_expire('comment_amount_'.$article_id,count($comment_data['comment_data']));//缓存评论条数
			for ($i = 0; $i < count($comment_data['comment_data']); $i++) { 
				$redis->set_hash('comment_'.$article_id.'_'.$i,$comment_data['comment_data'][$i]);
			}
		}
			load_view('article/detail',$detail_data,$comment_data);
	}

	public function publish(){
		$user = load_model('user_model');
		$article = load_model('article_model');
		$redis = load_model('redis_model');

		$data['category'] = $article->get_category();//获取文章分类
		$username = isset($_SESSION['username'])?$_SESSION['username']:'';
		$user->check_statu($username);
		load_view("article/publish",$data);

		if ($_POST) {
			$title = clean($_POST['title']);
			$content = clean($_POST['content']);
			$category = clean($_POST['category']);
			if (!$username || !$content || !$category) {
				error_page("输入有误，请检查",'');
			}
			$result = $article->publish($title,$content,$category);
			if(!$result){
				error_page("发布失败，请稍后再试",'');
			}else{
				message_page("发布成功，点击返回首页",'/article/index');
				$expire = $redis->get_expire('article_amount');
				if ($expire) {
					$redis->delete('article_amount');
					//直接删除'article_amoutn'这个key，返回首页后就是从数据库取值了
				}
			}
		}
	}

}

?>
