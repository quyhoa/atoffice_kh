<?php

function db_get_all($sql, $db){
	$rows = array();
	$result = mysql_query($sql, $db);
	while($item = mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}
	require_once("../../at_office_config.php");
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

	//var_dump($_REQUEST);

	if(isset($_REQUEST['hid']) && $_REQUEST['hid']){
		$hall_id = $_REQUEST['hid'];
	}elseif(isset($_REQUEST['amp;hid']) && $_REQUEST['amp;hid']){
		$hall_id = $_REQUEST['amp;hid'];
	}
	if(isset($_REQUEST['amp;rid']) && $_REQUEST['amp;rid']){
		$room_id = $_REQUEST['amp;rid'];
	}elseif(isset($_REQUEST['rid']) && $_REQUEST['rid']){
		$room_id = $_REQUEST['rid'];
	}

	if(isset($_REQUEST["amp;page"]) && $_REQUEST["amp;page"]){
		$page = $_REQUEST["amp;page"];
	}elseif(isset($_REQUEST["page"]) && $_REQUEST["page"]){
		$page = $_REQUEST["page"];
	}
	if(isset($_REQUEST['amp;reserve_id']) && $_REQUEST['amp;reserve_id']){
		$reserve_id = $_REQUEST['amp;reserve_id'];
	}elseif(isset($_REQUEST['reserve_id']) && $_REQUEST['reserve_id']){
		$reserve_id = $_REQUEST['reserve_id'];
	}
	if(isset($_REQUEST['amp;u']) && $_REQUEST['amp;u']){
		$u = $_REQUEST['amp;u'];
	}elseif(isset($_REQUEST['u']) && $_REQUEST['u']){
		$u = $_REQUEST['u'];
	}

	if(isset($_REQUEST['amp;pre_id']) && $_REQUEST['amp;pre_id']){
		$pre_id = $_REQUEST['amp;pre_id'];
	}elseif(isset($_REQUEST['pre_id']) && $_REQUEST['pre_id']){
		$pre_id = $_REQUEST['pre_id'];
	}

	// 今日の日付
	$date_flag = 0;
	if(isset($_REQUEST['amp;target_year']) && $_REQUEST['amp;target_year']){
		if(isset($_REQUEST['amp;target_month']) && $_REQUEST['amp;target_month']==0){
			$year = $_REQUEST['amp;target_year']-1;
		}elseif(isset($_REQUEST['amp;target_month']) && $_REQUEST['amp;target_month']==13){
			$year = $_REQUEST['amp;target_year']+1;
		}else{
			$year = $_REQUEST['amp;target_year'];
		}
	}elseif(isset($_REQUEST['target_year']) && $_REQUEST['target_year']){
		if(isset($_REQUEST['target_month']) && $_REQUEST['target_month']==0){
			$year = $_REQUEST['target_year']-1;
		}elseif(isset($_REQUEST['target_month']) && $_REQUEST['target_month']==13){
			$year = $_REQUEST['target_year']+1;
		}else{
			$year = $_REQUEST['target_year'];
		}
	}else{
		$year = date("Y");
		$date_flag=1;
	}

	if(!empty($_REQUEST['amp;target_month']) and $_REQUEST['amp;target_year']){
		if(strval($_REQUEST['amp;target_month'])==0){
			$month = 12;
		}elseif($_REQUEST['amp;target_month']==13){
			$month = 1;
		}else{
			$month = $_REQUEST['amp;target_month'];
		}
	}elseif(!empty($_REQUEST['target_month']) and $_REQUEST['target_year']){
		if(strval($_REQUEST['target_month'])==0){
			$month = 12;
		}elseif($_REQUEST['target_month']==13){
			$month = 1;
		}else{
			$month = $_REQUEST['target_month'];
		}
	}else{
		$month = date("m");
		$date_flag=1;
	}
	$this_year = date("Y");
	$this_month = date("m");
	$today = date("d");
	$today_f = $today;

	if($year==$this_year and $month==$this_month){
		$date_flag=1;
	}

// 予約最短日に修正(3日後)


for($x=1;$x<=3;$x++){
	$today++;
	if(!checkdate($this_month, $today, $this_year)){
		$this_month++;
		$today=1;
		if(!checkdate($this_month, $today, $this_year)){
			$this_year++;
			$this_month=1;
		}
	}
}


	$wtop = date('w',mktime(0,0,0,$month,1,$year));

	// 予約受付範囲取得
	$hall_id = isset($hall_id) ? $hall_id : '';
	$sql = "select reservation_month from a_hall where hall_id = $hall_id";
	$limit_month = db_get_all($sql, $db);
	$limit_month = isset($limit_month[0]['reservation_month']) ? $limit_month[0]['reservation_month'] : 0;
	$reserve_limit_year = $this_year;
	$reserve_limit_month = $this_month + $limit_month;
	if($reserve_limit_month > 12){
		$reserve_limit_year+=1;
		$reserve_limit_month-=12;
	}

$a = $reserve_limit_year.sprintf("%02d", $reserve_limit_month);
$b = $year.$month;

if($a==$b){
	$month--;
	if($month==0){
		$month=12;
		$year--;
	}
}

	// type
	$room_id = isset($room_id) ? $room_id : '';
	$sql = "select type from a_room where hall_id = $hall_id and room_id = $room_id";
	$type=db_get_all($sql, $db);
	$type= isset($type[0]['type']) ? $type[0]['type'] : null;


	// 会場の休日データ取得
	// 定休日
	$sql = "select * from a_hall_regular_holiday where hall_id = $hall_id";
	$hall_regular_data = db_get_all($sql, $db);
	$hall_regular_data = isset($hall_regular_data[0]) ? $hall_regular_data[0] : null;

	// 指定日
	$sql = "select * from a_hall_holiday where hall_id = $hall_id";
	$hall_holiday_list = db_get_all($sql, $db);

	// 部屋の休日データ取得
	// 定休日
	$sql = "select * from a_room_regular_holiday where hall_id = $hall_id";
	$sql.= " and room_id = $room_id";

	$room_regular_data = db_get_all($sql, $db);
	$room_regular_data = isset($room_regular_data[0]) ? $room_regular_data[0] : null;

	// 指定日
	$sql = "select * from a_room_holiday where hall_id = $hall_id";
	$sql.= " and room_id = $room_id";
	$room_holiday_list = db_get_all($sql, $db);

	$day_list = array();
	$key=0;
	for($day = 1; checkdate($month, $day, $year); $day++ ){
		$day_list[$key]['day']=$day;
		$day_list[$key]['week']=$wtop_d;
		$day_list[$key]['week_num'] = date('w',mktime(0,0,0,$month,$day,$year));

		// 定休日

		// 会場-月
		if($hall_regular_data['january'] and $month==1){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['february'] and $month==2){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['march'] and $month==3){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['april'] and $month==4){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['may'] and $month==5){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['june'] and $month==6){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['july'] and $month==7){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['august'] and $month==8){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['september'] and $month==9){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['october'] and $month==10){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['november'] and $month==11){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['december'] and $month==12){
			$day_list[$key]['hall_holiday']=1;
		}

		// 会場-週

		$week = date('w',mktime(0,0,0,$month,$day,$year));

		if($hall_regular_data['monday'] and $week==1){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['tuesday'] and $week==2){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['wednesday'] and $week==3){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['thursday'] and $week==4){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['friday'] and $week==5){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['saturday'] and $week==6){
			$day_list[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['sunday'] and $week==0){
			$day_list[$key]['hall_holiday']=1;
		}


		// 部屋定休日

		// 部屋-月
		if($room_regular_data['january'] and $month==1){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['february'] and $month==2){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['march'] and $month==3){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['april'] and $month==4){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['may'] and $month==5){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['june'] and $month==6){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['july'] and $month==7){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['august'] and $month==8){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['september'] and $month==9){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['october'] and $month==10){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['november'] and $month==11){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['december'] and $month==12){
			$day_list[$key]['room_holiday']=1;
		}

		// 部屋-週

		$week = date('w',mktime(0,0,0,$month,$day,$year));

		if($room_regular_data['monday'] and $week==1){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['tuesday'] and $week==2){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['wednesday'] and $week==3){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['thursday'] and $week==4){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['friday'] and $week==5){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['saturday'] and $week==6){
			$day_list[$key]['room_holiday']=1;
		}
		if($room_regular_data['sunday'] and $week==0){
			$day_list[$key]['room_holiday']=1;
		}


		// 会場の定休日
		$sql = "select day$day from a_hall_regular_holiday where hall_id = $hall_id";
		$result = db_get_all($sql, $db);
		if($result[0]['day'.$day]){
			$day_list[$key]['hall_holiday']=1;
		}

		// 会場の指定日
		$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]['hall_id']){
			$day_list[$key]['hall_holiday']=1;
		}

		// 部屋の定休日
		$sql = "select day$day from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
		$result = db_get_all($sql, $db);
		if($result[0]['day'.$day]){
			$day_list[$key]['room_holiday']=1;
		}

		// 部屋の指定日
		$sql = "select * from a_room_holiday where hall_id = $hall_id and room_id = $room_id and year = $year and month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]['hall_id']){
			$day_list[$key]['room_holiday']=1;
		}

		// 選択月の祝日
		$sql = "select * from c_holiday where month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]){
			$day_list[$key]['holiday_jp']=$result[0];
			if($hall_regular_data['holiday']){
				$day_list[$key]['hall_holiday']=1;
			}
			if($room_regular_data['holiday']){
				$day_list[$key]['room_holiday']=1;
			}
		}

		// 予約チェック
		//$day_list[$key]['reserved']=check_reserve($hall_id, $room_id, $year, $month, $day, $db);

		$key++;
		$wtop_d++;
		if($wtop_d>6){
			$wtop_d=0;
		}
	}

