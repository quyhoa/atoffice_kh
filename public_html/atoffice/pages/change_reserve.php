<?php
//var_dump($_REQUEST);
function db_get_all($sql, $db){
	$result = mysql_query($sql, $db);
	while($item = @mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}

/// 2013.12.21 消費税改定対応 begin

function tmp_room_price_convert(&$tab, $tax){

	for($i = 0; $i < count($tab); $i++){

		/// 本体価格計算
		if($tab[$i]["k_lowest_price"]	) $tab[$i]["k_lowest_price"]	=round($tab[$i]["k_lowest_price"]	/1.05);
		if($tab[$i]["price1"]		) $tab[$i]["price1"]		=round($tab[$i]["price1"]		/1.05);
		if($tab[$i]["price2"]		) $tab[$i]["price2"]		=round($tab[$i]["price2"]		/1.05);
		if($tab[$i]["price3"]		) $tab[$i]["price3"]		=round($tab[$i]["price3"]		/1.05);
		if($tab[$i]["price4"]		) $tab[$i]["price4"]		=round($tab[$i]["price4"]		/1.05);
		if($tab[$i]["price5"]		) $tab[$i]["price5"]		=round($tab[$i]["price5"]		/1.05);
		if($tab[$i]["price6"]		) $tab[$i]["price6"]		=round($tab[$i]["price6"]		/1.05);
		if($tab[$i]["price7"]		) $tab[$i]["price7"]		=round($tab[$i]["price7"]		/1.05);
		if($tab[$i]["k_price2"]		) $tab[$i]["k_price2"]		=round($tab[$i]["k_price2"]		/1.05);
		if($tab[$i]["k_price3"]		) $tab[$i]["k_price3"]		=round($tab[$i]["k_price3"]		/1.05);
		if($tab[$i]["k_highest_price"]	) $tab[$i]["k_highest_price"]	=round($tab[$i]["k_highest_price"]	/1.05);
		if($tab[$i]["price8"]		) $tab[$i]["price8"]		=round($tab[$i]["price8"]		/1.05);
		if($tab[$i]["price9"]		) $tab[$i]["price9"]		=round($tab[$i]["price9"]		/1.05);
		if($tab[$i]["price12"]		) $tab[$i]["price12"]		=round($tab[$i]["price12"]		/1.05);
		if($tab[$i]["price13"]		) $tab[$i]["price13"]		=round($tab[$i]["price13"]		/1.05);
		if($tab[$i]["price14"]		) $tab[$i]["price14"]		=round($tab[$i]["price14"]		/1.05);
		if($tab[$i]["price15"]		) $tab[$i]["price15"]		=round($tab[$i]["price15"]		/1.05);
		if($tab[$i]["price16"]		) $tab[$i]["price16"]		=round($tab[$i]["price16"]		/1.05);
		if($tab[$i]["price17"]		) $tab[$i]["price17"]		=round($tab[$i]["price17"]		/1.05);
		if($tab[$i]["price18"]		) $tab[$i]["price18"]		=round($tab[$i]["price18"]		/1.05);
		if($tab[$i]["price19"]		) $tab[$i]["price19"]		=round($tab[$i]["price19"]		/1.05);
		if($tab[$i]["price20"]		) $tab[$i]["price20"]		=round($tab[$i]["price20"]		/1.05);
		if($tab[$i]["price21"]		) $tab[$i]["price21"]		=round($tab[$i]["price21"]		/1.05);
		if($tab[$i]["price22"]		) $tab[$i]["price22"]		=round($tab[$i]["price22"]		/1.05);
		if($tab[$i]["price23"]		) $tab[$i]["price23"]		=round($tab[$i]["price23"]		/1.05);
		if($tab[$i]["price24"]		) $tab[$i]["price24"]		=round($tab[$i]["price24"]		/1.05);

		/// 消費税額計算
		if($tab[$i]["k_lowest_price"]	) $tab[$i]["k_lowest_price"]	=round($tab[$i]["k_lowest_price"]	*$tax);
		if($tab[$i]["price1"]		) $tab[$i]["price1"]		=round($tab[$i]["price1"]		*$tax);
		if($tab[$i]["price2"]		) $tab[$i]["price2"]		=round($tab[$i]["price2"]		*$tax);
		if($tab[$i]["price3"]		) $tab[$i]["price3"]		=round($tab[$i]["price3"]		*$tax);
		if($tab[$i]["price4"]		) $tab[$i]["price4"]		=round($tab[$i]["price4"]		*$tax);
		if($tab[$i]["price5"]		) $tab[$i]["price5"]		=round($tab[$i]["price5"]		*$tax);
		if($tab[$i]["price6"]		) $tab[$i]["price6"]		=round($tab[$i]["price6"]		*$tax);
		if($tab[$i]["price7"]		) $tab[$i]["price7"]		=round($tab[$i]["price7"]		*$tax);
		if($tab[$i]["k_price2"]		) $tab[$i]["k_price2"]		=round($tab[$i]["k_price2"]		*$tax);
		if($tab[$i]["k_price3"]		) $tab[$i]["k_price3"]		=round($tab[$i]["k_price3"]		*$tax);
		if($tab[$i]["k_highest_price"]	) $tab[$i]["k_highest_price"]	=round($tab[$i]["k_highest_price"]	*$tax);
		if($tab[$i]["price8"]		) $tab[$i]["price8"]		=round($tab[$i]["price8"]		*$tax);
		if($tab[$i]["price9"]		) $tab[$i]["price9"]		=round($tab[$i]["price9"]		*$tax);
		if($tab[$i]["price10"]		) $tab[$i]["price10"]		=round($tab[$i]["price10"]		*$tax);
		if($tab[$i]["price11"]		) $tab[$i]["price11"]		=round($tab[$i]["price11"]		*$tax);
		if($tab[$i]["price12"]		) $tab[$i]["price12"]		=round($tab[$i]["price12"]		*$tax);
		if($tab[$i]["price13"]		) $tab[$i]["price13"]		=round($tab[$i]["price13"]		*$tax);
		if($tab[$i]["price14"]		) $tab[$i]["price14"]		=round($tab[$i]["price14"]		*$tax);
		if($tab[$i]["price15"]		) $tab[$i]["price15"]		=round($tab[$i]["price15"]		*$tax);
		if($tab[$i]["price16"]		) $tab[$i]["price16"]		=round($tab[$i]["price16"]		*$tax);
		if($tab[$i]["price17"]		) $tab[$i]["price17"]		=round($tab[$i]["price17"]		*$tax);
		if($tab[$i]["price18"]		) $tab[$i]["price18"]		=round($tab[$i]["price18"]		*$tax);
		if($tab[$i]["price19"]		) $tab[$i]["price19"]		=round($tab[$i]["price19"]		*$tax);
		if($tab[$i]["price20"]		) $tab[$i]["price20"]		=round($tab[$i]["price20"]		*$tax);
		if($tab[$i]["price21"]		) $tab[$i]["price21"]		=round($tab[$i]["price21"]		*$tax);
		if($tab[$i]["price22"]		) $tab[$i]["price22"]		=round($tab[$i]["price22"]		*$tax);
		if($tab[$i]["price23"]		) $tab[$i]["price23"]		=round($tab[$i]["price23"]		*$tax);
		if($tab[$i]["price24"]		) $tab[$i]["price24"]		=round($tab[$i]["price24"]		*$tax);
	}

}

function tmp_pack_price_convert(&$tab, $tax){

	for($i = 0; $i < count($tab); $i++){

		if($tab[$i]["koma2"] == 0){

		/// 本体価格計算
		if($tab[$i]["price"]		) $tab[$i]["price"]		=round($tab[$i]["price"]		/1.05);

		/// 消費税額計算
		if($tab[$i]["price"]		) $tab[$i]["price"]		=round($tab[$i]["price"]		*$tax);

		}

	}

}

/// 2013.12.21 消費税改定対応 end

	require_once("../at_office_config.php");
	if(!isset($mysql_db)) $mysql_db="at_office";
	require_once 'HTTP.php';

	global $mysql_addr;
	global $port;
	global $user;
	global $pass;

	$db = mysql_connect("$mysql_addr:$port", $user, $pass);
	if ($db == false)
	{
		print "sql connect error";
		exit(1);
	}
	mysql_select_db($mysql_db,$db) or die("sql database select error");


	mysql_query("SET NAMES 'utf8'");

	//var_dump($_REQUEST);

/// 2013.12.21 消費税改定対応 begin
//
//	if(!$_REQUEST['PHPSESSID']){
//		HTTP::redirect("error.php");
//	}
//
/// 2013.12.21 消費税改定対応 end

	session_start();
	$u = $_SESSION['u'];
	if(!$u){
		HTTP::redirect("error.php");
	}

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;reserve_id'])){
		$reserve_id = $_REQUEST['amp;reserve_id'];
	}elseif(preg_match("/^[0-9]+$/", $_REQUEST['reserve_id'])){
		$reserve_id = $_REQUEST['reserve_id'];
	}else{
		HTTP::redirect("error.php");
	}

	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id' and c_member_id = '$u'";
	$reserve_data = db_get_all($sql, $db);
	$reserve_data = $reserve_data[0];
