<?php
namespace Common\Model;
use Think\Model;

class UrlsModel extends Model
{
	function addGitHubUrl($data)
	{
		$res = $this->add($data);
		return $res;
	}

	function findAll($condition=array())
	{
		$ret = M("Urls")->where($condition)->order('addtime desc')->select();
		// echo $this->getLastSql();die;
		return $ret;
	}

	public function findInfoById($id)
	{
		$res = M("Urls")->where('url_id = '.$id)->find();
		return $res;
	}

	public function updateById($data, $id)
	{
		$res = M("Urls")->where('url_id = '.$id)->save($data);
		return $res;
	}

}