<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_reserve_list extends OpenPNE_Action
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

	$c_member_id = null;
	if(isset($_REQUEST['u']) && $_REQUEST['u']){
		$c_member_id = $_REQUEST['u'];
	}
	$this->set('c_member_id', $c_member_id);

	$limit = null;
	if(isset($_REQUEST['limit']) && $_REQUEST['limit']){
		$limit = $_REQUEST['limit'];
	}
	$this->set('limit', $limit);

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);

	//件数
	$sql = "select count(reserve_id) as reserve_num from a_reserve_list where tmp_flag = 0 and cancel_flag = 0 and pay_flag = 0 ";

	if($hall_id){
		$sql.= "and hall_id = '$hall_id' ";
	}
	if($c_member_id){
		$sql.= "and c_member_id = '$c_member_id' ";
	}
	if($limit==1){
		$sql.= "and pay_limitdate >= now() ";
	}elseif($limit==2){
		$sql.= "and pay_limitdate < now() ";
	}

	$sql.= "order by reserve_datetime";
	$result = db_get_all($sql);
	$num = isset($result[0]['reserve_num']) ? $result[0]['reserve_num'] : null;
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);

	//検索
	$sql = "select * from a_reserve_list where tmp_flag = 0 and cancel_flag = 0 and pay_flag = 0 ";

	if($hall_id){
		$sql.= "and hall_id = '$hall_id' ";
	}
	if($c_member_id){
		$sql.= "and c_member_id = '$c_member_id' ";
	}
	if($limit==1){
		$sql.= "and pay_limitdate >= now() ";
	}elseif($limit==2){
		$sql.= "and pay_limitdate < now() ";
	}


	$sql.= "order by reserve_datetime ";
	$sql.= "limit ".$index.", 10";
	$result = db_get_all($sql);

	foreach($result as $key=>$value){

/// 2013.12.21 消費税改定対応 begin

		$tmp_date = strtotime($value['begin_datetime']);	/// 使用開始時刻
		$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 税率適用日
		$tmp_sql  = "";
		$tmp_sql .= "select rate from a_tax ";			/// 税率テーブル
		$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
		$tmp_sql .= "order by stadate desc ";			/// 開始日の降順
		$tmp_sql .= "limit 0, 1";				/// 先頭１件
		$tmp_tab  = db_get_all($tmp_sql);
		$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率

/// 2013.12.21 消費税改定対応 end

		// 日付書式
		if($value['tmp_reserve_datetime']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['tmp_reserve_datetime']);
			$result[$key]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		}else{
			$result[$key]['tmp_reserve_datetime']="-- --";
		}
		if($value['reserve_datetime']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['reserve_datetime']);
			$result[$key]['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		}else{
			$result[$key]['reserve_datetime'] = "-- --";
		}
	if ($value['pay_checkdate']!='0000-00-00 00:00:00'){
		$dt = new DateTime($value['pay_checkdate']);
		$result[$key]['pay_checkdate'] = $dt->format("Y年m月d日 H時i分s秒");
	}else{
		$result[$key]['pay_checkdate'] = 0;
	}
		
		$dt = new DateTime($value['begin_datetime']);
        $week = get_week($dt->format("Ymd"));
		$result[$key]['datetime'] = $dt->format("Y年m月d日(".$week.")");
		$result[$key]['begin_datetime'] = $dt->format("H時i分");
		$dt = new DateTime($value['finish_datetime']);
		$result[$key]['finish_datetime'] = $dt->format("H時i分");
		if($value['pay_limitdate']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['pay_limitdate']);
			$result[$key]['pay_limitdate'] = $dt->format("Y年m月d日");
		}else{
			$result[$key]['pay_limitdate'] ="-- --";
		}
		$s = mktime(0,0,0,$dt->format("m"),$dt->format("d"),$dt->format("Y")) - mktime(0,0,0,date("m"),date("d"),date("Y"));
		$result[$key]['pay_limit'] = ($s/60/60/24);

		// 会場
		$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
		$hall_data = db_get_all($sql);
		$result[$key]['hall_data'] = isset($hall_data[0]) ? $hall_data[0] : null;
		// 部屋
		$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
		$room_data = db_get_all($sql);
		$result[$key]['room_data'] = isset($room_data[0]) ? $room_data[0] : null;

		//備品
		$sql = "select * from a_reserve_v where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_v_list = db_get_all($sql);

		$cancel_vessel_price = 0;
	if($reserve_v_list){
		foreach($reserve_v_list as $k=>$v){
			$vessel_data = get_vessel_data($v['vessel_id']);
			$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
			$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];

			$tmp_price = $vessel_data['price'];		
			// 備品使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));		
			$cancel_vessel_price += $tmp_price*$v['num'];			

/// 2013.12.21 消費税改定対応 end

		}
	}else{
		$reserve_v_list = 0;
	}
		$result[$key]['reserve_v_list'] = $reserve_v_list;

		//サービス
		$sql = "select * from a_reserve_s where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_s_list = db_get_all($sql);
		$cancel_service_price = 0;
	if($reserve_s_list){
		foreach($reserve_s_list as $k=>$v){
			$service_data = get_service_data($v['service_id']);
			$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
			$reserve_s_list[$k]['memo'] = $service_data['memo2'];
			if($service_data['cancel_mode']==1){


/// 2013.12.21 消費税改定対応 begin

			  $tmp_price = $service_data['price'];		/// サービス使用料
			  $tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			  $tmp_price = round($tmp_price * (1 + $tmp_tax));
			  $cancel_service_price += $tmp_price*$v['num'];

/// 2013.12.21 消費税改定対応 end

			}
		}
	}else{
		$reserve_s_list = 0;
	}
		$result[$key]['cancel_service_price'] = $cancel_service_price;
		$result[$key]['cancel_vessel_price'] = $cancel_vessel_price;
		$result[$key]['reserve_s_list'] = $reserve_s_list;

		// 会員情報
		$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
		$c_member = db_get_all($sql);
		$result[$key]['c_member'] = $c_member[0];
		// プロフィール
		$result[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
		// キャンセル料計算
		$result[$key]['cancel_list'] = get_cancel_list($value['reserve_id']);
		$result[$key]['room_price1'] = $value['room_price'];

		$percent = $result[$key]['cancel_list']['percent']*0.01;
		$result[$key]['room_price'] = round($value['room_price']*$percent);
		$result[$key]['vessel_price'] = round($value['vessel_price']*$percent);
		$result[$key]['service_price'] = round($value['service_price']*$percent);
		$result[$key]['room_price1'] = round($value['room_price']);
		$result[$key]['vessel_price1'] = round($value['vessel_price']);
		$result[$key]['service_price1'] = round($value['service_price']);
		// キャンセル料
		$result[$key]['cancel_price'] = round(($value['room_price']+$value['vessel_price']+$value['service_price'])*($result[$key]['cancel_list']['percent']*0.01));
		$result[$key]['cancel_price1'] = round($value['room_price']+$value['vessel_price']+$value['service_price']);

	}
	$this->set('reserve_list', $result);

        return 'success';
    }
}

?>
