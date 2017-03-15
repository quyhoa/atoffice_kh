<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_reserve_revision extends OpenPNE_Action
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
	//var_dump($_REQUEST['reserve_id']);exit;
	// 履歴
	$sql = "select * from a_rl_log where reserve_id = ".$_REQUEST['reserve_id'];
	$result = db_get_all($sql);
	foreach($result as $key=>$value){
		$result[$key]['hall_name'] = get_hall_name($value['hall_id']);
		$result[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
	}
	$this->set('log', $result);
	// 部屋セレクトデータ
	$sql = "select room_id, room_name from a_room where hall_id = ".$reserve_data['hall_id']." and flag = 1";
	$room_select = db_get_all($sql);
	$this->set('room_select', $room_select);

	$purpose_list = array('未選択', '会議', 'セミナー', '研修', '面接・試験', '懇談会・パーティ', 'その他');
	$this->set('purpose_list', $purpose_list);

        return 'success';
    }
}


?>
