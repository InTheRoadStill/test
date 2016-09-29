<?php 
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller
{
	// 在任何方法前，调用该方法
	public function _initialize()
	{
		// 判断用户已经登录是否登录了
		if (!$_SESSION['login']) {
			return $this->error("您未登录", U("Login/index"));
		}
	}
}
?>