<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_cancel_list extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	// 有効な会場一覧
	$sql = "select * from a_hall where flag=0";
	$hall_list = db_get_all($sql);
	if(isset($_REQUEST['hall_list']) && $_REQUEST['hall_list']){
		$hall_id = $_REQUEST['hall_list'];
	}else{
		$hall_id = 0;
	}
	$this->set('hall_list', $hall_list);
	$this->set('hall_id', $hall_id);

	$c_member_id = null;
	if(isset($_REQUEST['u']) && $_REQUEST['u']){
		$c_member_id = $_REQUEST['u'];
	}
	$this->set('c_member_id', $c_member_id);

	if(isset($_REQUEST['begin_date']) && $_REQUEST['begin_date']){
		$begin_date = $_REQUEST['begin_date'];
	}else{
		$begin_date = '0000-00-00';
	}
	$this->set('begin_date', $begin_date);

	if(isset($_REQUEST['finish_date']) && $_REQUEST['finish_date']){
		$finish_date = $_REQUEST['finish_date'];
	}else{
		$finish_date = '0000-00-00';
	}
	$this->set('finish_date', $finish_date);

	if(isset($_REQUEST['index']) && $_REQUEST['index']){
		$index=$_REQUEST['index'];
	}else{
		$index=0;
	}
	$this->set('index', $index);


	// 件数
	$sql = "select count(reserve_id) as reserve_num from a_reserve_list where cancel_flag = 1 ";

	if($hall_id){
		$sql.= "and hall_id = '$hall_id' ";
	}
	if($c_member_id){
		$sql.= "and c_member_id = '$c_member_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (begin_datetime >= '".$begin_date." 00:00:00' ";
		$sql.= "and finish_datetime <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by reserve_datetime ";

	$result = db_get_all($sql);
	$num = $result[0]['reserve_num'];
	$this->set('num', $num);

	$page_list = get_page_list($index, $num, 10, 30);
	$this->set('page_list', $page_list);

	// 検索
	$sql = "select * from a_reserve_list where cancel_flag = 1 ";

	if($hall_id){
		$sql.= "and hall_id = '$hall_id' ";
	}
	if($c_member_id){
		$sql.= "and c_member_id = '$c_member_id' ";
	}
	if($begin_date!='0000-00-00' and $finish_date!='0000-00-00'){
		$sql.= "and (begin_datetime >= '".$begin_date." 00:00:00' ";
		$sql.= "and finish_datetime <= '".$finish_date." 23:59:59') ";
	}

	$sql.= "order by reserve_datetime ";
	$sql.= "limit ".$index.", 10";

	$result = db_get_all($sql);

	foreach($result as $key=>$value){
		// 日付書式
		$dt = new DateTime($value['tmp_reserve_datetime']);
		$result[$key]['tmp_reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		if($value['reserve_datetime']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['reserve_datetime']);
			$result[$key]['reserve_datetime'] = $dt->format("Y年m月d日 H時i分s秒");
		}else{
			$result[$key]['reserve_datetime'] = 0;
		}
		$dt = new DateTime($value['begin_datetime']);
        $week = get_week($dt->format("Ymd"));
		$result[$key]['datetime'] = $dt->format("Y年m月d日(".$week.")");
		$result[$key]['begin_datetime'] = $dt->format("H時i分");
		$dt = new DateTime($value['finish_datetime']);
		$result[$key]['finish_datetime'] = $dt->format("H時i分");
		if($value['pay_checkdate']!='0000-00-00 00:00:00'){
			$dt = new DateTime($value['pay_checkdate']);
			$result[$key]['pay_checkdate'] = $dt->format("Y年m月d日");
		}else{
			$result[$key]['pay_checkdate'] = 0;
		}

		$dt = new DateTime($value['cancel_datetime']);
		$result[$key]['cancel_datetime'] = $dt->format("Y年m月d日 H時i分s秒");

		// 会場
		$sql = "select * from a_hall where hall_id = ".$value['hall_id'];
		$hall_data = db_get_all($sql);
		$result[$key]['hall_data'] = isset($hall_data[0]) ? $hall_data[0] : null;
		// 部屋
		$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
		$room_data = db_get_all($sql);
		$result[$key]['room_data'] = isset($room_data[0]) ? $room_data[0] : null;

		//備品
		$sql = "select * from a_reserve_v where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_v_list = db_get_all($sql);
		$cancel_vessel_price = 0;
		global $tmp_tax;
		if($reserve_v_list){
			foreach($reserve_v_list as $k=>$v){
				//var_dump($v);
				$vessel_data = get_vessel_data($v['vessel_id']);
				$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
				$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];
				$tmp_price = $vessel_data['price'];	
			// 備品使用料
				$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
				$tmp_price = round($tmp_price * (1 + $tmp_tax));		
				$cancel_vessel_price += $tmp_price*$v['num'];	
			}
		}else{
			$reserve_v_list = 0;
		}
		$result[$key]['reserve_v_list'] = $reserve_v_list;
		//サービス
		$sql = "select * from a_reserve_s where reserve_id = ".$value['reserve_id']." and cancel_flag = 0";
		$reserve_s_list = db_get_all($sql);
		$cancel_service_price = 0;
		if($reserve_s_list){
			foreach($reserve_s_list as $k=>$v){
				$service_data = get_service_data($v['service_id']);
				$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
				$reserve_s_list[$k]['memo'] = $service_data['memo2'];
				if($service_data['cancel_mode']==1){
					$cancel_service_price += $service_data['price']*$v['num'];
				}
			}
		}else{
			$reserve_s_list = 0;
		}
		$result[$key]['cancel_service_price'] = $cancel_service_price;
		$result[$key]['cancel_vessel_price'] = $cancel_vessel_price;
		$result[$key]['reserve_s_list'] = $reserve_s_list;

		// 会員情報
		$sql = "select * from c_member where c_member_id = ".$value['c_member_id'];
		$c_member = db_get_all($sql);
		$result[$key]['c_member'] = $c_member[0];
		// プロフィール
		$result[$key]['corp'] = get_profile_value($value['c_member_id'], 12);

		//$sql = "" 

		// 請求
		


		// 返金
		$sql = "select * from a_reserve_list where reserve_id = ".$value['reserve_id'];
		$result1 = db_get_all($sql);
		$sql = "select * from a_amount_billed where reserve_id = ".$value['reserve_id'];
		$ab_data = db_get_all($sql);
		$result[$key]['ab_data'] = isset($ab_data[0]) ? $ab_data[0] : null;	

		$result[$key]['cancel_list'] = get_cancel_list($value['reserve_id']);
		$room_price = $result1[0]['room_price'];
		$vessel_price = $result1[0]['vessel_price'];
		$service_price = $result1[0]['service_price'];		
		$result[$key]['tmp_flag'] = $result1[0]['tmp_flag'];
		/*$begindate_s = date('Y-m-d',strtotime($result1[0]['begin_datetime']));
        $canceldate_s=date('Y-m-d',strtotime($result1[0]['cancel_datetime']));
        $timeDiff = abs(strtotime($begindate_s)-strtotime($canceldate_s));
        $numberDays = $timeDiff/86400;  
        $numBeforeDate = intval($numberDays);
        if($numBeforeDate <=9){
            $cancel_price = ceil(($room_price + $vessel_price+$service_price));         
        }
        else if($numBeforeDate >9 && $numBeforeDate <=14){             
             $cancel_price = ceil(($room_price + $vessel_price+$service_price))*0.5;
        }
        else if($numBeforeDate >14 && $numBeforeDate <=29)
        {            
            $cancel_price = ceil(($room_price + $vessel_price+$service_price))*0.2;
        }
        else{             
             $cancel_price = ceil(($room_price + $vessel_price+$service_price))*0.1;
        }*/
		$sql = "select * from a_repayment_list where reserve_id = ".$value['reserve_id']." order by repayment_id desc";
		$repay_data = db_get_all($sql);
		$result[$key]['repay_data'] = isset($repay_data[0]) ? $repay_data[0] : null;
		$cancel_list = get_cancel_list2($value['reserve_id']);
		$cancel_price = ceil(($room_price + $vessel_price+$service_price))*($cancel_list['percent']*0.01);
		$result[$key]['cancel_price'] = $cancel_price;
	}
	global $cancel_flag;//add by quyhoa
	global $tmp_flag;//add by quyhoa
	$this->set('reserve_list', $result);
	$this->set('cancel_flag', $cancel_flag);
	//$this->set('cancel_price', $cancel_price);

	$this->set('tmp_flag', $tmp_flag);

        return 'success';
    }
}

?>