// 変更済みだったら終了
	if($reserve_data['change_flag']){
		print "この予約はすでに変更済みです。";
		exit(1);
	}

// 利用日付が２営業日前か再確認
	// 利用日から2営業日以上前か
	$limit = get_business_days(2, $db);
	$dt = new DateTime($limit);
	$limit_num = $dt->format("YmdHis");
	$dt = new DateTime($reserve_data['begin_datetime']);
	$begin_num = $dt->format("YmdHis");

	if($reserve_data['cancel_flag']!=0 or $reserve_data['complete_flag']!=0 or $limit_num >= $begin_num or $reserve_data['pay_money']!=0){
		print "この予約は変更できません。";
		exit(1);
	}

// 期限切れ消去
$sql = "delete from a_pre_id where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_reserve where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_rv where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_rs where limit_datetime < now()";
db_get_all($sql, $db);

// ID発行
if(!$_REQUEST['amp;pre_id'] and !$_REQUEST['pre_id']){
	$pre_id = rand(10000, 999999999);
	while(get_pre_id($pre_id, $db)){
		$pre_id = rand(10000, 999999999);
	}
	$sql = "insert into a_pre_id (pre_id, limit_datetime) values ('$pre_id', NOW() + INTERVAL 3 hour)";
	db_get_all($sql, $db);
}else{
	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}elseif(preg_match("/^[0-9]+$/", $_REQUEST['pre_id'])){
		$pre_id = $_REQUEST['pre_id'];
	}else{
		exit(1);
	}
}

// 会場ID

	$hall_id = $reserve_data['hall_id'];

	if($_REQUEST['amp;rid']){
		$room_id = $_REQUEST['amp;rid'];
	}else{
		$room_id = $reserve_data['room_id'];
	}

// 旧予約情報
	$reserve_data['room_name'] = get_room_name($hall_id, $room_id, $db);
	
	$dt = new DateTime($reserve_data['begin_datetime']);
    $reserve_data['week'] = get_week($dt->format("Ymd"));
	$reserve_data['reserve_date'] = $dt->format("Y年m月d日");
	$reserve_data['begin_time'] = $dt->format("H:i");
	$dt = new DateTime($reserve_data['finish_datetime']);
	$reserve_data['finish_time'] = $dt->format("H:i");

	if($_REQUEST['amp;target_year'] and $_REQUEST['amp;target_month'] and $_REQUEST['amp;target_day']){
		$year = $_REQUEST['amp;target_year'];
		$month = $_REQUEST['amp;target_month'];
		$day = $_REQUEST['amp;target_day'];
	}elseif($_REQUEST['year'] and $_REQUEST['month'] and $_REQUEST['day']){
		$year = $_REQUEST['year'];
		$month = $_REQUEST['month'];
		$day = $_REQUEST['day'];

	}else{

		$dt = new DateTime($reserve_data['begin_datetime']);
		$year = $dt->format("Y");
		$month = $dt->format("m");
		$day = $dt->format("d");
	}

/// 2013.12.21 消費税改定対応 begin

	$tmp_ymd = sprintf("%04d-%02d-%02d 00:00:00", $year, $month, $day);
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
	$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";			/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql, $db);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100 + 1;	/// 消費税率

