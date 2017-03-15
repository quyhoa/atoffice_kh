<?php
//var_dump($_REQUEST);
function db_get_all($sql, $db){
	$rows =array();
	$result = mysql_query($sql, $db);
	while($item = mysql_fetch_assoc($result)){
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

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		HTTP::redirect("error.php");
	}
	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pid'])){
		$pid = $_REQUEST['amp;pid'];
	}else{
		HTTP::redirect("error.php");
	}

// データ再取得

	$sql = "select * from a_pre_reserve where pid = '$pid'";
	$pre_data = db_get_all($sql, $db);
	$pre_data = $pre_data[0];

	if(is_null($pre_data)){
		print "選択した予約が見つかりません。";
		exit();
	}

/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($pre_data['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日

/// 2013.12.21 消費税改定対応 end

	$hall_id = $pre_data['hall_id'];
	$room_id = $pre_data['room_id'];
	$dt = new DateTime($pre_data['begin_datetime']);
	$pre_data['date'] = $dt->format("Y年m月d日");
    $pre_data['week'] = get_week($dt->format("Ymd"));
	$pre_data['begin'] = $dt->format("H時i分");
	$dt = new DateTime($pre_data['finish_datetime']);
	$pre_data['finish'] = $dt->format("H時i分");
	$year = $dt->format("Y");
	$month = $dt->format("m");
	$day = $dt->format("d");
	$people = $pre_data['people'];
	$begin_datetime = $pre_data['begin_datetime'];
	$finish_datetime = $pre_data['finish_datetime'];
	$room_price = $pre_data['room_price'];

// 会場取得

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql, $db);
	$hall_data = $hall_data[0];


// 部屋データ

	$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql, $db);
	$room_data = $room_data[0];


// キャンセル料率

	$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = ".$room_data['cancel'];
	$cancel_list = db_get_all($sql, $db);
	$cancel_list = $cancel_list[0];

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

			$reserve_vessel_num = get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $value['vessel_id'], $db);
			$reserve_pre_vessel_num = get_pre_rv($hall_id, $room_id, $begin_datetime, $finish_datetime, $value['vessel_id'], $pre_data['pre_id'], $db);
			// 予約数合算
			$reserve_vessel_num += $reserve_pre_vessel_num;
			//print "vessel_id = ".$value['vessel_id']." 予約数＝".$reserve_vessel_num."<br>";

			//予約数を引く
			$vessel_list[$key]['remainder'] = $value['num'] - $reserve_vessel_num;

		}
	}else{
		$vessel_list = 0;
		$vessel_num = 0;
	}


// サービス取得

	$sql = "select service_id from a_room_service where hall_id = $hall_id and room_id = $room_id and flag = 0";
	$service_id_list = db_get_all($sql, $db);
	if($service_id_list){
		$sql = "select * from a_service_data where ";
		foreach($service_id_list as $key=>$value){
			$sql.="service_id = ".$value['service_id']." ";
			if ($service_id_list[($key+1)]['service_id']){
				$sql.="or ";
			}
		}
        $sql.=" order by weight desc";
		$service_list = db_get_all($sql, $db);
	// 在庫数
		foreach($service_list as $key=>$value){

			$service_list[$key]['remainder'] = $value['num'];

		}
	}else{
		$service_list = 0;
	}
	$service_num = count($service_list);


