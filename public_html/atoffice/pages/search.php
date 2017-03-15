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

// POST　data
	//var_dump($_REQUEST);

	// hall
	if($_REQUEST['amp;hall_id']){
		$hall_id = $_REQUEST['amp;hall_id'];
	}
	if($_REQUEST['amp;ken']){
		$ken=$_REQUEST['amp;ken'];

	}
	if($_REQUEST['amp;line']){
		$line=$_REQUEST['amp;line'];

	}
	if($_REQUEST['amp;station']){
		$station=$_REQUEST['amp;station'];

	}

	// room
	if($_REQUEST['amp;conference']){
		$conference=$_REQUEST['amp;conference'];
	}
	if($_REQUEST['amp;seminar']){
		$seminar=$_REQUEST['amp;seminar'];
	}
	if($_REQUEST['amp;training']){
		$training=$_REQUEST['amp;training'];
	}
	if($_REQUEST['amp;interview']){
		$interview=$_REQUEST['amp;interview'];
	}
	if($_REQUEST['amp;party']){
		$party=$_REQUEST['amp;party'];
	}
	if($_REQUEST['amp;etc']){
		$etc=$_REQUEST['amp;etc'];
	}
	if($_REQUEST['amp;index']){
		$index = $_REQUEST['amp;index'];
	}else{
		$index = 0;
	}
	if($_REQUEST['amp;sort']){
		$sort = $_REQUEST['amp;sort'];
	}else{
		$sort = 0;
	}

// 会場リスト
	$sql = "select * from a_hall where flag!=2";
	$hall_list = db_get_all($sql, $db);

// 条件にあった会場取得
	$sql = "select * from a_hall where flag!=2 and ";
	if($hall_id){
		$sql.= "hall_id = $hall_id and ";
	}
	if($ken){
		$sql.= "address_prefecture = $ken and ";
	}
	if($line){
		$sql.= "(line1='$line' or line2='$line' or line3='$line') and ";
	}
	if($station){
		$sql.= "(station1='$station' or station2='$station' or station3='$station') and ";
	}
	$sql = substr($sql, 0, (strlen($sql)-4));

	//print $sql."<br>";
	$hall_data = db_get_all($sql, $db);


// 画像
	foreach($hall_data as $key=>$value){
		$sql = "select image_filename from a_hall_image where hall_id = ".$value['hall_id']." and image_id = 1";
		$result = db_get_all($sql, $db);
		$hall_data[$key]['image_filename']=$result[0]['image_filename'];
	}

// 条件に合った会場の有効な部屋

	if($hall_data){

		$search_list = array();
		$r=0;

		//全体数

		$sql = "select count(*) as count from a_room where flag=1 and ";
		foreach($hall_data as $key=>$value){
			$sql.="hall_id = ".$value['hall_id']." or ";
		}
		$sql = substr($sql, 0, (strlen($sql)-4));
		$sql.= " and ";
		if($conference){
			$sql.= "conference=1 and ";
		}
		if($seminar){
			$sql.= "seminar=1 and ";
		}
		if($training){
			$sql.= "training=1 and ";
		}
		if($interview){
			$sql.= "interview=1 and ";
		}
		if($party){
			$sql.= "party=1 and ";
		}
		if($etc){
			$sql.= "etc=1 and ";
		}

		$sql = substr($sql, 0, (strlen($sql)-4));

		//print $sql;
		$count = db_get_all($sql, $db);
		$count = $count[0]['count'];

		// データ取得

		$sql = "select * from a_room where flag=1 and ";
		foreach($hall_data as $key=>$value){
			$sql.="hall_id = ".$value['hall_id']." or ";
		}
		$sql = substr($sql, 0, (strlen($sql)-4));
		$sql.= " and ";
		if($conference){
			$sql.= "conference=1 and ";
		}
		if($seminar){
			$sql.= "seminar=1 and ";
		}
		if($training){
			$sql.= "training=1 and ";
		}
		if($interview){
			$sql.= "interview=1 and ";
		}
		if($party){
			$sql.= "party=1 and ";
		}
		if($etc){
			$sql.= "etc=1 and ";
		}
		$sql = substr($sql, 0, (strlen($sql)-4));

		// ソート

		if($sort==1){
			//スクール多い順
			$sql.= "order by num_school DESC ";
		}
		if($sort==2){
			//口の字多い順
			$sql.= "order by num_mouth DESC ";
		}
		if($sort==3){
			//シアター多い順
			$sql.= "order by num_theater DESC ";
		}


		
		$sql.= " limit ".$index.", 10";
		//print $sql;
		$result=db_get_all($sql, $db);
		if($result){
			foreach($result as $k=>$v){

				$sql= "select * from a_hall where hall_id=".$v['hall_id'];
				//print "<br>".$sql."<br>";
				$hall_data = db_get_all($sql, $db);

				$hall_data[0]['ken']=get_option_name($hall_data[0]['address_prefecture'], $db);
				$hall_data[0]['trans1']=get_option_name($hall_data[0]['transportation1'], $db);
				$hall_data[0]['trans2']=get_option_name($hall_data[0]['transportation2'], $db);
				$hall_data[0]['trans3']=get_option_name($hall_data[0]['transportation3'], $db);
				$hall_data[0]['room_id']=$v['room_id'];

				$serch_list[$r]['hall_data']=$hall_data[0];
				$serch_list[$r]['room_data']=$v;
				$r++;
			}
		}

	}

