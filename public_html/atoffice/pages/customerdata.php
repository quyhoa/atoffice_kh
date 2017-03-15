<?php
//var_dump($_REQUEST);
$year = isset($year) ? $year : '';
$month = isset($year) ? $year : '';
$day = isset($year) ? $year : '';
if(isset($_REQUEST['year'])) $year=$_REQUEST['year'];
else if(isset($_REQUEST['amp;year'])) $year=$_REQUEST['amp;year'];
if(isset($_REQUEST['month'])) $month=$_REQUEST['month'];
else if(isset($_REQUEST['amp;month'])) $month=$_REQUEST['amp;month'];
if(isset($_REQUEST['day'])) $day=$_REQUEST['day'];
else if(isset($_REQUEST['amp;day'])) $day=$_REQUEST['amp;day'];
if(isset($_REQUEST['hid'])) $hid=$_REQUEST['hid'];
else if(isset($_REQUEST['amp;hid'])) $hid=$_REQUEST['amp;hid'];

function db_get_all($sql, $db){
	$rows = array();	
	$result = mysql_query($sql, $db);
	if($result !== true){
		while($item = mysql_fetch_assoc($result)){
			$rows[]=$item;
		}
	}
	// while($item = mysql_fetch_assoc($result)){
	// 	$rows[]=$item;
	// }
	return $rows;

}