/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////

	$day_list2 = array();
	$next_month = $month+1;
	if($next_month>=13){
		$next_month = 1;
		$next_year = $year+1;
	}else{
		$next_year = $year;
	}
	$wtop2 = date('w',mktime(0,0,0,$next_month,1,$next_year));
	$key=0;
	for($day = 1; checkdate($next_month, $day, $next_year); $day++ ){
		$day_list2[$key]['day']=$day;
		$day_list2[$key]['week']=$wtop_d;
		$day_list2[$key]['week_num'] = date('w',mktime(0,0,0,$next_month,$day,$next_year));

		// 定休日

		// 会場-月
		if($hall_regular_data['january'] and $next_month==1){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['february'] and $next_month==2){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['march'] and $next_month==3){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['april'] and $next_month==4){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['may'] and $next_month==5){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['june'] and $next_month==6){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['july'] and $next_month==7){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['august'] and $next_month==8){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['september'] and $next_month==9){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['october'] and $next_month==10){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['november'] and $next_month==11){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['december'] and $next_month==12){
			$day_list2[$key]['hall_holiday']=1;
		}

		// 会場-週

		$next_week = date('w',mktime(0,0,0,$next_month,$day,$next_year));

		if($hall_regular_data['monday'] and $next_week==1){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['tuesday'] and $next_week==2){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['wednesday'] and $next_week==3){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['thursday'] and $next_week==4){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['friday'] and $next_week==5){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['saturday'] and $next_week==6){
			$day_list2[$key]['hall_holiday']=1;
		}
		if($hall_regular_data['sunday'] and $next_week==0){
			$day_list2[$key]['hall_holiday']=1;
		}


		// 部屋定休日

		// 部屋-月
		if($room_regular_data['january'] and $next_month==1){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['february'] and $next_month==2){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['march'] and $next_month==3){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['april'] and $next_month==4){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['may'] and $next_month==5){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['june'] and $next_month==6){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['july'] and $next_month==7){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['august'] and $next_month==8){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['september'] and $next_month==9){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['october'] and $next_month==10){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['november'] and $next_month==11){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['december'] and $next_month==12){
			$day_list2[$key]['room_holiday']=1;
		}

		// 部屋-週

		$next_week = date('w',mktime(0,0,0,$next_month,$day,$next_year));

		if($room_regular_data['monday'] and $next_week==1){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['tuesday'] and $next_week==2){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['wednesday'] and $next_week==3){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['thursday'] and $next_week==4){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['friday'] and $next_week==5){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['saturday'] and $next_week==6){
			$day_list2[$key]['room_holiday']=1;
		}
		if($room_regular_data['sunday'] and $next_week==0){
			$day_list2[$key]['room_holiday']=1;
		}


		// 会場の定休日
		$sql = "select day$day from a_hall_regular_holiday where hall_id = $hall_id";
		$result = db_get_all($sql, $db);
		if($result[0]['day'.$day]){
			$day_list2[$key]['hall_holiday']=1;
		}

		// 会場の指定日
		$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $next_month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]['hall_id']){
			$day_list2[$key]['hall_holiday']=1;
		}

		// 部屋の定休日
		$sql = "select day$day from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
		$result = db_get_all($sql, $db);
		if($result[0]['day'.$day]){
			$day_list2[$key]['room_holiday']=1;
		}

		// 部屋の指定日
		$sql = "select * from a_room_holiday where hall_id = $hall_id and room_id = $room_id and year = $year and month = $next_month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]['hall_id']){
			$day_list2[$key]['room_holiday']=1;
		}

		// 選択月の祝日
		$sql = "select * from c_holiday where month = $next_month and day = $day";
		$result = db_get_all($sql, $db);
		if($result[0]){
			$day_list2[$key]['holiday_jp']=$result[0];
			if($hall_regular_data['holiday']){
				$day_list2[$key]['hall_holiday']=1;
			}
			if($room_regular_data['holiday']){
				$day_list2[$key]['room_holiday']=1;
			}
		}

		// 予約チェック
		//$day_list2[$key]['reserved']=check_reserve($hall_id, $room_id, $next_year, $next_month, $day, $db);

		$key++;
		$wtop_d++;
		if($wtop_d>6){
			$wtop_d=0;
		}
	}


