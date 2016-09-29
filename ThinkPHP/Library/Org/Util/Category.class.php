<?php
namespace Org\Util;
Class Category
{
	// 无限级分类方法：组合一维数组
	public function unlimitedForLevel ($cate, $html='+&nbsp;&nbsp;', $pid=0, $level=0)
	{
		$arr = array();
		foreach($cate as $v)
		{
			if($v['pid'] == $pid)
			{
				$v['level'] = $level + 1;
				$v['html'] = str_repeat($html, $level);
				$arr[] = $v;
				$arr = array_merge($arr, $this->unlimitedForLevel($cate, $html, $v['cid'], $level+1));
			}
		}

		return $arr;
	}

	// 无限级分类方法：组合多维数组
	public function unlimitedForLayer ($cate, $pid=0)
	{
		$arr = array();

		foreach($cate as $v)
		{
			if ($v['pid'] == $pid) {
				$v['child'] = $this->unlimitedForLayer($cate, $v['cid']);
				$arr[] = $v;
			}
		}
		return $arr;
	}

	// 面包屑导航：传递一个子分类ID返回所有的父类
	public function getParents ($cate, $id)
	{
		$arr = array();

		foreach($cate as $val)
		{
			if($val['id'] == $id)
			{
				$arr[] = $val;
				$arr = array_merge($this->getParents($cate, $val['pid']), $arr);
			}
		}
		return $arr;
	}

	// 传递一个父ID，列出1个分类下的所有子分类ID
	public function getChildId($cate, $pid)
	{
		$arr = array();

		foreach($cate as $val)
		{
			if($val['pid'] == $pid)
			{
				$arr[] = $val['id'];
				$arr = array_merge($arr, $this->getChildId($cate, $val['id']));
			}
		}
		return $arr;
	}
}
?>