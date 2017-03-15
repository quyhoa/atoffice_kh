<?php
include 'fpdf/mbfpdf.php';
include 'HTTP.php';
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
function setXY($pdf,$x,&$y,$line_height)
{
    if (($y + $line_height) >= 267) {
        $pdf->AddPage();
        $y = 20; 
    }
    $pdf->SetXY($x,$y);
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

	

	$reserve_num=0;
	for($i=1;$i<=10;$i++){
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

    $cMemeberId = isset($cMemeberId) ? $cMemeberId : '';
	$sql = "select * from c_member where c_member_id = '$cMemeberId'";
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
		$usedate[$i] = date("m/d/Y",strtotime($reserve_data[$i]['begin_datetime']));
        $usetime[$i]['start']=date("H:i",strtotime($reserve_data[$i]['begin_datetime']));
		$usetime[$i]['end']=date("H:i",strtotime($reserve_data[$i]['finish_datetime']));
		
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
        $service_price=0;  
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




////////////////////////////////////////////////////////////////////////////

$GLOBALS['EUC2SJIS'] = true;

$pdf=new MBFPDF();
$pdf->AddMBFont(GOTHIC ,'SJIS');
$pdf->AddMBFont(PGOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO ,'SJIS');
$pdf->AddMBFont(PMINCHO,'SJIS');
$pdf->AddMBFont(KOZMIN ,'SJIS');
$pdf->Open();
$pdf->SetDisplayMode('default','continuous');
$pdf->AddPage();
$pdf->SetXY(50,20);
$pdf->SetDrawColor(50,60,100);
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 2, $today, 0, 'R', 0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',20);
$pdf->MultiCell(120,10,'御　見　積　書',0,0,'C',0);
$pdf->Ln();
$pdf->SetFont(GOTHIC,'B',12);
$pdf->MultiCell(0, 5, mb_convert_encoding($corp, "EUC-JP", "auto").' 様', 0, 'L', 0);
$pdf->Ln();
$pdf->MultiCell(0, 2, '株式会社アットオフィス', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 2, '東京都港区南青山2-2-8　DFビル３F', 0, 'R', 0);
$pdf->Ln();
$pdf->MultiCell(0, 0, '下記の通り御見積書を作成いたしました。', 0, 'L', 0);
$pdf->MultiCell(0, 2, 'TEL:03-5465-5506', 0, 'R', 0);
/*$pdf->Ln();
$pdf->MultiCell(0, 2, 'FAX:03-6418-5424', 0, 'R', 0);*/
$pdf->Ln();
$pdf->MultiCell(0, 0, 'ご検討の程よろしくお願い申し上げます。', 0, 'L', 0);
$pdf->Ln();

//=================
    $pdf->SetFont(GOTHIC,'B',10);
    $pdf->SetXY(120,80);
    $pdf->MultiCell(40, 6, '担当', 1, 'C', 0);
    $pdf->SetXY(160,80);
    $pdf->MultiCell(40, 6, '受付', 1, 'C', 0);
    $pdf->SetFont(GOTHIC,'B',10);
    $pdf->SetXY(120,86);
    $pdf->MultiCell(40, 20, '', 1, 'C', 0);
    $pdf->SetXY(160,86);
    $pdf->MultiCell(40, 20, '', 1, 'C', 0);
    
    $pdf->Ln();

$pdf->SetXY(10,100);

$total = 0;
$a_room=array();
for($i=0;$i<$reserve_num;$i++){
    $room_cost=0;
	$sql = "select hall_name from a_hall where hall_id = ".$reserve_data[$i]['hall_id'];
	$hall_name = db_get_all($sql, $db);
	$sql = "select room_name from a_room where hall_id = ".$reserve_data[$i]['hall_id']." and room_id = ".$reserve_data[$i]['room_id'];
	$room_name = db_get_all($sql, $db);
    $room_cost += $reserve_data[$i]['room_price'];
    $a_room[$i]['room_name'] = $room_name[0]['room_name'];
    $a_room[$i]['room_price']= $reserve_data[$i]['room_price'];
    $a_room[$i]['hall_name'] = $hall_name[0]['hall_name'];
    $service_cost=0;
   if(!empty($vessel_rd[$i]) || !empty($service_rd[$i]))
    {
        if(!empty($vessel_rd[$i]))
        {
             $service_cost+=$reserve_data[$i]['vessel_price'];
    
            
        }
        if($service_rd[$i])
        {
            $service_cost+=$reserve_data[$i]['service_price'];
    
        }
    }
    
    $total +=($service_cost+$room_cost);
 }   


$pdf->SetFont(GOTHIC,'U',20);
$pdf->MultiCell(0,10,'御見積合計金額　　￥'.number_format($total),0,'L',0);
$pdf->Ln();

$pdf->SetFont(GOTHIC,'B',10);
$pdf->SetXY(10,120);
$pdf->MultiCell(150, 6, '品目', 1, 'C', 0);
$pdf->SetXY(160,120);
$pdf->MultiCell(40, 6, '合計金額（税込）', 1, 'C', 0);
$y=120;
$money =array();
$y+=6;
for($i=0;$i<$reserve_num;$i++){
    
	$hall_name = $a_room[$i]['hall_name'];

    $room_name = $a_room[$i]['room_name'];
    $room_price = $reserve_data[$i]['room_price'];
    $money[$i]['room_price']= $reserve_data[$i]['room_price'];
    
    //$pdf->SetFont(GOTHIC,'B',10);
    $column_width =120;
    $name_room_reserve=mb_convert_encoding($hall_name, "EUC-JP", "auto").' '.mb_convert_encoding($room_name, "EUC-JP", "auto").'('.$usetime[$i]['start'].'〜'.$usetime[$i]['end'].')'.'利用料として';
    //var_dump($pdf->GetStringWidth($name_room_reserve));
    $line_width= ceil($pdf->GetStringWidth($name_room_reserve));
    $number_of_lines = ceil( $line_width / ($column_width) );
    if($number_of_lines >1){
        $number_of_lines+=1;
       $pdf->SetFont(GOTHIC,'B',9);
    }
        
     
    //$line_height = 6;
    //$height_of_cell = ceil($number_of_lines * $line_height ); 
    //$pdf->SetXY(10,$y);
    //setXY($pdf,10,$y,$height_of_cell);
    
    //code change format date
    
    $dt1 = new DateTime($usedate[$i]);
	$usedate1= $dt1->format("Y年m月d日");
   
    $pdf->SetXY(10,$y);
	$pdf->MultiCell(155, 6, $usedate1.' '.$name_room_reserve, "L B T", 'L', 0);
	$pdf->SetXY(160,$y);
	$pdf->MultiCell(40, 6, '\\'.number_format($reserve_data[$i]['room_price']), 1, 'R', 0);
	$pdf->Ln();

	$y+=6;
    $verssel_price=0;
    if(!empty($vessel_rd[$i]) || !empty($service_rd[$i]))
    {   
        
            
        if(!empty($vessel_rd[$i]))
        {
            $j=0;
                $verssel_price +=$reserve_data[$i]['vessel_price'];
            	foreach($vessel_rd[$i] as $key=>$value){
            	   
            	    if($value['name']){
            	       //$verssel_price +=$value['price'];
            		    setXY($pdf,10,$y,6);
            			$pdf->MultiCell(150, 6, $usedate1.' 備品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として', 1, 'L', 0);
            			setXY($pdf,160,$y,6);
            	        if($j==0){
            	        $pdf->MultiCell(40, 6, '備品利用総額：', 1, 'L', 0);               	           
            			setXY($pdf,160,$y,6);
                        $pdf->MultiCell(40, 6,'\\'.number_format($reserve_data[$i]['vessel_price']), 'R B', 'R', 0);
                    	}else{
                    	  		$pdf->MultiCell(40, 6, '', 1, 'R', 0);
                    	}
                        $j++;
            			$pdf->Ln();
            			$y+=6;
            	    }
                    
		     }
          
                
                
                
            }
            
        
        if($service_rd[$i])
        {
            $j=0;
            $verssel_price +=$reserve_data[$i]['service_price'];
            foreach($service_rd[$i] as $key=>$value){
                if($value['name']){
                    setXY($pdf,10,$y,6);
                	$str=$usedate1.' サービス品（'.mb_convert_encoding($value['name'], "EUC-JP", "auto").'ｘ'.$value['num'].'個）利用料として';
        			$sl=strlen($str);
        			$pdf->MultiCell(150, 6, $str, 1, 'L', 0);
        			$pdf->SetFont(GOTHIC,'B',10);
        			setXY($pdf,160,$y,6);
        			if($key==0){
        				$pdf->MultiCell(40, 6, 'サービス品総額：', 1, 'L', 0);
        				setXY($pdf,160,$y,6);
                        $pdf->MultiCell(40, 6, '\\'.number_format($reserve_data[$i]['service_price']), 0, 'R', 0);
        			}else{
        				$pdf->MultiCell(40, 6, '', 1, 'R', 0);
                 	}
        			$pdf->Ln();
        			$y+=6;
                }
    			
    		}
            
        }
        
    }
    $money[$i]['sevice_price']=$verssel_price;
    $total_after_tax=($room_price +$verssel_price)*8/100 +($room_price +$verssel_price);
    $money[$i]['total_after_tax']=$total_after_tax;
    $money[$i]['total_notax']=$room_price +$verssel_price;
    $money[$i]['total_tax']=($room_price +$verssel_price)*8/100;
  
     
}
if(!empty($money))
{
    $total_money_notax=0;
    $total_money_tax = 0;
    $total_mone=0;
    foreach($money as $kmoney =>$vmoney)
    {
        $total_money_notax +=$vmoney['total_notax'];
        $total_money_tax +=$vmoney['total_tax'];
        $total_mone +=$vmoney['total_after_tax'];
    }
    //var_dump($total_money_notax);
    
   /* $pdf->SetFont(GOTHIC,'B',10);
    setXY($pdf,10,$y,6);
    $pdf->MultiCell(150, 6, '合計金額として  '.'\\'.number_format($total_mone).' （税込）御見積申し上げます。', 1, 'L', 0);
    setXY($pdf,160,$y,6);
    $pdf->MultiCell(40, 6, '', 1, 'C', 0);
    
    $y +=12;
    $pdf->SetFont(GOTHIC,'B',10);
    setXY($pdf,100,$y,6);
    $pdf->MultiCell(60, 6, '合計金額（税抜）', 1, 'C', 0);
    setXY($pdf,160,$y,6);
    $pdf->MultiCell(40, 6, '\\'.number_format($total_money_notax), 1, 'R', 0);
    $y+=6;
    $pdf->SetFont(GOTHIC,'B',10);
    setXY($pdf,100,$y,6);
    $pdf->MultiCell(60, 6, '消費税（8％）', 1, 'C', 0);
    setXY($pdf,160,$y,6);
    $pdf->MultiCell(40, 6, '\\'.number_format($total_money_tax), 1, 'R', 0);*/
   // $y+=6;
    $pdf->SetFont(GOTHIC,'B',10);
    setXY($pdf,100,$y,6);
    $pdf->MultiCell(60, 6, '合計金額（税込）', 1, 'C', 0);
    setXY($pdf,160,$y,6);
    $pdf->MultiCell(40, 6, '\\'.number_format($total_money_notax), 1, 'R', 0);
    
}

$pdf->Ln();

$y+=10;
$pdf->SetFont(GOTHIC,'B',14);

setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '【キャンセルポリシー】', 0, 'L', 0);
$y +=6;
$pdf->SetFont(GOTHIC,'B',10);
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '※キャンセル料金については以下の通り発生いたします。', 0, 'L', 0);

$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・利用日から起算して（利用日含む）10日前まで：料金の100％（返金なし）', 0, 'L', 0);

$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・利用日から起算して（利用日含む）11日前〜15日前まで：料金の50％', 0, 'L', 0);

$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・利用日から起算して（利用日含む）16日前〜30日前まで：料金の20％', 0, 'L', 0);

$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・利用日から起算して（利用日含む）31日以上前：料金の10％', 0, 'L', 0);

$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・オプション機器及びケイタリングについても同様といたします。 	', 0, 'L', 0);
$y +=6;
setXY($pdf,10,$y,6);
$pdf->MultiCell(200, 6, '・理由の如何を問わず弊社より予約確定返答後に支払いがなされていない場合も同様といたします。', 0, 'L', 0);

$pdf->Output();
?>