// 会場データでソート
	if($sort==0){
		$time1=array();
		foreach($serch_list as $key=>$value){
			array_push($time1, $value['hall_data']['time1']);
		}
		array_multisort($time1,SORT_ASC,$serch_list);
	}



// 有効な会場のある都道府県
	$address_list = array();
	for($x=7;$x<=54;$x++){
		$sql = "select count(*) as find from a_hall where flag!=2 and address_prefecture=$x";
		$result = db_get_all($sql, $db);
		if($result[0]['find']){
			$sql = "select * from c_profile_option where c_profile_option_id = $x";
			$address = db_get_all($sql, $db);
			array_push($address_list, $address[0]);
		}

	}
// 有効な会場のある路線
	$sql = "select * from a_hall where flag!=2";
	$result = db_get_all($sql, $db);

	$line_list = array();
	$station_list = array();

	foreach($result as $value){
		if($value['line1'] and !in_array($value['line1'], $line_list)){
			array_push($line_list, $value['line1']);
		}
		if($value['line2'] and !in_array($value['line2'], $line_list)){
			array_push($line_list, $value['line2']);
		}
		if($value['line3'] and !in_array($value['line3'], $line_list)){
			array_push($line_list, $value['line3']);
		}
		if($value['station1'] and !in_array($value['station1'], $station_list)){
			array_push($station_list, $value['station1']);
		}
		if($value['station2'] and !in_array($value['station2'], $station_list)){
			array_push($station_list, $value['station2']);
		}
		if($value['station3'] and !in_array($value['station3'], $station_list)){
			array_push($station_list, $value['station3']);
		}


	}