function check_reserve($hall_id, $room_id, $year, $month, $day, $db){

// 予約チェック

	$begin_datetime = $year."-".$month."-".$day." "."00:00:00";
	$finish_datetime = $year."-".$month."-".$day." "."23:59:59";

	// 通常予約
	$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag=0 and ('$begin_datetime' <= begin_datetime and '$finish_datetime' >= finish_datetime)";
	$reserve_flag = db_get_all($sql, $db);
	// 貸し止め
	$sql = "select count(stop_id) as stop from a_rental_stop where hall_id = $hall_id and room_id = $room_id and ('$begin_datetime' <= begin_datetime and '$finish_datetime' >= finish_datetime) and limit_datetime > now()";
	$stop_flag = db_get_all($sql, $db);

	if($reserve_flag[0]['reserve'] or $stop_flag[0]['stop']){
		return(1);
	}else{
		return(0);
	}

}


?>

<body>
<a name="calendar" id="calendar"></a>
<div class="side_btn">

<h2>
<span style="font-size:12px;">
<center><b>日付を選択してください</b></center>
</span>
</h2>

<table border=1>
<tr>
<td colspan=2 style="text-align:left;">

<?php 
	if(!($this_year>=$year and $this_month>=$month)){
	
?>

<form method="POST" action="javascript:LoadHTML('Calendar', 'side/calendar2.php?hid=<?php print $hall_id; ?>&rid=<?php print $room_id; ?>&target_year=<?php print $year; ?>&target_month=<?php print ($month-1); ?>&page=<?php print $page; ?><?php if($reserve_id) print "&reserve_id=".$reserve_id; ?><?php if($u) print "&u=$u"; ?><?php if($pre_id) print "&pre_id=$pre_id"; ?>');">

<input type='submit' value='<' style='width=20px;border:3px ridge;background:#CDCDCD;color:#FFFFFF; padding:3px; font-weight:bold;cursor: pointer;'>
</form>

<?php
	}
