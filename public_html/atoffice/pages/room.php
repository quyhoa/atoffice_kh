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

// 会場ID
	if ($_GET['hid']){
		$hall_id = $_GET['hid'];
	}else{
		print "無効な会場IDです。";
		exit(1);
	}
	if ($_GET['rid']){
		$room_id = $_GET['rid'];
	}else{
		print "無効な部屋IDです。";
		exit(1);
	}
// 会場取得

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql, $db);
	$hall_data = $hall_data[0];

// 有効な部屋データ

	$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql, $db);
	$room_data = $room_data[0];



// 有効な備品リスト
	$sql = "select * from a_vessel_data where hall_id = $hall_id and flag=1";	$vessel_list = db_get_all($sql, $db);

	foreach($vessel_list as $key=>$value){
		$vessel_list[$key]['used_room']="";
		$sql = "select room_id from a_room_vessel where vessel_id = ".$value['vessel_id'];
		$room_id_vessel = db_get_all($sql, $db);
		if($room_id_vessel[0]['room_id']){
			foreach($room_id_vessel as $v){
				$sql="select room_name from a_room where hall_id = $hall_id and room_id = ".$v['room_id'];
				$room_name_vessel = db_get_all($sql, $db);
				$vessel_list[$key]['used_room'].= $room_name_vessel[0]['room_name']."\n";
			}
		}
	}


