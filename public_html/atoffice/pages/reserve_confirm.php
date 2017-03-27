<?php
//var_dump($_REQUEST);

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

	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}else{
		exit();
	}


	//var_dump($_REQUEST);

// 顧客情報戻り
	if(isset($_REQUEST['amp;shimei']) && $_REQUEST['amp;shimei']){
		$shimei = $_REQUEST['amp;shimei'];
	}
	if(isset($_REQUEST['amp;kana']) && $_REQUEST['amp;kana']){
		$kana = $_REQUEST['amp;kana'];
	}
	if(isset($_REQUEST['amp;riyo']) && $_REQUEST['amp;riyo']){
		$riyo = $_REQUEST['amp;riyo'];
	}
	if(isset($_REQUEST['amp;daihyou']) && $_REQUEST['amp;daihyou']){
		$daihyou = $_REQUEST['amp;daihyou'];
	}
	if(isset($_REQUEST['amp;busho']) && $_REQUEST['amp;busho']){
		$busho = $_REQUEST['amp;busho'];
	}
	if(isset($_REQUEST['amp;mail']) && $_REQUEST['amp;mail']){
		$mail = $_REQUEST['amp;mail'];
	}
	if(isset($_REQUEST['amp;ken']) && $_REQUEST['amp;ken']){
		$ken = $_REQUEST['amp;ken'];
	}
	if(isset($_REQUEST['amp;zip']) && $_REQUEST['amp;zip']){
		$zip = $_REQUEST['amp;zip'];
	}
	if(isset($_REQUEST['amp;address_city']) && $_REQUEST['amp;address_city']){
		$address_city = $_REQUEST['amp;address_city'];
	}
	if(isset($_REQUEST['amp;address_banchi']) && $_REQUEST['amp;address_banchi']){
		$address_banchi = $_REQUEST['amp;address_banchi'];
	}
	if(isset($_REQUEST['amp;address_build']) && $_REQUEST['amp;address_build']){
		$address_build = $_REQUEST['amp;address_build'];
	}
	if(isset($_REQUEST['amp;tel']) && $_REQUEST['amp;tel']){
		$tel = $_REQUEST['amp;tel'];
	}
	if(isset($_REQUEST['amp;fax']) && $_REQUEST['amp;fax']){
		$fax = $_REQUEST['amp;fax'];
	}
	if(isset($_REQUEST['amp;message']) && $_REQUEST['amp;message']){
		$message = $_REQUEST['amp;message'];
	}

	$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
	$pre_data = db_get_all($sql, $db);
	if(is_null($pre_data)){
		print "選択した予約が見つかりません。";
		exit();
	}

	// ログインか
	if(isset($_REQUEST['amp;c_member_id']) && $_REQUEST['amp;c_member_id']){
		$c_member_id = $_REQUEST['amp;c_member_id'];
	}else{
		$c_member_id = 0;
	}
	if(isset($_REQUEST['amp;msg']) && $_REQUEST['amp;msg']){
		$msg=$_REQUEST['amp;msg'];
	}

$all_total = 0;

