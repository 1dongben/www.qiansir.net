<?php
//博客  v0.0.2
//这里就是单入口文件。


//1. 一般框架会在这个入口做一系列很多的初始化操作，比如加载配置，初始化环境和重要变量，
//2. 然后就是根据请求的路径分发到实际的地方
//这个框架为极简框架，只做学习用，你会发现真正的框架 有点难懂。有兴趣一年后可以学习下其他微型框架实现逻辑


//1.
session_start();
header("Content-Type: text/html;charset=utf-8");
date_default_timezone_set('PRC');

error_reporting(E_ALL);
ini_set('display_errors','On');


define("ROOT", getcwd() . DIRECTORY_SEPARATOR);
define("APP_PATH", ROOT . 'application' . DIRECTORY_SEPARATOR);
define("CONFIG_PATH", APP_PATH . "config" . DIRECTORY_SEPARATOR);
define("CONTROLLER_PATH", APP_PATH . "controller" . DIRECTORY_SEPARATOR);
define("MODEL_PATH", APP_PATH . "model" . DIRECTORY_SEPARATOR);
define("VIEW_PATH", APP_PATH . "view" . DIRECTORY_SEPARATOR);

function load_database(){
	$config = require_once CONFIG_PATH.'database.php';
	$conn=new mysqli(DB_SERVER_NAME, DB_USER_NAME, DB_PASSWORD, DB_NAME);
	$conn->set_charset('utf8');
	return $conn;
}

function load_view($view, $data=array(),$ano_data=array()){
	extract($data);
	extract($ano_data);
	require_once VIEW_PATH.$view.'.php';
}

function load_model($model){
	$model = ucfirst($model);
	require_once MODEL_PATH.$model.'.php';
	return new $model;
}

require_once 'helper/common_function.php';
//2. 请求分发，正常的并不是这样  
//正常的 比如这个简单的框架教学 http://www.phpchina.com/article-40109-1.html  现阶段有点难懂，但是这篇文章相当棒！几乎已经是商用框架的雏形了

$url_arr = array_filter(explode("/",$_SERVER['REQUEST_URI']));

$controller = ucfirst(isset($url_arr[1]) ? $url_arr[1] : 'article');
$method = isset($url_arr[2]) ? $url_arr[2] : 'index';

//$controller = ucfirst(isset($_GET['c']) ? $_GET['c'] : 'article');
//$method = isset($_GET['m']) ? $_GET['m'] : 'index';

require_once CONTROLLER_PATH.ucfirst($controller).'.php';
$controller = new $controller;
$controller->$method();

?>
