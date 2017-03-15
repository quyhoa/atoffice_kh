<?php
include 'fpdf/mbfpdf.php';
include 'HTTP.php';
$type = 0;
function db_get_all($sql, $db){
//echo $sql."<br>";
	$result = mysql_query($sql, $db);
    if($result != false)
    {
        while($item = mysql_fetch_assoc($result)){
		$rows[]=$item;
    	}
    	return $rows;
    }

}
function setXY($pdf,$x,&$y,$line_height)
{
	global $type;
    if (($y + $line_height) >= 260) {
        
        $y = 20; 
		$pdf->AliasNbPages();
		$pdf->SetFont(GOTHIC,'B',10);
		$pdf->SetY(-35);
		$pdf->Cell(0,10,$pdf->PageNo().'/{nb}', 0, 0, 'R');
		$pdf->AddPage();
		if($type==1){
			$pdf->SetFont(GOTHIC,'B',12);
			$today = date("Y年m月d日");
			$pdf->MultiCell(0, $y, $today, 0, 'R', 0);
			$pdf->Ln();
			$pdf->SetFont(GOTHIC,'B',10);
			$pdf->SetXY(10,$y+14);
			$pdf->MultiCell(140, 6, '品目', 1, 'C', 0);
			$pdf->SetXY(150,$y+14);
			$pdf->MultiCell(50, 6, '合計金額（税込）', 1, 'C', 0);
			$pdf->Ln();
		}
		
		$y +=20;
    }
    $pdf->SetXY($x,$y);
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

	$reserve_num=0;
	for($i=1;$i<=15;$i++){
		if(isset($_POST['res'.$i])){
			if(($reserves[$reserve_num]=$_POST['res'.$i])=="") continue;
		
			if(preg_match("/^[0-9]+$/", $reserves[$reserve_num])){
				$reserve_num++;
			}else{
				echo "error<br>"; break;
				//HTTP::redirect("../../../?page=error");
			}
		}
	}

//	if(isset($_POST['admin'])){

		$sql = "select * from a_reserve_list where ";

		for($i=0;$i<$reserve_num;$i++){
			$sql.="reserve_id = ".$reserves[$i]." or ";
		}
		$sql.="0";

		$reserve_data = db_get_all($sql, $db);
//		var_dump($reserve_data);
		$cMemberId=$reserve_data[0]['c_member_id'];
//		return;
		for($i=1;$i<$reserve_num;$i++){
			if($cMemberId!=$reserve_data[$i]['c_member_id']){
//				HTTP::redirect("../../../?page=error");
			}
		}

/*
		$reserve_data = $reserve_data[0];

		$u=$reserve_data['c_member_id'];

		if($reserve_data['c_member_id'] != $u){
			// 他人の予約
			HTTP::redirect("../../../?page=error");
*/

//	} else HTTP::redirect("../../../?page=error");


	$sql = "select * from c_member where c_member_id = '$cMemeberId'";
	$c_member = db_get_all($sql, $db);
	$c_member = $c_member[0];
    if(isset($_POST['reserve_name']) && $_POST['reserve_name'] !='')
    {
        $corp = $_POST['reserve_name'];
    }
    else{
        $corp = get_profile_value($cMemberId, 12, $db);
   
    }
	

	$today = date("Y年m月d日");

	$dt = new DateTime($reserve_data[0]['pay_checkdate']);
	$pay_checkdate = $dt->format("Y年m月d日");
//
//-----

	$all_total=0;

/// 2013.12.21 消費税改定対応 begin
//
//	$sql = "select rate from a_tax";
//	$tax_rate = db_get_all($sql, $db);
//	$tax_rate = ($tax_rate[0]['rate']*0.01)+1;
//
/// 2013.12.21 消費税改定対応 end

    $tax_rate=1;
	for($i=0;$i<$reserve_num;$i++){

		$dt = new DateTime($reserve_data[$i]['pay_limitdate']);
		$limitdate[$i] = $dt->format("Y年m月d日");

		$dt = new DateTime($reserve_data[$i]['begin_datetime']);
		$usedate[$i] = $dt->format("Y年m月d日");

		$sql = "select hall_name from a_hall where hall_id = ".$reserve_data[$i]['hall_id'];
		$hall_name_d = db_get_all($sql, $db);
		$hall_name[$i] = $hall_name_d[0]['hall_name'];

		$sql = "select room_name from a_room where hall_id = ".$reserve_data[$i]['hall_id']." and room_id = ".$reserve_data[$i]['room_id'];
		$room_name_d = db_get_all($sql, $db);
		$room_name[$i] = $room_name_d[0]['room_name'];

		$sql = "select * from a_reserve_v where reserve_id = '".$reserve_data[$i]['reserve_id']."' and cancel_flag=0";
		$vessel_rd_d = db_get_all($sql, $db);
		if($vessel_rd_d){
			foreach($vessel_rd_d as $key=>$value){
				$vessel_rd[$i][$key]=$value;
				$vessel_rd[$i][$key]['name']=get_vessel_name($value['vessel_id'], $db);
			}
		}

		$sql = "select * from a_reserve_s where reserve_id = '".$reserve_data[$i]['reserve_id']."' and cancel_flag=0";
		$service_rd_d = db_get_all($sql, $db);
		if($service_rd_d){
			foreach($service_rd_d as $key=>$value){
				$service_rd[$i][$key]=$value;
				$service_rd[$i][$key]['name']=get_service_name($value['service_id'], $db);
			}
		}

		$all_total+=$reserve_data[$i]['total_price'];
		$taxless_price[$i] = $reserve_data[$i]['total_price']/$tax_rate;
		$tax[$i] = $reserve_data[$i]['total_price']-$taxless_price[$i];

		$virtual_code_d = $reserve_data[$i]['virtual_code'];
		$branch_code[$i] = substr($virtual_code_d, 0, 3);
		$virtual_code[$i] = substr($virtual_code_d, 4, 10);

		$sql = "select * from a_virtual_account_conf where branch_id = '".$branch_code[$i]."'";
		$bank_data_d = db_get_all($sql, $db);
		$bank_data[$i] = $bank_data_d[0];
	}
	$all_taxless_price = $all_total/$tax_rate;
	$all_tax = $all_total-$all_taxless_price;


$GLOBALS['EUC2SJIS'] = true;
if(isset($_POST['bill'])){
////////////////////////////////////////////////////////////////////////////
// 請求書
$type = 1;
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
//$pdf->MultiCell(0, 3, 'No.'.$reserve_id, 0, 'R', 0);
//$pdf->Ln();
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
$pdf->MultiCell(0, 0, $limitdate[0].'までにお振り込みください。', 0, 'L', 0);
$pdf->Ln();
$pdf->Image('kakuin.gif', 160, 75, 40.0);
$pdf->Ln();



$pdf->SetXY(10,90);

$pdf->SetFont(GOTHIC,'U',20);
$pdf->MultiCell(0,10,'ご請求額　　　　　￥'.number_format($all_total)."-",0,'L',0);
$pdf->Ln();

//edit
$pdf->SetXY(10,100);
$pdf->SetFont(GOTHIC,'U',12);
$pdf->MultiCell(0, 4, '振込先', 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 3, '振込指定銀行：'.mb_convert_encoding($bank_data[0]['bank'], "EUC-JP", "auto")."・".mb_convert_encoding($bank_data[0]['branch'], "EUC-JP", "auto")."(支店番号：".$branch_code[0].")", 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 3, '口座番号：（普通）'.$virtual_code[0], 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 3, '口座名義人：'.mb_convert_encoding($bank_data[0]['account'], "EUC-JP", "auto"), 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 6, '※ なお、お振込手数料は貴社にてご負担下さいます様、お願い申しあげます。', 0, 'L', 0);
$pdf->Ln();

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,140);
$pdf->MultiCell(140, 6, '品目', 1, 'C', 0);
$pdf->SetXY(150,140);
$pdf->MultiCell(50, 6, '合計金額（税込）', 1, 'C', 0);
$pdf->Ln();

$y=146;

for($i=0;$i<$reserve_num;$i++){

	//$pdf->SetXY(10,$y);
	setXY($pdf,10,$y,6);
	$pdf->MultiCell(140, 6, $usedate[$i].' '.mb_convert_encoding($hall_name[$i], "EUC-JP", "auto").' '.mb_convert_encoding($room_name[$i], "EUC-JP", "auto").'利用料として', 1, 'L', 0);
	$column_width =120;
    $line_width= ceil($pdf->GetStringWidth(mb_convert_encoding($hall_name[$i], "EUC-JP", "auto")));
    $number_of_lines = ceil( $line_width / ($column_width) );
    if($number_of_lines >1){
        $number_of_lines+=1;
       $pdf->SetFont(GOTHIC,'B',9);
    }
    //$pdf->SetXY(150,$y);
	setXY($pdf,150,$y,6);
	$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data[$i]['room_price']), 1, 'R', 0);
	
    $pdf->Ln();

	$y+=6;
	if($vessel_rd[$i]){
		foreach($vessel_rd[$i] as $key=>$value){
			//$pdf->SetXY(10,$y);
			setXY($pdf,10,$y,6);
            $str=$usedate[$i].' 備品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として';
			$sl=strlen($str);
			if($sl<62) $fsize=10;
			else if($sl<80) $fsize=9;
			else $fsize=8;

			$pdf->SetFont(GOTHIC,'B',$fsize);
			$pdf->MultiCell(140, 6, $str, 1, 'L', 0);
			$pdf->SetFont(GOTHIC,'B',10);
            
            //$pdf->SetXY(150,$y);
			setXY($pdf,150,$y,6);
			if($key==0){
					$pdf->MultiCell(50, 6, '備品利用総額：', 1, 'L', 0);
					$pdf->SetXY(150,$y);
					$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data[$i]['vessel_price']), 0, 'R', 0);
			}else{
					$pdf->MultiCell(50, 6, '', 1, 'R', 0);
			}			$pdf->Ln();
			$y+=6;
		}
	}

	if($service_rd[$i]){
		foreach($service_rd[$i] as $key=>$value){
			//$pdf->SetXY(10,$y);
			setXY($pdf,10,$y,6);
			$str=$usedate[$i].' サービス品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として';
			$sl=strlen($str);
			if($sl<62) $fsize=10;
			else if($sl<80) $fsize=9;
			else $fsize=8;

			$pdf->SetFont(GOTHIC,'B',$fsize);
			$pdf->MultiCell(140, 6, $str, 1, 'L', 0);
			$pdf->SetFont(GOTHIC,'B',10);
			//$pdf->SetXY(150,$y);
			setXY($pdf,150,$y,6);
		if($key==0){
				$pdf->MultiCell(50, 6, 'サービス品総額：', 1, 'L', 0);
				$pdf->SetXY(150,$y);
				$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data[$i]['service_price']), 0, 'R', 0);
			}else{
				$pdf->MultiCell(50, 6, '', 1, 'R', 0);
			}			$pdf->Ln();
			$y+=6;
		}
	}
}