/// 2013.12.21 消費税改定対応 end

    $wweek = get_week($year.sprintf("%02d", $month).sprintf("%02d", $day));

// 会場取得

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql, $db);
	$hall_data = $hall_data[0];





// 営業時間範囲
	$open_time = array();
	for($x=$hall_data['begin'];$x<$hall_data['finish'];$x++){
		array_push($open_time, intval($x));
	}
	$col_num = 1;

// 会場で有効な部屋データ

	$sql = "select * from a_room where hall_id = $hall_id and flag=1";
	$room_data = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

	tmp_room_price_convert($room_data, $tmp_tax);

/// 2013.12.21 消費税改定対応 end

	$strdt=strtotime($datetime);

// 補正時間（神田）




foreach($room_data as $k=>$v){

if(!check_holiday($hall_id, $v['room_id'], $year, $month, $day, $db)){
	$room_data[$k]['holiday'] = 0;
	$room_data[$k]['opentime'] = $open_time;
	$room_data[$k]['max'] = max($v['num_school'], $v['num_mouth'], $v['num_theater']);

	$komatime=0;
if ($v['type']==2){
		$koma = $v['koma'];
//		$komatime=$hall_data['hall_attribute']?0:($koma*60*60);
		$komatime=$koma*60*60;
		if($koma>1){
			$hosei = $koma*$v['lowest_koma'];
		}else{
			$hosei = $v['lowest_koma'];
		}
		$koma = $v['koma'];
		$min = array();
		if($koma==0.5){
			$room_data[$k]['cs'] = 2;
			$key=0;
			foreach($open_time as $value){
				$min[$key]['time'] = sprintf("%02d", $value).':00';
				$key++;
				$min[$key]['time'] = sprintf("%02d", $value).':30';
				$key++;
			}
			$room_data[$k]['opentime'] = $min;
			if($col_num<2){
				$col_num = 2;
			}
		}elseif($koma==0.25){
			$room_data[$k]['cs'] = 1;
			foreach($open_time as $value){
				$min[$key]['time'] = sprintf("%02d", $value).':00';
				$key++;
				$min[$key]['time'] = sprintf("%02d", $value).':15';
				$key++;
				$min[$key]['time'] = sprintf("%02d", $value).':30';
				$key++;
				$min[$key]['time'] = sprintf("%02d", $value).':45';
				$key++;
			}
			$room_data[$k]['opentime'] = $min;
			if($col_num<3){
				$col_num = 3;
			}
		}else{

			$room_data[$k]['cs'] = 4*$v['koma'];
			$count_koma = 0;
			foreach($open_time as $value){
				$count_koma--;
				if($count_koma<=0){
					if(($value+$v['koma']) <= $hall_data['finish']){
						$min[$key]['time'] = sprintf("%02d", $value).':00';
						$key++;
						$count_koma = $v['koma'];
					}
				}
			}
			$room_data[$k]['opentime'] = $min;
			

		}

		// その日のデータを全て取得する。
		$dayday=$year."-".$month."-".$day." ";
		$daystart=$dayday."00:00:00";
		$dayend=$dayday."23:59:59";
			$sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime)";
			$today_reserve_flag = db_get_all($sql, $db);
			// 重なる貸し止め
			$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and (limit_datetime > now() or flag=1)";
			$today_stop_flag = db_get_all($sql, $db);

	foreach($room_data[$k]['opentime'] as $key=>$val){
		$room_data[$k]['opentime'][$key]['reserved'] = 0;

		$datetime = $year."-".$month."-".$day." ".$val['time'].":00";
			$strdt=strtotime($datetime);
//			$tmptime=strtotime($datetime);
//			$datetime1=date("Y-m-d H:i:s",$tmptime+$komatime);
//			$datetime2=date("Y-m-d H:i:s",$tmptime-$komatime);

/*
		// 重なる予約
//		$sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime <= '$datetime1' and '$datetime2' < finish_datetime)";
		$sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and ((reserve_id != $reserve_id and begin_datetime <= '$datetime1' and '$datetime2' < finish_datetime) or (reserve_id = $reserve_id and begin_datetime <= '$datetime' and '$datetime' < finish_datetime))";
// 予約IDが一致してなくて拡張された時間内か、予約IDが一致してて時間内か
		$reserve_flag = db_get_all($sql, $db);
//	echo "DT $key $datetime1 $datetime2 <br>";
//	var_dump($reserve_flag);
//  echo "--<br>";

		// 重なる貸し止め
		$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and (limit_datetime > now() or flag=1)";
		$stop_flag = db_get_all($sql, $db);
*/
			$reserve_flag=$stop_flag=0;
			
			if(isset($today_reserve_flag)) foreach($today_reserve_flag as $kk=>$vv){

				if(($vv['reserve_id']!=$reserve_id && strtotime($vv['begin_datetime'])<=$strdt+$komatime && strtotime($vv['finish_datetime'])>$strdt-$komatime)||
				   ($vv['reserve_id']==$reserve_id && strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt))
					{ $reserve_flag=$vv['reserve_id']; break; }
			}
			if(isset($today_stop_flag)) foreach($today_stop_flag as $kk=>$vv){
				if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $stop_flag=1; break; }
			}
//		echo "today_reserve_flag ="; var_dump($today_reserve_flag); echo "<br>";

/*
		if($reserve_flag[0]['reserve_id']){
			if($reserve_flag[0]['reserve_id'] == $reserve_id){
				$room_data[$k]['opentime'][$key]['reserved'] = 0;
				$room_data[$k]['opentime'][$key]['checked'] = 1;			}else{
				$room_data[$k]['opentime'][$key]['reserved'] = 1;
			}
		}elseif($stop_flag[0]['stop_id']){
			$room_data[$k]['opentime'][$key]['reserved'] = 1;
*/
		if($reserve_flag){
			if($reserve_flag == $reserve_id){
				$room_data[$k]['opentime'][$key]['reserved'] = 0;
				$room_data[$k]['opentime'][$key]['checked'] = 1;			}else{
				$room_data[$k]['opentime'][$key]['reserved'] = 1;
			}
		}elseif($stop_flag){
			$room_data[$k]['opentime'][$key]['reserved'] = 1;

		}else{
			$room_data[$k]['opentime'][$key]['reserved'] = 0;
		}
	}

	// 代理店割引確認
	$sql = "select * from a_agency where c_member_id = $u";
	$agency = db_get_all($sql, $db);
	$agency = $agency[0];

	if(!empty($agency)){
		$room_data[$k]['agency'] = 1;
		if($agency['type'] == 1){
			$hallListId = !empty($agency['hall_list']) ? json_decode($agency['hall_list'],true) : null;
			$room_data[$k]['discount'] = $hallListId[$hall_id];
		}elseif($agency['percent']){
			$room_data[$k]['discount'] = $agency['percent'];
		}
	}else{

	// 割引期間
	$room_data[$k]['agency'] = 0;
	$room_data[$k]['discount'] = 0;
	$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = ".$v['room_id']." and flag = 1";
	//print $sql."<br>";
	$result = db_get_all($sql, $db);
	if ($result){
		if($result[0]['pattern_id'] <= 3){
			$d_begin_time = $result[0]['begin_year'].sprintf('%02d', $result[0]['begin_month']).sprintf('%02d', $result[0]['begin_day']);
			$d_finish_time = $result[0]['finish_year'].sprintf('%02d', $result[0]['finish_month']).sprintf('%02d', $result[0]['finish_day']);
			$reserve_date = $year.sprintf('%02d', $month).sprintf('%02d', $day);
			if($d_begin_time <= $reserve_date and $reserve_date <= $d_finish_time){
				// 期間割引
				$room_data[$k]['discount'] = $result[0]['percent'];
			}

		}else{
			$week = date('w',mktime(0,0,0,$month,$day,$year));
			if($result[0]['continuance']==1){
				//すべての平日
				if($week!=0 and $week!=6){
					//土日以外
					$sql = "select * from c_holiday where month=$month and day=$day";
					if(!db_get_all($sql, $db)){
						//祝日以外
						$room_data[$k]['discount'] = $result[0]['percent'];

					}
				}
			}elseif($result[0]['continuance']==2){
				//すべての土曜
				if($week==6){
					$room_data[$k]['discount'] = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==3){
				//すべての日祭日
				$sql = "select * from c_holiday where month=$month and day=$day";
				if($week==0 or db_get_all($sql, $db)){
					$room_data[$k]['discount'] = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==4){
				//すべての営業日
				$room_data[$k]['discount'] = $result[0]['percent'];
			}

		}
	} // result

	} // agency

	// パック料金(神田タイプ)
	$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = ".$v['room_id']." and pack_flag = 1";
	$pack_list = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

	tmp_pack_price_convert($pack_list, $tmp_tax);

/// 2013.12.21 消費税改定対応 end

	$room_data[$k]['pack_list'] = $pack_list;
	$room_data[$k]['pack_num'] = count($pack_list);

//	var_dump($_REQUEST); echo "<br>!<br>";

}else{
// 池袋
// コマ割り

	$room_data[$k]['komawari'] = array();

		// その日のデータを全て取得する。
		$dayday=$year."-".$month."-".$day." ";
		$daystart=$dayday."00:00:00";
		$dayend=$dayday."23:59:59";
			$sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime)";
			
			$today_reserve_flag = db_get_all($sql, $db);

			// 重なる貸し止め
			$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and (limit_datetime > now() or flag=1)";
			$today_stop_flag = db_get_all($sql, $db);
//var_dump($today_stop_flag);

			// 選択済み予約
			$sql = "select * from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and limit_datetime > now()";
			$today_checked_flag = db_get_all($sql, $db);

			// 部屋データ取得

			$sql="select * from a_room where hall_id=$hall_id and room_id=".$v['room_id'];
			$roomstatus = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

			tmp_room_price_convert($roomstatus, $tmp_tax);

/// 2013.12.21 消費税改定対応 end

	foreach($room_data[$k]['opentime'] as $open_k=>$open_v){
			$datetime = $year."-".$month."-".$day." ".$open_v.":00:00";
//			$datetime = $year."-".$month."-".$day." ".$val['time'].":00";
			$strdt=strtotime($datetime);
/*
		$datetime = $year."-".$month."-".$day." ".$open_v.":00:00";
			$tmptime=strtotime($datetime);
			$datetime1=date("Y-m-d H:i:s",$tmptime+$komatime);
			$datetime2=date("Y-m-d H:i:s",$tmptime-$komatime);
		// 重なる予約
		$sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime <= '$datetime1' and '$datetime2' < finish_datetime)";
		$reserve_flag = db_get_all($sql, $db);
//	echo "DT $datetime1 $datetime2 <br>";
//	var_dump($reserve_flag);
//  echo "--<br>";
		// 重なる貸し止め
		$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and (limit_datetime > now() or flag=1)";
		$stop_flag = db_get_all($sql, $db);
*/
			$reserve_flag=$stop_flag=0;
			
			if(isset($today_reserve_flag)) foreach($today_reserve_flag as $kk=>$vv){
	
				if(($vv['reserve_id']!=$reserve_id && strtotime($vv['begin_datetime'])<=$strdt+$komatime && strtotime($vv['finish_datetime'])>$strdt-$komatime)||
				   ($vv['reserve_id']==$reserve_id && strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt))
					{ $reserve_flag=$vv['reserve_id']; break; }
			}
			if(isset($today_stop_flag)) foreach($today_stop_flag as $kk=>$vv){
				if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $stop_flag=1; break; }
			}

		//print $sql."<br>";
		for($x=1;$x<=7;$x++){
			if(!is_null($v['begin_time'.$x]) and $open_v == $v['begin_time'.$x]){
				$room_data[$k]['komawari'][$open_k]['cs']=($v['finish_time'.$x]-$v['begin_time'.$x])*4;
				$room_data[$k]['komawari'][$open_k]['begin_time'] = sprintf("%02d", $v['begin_time'.$x]).":00";
				$room_data[$k]['komawari'][$open_k]['finish_time'] = sprintf("%02d", $v['finish_time'.$x]).":00";
				$room_data[$k]['komawari'][$open_k]['price'] = $v['price'.$x];
				$room_data[$k]['komawari'][$open_k]['rest']=0;
/*
				if($reserve_flag[0]['reserve_id']){
					if($reserve_flag[0]['reserve_id'] == $reserve_id){
						$room_data[$k]['komawari'][$open_k]['reserved']=0;
						$room_data[$k]['komawari'][$open_k]['checked']=1;
					}else{
						$room_data[$k]['komawari'][$open_k]['reserved']=$reserve_flag[0]['reserve_id'];
					}
				}elseif($stop_flag[0]['stop_id']){
*/
				if($reserve_flag){
					if($reserve_flag == $reserve_id){
						$room_data[$k]['komawari'][$open_k]['reserved']=0;
						$room_data[$k]['komawari'][$open_k]['checked']=1;
					}else{
						$room_data[$k]['komawari'][$open_k]['reserved']=$reserve_flag;
					}
				}elseif($stop_flag){
					$room_data[$k]['komawari'][$open_k]['reserved']=1;
				}
				break;
			}else{
				$sql="select count(*) as flag from a_room where hall_id=$hall_id and room_id=".$v['room_id']." and ((begin_time1 < $open_v and $open_v < finish_time1) or (begin_time2 < $open_v and $open_v < finish_time2) or (begin_time3 < $open_v and $open_v < finish_time3) or (begin_time4 < $open_v and $open_v < finish_time4) or (begin_time5 < $open_v and $open_v < finish_time5) or (begin_time6 < $open_v and $open_v < finish_time6) or (begin_time7 < $open_v and $open_v < finish_time7))";
				//print $sql."<br>";
				$check = db_get_all($sql, $db);
				if(!$check[0]['flag']){
					$room_data[$k]['komawari'][$open_k]['cs']=4;
					$room_data[$k]['komawari'][$open_k]['rest']=1;
				}
			}// if

		}// for

	}

	// 代理店割引確認
	$sql = "select * from a_agency where c_member_id = $u";
	$agency = db_get_all($sql, $db);
	$agency = $agency[0];

	if(!empty($agency)){
		$room_data[$k]['agency'] = 1;
		if($agency['type'] == 1){
			$hallListId = !empty($agency['hall_list']) ? json_decode($agency['hall_list'],true) : null;
			$room_data[$k]['discount'] = $hallListId[$hall_id];
		}elseif($agency['percent']){
			$room_data[$k]['discount'] = $agency['percent'];
		}
	}else{

	// 割引期間
	$room_data[$k]['agency'] = 0;
	$room_data[$k]['discount'] = 0;
	$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = ".$v['room_id']." and flag = 1";
	//print $sql."<br>";
	$result = db_get_all($sql, $db);
	if ($result){
		if($result[0]['pattern_id'] <= 3){
			$d_begin_time = $result[0]['begin_year'].sprintf('%02d', $result[0]['begin_month']).sprintf('%02d', $result[0]['begin_day']);
			$d_finish_time = $result[0]['finish_year'].sprintf('%02d', $result[0]['finish_month']).sprintf('%02d', $result[0]['finish_day']);

			$reserve_date = $year.sprintf('%02d', $month).sprintf('%02d', $day);
			// print $d_begin_time."<br>".$reserve_date."<br>".$d_finish_time;

			if($d_begin_time <= $reserve_date and $reserve_date <= $d_finish_time){

				$room_data[$k]['discount'] = $result[0]['percent'];

			}

		}else{
			$week = date('w',mktime(0,0,0,$month,$day,$year));
			if($result[0]['continuance']==1){
				//すべての平日
				if($week!=0 and $week!=6){
					//土日以外
					$sql = "select * from c_holiday where month=$month and day=$day";
					if(!db_get_all($sql, $db)){
						//祝日以外
						$room_data[$k]['discount'] = $result[0]['percent'];

					}
				}
			}elseif($result[0]['continuance']==2){
				//すべての土曜
				if($week==6){
					$room_data[$k]['discount'] = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==3){
				//すべての日祭日
				$sql = "select * from c_holiday where month=$month and day=$day";
				if($week==0 or db_get_all($sql, $db)){
					$room_data[$k]['discount'] = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==4){
				//すべての営業日
				$room_data[$k]['discount'] = $result[0]['percent'];
			}
		}
	}// result

	}// agency

	// パック料金
	$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = ".$v['room_id']." and pack_flag = 1";
	$pack_list = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

	tmp_pack_price_convert($pack_list, $tmp_tax);

/// 2013.12.21 消費税改定対応 end

	if($agency['percent']>0 and $pack_list){
		foreach($pack_list as $pk=>$pv){
			$price = $pv['price'] - ($pv['price']*($agency['percent']*0.01));
			$pack_list[$pk]['price'] = $price;
			$pack_list[$pk]['pack_name'] = $pv['pack_name']."<br>代理店様値引き(".$agency['percent']."%引き)";
		}
	}
	$room_data[$k]['pack_list'] = $pack_list;
	$room_data[$k]['pack_num'] = count($pack_list);


}// if type

}else{ // holiday

	$room_data[$k]['holiday'] = 1;

}// holiday

}// foreach


