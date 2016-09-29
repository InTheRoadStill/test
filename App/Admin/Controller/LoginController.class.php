<?php 
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller
{
	public function index()
	{
		if ($_SESSION['login']) {
			return $this->redirect("Index/index");
		}

		if (IS_POST) {
			// 判断验证码是否正确
			$yzm = $_POST['yzm'];
			$Verify = new \Think\Verify();

			if (!$Verify->check($yzm)) {
				return $this->error("验证码错误", U("Login/index"));
			}

			// 数据校验
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			if (!$username) {
				return $this->error("用户名不能为空");
			}

			if (!$password) {
				return $this->error("密码不能为空");
			}

			// 访问Model层
			$ret = D("User")->getUserByUsername($username);

			if (!$ret) {
				return $this->error("用户名不存在", U("Login/index"));
			}

			// 返回真，再判断用户名是否正确
			if ($ret['password'] != getMdPassword($password)) {
				return $this->error("登录失败", U("Login/index"));
			}

			// 把登录成功的信息存储到$_SESSION中
			$_SESSION['login'] = $ret;

			return $this->success("登录成功", "Index/index");			
		}

		$this->display();
	}

	public function yzm()
	{
		$Verify = new \Think\Verify();
		$Verify->fontttf = '4.ttf';
		$Verify->codeSet = '0123456789';
		$Verify->useNoise = false;
		$Verify->length = 4;
		$Verify->entry();
	}

	function logout()
	{
		unset($_SESSION['login']);
		return $this->success("退出登录", U("Login/index"));
	}
}

?>