<?php

/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */
// 画像リスト
class admin_page_set_reserve_confirm extends OpenPNE_Action {

    function execute($requests) {
 
        if(isset($_POST['delete']) && $_POST['delete']==1)
        {
            $pre_id = $_POST['pre_id'];
            $pid = $_POST['pid'];
            $del_a_pre_reserve = "delete from a_pre_reserve where pid=$pid";
            $del_a_pre_rs = "delete from a_pre_rs where pid=$pid";
            $del_a_pre_rv = "delete from a_pre_rv where pid=$pid";
            db_get_all($del_a_pre_reserve);
            db_get_all($del_a_pre_rs);
            db_get_all($del_a_pre_rv);
        }
        else{
            $pre_id = $_REQUEST['pre_id'];
        }
        $this->set('year', $_POST['year']);
    	$this->set('month', $_POST['month']);
    	$this->set('day', $_POST['day']);
    	$this->set('hall_id', $_POST['hall_id']);
        
        $sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by pid asc";
        $pre_data = db_get_all($sql, $db);
        if (is_null($pre_data)) {
            $msg= "選択した予約が見つかりません。";
            $this->set('msg',$msg);
            
            return 'success';
        }
        $c_member_data = null;
        if ($_REQUEST['uid']) {
            $c_member_id = $_REQUEST['uid'];
            $sql = "select * from c_member where c_member_id = ".$c_member_id;
        	$result = db_get_all($sql);
        	$c_member_data = $result[0];
        } else {
            $c_member_id = 0;
        }
        if($c_member_id){
            if(check_guest($c_member_id)){
                $this->set('guest', "ゲスト");
            }else{
                $this->set('guest', "会員");
            }
        }else{
            $this->set('guest', "ゲスト");
        }
        $this->set('c_member_data',$c_member_data);
        $all_total = 0;
		$reserve_id ='';
        foreach ($pre_data as $key => $value) {

            $hall_id = $value['hall_id'];
            $room_id = $value['room_id'];
			$reserve_id .=$value['pid'].",";
            $dt = new DateTime($value['begin_datetime']);
            $pre_data[$key]['date'] = $dt->format("Y年m月d日");
            $pre_data[$key]['week'] = get_week($dt->format("Ymd"));
            $pre_data[$key]['begin'] = $dt->format("H時i分");
            $dt = new DateTime($value['finish_datetime']);
            $pre_data[$key]['finish'] = $dt->format("H時i分");

             /// 2013.12.21 消費税改定対応 begin
    
        	$tmp_ymd  = strtotime($value['begin_datetime']);
        	$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
        	$tmp_sql  = "";
        	$tmp_sql .= "select rate from a_tax ";		
        	$tmp_sql .= "where stadate <= '$tmp_ymd' ";	
        	$tmp_sql .= "order by stadate desc ";		
        	$tmp_sql .= "limit 0, 1";			
        	$tmp_tab  = db_get_all($tmp_sql);
        	$tmp_tax  = $tmp_tab[0]['rate'] / 100;	

            $sql = "select * from a_hall where hall_id = " . $value['hall_id'];
            $hall_data = db_get_all($sql, $db);
            $pre_data[$key]['hall_data'] = $hall_data[0];



            $sql = "select * from a_room where hall_id = " . $value['hall_id'] . " and room_id = " . $value['room_id'];
            $room_data = db_get_all($sql, $db);
            $pre_data[$key]['room_data'] = $room_data[0];


            $sql = "select * from a_cancel_charge where hall_id = " . $value['hall_id'] . " and pattern_id = " . $room_data[0]['cancel'];
            $cancel_list = db_get_all($sql, $db);
            $pre_data[$key]['cancel_list'] = $cancel_list[0];

            $sql = "select * from a_pre_rv where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $vessel_data = db_get_all($sql, $db);
            if ($vessel_data) {
                foreach ($vessel_data as $k => $v) {
                    $sql = "select * from a_vessel_data where vessel_id = " . $v['vessel_id'];
                    $results = db_get_all($sql, $db);
                    $result=$results[0];
               		$tmp_price = $result['price'];			
            		$tmp_price = round($tmp_price * 100 / 105);		
            		$tmp_price = round($tmp_price * (1 + $tmp_tax));	
            		$result['price'] = $tmp_price;			
                	$vessel_data[$k]['vessel_data'] = $result;
                }
                $pre_data[$key]['vessel_list'] = $vessel_data;
            }
            $sql = "select * from a_pre_rs where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $service_data = db_get_all($sql, $db);
            if ($service_data) {
                foreach ($service_data as $k => $v) {
                    $sql = "select * from a_service_data where service_id = " . $v['service_id'];
                    $results = db_get_all($sql, $db);
                    
                    $result=$results[0];
               		$tmp_price = $result['price'];		
            		$tmp_price = round($tmp_price * 100 / 105);		
            		$tmp_price = round($tmp_price * (1 + $tmp_tax));
            		$result['price'] = $tmp_price;	
                    $service_data[$k]['service_data'] = $result;
                    
                }
                $pre_data[$key]['service_list'] = $service_data;
            }

            $all_total += $value['total_price'];
            
        }
        if(count($pre_data)==0)
        {
           $c_member_id='';
        }
		$sql="select * from a_tmp_user where pre_id='$pre_id'";
		$tmp_user=db_get_all($sql,$db);
		if(!empty($tmp_user)){
			$tmp_user=$tmp_user[0];
		}
		
        $this->set('tmp_user',$tmp_user);
        $this->set('all_total',$all_total);
        $this->set('pre_data',$pre_data);
        $this->set('num_pre_data',count($pre_data));
        $this->set('c_member_id',$c_member_id);
        $this->set('pre_id',$pre_id);
		$this->set('reserve_id',rtrim($reserve_id,","));
        return 'success';
    }

}

?>