function check_holiday($hall_id, $room_id, $year, $month, $day, $db){
	$week = date('w',mktime(0,0,0,$month,$day,$year));
	// 会場の休日
	$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $month and day = $day";
	if(db_get_all($sql, $db)){
		return(1);
	}

	// 部屋の休日
	$sql = "select * from a_room_holiday where hall_id = $hall_id and room_id = $room_id and year = $year and month = $month and day = $day";
	if(db_get_all($sql, $db)){
		return(1);
	}


	$sql = "select * from a_hall_regular_holiday where hall_id = $hall_id";
	$hall_rh = db_get_all($sql, $db);
	$hall_rh = $hall_rh[0];

	$sql = "select * from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
	$room_rh = db_get_all($sql, $db);
	$room_rh = $room_rh[0];

	if(($hall_rh['january'] or $room_rh['january']) and $month==1){
		return(1);
	}elseif(($hall_rh['february'] or $room_rh['february']) and $month==2){
		return(1);
	}elseif(($hall_rh['march'] or $room_rh['march']) and $month==3){
		return(1);
	}elseif(($hall_rh['april'] or $room_rh['april']) and $month==4){
		return(1);
	}elseif(($hall_rh['may'] or $room_rh['may']) and $month==5){
		return(1);
	}elseif(($hall_rh['june'] or $room_rh['june']) and $month==6){
		return(1);
	}elseif(($hall_rh['july'] or $room_rh['july']) and $month==7){
		return(1);
	}elseif(($hall_rh['august'] or $room_rh['august']) and $month==8){
		return(1);
	}elseif(($hall_rh['september'] or $room_rh['september']) and $month==9){
		return(1);
	}elseif(($hall_rh['october'] or $room_rh['october']) and $month==10){
		return(1);
	}elseif(($hall_rh['november'] or $room_rh['november']) and $month==11){
		return(1);
	}elseif(($hall_rh['december'] or $room_rh['december']) and $month==12){
		return(1);
	}

	if(($hall_rh['sunday'] or $room_rh['sunday']) and $week==0){
		return(1);
	}elseif(($hall_rh['monday'] or $room_rh['monday']) and $week==1){
		return(1);
	}elseif(($hall_rh['tuesday'] or $room_rh['tuesday']) and $week==2){
		return(1);
	}elseif(($hall_rh['wednesday'] or $room_rh['wednesday']) and $week==3){
		return(1);
	}elseif(($hall_rh['thursday'] or $room_rh['thursday']) and $week==4){
		return(1);
	}elseif(($hall_rh['friday'] or $room_rh['friday']) and $week==5){
		return(1);
	}elseif(($hall_rh['saturday'] or $room_rh['saturday']) and $week==6){
		return(1);
	}

	if($hall_rh['day'.$day] or $room_rh['day'.$day]){
		return(1);
	}

	if($hall_rh['holiday'] or $room_rh['holiday']){
		$sql = "select * from c_holiday where month = $month and day = $day";
		if(db_get_all($sql, $db)){
			return(1);
		}
	}

	return(0);
}

