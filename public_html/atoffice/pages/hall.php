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

// 会場取得

	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql, $db);
	$hall_data = $hall_data[0];

// 画像データ取得

	$sql = "select * from a_hall_image where hall_id = $hall_id";
	$hall_image = db_get_all($sql, $db);

// 有効な部屋データ

	$sql = "select * from a_room where hall_id = $hall_id and flag=1";
	$room_data = db_get_all($sql, $db);

	foreach($room_data as $key=>$value){
		//キャンセル料率
		$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = ".$value['cancel'];
		$cancel_list = db_get_all($sql, $db);
		//var_dump($cancel_list);
		$room_data[$key]['cancel_list'] = $cancel_list[0];

		// 最大収容人数
		if($value['num_school'] > $value['num_mouth'] and $value['num_school'] > $value['num_theater']){
			$max_num = $value['num_school'];
		}elseif($value['num_theater'] > $value['num_mouth']){
			$max_num = $value['num_theater'];
		}else{
			$max_num = $value['num_mouth'];
		}
		$room_data[$key]['max_num'] = $max_num;

	}


// 有効な備品リスト
	$sql = "select * from a_vessel_data where hall_id = $hall_id and flag=1";	$vessel_list = db_get_all($sql, $db);

	if($vessel_list){

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
	}

