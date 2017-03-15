<?php

function db_get_all($sql, $db){
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

// データ再構成

	//var_dump($_REQUEST);
	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		HTTP::redirect("error.php");
	}

	$sql = "select * from a_pre_reserve where pre_id = '$pre_id'";
	$pre_data = db_get_all($sql, $db);
	$pre_data = $pre_data[0];
	if(!$pre_data){
		HTTP::redirect("error.php");
	}

	$reserve_id = $pre_data['reserve_id'];
	$hall_id = $pre_data['hall_id'];
	$room_id = $pre_data['room_id'];
	$people = $pre_data['people'];
	if($pre_data["purpose"]==0){
		$purpose="未選択";
	}elseif($pre_data["purpose"]==1){
		$purpose="会議";
	}elseif($pre_data["purpose"]==2){
		$purpose="セミナー";
	}elseif($pre_data["purpose"]==3){
		$purpose="研修";
	}elseif($pre_data["purpose"]==4){
		$purpose="面接・試験";
	}elseif($pre_data["purpose"]==5){
		$purpose="懇談会・パーティ";
	}elseif($pre_data["purpose"]==6){
		$purpose="その他";
	}else{
		HTTP::redirect("error.php");
	}

	if($_REQUEST['amp;msg']){
		$msg=$_REQUEST['amp;msg'];
	}
	$dt = new DateTime($pre_data['begin_datetime']);
    $pre_data['week'] = get_week($dt->format("Ymd"));
	$pre_data['date'] = $dt->format("Y年m月d日");
	$pre_data['begin'] = $dt->format("H:i");
	$dt = new DateTime($pre_data['finish_datetime']);
	$pre_data['finish'] = $dt->format("H:i");

// 旧予約情報
	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$old_rd = db_get_all($sql, $db);
	$old_rd = $old_rd[0];
	$old_rd['room_name'] = get_room_name($hall_id, $old_rd['room_id'], $db);
	
	$dt = new DateTime($old_rd['begin_datetime']);
    $old_rd['week'] = get_week($dt->format("Ymd"));
	$old_rd['reserve_date'] = $dt->format("Y年m月d日");
	$old_rd['begin_time'] = $dt->format("H:i");
	$dt = new DateTime($old_rd['finish_datetime']);
	$old_rd['finish_time'] = $dt->format("H:i");
	if($old_rd["purpose"]==0){
		$old_purpose="未選択";
	}elseif($old_rd["purpose"]==1){
		$old_purpose="会議";
	}elseif($old_rd["purpose"]==2){
		$old_purpose="セミナー";
	}elseif($old_rd["purpose"]==3){
		$old_purpose="研修";
	}elseif($old_rd["purpose"]==4){
		$old_purpose="面接・試験";
	}elseif($old_rd["purpose"]==5){
		$old_purpose="懇談会・パーティ";
	}elseif($old_rd["purpose"]==6){
		$old_purpose="その他";
	}

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

function get_room_name($hall_id, $room_id, $db){
	$sql = "select room_name from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_name = db_get_all($sql, $db);
	return $room_name[0]['room_name'];
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


<h2><b><?php print "予約日時・部屋変更 ＞ 確認（".$hall_data['hall_name']."）"; ?></b></h2>
<br>

<?php
	if($msg){
		print "<center>";
		print "<span style='font:20px;border:3px ridge;background:#FF1111;color:#FFFFFF; padding:3px; font-weight:bold;'>";
		print "　予約エラー：　".$msg."　";
		print "</span></center><br><br><br>";
	}
?>

※　予約後の日程変更・時間変更につきましては、1回のみキャンセル料無料で受け付けしております。<br>
<br>

<table width=600>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $hall_data['hall_name']; ?></td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名称</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>
旧：　<?php print $old_rd['room_name']; ?><br>
↓<br>
新：　<?php print $room_data['room_name']; ?>
</b></td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用日</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>
<?php
	print "旧：　".$old_rd['reserve_date']."(".$old_rd['week'].")<br>";
	print "↓<br>";
	print "新：　".$pre_data['date']."(".$pre_data['week'].")";
?>
</b></td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用時間帯</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>
<?php
	print "旧：　".$old_rd['begin_time']."～".$old_rd['finish_time']."<br>";
	print "↓<br>";
	print "新：　".$pre_data['begin']."～".$pre_data['finish']."<br>";
?>
</b></td>
</tr>

<tr>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用人数</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>
<?php
	print "旧：　".$old_rd['people']."人<br>";
	print "↓<br>";
	print "新：　".$people."人";
?>
</b></td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用目的</td>
<td style='border: 1px #000000 solid;text-align: center;'><b>
<?php
	print "旧：　".$old_purpose."<br>";
	print "↓<br>";
	print "新：　".$purpose;
?>
</b></td>

</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>キャンセル料金</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;'>
<?php

	print "<table>";
	print "<tr><td>";

	print $cancel_list['day1']."日前まで".$cancel_list['percent1']."%";
	print "</td>";

	if ($cancel_list['day2']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $cancel_list['day2']."日前まで".$cancel_list['percent2']."%";
		print "</span>";
		print "</td>";
	}
	if ($cancel_list['day3']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $cancel_list['day3']."日前まで".$cancel_list['percent3']."%";
		print "</span>";
		print "</td>";
	}
	if ($cancel_list['day4']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $cancel_list['day4']."日前まで".$cancel_list['percent4']."%";
		print "</span>";
		print "</td>";
	}
	if ($cancel_list['day5']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $cancel_list['day5']."日前まで".$cancel_list['percent5']."%";
		print "</span>";
		print "</td>";
	}

	print "</tr></table>";



?>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>施設利用料差額</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><b>

<?php 
	// 請求
	print "旧：　施設利用料金　".number_format($old_rd['room_price'])." 円<br>";
	print "↓<br>";
	print "新：　施設利用料金　".number_format($pre_data['room_price'])." 円<br>";

	print "<hr>";

	$new_total_price = $pre_data['room_price'] + $old_rd['vessel_price'] + $old_rd['service_price'];

	print "旧：　総額　".number_format($old_rd['total_price'])." 円<br>";
	print "↓<br>";
	print "新：　総額　".number_format($new_total_price)." 円<br>";

	print "<hr>";

	print "<span style='color:#FF0000;font:16px;'><b>変更後請求総額：</b></span>";
	print "<span style='color:#FF0000;font:16px;'><b>";
	print number_format($new_total_price)." 円";



?>


</b></span>

</b></td>
</tr>

</table>



<form name="yoyaku" method="POST" action="./">
<input type="hidden" name="page" value="do_change_reserve">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">

<br>
<center>

<INPUT TYPE=button VALUE="　戻る　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;" onClick="self.history.back()">
<INPUT TYPE="submit" VALUE="　変更内容の確定　" style="width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;">

</center>

</form>

</div>
<br>
</body>