function get_option_name($option_id, $db){
	$sql = "select value from c_profile_option where c_profile_option_id = $option_id";
	$id = db_get_all($sql, $db);
	return $id[0]['value'];
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


<h2><b>会議室検索</b></h2>

<form method="POST" name="search" action="./">
<input type="hidden" name="page" value="search">

<div class="kaijo_bg">
<div class="kaijo_in">

会場名：
<select name="hall_id">
<option value=''>-選択-</option>
<?php
	foreach($hall_list as $value){
		$code = "<option value=".$value['hall_id'];
		if($hall_id==$value['hall_id']){
			$code.= " selected";
		}
		$code.= ">".$value['hall_name']."</option>";
		print $code;
	}
?>
</select>

<br>

都道府県：
<select name="ken">
<option value=''>-選択-</option>
<?php
	foreach($address_list as $value){
		$code = "<option value=".$value['c_profile_option_id'];
		if($ken==$value['c_profile_option_id']){
			$code.= " selected";
		}
		$code.= ">".$value['value']."</option>";
		print $code;
	}
?>
</select>

<br>

路線：
<select name="line">
<option value=''>-選択-</option>
<?php
	foreach($line_list as $value){
		$code = "<option value=".$value;
		if($line==$value){
			$code.= " selected";
		}
		$code.= ">".$value."線</option>";
		print $code;
	}
?>
</select>

最寄駅：

<select name="station">
<option value=''>-選択-</option>
<?php
	foreach($station_list as $value){
		$code = "<option value=".$value;
		if($station==$value){
			$code.= " selected";
		}
		$code.= ">".$value."駅</option>";
		print $code;
	}
?>
</select>
<br>

<input type="checkbox" name="conference" value="1" <?php if($conference){ print "checked"; } ?>> 会議 
<input type="checkbox" name="seminar" value="1" <?php if($seminar){ print "checked"; } ?>> セミナー 
<input type="checkbox" name="training" value="1" <?php if($training){ print "checked"; } ?>> 研修 
<input type="checkbox" name="interview" value="1" <?php if($interview){ print "checked"; } ?>> 面接・試験 
<input type="checkbox" name="party" value="1" <?php if($party){ print "checked"; } ?>> 懇談会・パーティ 
<input type="checkbox" name="etc" value="1" <?php if($etc){ print "checked"; } ?>> その他 <br>
<hr>
<input type="radio" name="sort" value="0" <?php if($sort==0){ print "checked"; } ?>> 駅から近い順 
<br>
<input type="radio" name="sort" value="1" <?php if($sort==1){ print "checked"; } ?>> スクール型収容人数が多い順 
<input type="radio" name="sort" value="2" <?php if($sort==2){ print "checked"; } ?>> 口の字型収容人数が多い順 
<input type="radio" name="sort" value="3" <?php if($sort==3){ print "checked"; } ?>> シアター型収容人数が多い順 
<hr>

<center><input type="button" value="　リセット　" onClick="LoadHTML('AppContentInput', 'search.php')">
<input type="submit" value="　検索　"></center>

</div><!--kaijo_in_end-->
</div><!--kaijo_bg_end-->



<h2><b>検索結果 (
<?php 
	if ($serch_list){
		print $count."件中　";
		print ($index+1)."件～";

		if(($index+10) > $count){
			print $count;
		}else{
			print $index+10;
		}
		print "件を表示";
	}else{
		print "0件";
	}
?>
)</b></h2>

<div class="kaijo_bg">
<div class="kaijo_in">
<div ><div ></div></div>

<br>

<input type='hidden' name='index' value="">
<table width=550>
<tr>
<td style="text-align:right">
<?php
	if($count){

	if($index!=0){
		print "<input type='button' value='<<前へ' onClick=set_index(".($index-10).") style='width:60px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;'>";
	}

	for($x=1;$x<($count+10)/10;$x++){
		if( (($x*10)-10) == $index){
			print "<span style='border:3px ridge;background:#FF1111;color:#FFFFFF; padding:3px; font-weight:bold;'>$x</span>";
		}else{
			print "<input type='button' value='$x' onClick=set_index(".(($x*10)-10).") style='border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;'>";
		}
	}
	}

	if($index+10 <= $count){
		print "<input type='button' value='次へ>>' onClick=set_index(".($index+10).") style='width:60px;border:3px ridge;background:#090;color:#fff; padding:3px; font-weight:bold;'>";
	}

?>
</td>
</tr>
</table>

</form>
<br>
<center>


<?php
	if($serch_list){
	foreach($serch_list as $key=>$value){

		print "<table width=550 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#FFFFFF;'>";
		print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "施設名";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;'>";
		print $value['hall_data']['hall_name'];
		print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "部屋名";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;'>";
		print $value['room_data']['room_name'];
		print "</td>";
		print "</tr>";

		print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "住所";
		print "</td><td colspan=3>";
		print $value['hall_data']['ken'].$value['hall_data']['address_city'].$value['hall_data']['address_other'];
		if($value['hall_data']['google_maps']){
			print "<br>［<a href=".$value['hall_data']['google_maps']." style='color:#0000FF;text-align:left' target='_blank'>google mapsで地図を表示</a>］";
		}
		print "</td></tr>";
		if($sort==0){
			print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#FFD2C8;'>";
		}else{
			print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		}
		print "最寄駅1";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";
		print $value['hall_data']['line1']."線 ".$value['hall_data']['station1']."駅 ".$value['hall_data']['trans1'].$value['hall_data']['time1']."分";
		if($sort==1){
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#FFD2C8;'>";
		}else{
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		}
		print "スクール型";
		print "</td><td  width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";

		if($value['room_data']['num_school']){
			print $value['room_data']['num_school']."人まで収容可能";
		}else{
			print "<center>--</center>";
		}

		print "</td></tr>";
		print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "最寄駅2";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";
		if($value['hall_data']['line2']){
			print $value['hall_data']['line2']."線 ".$value['hall_data']['station2']."駅 ".$value['hall_data']['trans2'].$value['hall_data']['time2']."分";
		}else{
			print "<center>--</center>";
		}
		if($sort==2){
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#FFD2C8;'>";
		}else{
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		}
		print "口の字型";
		print "</td><td  width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";

		if($value['room_data']['num_mouth']){
			print $value['room_data']['num_mouth']."人まで収容可能";
		}else{
			print "<center>--</center>";
		}

		print "</td></tr>";
		print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "最寄駅3";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";
		if($value['hall_data']['line3']){
			print $value['hall_data']['line3']."線 ".$value['hall_data']['station3']."駅 ".$value['hall_data']['trans3'].$value['hall_data']['time3']."分";
		}else{
			print "<center>--</center>";
		}
		if($sort==3){
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#FFD2C8;'>";
		}else{
			print "</td><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		}
		print "シアター型";
		print "</td><td width=175 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";

		if($value['room_data']['num_theater']){
			print $value['room_data']['num_theater']."人まで収容可能";
		}else{
			print "<center>--</center>";
		}
		print "</td></tr>";

		print "<tr><td width=100 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;background-color:#E6FFDC;'>";
		print "ご利用料金";
		print "</td><td colspan=3 style='border: 1px #96FF8C solid;text-align: left;vertical-align:middle;'>";
			$price_list = array();
			if($value['room_data']['type']==1){
				for($x=1;$x<=7;$x++){
					if($value['room_data']['price'.$x]){
						array_push($price_list, $value['room_data']['price'.$x]);
					}
				}
				print "ご利用時間により、".number_format(min($price_list))."円 ～ ".number_format(max($price_list))."円 からご予約可能です。";

			}else{
				if($value['room_data']['k_lowest_price']){
					array_push($price_list, $value['room_data']['k_lowest_price']);
				}
				if($value['room_data']['k_price2']){
					array_push($price_list, $value['room_data']['k_price2']);
				}
				if($value['room_data']['k_price3']){
					array_push($price_list, $value['room_data']['k_price3']);
				}
				if($value['room_data']['k_highest_price']){
					array_push($price_list, $value['room_data']['k_highest_price']);
				}
				print "ご利用人数により、".number_format(min($price_list))."円 ～ ".number_format(max($price_list))."円 からご予約可能です。";

			}
		print "</td></tr>";

		print "<tr><td colspan=4 style='border: 1px #96FF8C solid;text-align: center;vertical-align:middle;'>";

			print "<form action='./' method='POST' name='reserve' id='reserve' style='{margin:0px;}'>";
	  		print "<input type='hidden' name='page' value='reserve' />";
          		print "<input type='hidden' name='hid' value=".$value['hall_data']['hall_id']." />";
			print "<input type='hidden' name='rid' value=".$value['room_data']['room_id']." />";
			print "<input type='image' name='button' src='./atoffice/img/btn_reserve.jpg' alt='空室確認・ご予約' />";
			print "</form>";

		print "</td></tr>";

		print "</table><br>";

	}
	}else{
		print "お探しの条件の会場は見つかりませんでした。";
	}
?>
</center>


<div class="clr"></div>

</div><!--kaijo_in_end-->
</div><!--kaijo_bg_end-->



</body>