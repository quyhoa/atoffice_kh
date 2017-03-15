<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_completion_report extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select * from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('reporter', $result[0]['c_admin_user_id']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$reserve_id = $_REQUEST['reserve_id'];
// 予約データ
	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

	$uid = $reserve_data['c_member_id'];

// 顧客データ
	$sql = "select * from c_member where c_member_id = $uid";
	$c_member_data = db_get_all($sql);
	$c_member_data = $c_member_data[0];
// メール
	$sql = "select pc_address from c_member_secure where c_member_id = $uid";
	$result=db_get_all($sql);
	$mail = t_decrypt($result[0]['pc_address']);

	$this->set('reserve_data', $reserve_data);
	$this->set('c_member_data', $c_member_data);
	$this->set('mail', $mail);

	$this->set('kana', get_profile_value($uid, 11));
	$this->set('corp', get_profile_value($uid, 12));
	$this->set('busho', get_profile_value($uid, 19));
	$this->set('tel', get_profile_value($uid, 17));
	$this->set('fax', get_profile_value($uid, 18));

        return 'success';
    }
}


?>