?>

</td>
<td colspan=3 style="text-align:center;">

<?php print $year; ?>年<?php print $month; ?>月

</td><td colspan=2 style="text-align:right;">

<?php
	if(!($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month)){
?>

<form method="POST" action="javascript:LoadHTML('Calendar', 'side/calendar2.php?hid=<?php print $hall_id; ?>&rid=<?php print $room_id; ?>&target_year=<?php print $year; ?>&target_month=<?php print ($month+1); ?>&page=<?php print $page; ?><?php if($reserve_id) print "&reserve_id=".$reserve_id; ?><?php if($u) print "&u=$u"; ?><?php if($pre_id) print "&pre_id=$pre_id"; ?>');">

<input type='submit' value='>' style='width=20px;border:3px ridge;background:#CDCDCD;color:#FFFFFF; padding:3px; font-weight:bold;cursor: pointer;'>
</form>

<?php
	}
?>

</td>
</tr>
<tr>

<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;"><span style="color:#FF0000">日</span></td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">月</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">火</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">水</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">木</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">金</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;"><span style="color:#0000FF">土</span></td>
</tr>
<?php
	if ($wtop>0){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop>1){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop>2){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop>3){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop>4){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop>5){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}

	foreach($day_list as $key=>$item){

		$code = "<td style='text-align:center;border: 1px #ABABAB solid;font-size:11px;' ";
		//({*** 過ぎた日 ***})
		if($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)){
			$code.= "bgcolor=#D0D0D0 ";
		}else{
			//({*** 定休日 ***})
			if($item['room_holiday'] or $item['hall_holiday']){
				$code.= "bgcolor=#FFDDDD ";
			}elseif($item['reserved']){
				// 予約あり
				//$code.= "bgcolor=#FFDCDC ";
				$code.= "bgcolor=#E6FFDC ";
			}else{
				// 予約なし
				$code.= "bgcolor=#E6FFDC ";
			}
		}

		$code.= ">";

		//({*** 祝日文字色  ***})
		if($item['holiday_jp']['day'] == $item['day'] or $item['week_num']==0){
				if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !($item['room_holiday'] or $item['hall_holiday'])){


				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$year."&month=".$month."&day=".$item['day'];
				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #FF0000;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #FF0000;'><b>".$item['day']."</b></span>";
				}
		}elseif($item['week_num']==6){

				if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !($item['room_holiday'] or $item['hall_holiday'])){


				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$year."&month=".$month."&day=".$item['day'];

				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #0000FF;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #0000FF;'><b>".$item['day']."</b></span>";
				}

		}else{
			

			if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !($item['room_holiday'] or $item['hall_holiday'])){


				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$year."&month=".$month."&day=".$item['day'];

				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #000000;'>".$item['day']."</span></a>";
			}else{
				$code.= $item['day'];
			}

		}

		$code.="</td>";
		if($wtop==0 and ($key+1)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==1 and ($key+2)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==2 and ($key+3)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==3 and ($key+4)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==4 and ($key+5)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==5 and ($key+6)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop==6 and ($key+7)%7==0){
			$code.= "</tr><tr>";
		}

		print $code;

	}// foreach
