<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_receipt_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	if($_POST['begin_date']){
		$begin_date = $_POST['begin_date'];
	}else{
		$begin_date = '0000-00-00';
	}
	if($_POST['finish_date']){
		$finish_date = $_POST['finish_date'];
	}else{
		$finish_date = '0000-00-00';
	}
	$this->set('begin_date', $begin_date);
	$this->set('finish_date', $finish_date);

	if($begin_date == '0000-00-00' and $finish_date == '0000-00-00'){
		return 'success';
	}

// 予約

	$sql = "select * from a_reserve_list where ";
	$sql.= "receipt_flag > 0 and ";
	$sql.= "(receipt_datetime >= '".$begin_date." 00:00:00' ";
	$sql.= "and receipt_datetime <= '".$finish_date." 23:59:59') ";
	$reserve_data = db_get_all($sql);

	if($reserve_data){
		foreach($reserve_data as $key=>$value){
			$reserve_data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
			$dt = new DateTime($value['receipt_datetime']);
			$reserve_data[$key]['date'] = $dt->format("Y年m月d日");
			$reserve_data[$key]['price'] = number_format($value['total_price']);

		}

	}

// キャンセル
	$sql = "select * from a_amount_billed where ";
	$sql.= "receipt_flag > 0 and ";
	$sql.= "(receipt_datetime >= '".$begin_date." 00:00:00' ";
	$sql.= "and receipt_datetime <= '".$finish_date." 23:59:59') ";
	$ab_data = db_get_all($sql);

	if($ab_data){
		foreach($ab_data as $key=>$value){
			$sql = "select * from a_reserve_list where reserve_id = ".$value['reserve_id'];
			$u = db_get_all($sql);
			$u = $u[0]['c_member_id'];
			$ab_data[$key]['corp'] = get_profile_value($u, 12);
			$dt = new DateTime($value['receipt_datetime']);
			$ab_data[$key]['date'] = $dt->format("Y年m月d日");
			$ab_data[$key]['price'] = number_format($value['total_billed_money']);

		}
	}

	$this->set('reserve_data', $reserve_data);
	$this->set('ab_data', $ab_data);

        return 'success';
    }
}

?>
