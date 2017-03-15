<?php
function db_get_all($sql, $db){
	$result = mysql_query($sql, $db);
	while($item = @mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}
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

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;reserve_id'])){
		$reserve_id = $_REQUEST['amp;reserve_id'];
	}else{
		HTTP::redirect("error.php");
	}

	session_start();
	$u = $_SESSION['u'];
	if(!$u){
		HTTP::redirect("error.php");
	}

	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id' and c_member_id = '$u'";
	$reserve_data = db_get_all($sql, $db);
	$reserve_data = $reserve_data[0];

/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($reserve_data['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日

/// 2013.12.21 消費税改定対応 end

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
	if($_REQUEST['amp;pre_id']){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		$pre_id = $_REQUEST['pre_id'];
	}
}


	$hall_id = $reserve_data['hall_id'];
	$room_id = $reserve_data['room_id'];
	$begin_datetime = $reserve_data['begin_datetime'];
	$finish_datetime = $reserve_data['finish_datetime'];

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql, $db);
	$hall_data = $hall_data[0];

	$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql, $db);
	$room_data = $room_data[0];

	// 備品取得
	$sql = "select vessel_id from a_room_vessel where hall_id = $hall_id and room_id = $room_id and flag = 0";

	$vessel_id_list = db_get_all($sql, $db);

	if($vessel_id_list){
		$sql = "select * from a_vessel_data where ";
		foreach($vessel_id_list as $key=>$value){
			$sql.="vessel_id = ".$value['vessel_id']." ";
			if ($vessel_id_list[($key+1)]['vessel_id']){
				$sql.="or ";
			}
		}
        $sql.=" order by weight desc";
		$vessel_num = count($vessel_id_list);

		$vessel_list = db_get_all($sql, $db);
	// 在庫数
		foreach($vessel_list as $key=>$value){

			$sql = "select num, cancel_flag from a_reserve_v where reserve_id = $reserve_id and vessel_id = ".$value['vessel_id'];
			$result = db_get_all($sql, $db);
			$vessel_list[$key]['num']=$result[0]['num'];
			$vessel_list[$key]['cancel_flag']=$result[0]['cancel_flag'];

			$reserve_vessel_num = get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $value['vessel_id'], $db);
			//予約数を引く
		
			$vessel_list[$key]['num_list'] = $value['num'] - $reserve_vessel_num;

			if($vessel_list[$key]['num_list'] > 0){
				$list = array();
				for($x=1;$x<=$vessel_list[$key]['num_list'];$x++){
					array_push($list, $x);
				}
				$vessel_list[$key]['num_list'] = $list;
			}else{
				$vessel_list[$key]['num_list'] = 0;
			}

		}
	}else{
		$vessel_list = 0;
		$vessel_num = 0;
	}
	$vessel_num = count($vessel_list);
function get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $vessel_id, $db){

/*	$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
*/
//Add by RS 2016-04-29
$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id 
	and room_id != $room_id and cancel_flag=0 
	and ((begin_datetime between '$begin_datetime' and '$finish_datetime') 
	or (finish_datetime between '$begin_datetime' and '$finish_datetime') 
	or ('$begin_datetime' between begin_datetime and finish_datetime)
	or ( begin_datetime <= '$begin_datetime' and  '$begin_datetime' <= finish_datetime)
	or ( begin_datetime <= '$finish_datetime' and  '$finish_datetime' <= finish_datetime)
	)";
	$reserve_id_list = db_get_all($sql, $db);

	if($reserve_id_list){
		$sql = "select num from a_reserve_v where vessel_id = ".$vessel_id;
		$sql.= " and (";
		foreach($reserve_id_list as $k=>$v){
			$sql.= "reserve_id = ".$v['reserve_id'];
			if($reserve_id_list[($k+1)]['reserve_id']){
				$sql.= " or ";
			}
		}
		$sql.= ")";

		$v_num = db_get_all($sql, $db);

		if($v_num){
			$reserve_v_num = 0;
			foreach($v_num as $v){
				$reserve_v_num+=$v['num'];
			}
		}else{
			$reserve_v_num = 0;
		}
	}else{
		$reserve_v_num = 0;
	}

	return $reserve_v_num;

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

<h2><b><?php print "備品変更 (".$hall_data['hall_name'].")"; ?></b></h2>
<br>

<table width=600>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>会場名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $hall_data['hall_name']; ?></td>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $room_data['room_name']; ?></td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>備品利用料金</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print number_format($reserve_data['vessel_price']); ?> 円</td>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>請求金額</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print number_format($reserve_data['total_price']); ?> 円</td>
</tr>

</table>
<br>
<?php 

/// 2013.12.21 消費税改定対応 begin

	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql, $db);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2013.12.21 消費税改定対応 end

