<?php

include 'fpdf/mbfpdf.php';
include 'HTTP.php';
function db_get_all($sql, $db)
{
	$rows = array();
	$result = mysql_query($sql, $db);
	while($item = mysql_fetch_assoc($result))
    {
		$rows[]=$item;
	}
	return $rows;

}

function get_profile_value($u, $p, $db)
{
	$sql = "select value from c_member_profile where c_member_id = $u and c_profile_id = $p";
	$result = db_get_all($sql, $db);
	return($result[0]['value']);
}

function get_vessel_name($vessel_id, $db)
{
	$sql = "select vessel_name from a_vessel_data where vessel_id = $vessel_id";
	$result = db_get_all($sql, $db);
	return $result[0]['vessel_name'];
}

function get_service_name($service_id, $db)
{
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
		if(!$u){
			print "ログインしてください。";
		}

		$sql = "select * from a_reserve_list where reserve_id = '$reserve_id' and tmp_flag=0 and cancel_flag=0 and complete_flag=0";
		$reserve_data = db_get_all($sql, $db);
		$reserve_data = $reserve_data[0];

		if($reserve_data['c_member_id'] != $u){
			// 他人の予約
			HTTP::redirect("../../../?page=error");
		}
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
    else
    {
        $corp = get_profile_value($u, 12, $db);
   
    }
	

	$today = date("Y年m月d日");

	$dt = new DateTime($reserve_data['pay_limitdate']);
	$limitdate = $dt->format("Y年m月d日");

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
	if($vessel_rd)
    {
		foreach($vessel_rd as $key=>$value)
        {
			$vessel_rd[$key]['name']=get_vessel_name($value['vessel_id'], $db);
		}
	}

	$sql = "select * from a_reserve_s where reserve_id = '$reserve_id' and cancel_flag=0";
	$service_rd = db_get_all($sql, $db);
	if($service_rd)
    {
		foreach($service_rd as $key=>$value)
        {
			$service_rd[$key]['name']=get_service_name($value['service_id'], $db);
		}
	}

/// 2013.12.21 消費税改定対応 begin
//
//	$sql = "select rate from a_tax";
//	$tax_rate = db_get_all($sql, $db);
//	$tax_rate = ($tax_rate[0]['rate']*0.01)+1;
//	$taxless_price = $reserve_data['total_price']/$tax_rate;
//	$tax = $reserve_data['total_price']-$taxless_price;
//
/// 2013.12.21 消費税改定対応 end

	$virtual_code = $reserve_data['virtual_code'];
	$branch_code = substr($virtual_code, 0, 3);
	$virtual_code = substr($virtual_code, 4, 10);

	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_code'";
	$bank_data = db_get_all($sql, $db);
	$bank_data = $bank_data[0];

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
$pdf->SetFont(GOTHIC,'U',12);
$pdf->MultiCell(0, 3, 'No.'.$reserve_id, 0, 'R', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 2, $today, 0, 'R', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',20);
$pdf->MultiCell(100,10,'請求書',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 5, mb_convert_encoding($corp, "EUC-JP", "auto").' 様', 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 2, '株式会社アットオフィス', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 2, '東京都港区南青山2-2-8DFビル3階', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 0, '下記の通りご請求申し上げます。', 0, 'L', 0);
$pdf->MultiCell(0, 2, 'TEL:03-5465-5506', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 0, $limitdate.'までにお振り込みください。', 0, 'L', 0);
$pdf->Ln();
$pdf->Image('kakuin.gif', 160, 75, 40.0);
$pdf->Ln();

$pdf->SetXY(10,90);

$pdf->SetFont(GOTHIC,'U',20);
$pdf->MultiCell(0,10,'ご請求額　　　　　￥'.number_format($reserve_data['total_price'])."-",0,'L',0);
$pdf->Ln();
//edit
$pdf->SetXY(10,100);

$pdf->SetFont(GOTHIC,'U',12);
$pdf->MultiCell(0, 4, '振込先', 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 3, '振込指定銀行：'.mb_convert_encoding($bank_data['bank'], "EUC-JP", "auto")."・".mb_convert_encoding($bank_data['branch'], "EUC-JP", "auto")."(支店番号：".$branch_code.")", 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 3, '口座番号：（普通）'.$virtual_code, 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 3, '口座名義人：'.mb_convert_encoding($bank_data['account'], "EUC-JP", "auto"), 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 6, '※ なお、お振込手数料は貴社にてご負担下さいます様、お願い申しあげます。', 0, 'L', 0);
$pdf->Ln();



$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,134);
$pdf->MultiCell(140, 6, '品目', 1, 'C', 0);
$pdf->SetXY(150,134);
$pdf->MultiCell(50, 6, '合計金額（税込）', 1, 'C', 0);
$pdf->Ln();


$pdf->SetXY(10,140);
$column_width =120;
$line_width= ceil($pdf->GetStringWidth($usedate.' '.mb_convert_encoding($hall_name, "EUC-JP", "auto").' '.mb_convert_encoding($room_name, "EUC-JP", "auto").'利用料として'));
$number_of_lines = ceil( $line_width / ($column_width) );
if($number_of_lines >1){
    $number_of_lines+=1;
   $pdf->SetFont(GOTHIC,'B',9);
}
$pdf->MultiCell(140, 6, $usedate.' '.mb_convert_encoding($hall_name, "EUC-JP", "auto").' '.mb_convert_encoding($room_name, "EUC-JP", "auto").'利用料として', 1, 'L', 0);
$pdf->SetXY(150,140);
$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data['room_price']), 1, 'R', 0);
$pdf->Ln();

