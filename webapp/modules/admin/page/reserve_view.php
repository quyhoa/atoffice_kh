<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_reserve_view extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	// 有効な会場一覧
	$sql = "select * from a_hall where flag=0";
	$hall_list = db_get_all($sql);
	if(isset($_REQUEST['hall_list']) && $_REQUEST['hall_list']){
		$hall_id = $_REQUEST['hall_list'];
	}else{
		$hall_id = 0;
	}
	$this->set('hall_list', $hall_list);
	$this->set('hall_id', $hall_id);
	$bill_id 	= null;
	$reserve_id = null;
	$vn 		= null;

	if(isset($_REQUEST['reserve_id']) && $_REQUEST['reserve_id']){//add by quyhoa
		$reserve_id = $_REQUEST['reserve_id'];
	}elseif(isset($_REQUEST['bill_id']) && $_REQUEST['bill_id']){//add by quyhoa
		$bill_id = $_REQUEST['bill_id'];
	}elseif(isset($_REQUEST['virtual_number']) && $_REQUEST['virtual_number']){//add by quyhoa
		$vn = $_REQUEST['virtual_number'];
	}
	global $mail;//add by quyhoa
	if(isset($_REQUEST['mail']) && $_REQUEST['mail']){
		$mail = $_REQUEST['mail'];
		$this->set('mail', $mail);
	}
	if(isset($_REQUEST['begin_date']) && $_REQUEST['begin_date']){
		$begin_date = $_REQUEST['begin_date'];
	}else{
		$begin_date = "0000-00-00";
	}

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);


	$this->set('begin_date', $begin_date);

	$this->set('reserve_id', $reserve_id);
	$this->set('bill_id', $bill_id);
	$this->set('virtual_number', $vn);

	$u = null;

	if($reserve_id){
		$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
		$sql2 = "select count(*) as count_num from a_reserve_list where reserve_id = $reserve_id";
	}elseif($bill_id){
		$sql = "select * from a_reserve_list where bill_id = $bill_id";
		$sql2 = "select count(*) as count_num from a_reserve_list where bill_id = $bill_id";
	}else{
		if($mail){
			$hashed_mail = t_encrypt($mail);
			$sql = "select c_member_id from c_member_secure where pc_address = '".$hashed_mail."'";
			$regist=db_get_all($sql);
			if($regist[0]['c_member_id']){
				$u = $regist[0]['c_member_id'];
			}else{
				$msg = "登録されていないメールアドレスです。";
				$this->set('msg', $msg);
				return 'success';
			}
		}

		$sql = "select * from a_reserve_list where reserve_id > 0";
		$sql2 = "select count(*) as count_num from a_reserve_list where reserve_id > 0";
if($u){
		$sql.= " and c_member_id = $u";
		$sql2.= " and c_member_id = $u";
}

if($vn){
		$sql.= " and virtual_code = '$vn'";
		$sql2.= " and virtual_code = '$vn'";
}

if($hall_id){
		$sql.= " and hall_id = $hall_id";
		$sql2.= " and hall_id = $hall_id";
}
if($begin_date != "0000-00-00"){
	$sql.= " and (begin_datetime >= '".$begin_date." 00:00:00' and ";
	$sql.= "'".$begin_date." 23:59:59' >= begin_datetime)";
	$sql2.= " and (begin_datetime >= '".$begin_date." 00:00:00' and ";
	$sql2.= "'".$begin_date." 23:59:59' >= begin_datetime)";
}
		$sql.= " limit ".$index.", 10";
	}

	$result = db_get_all($sql2);
	$num = $result[0]['count_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);

	$data = db_get_all($sql);

	foreach($data as $key=>$value){

		/*insert*/
		$tmp_date = strtotime($value['begin_datetime']);	/// 使用開始時刻
		$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 税率適用日
		$tmp_sql  = "";
		$tmp_sql .= "select rate from a_tax ";			/// 税率テーブル
		$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
		$tmp_sql .= "order by stadate desc ";			/// 開始日の降順
		$tmp_sql .= "limit 0, 1";				/// 先頭１件
		$tmp_tab  = db_get_all($tmp_sql);
		$tmp_tax  = $tmp_tab[0]['rate'] / 100;
	/*end insert*/

		$dt = new DateTime($value['tmp_reserve_datetime']);
		$data[$key]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
if($value['reserve_datetime']!='0000-00-00 00:00:00'){
		$dt = new DateTime($value['reserve_datetime']);
		$data[$key]['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
}else{
		$data[$key]['reserve_datetime'] = "-- --";
}
		$dt = new DateTime($value['begin_datetime']);
        $week = get_week($dt->format("Ymd"));
		$data[$key]['datetime'] = $dt->format("Y年m月d日(".$week.")");
		$data[$key]['begin_datetime'] = $dt->format("H時i分");
		$dt = new DateTime($value['finish_datetime']);
		$data[$key]['finish_datetime'] = $dt->format("H時i分");
if($value['pay_limitdate']!='0000-00-00 00:00:00'){
		$dt = new DateTime($value['pay_limitdate']);
		$data[$key]['pay_limitdate'] = $dt->format("Y年m月d日");
}else{
		$data[$key]['pay_limitdate'] = "-- --";
}
		if($value['pay_checkdate']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['pay_checkdate']);
			$data[$key]['pay_checkdate'] = $dt->format("Y年m月d日");
		}else{
			$data[$key]['pay_checkdate'] = 0;
		}



		// 会場
		$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
		$hall_data = db_get_all($sql);
		$hall_data = isset($hall_data[0]) ? $hall_data[0] : null;
		$data[$key]['hall_data'] = $hall_data;

		// 部屋
		$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
		$room_data = db_get_all($sql);
		$room_data = isset($room_data[0]) ? $room_data[0] : null;
		$data[$key]['room_data'] = $room_data;

		//備品
		$sql = "select * from a_reserve_v where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";

		$reserve_v_list = db_get_all($sql);
		//echo "<pre>",print_r($reserve_v_list),"</pre>";exit;
		$cancel_vessel_price = 0;
		if($reserve_v_list){
			foreach($reserve_v_list as $k=>$v){
				$vessel_value = get_vessel_data($v['vessel_id']);
				$reserve_v_list[$k]['vessel_name'] = $vessel_value['vessel_name'];
				$reserve_v_list[$k]['memo'] = $vessel_value['memo2'];
				//$cancel_vessel_price += $vessel_value['price']*$v['num'];
				//$reserve_v_list[$k]['price'] = 	$vessel_value['price'];
				$tmp_price = $vessel_value['price'];		
			// 備品使用料
				$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
				$tmp_price = round($tmp_price * (1 + $tmp_tax));		
				$cancel_vessel_price += $tmp_price*$v['num'];	
	//			echo $cancel_vessel_price." ".$vessel_value['price']." ".$v['num']."<br>";
			}
		}else{
			$reserve_v_list = 0;
		}
		$data[$key]['reserve_v_list'] = $reserve_v_list;

		//サービス
		$sql = "select * from a_reserve_s where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_s_list = db_get_all($sql);
		$cancel_service_price = 0;
	if($reserve_s_list){
		foreach($reserve_s_list as $k=>$v){
			$service_value = get_service_data($v['service_id']);
			$reserve_s_list[$k]['service_name'] = $service_value['service_name'];
			$reserve_s_list[$k]['memo'] = $service_value['memo2'];
			if($service_value['cancel_mode']==1){
				//$cancel_service_price += $service_value['price']*$v['num'];

				$tmp_price = $service_value['price'];		/// サービス使用料
			  	$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			  	$tmp_price = round($tmp_price * (1 + $tmp_tax));
			  	$cancel_service_price += $tmp_price*$v['num'];
			}
		}
	}else{
		$reserve_s_list = 0;
	}
		$data[$key]['cancel_service_price'] = $cancel_service_price;
		$data[$key]['cancel_vessel_price'] = $cancel_vessel_price;
		$data[$key]['reserve_s_list'] = $reserve_s_list;

		// 会員情報
		$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
		$c_member = db_get_all($sql);
		$data[$key]['c_member'] = $c_member[0];
		// プロフィール
		$data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
		// キャンセル料計算
		$data[$key]['cancel_list'] = get_cancel_list($value['reserve_id']);

		$data[$key]['room_price1'] = round($value['room_price']);
		$data[$key]['vessel_price1'] = round($value['vessel_price']);
		$data[$key]['service_price1'] = round($value['service_price']);

		$percent = ($data[$key]['cancel_list']['percent'])*0.01;
		$data[$key]['room_price'] = round($value['room_price']*$percent);
		$data[$key]['vessel_price'] = round($value['vessel_price']*$percent);
		$data[$key]['service_price'] = round($value['service_price']*$percent);

		

		// キャンセル料
		$data[$key]['cancel_price'] = round(($value['room_price']+$value['vessel_price']+$value['service_price'])*($data[$key]['cancel_list']['percent']*0.01));
		$data[$key]['cancel_price1'] = round($value['room_price']+$value['vessel_price']+$value['service_price']);
	} // foreach
 	$this->set('data', $data);


        return 'success';
    }
}

?>
