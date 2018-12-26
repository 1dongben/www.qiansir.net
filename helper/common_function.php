<?php
//事实上，每个框架都应该有一些封装的通用方法，这个框架也不例外...
//把常用的方法都写到这里，在程序的任何地方直接调用就行
//记住，永远不要把业务逻辑写在通用方法里！！！比如什么获取数据库里的一些信息之类


//用这个方法代替var_dump()  发现调试美滋滋
//为啥 d(调试对象) 的实现  这里的参数是空的?  有问题查手册！
function d(){
    $args = func_get_args();
    foreach ($args as $val) {
        echo "<pre>";
        print_r($val);
    }
    exit();
}

//比如你发表博客文章、或者评论、或者回复后 你觉得 2017-01-01 00:00:00 这种发布时间太low
//你可以使用这种方法  
//@param time  时间戳(这里传入的是时间戳，你非要传2017-01-01 00:00:00 这种字符串，尝试加一行改造下)
function format_time($time){
    $sub_time = time() - $time;
    if ($sub_time < 3600) {
        $sub = floor($sub_time / 60);
        $sub = $sub < 1 ? 1 : $sub;
        return $sub . '分钟前';
    } elseif ($sub_time < 86400) {
        return floor($sub_time / 3600) . '小时前';
    } elseif ($sub_time >= 86400 && $sub_time <= 2592000) {
        return floor($sub_time/86400) . '天前';
    } else {
        $month = floor($sub_time/2592000);
        $month = $month >= 3 ? 3 : $month;
        return $month . '个月前';
    }
}

//这个函数自动过滤xss，sql注入
//以后  $title = xss_sql_clean($_GET['title']); 就好啦
//麻烦你实现下
function xss_sql_clean($string){
	return;
}


//显示错误信息，点击 确定跳转  link未设置则默认返回上一页
function error_page($message, $link = ''){
    $data['message'] = $message;
    $data['link'] = $link;
    load_view('/error/general_error', $data);
    exit;
}

function message_page($message, $link = ''){
    $data['message'] = $message;
    $data['link'] = $link;
    load_view('/error/general_message', $data);
    exit;
}
//剩下的你自己加，一旦有封装的必要，就一定要封装

function clean($var){
    return trim(addslashes($var));
}

function arr_transform($arr){
    //把数值数组[关联数组]转换为关联数组[数值数组]
    $i = 0;
    //提取数组中所有的key放到数组$key_arr
    if(count($arr)>0){
        foreach($arr[0] as $key=>$value){
            $key_arr[$i] = $key;
            $i++;
        }
       for ($i=0; $i <count($key_arr) ; $i++) { 
            $new_arr[$key_arr[$i]] = array_column($arr,$key_arr[$i]);
        } 
        return $new_arr;
        }   
    }


?>