/// 2013.12.21 消費税改定対応 begin
// 
// $pdf->SetXY(110,$y);
// $pdf->MultiCell(40, 6, '税抜き合計金額', 1, 'C', 0);
// $pdf->SetXY(150,$y);
// $pdf->MultiCell(50, 6, '\\'.number_format($all_taxless_price), 1, 'R', 0);
// $pdf->Ln();
// $y+=6;
//
// $pdf->SetXY(110,$y);
// $pdf->MultiCell(40, 6, '消費税', 1, 'C', 0);
// $pdf->SetXY(150,$y);
// $pdf->MultiCell(50, 6, '\\'.number_format($all_tax), 1, 'R', 0);
// $pdf->Ln();
// $y+=6;
//
/// 2013.12.21 消費税改定対応 begin

//$pdf->SetXY(110,$y);
setXY($pdf,110,$y,6);
$pdf->MultiCell(40, 6, '請求金額', 1, 'C', 0);
//$pdf->SetXY(150,$y);
setXY($pdf,150,$y,6);
$pdf->MultiCell(50, 6, '\\'.number_format($all_total), 1, 'R', 0);
$pdf->Ln();
$y+=6;
$pdf->AliasNbPages();
$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetY(-35);
$pdf->Cell(0,10,$pdf->PageNo().'/{nb}', 0, 0, 'R');


}else{
////////////////////////////////////////////////////////////////////////////
// 領収書
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
$pdf->MultiCell(70,10,'領収書',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',15);
/*
$r="";
for($i=0;$i<$reserve_num;$i++){
	if($i!=0) $r.=",";
	$r.=$reserve_data[$i]['reserve_id'];
}

$pdf->MultiCell(0, 3, '予約番号.'.$r, 0, 'R', 0);
$pdf->Ln();
*/
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 5, mb_convert_encoding($corp, "EUC-JP", "auto").' 様', 0, 'L', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'U',20);
$pdf->MultiCell(0,10,'￥　'.number_format($all_total)."-",0,'C',0);
$pdf->SetFont(GOTHIC,'B',12);
$pdf->SetXY(100,75);
$pdf->MultiCell(0, 6, $pay_checkdate, 0, 'L', 0);
$pdf->SetFont(GOTHIC,'B',12);
$pdf->SetXY(100,85);
$pdf->MultiCell(0, 6, '上記　正に領収いたしました', 0, 'L', 0);

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,100);
$pdf->MultiCell(0, 6, 'ご利用明細', 0, 'L', 0);
$pdf->SetFont(GOTHIC,'B',10);
$y=106;
for($i=0;$i<$reserve_num;$i++){
	$sql = "select hall_name from a_hall where hall_id = ".$reserve_data[$i]['hall_id'];
	$hall_name = db_get_all($sql, $db);
	$hall_name = $hall_name[0]['hall_name'];

	$sql = "select room_name from a_room where hall_id = ".$reserve_data[$i]['hall_id']." and room_id = ".$reserve_data[$i]['room_id'];
	$room_name = db_get_all($sql, $db);
	$room_name = $room_name[0]['room_name'];

//$pdf->SetXY(10,$y);
setXY($pdf,10,$y,6);
$pdf->MultiCell(0, 6, '会場名：　'.mb_convert_encoding($hall_name, "EUC-JP", "auto"), 0, 'L', 0);
$y+=6;
//$pdf->SetXY(10,$y);
setXY($pdf,10,$y,6);
$pdf->MultiCell(0, 6, '部屋名：　'.mb_convert_encoding($room_name, "EUC-JP", "auto"), 0, 'L', 0);
$y+=6;

$pdf->SetFont(GOTHIC,'B',10);
//$pdf->SetXY(10,$y);
setXY($pdf,10,$y,6);
$pdf->MultiCell(30, 6, 'ご利用日', 1, 'C', 0);
//$pdf->SetXY(40,$y);
setXY($pdf,40,$y,6);
$pdf->MultiCell(100, 6, '内容', 1, 'C', 0);
//$pdf->SetXY(140,$y);
setXY($pdf,140,$y,6);
$pdf->MultiCell(60, 6, '金額(税込)', 1, 'C', 0);
$pdf->Ln();
$y+=6;

//$pdf->SetXY(10,$y);
setXY($pdf,10,$y,6);
$pdf->MultiCell(30, 6, $usedate[$i], 1, 'C', 0);
//$pdf->SetXY(40,$y);
setXY($pdf,40,$y,6);
$pdf->MultiCell(100, 6, '会議室利用料金', 1, 'L', 0);
$pdf->SetXY(140,$y);	//124
$pdf->MultiCell(60, 6, "\\".number_format($reserve_data[$i]['room_price']), 1, 'R', 0);
$pdf->Ln();
$y+=6;

//$y = 130;
if($vessel_rd[$i]){
	foreach($vessel_rd[$i] as $key=>$value){
		//$pdf->SetXY(10,$y);
		setXY($pdf,10,$y,6);
		$pdf->MultiCell(30, 6, $usedate[$i], 1, 'C', 0);
		//$pdf->SetXY(40,$y);
		setXY($pdf,40,$y,6);
		$pdf->MultiCell(100, 6, mb_convert_encoding($value['name'], "EUC-JP", "auto")."(数量:".$value['num'].")", 1, 'L', 0);
		//$pdf->SetXY(140,$y);
		setXY($pdf,140,$y,6);
		//$pdf->MultiCell(60, 6, "\\".number_format($value['price']*$value['num']), 1, 'R', 0);
		if($key==0){
					$pdf->MultiCell(60, 6, '備品利用総額：', 1, 'L', 0);
					$pdf->SetXY(150,$y);
					$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data[$i]['vessel_price']), 0, 'R', 0);
		}else{
					$pdf->MultiCell(60, 6, '', 1, 'R', 0);
			}		
		$pdf->Ln();
		$y+=6;
	}
}
if($service_rd[$i]){
	foreach($service_rd[$i] as $key=>$value){
		//$pdf->SetXY(10,$y);
		setXY($pdf,10,$y,6);
		$pdf->MultiCell(30, 6, $usedate[$i], 1, 'C', 0);
		//$pdf->SetXY(40,$y);
		setXY($pdf,40,$y,6);
//		$pdf->SetFont(GOTHIC,'B',10);
/*
		$sl=strlen($fsize);
		if($sl<62) $fsize=10;
		else if($sl<80) $fsize=9;
		else $fsize=8;

		$pdf->SetFont(GOTHIC,'B',$fsize);
*/
		$str=mb_convert_encoding($value['name'], "EUC-JP", "auto")."(数量:".$value['num'].")";
		$pdf->MultiCell(100, 6, $str, 1, 'L', 0);
		$pdf->SetFont(GOTHIC,'B',10);
		//$pdf->SetXY(140,$y);
		setXY($pdf,140,$y,6);
		//$pdf->MultiCell(60, 6, "\\".number_format($value['price']*$value['num']), 1, 'R', 0);
		if($key==0){
					$pdf->MultiCell(60, 6, 'サービス品総額：', 1, 'L', 0);
					$pdf->SetXY(150,$y);
					$pdf->MultiCell(50, 6, '\\'.number_format($reserve_data[$i]['service_price']), 0, 'R', 0);
			}else{
				$pdf->MultiCell(60, 6, '', 1, 'R', 0);
			}
		$pdf->Ln();
		$y+=6;
	}
}

}//end for

