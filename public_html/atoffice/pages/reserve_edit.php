<?php
//var_dump($_REQUEST);
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

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}

$db = mysql_connect("$mysql_addr:$port", $user, $pass);
if ($db == false)
{
		print "sql connect error";
		exit(1);
}
mysql_select_db($mysql_db,$db) or die("sql database select error");

mysql_query("SET NAMES 'utf8'");

	//var_dump($_REQUEST);

$uid=(isset($_REQUEST['amp;uid']))?$_REQUEST['amp;uid']:0;

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		HTTP::redirect("error.php");
	}



$pid=$_REQUEST['amp;pid'];
$key=$_REQUEST['amp;key'];

	$sql = "select * from a_pre_reserve where pid = '$pid'";
	$pre_data = db_get_all($sql, $db);
	if(is_null($pre_data)){
		print "選択した予約が見つかりません。<br>";
		print "<INPUT TYPE=button VALUE='　戻る　' style='width:250px;font:20px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;' onClick='self.history.back()'>";
		exit();
	}
	$pre_data=$pre_data[0];

// 時間
	$dt = new DateTime($pre_data['begin_datetime']);
	$pre_data['date'] = $dt->format("Y年m月d日");
	$pre_data['week'] = get_week($dt->format("Ymd"));
	$pre_data['begin'] = $dt->format("H時i分");
	$dt = new DateTime($pre_data['finish_datetime']);
	$pre_data['finish'] = $dt->format("H時i分");

// 会場取得

	$sql = "select * from a_hall where hall_id = ".$pre_data['hall_id'];
	$hall_data = db_get_all($sql, $db);
	$pre_data['hall_data'] = $hall_data[0];

// 部屋データ

	$sql = "select * from a_room where hall_id = ".$pre_data['hall_id']." and room_id = ".$pre_data['room_id'];
	$room_data = db_get_all($sql, $db);
	$pre_data['room_data'] = $room_data[0];

// 選択備品
	$sql = "select * from a_pre_rv where pid = '".$pre_data['pid']."' and pre_id = '$pre_id' order by weight desc";
	$vessel_data = db_get_all($sql, $db);
	if($vessel_data){
		foreach($vessel_data as $k=>$v){
			$sql = "select * from a_vessel_data where vessel_id = ".$v['vessel_id'];
			$result = db_get_all($sql, $db);
			$vessel_data[$k]['vessel_data'] = $result[0];
		}
		$pre_data['vessel_list'] = $vessel_data;
	}


// 選択サービス
	$sql = "select * from a_pre_rs where pid = '".$pre_data['pid']."' and pre_id = '$pre_id' order by weight desc";
	$service_data = db_get_all($sql, $db);
	if($service_data){
		foreach($service_data as $k=>$v){
			$sql = "select * from a_service_data where service_id = ".$v['service_id'];
			$result = db_get_all($sql, $db);
			$service_data[$k]['service_data'] = $result[0];
		}
		$pre_data['service_list'] = $service_data;
	}

	$value=$pre_data;
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
<?php 
/*
<br />
<img src="./atoffice/img/Step2.jpg" width="660" height="143">
<br><br>
<hr>
<br>
<img src="./atoffice/img/step2.png" width="660" height="31"><br>
<br>
*/
?>
<h2>予約変更</h2>
<font color="#ff0000">※ 予約時間、部屋を変更したい場合は予約を一度「取消」して選択しなおして下さい。</font><br>

<form name="reserve" id="reserve" method="POST" action="./" onSubmit="return reserve_check()">
<input type='hidden' name='pid' value='<?php print $pid; ?>'>
<input type="hidden" name="page" value="do_pre_reserve_edit">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="uid" value="<?php print $uid; ?>">
<input type="hidden" name="rid" id="rid" value="">
<input type="hidden" name="hid" id="hid" value="<?php print $hall_id; ?>">

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
<select name="purpose">
<?php 
$purposes=Array(0=>"--未選択--","会議","セミナー","研修","面接・試験","懇談会・パーティ","その他");
for($i=0;$i<7;$i++){
	echo "<option value='$i'";
	if($i==$value["purpose"]) echo " selected";
	echo ">".$purposes[$i]."</option>";
}
?>
</select>
</td>
</tr>
<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>ご利用予定人数</td>
<td style='border: 1px #000000 solid;text-align: center;'>
<input type="text" id="people" name="people" value="<?php echo $value['people'];?>" style="text-align:right;"> 人
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
	if($value['vessel_list']){
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
	if($value['service_list']){
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

</td></tr>
<tr height="48">
<td width=100 style='border: 1px #646464 solid;text-align: center;' bgcolor=#CDCDCD>会議室入口<br>表示名</td>
<td colspan="3" style='border: 1px #646464 solid;text-align: center;'>
<input type="text" size="90" id="kanban" name="kanban" style="text-align:left;" value="<?php echo $value['kanban']; ?>">
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
</form>

<br><br>



