<?php
function db_get_all($sql, $db){
	$rows = array();
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
/**
 * function checkDayHoliday
 * @author RSDN-hieudt
 * @since 2016-06-29
 * @param unknown $data
 * @param unknown $checks
 * @return multitype:
 */
function checkDayHoliday($year, $month, $day,$db)
{
    $sql = "select * from c_holiday where month = $month and day = $day";
    if(db_get_all($sql,$db)){
        return (4);
    }
    else{
        $date = strtolower(date("l", strtotime($year."-".$month."-".$day)));
        if($date == 'saturday'){
            return (2);
        }
        if($date == 'sunday'){
            return (3);
        }
        else{
            return (1);
        }
    }
}
/// 2013.12.21 消費税改定対応 end

require_once("../at_office_config.php");
if(!isset($mysql_db)) $mysql_db="at_office";
//require_once 'HTTP.php';

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

if(!empty($_REQUEST['amp;uid'])) $uid=$_REQUEST['amp;uid'];
else if(!empty($_REQUEST['uid'])) $uid=$_REQUEST['uid'];
//echo "[$uid]<br>";

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
// if(!$_REQUEST['amp;pre_id'] and !$_REQUEST['pre_id']){
if(empty($_REQUEST['amp;pre_id']) and empty($_REQUEST['pre_id'])){
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
		HTTP::redirect("error.php");
	}
}
//print "$pre_id<br>";

// 追加済みの予約があるか
$sql = "select count(*) as add_flag from a_pre_reserve where pre_id = '$pre_id'";
$add_flag = db_get_all($sql, $db);
$add_flag = $add_flag[0]['add_flag'];

// 会場ID



if (preg_match("/^[0-9]+$/", $_REQUEST['hid'])){
	$hall_id = $_REQUEST['hid'];
}else{
	exit(1);
}

if (preg_match("/^[0-9]+$/", $_REQUEST['amp;rid'])){
	$room_id = $_REQUEST['amp;rid'];
}elseif(preg_match("/^[0-9]+$/", $_REQUEST['rid'])){
	$room_id = $_REQUEST['rid'];
}else{
	exit(1);
}