// 有効なサービスリスト
	$sql = "select * from a_service_data where hall_id = $hall_id and flag=1";
	$service_list = db_get_all($sql, $db);

	if($service_list){

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


<h2><b><?php print $hall_data['hall_name']; ?></b></h2>

<span style="font-size: 16pt;color: #FF0000;"><b>
<?php print nl2br($hall_data['characteristic']); ?>
</b></span>
<hr>
<div class="bukken_bg">
<table class="main">
<tr>
<td class="bukken" rowspan="2">

<img src='./img.php?filename=<?php print $hall_image[0]['image_filename']; ?>' width='270' height='360' alt="<?php print $hall_image[0]['title']; ?>">

</td>
<td class="map">

<img src='./img.php?filename=<?php print $hall_image[1]['image_filename']; ?>' width='300' height='309' alt="<?php print $hall_image[1]['title']; ?>">

</td>
</tr>
<tr><td class="btn">
<a href="./?m=admin&a=page_hall_access_preview&h=({$hall_data.hall_id})" target="blank"><img src="./atoffice/img/btn_access.jpg" alt="詳細アクセスはコチラ" /></a></td>
</tr>
</table>
</div>


<div id="price">
<a name="price"></a>
<h2><b>ご利用料金</b></h2>
<div class="catch"></div>
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#cccccc">
<tr>
<th scope="col">部屋名</th>
<th scope="col">定員数</th>
<th scope="col">ご利用時間</th>
<th scope="col">ご利用料金</th>
</tr>

<?php 

foreach($room_data as $key=>$value){

print "<tr>";
if ($key%2==1){
	print "<td bgcolor=#F0F0F0>";
}else{
	print "<td>";
}
print "<a href='./?hid=".$hall_data['hall_id']."&rid=".$value['room_id']."'>".$value['room_name']."</a></td>";
if ($key%2==1){
	print "<td bgcolor=#F0F0F0>";
}else{
	print "<td>";
}
print "スクール：".$value['num_school']."人<br>";
print "　口の字：".$value['num_mouth']."人<br>";
print "シアター：".$value['num_theater']."人<br>";
print "</td>";
if ($key%2==1){
	print "<td bgcolor=#F0F0F0>";
}else{
	print "<td>";
}
print $hall_data['begin'].":00<br>～<br>".$hall_data['finish'].":00
</td>";
if ($key%2==1){
	print "<td bgcolor=#F0F0F0>";
}else{
	print "<td>";
}
if ($value['type']==1){
	// 池袋タイプ

	print "<div align=left>";
	print "1コマ目：　".$value['begin_time1'].":00 ～ ".$value['finish_time1'].":00　".$value['price1']."円<br>";

	if($value['price2']){
		print "2コマ目：　".$value['begin_time2'].":00 ～ ".$value['finish_time2'].":00　".$value['price2']."円<br>";
	}

	if($value['price3']){
		print "3コマ目：　".$value['begin_time3'].":00 ～ ".$value['finish_time3'].":00　".$value['price3']."円<br>";
	}

	if($value['price4']){
		print "4コマ目：　".$value['begin_time4'].":00 ～ ".$value['finish_time4'].":00　".$value['price4']."円<br>";
	}

	if($value['price5']){
		print "5コマ目：　".$value['begin_time5'].":00 ～ ".$value['finish_time5'].":00　".$value['price5']."円<br>";
	}

	if($value['price6']){
		print "6コマ目：　".$value['begin_time6'].":00 ～ ".$value['finish_time6'].":00　".$value['price6']."円<br>";
	}

	if($value['price7']){
		print "7コマ目：　".$value['begin_time7'].":00 ～ ".$value['finish_time7'].":00　".$value['price7']."円<br>";
	}
	print "</div>";

}else{
	// 神田タイプ

	print "<div align=left>";
	print "1コマあたりの時間は、";
	if ($value['koma']<1){
		if ($value['koma']==0.25){
			print "15分";
		}else{
			print "30分";
		}
	}else{
		print $value['koma']."時間";
	}

	print "です。<br>";

	print "最低".$value['lowest_koma']."コマから予約できます。<br><br>";
	print "1コマあたりのお値段は、<br>";

	if ($value.k_lowest_price){
		print $value['k_capa_lowest']."人まで　".$value['k_lowest_price']."円<br>";
	}

	if ($value['k_price2']){
		print $value['k_capa_low2']."人～".$value['k_capa_high2']."　".$value['k_price2']."円<br>";
	}

	if ($value['k_price3']){
		print $value['k_capa_low3']."人～".$value['k_capa_high3']."　".$value['k_price3']."円<br>";
	}

	if ($value['k_highest_price']){
		print $value['k_capa_highest']."人以上　".$value['k_highest_price']."円<br>";
	}
	print "となっております。";

	print "</div>";
}
print "</td>";
print "</tr>";
}
?>

</table>
</div>
<br>
<p><span class="notice">※準備・入室・退室はご利用時間内にお願いいたします。</span><br />
※時間内に退室いただけず、他の利用者に損害が生じた場合、その損害賠償をいただく場合がございます。<br />
※１時間単位でのご予約はお受けできかねます。各部屋のお得なパックプランをご利用ください。<br />
※机や椅子を移動された場合は、退室前に必ず元の状態にお戻しください。<br />
※ご利用後、ご利用者自身にごみをお持ち帰りいただきます。</p><br />
<br>

<div id="photo" align=center>
<?php 
if ($hall_image[3]['image_filename'] and $hall_image[2]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[3]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[3]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[2]['image_filename']."' alt=".$hall_image[2]['title']." width='181' height='136' border='0' /></a>";
}

if ($hall_image[5]['image_filename'] and $hall_image[4]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[5]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[5]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[4]['image_filename']."' alt=".$hall_image[4]['title']." width='181' height='136' border='0' /></a>";
}

if ($hall_image[7]['image_filename'] and $hall_image[6]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[7]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[7]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[6]['image_filename']."' alt=".$hall_image[6]['title']." width='181' height='136' border='0' /></a>";
}


print "<br>";


if ($hall_image[9]['image_filename'] and $hall_image[8]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[9]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[9]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[8]['image_filename']."' alt=".$hall_image[8]['title']." width='88' height='66' border='0' /></a>";
}

if ($hall_image[11]['image_filename'] and $hall_image[10]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[11]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[11]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[10]['image_filename']."' alt=".$hall_image[10]['title']." width='88' height='66' border='0' /></a>";
}

if ($hall_image[13]['image_filename'] and $hall_image[12]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[13]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[13]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[12]['image_filename']."' alt=".$hall_image[12]['title']." width='88' height='66' border='0' /></a>";
}

if ($hall_image[15]['image_filename'] and $hall_image[14]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[15]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[15]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[14]['image_filename']."' alt=".$hall_image[14]['title']." width='88' height='66' border='0' /></a>";
}

if ($hall_image[17]['image_filename'] and $hall_image[16]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[17]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[17]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[16]['image_filename']."' alt=".$hall_image[16]['title']." width='88' height='66' border='0' /></a>";
}

if ($hall_image[19]['image_filename'] and $hall_image[18]['image_filename']){
	print "<a href='./img.php?filename=".$hall_image[19]['image_filename']."' id='thumb1' class='highslide' onclick='return hs.expand(this)' title=".$hall_image[19]['title'].">";
	print "<img src='./img.php?filename=".$hall_image[18]['image_filename']."' alt=".$hall_image[18]['title']." width='88' height='66' border='0' /></a>";
}
?>

<br />
※画像クリックで拡大</div>
<br />

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