foreach($pre_data as $key=>$value){

	$hall_id = $value['hall_id'];
	$room_id = $value['room_id'];
	$dt = new DateTime($value['begin_datetime']);
	$pre_data[$key]['date'] = $dt->format("Y年m月d日");
    $pre_data[$key]['week'] = get_week($dt->format("Ymd"));
	$pre_data[$key]['begin'] = $dt->format("H時i分");
	$dt = new DateTime($value['finish_datetime']);
	$pre_data[$key]['finish'] = $dt->format("H時i分");

// 会場取得

	$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
	$hall_data = db_get_all($sql, $db);
	$pre_data[$key]['hall_data'] = isset($hall_data[0]) ? $hall_data[0] : null;


// 部屋データ

	$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
	$room_data = db_get_all($sql, $db);
	$pre_data[$key]['room_data'] = isset($room_data[0]) ? $room_data[0] : null;

// キャンセル料率

	$sql = "select * from a_cancel_charge where hall_id = ".$value['hall_id']." and pattern_id = ".$room_data[0]['cancel'];
	$cancel_list = db_get_all($sql, $db);
	$pre_data[$key]['cancel_list'] = isset($cancel_list[0]) ? $cancel_list[0] : null;

// 選択備品
	$sql = "select * from a_pre_rv where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$vessel_data = db_get_all($sql, $db);
	if(!empty($vessel_data)){
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
	if(!empty($service_data)){
		foreach($service_data as $k=>$v){
			$sql = "select * from a_service_data where service_id = ".$v['service_id'];
			$result = db_get_all($sql, $db);
			$service_data[$k]['service_data'] = $result[0];
		}
		$pre_data[$key]['service_list'] = $service_data;
	}

	$all_total += $value['total_price'];
}// foreach

// 誕生日オプション
/*
	$birth_month_list=array();
	for($x=1;$x<13;$x++){
		array_push($birth_month_list, $x);
	}
	$birth_day_list=array();
	for($x=1;$x<32;$x++){
		array_push($birth_day_list, $x);
	}
*/

// 都道府県オプション
	$sql = "select * from c_profile_option where c_profile_id = 3";
	$ken_list=db_get_all($sql, $db);
	
function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}
/**
*@author: haipt
*@date: 2017-03-13
**/
	$u_email = ''; 
	if(isset($_REQUEST['amp;u_email']))
	{
		$u_email = $_REQUEST['amp;u_email'];
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

<a name="top"></a>

<center><div id="left" style='width:660px;'>
<H2 style="background:url(./atoffice/img/customerdata.png) no-repeat;">
</H2>
<br />
<img src="./atoffice/img/Step3.jpg" width="660" height="143">
<br><br>
<hr>
<br>
<img src="./atoffice/img/step4.png" width="660" height="31"><br>
<br>



<?php
	if($msg){
		print "<center>";
		print "<table border=2 width=500>";
		print "<tr>";
		print "<th style='background-color:#FF0000;color:#FFFFFF;font-size:16px;'><center><b>予約エラー</b></center></th></tr>";
		print "<tr><td style='background-color:#FF0000;color:#FFFFFF;'>";
		print "・".nl2br($msg);
		print "</td></tr></table></center><br><br><br>";
	}
?>

※　予約後の日程変更・時間変更につきましては、1回のみ無料で受け付けしております。<br>
（部屋の変更等で料金の変わる場合は差額分を請求、またはお返しいたします。）<br>
アカウントをお持ちの方はログイン後の予約確認より、申請してください。<br>
お持ちでない方は、お電話にて変更を受け付けしております。<br>
<br>
<span style="font-size:16px;">
★ 今回のご予約件数：<b><?php print count($pre_data); ?></b> 件 ★<br>
</span>
<br>

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
<td colspan=4 bgcolor=#FFFF66 style='border: 1px #000000 solid;text-align: center;'><b>◆　予約：<?php print ($key+1); ?>　◆</b></td>
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
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;'>キャンセル料金</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;'>
<?php

	print "<table>";
	print "<tr><td>";

	print $value['cancel_list']['day1']."日以前".$value['cancel_list']['percent1']."%";
	print "</td>";

	if ($value['cancel_list']['day2']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $value['cancel_list']['day2']."日前まで".$value['cancel_list']['percent2']."%";
		print "</span>";
		print "</td>";
	}
	if ($value['cancel_list']['day3']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $value['cancel_list']['day3']."日前まで".$value['cancel_list']['percent3']."%";
		print "</span>";
		print "</td>";
	}
	if ($value['cancel_list']['day4']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $value['cancel_list']['day4']."日前まで".$value['cancel_list']['percent4']."%";
		print "</span>";
		print "</td>";
	}
	if ($value['cancel_list']['day5']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $value['cancel_list']['day5']."日前まで".$value['cancel_list']['percent5']."%";
		print "</span>";
		print "</td>";
	}

	print "</tr></table>";



?>
</td>
</tr>

<tr>
<td bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>会議室入口<br>表示名<br>(※任意)</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: left;'>

<?php 
	print nl2br($value['kanban']);
?>



</td>
</tr>
<tr>
<td rowspan=2 bgcolor=#CDCDCD style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>請求予定額内訳</td>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>
<table>
<tr>
<td>
<b>施設利用料金：</b>
</td>
<td>
<span style="font:14px;"><b>
<?php print number_format($value['room_price']); ?> 円
</b></span>
</td>
<td>
　[ご利用予定人数] <?php print $value['people']; ?> 人

</td>
</tr>
<tr>
<td>
<b>備品利用料金：</b>
</td>
<td>
<span style="font:14px;"><b>
<?php print number_format($value['vessel_price']); ?> 円
</b></span>
</td>
<td>
<?php
	if(!empty($value['vessel_list'])){
		print "[備品詳細]<br>";
		foreach($value['vessel_list'] as $v){
			if($v['vessel_data']){
				print "-- ".$v['vessel_data']['vessel_name']."：";
				print number_format($v['price'])." 円 × ";
				print $v['num']."<br>";
			}
		}
	}

?>
</td>
</tr>


<tr>
<td>
<b>サービス利用料金：</b>
</td>
<td>
<span style="font:14px;"><b>
<?php print number_format($value['service_price']); ?> 円
</b></span>
</td>
<td>
<?php
	if(!empty($value['service_list'])){
		print "[サービス詳細]<br>";
		foreach($value['service_list'] as $v){
			if($v['service_data']){
				print "-- ".$v['service_data']['service_name']."：";
				print number_format($v['price'])." 円 × ".$v['num']."<br>";			}
		}
	}

?>
</td>
</tr>

</table>

</td>
</tr>
<tr>
<td colspan=3 style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'><table>
<tr>
<td>
<span style="color:#FF0000;font-size:16px;"><b>合計金額：</b></span>
</td>
<td>
<span style="color:#FF0000;font-size:16px;"><b>
<?php print number_format($value['total_price']); ?> 円(税込)
</b></span>
</td>
</tr>
</table>
</td>
</tr>
</table>
<br>
<?php
}// foreach
?>