function get_room_name($hall_id, $room_id, $db){
	$sql = "select room_name from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_name = db_get_all($sql, $db);
	return $room_name[0]['room_name'];
}

function get_business_days($days, $db){
	$year = date("Y");
	$month = date("m");
	$day = date("d");
	// 予約最短日に修正(3日後)
	$count=1;
	while($count<=$days){
		$day++;
		if(!checkdate($month, $day, $year)){
			$month++;
			$day=1;
			if(!checkdate($month, $day, $year)){
				$year++;
				$month=1;
			}
		}
		// 土日を飛ばす
		$week = date('w',mktime(0,0,0,$month,$day,$year));
		if($week!=0 and $week!=6){
			// 祝日を飛ばす
			$sql = "select * from c_holiday where month = $month and day = $day";
			$result = db_get_all($sql, $db);
			if(!$result){
				//print "$month / $day<br>";
				$count++;
			}
		}
	}
	return("$year-$month-$day 00:00:00");
}

function get_pre_id($pre_id, $db){
	$sql = "select * from a_pre_id where pre_id = '$pre_id'";
	$result = db_get_all($sql, $db);
	if($result){
		return(1);
	}else{
		return(0);
	}
}

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}

?>

<head>
<script type="text/javascript" src="./atoffice/js/prototype.js"></script>
<script type="text/javascript" src="./atoffice/js/smartRollover.js"></script>
<script type="text/javascript" src="./atoffice/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="./atoffice/js/highslide.js"></script>
<script type="text/javascript">
  hs.graphicsDir = 'http://www.at-office.co.jp/highslide/graphics/';
  hs.outlineType = 'rounded-white';
  window.onload = function() {
  hs.preloadImages(5);
      }
