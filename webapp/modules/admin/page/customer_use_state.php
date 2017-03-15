<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_customer_use_state extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

//

	$this->set('title', '顧客利用状況');
	$u = null;//add by quyhoa
	if(isset($_POST['c_member_id']) && preg_match("/^[0-9]+$/", $_POST['c_member_id'])){// add by quyhoa
		$u = $_POST['c_member_id'];
		$this->set('c_member_id', $u);
	}elseif(isset($_POST['nickname']) && $_POST['nickname']){
		$nickname = $_POST['nickname'];
		$this->set('nickname', $nickname);

		$sql = "select * from c_member where nickname = '$nickname'";
		$c_member = db_get_all($sql);
		$c_member = $c_member[0];

		$u = $c_member['c_member_id'];

	}elseif(isset($_POST['corp']) && $_POST['corp']){
		$corp = $_POST['corp'];
		$this->set('corp', $corp);

		$sql = "select * from c_member_profile where value = '$corp'";
		$c_member_prof = db_get_all($sql);
		$u = $c_member_prof[0]['c_member_id'];

	}

	// add by quyhoa
	$_POST['year1'] 	= isset($_POST['year1']) ? $_POST['year1'] : null;
	$_POST['month1'] 	= isset($_POST['month1']) ? $_POST['month1'] : null;
	$_POST['day1'] 		= isset($_POST['day1']) ? $_POST['day1'] : null;
	$_POST['year2'] 	= isset($_POST['year2']) ? $_POST['year2'] : null;
	$_POST['month2'] 	= isset($_POST['month2']) ? $_POST['month2'] : null;
	$_POST['day2'] 		= isset($_POST['day2']) ? $_POST['day2'] : null;
	// end

	$this->set('year1', $_POST['year1']);
	$this->set('month1', $_POST['month1']);
	$this->set('day1', $_POST['day1']);
	$this->set('year2', $_POST['year2']);
	$this->set('month2', $_POST['month2']);
	$this->set('day2', $_POST['day2']);	

	if(!$u){
		return 'success';
	}
	$this->set('u', $u);

	$sql = "select * from c_member where c_member_id = $u";
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];
	$c_member['corp'] = get_profile_value($u, 12);
	$c_member['tel'] = get_profile_value($u, 17);
	$c_member['fax'] = get_profile_value($u, 18);
	$c_member['address'] = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

	$this->set('c_member', $c_member);


	$sql = "select * from a_reserve_list where c_member_id = $u ";
	$sql.= "and cancel_flag = 0 ";
	if($_POST['year1'] and $_POST['month1'] and $_POST['day1'] and $_POST['year2'] and $_POST['month2'] and $_POST['day2']){
		$date_s = $_POST['year1']."-".$_POST['month1']."-".$_POST['day1']." 00:00:00";
		$date_e = $_POST['year2']."-".$_POST['month2']."-".$_POST['day2']." 23:59:59";

		$sql.= "and begin_datetime >= '$date_s' ";
		$sql.= "and begin_datetime <= '$date_e' ";

	}
	$reserve_data = db_get_all($sql);
	$total_time = 0;
    $total_money = 0;
	foreach($reserve_data as $key=>$value){
	    $reserve_data[$key]['hall_name'] = get_hall_name($value['hall_id']);
		$reserve_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);

		$dt = new DateTime($value['begin_datetime']);
		$reserve_data[$key]['date'] = $dt->format("Y/m/d");
		$time = $dt->format("H:i ～ ");
		$time_s = ($dt->format("H")*60)+$dt->format("i");
		$dt = new DateTime($value['finish_datetime']);
		$time.= $dt->format("H:i");
		$time_e = ($dt->format("H")*60)+$dt->format("i");
		$reserve_data[$key]['time'] = $time;

		$time = ($time_e - $time_s)/60;
		$reserve_data[$key]['between_time'] = $time;
		$total_time += $time;
        $total_money += $value['total_price'];
		$reserve_data[$key]['purpose'] = get_purpose_word($value['purpose']);

	}
	$this->set('total_time', $total_time);
    $this->set('total_money', $total_money);
	$this->set('reserve_data', $reserve_data);

       return 'success';
    }
}


?>