<form name="yoyaku" method="POST" action="http://go.at-office.co.jp/l/73352/2017-02-28/79zrs8">
<input type="hidden" name="email" value="<?php print $u_email;?>">
<input type="hidden" name="page" value="do_yoyaku">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="uid" value="<?php print $_REQUEST['amp;uid']; ?>">

<table width=600>
<tr>
<td height=30 bgcolor=#CDFFCD style='border: 1px #000000 solid;text-align: center;'>
<span style="font:16px;"><b>お客さまメッセージ　（※　施設へメッセージがある場合はこちらにご記入ください。）</b></span>
</td>
</tr>
<tr>
<td style='border: 1px #000000 solid;text-align: center;'>
<?php $message = isset($message) ? $message : ''; ?>
<textarea id="mce_editor_textarea" name="message" rows="10" cols="90"><?php print $message; ?></textarea>

</td>
</tr>
</table>
<br>

<table width=600>
<tr>
<td height=30 bgcolor=#FFCDCD style='border: 1px #000000 solid;text-align: center;'>
<span style="font:16px;"><b>請求予定総額</b></span>
</td>
</tr>
<tr>
<td style='border: 1px #000000 solid;text-align: center;'>
<span id="total_price" style="font-size:20px;color:#FF0000;"><b>
<?php print number_format($all_total); ?>
</b></span> 円(税込)
</td>
</tr>
</table>
<br>

<br>
<table width=600>
<tr>
<td style='text-align: center;'>
<a href="#" onClick="self.history.back()"><img src="./atoffice/img/btn_back.png"></a>
<INPUT TYPE="image" src="./atoffice/img/stable.png" VALUE="">
</td>
</tr>
</table>

</form>

</div>
<br>
</body>