function get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $vessel_id, $db){

	$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	//print $sql."<br>";
	$reserve_id_list = db_get_all($sql, $db);
	//var_dump($reserve_id_list);

	// 予約数
		//var_dump($reserve_id_list);
		//print "<br>";

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
		//var_dump($v_num);
		//print "<br>";

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

function get_pre_rv($hall_id, $room_id, $begin_datetime, $finish_datetime, $vessel_id, $pre_id, $db){

	$sql = "select pid from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id != $room_id and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	$reserve_id_list = db_get_all($sql, $db);
	if($reserve_id_list){
		$sql = "select num from a_pre_rv where vessel_id = ".$vessel_id;
		$sql.= " and (";
		foreach($reserve_id_list as $k=>$v){
			$sql.= "pid = ".$v['pid'];
			if($reserve_id_list[($k+1)]['pid']){
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
<img src="./atoffice/img/step3.png" width="660" height="31"><br>
<br>

<form name="reserve_vs" method="POST" action="./">
<input type="hidden" name="page" value="do_set_reserve_v">
<input type='hidden' name='vessel_num' value='<?php print $vessel_num;?>'>
<input type='hidden' name='service_num' value='<?php print $service_num;?>'>
<input type='hidden' name='pre_id' value='<?php print $pre_id;?>'>
<input type="hidden" name="uid" value="<?php print $_REQUEST['amp;uid']; ?>">
<input type='hidden' name='pid' value='<?php print $pid;?>'>

<table width=600>
<tr>
<td colspan=4 bgcolor=#FFFF66 style='border: 1px #000000 solid;text-align: center;'><b> ◆　予約:<?php print ($_REQUEST['amp;pno']+1); ?>　◆</b></td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $hall_data['hall_name']; ?></td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名称</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $room_data['room_name']; ?></td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用日</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php
	print $pre_data['date']."(".$pre_data['week'].")";
?>
</td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用時間帯</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php
	print $pre_data['begin']."～".$pre_data['finish'];
?>
</td>
</tr>
</table>
<br><br>
<div style="font-size: 22px; font-weight: bold;">備品一覧</div>
<br>
<?php
	if ($vessel_list){
?>

<table width=600 style='border: 1px #000000 solid;'>
<tr>
<td colspan=6 bgcolor=#EFEFEF style='border: 1px #000000 solid;text-align: center;'><?php print $room_data['room_name']; ?> では以下の備品がご利用いただけます。<br>
<span style="color:#FF0000"><b>
※　在庫切れ、又は備品の数が不足している場合はお電話にてご相談ください。（03-5465-5506）
</b></span>
</td>
</tr>
<tr>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>選択</th>
<th bgcolor=#CDCDCD width=180 style='border: 1px #000000 solid;text-align: center;'>名称</th>
<th bgcolor=#CDCDCD width=80 style='border: 1px #000000 solid;text-align: center;'>価格</th>
<th bgcolor=#CDCDCD width=65 style='border: 1px #000000 solid;text-align: center;'>数量</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>メモ</th>
</tr>
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

foreach($vessel_list as $key=>$value){

	print "<tr><td style='border: 1px #000000 solid;text-align: center;'>";

	if ($value['remainder']>0){
		print "<input type='checkbox' name='select_vessel".$key."' value=".$value['vessel_id']." onclick=\"vessel_price_change(".count($vessel_list).")\">";

	}else{
		print "<input type='checkbox' name='select_vessel".$key."' value=".$value['vessel_id']." onclick=\"vessel_price_change(".count($vessel_list).")\" style='display:none;'>";
	}

	print "</td><td style='border: 1px #000000 solid;text-align: center;'>";
	print $value['vessel_name'];
	print "</td><td style='border: 1px #000000 solid;text-align: right;' nowrap>";

/// 2013.12.21 消費税改定対応 begin

	$tmp_price = $value['price'];				/// 備品価格
	$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
	$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格

	print number_format($tmp_price)." 円";			/// 備品単価
	print "<span id='tanka".$key."' style='display:none;'>".$tmp_price."</span>";

/// 2013.12.21 消費税改定対応 end

	print "</td><td style='border: 1px #000000 solid;text-align: center;'>";
	if ($value['remainder']>0){

		print "<select name='remainder".$key."' onchange=\"vessel_price_change(".count($vessel_list).")\">";
		for($x=1;$x<=$value['remainder'];$x++){
			print "<option value=$x >$x</option>";
		}
		print "</select>";
	}else{
		print "<span style='color: #FF3300;'><b>在庫切れ</b></span>";
	}

	print "</td><td style='border: 1px #000000 solid;text-align: left;'>";
		print nl2br($value['memo1']);
	print "</td></tr>";
}

?>
<tr>
<td colspan=2 bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>
備品利用料金
</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;'>
<span id="reserve_vessel_price">0</span> 円(税込)
</td>
</tr>
</table>
<?php
	}else{
		print "<span id='reserve_vessel_price' style='display:none;'>0</span>";
	}
?>
<br>
<table width=600>
<tr>
<td style='text-align: center;'>
<a href="#" onClick="self.history.back()"><img src="./atoffice/img/btn_back.png"></a>
<INPUT TYPE="image" src="./atoffice/img/btn_regequip.png" VALUE="">
</td>
</tr>
</table>

</form>

</div>
<br>
</body>

