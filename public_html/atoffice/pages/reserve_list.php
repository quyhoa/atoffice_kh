<?php
function db_get_all($sql, $db){
	$rows = array();
	$result = mysql_query($sql, $db);
	while($item = mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}

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

$uid=(isset($_REQUEST['amp;uid']))?$_REQUEST['amp;uid']:0;

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		HTTP::redirect("error.php");
	}

// 会場ID

	//var_dump($_REQUEST);

	$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
	$pre_data = db_get_all($sql, $db);
	if(is_null($pre_data)){
		print "選択した予約が見つかりません。<br>";
		print "<INPUT TYPE=button VALUE='　戻る　' style='width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;' onClick='self.history.back()'>";
		exit();
	}
	$all_total = 0;

foreach($pre_data as $key=>$value){
// 時間
	$dt = new DateTime($value['begin_datetime']);
	$pre_data[$key]['date'] = $dt->format("Y年m月d日");
    $pre_data[$key]['week'] = get_week($dt->format("Ymd"));
	$pre_data[$key]['begin'] = $dt->format("H時i分");
	$dt = new DateTime($value['finish_datetime']);
	$pre_data[$key]['finish'] = $dt->format("H時i分");

	$hall_id=$value['hall_id'];

// 会場取得

	$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
	$hall_data = db_get_all($sql, $db);
	$pre_data[$key]['hall_data'] = $hall_data[0];


// 部屋データ

	$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
	$room_data = db_get_all($sql, $db);
	$pre_data[$key]['room_data'] = $room_data[0];

// キャンセル料率

	$sql = "select * from a_cancel_charge where hall_id = ".$value['hall_id']." and pattern_id = ".$room_data[0]['cancel'];
	$cancel_list = db_get_all($sql, $db);
	$pre_data[$key]['cancel_list'] = $cancel_list[0];

// 選択備品
	$sql = "select * from a_pre_rv where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$vessel_data = db_get_all($sql, $db);
	if($vessel_data){
		foreach($vessel_data as $k=>$v){
			$sql = "select * from a_vessel_data where vessel_id = ".$v['vessel_id'];
			$result = db_get_all($sql, $db);
			$vessel_data[$k]['vessel_data'] = $result[0];
		}
		$pre_data[$key]['vessel_list'] = $vessel_data;
	}


// 選択サービス
	$sql = "select * from a_pre_rs where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$service_data = db_get_all($sql, $db);
	if($service_data){
		foreach($service_data as $k=>$v){
			$sql = "select * from a_service_data where service_id = ".$v['service_id'];
			$result = db_get_all($sql, $db);
			$service_data[$k]['service_data'] = $result[0];
		}
		$pre_data[$key]['service_list'] = $service_data;
	}

	$all_total += $value['total_price'];

}// foreach

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}

//-------------------------------



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

<table width="660" height="75" bgcolor="#FAFAFA" style="border: 1px solid #CDCDCD; border-collapse: collapse; empty-cells: show;">
<tr>
<td width="400" style="font-size: 20px; font-weight: bold; text-align: center; vertical-align: middle">他の予約を追加する場合はコチラ　>>></td>
<td width="260" style="text-align: center; vertical-align: middle">
<form name="add_reserve" method="POST" action="./">
<input type="hidden" name="page" value="reserve">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type='hidden' name='uid' value='<?php print $uid; ?>'>
<input type='hidden' name='hid' value='<?php print $hall_id; ?>'>
<input type="image" src="./atoffice/img/otherreserve.png" value="">
</form>
</td>
</tr>
</table>
<br>
<br>

<center>

<?php