</script>
<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body>

<form name="change_room" id="change_room" method="POST" action="./">
<input type="hidden" name="hid" value="<?php print $hall_id; ?>">
<input type="hidden" name="page" value="change_reserve">
<input type="hidden" name="year" value="<?php print $year; ?>">
<input type="hidden" name="month" value="<?php print $month; ?>">
<input type="hidden" name="day" value="<?php print $day; ?>">
<input type="hidden" name="reserve_id" value="<?php print $reserve_id; ?>">
<input type="hidden" name="rid_c" id="rid_c" value="">
</form>

<h2><b><?php print "予約日時・部屋変更 (".$hall_data['hall_name'].")"; ?></b></h2>
<br>

<center>

<form onSubmit="return reserve_check();" name="reserve" id="reserve" method="POST" action="./">
<input type="hidden" name="reserve_id" value="<?php print $reserve_id; ?>">
<input type="hidden" name="page" value="do_pre_change_set">
<input type="hidden" name="hid" id="hid" value="<?php print $hall_id; ?>">
<input type="hidden" name="year" value="<?php print $year; ?>">
<input type="hidden" name="month" value="<?php print $month; ?>">
<input type="hidden" name="day" value="<?php print $day; ?>">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="rid" id="rid" value="">


<table width=600>
<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>施設名</td>
<td width=200 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><?php print $hall_data['hall_name']; ?></td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>部屋名</td>
<td width=200 style='border: 1px #000000 solid;text-align: center;'vertical-align:middle;>
旧：　<?php print $reserve_data['room_name']; ?><br>
↓<br>
新：　<span id="room_name_top">未選択</span>
</td>
</tr>

<td width=100 rowspan=2 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>部屋情報</td>
<td height=120 rowspan=2 style='border: 1px #000000 solid;text-align: center;'>

