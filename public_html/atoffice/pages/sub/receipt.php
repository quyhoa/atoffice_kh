<?php
include 'fpdf/mbfpdf.php';
include 'HTTP.php';

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

	//var_dump($_POST);
	if(preg_match("/^[0-9]+$/", $_POST['reserve_id'])){
		$reserve_id = $_POST['reserve_id'];
	}else{
		HTTP::redirect("../../../?page=error");
	}

	if(isset($_POST['admin'])){
		$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
		$reserve_data = db_get_all($sql, $db);
		$reserve_data = $reserve_data[0];

		$u=$reserve_data['c_member_id'];
	}else{
		session_start();
		$u = $_SESSION['u'];
		if(!$u && !isset($_POST['admin'])){
			print "ログインしてください。";
		}

		$sql = "select * from a_reserve_list where reserve_id = '$reserve_id' and tmp_flag=0 and cancel_flag=0 and receipt_flag=0 and pay_flag=1";
		$reserve_data = db_get_all($sql, $db);
		$reserve_data = $reserve_data[0];

		if($reserve_data['receipt_flag']>0){
			// 印刷済み
			HTTP::redirect("../../../?page=error");
		}

		if($reserve_data['c_member_id'] != $u){
			// 他人の予約
			HTTP::redirect("../../../?page=error");
		}

		// 印刷済みにする
		$sql = "update a_reserve_list SET ";
		$sql.= "receipt_flag = '1', ";
		$sql.= "receipt_datetime = now() ";
		$sql.= "where reserve_id = '$reserve_id'";
		db_get_all($sql, $db);
	}

	$sql = "select * from c_member where c_member_id = '$u'";
	$c_member = db_get_all($sql, $db);
	$c_member = $c_member[0];
     /* 
    * GMO_RUNSYSTEM
    * ADD 20140401 
    */
    if(isset($_POST['reserve_name']) && $_POST['reserve_name'] !='')
    {
        $corp = $_POST['reserve_name'];
    }
    else{
        $corp = get_profile_value($u, 12, $db);
   
    }
	

	$today = date("Y年m月d日");

	$dt = new DateTime($reserve_data['pay_checkdate']);
	$pay_checkdate = $dt->format("Y年m月d日");

	$dt = new DateTime($reserve_data['begin_datetime']);
	$usedate = $dt->format("Y年m月d日");

	$sql = "select hall_name from a_hall where hall_id = ".$reserve_data['hall_id'];
	$hall_name = db_get_all($sql, $db);
	$hall_name = $hall_name[0]['hall_name'];

	$sql = "select room_name from a_room where hall_id = ".$reserve_data['hall_id']." and room_id = ".$reserve_data['room_id'];
	$room_name = db_get_all($sql, $db);
	$room_name = $room_name[0]['room_name'];

	$sql = "select * from a_reserve_v where reserve_id = '$reserve_id' and cancel_flag=0";
	$vessel_rd = db_get_all($sql, $db);
	if($vessel_rd){
		foreach($vessel_rd as $key=>$value){
			$vessel_rd[$key]['name']=get_vessel_name($value['vessel_id'], $db);
		}
	}

	$sql = "select * from a_reserve_s where reserve_id = '$reserve_id' and cancel_flag=0";
	$service_rd = db_get_all($sql, $db);
	if($service_rd){
		foreach($service_rd as $key=>$value){
			$service_rd[$key]['name']=get_service_name($value['service_id'], $db);
		}
	}



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
$pdf->SetFont(GOTHIC,'B',20);
$pdf->MultiCell(65,10,'領収書',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',15);
$pdf->MultiCell(0, 3, '予約番号.'.$reserve_id, 0, 'R', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 5, mb_convert_encoding($corp, "EUC-JP", "auto").' 様', 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',20);
$pdf->MultiCell(0,10,'￥　'.number_format($reserve_data['total_price'])."-",0,'C',0);
$pdf->SetFont(GOTHIC,'B',12);
$pdf->SetXY(120,70);
$pdf->MultiCell(0, 6, $pay_checkdate, 0, 'L', 0);
$pdf->SetFont(GOTHIC,'B',12);
$pdf->SetXY(120,76);
$pdf->MultiCell(0, 6, '上記　正に領収いたしました', 0, 'L', 0);

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,90);
$pdf->MultiCell(0, 6, 'ご利用明細', 0, 'L', 0);

$pdf->SetXY(10,96);
$pdf->MultiCell(0, 6, '会場名：　'.mb_convert_encoding($hall_name, "EUC-JP", "auto"), 0, 'L', 0);
$pdf->SetXY(10,102);
$pdf->MultiCell(0, 6, '部屋名：　'.mb_convert_encoding($room_name, "EUC-JP", "auto"), 0, 'L', 0);

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,108);
$pdf->MultiCell(30, 6, 'ご利用日', 1, 'C', 0);
$pdf->SetXY(40,108);
$pdf->MultiCell(100, 6, '内容', 1, 'C', 0);
$pdf->SetXY(140,108);
$pdf->MultiCell(60, 6, '金額(税込)', 1, 'C', 0);
$pdf->Ln();


