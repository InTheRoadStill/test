<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function add()
    {
        // 获取数据
        $username = trim($_POST['username']);
        $personid = trim($_POST['personid']);
        $classname = $_POST['classname'];
        $github_url = $_POST['github_url'];

        // 完善数据
        $_POST['addtime'] = time();
        $_POST['status'] = 0;

        // 数据校验
        if (!$username) {
            echo "<script>alert('姓名不能为空'); window.location.href = '".U('Index/index')."'</script>"; die;
        }

        // 操作M层
        $result = D("Urls")->addGitHubUrl($_POST);
        // dump($result); die;
        
        if (!$result) {
            echo "<script>alert('操作失败'); window.location.href='".U('index/index')."'</script>"; die;
        }
        echo "<script>alert('添加成功'); window.location.href='".U('Index/index')."'</script>";
    }

    public function urllist()
    {
        $condition['status'] = array('eq', 1);

        $result = D("Urls")->findAll($condition);
        // dump($result);die;
        $this->assign('list', $result);

        $this->display();
    }
}