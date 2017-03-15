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
	require_once("../../at_office_config.php");
	if(!isset($mysql_db)) $mysql_db="at_office";
$uid = isset($uid) ? $uid : '';
if(isset($_REQUEST['amp;uid']) && $_REQUEST['amp;uid']) $uid=$_REQUEST['amp;uid'];
else if(isset($_REQUEST['uid']) && $_REQUEST['uid']) $uid=$_REQUEST['uid'];
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

	if(!empty($_REQUEST['hid'])){
		$hall_id = $_REQUEST['hid'];
	}elseif(!empty($_REQUEST['amp;hid'])){
		$hall_id = $_REQUEST['amp;hid'];
	}
	if(!empty($_REQUEST['amp;rid'])){
		$room_id = $_REQUEST['amp;rid'];
	}elseif(!empty($_REQUEST['rid'])){
		$room_id = $_REQUEST['rid'];
	}

	if(!empty($_REQUEST["amp;page"])){
		$page = $_REQUEST["amp;page"];
	}elseif(!empty($_REQUEST["page"])){
		$page = $_REQUEST["page"];
	}
	if(!empty($_REQUEST['amp;reserve_id'])){
		$reserve_id = $_REQUEST['amp;reserve_id'];
	}elseif(!empty($_REQUEST['reserve_id'])){
		$reserve_id = $_REQUEST['reserve_id'];
	}
	if(!empty($_REQUEST['amp;u'])){
		$u = $_REQUEST['amp;u'];
	}elseif(!empty($_REQUEST['u'])){
		$u = $_REQUEST['u'];
	}

	if(!empty($_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}elseif(!empty($_REQUEST['pre_id'])){
		$pre_id = $_REQUEST['pre_id'];
	}

	// 今日の日付
	$date_flag = 0;
	if(!empty($_REQUEST['amp;target_year'])){
		if(isset($_REQUEST['amp;target_month']) && $_REQUEST['amp;target_month']==0){
			$year = $_REQUEST['amp;target_year']-1;
		}elseif(isset($_REQUEST['amp;target_month']) && $_REQUEST['amp;target_month']==13){
			$year = $_REQUEST['amp;target_year']+1;
		}else{
			$year = $_REQUEST['amp;target_year'];
		}
	}elseif(!empty($_REQUEST['target_year'])){
		if($_REQUEST['target_month']==0){
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

	// if(!is_null($_REQUEST['amp;target_month']) and $_REQUEST['amp;target_year']){
	if(!empty($_REQUEST['amp;target_month']) and $_REQUEST['amp;target_year']){
		if(strval($_REQUEST['amp;target_month'])==0){
			$month = 12;
		}elseif(isset($_REQUEST['amp;target_month']) && $_REQUEST['amp;target_month']==13){
			$month = 1;
		}else{
			$month = $_REQUEST['amp;target_month'];
		}
	// }elseif(!is_null($_REQUEST['target_month']) and $_REQUEST['target_year']){
	}elseif(!empty($_REQUEST['target_month']) and $_REQUEST['target_year']){
		if(strval($_REQUEST['target_month'])==0){
			$month = 12;
		}elseif(isset($_REQUEST['target_month']) && $_REQUEST['target_month']==13){
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

if($date_flag){
	for($x=1;$x<=1;$x++){
		$today++;
		if(!checkdate($month, $today, $year)){
			$month++;
			$this_month++;
			$today=1;
			if(!checkdate($month, $today, $year)){
				$year++;
				$this_year++;
				$month=1;
			}
		}
	}
}


	// 予約受付範囲取得
	$sql = "select reservation_month from a_hall where hall_id = $hall_id";
	$limit_month = db_get_all($sql, $db);
	$limit_month = $limit_month[0]['reservation_month'];
	$reserve_limit_year = $this_year;
	$reserve_limit_month = $this_month + $limit_month;
	if($reserve_limit_month > 12){
		$reserve_limit_year+=1;
		$reserve_limit_month-=12;
	}

	// type
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

	$o_year=$year;
	$o_month=$month;
	$o_day=isset($day) ? $day : null;

	for($i=0;$i<3;$i++){	// 3ヶ月分

	$wtop = date('w',mktime(0,0,0,$month,1,$year));

	$day_list = array();
	$key=0;
	$wtop_d = isset($wtop_d) ? $wtop_d : 0;
	for($day = 1; checkdate($month, $day, $year); $day++ ){
		$day_list[$key]['day']=$day;
		$day_list[$key]['week']= $wtop_d;
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
		if(isset($result[0]['day'.$day]) && $result[0]['day'.$day]){
			$day_list[$key]['hall_holiday']=1;
		}

		// 会場の指定日
		$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if(!empty($result[0]['hall_id'])){
			$day_list[$key]['hall_holiday']=1;
		}

		// 部屋の定休日
		$sql = "select day$day from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
		$result = db_get_all($sql, $db);
		if(isset($result[0]['day'.$day]) && $result[0]['day'.$day]){
			$day_list[$key]['room_holiday']=1;
		}

		// 部屋の指定日
		$sql = "select * from a_room_holiday where hall_id = $hall_id and room_id = $room_id and year = $year and month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if(!empty($result[0]['hall_id'])){
			$day_list[$key]['room_holiday']=1;
		}

		// 選択月の祝日
		$sql = "select * from c_holiday where month = $month and day = $day";
		$result = db_get_all($sql, $db);
		if(!empty($result[0])){
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

	$a_day_list[$i]=$day_list;
	$a_wtop[$i]=$wtop;

	$month++;
	if($month>12){ $month=1; $year++; }

	}// for3ヶ月分

	$year=$o_year;
	$month=$o_month;
	$day=$o_day;

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

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}

?>

<body>
<a name="calendar" id="calendar"></a>

<style type="text/css">
<!--
table#cal {
 border-collapse: collapse;
 border-spacing: 0;
}
table#cal th {
 background: #E7E7E7;
 border:1px solid #ABABAB;
 text-align: center;
}
table#cal td {
 background: #FFFFFF;
 border:1px solid #ABABAB;
 text-align: center;
}
-->
</style>


<table width="580" style="padding: 0px; background: #FFFFFF; border: none;">
<tr><td colspan="3" style="background: #F0F0F0; color: #000000; padding: 12px; font-weight: bold; font-size: 16px;">
カレンダーから選択
</td></tr>
<tr>
<?php for($i=0;$i<3;$i++){ ?>

<td style="padding: 8px; vertical-align: top;"><table>
<tr>
<td style="text-align:left;">

<?php print $year; ?>年 <font size="+1"><b><?php print ($month+0); ?></b></font>月

<?php
if($year==$this_year && $month==$this_month){
	echo "<span style='padding: 1px; background: #C90000; color: #FFFFFF;'>今月</div>";
}
?>
</td></tr><tr>
<td><table id="cal">



<tr>

<th width=25><span style="color:#FF0000">日</span></td>
<th width=25>月</td>
<th width=25>火</td>
<th width=25>水</td>
<th width=25>木</td>
<th width=25>金</td>
<th width=25><span style="color:#0000FF">土</span></td>
</tr>
<tr>
<?php
	for($j=0;$j<$a_wtop[$i];$j++)
		print "<td></td>";

	foreach($a_day_list[$i] as $key=>$item){

		$wweek = get_week($this_year.sprintf("%02d", $month).sprintf("%02d", $item['day']));

		$code = "<td ";
		//({*** 過ぎた日 ***})
		if($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)){
			$code.= "bgcolor=#D0D0D0 ";
		}else{
			//({*** 定休日 ***})
			if((isset($item['room_holiday']) && $item['room_holiday']) or (isset($item['hall_holiday']) && $item['hall_holiday'])){
				$code.= "bgcolor=#FFDDDD ";
			}elseif(!empty($item['reserved'])){
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
		if((isset($item['holiday_jp']['day']) && $item['holiday_jp']['day'] == $item['day']) or $item['week_num']==0){
				if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !(!empty($item['room_holiday']) or !empty($item['hall_holiday'])) && !($year>=$reserve_limit_year and $month>=$reserve_limit_month and $today_f < $item['day'])){

                $day=$item['day']; 
				$code.= "<a href='javascript:{setValue($year,$month,$day); toggleCalendar();}'><span style='color: #FF0000;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #FF0000;'><b>".$item['day']."</b></span>";
				}
		}elseif($item['week_num']==6){

				if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !(!empty($item['room_holiday']) or !empty($item['hall_holiday'])) && !($year>=$reserve_limit_year and $month>=$reserve_limit_month and $today_f < $item['day'])){
                     $day=$item['day']; 

					$code.= "<a href='javascript:{setValue($year,$month,$day); toggleCalendar();}'><span style='color: #0000FF;'><b>".$item['day']."</b></span></a>";

				}else{
					$code.= "<span style='color: #0000FF;'><b>".$item['day']."</b></span>";
				}

		}else{

			if(!($year==$this_year and ($month==$this_month and $item['day']<$today) or ($year==$this_year and $month<$this_month) or ($year<$this_year)) and !(!empty($item['room_holiday']) or !empty($item['hall_holiday'])) && !($year>=$reserve_limit_year and $month>=$reserve_limit_month and $today_f < $item['day'])){
                $day=$item['day']; 
                 
				$code.= "<a href='javascript: {setValue($year,$month,$day); toggleCalendar();}'><span style='color: #000000;'>".$item['day']."</span></a>";
			}else{
				$code.= $item['day'];
			}

		}

		$code.="</td>";
		if(($key+$a_wtop[$i]+1)%7==0) $code.= "</tr><tr>";

		print $code;

	}// foreach
?>
</tr>
</table>

</td></tr>
</table></td>
<?php
$month++;
if($month>12){ $year++; $month=1; }	
}
?>
</tr>
<tr>
<td style="text-align: left; padding: 8px;">
<?php
if(!($this_year>=$o_year and $this_month>=$o_month)){
	echo "<a href=\"javascript:LoadHTML('Calendar', 'side/calendar.php?hid=$hall_id&rid=$room_id&target_year=$o_year&target_month=".
		($o_month-1)."&page=$page&uid=".$uid;
	if($reserve_id) print "&reserve_id=".$reserve_id;
	if($u) print "&u=$u";
	if($pre_id) print "&pre_id=$pre_id";
	echo "')";
	echo '"><img src="./atoffice/img/tr_l.png" width="3" height="5" style="vertical-align: middle"><font color="#416740"> 前の月へ</font></a>';
}
?>
</td>
<td></td>
<td style="text-align: right; padding: 8px;">
<?php
$next_year=$o_year;
$next_month=$o_month+2;
if($next_month>12){ $next_year++; $next_month-=12; }
if(!($next_year>=$reserve_limit_year and $next_month>=$reserve_limit_month)){
	echo "<a href=\"javascript:LoadHTML('Calendar', 'side/calendar.php?hid=$hall_id&rid=$room_id&target_year=$o_year&target_month=".
		($o_month+1)."&page=$page&uid=".$uid;
	if($reserve_id) print "&reserve_id=".$reserve_id;
	if($u) print "&u=$u";
	if($pre_id) print "&pre_id=$pre_id";
	echo "')";
	echo '"><font color="#416740">次の月へ </font><img src="./atoffice/img/tr_r.png" width="3" height="5" style="vertical-align: middle"></a>';
}
?>
</td>
</tr></table>

<div id="close" style="position: absolute; top: 10px; left: 550px;">
<a href="javascript:toggleCalendar();"><img src="./atoffice/img/close.gif" border="0"></a>
</div>




</tr></table>

</body>
