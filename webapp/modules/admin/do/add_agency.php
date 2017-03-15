<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_agency extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);

	if(!preg_match("/^[0-9]+$/", $_POST['percent']) or $_POST['percent'] < 1 or $_POST['percent'] > 100){
		admin_client_redirect('c_member_detail&target_c_member_id='.$_POST['c_member_id'], '値引き率には1以上100以下の半角数字を入力してください。');
	}

	// 一旦削除
	$sql = "delete from a_agency where c_member_id = ".$_POST['c_member_id'];
	db_get_all($sql);

	// 登録
	$sql = "insert into a_agency (c_member_id, percent, info) values (".$_POST['c_member_id'].", ".$_POST['percent'].", '".$_POST['info']."')";
	db_get_all($sql);

	admin_client_redirect('agency_list', '代理店値引き対象に設定しました。');


    }
}


?>
