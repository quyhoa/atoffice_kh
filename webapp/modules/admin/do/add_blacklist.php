<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_blacklist extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);

	// 一旦削除
	$sql = "delete from c_blacklist where c_member_id = ".$_REQUEST['c_member_id'];
	db_get_all($sql);

	// 登録
	$sql = "insert into c_blacklist (c_member_id, info) values (".$_REQUEST['c_member_id'].", '".$_REQUEST['info']."')";
	db_get_all($sql);

	// ログイン停止
	$sql = "update c_member SET is_login_rejected = 1 where c_member_id = ".$_REQUEST['c_member_id'];
	db_get_all($sql);

	admin_client_redirect('blacklist', 'ブラックリストに設定しました。');


    }
}


?>
