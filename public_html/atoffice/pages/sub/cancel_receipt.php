<?php
require('fpdf/mbfpdf.php');

function db_get_all($sql, $db){
	$result = mysql_query($sql, $db);
	while($item = @mysql_fetch_assoc($result)){
		$rows[]=$item;
	}
	return $rows;

}

function get_profile_value($u, $p, $db){
	$sql = "select value from c_member_profile where c_member_id = $u and c_profile_id = $p";
	$result = db_get_all($sql, $db);
	return($result[0]['value']);
}
function get_vessel_name($vessel_id, $db){
	$sql = "select vessel_name from a_vessel_data where vessel_id = $vessel_id";
	$result = db_get_all($sql, $db);
	return $result[0]['vessel_name'];
}
function get_service_name($service_id, $db){
	$sql = "select service_name from a_service_data where service_id = $service_id";
	$result = db_get_all($sql, $db);
	return $result[0]['service_name'];
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
	require_once 'HTTP.php';

	//var_dump($_POST);
	if(preg_match("/^[0-9]+$/", $_POST['billed_id'])){
		$billed_id = $_POST['billed_id'];
	}else{
		HTTP::redirect("../../../?page=error");
	}

	session_start();
	$u = $_SESSION['u'];
	if(!$u){
		print "ログインしてください。";
	}

	$sql = "select * from a_amount_billed where billed_id = '$billed_id'";
	$ab_data = db_get_all($sql, $db);
	$ab_data = $ab_data[0];
	if($ab_data['receipt_flag']>0){
		// 印刷済み
		HTTP::redirect("../../../?page=error");
	}

	$sql = "select * from a_reserve_list where reserve_id = ".$ab_data['reserve_id'];
	$reserve_data = db_get_all($sql, $db);
	$reserve_data = $reserve_data[0];
	if($reserve_data['c_member_id'] != $u){
		// 他人の予約
		HTTP::redirect("../../../?page=error");
	}

// 印刷済みにする
	$sql = "update a_amount_billed SET ";
	$sql.= "receipt_flag = '1', ";
	$sql.= "receipt_datetime = now() ";
	$sql.= "where billed_id = '$billed_id'";
	db_get_all($sql, $db);


	$sql = "select * from c_member where c_member_id = '$u'";
	$c_member = db_get_all($sql, $db);
	$c_member = $c_member[0];

	$corp = get_profile_value($u, 12, $db);

	$today = date("Y年m月d日");

	$dt = new DateTime($ab_data['check_datetime']);
	$pay_checkdate = $dt->format("Y年m月d日");

	$dt = new DateTime($ab_data['add_datetime']);
	$canceldate = $dt->format("Y年m月d日");

	$sql = "select hall_name from a_hall where hall_id = ".$reserve_data['hall_id'];
	$hall_name = db_get_all($sql, $db);
	$hall_name = $hall_name[0]['hall_name'];

	$sql = "select room_name from a_room where hall_id = ".$reserve_data['hall_id']." and room_id = ".$reserve_data['room_id'];
	$room_name = db_get_all($sql, $db);
	$room_name = $room_name[0]['room_name'];

////////////////////////////////////////////////////////////////////////////

$GLOBALS['EUC2SJIS'] = true;

$pdf=new MBFPDF();
$pdf->AddMBFont(GOTHIC ,'SJIS');
$pdf->AddMBFont(PGOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO ,'SJIS');
$pdf->AddMBFont(PMINCHO,'SJIS');
$pdf->AddMBFont(KOZMIN ,'SJIS');
$pdf->Open();
$pdf->AddPage();
$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->SetFont(GOTHIC,'B',40);
$pdf->MultiCell(80,10,'領収書',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',15);
$pdf->MultiCell(0, 3, '予約番号.'.$ab_data['reserve_id'], 0, 'R', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 5, mb_convert_encoding($corp, "EUC-JP", "auto").' 様', 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',40);
$pdf->MultiCell(0,10,'￥　'.number_format($ab_data['total_billed_money'])."-",0,'C',0);
$pdf->Ln();

$pdf->SetFont(GOTHIC,'B',20);
$pdf->SetXY(100,75);
$pdf->MultiCell(0, 6, $pay_checkdate, 0, 'L', 0);
$pdf->SetFont(GOTHIC,'B',20);
$pdf->SetXY(100,85);
$pdf->MultiCell(0, 6, '上記　正に領収いたしました', 0, 'L', 0);

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,100);
$pdf->MultiCell(0, 6, 'ご利用明細', 0, 'L', 0);

$pdf->SetXY(10,106);
$pdf->MultiCell(0, 6, '会場名：　'.mb_convert_encoding($hall_name, "EUC-JP", "auto"), 0, 'L', 0);
$pdf->SetXY(10,112);
$pdf->MultiCell(0, 6, '部屋名：　'.mb_convert_encoding($room_name, "EUC-JP", "auto"), 0, 'L', 0);

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,118);
$pdf->MultiCell(30, 6, 'ｷｬﾝｾﾙ日', 1, 'C', 0);
$pdf->SetXY(40,118);
$pdf->MultiCell(120, 6, '内容', 1, 'C', 0);
$pdf->SetXY(160,118);
$pdf->MultiCell(40, 6, '金額', 1, 'C', 0);
$pdf->Ln();


$pdf->SetXY(10,124);
$pdf->MultiCell(30, 6, $canceldate, 1, 'C', 0);
$pdf->SetXY(40,124);
$pdf->MultiCell(120, 6, '会議室予約キャンセル料として', 1, 'L', 0);
$pdf->SetXY(160,124);
$pdf->MultiCell(40, 6, number_format($ab_data['total_billed_money']), 1, 'R', 0);
$pdf->Ln();

$y = 130;

$pdf->SetXY(120,$y);
$pdf->MultiCell(40, 6, '合計（消費税含む）', 1, 'C', 0);
$pdf->SetXY(160,$y);
$pdf->MultiCell(40, 6, number_format($ab_data['total_billed_money']), 1, 'R', 0);



$pdf->Image('inshi.gif', 10, 240, 40.0);
$pdf->SetFont(GOTHIC,'B',16);
$pdf->SetXY(57,240);
$pdf->MultiCell(0, 16, '〒153-0044', 0, 'L', 0);
$pdf->SetXY(57,246);
$pdf->MultiCell(0, 16, '東 京 都 目 黒 区 大 橋 ２−２２−６', 0, 'L', 0);
$pdf->SetXY(57,252);
$pdf->MultiCell(0, 16, '株式会社　ア ッ ト オ フ ィ ス', 0, 'L', 0);
$pdf->SetXY(57,258);
$pdf->MultiCell(0, 16, 'TEL　03-5452-3711', 0, 'L', 0);
$pdf->Image('kakuin.gif', 160, 235, 40.0);

$pdf->Output();
?>