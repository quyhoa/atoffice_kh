<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_set_amount_billed extends OpenPNE_Action
{

    function execute($requests)
    {


	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	$sql = "select * from a_reserve_list where reserve_id = ".$_REQUEST['reserve_id'];
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];
	$reserve_data['hall_name'] = get_hall_name($reserve_data['hall_id']);
	$reserve_data['room_name'] = get_room_name($reserve_data['hall_id'], $reserve_data['room_id']);

	$this->set('reserve_data', $reserve_data);

	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];

	$this->set('c_member', $c_member);

	$reserve_id = $_REQUEST['reserve_id'];
	$hall_id = $reserve_data['hall_id'];
	$room_id = $reserve_data['room_id'];

	// 請求データ取得
	$sql = "select * from a_amount_billed where reserve_id = $reserve_id";
	$result = db_get_all($sql);
	$this->set('ab_data', $result[0]);

        return 'success';
    }
}


?>