$y=146;
if($vessel_rd)
{
	foreach($vessel_rd as $key=>$value)
    {
		$pdf->SetXY(10,$y);
		$str =  $usedate.' 備品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として';
        $sl=strlen($str);
		if($sl<62) $fsize=10;
		else if($sl<80) $fsize=9;
		else $fsize=8;

		$pdf->SetFont(GOTHIC,'B',$fsize);
		$pdf->MultiCell(140, 6, $str, 1, 'L', 0);
		$pdf->SetFont(GOTHIC,'B',10);
        
        $pdf->SetXY(150,$y);
if($key==0){
		$pdf->MultiCell(50, 6, '備品利用総額：', 1, 'L', 0);
		$pdf->SetXY(150,$y);
		$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data['vessel_price']), 0, 'R', 0);
}else{
		$pdf->MultiCell(50, 6, '', 1, 'R', 0);
}
		$pdf->Ln();
		$y+=6;	}
}
if($service_rd){
	foreach($service_rd as $key=>$value){
		$pdf->SetXY(10,$y);

		$str=$usedate.' サービス品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として';
		$sl=strlen($str);
		if($sl<62) $fsize=10;
		else if($sl<80) $fsize=9;
		else $fsize=8;

		$pdf->SetFont(GOTHIC,'B',$fsize);
		$pdf->MultiCell(140, 6, $str, 1, 'L', 0);
		$pdf->SetFont(GOTHIC,'B',10);
		$pdf->SetXY(150,$y);
if($key==0){
		$pdf->MultiCell(50, 6, 'サービス品総額：', 1, 'L', 0);
		$pdf->SetXY(150,$y);
		$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data['service_price']), 0, 'R', 0);
}else{
		$pdf->MultiCell(50, 6, '', 1, 'R', 0);
}		$pdf->Ln();
		$y+=6;
	}
}

/// 2013.12.21 消費税改定対応 begin
//
// $pdf->SetXY(110,$y);
// $pdf->MultiCell(40, 6, '税抜き合計金額', 1, 'C', 0);
// $pdf->SetXY(150,$y);
// $pdf->MultiCell(50, 6, '\\'.number_format($taxless_price), 1, 'R', 0);
// $pdf->Ln();
// $y+=6;
// 
// $pdf->SetXY(110,$y);
// $pdf->MultiCell(40, 6, '消費税', 1, 'C', 0);
// $pdf->SetXY(150,$y);
// $pdf->MultiCell(50, 6, '\\'.number_format($tax), 1, 'R', 0);
// $pdf->Ln();
// $y+=6;
//
/// 2013.12.21 消費税改定対応 end

$pdf->SetXY(110,$y);
$pdf->MultiCell(40, 6, '請求金額', 1, 'C', 0);
$pdf->SetXY(150,$y);
$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data['total_price']), 1, 'R', 0);
$pdf->Ln();
$y+=6;
$pdf->AliasNbPages();
$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetY(-35);
$pdf->Cell(0,10,$pdf->PageNo().'/{nb}', 0, 0, 'R');
        
//$pdf->AutoPrint(true);
$pdf->Output();
?>

