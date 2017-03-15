<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_service_revision extends OpenPNE_Action
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

/// 2014.01.19 消費税改定対応 begin

	$tmp_ymd  = strtotime($reserve_data['begin_datetime']);
	$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
	$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";			/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率

/// 2014.01.19 消費税改定対応 end

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
	$begin_datetime = $reserve_data['begin_datetime'];
	$finish_datetime = $reserve_data['finish_datetime'];

// サービス取得

	$sql = "select service_id from a_room_service where hall_id = $hall_id and room_id = $room_id and flag = 0";
	$service_id_list = db_get_all($sql);
	if($service_id_list){
		$sql = "select * from a_service_data where ";
		foreach($service_id_list as $key=>$value){
			$sql.="service_id = ".$value['service_id']." ";
			if ($service_id_list[($key+1)]['service_id']){
				$sql.="or ";
			}
		}
        $sql.= " order by weight desc";
		$service_list = db_get_all($sql);

/// 2014.01.19 消費税改定対応 begin

		for($ixa = 0; $ixa < count($service_list); $ixa += 1){
			$tmp_price = $service_list[$ixa]["price"];	/// サービス使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$service_list[$ixa]["price"] = $tmp_price;	/// サービス使用料
		}

/// 2014.01.19 消費税改定対応 end

		foreach($service_list as $key=>$value){
			// 予約数
			$sql = "select num, cancel_flag from a_reserve_s where reserve_id = $reserve_id and service_id = ".$value['service_id'];
			$num = db_get_all($sql);
			if($num[0]['num']){
				$service_list[$key]['num'] = $num[0]['num'];
				$service_list[$key]['cancel_flag'] = $num[0]['cancel_flag'];
			}else{
				$service_list[$key]['num'] = 0;
				$service_list[$key]['cancel_flag'] = 0;
			}

		}
	}else{
		$service_list = 0;
	}
	$this->set('service_list_num', count($service_list));
	$this->set('service_list', $service_list);

	// ログ
	$sql = "select * from a_rs_log where reserve_id = $reserve_id order by revision_id";
	$log = db_get_all($sql);
	if($log){
		$key=0;
		$k=0;
		$new = array();
		$revision = 1;
		foreach($log as $value){
			if($revision==$value['revision_id']){
				$new[$key]['change_datetime'] = $value['change_datetime'];
				$new[$key]['staff_name'] = $value['staff_name'];
				$new[$key]['list'][$k]=$value;
				$new[$key]['list'][$k]['service_name'] = get_service_name($value['service_id']);
			}else{
				$key++;
				$k=0;
				$revision=$value['revision_id'];
				$new[$key]['change_datetime'] = $value['change_datetime'];
				$new[$key]['staff_name'] = $value['staff_name'];
				$new[$key]['list'][$k]=$value;
				$new[$key]['list'][$k]['service_name'] = get_service_name($value['service_id']);
			}
			$k++;
		}
	}
	$this->set('log', $new);

        return 'success';
    }
}


?>
