<?php
//测试专用
class Test{
	public function check1(){
		error_page("请输入用户名",'/');
	}

	public function check2(){
		error_page("请输入密码",'/');
	}

	public function check3(){
                #error_page("呵呵，出错了，你查找的用户已经挂了");
		error_page("输入有误请检查",'/');
	}
}
?>
