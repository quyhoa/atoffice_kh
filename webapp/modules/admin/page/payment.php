<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_payment extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);


	$sql = "select * from a_reserve_list where reserve_id = ".$_POST['reserve_id'];
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

	// 日付書式
	$dt = new DateTime($reserve_data['tmp_reserve_datetime']);
	$reserve_data['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
	$dt = new DateTime($reserve_data['reserve_datetime']);
	$reserve_data['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");

	if ($reserve_data['pay_checkdate']!='0000-00-00 00:00:00'){
		$dt = new DateTime($reserve_data['pay_checkdate']);
		$reserve_data['pay_checkdate'] = $dt->format("Y年m月d日 H時i分s秒");
	}else{
		$reserve_data['pay_checkdate'] = 0;
	}

	$dt = new DateTime($reserve_data['begin_datetime']);
	$reserve_data['begin_datetime'] = $dt->format("Y年m月d日 H時i分");
	$dt = new DateTime($reserve_data['finish_datetime']);
	$reserve_data['finish_datetime'] = $dt->format("Y年m月d日 H時i分");
	$dt = new DateTime($reserve_data['pay_limitdate']);
	$reserve_data['pay_limitdate'] = $dt->format("Y年m月d日");
	$s = mktime(0,0,0,$dt->format("m"),$dt->format("d"),$dt->format("Y")) - mktime(0,0,0,date("m"),date("d"),date("Y"));
	$reserve_data['pay_limit'] = ($s/60/60/24);

	// 会場
	$sql = "select * from a_hall where hall_id = ".$reserve_data['hall_id'];
	$hall_data = db_get_all($sql);
	$reserve_data['hall_data'] = $hall_data[0];
	// 部屋
	$sql = "select * from a_room where hall_id = ".$reserve_data['hall_id']." and room_id = ".$reserve_data['room_id'];
	$room_data = db_get_all($sql);
	$reserve_data['room_data'] = $room_data[0];

	// 会員情報
	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
	$c_member = db_get_all($sql);
	$reserve_data['c_member'] = $c_member[0];
	// プロフィール
	$reserve_data['corp'] = get_profile_value($reserve_data['c_member_id'], 12);

	// 口座番号
	$sql = "select account_number from a_bank_data where hall_id = ".$reserve_data['hall_id'];
	$account_number = db_get_all($sql);
	$reserve_data['account_number'] = $account_number[0]['account_number'];


	$this->set('reserve_data', $reserve_data);

        return 'success';
    }
}

?>