// 有効なサービスリスト
	$sql = "select * from a_service_data where hall_id = $hall_id and flag=1";
	$service_list = db_get_all($sql, $db);
	foreach($service_list as $key=>$value){
		$service_list[$key]['used_room']="";
		$sql = "select room_id from a_room_service where service_id = ".$value['service_id'];
		$room_id_service = db_get_all($sql, $db);
		if($room_id_service[0]['room_id']){
			foreach($room_id_service as $v){
				$sql="select room_name from a_room where hall_id = $hall_id and room_id = ".$v['room_id'];
				$room_name_service = db_get_all($sql, $db);
				$service_list[$key]['used_room_service'].= $room_name_service[0]['room_name']."\n";
			}
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

<h2><b><?php print $room_data['room_name']; ?></b></h2>


<div id="setsubi">
<a name="option"></a>
<h2><b>設備・サービス</b></h2>

<span style="font-size: 16pt;color: #FF0000;"><b>
<?php print nl2br($hall_data['facilities']); ?>
</b></span>

<?php 

if ($vessel_list){
	print "<hr>";
	print "<table class='facilities' border='1' cellpadding='0' cellspacing='0' bordercolor='#cccccc'>";
	print "<caption class='top' align=left>■有料設備</caption>";
	print "<tr>";
	print "<th scope='col'>設備名称</th>";
	print "<th scope='col'>ご利用<br>価格</th>";
	print "<th scope='col'>料金<br>区分</th>";
	print "<th scope='col'>ご利用が<br>可能な部屋</th>";
	print "<th scope='col'>説明</th>";
	print "</tr>";

	foreach ($vessel_list as $key=>$item){
		print "<tr>";
		print "<td>";
		print $item['vessel_name']."</td>";
		print "<td>".$item['price']."円</td>";
		print "<td>";
		if ($item['charge_devision==1']){
			print "予約毎";
		}else{
			print "時間毎";
		}
		print "</td>";
		print "<td valign=top>";
		print "<div align=left>";
		print nl2br($item['used_room']);
		print "</div>";
		print "</td>";
		print "<td valign=top>";
		print "<div align=left>";
		print nl2br($item['memo1']);
		print "</div>";
		print "</td>";
		print "</tr>";
	}
	print "</table>";
	print "<br>";
	print "※　料金区分について<br>";
	print "予約毎＝１回の予約で同日に連続して何時間選択してもご利用価格は変わりません。<br>";
	print "時間毎＝連続して複数時間選択した場合、選択した数だけご利用価格をいただきます。<br>";
	print "<br>";
}

if ($service_list){
	print "<hr>";
	print "<table class='facilities' border='1' cellpadding='0' cellspacing='0' bordercolor='#cccccc'>";
	print "<caption class='top' align=left>■有料サービス</caption>";
	print "<tr>";
	print "<th scope='col'>サービス名称</th>";
	print "<th scope='col'>ご利用<br>価格</th>";
	print "<th scope='col'>最低<br>注文数</th>";
	print "<th scope='col'>ご利用が<br>可能な部屋</th>";
	print "<th scope='col'>説明</th>";
	print "</tr>";
	foreach ($service_list as $item){
		print "<tr>";
		print "<td>".$item['service_name']."</td>";
		print "<td>".$item['price']."円</td>";
		print "<td>".$item['minimum_orders']."</td>";
		print "<td valign=top>";
		print "<div align=left>";
		print nl2br($item['used_room_service']);
		print "</div>";
		print "</td>";
		print "<td valign=top>";
		print "<div align=left>";
		print nl2br($item['memo1']);
		print "</div>";
		print "</td>";
		print "</tr>";
	}
	print "</table>";
	print "<br>";
	print "※　最低注文数について<br>";
	print "最低注文数以上の数量でご予約を承っております。<br>";
	print "最低注文数以下の数量ではご予約できませんのでご了承ください。<br><br>";
}
?>

</div>


<div id="flow">
<a name="flow"></a>
<h2><b>ご利用の流れ</b></h2>
<table class="flow">
<tr>
<td class="title">空室確認</td><td class="text"><p>まずご利用されたい物件をお探しいただき。日時や人数が決まりましたら、<br />
各物件ページにある以下のボタンをクリックし、空き室の状況をご確認ください。</p>
<image src="./atoffice/img/btn_reserve.jpg"alt="空室確認・ご予約" />
</td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
</tr>
<tr>
<td class="title">仮予約</td>
<td class="text"><p>各物件ごとの<a href="./?m=admin&a=page_hall_kiyaku_preview&h=({$hall_data.hall_id})" target="blank">「利用規約」</a>に同意いただいたうえで、空室確認画面の中の日付部分をクリックいただき、ご希望の部屋/日時にチェックを入れ、仮予約を行っていただきます。</p>
<p class="caption">※仮予約後２営業日以内に弊社よりご連絡させていただきます。<br />
※弊社より「ご予約確認」のメールを送らせていただいた後のキャンセルは、既定のキャンセル料が発生いたします。ご注意ください。</p></td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
<tr>
<td class="title">お支払い</td><td class="text"><p>弊社からの返信メールに記載されている入金先へご入金いただきます。</p>
<p class="caption">※料金は前払い制になっております。<br />※振込手数料はお客様のご負担となります。ご了承ください。<br />※振込名義はご予約の際の会社名・団体名でお願いいたします。<br />
（個人でお申込みのお客様はご予約の際のお名前にてお願いいたします）</p></td>
</tr>
<tr><td class="arrow" colspan="2"><img src="./atoffice/img/flow_arrow.gif" width="49" height="14" /></td>
<tr>
<td class="title">当　　日</td>
<td class="text"><p><span class="bold">ご利用時間内での入室、退室</span>をお願いいたします。</p>
<p class="caption">※ご利用時間に、お部屋の準備は完了しておりますので、そのまま入室いただけます。</p></td>
</tr>
</table>
<br>
<p><span class="bold">■仮予約後のキャンセルについて</span><br><br>
<center>各部屋ごとのキャンセル料は以下のようになっております。</center>

<table>
<?php
foreach ($room_data as $item){
	print "<tr>";
	print "<td bgcolor=#FF9900 height=25>";
	print "<span style='margin:5px;color:#FFFFFF;'>";
	print "<b>".$item['room_name']."</b>";
	print "</span>";
	print "</td>";
	print "<td>";
	print "<span style='margin:2px'>";
	print $item['cancel_list']['day1']."日前まで".$item['cancel_list']['percent1']."%";
	print "</span>";
	print "</td>";

	if ($item['cancel_list']['day2']){
		print "<td>";
		print "<span style='margin:2px'>";
		print $item['cancel_list']['day2']."日前まで".$item['cancel_list']['percent2']."%";
		print "</span>";
		print "</td>";
	}
	if ($item['cancel_list']['day3']){
		print "<td>";
		print "<span style='margin:3px'>";
		print $item['cancel_list']['day3']."日前まで".$item['cancel_list']['percent3']."%";
		print "</span>";
		print "</td>";
	}
	if ($item['cancel_list']['day4']){
		print "<td>";
		print "<span style='margin:4px'>";
		print $item['cancel_list']['day4']."日前まで".$item['cancel_list']['percent4']."%";
		print "</span>";
		print "</td>";
	}
	if ($item['cancel_list']['day5']){
		print "<td>";
		print "<span style='margin:5px'>";
		print $item['cancel_list']['day5']."日前まで".$item['cancel_list']['percent5']."%";
		print "</span>";
		print "</td>";
	}
	print "</tr>";
}
?>
</table>
<br>
<span style="margin:5px;color:#FF0000;">
<table>
<tr>
<td>※</td>
<td>キャンセル料の割合は、弊社が回収する割合になります。</td>
</tr>
<tr><td></td>
<td>例として30%の場合、弊社が予約金の30%を回収し、70%をご返金いたします。</td>
</tr>
<tr>
<td>※</td>
<td>有料設備をご予約の場合、設備料金はキャンセル料の回収額に含まれません。</td>
</tr>
<tr>
<td>※</td>
<td>有料サービスには、キャンセル料に含まれるものと含まれないものがあります。</td>
<tr><td></td>
<td>サービスご予約の際に表示されますのでご確認の上、ご了承ください。</td>
</tr>
</tr>
</table>
</span>
<br>
<p>より詳細な内容については各会場の<a href="./?m=admin&a=page_hall_kiyaku_preview&h=({$hall_data.hall_id})" target="blank">「利用規約」</a>をご確認ください。</p>
<br>
</div>


<a name="contact"></a>
<h2><b><?php print $hall_data['hall_name']; ?>についてのお問い合わせ</b></h2>
<div id="index_btn">
<table border="0">
<tr>
<td><img src="./atoffice/img/contact_btn.gif" alt="お問い合わせ" border="0" /></a></td>
<td><image src="./atoffice/img/reserve_btn.gif" alt="空室確認・ご予約" />
</td>
</tr>
</table>
</div>
<div id="tel">
<p><img src="./atoffice/img/footer_tel.gif" alt="ご予約・ご質問・空室のご確認は03-5465-5506" width="394" height="88" /><br />
※「貸し会議室の件」とお申し付け下さいTEL受付時間：平日 9:00～18:00</p>
</div>


</div>

</body>