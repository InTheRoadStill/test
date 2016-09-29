<?php 
namespace Admin\Controller;

class UrlsController extends CommonController
{
	public function index()
	{
		$condition['status'] = array('neq', -1);

		// 操作M层
		$result = D("Urls")->findAll($condition);

		// 赋值给V层
		$this->assign('list', $result);

		$this->display();
	}

	public function fake()
	{
		$condition['status'] = array('eq', -1);

		// 操作M层
		$result = D("Urls")->findAll($condition);

		// 赋值给V层
		$this->assign('list', $result);

		$this->display('Urls/index');
	}

	public function edit()
	{
		$id = I('get.id');

		// 非法操作屏蔽
		
		$result = D("Urls")->findInfoById($id);
		// dump($result); die;
		
		// 赋值给V层
		$this->assign("result", $result);

		$this->display();
	}

	public function save()
	{
		$_POST['addtime'] = time();
		// dump($_POST);
		$id = $_POST['url_id'];
		unset($_POST['url_id']);

		$result = D("Urls")->updateById($_POST, $id);
		// dump($result); die();
		
		if (!$result) {
			echo "<script>alert('更新失败'); window.location.href='".U('Urls/index')."'</script>"; die;
		}

		echo "<script>alert('更新成功'); window.location.href='".U('Urls/index')."'</script>";
	}

	public function del()
	{
		// 操作M层，修改状态值
		$id = I('get.id');
		$data['status'] = -1;
		$result = D("Urls")->updateById($data, $id);
		// dump($result); die;
		
		if (!$result) {
			echo "<script>alert('操作失败'); window.location.href='".U('Urls/index')."'</script>"; die;
		}
		echo "<script>alert('操作成功'); window.location.href='".U('Urls/index')."'</script>";
	}

	public function reedit()
	{
		// 操作M层，修改状态值
		$id = I('get.id');
		$data['status'] = 1;
		$result = D("Urls")->updateById($data, $id);
		// dump($result); die;
		
		if (!$result) {
			echo "<script>alert('操作失败'); window.location.href='".U('Urls/index')."'</script>"; die;
		}
		echo "<script>alert('操作成功'); window.location.href='".U('Urls/index')."'</script>";
	}
}
?>