<?php
foreach($room_data as $value){
	if($value['type']==2){
		print "<div id='room_info".$value['room_id']."' style='display:none;'>";
		print "<center>最大 <span id=".$value['room_id']."max >".$value['max']."</span> 座席</center>";
		print "<table><tr><td colspan=2>";

		if($value['k_lowest_price']){
			print "</td></tr>";
			print "<tr>";
			print "<td>";
			print "<span id=".$value['room_id']."low1 >".$value['k_capa_lowest']."</span>人まで";
			print "</td><td style='text-align: right;'>";
			print "<span id=".$value['room_id']."price1 style='display:none;'>".$value['k_lowest_price']."</span>";
			print "<span id=".$value['room_id']."price1_v >".number_format($value['k_lowest_price'])."</span> 円";
		}


		if($value['k_price2']){
			print "</td></tr>";
			print "<tr>";
			print "<td>";
			print "<span id=".$value['room_id']."low2 >".$value['k_capa_low2']."</span>人から<span id=".$value['room_id']."high2 >".$value['k_capa_high2']."</span>人まで";
			print "</td><td style='text-align: right;'>";
			print "<span id=".$value['room_id']."price2 style='display:none;' >".$value['k_price2']."</span>";
			print "<span id=".$value['room_id']."price2_v >".number_format($value['k_price2'])."</span> 円";
		}
		if($value['k_price3']){
			print "</td></tr>";
			print "<tr>";
			print "<td>";
			print "<span id=".$value['room_id']."low3 >".$value['k_capa_low3']."</span>人から<span id=".$value['room_id']."high3 >".$value['k_capa_high3']."</span>人まで";
			print "</td><td style='text-align: right;'>";
			print "<span id=".$value['room_id']."price3 style='display:none;' >".$value['k_price3']."</span> 円";
			print "<span id=".$value['room_id']."price3_v >".number_format($value['k_price3'])."</span> 円";
		}
		if($value['k_highest_price']){
			print "</td></tr>";
			print "<tr>";
			print "<td>";
			print "<span id=".$value['room_id']."high4 >".$value['k_capa_highest']."</span>人以上";
			print "</td><td style='text-align: right;'>";
			print "<span id=".$value['room_id']."price4 style='display:none;' >".$value['k_highest_price']."</span> 円";
			print "<span id=".$value['room_id']."price4_v >".number_format($value['k_highest_price'])."</span> 円";

		}
		print "</td></tr></table>";

        // パック料金
		print "<div style='display:none;'>";
		foreach($value['pack_list'] as $k=>$v){
			print "<span id='".$value['room_id']."pack_name".$k."'>".$v['pack_name']."</span>";
			print "<span id='".$value['room_id']."koma1".$k."'>".$v['koma1']."</span>";
			print "<span id='".$value['room_id']."koma2".$k."'>".$v['koma2']."</span>";
			print "<span id='".$value['room_id']."pack_percent".$k."'>".$v['price']."</span>";
		}
		print "<span id='".$value['room_id']."pack_num'>".$value['pack_num']."</span>";
		print "</div>";

		print "</div>";

	}else{
		print "<div id='room_info".$value['room_id']."' style='display:none;'>";
			print "<center>最大 <span id=".$value['room_id']."max >".$value['max']."</span> 座席</center>";
		print "<span style='color: #6633FF;'><b>１コマ目：</b></span>";
		print "<b>".$value['begin_time1']."</b>時～<b>".$value['finish_time1']."</b>時　<b>".number_format($value['price1'])."</b>円<br>";

		if ($value['price2']){
			print "<span style='color: #6633FF;'><b>２コマ目：</b></span>";
			print "<b>".$value['begin_time2']."</b>時～<b>".$value['finish_time2']."</b>時　<b>".number_format($value['price2'])."</b>円<br>";
		}

		if ($value['price3']){
			print "<span style='color: #6633FF;'><b>３コマ目：</b></span>";
			print "<b>".$value['begin_time3']."</b>時～<b>".$value['finish_time3']."</b>時　<b>".number_format($value['price3'])."</b>円<br>";
		}
		if ($value['price4']){
			print "<span style='color: #6633FF;'><b>４コマ目：</b></span>";
			print "<b>".$value['begin_time4']."</b>時～<b>".$value['finish_time4']."</b>時　<b>".number_format($value['price4'])."</b>円<br>";
		}
		if ($value['price5']){
			print "<span style='color: #6633FF;'><b>５コマ目：</b></span>";
			print "<b>".$value['begin_time5']."</b>時～<b>".$value['finish_time5']."</b>時　<b>".number_format($value['price5'])."</b>円<br>";
		}
		if ($value['price6']){
			print "<span style='color: #6633FF;'><b>６コマ目：</b></span>";
			print "<b>".$value['begin_time6']."</b>時～<b>".$value['finish_time6']."</b>時　<b>".number_format($value['price6'])."</b>円<br>";
		}
		if ($value['price7']){
			print "<span style='color: #6633FF;'><b>７コマ目：</b></span>";
			print "<b>".number_format($value['begin_time7'])."</b>時～<b>".$value['finish_time7']."</b>時　<b>".$value['price7']."</b>円<br>";
		}

		print "<div style='display:none;'>";
		foreach($value['pack_list'] as $k=>$v){
			print "<span id='".$value['room_id']."pack_name".$k."'>".$v['pack_name']."</span>";
			print "<span id='".$value['room_id']."pack_time".$k."'>".sprintf("%02d", $v['begin_time']).":00～".sprintf("%02d", $v['finish_time']).":00</span>";
			print "<span id='".$value['room_id']."pack_price".$k."'>".$v['price']."</span>";
		}
		print "<span id='".$value['room_id']."pack_num'>".$value['pack_num']."</span>";
		print "</div>";

		print "</div>";
	}
}
?>
</td>

<td width=100 style='border: 1px #000000 solid;text-align: center;' bgcolor=#CDCDCD>選択コマ数</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<span id="koma">0</span> コマ　<span id="lowest_koma"></span>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>ご利用料金</td>
<td height=120 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><b>
旧：　<?php print number_format($reserve_data['room_price']); ?> 円<br>
↓<br>
<span id="select_pack_name" style="color:#FF0000"></span><br>
新：　<span id="price">0</span> 円
</b>
</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;' bgcolor=#CDCDCD>ご利用予定人数</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<input type="text" id="people" name="people" value="<?php print $reserve_data['people']; ?>" style="text-align:right;" onChange='box_clear()'> 人
</td>

<td width=100 style='border: 1px #000000 solid;text-align: center;' bgcolor=#CDCDCD>ご利用目的</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<select name="purpose">
<option value="0">--未選択--</option>
<option value="1" <?php if($reserve_data['purpose']==1) print "selected"; ?>>会議</option>
<option value="2" <?php if($reserve_data['purpose']==2) print "selected"; ?>>セミナー</option>
<option value="3" <?php if($reserve_data['purpose']==3) print "selected"; ?>>研修</option>
<option value="4" <?php if($reserve_data['purpose']==4) print "selected"; ?>>面接・試験</option>
<option value="5" <?php if($reserve_data['purpose']==5) print "selected"; ?>>懇談会・パーティ</option>
<option value="6" <?php if($reserve_data['purpose']==6) print "selected"; ?>>その他</option>
</select>