//$pdf->SetXY(100,$y);
setXY($pdf,100,$y,6);
$pdf->MultiCell(40, 6, '合計（消費税含む）', 1, 'C', 0);
//$pdf->SetXY(140,$y);
setXY($pdf,140,$y,6);
$pdf->MultiCell(60, 6, "\\".number_format($all_total), 1, 'R', 0);
$y+=20;
setXY($pdf,10,$y,6);
$img = $y+12;
//$pdf->Image('inshi.gif', 10, $img, 40.0);
$img1 = $y+20;
//$pdf->Image('inshi.gif', 10, $img, 40.0);
$pdf->SetXY(20,$img1);
$pdf->Cell(18,20,'収入印紙',1,1,'C');
$pdf->Image('kakuin.gif', 160, $img, 40.0);
$pdf->SetFont(GOTHIC,'B',16);
//$pdf->SetXY(57,235);

$y+=12;
setXY($pdf,57,$y,6);
$pdf->MultiCell(0, 16, '〒107-0062', 0, 'L', 0);
//$pdf->SetXY(57,242);
$y+=6;
setXY($pdf,57,$y,6);
$pdf->MultiCell(0, 16, '東京都港区南青山2-2-8 DFビル3階', 0, 'L', 0);
//$pdf->SetXY(57,248);
$y+=6;
setXY($pdf,57,$y,6);
$pdf->MultiCell(0, 16, '株式会社　ア ッ ト オ フ ィ ス', 0, 'L', 0);
//$pdf->SetXY(57,254);
$y+=6;
setXY($pdf,57,$y,6);
$pdf->MultiCell(0, 16, 'TEL:03-5465-5506', 0, 'L', 0);
//$pdf->SetXY(57,260);
$y+=6;

$pdf->AliasNbPages();
$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetY(-35);
$pdf->Cell(0,10,$pdf->PageNo().'/{nb}', 0, 0, 'R');
}// endif mode

$pdf->Output();
?>