$pdf->SetXY(10,114);
$pdf->MultiCell(30, 6, $usedate, 1, 'C', 0);
$pdf->SetXY(40,114);
$pdf->MultiCell(100, 6, '会議室利用料金', 1, 'L', 0);
$pdf->SetXY(140,114);
$pdf->MultiCell(60, 6, "\\".number_format($reserve_data['room_price']), 1, 'R', 0);
$pdf->Ln();

$y = 120;
if($vessel_rd){
	foreach($vessel_rd as $key=>$value){
		$pdf->SetXY(10,$y);
		$pdf->MultiCell(30, 6, $usedate, 1, 'C', 0);
		$pdf->SetXY(40,$y);
		$pdf->MultiCell(100, 6, mb_convert_encoding($value['name'], "EUC-JP", "auto")."(数量:".$value['num'].")", 1, 'L', 0);
if($key==0){
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "備品利用総額：", 1, 'L', 0);
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "\\".number_format($reserve_data['vessel_price']), 0, 'R', 0);
}else{
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "", 1, 'R', 0);
}		$pdf->Ln();
		$y+=6;
	}
}
if($service_rd){
	foreach($service_rd as $key=>$value){
		$pdf->SetXY(10,$y);
		$pdf->MultiCell(30, 6, $usedate, 1, 'C', 0);
		$pdf->SetXY(40,$y);
//		$pdf->SetFont(GOTHIC,'B',10);
/*
		$str=mb_convert_encoding($value['name'], "EUC-JP", "auto")."(数量:".$value['num'].")";
		$sl=strlen($fsize);
		if($sl<62) $fsize=10;
		else if($sl<80) $fsize=9;
		else $fsize=8;

		$pdf->SetFont(GOTHIC,'B',$fsize);
*/
		$str=mb_convert_encoding($value['name'], "EUC-JP", "auto")."(数量:".$value['num'].")";
		$pdf->MultiCell(100, 6, $str, 1, 'L', 0);
		$pdf->SetFont(GOTHIC,'B',10);
if($key==0){
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "サービス総額：", 1, 'L', 0);
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "\\".number_format($reserve_data['service_price']), 0, 'R', 0);
}else{
		$pdf->SetXY(140,$y);
		$pdf->MultiCell(60, 6, "", 1, 'R', 0);
}		$pdf->Ln();
		$y+=6;
	}
}

$pdf->SetXY(100,$y);
$pdf->MultiCell(40, 6, '合計（消費税含む）', 1, 'C', 0);
$pdf->SetXY(140,$y);
$pdf->MultiCell(60, 6, "\\".number_format($reserve_data['total_price']), 1, 'R', 0);



//$pdf->Image('inshi.gif', 10, 238, 40.0);
//$pdf->Rect(10, 238, 40,35, 'D');
$pdf->SetXY(20,242);
//$pdf->drawTextBox('収入印紙', 50, 50, 'C', 'M');
$pdf->Cell(18,20,'収入印紙',1,1,'C');
$pdf->SetFont(GOTHIC,'B',16);
$pdf->SetXY(57,236);
$pdf->MultiCell(0, 16, '〒107-0062', 0, 'L', 0);
$pdf->SetXY(57,242);
$pdf->MultiCell(0, 16, '東京都港区南青山2-2-8 DFビル3階', 0, 'L', 0);
$pdf->SetXY(57,248);
$pdf->MultiCell(0, 16, '株式会社　ア ッ ト オ フ ィ ス', 0, 'L', 0);
$pdf->SetXY(57,254);
$pdf->MultiCell(0, 16, 'TEL:03-5465-5506', 0, 'L', 0);
$pdf->Image('kakuin.gif', 160, 235, 40.0);

$pdf->Output();
?>

$pdf->MultiCell(0, 2, 'TEL:03-5465-5506', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 2, 'FAX:03-6418-5424', 0, 'R', 0);