?>
</tr>
</table>

<table border=1>
<tr>
<td colspan=2 style="text-align:left;">


</td>
<td colspan=3 style="text-align:center;">

<?php print $next_year; ?>年<?php print $next_month; ?>月

</td><td colspan=2 style="text-align:right;">


</td>
</tr>
<tr>

<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;"><span style="color:#FF0000">日</span></td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">月</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">火</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">水</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">木</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;">金</td>
<td width=25 style="text-align:center;margin:2px;border: 1px #ABABAB solid;"><span style="color:#0000FF">土</span></td>
</tr>
<?php
	if ($wtop2>0){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop2>1){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop2>2){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop2>3){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop2>4){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}
	if($wtop2>5){
		print "<td style='text-align:center;border: 1px #ABABAB solid;'></td>";
	}

	foreach($day_list2 as $key=>$item){

		$code = "<td style='text-align:center;border: 1px #ABABAB solid;font-size:11px;' ";

		// 最終月の開いた日より後の日付
		if($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month and $today_f < $item['day']){
			$code.= "bgcolor=#D0D0D0 ";
		}else{
			//({*** 定休日 ***})
			if($item['room_holiday'] or $item['hall_holiday']){
				$code.= "bgcolor=#FFDDDD ";
			}elseif($item['reserved']){
				// 予約あり
				//$code.= "bgcolor=#FFDCDC ";
				$code.= "bgcolor=#E6FFDC ";
			}else{
				// 予約なし
				$code.= "bgcolor=#E6FFDC ";
			}
		}


		$code.= ">";

		//({*** 祝日文字色  ***})
		if($item['holiday_jp']['day'] == $item['day'] or $item['week_num']==0){
				if(!($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month and $today_f < $item['day'])){
				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$next_year."&month=".$next_month."&day=".$item['day'];
				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #FF0000;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #FF0000;'><b>".$item['day']."</b></span>";
				}
		}elseif($item['week_num']==6){

				if(!($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month and $today_f < $item['day'])){
				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$next_year."&month=".$next_month."&day=".$item['day'];

				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #0000FF;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #0000FF;'><b>".$item['day']."</b></span>";
				}

		}else{

			if(!($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month and $today_f < $item['day'])){

				$code.= "<a href='javascript:LoadHTML(\"AppContentInput\", \"".$page.".php?hid=".$hall_id."&rid=".$room_id."&year=".$next_year."&month=".$next_month."&day=".$item['day'];

				if($reserve_id){
					$code.="&reserve_id=".$reserve_id;
				}
				if($u){
					$code.="&u=$u";
				}
				if($pre_id){
					$code.="&pre_id=$pre_id";
				}

				$code.="\")'><span style='color: #000000;'>".$item['day']."</span></a>";
			}else{
				$code.= $item['day'];
			}

		}

		$code.="</td>";
		if($wtop2==0 and ($key+1)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==1 and ($key+2)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==2 and ($key+3)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==3 and ($key+4)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==4 and ($key+5)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==5 and ($key+6)%7==0){
			$code.= "</tr><tr>";
		}
		if($wtop2==6 and ($key+7)%7==0){
			$code.= "</tr><tr>";
		}

		print $code;

	}// foreach
?>
</tr>
</table>

</body>