if($vessel_list){
	$code = "<table width=600>";
	$code.= "<tr><th colspan=5 bgcolor=#FFCCFF style='border: 1px #000000 solid;text-align: center;'>変更前の備品予約状況</th></tr>";
	$code.= "<tr>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>選択</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>名称</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>価格</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>数量</th>";
	$code.= "</tr>";

foreach($vessel_list as $key=>$value){
	$code.= "<tr>";
	$code.= "<td style='border: 1px #000000 solid;text-align: center;'>";
	if($value['num']>0){
		$code.= "○";
	}else{
		$code.= "--";
	}
	$code.= "</td><td style='border: 1px #000000 solid;text-align: center;'>".$value['vessel_name']."</td>";

/// 2013.12.21 消費税改定対応 begin

	$tmp_price = $value['price'];				/// 備品価格
	$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
	$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格

	$code.= "<td style='border: 1px #000000 solid;text-align: center;'>".$tmp_price."</td>";

/// 2013.12.21 消費税改定対応 end

	if($value['num']>0){
		$code.= "<td style='border: 1px #000000 solid;text-align: center;'>".$value['num']."</td>";
	}else{
		$code.= "<td style='border: 1px #000000 solid;text-align: center;'>--</td>";
	}
	$code.= "</tr>";
}

	$code.= "</table>";

	$code.= "<br><center><b>↓　↓　↓</b></center><br>";

	$code.= "<form name='change_vessel' method='POST' action='./'>";
	$code.= "<input type='hidden' name='page' value='do_change_set_v' />";
	$code.= "<input type='hidden' name='reserve_id' value='$reserve_id'>";
	$code.= "<input type='hidden' name='vessel_list_num' value='$vessel_num'>";
	$code.= "<input type='hidden' name='pre_id' value='$pre_id'>";

	$code.= "<table width=600>";
	$code.= "<tr><th colspan=5 bgcolor=#FFFFCC style='border: 1px #000000 solid;text-align: center;'>備品変更</th></tr>";
	$code.= "<tr>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>選択</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>名称</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>価格</th>";
	$code.= "<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>数量</th>";
	$code.= "</tr>";

foreach($vessel_list as $key=>$value){
	$code.= "<tr>";
	$code.= "<td style='border: 1px #000000 solid;text-align: center;'>";
if($value['num_list']){
	if($value['num']>0){
		$code.= "<input type='checkbox' name='vessel_id".$key."' value=".$value['vessel_id']." checked>";
	}else{
		$code.= "<input type='checkbox' name='vessel_id".$key."' value=".$value['vessel_id'].">";
	}
}
	$code.= "</td><td style='border: 1px #000000 solid;text-align: center;'>".$value['vessel_name']."</td>";

/// 2013.12.21 消費税改定対応 begin

	$tmp_price = $value['price'];				/// 備品価格
	$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
	$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格

	$code.= "<td style='border: 1px #000000 solid;text-align: center;'>".$tmp_price."</td>";

/// 2013.12.21 消費税改定対応 end

	$code.= "<td style='border: 1px #000000 solid;text-align: center;'>";
	if($value['num_list']){
		$code.= "<select name='num".$key."'>";
		foreach($value['num_list'] as $v){
			$code.= "<option value=$v ";
			if($v == $value['num']){
				$code.= "selected";
			}
			$code.= ">$v</option>";
		}
		$code.= "</select>";
	}else{
		$code.= "在庫切れ";
	}
}
	$code.= "<tr>";
	$code.= "<td colspan=5 style='border: 1px #000000 solid;text-align: center;'>";

	$code.= "<INPUT TYPE='submit' VALUE='　確認　' style='width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;cursor: pointer;'>";

	$code.= "</td>";
	$code.= "</tr>";

	$code.= "</table>";
	$code.= "</form>";
}else{
	$code = "<center>この部屋に登録されている備品はありません。</center><br>";
}
print $code;

?>

</div>
<br>
</body>

