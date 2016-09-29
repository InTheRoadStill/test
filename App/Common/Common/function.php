<?php 
function getMdPassword($password)
{
	$prefix = C('PASS_PRE');
	return md5($password.$prefix);
}

/**
 * 根据status值获取状态
 */
function getStatusValue($status)
{
	switch ($status) {
		case 0:
			return "<span class='msg_wait'>等待审核</span>";
			break;
		case -1:
			return "<span class='msg_error'>垃圾链接</span>";
			break;
		case 1:
			return "<span class='msg_success'>审核通过</span>";
			break;
		
		default:
			return "非法操作";
			break;
	}
}
?>