$date_flag = 0;
if (isset($_REQUEST['amp;year']) && preg_match("/^[0-9]+$/", $_REQUEST['amp;year'])){
	$year = $_REQUEST['amp;year'];
}elseif(isset($_REQUEST['year']) && preg_match("/^[0-9]+$/", $_REQUEST['year'])){
	$year = $_REQUEST['year'];
}else{
	$year = date("Y");
	$date_flag = 1;
}
if ( isset($_REQUEST['amp;month']) && preg_match("/^[0-9]+$/", $_REQUEST['amp;month'])){
	$month = $_REQUEST['amp;month'];
}elseif(isset($_REQUEST['month']) && preg_match("/^[0-9]+$/", $_REQUEST['month'])){
	$month = $_REQUEST['month'];
}else{
	$month = date("m");
	$date_flag = 1;
}
if (isset($_REQUEST['amp;day']) && preg_match("/^[0-9]+$/", $_REQUEST['amp;day'])){
	$day = $_REQUEST['amp;day'];
}elseif(isset($_REQUEST['day']) && preg_match("/^[0-9]+$/", $_REQUEST['day'])){
	$day = $_REQUEST['day'];
}else{
	$day = date("d");
	$date_flag = 1;
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

if(isset($_REQUEST['amp;u']) && preg_match("/^[0-9]+$/", $_REQUEST['amp;u'])){
	$c_member_id = $_REQUEST['amp;u'];
}elseif(isset($_REQUEST['u']) && preg_match("/^[0-9]+$/", $_REQUEST['u'])){
	$c_member_id = $_REQUEST['u'];
}else{
	$c_member_id = 0;
}

// 予約最短日に修正(1日後)

if($date_flag){
	for($x=1;$x<=1;$x++){
		$day++;
		if(!checkdate($month, $day, $year)){
			$month++;
			$day=1;
			if(!checkdate($month, $day, $year)){
				$year++;
				$month=1;
			}
		}
	}
}


// 会場取得

$sql = "select * from a_hall where hall_id = $hall_id";
$hall_data = db_get_all($sql, $db);
$hall_data = $hall_data[0];


// 日付確認　//////////////////////////////////////////////
// yearadj設定時、月が戻ってたら年を送る。
//	$year=date("Y");
    if(isset($_REQUEST['amp;yearadj']) && $month<date("m"))
    {
      $year=date("Y");  
      $year++;
    }
    else if(isset($_REQUEST['amp;yearadj']) && $month>=date("m"))
    {
        $year=date("Y"); 
    } 
// 存在する日付か
    $date_error = isset($date_error) ? $date_error : 0;
if(!checkdate($month, $day, $year)){
	$date_error = 1;
}

$limit_year = date("Y");
$limit_month = date("m");
$today = date("d");

// 予約期間範囲内か
for($x=1;$x<=$hall_data['reservation_month'];$x++){
	$limit_month++;
	if(!checkdate($limit_month, 1, $limit_year)){
		$limit_year++;
		$limit_month = 1;
	}
	//print "$limit_month<br>";
}

$wweek = get_week($year.sprintf("%02d", $month).sprintf("%02d", $day));

$check_date1 = intval($year.sprintf("%02d", $month).sprintf("%02d", $day));
$check_date2 = intval($year.sprintf("%02d", $month).sprintf("%02d", $day));
$uper_date = intval($limit_year.sprintf("%02d", $limit_month).sprintf("%02d", $today));

$under_year = date("Y");
$under_month = date("m");
$under_day = date("d");

/*
for($x=1;$x<=3;$x++){
	$under_day++;
	if(!checkdate($under_month, $under_day, $under_year)){
		$under_month++;
		$under_day=1;
		if(!checkdate($under_month, $under_day, $under_year)){
			$under_year++;
			$under_month=1;
		}
	}
}
*/

$under_date = intval($under_year.sprintf("%02d", $under_month).sprintf("%02d", $under_day));

//print "$under_date > $check_date2 or $uper_date < $check_date1<br>";
if($under_date > $check_date2 or $uper_date < $check_date1)
{
	//print "date error";
	$date_error = 1;
}
elseif($date_error != 1)
{
	$date_error = 0;
}
if($date_error==0){
    $sql = "select * from a_reserve_valid";
    $reserve_valid_data = db_get_all($sql, $db);
    $hour=$reserve_valid_data[0]['hour'];
    $minute=$reserve_valid_data[0]['minute'];
    
    $yearBook= $year;
    $monthBook= $month;
    $dayBook= $day;
    if($monthBook<10)
    {
        $monthBook='0'.intval($monthBook);
    }
    $date_book=$yearBook.'-'.$monthBook.'-'.$dayBook;
    $date_book=strtotime($date_book);
    $current_date=date('Y-m-d');
    $current_date=strtotime($current_date);
    
    
    $current_time = date('Y-m-d H:i:s');
    $limit_order  = date('Y-m-d')." ".$hour.":".$minute.":00";
    $current_time= strtotime($current_time);
    $limit_order=strtotime($limit_order);
    $nextdate = strtotime('+1 day', strtotime(date('Y-m-d')));
    if( (($date_book == $nextdate) && (($limit_order > $current_time) )) || ($date_book >$nextdate)){
    	$date_error = 0;
    }
    
    else{
    	$date_error = 1;
    }
}


//print $date_error;

// 代理店値引きフラグ初期値
$agency_flag = 0;


///////////////////////////////////////////////////////////
//START haipt add 2016-07-26
$checkTime = checkDayHoliday($year, $month, $day,$db);
$usedate = explode(',',$hall_data['usedate']);
if($checkTime == 1){
	if($hall_data['begin1'] != '' && $hall_data['finish1'] != '')
	{
		$hall_data['begin'] = $hall_data['begin1'];
		$hall_data['finish'] = $hall_data['finish1'];
	}
}else if($checkTime == 2)
{
	if($hall_data['begin2'] != '' && $hall_data['finish2'] != '')
	{
		$hall_data['begin'] = $hall_data['begin2'];
		$hall_data['finish'] = $hall_data['finish2'];
	}
}else if($checkTime == 3)
{
	if($hall_data['begin3'] != '' && $hall_data['finish3'] != '')
	{
		$hall_data['begin'] = $hall_data['begin3'];
		$hall_data['finish'] = $hall_data['finish3'];
	}
}else if($checkTime == 4)
{
	if($hall_data['begin4'] != '' && $hall_data['finish4'] != '')
	{
		$hall_data['begin'] = $hall_data['begin4'];
		$hall_data['finish'] = $hall_data['finish4'];
	}
}
		
//END haipt add 2016-07-26

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

$room_data = $room_data;

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
		// 前後の枠を決める時間なので、例えば15分枠で変更したい場合などは
		// この時間を変更してやれば対応できる。
		if($koma>1){
			$hosei = $koma*$v['lowest_koma'];
		}else{
			$hosei = $v['lowest_koma'];
		}
		$min = array();
		$key=0;
		if($koma==0.5){
			$room_data[$k]['cs'] = 2;
			// $key=0;
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
//		echo $sql;
//		var_dump($today_reserve_flag);

			// 重なる貸し止め
			$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and (limit_datetime > now() or flag=1)";
			$today_stop_flag = db_get_all($sql, $db);

			// 選択済み予約
			$sql = "select * from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and limit_datetime > now()";
			$today_checked_flag = db_get_all($sql, $db);
//		echo $sql;
//		var_dump($today_checked_flag);

//		foreach($room_data[$k]['opentime'] as $key=>$val){
//			$datetime = $year."-".$month."-".$day." ".$val['time'].":00";



//			echo $key." ".$val['time']."<br>";
//		}
//		echo "---<br>";

		foreach($room_data[$k]['opentime'] as $key=>$val){
			$room_data[$k]['opentime'][$key]['reserved'] = 0;

			$datetime = $year."-".$month."-".$day." ".$val['time'].":00";
			$strdt=strtotime($datetime);
/*
			// 重なる予約
			$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime)";
			$reserve_flag = db_get_all($sql, $db);
			// 重なる貸し止め
			$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and (limit_datetime > now() or flag=1)";
			$stop_flag = db_get_all($sql, $db);

			// 選択済み予約
			$sql = "select * from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and limit_datetime > now()";
			$checked_flag = db_get_all($sql, $db);
*/
			$f=0;
			//START haipt add 2016/07/29
			if(in_array($checkTime,$usedate)){
				if($checkTime == 1 && $hall_data['finish_often1'] != '' && $hall_data['begin_often1'] != '' &&  (strtotime($datetime)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often1'].":00")  ||(strtotime($datetime)>=strtotime($year."-".$month."-".$day." ".$hall_data['finish_often1'].":00")&& strtotime($year."-".$month."-".$day." ".$hall_data['finish_often1'].":00") )))
				{
						$room_data[$k]['opentime'][$key]['reserved'] = 1;
				}
				else if($checkTime == 2 && $hall_data['finish_often2'] != '' && $hall_data['begin_often2'] != '' &&  (strtotime($datetime)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often2'].":00") ||(strtotime($datetime)>=strtotime($year."-".$month."-".$day." ".$hall_data['finish_often2'].":00") && strtotime($year."-".$month."-".$day." ".$hall_data['finish_often2'].":00") )))
				{
						$room_data[$k]['opentime'][$key]['reserved'] = 1;
				}
				else if($checkTime == 3 && $hall_data['finish_often3'] != '' && $hall_data['begin_often3'] != '' &&  (strtotime($datetime)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often3'].":00") ||(strtotime($datetime)>=strtotime($year."-".$month."-".$day." ".$hall_data['finish_often3'].":00") && strtotime($year."-".$month."-".$day." ".$hall_data['finish_often3'].":00") )))
				{
						$room_data[$k]['opentime'][$key]['reserved'] = 1;
				}
				else if($checkTime == 4 && $hall_data['finish_often4'] != '' && $hall_data['begin_often4'] != '' &&  (strtotime($datetime)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often4'].":00") ||(strtotime($datetime)>= strtotime($year."-".$month."-".$day." ".$hall_data['finish_often4'].":00") && strtotime($year."-".$month."-".$day." ".$hall_data['finish_often4'].":00") )))
				{
						$room_data[$k]['opentime'][$key]['reserved'] = 1;
				}
			}
			else{
					$room_data[$k]['opentime'][$key]['reserved'] = 1;
			}			
			//END haipt add 2016/07/29
			if(isset($today_reserve_flag)) foreach($today_reserve_flag as $kk=>$vv){
				if(strtotime($vv['begin_datetime'])<=$strdt+$komatime && strtotime($vv['finish_datetime'])>$strdt-$komatime){ $f=1; break; }
			}
			if($f){
				$room_data[$k]['opentime'][$key]['reserved'] = $f;
			}else{ // 予約がない
				$f=0;
				if(isset($today_stop_flag)) foreach($today_stop_flag as $kk=>$vv){
					if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $f=1; break; } // 貸し止めではkomatimeは適用しない。
				}
				if($f){
					$room_data[$k]['opentime'][$key]['reserved'] = 1;
				}else{	// 貸し止めがない
					if(isset($today_checked_flag)) foreach($today_checked_flag as $kk=>$vv){
//						echo $vv['begin_datetime']." ".$datetime." (".($vv['begin_datetime']<='$datetime').")<br>";
						if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $f=1; break; }
					}
					if($f){
						$room_data[$k]['opentime'][$key]['checked'] = 1;
					}
				}
			}
/*
			if($reserve_flag[0]['reserve']){
				$room_data[$k]['opentime'][$key]['reserved'] = $reserve_flag[0]['reserve'];
			}elseif($stop_flag[0]['stop_id']){
				$room_data[$k]['opentime'][$key]['reserved'] = 1;
			}
			if($checked_flag[0]['pid']){
				$room_data[$k]['opentime'][$key]['checked'] = 1;
			}
*/
			//print $sql."<br>".$reserve_flag[0]['reserve']."<br>";
		}

		// 代理店割引確認
		$sql = "select * from a_agency where c_member_id = $c_member_id";
		$agency = db_get_all($sql, $db);
		$agency = isset($agency[0]) ? $agency[0] : null;
		$room_data[$k]['agency'] = 0;

		if(!empty($agency)){
			if($agency['type'] == 1){
				$hallListId = !empty($agency['hall_list']) ? json_decode($agency['hall_list'],true) : null;
				if(!empty($hallListId[$hall_id])){
					$room_data[$k]['agency'] = $hallListId[$hall_id];
					$agency_flag = 1;
				}				
			}elseif($agency['percent']){
				$room_data[$k]['agency'] = $agency['percent'];	
				$agency_flag = 1;
			}
		}

		// 割引期間
//	$room_data[$k]['agency'] = 0;
		$room_data[$k]['discount'] = 0;
		$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = ".$v['room_id']." and flag = 1";
//		print $sql."<br>";
		$result = db_get_all($sql, $db);
		if (!empty($result)){
			if($result[0]['pattern_id'] <= 3){
				$d_begin_time = $result[0]['begin_year'].sprintf('%02d', $result[0]['begin_month']).sprintf('%02d', $result[0]['begin_day']);
				$d_finish_time = $result[0]['finish_year'].sprintf('%02d', $result[0]['finish_month']).sprintf('%02d', $result[0]['finish_day']);

				$reserve_date = $year.sprintf('%02d', $month).sprintf('%02d', $day);
//				 print $d_begin_time."<br>".$reserve_date."<br>".$d_finish_time;

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
	//echo $k." ".$room_data[$k]['discount']."<br>";
	//}// agency


	// パック料金(神田タイプ)
		$sql = "select * from a_room_pack where hall_id = $hall_id and room_id = ".$v['room_id']." and pack_flag = 1";
		$pack_list = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

		tmp_pack_price_convert($pack_list, $tmp_tax);

/// 2013.12.21 消費税改定対応 end

		$room_data[$k]['pack_list'] = $pack_list;
		$room_data[$k]['pack_num'] = count($pack_list);


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
			$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = ".$v['room_id']." and cancel_flag=0 and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime)";
			$reserve_flag = db_get_all($sql, $db);
		// 重なる貸し止め
			$sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and (limit_datetime > now() or flag=1)";
			$stop_flag = db_get_all($sql, $db);

		// 選択済み予約
			$sql = "select * from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id = ".$v['room_id']." and (begin_datetime <= '$datetime' and '$datetime' < finish_datetime) and limit_datetime > now()";
			$checked_flag = db_get_all($sql, $db);
*/

		//print $sql."<br>";
		// 23コマ
			for($x=1;$x<=23;$x++){
//				echo $x."<br>";
//print "x=$x ".$open_v." == ".$v['begin_time'.$x]."<br>";

				if(!is_null($v['begin_time'.$x]) and $open_v == $v['begin_time'.$x]){



					$room_data[$k]['komawari'][$open_k]['cs']=($v['finish_time'.$x]-$v['begin_time'.$x])*4;
					$room_data[$k]['komawari'][$open_k]['begin_time'] = sprintf("%02d", $v['begin_time'.$x]).":00";
					$room_data[$k]['komawari'][$open_k]['finish_time'] = sprintf("%02d", $v['finish_time'.$x]).":00";
					$room_data[$k]['komawari'][$open_k]['price'] = $v['price'.$x];
					$room_data[$k]['komawari'][$open_k]['rest']=0;

			$f=0;
			//START haipt add 2016/07/29
			if(in_array($checkTime,$usedate)){
				$begin_time = $year."-".$month."-".$day." ".$room_data[$k]['komawari'][$open_k]['begin_time'].":00";
				$finish_time = $year."-".$month."-".$day." ".$room_data[$k]['komawari'][$open_k]['finish_time'].":00";
				if($checkTime == 1 && $hall_data['begin_often1'] !='' && $hall_data['finish_often1'] !='' && (strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often1'].":00:00") || strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['finish_often1'].":00:00") && strtotime($finish_time)>strtotime($year."-".$month."-".$day." ".$hall_data['finish_often1'].":00:00")))
				{
						$room_data[$k]['komawari'][$open_k]['reserved'] = 1;break;
				}else if($checkTime == 2 && $hall_data['begin_often2'] !='' && $hall_data['finish_often2'] !='' && (strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often2'].":00:00") || strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['finish_often2'].":00:00") && strtotime($finish_time)>strtotime($year."-".$month."-".$day." ".$hall_data['finish_often2'].":00:00")))
				{
					$room_data[$k]['komawari'][$open_k]['reserved'] = 1;break;
				}else if($checkTime == 3 && $hall_data['begin_often3'] !='' && $hall_data['finish_often3'] !='' && (strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often3'].":00:00") || strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['finish_often3'].":00:00") && strtotime($finish_time)>strtotime($year."-".$month."-".$day." ".$hall_data['finish_often3'].":00:00")))
				{
					$room_data[$k]['komawari'][$open_k]['reserved'] = 1;break;
				}else if($checkTime == 4 && $hall_data['begin_often4'] !='' && $hall_data['finish_often4'] !='' && (strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['begin_often4'].":00:00") || strtotime($begin_time)<strtotime($year."-".$month."-".$day." ".$hall_data['finish_often4'].":00:00") && strtotime($finish_time)>strtotime($year."-".$month."-".$day." ".$hall_data['finish_often4'].":00:00")))
				{
					$room_data[$k]['komawari'][$open_k]['reserved'] = 1;break;
				}
			}
			else{
				$room_data[$k]['komawari'][$open_k]['reserved'] = 1;break;
			}
			//END haipt add 2016/-7/29	
			// ここではkomatimeは0のはずなのでそのままにしておく
			if(isset($today_reserve_flag)) foreach($today_reserve_flag as $kk=>$vv){
				if(strtotime($vv['begin_datetime'])<=$strdt+$komatime && strtotime($vv['finish_datetime'])>$strdt-$komatime){ $f=1; break; }
			}
			if($f){
				$room_data[$k]['komawari'][$open_k]['reserved'] = $f;
			}else{ // 予約がない
				$f=0;
				if(isset($today_stop_flag)) foreach($today_stop_flag as $kk=>$vv){
//var_dump($vv);
					if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $f=1; break; } // 貸し止めではkomatimeは適用しない。
				}
				if($f){
					$room_data[$k]['komawari'][$open_k]['reserved'] = 1;
				}else{	// 貸し止めがない
					if(isset($today_checked_flag)) foreach($today_checked_flag as $kk=>$vv){
//						echo $vv['begin_datetime']." ".$datetime." (".($vv['begin_datetime']<='$datetime').")<br>";
						if(strtotime($vv['begin_datetime'])<=$strdt && strtotime($vv['finish_datetime'])>$strdt){ $f=1; break; }
					}
					if($f){
						$room_data[$k]['komawari'][$open_k]['checked'] = 1;
					}
				}
			}
/*
					if($reserve_flag[0]['reserve']){
						$room_data[$k]['komawari'][$open_k]['reserved']=$reserve_flag[0]['reserve'];
					}elseif($stop_flag[0]['stop_id']){
						$room_data[$k]['komawari'][$open_k]['reserved'] = 1;
					}
					if($checked_flag[0]['pid']){
						$room_data[$k]['komawari'][$open_k]['checked'] = 1;
					}
*/

					break;
				}else{
/*
					$sql="select count(*) as flag from a_room where hall_id=$hall_id and room_id=".$v['room_id']." and ((begin_time1 < $open_v and $open_v < finish_time1) or (begin_time2 < $open_v and $open_v < finish_time2) or (begin_time3 < $open_v and $open_v < finish_time3) or (begin_time4 < $open_v and $open_v < finish_time4) or (begin_time5 < $open_v and $open_v < finish_time5) or (begin_time6 < $open_v and $open_v < finish_time6) or (begin_time7 < $open_v and $open_v < finish_time7) or (begin_time8 < $open_v and $open_v < finish_time8) or (begin_time9 < $open_v and $open_v < finish_time9) or (begin_time10 < $open_v and $open_v < finish_time10) or (begin_time11 < $open_v and $open_v < finish_time11) or (begin_time12 < $open_v and $open_v < finish_time12) or (begin_time13 < $open_v and $open_v < finish_time13) or (begin_time14 < $open_v and $open_v < finish_time14) or (begin_time15 < $open_v and $open_v < finish_time15) or (begin_time16 < $open_v and $open_v < finish_time16) or (begin_time17 < $open_v and $open_v < finish_time17) or (begin_time18 < $open_v and $open_v < finish_time18) or (begin_time19 < $open_v and $open_v < finish_time19) or (begin_time20 < $open_v and $open_v < finish_time20) or (begin_time21 < $open_v and $open_v < finish_time21) or (begin_time22 < $open_v and $open_v < finish_time22) or (begin_time23 < $open_v and $open_v < finish_time23))";

				//print $sql."<br>";
					$check = db_get_all($sql, $db);
					if(!$check[0]['flag']){
*/
					$f=0;
					for($i=1;$i<=23;$i++){
						if($roomstatus[0]['begin_time'.$i]<$open_v &&
								$open_v<$roomstatus[0]['finish_time'.$i]){
									$f=1;
									break;
								}
					}
					if(!$f){
						$room_data[$k]['komawari'][$open_k]['cs']=4;
						$room_data[$k]['komawari'][$open_k]['rest']=1;
					}
/*
						$room_data[$k]['komawari'][$open_k]['cs']=4;
						$room_data[$k]['komawari'][$open_k]['rest']=1;
					}
*/
				}// if

			}// for
		}

	// 代理店割引確認
		$sql = "select * from a_agency where c_member_id = $c_member_id";
		$agency = db_get_all($sql, $db);
		$agency = isset($agency[0]) ? $agency[0] : null;
		$room_data[$k]['agency'] = 0;

		// source Old
		// if($agency['percent']){
		// 	$room_data[$k]['agency'] = $agency['percent'];
  // 			$agency_flag = 1;
		// }
		// new source handle for 会場指定あり
		if(!empty($agency)){
			if($agency['type'] == 1){
				$hallListId = !empty($agency['hall_list']) ? json_decode($agency['hall_list'],true) : null;
				if(!empty($hallListId[$hall_id])){
					$room_data[$k]['agency'] = $hallListId[$hall_id];
					$agency_flag = 1;
				}				
			}elseif($agency['percent']){
				$room_data[$k]['agency'] = $agency['percent'];	
				$agency_flag = 1;
			}
		}

	// 割引期間
//	$room_data[$k]['agency'] = 0;
		$room_data[$k]['discount'] = 0;
		$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = ".$v['room_id']." and flag = 1";
	//print $sql."<br>";
		$result = db_get_all($sql, $db);
		if (!empty($result)){
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
	//echo $k." ".$room_data[$k]['discount']."<br>";

	//}// agency

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
	$room_data[$k]['max'] = max($v['num_school'], $v['num_mouth'], $v['num_theater']);

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
	$hall_rh = isset($hall_rh[0]) ? $hall_rh[0] : null;

	$sql = "select * from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
	$room_rh = db_get_all($sql, $db);
	$room_rh = isset($room_rh[0]) ? $room_rh[0] : null;

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


// 有効な会場リスト(pulldown数値大きい順)
$sql = "select * from a_hall where flag=0 order by pulldown desc";
$hall_list = db_get_all($sql, $db);

?>

<head>
<script type="text/javascript" src="./atoffice/js/prototype.js"></script>
<script type="text/javascript" src="./atoffice/js/smartRollover.js"></script>
<script type="text/javascript" src="./atoffice/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="./atoffice/js/highslide.js"></script>

<link href="./atoffice/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<a name="top"></a>

<center><div id="left" style='width:660px;'>
<H2 style="background:url(./atoffice/img/customerdata.png) no-repeat;">
</H2>
<br />
<img src="./atoffice/img/Step2.jpg" width="660" height="143">
<br><br>
<hr>
<br>
<img src="./atoffice/img/step2.png" width="660" height="31"><br>
<br>
<h3>
<form name="day_change" method="POST" action="./">
<table width="660" height="90" bgcolor="#FAFAFA" style="border: 1px solid #CDCDCD; border-collapse: collapse; empty-cells: show;">
<tr height="45">
    <td style="padding:8px 8px 16px 16px;">
	<b>会場名：　</b>
		<?php

		if($add_flag){
		 	print "<select name='hid_1' disabled>";
            
		}else{
			print "<select name='hid' style='font-weight:bold;'>";
		}

		foreach($hall_list as $key=>$value){
			if($value['hall_id'] == $hall_id){
				print "<option value='".$value['hall_id']."' selected>".$value['hall_name']."</option>";
			}else{
				print "<option value='".$value['hall_id']."' >".$value['hall_name']."</option>";
			}
		}
		?>
	</select>
        
	<input type="hidden" name="year" id="year" value="<?php print $year; ?>">
	<input type="hidden" name="month" id="month" value="<?php print $month; ?>">
	<input type="hidden" name="day" id="day" value="<?php print $day; ?>">
	<input type="hidden" name="uid" value="<?php print $uid; ?>">
	<input type="hidden" name="page" value="reserve">
	<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
	<?php
	if($add_flag){?>
	   <input type="hidden" name="hid"  value="<?php print $hall_id; ?>">	   
	<?php    	   
		print "<a style='font-size: 12px; font-color=#FF0000;'>予約作業中は会場の移動はできません。</a>";
	}else{
	//	print "<input type='submit' value='　会場変更　'>";
	}
	?>
</td>
 </tr>
 <tr height="45">
 <td style="padding:8px 8px 16px 16px;">


<input type="hidden" name="year1" value="<?php print $year; ?>">
<input type="hidden" name="uid1" value="<?php print $uid; ?>">
<input type="hidden" name="page1" value="reserve">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="hid1" value="<?php echo $hall_id; ?>">
<input type="hidden" name="yearadj" value="1">
<TABLE border="0">
  <TBODY>
    <TR>
      <TD>
      <FONT size="-1" color="#2c4327">ご予約希望日</FONT></TD>
      <TD>
      <SELECT name="month" id="select_month">
	<?php
	for($i=1;$i<=12;$i++){
		echo "<option value=$i";
		if($i==$month) echo " selected";
		echo ">".
		(($i>=$under_month)?$under_year:($under_year+1)).
		"年".$i."月</option>";
	}	
	?>
      </SELECT>
      </TD>
      <TD>
      <SELECT name="day" id='select_day'>
	<?php
	for($i=1;$i<=31;$i++){
		echo "<option value='$i'";
		if($i==$day) echo " selected";
		echo ">".$i."日</option>";
	}	
	?>
      </SELECT>
      </TD>
	<td style="width: 16px;"></td>
      <TD>
	<a href="#" onClick="toggleCalendar()"><img src="./atoffice/img/calicon.png"></a>
      </TD>
    	<td width="16">
            <input style="margin-left:15px" type="submit" value="変更">
        </td>
      <td>
     
      </td>
    </TR>
  </TBODY>
</TABLE>
</td>
</tr>
</table>
</form>
</h3>
<br />
<?php
	if($hall_data['web_reserve']!=1){
?>
<span style="font-size:20px"><b>
この会場のご予約は、電話のみで承っております。<br>
ご希望の日時をご連絡下さい。<br>
03-5465-5506（月～土：9：00～18：00）<br>
</b></span>
<?php
}
?>


<br />
<TABLE border="0" width="660">
  <TBODY>
    <TR>
      <TD><h4>
	<?php echo $year."年".($month+0)."月".($day+0)."日($wweek)"; ?>
	</h4></TD>
      <TD></TD>
      <TD width="80" align="center">
<?php
	$now=strtotime("$year/$month/$day 00:00:00");
	$nowy = date("Y");
	$nowm = date("m");
	$nowd = date("d");

	$tmpy = date("Y",$now-86400);
	$tmpm = date("m",$now-86400);
	$tmpd = date("d",$now-86400);
	if($tmpy>$nowy || $tmpm>$nowm || $tmpd>$nowd){
		echo "<a id='date' href='?page=reserve&hid=$hall_id&uid=$uid&pre_id=$pre_id&year=$tmpy&month=$tmpm&day=$tmpd'>";
		echo '<FONT size="-1">&lt;&lt;&lt;前日</FONT></a>';
	}
?>
</TD>
      <TD width="80" align="center">
<?php
	$nowm+=$hall_data['reservation_month'];
	if($nowm>12){ $nowy++; $nowm-=12; }
	$rem=$nowm;
	for($nowx=strtotime("$nowy/$nowm/$nowd");;$nowx-=86400){
		$nowy = date("Y",$nowx);
		$nowm = date("m",$nowx);
		$nowd = date("d",$nowx);
		if($nowm==$rem) break;
	}

//$xx=strtotime("2013/11/31");
//echo date("Y",$xx)."/".date("m",$xx)."/".date("d",$xx)."<br>";
	$tmpy = date("Y",$now+86400);
	$tmpm = date("m",$now+86400);
	$tmpd = date("d",$now+86400);
	$uid = isset($uid) ? $uid : '';
	if($tmpy<$nowy || $tmpm<$nowm || $tmpd<=$nowd){
		echo "<a id='date' href='?page=reserve&hid=$hall_id&uid=$uid&pre_id=$pre_id&year=$tmpy&month=$tmpm&day=$tmpd'>";
		echo '<FONT size="-1">翌日&gt;&gt;&gt;</FONT></a>';
	}
?>
</TD>
    </TR>
  </TBODY>
</TABLE>

<form name="reserve" id="reserve" method="POST" action="./" onSubmit="return reserve_check()">
<input type='hidden' name='reserve_begin_time' value=''>
<input type='hidden' name='reserve_finish_time' value=''>
<input type='hidden' name='reserve_price' value=''>
<input type='hidden' name='reserve_koma_num' value=''>
<input type="hidden" name="year" value="<?php print $year; ?>">
<input type="hidden" name="month" value="<?php print $month; ?>">
<input type="hidden" name="day" value="<?php print $day; ?>">
<input type="hidden" name="uid" value="<?php print $uid; ?>">
<input type="hidden" name="page" value="do_pre_reserve_set">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="rid" id="rid" value="">
<input type="hidden" name="hid" id="hid" value="<?php print $hall_id; ?>">
<input type="hidden" name="agency_flag" value="<?php print $agency_flag; ?>">

<div style='width:600px;overflow-x:auto;'>

<?php 

if($date_error==0){

if($hall_data['web_reserve']==1){
?>
<br>
<b><image src="./atoffice/img/checkbox.gif"> 空き　
<image src="./atoffice/img/manshitsu.gif"> 満室　
<image src="./atoffice/img/yoyaku.gif"> 追加済み　
<br>
<?php
}

if($col_num == 1){
	print "<table width=600  style='border: 2px #646464 solid;text-align: center;'>";
}elseif($col_num == 2){
	print "<table width=1000  style='border: 2px #646464 solid;text-align: center;'>";
}else{
	print "<table width=2000  style='border: 2px #646464 solid;text-align: center;'>";
}
?>

<tr>
<th style='border: 1px #646464 solid;text-align: center;'>
部屋名
<?php
if($hall_data['web_reserve']==1){
?>
<br>
<input type="button" onClick="box_clear()" value="選択解除">
<?php
}
?>
</th>
<?php
foreach($open_time as $time){
	if (preg_match("/^[0-9]+$/", $time)) {
		print "<th nowrap bgcolor=#CDCDCD style='border: 1px #646464 solid;text-align: center;' colspan=4><b>".sprintf('%02d', $time).":00</b></th>";
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
	print "<td style='border: 1px #646464 solid;text-align: center;' ";
/*
	if($value['room_id']==$room_id){
		print "bgcolor=#FFCC00";
	}
*/
	print ">";
	//print "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']."</a></td>";
	print $value['room_name']."<br>(".$value['max']."人)</td>";
	print "<td colspan=".(4*$ct)." style='border: 1px #646464 solid;text-align: center;' bgcolor=#FF6666><b>休室日</b></td>";
	print "</tr>";
}else{
	print "<tr>";

	if($value['type']==2){
		$code = "<td style='border: 1px #646464 solid;text-align: center;' ";
/*
		if($value['room_id']==$room_id){
			$code.= "bgcolor=#FFCC00";
		}
*/
		$code.= ">";
		//$code.= "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']." (".$value['max']."人)</a></td>";
		$code.= $value['room_name']."<br>(".$value['max']."人)</td>";

		foreach($value['opentime'] as $k=>$v){
			$code.= "<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;' colspan=".$value['cs']." ";
			if($v['reserved']){
				$code.="bgcolor=#FFDCDC><span style='color:#FF0000;'><b>×</b></span>";
			}elseif(isset($v['checked']) && $v['checked']){
				$code.="bgcolor=#FFFF66>";
				$code.= "<image src='atoffice/img/yoyaku.gif'>";
			}else{
				$code.= ">";

if($hall_data['web_reserve']==1){
				$code.= "<input id=box".$number." type='checkbox' value='1' onClick='reserve_form(".$value['type'].", ".$number.", ".$value['room_id'].", \"".$value['room_name']."\", ".$value['discount'].", ".$value['agency'].")'>";
}else{
	$code.= "<span style='color:#0000FF;font-size:16px'><b>○</b></span>";
}

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
		$code = "<td style='border: 1px #646464 solid;text-align: center;' ";
/*
		if($value['room_id']==$room_id){
			$code.= "bgcolor=#FFCC00";
		}
*/
		$code.= ">";
		//$code.= "<a href='javascript:change_room(".$value['room_id'].");'>".$value['room_name']." (".$value['max']."人)</a></td>";
		$code.= $value['room_name']."<br>(".$value['max']."人)</td>";
		$check_x=0;
		foreach($value['komawari'] as $k=>$v){
			$code.= "<td style='border: 1px #646464 solid;text-align: center;vertical-align:middle;' colspan=".$v['cs']." ";
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
			}elseif($v['checked']){
				$code.="bgcolor=#FFFF66>";
				$code.= "<image src='atoffice/img/yoyaku.gif'>";

			}else{
				$code.= ">";
if($hall_data['web_reserve']==1){
				$code.= "<input id=box".$number." type='checkbox' value='1' onClick='reserve_form(".$value['type'].", ".$number.", ".$value['room_id'].", \"".$value['room_name']."\", ".$value['discount'].", ".$value['agency'].")'>";
}else{
	$code.= "<span style='color:#0000FF;font-size:16px'><b>○</b></span>";
}

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

}//foreach

?>
</table>
<?php

foreach($room_data as $key=>$value){

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
			print "<b>".$value['begin_time7']."</b>時～<b>".$value['finish_time7']."</b>時　<b>".number_format($value['price7'])."</b>円<br>";
		}
		if ($value['price8']){
			print "<span style='color: #6633FF;'><b>８コマ目：</b></span>";
			print "<b>".$value['begin_time8']."</b>時～<b>".$value['finish_time8']."</b>時　<b>".number_format($value['price8'])."</b>円<br>";
		}
		if ($value['price9']){
			print "<span style='color: #6633FF;'><b>９コマ目：</b></span>";
			print "<b>".$value['begin_time9']."</b>時～<b>".$value['finish_time9']."</b>時　<b>".number_format($value['price9'])."</b>円<br>";
		}
		if ($value['price10']){
			print "<span style='color: #6633FF;'><b>１０コマ目：</b></span>";
			print "<b>".$value['begin_time10']."</b>時～<b>".$value['finish_time10']."</b>時　<b>".number_format($value['price10'])."</b>円<br>";
		}
		if ($value['price11']){
			print "<span style='color: #6633FF;'><b>１１コマ目：</b></span>";
			print "<b>".$value['begin_time11']."</b>時～<b>".$value['finish_time11']."</b>時　<b>".number_format($value['price11'])."</b>円<br>";
		}
		if ($value['price12']){
			print "<span style='color: #6633FF;'><b>１２コマ目：</b></span>";
			print "<b>".$value['begin_time12']."</b>時～<b>".$value['finish_time12']."</b>時　<b>".number_format($value['price12'])."</b>円<br>";
		}
		if ($value['price13']){
			print "<span style='color: #6633FF;'><b>１３コマ目：</b></span>";
			print "<b>".$value['begin_time13']."</b>時～<b>".$value['finish_time13']."</b>時　<b>".number_format($value['price13'])."</b>円<br>";
		}
		if ($value['price14']){
			print "<span style='color: #6633FF;'><b>１４コマ目：</b></span>";
			print "<b>".$value['begin_time14']."</b>時～<b>".$value['finish_time14']."</b>時　<b>".number_format($value['price14'])."</b>円<br>";
		}
		if ($value['price15']){
			print "<span style='color: #6633FF;'><b>１５コマ目：</b></span>";
			print "<b>".$value['begin_time15']."</b>時～<b>".$value['finish_time15']."</b>時　<b>".number_format($value['price15'])."</b>円<br>";
		}
		if ($value['price16']){
			print "<span style='color: #6633FF;'><b>１６コマ目：</b></span>";
			print "<b>".$value['begin_time16']."</b>時～<b>".$value['finish_time16']."</b>時　<b>".number_format($value['price16'])."</b>円<br>";
		}
		if ($value['price17']){
			print "<span style='color: #6633FF;'><b>１７コマ目：</b></span>";
			print "<b>".$value['begin_time17']."</b>時～<b>".$value['finish_time17']."</b>時　<b>".number_format($value['price17'])."</b>円<br>";
		}
		if ($value['price18']){
			print "<span style='color: #6633FF;'><b>１８コマ目：</b></span>";
			print "<b>".$value['begin_time18']."</b>時～<b>".$value['finish_time18']."</b>時　<b>".number_format($value['price18'])."</b>円<br>";
		}
		if ($value['price19']){
			print "<span style='color: #6633FF;'><b>１９コマ目：</b></span>";
			print "<b>".$value['begin_time19']."</b>時～<b>".$value['finish_time19']."</b>時　<b>".number_format($value['price19'])."</b>円<br>";
		}
		if ($value['price20']){
			print "<span style='color: #6633FF;'><b>２０コマ目：</b></span>";
			print "<b>".$value['begin_time20']."</b>時～<b>".$value['finish_time20']."</b>時　<b>".number_format($value['price20'])."</b>円<br>";
		}
		if ($value['price21']){
			print "<span style='color: #6633FF;'><b>２１コマ目：</b></span>";
			print "<b>".$value['begin_time21']."</b>時～<b>".$value['finish_time21']."</b>時　<b>".number_format($value['price21'])."</b>円<br>";
		}
		if ($value['price22']){
			print "<span style='color: #6633FF;'><b>２２コマ目：</b></span>";
			print "<b>".$value['begin_time22']."</b>時～<b>".$value['finish_time22']."</b>時　<b>".number_format($value['price22'])."</b>円<br>";
		}
		if ($value['price23']){
			print "<span style='color: #6633FF;'><b>２３コマ目：</b></span>";
			print "<b>".$value['begin_time23']."</b>時～<b>".$value['finish_time23']."</b>時　<b>".number_format($value['price23'])."</b>円<br>";
		}
		if ($value['price24']){
			print "<span style='color: #6633FF;'><b>２４コマ目：</b></span>";
			print "<b>".$value['begin_time24']."</b>時～<b>".$value['finish_time24']."</b>時　<b>".number_format($value['price24'])."</b>円<br>";
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


    if($hall_id == 3){
        print "<br>";
        print "<div style='color:#FF0000;font-size:16px;'>";
        print "<center>";
        print "▼ ご希望の部屋が満室の場合は、並びの<a href='http://abc-kaigishitsu.com/ikebukuro/'>別館</a>をお探し下さい。<br><a href='http://abc-kaigishitsu.com/ikebukuro/'>別館</a>は、自由な時間帯で１時間単位（２時間～）の予約が出来ます。
";      
        print "</center>";
        print "</div>";
    }

	if($hall_data['web_reserve']==1){


?>
<br>
<table width=600 style='border: 2px #646464 solid;text-align: center;'>
<tr height="48">
<td width=88 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>利用日</td>
<td width=188 height="35" style='border: 1px #646464 solid;text-align: center;' bgcolor=#CCFFFF>
<div id="msgid2" name="msgid2" style="font-size:20px;font-weight:bold;text-align: center;">
<?php print sprintf("%04d年%02d月%02d日(%s)", $year,$month,$day,$wweek); ?>
</div>

</td>
<td width=88 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>選択時間帯</td>
<td style='border: 1px #646464 solid;text-align: center;' bgcolor=#CCFFFF>

<b><span id="begin_time_top" style="font-size:20px;">00:00</span>
 ～ 
<span id="finish_time_top" style="font-size:20px;">00:00</span></b>


</td>
</tr>

<tr height="48">
<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>ご利用予定<br>人数</td>
<td style='border: 1px #646464 solid;text-align: center;'>
<input type="text" id="people" name="people" value=0 style="text-align:right;"> 人
</td>

<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>ご利用目的</td>
<td style='border: 1px #646464 solid;text-align: center;'>
<select name="purpose">
<option value="0">--未選択--</option>
<option value="1">会議</option>
<option value="2">セミナー</option>
<option value="3">研修</option>
<option value="4">面接・試験</option>
<option value="5">懇談会・パーティ</option>
<option value="6">その他</option>
</select>
</td>
</tr>

<tr height="48">
<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>会議室入口<br>表示名</td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;'>
<input type="text" size="90" id="kanban" name="kanban" style="text-align:left;">
</td>
</tr>
</table>

<div style='display:none;'>
<span id="total_number"><?php print $number-1; ?></span>
<span id="koma">0</span>
<span id="lowest_koma">0</span>
<span id="select_pack_name" style="color:#FF0000"></span><br>
<span id="price">0</span> 円
</div>


<br><br>
<center><input type="image" src="./atoffice/img/setreserve.png" value=""></center>
<?php
}

}else{
	// date_error
	print "<center>";
	print "<span style='font-size:16px;color:#FF0000'><b>";
//	print "日付が不正です。値を元に戻してください。<br>";
//	print "<br>指定された日付の予約はできません。<br>";
	print "<br>ご希望の日程は現在承る事ができません。<br>";
	print "なお、当日の利用申込は電話でのみ承っております。<br>";
	print "03-5465-5506（月～土：9：00～18：00）";
	print "</b></span>";
}
?>
</form>

<br><br>



