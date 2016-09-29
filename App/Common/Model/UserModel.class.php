<?php
namespace Common\Model;
use Think\Model;

class UserModel extends Model
{
	function getUserByUsername($username)
	{
		$res = $this->where("username = '".$username."'")->find();
		return $res;
	}
}