function get_pre_id($pre_id, $db){
	$sql = "select * from a_pre_id where pre_id = '$pre_id'";
	$result = db_get_all($sql, $db);
	if($result){
		return(1);
	}else{
		return(0);
	}
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

// 期限切れ消去
$sql = "delete from a_pre_id where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_reserve where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_rv where limit_datetime < now()";
db_get_all($sql, $db);
$sql = "delete from a_pre_rs where limit_datetime < now()";
db_get_all($sql, $db);

// ID発行
// if(!$_REQUEST['amp;pre_id'] and !$_REQUEST['pre_id']){
if(empty($_REQUEST['amp;pre_id']) and empty($_REQUEST['pre_id'])){
	$pre_id = rand(10000, 999999999);
	while(get_pre_id($pre_id, $db)){
		$pre_id = rand(10000, 999999999);
	}
	$sql = "insert into a_pre_id (pre_id, limit_datetime) values ('$pre_id', NOW() + INTERVAL 3 hour)";
	db_get_all($sql, $db);
}else{
	if(preg_match("/^[0-9]+$/", $_REQUEST['amp;pre_id'])){
		$pre_id = $_REQUEST['amp;pre_id'];
	}elseif(preg_match("/^[0-9]+$/", $_REQUEST['pre_id'])){
		$pre_id = $_REQUEST['pre_id'];
	}else{
		HTTP::redirect("error.php");
	}
}

// 顧客情報戻り
	if(!empty($_REQUEST['amp;shimei'])){
		$shimei = $_REQUEST['amp;shimei'];
	}
	if(!empty($_REQUEST['amp;kana'])){
		$kana = $_REQUEST['amp;kana'];
	}
	if(!empty($_REQUEST['amp;riyo'])){
		$riyo = $_REQUEST['amp;riyo'];
	}
	if(!empty($_REQUEST['amp;daihyou'])){
		$daihyou = $_REQUEST['amp;daihyou'];
	}
	if(!empty($_REQUEST['amp;busho'])){
		$busho = $_REQUEST['amp;busho'];
	}
	if(!empty($_REQUEST['amp;mail'])){
		$mail = $_REQUEST['amp;mail'];
	}
	if(!empty($_REQUEST['amp;ken'])){
		$ken = $_REQUEST['amp;ken'];
	}
	if(!empty($_REQUEST['amp;zip'])){
		$zip = $_REQUEST['amp;zip'];
	}
	if(!empty($_REQUEST['amp;address_city'])){
		$address_city = $_REQUEST['amp;address_city'];
	}
	if(!empty($_REQUEST['amp;address_banchi'])){
		$address_banchi = $_REQUEST['amp;address_banchi'];
	}
	if(!empty($_REQUEST['amp;address_build'])){
		$address_build = $_REQUEST['amp;address_build'];
	}
	if(!empty($_REQUEST['amp;tel'])){
		$tel = $_REQUEST['amp;tel'];
	}
	if(!empty($_REQUEST['amp;fax'])){
		$fax = $_REQUEST['amp;fax'];
	}
	if(!empty($_REQUEST['amp;message'])){
		$message = $_REQUEST['amp;message'];
	}

	// ログインか
	if(!empty($_REQUEST['amp;c_member_id'])){
		$c_member_id = $_REQUEST['amp;c_member_id'];
	}else{
		$c_member_id = 0;
	}
	if(!empty($_REQUEST['amp;msg'])){
		$msg=$_REQUEST['amp;msg'];
	}

$all_total = 0;


// 都道府県オプション
	$sql = "select * from c_profile_option where c_profile_id = 3";
	$ken_list=db_get_all($sql, $db);
	
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
<a name="top"></a>

<center><div id="left" style='width:660px;'>
<H2 style="background:url(./atoffice/img/customerdata.png) no-repeat;">
</H2>
<br />
<img src="./atoffice/img/step1.jpg" width="660" height="143">
<br><br>
<hr>
<br>
<img src="./atoffice/img/step1.png" width="660" height="30"><br>
<br>
<img src="./atoffice/img/logininfo.png" width="660" height="59"><br>
<br>

<form name="yoyaku" method="POST" action="./">
<input type="hidden" name="page" value="set_guest_info">
<input type="hidden" name="pre_id" value="<?php print $pre_id; ?>">
<input type="hidden" name="hid" value="<?php echo $hid;?>">
<input type="hidden" name="year" value="<?php echo $year;?>">
<input type="hidden" name="month" value="<?php echo $month;?>">
<input type="hidden" name="day" value="<?php echo $day;?>">

<?php
	if(!empty($msg)){
		print "<center>";
		print "<table border=2 width=500>";
		print "<tr>";
		print "<th style='background-color:#FF0000;color:#FFFFFF;font-size:16px;'><center><b>予約エラー</b></center></th></tr>";
		print "<tr><td style='background-color:#FF0000;color:#FFFFFF;'>";
		print "・".nl2br($msg);
		print "</td></tr></table></center><br><br><br>";
	}

	if($c_member_id==0){
?>

会員登録されているメールアドレスでのゲスト予約はできません。ログインしてください。<br>
<br>
過去にゲストで申請したことがあり、同じメールアドレスでご登録の場合は新しい予約者情報で統一いたします。<br>
※複数予約をされる場合は会員登録が便利です。<br>
サポートセンター(03-5465-5506)へご連絡いただければ登録いたします。<br><br>

<table width=600>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">氏名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $shimei = isset($shimei) ? $shimei : ''; ?>
<input tyep="text" name="shimei" size=20 maxlength="15" value="<?php print htmlspecialchars($shimei); ?>">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">フリガナ(全角カタカナ)<span style="color:#FF0000">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $kana = isset($kana) ? $kana : ''; ?>
<input tyep="text" name="kana" size=30 maxlength="30" value="<?php print htmlspecialchars($kana); ?>">
</td>
</tr>

<?php
/*
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">生年月日<span style="color:#FF0000;">(※)</span></td>

<td colspan=3 style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">

<input type="text" name="birth_year" size=15 value=<?php print $birth_year; ?>> 年 
<select name="birth_month">
<?php
	foreach($birth_month_list as $value){
		$code ="<option value=$value ";
		if($value == $birth_month){
			$code.="selected";
		}
		$code.=">$value</option>";
		print $code;
	}
?>
</select> 月 
<select name="birth_day">
<?php
	foreach($birth_day_list as $value){
		$code ="<option value=$value ";
		if($value == $birth_day){
			$code.="selected";
		}
		$code.=">$value</option>";
		print $code;
	}
?>
</select> 日

</td>
</tr>

*/
?>

<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">利用形態<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<input type="radio" name="riyo" value="106" <?php if(isset($riyo) && $riyo==106) print "checked"; ?>> 法人　
<input type="radio" name="riyo" value="107" <?php if(isset($riyo) && $riyo==107) print "checked"; ?>> 個人
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">法人/団体名<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $daihyou = isset($daihyou) ? $daihyou : ''; ?>
<input tyep="text" name="daihyou" size=20 maxlength="40" value="<?php print htmlspecialchars($daihyou); ?>">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">部署名</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $busho = isset($busho) ? $busho : ''; ?>
<input tyep="text" name="busho" size=20 maxlength="15" value="<?php print htmlspecialchars($busho); ?>">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">メールアドレス<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $mail = isset($mail) ? $mail : ''; ?>
<input type="text" name="mail" size=30 maxlength="40" value="<?php print htmlspecialchars($mail); ?>">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">都道府県<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<select name="ken">
<?php
	foreach($ken_list as $value){
		$code = "<option value=".$value['c_profile_option_id'];
		if($value['c_profile_option_id'] == $ken){
			$code.= " selected";
		}
		$code.= ">".$value['value']."</option>";
		print $code;
	}
?>

</select>

</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">郵便番号<br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $zip = isset($zip) ? $zip : ''; ?>
<input type="text" name="zip" size=20 maxlength="10" value="<?php print htmlspecialchars($zip); ?>">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">市区町村<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $address_city = isset($address_city) ? $address_city : ''; ?>
<input type="text" name="address_city" size=20 maxlength="30" value="<?php print htmlspecialchars($address_city); ?>">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">番地<span style="color:#FF0000;">(※)</span></td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $address_banchi = isset($address_banchi) ? $address_banchi : ''; ?>
<input type="text" name="address_banchi" size=30 maxlength="30" value="<?php print htmlspecialchars($address_banchi); ?>">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">建物名</td>
<td colspan=3 style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
<?php $address_build = isset($address_build) ? $address_build : ''; ?>
<input type="text" name="address_build" size=60 maxlength="50" value="<?php print htmlspecialchars($address_build); ?>">
</td>
</tr>
<tr>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">電話番号<span style="color:#FF0000;">(※)</span><br>(ハイフン有り)</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
例）00-0000-0000<br>
<?php $tel = isset($tel) ? $tel : ''; ?>
<input type="text" name="tel" size=20 maxlength="15" value="<?php print htmlspecialchars($tel); ?>">
</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">FAX番号<br>ハイフン有り</td>
<td style="border: 1px #000000 solid;text-align: left;vertical-align:middle;'">
例）00-0000-0000<br>
<?php $fax = isset($fax) ? $fax : ''; ?>
<input type="text" name="fax" size=20 maxlength="15" value="<?php print htmlspecialchars($fax); ?>">
</td>
</tr>



</table>
<br><br>
<center><input type="image" src="./atoffice/img/tostep2.png" value=""></center>

<?php
	}
?>

<br>

</form>

</div>
<br>
</body>
