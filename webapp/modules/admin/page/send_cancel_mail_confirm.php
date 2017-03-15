<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// キャンセルメール送信 確認画面
class admin_page_send_cancel_mail_confirm extends OpenPNE_Action
{
    function execute($requests)
    {
//	var_dump($_REQUEST);
	if(isset($_REQUEST['cancel'])){	// cancel
/*
		$params=Array();
		$params['hall_list']=$_REQUEST['hall_list'];
		$params['u']=$_REQUEST['u'];
		$params['pay_flag']=$_REQUEST['pay_flag'];
		$params['index']=$_REQUEST['index'];
		openpne_redirect('pc',$_REQUEST['page'], $params);
*/
		admin_client_redirect($_REQUEST['page']."&hall_list=".$_REQUEST['hall_list'].
		//echo($_REQUEST['page']."&hall_list=".$_REQUEST['hall_list'].
					"&u=".$_REQUEST['u'].
					"&pay_flag=".$_REQUEST['pay_flag'].
					"&index=".$_REQUEST['index']);
	}

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$reserve_id=$_REQUEST['reserveid'];

	$this->set("mails",$_REQUEST['mails']);
	$this->set("subject",$_REQUEST['subject']);
	$this->set("message",$_REQUEST['message']);
	$this->set("reserve_id",$_REQUEST['reserveid']);

	$this->set('page',$_REQUEST['page']);

	$this->set('hall_list',$_REQUEST['hall_list']);
	$this->set('u',$_REQUEST['u']);
	$this->set('pay_flag',$_REQUEST['pay_flag']);
	$this->set('index',$_REQUEST['index']);

//	var_dump($_POST);

        return 'success';
    }
}

?>