foreach($pre_data as $key=>$value){

// 利用目的
	if($value['purpose']==0){
		$purpose = "未定";
	}elseif($value['purpose']==1){
		$purpose = "会議";
	}elseif($value['purpose']==2){
		$purpose = "セミナー";
	}elseif($value['purpose']==3){
		$purpose = "研修";
	}elseif($value['purpose']==4){
		$purpose = "面接・試験";
	}elseif($value['purpose']==5){
		$purpose = "懇談会・パーティ";
	}elseif($value['purpose']==6){
		$purpose = "その他";
	}

?>


<table width=600>
<tr>
<td colspan=4 bgcolor=#FFFF66 style='border: 1px #000000 solid;text-align: center;'><b> ◆　予約:<?php print ($key+1); ?>　◆</b></td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設名</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $value['hall_data']['hall_name']; ?></td>

<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>部屋名称</td>
<td style='border: 1px #000000 solid;text-align: center;'><?php print $value['room_data']['room_name']; ?></td>

</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用日</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php
	print $value['date']."(".$value['week'].")";
?>
</td>

<td rowspan=2 bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>利用時間帯</td>
<td rowspan=2 style='border: 1px #000000 solid;text-align: center;'>
<?php
	print $value['begin']."～".$value['finish'];
?>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用目的</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php
	print $purpose;
?>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用予定人数</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php print $value['people']; ?> 人
</td>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>施設利用料金</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php print number_format($value['room_price']); ?>
 円（税込）
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>備品</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>
<?php
	if(!empty($value['vessel_list'])){
?>
<table width=100%>
<tr>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>備品名</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>単価</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>数量</th>
</tr>

<?php
//var_dump($value);
		foreach($value['vessel_list'] as $k=>$v){
//echo "<br>";
//echo $v['price']."<br>";
?>
<tr>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print $v['vessel_data']['vessel_name']; ?></td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print number_format($v['price']); ?> 円</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print $v['num']; ?></td>
</tr>
<?php
		}
?>
<tr>
<td style='text-align: center;vertical-align:middle;'>
備品利用料金
</td>
<td>

<?php print number_format($value['vessel_price']); ?>

 円</td>
</table>
<?php
	}else{
		print "-- --";
	}
?>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>サービス</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>
<?php
	if(!empty($value['service_list'])){
?>
<table width=100%>
<tr>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>サービス名</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>単価</th>
<th bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'>数量</th>
</tr>
<?php
		foreach($value['service_list'] as $k=>$v){
?>
<tr>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print $v['service_data']['service_name']; ?></td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print number_format($v['price']); ?> 円</td>
<td style='border: 1px #000000 solid;text-align: center;text-align:center;vertical-align:middle;'><?php print $v['num']; ?></td>
</tr>
<?php
		}
?>
<tr>
<td style='text-align: center;vertical-align:middle;'>
サービス品利用料金
</td>
<td>

<?php print number_format($value['service_price']); ?>

 円</td>
</table>
<?php
	}else{
		print "-- --";
	}
?>
</td>
</tr>
<tr height="48">
<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>会議室入口<br>表示名</td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;'>
<?php echo $value['kanban'];?>
</td>
</tr>
</table>
<br>
<table width="500"><tr>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="reserve_v" method="POST" action="./">
<input type="hidden" name="page" value="reserve_vessel">
<input type='hidden' name='pre_id' value='<?php print $pre_id; ?>'>
<input type='hidden' name='pid' value='<?php print $value['pid']; ?>'>
<input type='hidden' name='uid' value='<?php print $uid; ?>'>
<input type='hidden' name='pno' value='<?php print $key; ?>'>
<INPUT TYPE="image" src="./atoffice/img/equiporder.png" VALUE="">
</form>
</td>
<td width="250" style="text-align: center; vertical-align:middle;">
<form name="reserve_s" method="POST" action="./">
<input type="hidden" name="page" value="reserve_service">
<input type='hidden' name='pre_id' value='<?php print $pre_id; ?>'>
<input type='hidden' name='pid' value='<?php print $value['pid']; ?>'>
<input type='hidden' name='uid' value='<?php print $uid; ?>'>
<input type='hidden' name='pno' value='<?php print $key; ?>'>
<INPUT TYPE="image" src="./atoffice/img/serviceorder.png" >
</form>
</td>
</tr></table>
<br>
<br>

<?php
}
?>

<hr><br>
<table width=600>
<tr>
<td colspan=2 height=30 bgcolor=#FFCDCD style='border: 1px #000000 solid;text-align: center;'>
<span style="font:16px;"><b>請求予定総額</b></span>
</td>
</tr>
<tr>
<td colspan=2 style='border: 1px #000000 solid;text-align: center;'>
<span id="total_price" style="font-size:20px;color:#FF0000;"><b>
<?php print number_format($all_total); ?>
</b></span> 円(税込)
</td>
</tr>
</table>
<br><br>
<form name="reserve_confirm" method="POST" action="./">
<input type="hidden" name="page" value="reserve_confirm">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type='hidden' name='uid' value='<?php print $uid; ?>'>
<input type="image" src="./atoffice/img/toconf.png" value="">
</form>

</center>

</div>
<br>
</body>