</td>
</tr>

<tr>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>利用日</td>
<td width=200 style='border: 1px #000000 solid;text-align: center;'><b>
<?php 
	print "旧：　".$reserve_data['reserve_date']."(".$reserve_data['week'].")<br>";
	print "↓<br>";
	print "新：　".$year."年".$month."月".$day."日(".$wweek.")";
?>
</b></td>
<td width=100 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>選択時間帯</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>

<?php 
	print "旧：　".$reserve_data['begin_time']."～".$reserve_data['finish_time']."<br>";

?>
↓<br>
新：　<span id="begin_time_top">00:00</span> ～ <span id="finish_time_top">00:00</b></span>
</td>
</tr>


</table>

<br>


<div style='width:600px;overflow-x:scroll;'>

<?php 
if($col_num == 1){
	print "<table width=600>";
}elseif($col_num == 2){
	print "<table width=1000>";
}else{
	print "<table width=2000>";
}
?>
<tr>
<th style='border: 1px #000000 solid;text-align: center;' width="150">
部屋名<br>
<input type="button" onClick="box_clear()" value="選択解除">
</th>
<?php
foreach($open_time as $time){
	if (preg_match("/^[0-9]+$/", $time)) {
		print "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;' colspan=4><b>".sprintf('%02d', $time).":00<br>～<br>".sprintf('%02d', $time+1).":00</b></th>";
	}
}

?>
</tr>

<?php

$number=0;
foreach($room_data as $key=>$value){

if($value['holiday']){
	$ct = count($open_time);
	print "<tr>";
	print "<td style='border: 1px #000000 solid;text-align: center;' ";
/*
	if($value['room_id']==$room_id){
		print "bgcolor=#FFCC00";
	}
*/
	print ">";
//	print "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']." (".$value['max']."人)</a></td>";
	print $value['room_name']."</td>";
	print "<td colspan=".(4*$ct)." style='border: 1px #000000 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>";
	print "</tr>";
}else{
	print "<tr>";
	if($value['type']==2){
		$code = "<td style='border: 1px #000000 solid;text-align: center;' ";
/*
		if($value['room_id']==$room_id){
			$code.= "bgcolor=#FFCC00";
		}
*/
		$code.= ">";
		//$code.= "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']."</a></td>";
		$code.= $value['room_name']."</td>";

		foreach($value['opentime'] as $k=>$v){
			$code.= "<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=".$value['cs']." ";
			if($v['reserved']){
				$code.="bgcolor=#FFDCDC><span style='color:#FF0000;'><b>×</b></span>";
			}else{

				if($v['checked']){
					$code.="bgcolor=#EEFFCC ";
				}

				$code.= "><input id=box".$number." type='checkbox' value='1' onClick='reserve_form(".$value['type'].", ".$number.", ".$value['room_id'].", \"".$value['room_name']."\", ".$value['discount'].", ".$value['agency'].")' ";

				$code.=">";
				$code.="<div style='display:none;'>";
				$code.="<span id='begin_time".$number."'>".$v['time']."</span>";

				if($value['koma']==0.25){
					$str=split(":", $v['time']);
					$str[1] = intval($str[1])+15;
					if(intval($str[1])>=60){
						$str[0]=intval($str[0])+1;
						$str[1]=0;
					}
					$finish=sprintf("%02d", $str[0]).":".sprintf("%02d", $str[1]);

				}elseif($value['koma']==0.5){
					$str=split(":", $v['time']);
					$str[1] = intval($str[1])+30;
					if(intval($str[1])>=60){
						$str[0]=intval($str[0])+1;
						$str[1]=0;
					}
					$finish=sprintf("%02d", $str[0]).":".sprintf("%02d", $str[1]);
				}else{
					$finish=sprintf("%02d", intval($v['time'])+$value['koma']).":00";
				}

				$code.="<span id='finish_time".$number."'>".$finish."</span>";
				$code.="<span id='lowest_koma".$number."'>".$value['lowest_koma']."</span>";
				$code.="</div>";
				$number++;
			}

			$code.= "</td>";
		}

	}else{
		$code = "<td style='border: 1px #000000 solid;text-align: center;' ";
/*
		if($value['room_id']==$room_id){
			$code.= "bgcolor=#FFCC00";
		}
*/
		$code.= ">";
		//$code.= "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']." (".$value['max']."人)</a></td>";
		$code.= $value['room_name']."</td>";
		$check_x=0;
		foreach($value['komawari'] as $k=>$v){
			$code.= "<td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' colspan=".$v['cs']." ";
			if($v['reserved']){
				$code.="bgcolor=#FFDCDC><span style='color:#FF0000;'><b>×</b></span>";
				$code.="<div style='display:none;'>";
				if($check_x==0){
					$code.="<span id='reserved".$number."'>1</span>";
					$check_x=1;
				}
				$code.="</div>";

			}elseif($v['rest']){
				$code.="bgcolor=#CDCDCD>";
			}else{

				if($v['checked']){
					$code.="bgcolor=#EEFFCC ";
				}

				$code.= "><input id=box".$number." type='checkbox' value='1' onClick='reserve_form(".$value['type'].", ".$number.", ".$value['room_id'].", \"".$value['room_name']."\", ".$value['discount'].", ".$value['agency'].")' ";

				$code.=">";

				$code.="<div style='display:none;'>";
				$code.="<span id='begin_time".$number."'>".$v['begin_time']."</span>";
				$code.="<span id='finish_time".$number."'>".$v['finish_time']."</span>";
				$code.="<span id='i_price".$number."'>".$v['price']."</span>";
				$code.="</div>";
				$number++;
				$check_x=0;
			}

			$code.= "</td>";
		}
	}

	print $code;
	print "</td>";	

	print "</tr>";
}// holiday
}// foreach
?>

</table>
</div>

<div style='display:none;'>
<span id="total_number"><?php print $number-1; ?></span>
<input type='hidden' name='reserve_begin_time' value=''>
<input type='hidden' name='reserve_finish_time' value=''>
<input type='hidden' name='reserve_price' value=''>
<input type='hidden' name='reserve_koma_num' value=''>

</div>

<br>

<INPUT TYPE="submit" VALUE="　変更確認　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;cursor: pointer;">

</form>

</div>
<br>
</body>

