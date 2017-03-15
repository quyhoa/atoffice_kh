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

	if(!empty($_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}
	$pre_id = isset($pre_id) ? $pre_id : '';
	$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
	$pre_data = db_get_all($sql, $db);
	if($pre_data){
		foreach($pre_data as $key=>$value){
			// 部屋名
			$sql = "select room_name from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
			$result = db_get_all($sql, $db);
			$pre_data[$key]['room_name'] = $result[0]['room_name'];
			$dt = new DateTime($value['begin_datetime']);
			$pre_data[$key]['date'] = $dt->format("Y年m月d日");
            $pre_data[$key]['week'] = get_week($dt->format("Ymd"));
			$pre_data[$key]['begin'] = $dt->format("H時i分");
			$dt = new DateTime($value['finish_datetime']);
			$pre_data[$key]['finish'] = $dt->format("H時i分");
		}
	}

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}
?>

<body><center>
<?php
//var_dump($_REQUEST);
if(isset($_REQUEST['amp;page'])) $page=$_REQUEST['amp;page'];
else if(isset($_REQUEST['page'])) $page=$_REQUEST['page'];

if($pre_data && $page=="reserve"){
?>
<form name="reserve_list" method="POST" action="./">
<input type="hidden" name="page" value="reserve_list">
<input type='hidden' name='uid' value='<?php echo $_REQUEST['amp;uid']; ?>'>
<input type="hidden" name="pre_id" value="<?php echo $pre_id; ?>">
<input type="image" src="./atoffice/img/btn_cart.png" value="">
</form>
<?php
}
if($pre_data)	foreach($pre_data as $key=>$value){

	echo '<table width="230" style="border: solid 1px #000000;">';
	echo '<tr><td bgcolor="#CC3467" style="text-align: center; padding: 8px; font-weight: bold;"><font color="#FFFFFF">予約'.($key+1).'</font></td></tr>';
	echo '<tr><td style="background: #f0f0f0; border-top: solid 1px #000000; padding: 8px; font-weight: bold;">部屋名</td></tr>';
	echo '<tr><td style="background: #ffffff; border-top: solid 1px #000000; padding: 8px;">'.$value['room_name'].'</td></tr>';
	echo '<tr><td style="background: #f0f0f0; border-top: solid 1px #000000; padding: 8px; font-weight: bold;">予約日</td></tr>';
	echo '<tr><td style="background: #ffffff; border-top: solid 1px #000000; padding: 8px;">'.$value['date']."(".$value['week'].')</td></tr>';
	echo '<tr><td style="background: #f0f0f0; border-top: solid 1px #000000; padding: 8px; font-weight: bold;">利用時間</td></tr>';
	echo '<tr><td style="background: #ffffff; border-top: solid 1px #000000; padding: 8px;">'.$value['begin']."～".$value['finish'].'</td></tr>';
?>
</table>
<table><tr><td>
<form name='pre_edit' method='POST' action='./'>
<input type='hidden' name='page' value='reserve_edit'>
<input type='hidden' name='pid' value='<?php echo $value['pid']; ?>'>
<input type='hidden' name='uid' value='<?php echo $_REQUEST['amp;uid']; ?>'>
<input type='hidden' name='key' value='<?php echo $key; ?>'>
<input type='hidden' name='pre_id' value='<?php echo $_REQUEST['amp;pre_id']; ?>'>
<input type="image" src="./atoffice/img/res_change.png" value="">
</form>
</td><td>

<form name='pre_delete' method='POST' action='./' onSubmit="return confirm('予約 <?php echo ($key+1);?> を削除してよろしいですか?');">
<input type='hidden' name='hid' value='<?php echo $_REQUEST['hid']; ?>'>
<input type='hidden' name='rid' value='<?php echo $_REQUEST['amp;rid']; ?>'>
<input type='hidden' name='uid' value='<?php echo $_REQUEST['amp;uid']; ?>'>
<input type='hidden' name='page' value='do_pre_delete'>
<input type='hidden' name='year' value='<?php echo $_REQUEST['amp;year']; ?>'>
<input type='hidden' name='month' value='<?php echo $_REQUEST['amp;month']; ?>'>
<input type='hidden' name='day' value='<?php echo $_REQUEST['amp;day']; ?>'>
<input type='hidden' name='pre_id' value='<?php echo $_REQUEST['amp;pre_id']; ?>'>
<input type='hidden' name='del_id' value='<?php echo $value['pid']; ?>'>
<input type='hidden' name='back' value='<?php echo $page; ?>'>
<input type="image" src="./atoffice/img/res_cancel.png" value="">
</form>


</td></tr></table>
<br>
<?php
}else{
	echo '<IMG src="./atoffice/img/res_empty.png" width="231" height="43">';
}

if($pre_data && $page=="reserve"){
?>
<form name="reserve_list" method="POST" action="./">
<input type="hidden" name="page" value="reserve_list">
<input type='hidden' name='uid' value='<?php echo $_REQUEST['amp;uid']; ?>'>
<input type="hidden" name="pre_id" value="<?php echo $pre_id; ?>">
<input type="image" src="./atoffice/img/btn_cart.png" value="">
</form>
<?php
}



/*

<?php
	if($pre_data){
		foreach($pre_data as $key=>$value){
			$code = "<table id='table-s' width=100% border=5 bordercolorlight=#000000 bordercolordark=#000000>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#FFFF66>予約".($key+1)."</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>部屋名</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>";
			$code.= $value['room_name'];
			$code.= "</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>予約日</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>";
			$code.= $value['date']."(".$value['week'].")";
			$code.= "</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;' bgcolor=#CDCDCD>利用時間</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>";
			$code.= $value['begin']."～".$value['finish'];
			$code.= "</td></tr>";
			$code.= "<tr><td style='border: 1px #000000 solid;text-align: center;vertical-align:middle;'>";
			$code.= "<form name='pre_delete' method='POST' action='./'>";
			$code.= "<input type='hidden' name='hid' value='".$_REQUEST['hid']."'>";
			$code.= "<input type='hidden' name='rid' value='".$_REQUEST['amp;rid']."'>";
			$code.= "<input type='hidden' name='page' value='do_pre_delete'>";
			$code.= "<input type='hidden' name='year' value='".$_REQUEST['amp;year']."'>";
			$code.= "<input type='hidden' name='month' value='".$_REQUEST['amp;month']."'>";
			$code.= "<input type='hidden' name='day' value='".$_REQUEST['amp;day']."'>";
			$code.= "<input type='hidden' name='pre_id' value='".$_REQUEST['amp;pre_id']."'>";
			$code.= "<input type='hidden' name='del_id' value='".$value['pid']."'>";
			$code.= "<input type='submit' value='取消'>";
			$code.= "</form>";

			$code.= "</td></tr>";
			$code.= "</table>";

			print $code."<br>";
		}
	}else{
		print "<center>予約は空です。</center>";
	}
print "<hr>";
*/
?>

</center></body>
