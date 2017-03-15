<?php

function tmp_room_price_convert(&$tab, $tax) {

    for ($i = 0; $i < count($tab); $i++) {

        /// 本体価格計算
        if ($tab[$i]["k_lowest_price"])
            $tab[$i]["k_lowest_price"] = round($tab[$i]["k_lowest_price"] / 1.05);
        if ($tab[$i]["price1"])
            $tab[$i]["price1"] = round($tab[$i]["price1"] / 1.05);
        if ($tab[$i]["price2"])
            $tab[$i]["price2"] = round($tab[$i]["price2"] / 1.05);
        if ($tab[$i]["price3"])
            $tab[$i]["price3"] = round($tab[$i]["price3"] / 1.05);
        if ($tab[$i]["price4"])
            $tab[$i]["price4"] = round($tab[$i]["price4"] / 1.05);
        if ($tab[$i]["price5"])
            $tab[$i]["price5"] = round($tab[$i]["price5"] / 1.05);
        if ($tab[$i]["price6"])
            $tab[$i]["price6"] = round($tab[$i]["price6"] / 1.05);
        if ($tab[$i]["price7"])
            $tab[$i]["price7"] = round($tab[$i]["price7"] / 1.05);
        if ($tab[$i]["k_price2"])
            $tab[$i]["k_price2"] = round($tab[$i]["k_price2"] / 1.05);
        if ($tab[$i]["k_price3"])
            $tab[$i]["k_price3"] = round($tab[$i]["k_price3"] / 1.05);
        if ($tab[$i]["k_highest_price"])
            $tab[$i]["k_highest_price"] = round($tab[$i]["k_highest_price"] / 1.05);
        if ($tab[$i]["price8"])
            $tab[$i]["price8"] = round($tab[$i]["price8"] / 1.05);
        if ($tab[$i]["price9"])
            $tab[$i]["price9"] = round($tab[$i]["price9"] / 1.05);
        if ($tab[$i]["price12"])
            $tab[$i]["price12"] = round($tab[$i]["price12"] / 1.05);
        if ($tab[$i]["price13"])
            $tab[$i]["price13"] = round($tab[$i]["price13"] / 1.05);
        if ($tab[$i]["price14"])
            $tab[$i]["price14"] = round($tab[$i]["price14"] / 1.05);
        if ($tab[$i]["price15"])
            $tab[$i]["price15"] = round($tab[$i]["price15"] / 1.05);
        if ($tab[$i]["price16"])
            $tab[$i]["price16"] = round($tab[$i]["price16"] / 1.05);
        if ($tab[$i]["price17"])
            $tab[$i]["price17"] = round($tab[$i]["price17"] / 1.05);
        if ($tab[$i]["price18"])
            $tab[$i]["price18"] = round($tab[$i]["price18"] / 1.05);
        if ($tab[$i]["price19"])
            $tab[$i]["price19"] = round($tab[$i]["price19"] / 1.05);
        if ($tab[$i]["price20"])
            $tab[$i]["price20"] = round($tab[$i]["price20"] / 1.05);
        if ($tab[$i]["price21"])
            $tab[$i]["price21"] = round($tab[$i]["price21"] / 1.05);
        if ($tab[$i]["price22"])
            $tab[$i]["price22"] = round($tab[$i]["price22"] / 1.05);
        if ($tab[$i]["price23"])
            $tab[$i]["price23"] = round($tab[$i]["price23"] / 1.05);
        if ($tab[$i]["price24"])
            $tab[$i]["price24"] = round($tab[$i]["price24"] / 1.05);

        /// 消費税額計算
        if ($tab[$i]["k_lowest_price"])
            $tab[$i]["k_lowest_price"] = round($tab[$i]["k_lowest_price"] * $tax);
        if ($tab[$i]["price1"])
            $tab[$i]["price1"] = round($tab[$i]["price1"] * $tax);
        if ($tab[$i]["price2"])
            $tab[$i]["price2"] = round($tab[$i]["price2"] * $tax);
        if ($tab[$i]["price3"])
            $tab[$i]["price3"] = round($tab[$i]["price3"] * $tax);
        if ($tab[$i]["price4"])
            $tab[$i]["price4"] = round($tab[$i]["price4"] * $tax);
        if ($tab[$i]["price5"])
            $tab[$i]["price5"] = round($tab[$i]["price5"] * $tax);
        if ($tab[$i]["price6"])
            $tab[$i]["price6"] = round($tab[$i]["price6"] * $tax);
        if ($tab[$i]["price7"])
            $tab[$i]["price7"] = round($tab[$i]["price7"] * $tax);
        if ($tab[$i]["k_price2"])
            $tab[$i]["k_price2"] = round($tab[$i]["k_price2"] * $tax);
        if ($tab[$i]["k_price3"])
            $tab[$i]["k_price3"] = round($tab[$i]["k_price3"] * $tax);
        if ($tab[$i]["k_highest_price"])
            $tab[$i]["k_highest_price"] = round($tab[$i]["k_highest_price"] * $tax);
        if ($tab[$i]["price8"])
            $tab[$i]["price8"] = round($tab[$i]["price8"] * $tax);
        if ($tab[$i]["price9"])
            $tab[$i]["price9"] = round($tab[$i]["price9"] * $tax);
        if ($tab[$i]["price10"])
            $tab[$i]["price10"] = round($tab[$i]["price10"] * $tax);
        if ($tab[$i]["price11"])
            $tab[$i]["price11"] = round($tab[$i]["price11"] * $tax);
        if ($tab[$i]["price12"])
            $tab[$i]["price12"] = round($tab[$i]["price12"] * $tax);
        if ($tab[$i]["price13"])
            $tab[$i]["price13"] = round($tab[$i]["price13"] * $tax);
        if ($tab[$i]["price14"])
            $tab[$i]["price14"] = round($tab[$i]["price14"] * $tax);
        if ($tab[$i]["price15"])
            $tab[$i]["price15"] = round($tab[$i]["price15"] * $tax);
        if ($tab[$i]["price16"])
            $tab[$i]["price16"] = round($tab[$i]["price16"] * $tax);
        if ($tab[$i]["price17"])
            $tab[$i]["price17"] = round($tab[$i]["price17"] * $tax);
        if ($tab[$i]["price18"])
            $tab[$i]["price18"] = round($tab[$i]["price18"] * $tax);
        if ($tab[$i]["price19"])
            $tab[$i]["price19"] = round($tab[$i]["price19"] * $tax);
        if ($tab[$i]["price20"])
            $tab[$i]["price20"] = round($tab[$i]["price20"] * $tax);
        if ($tab[$i]["price21"])
            $tab[$i]["price21"] = round($tab[$i]["price21"] * $tax);
        if ($tab[$i]["price22"])
            $tab[$i]["price22"] = round($tab[$i]["price22"] * $tax);
        if ($tab[$i]["price23"])
            $tab[$i]["price23"] = round($tab[$i]["price23"] * $tax);
        if ($tab[$i]["price24"])
            $tab[$i]["price24"] = round($tab[$i]["price24"] * $tax);
    }
}

function tmp_pack_price_convert(&$tab, $tax) {

    for ($i = 0; $i < count($tab); $i++) {

        if ($tab[$i]["koma2"] == 0) {

            /// 本体価格計算
            if ($tab[$i]["price"])
                $tab[$i]["price"] = round($tab[$i]["price"] / 1.05);

            /// 消費税額計算
            if ($tab[$i]["price"])
                $tab[$i]["price"] = round($tab[$i]["price"] * $tax);
        }
    }
}

class admin_page_set_reserve_list extends OpenPNE_Action {

    function execute($requests) {
        
    
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
    $pid='';
    $time_limit = "NOW() + INTERVAL 3 hour ";
    if(isset($_POST['pid']) && isset($_POST['edit']) && $_POST['edit']==1)
    {
        $pid=$_POST['pid'];
        if($pid !='')
        {
            $sql = "select * from a_pre_reserve where pid='".$pid."' ";
            $pre_resever_data = db_get_all($sql);
            $pre_resever_data = $pre_resever_data[0];
            $time_limit = "'".$pre_resever_data['limit_datetime']."'";
            $del_a_pre_reserve = "delete from a_pre_reserve where pid=$pid";
            $del_a_pre_rs = "delete from a_pre_rs where pid=$pid";
            $del_a_pre_rv = "delete from a_pre_rv where pid=$pid";
            db_get_all($del_a_pre_reserve);
            db_get_all($del_a_pre_rs);
            db_get_all($del_a_pre_rv);
        }
    } 
 	if(isset($_POST['back_confirm']) )
    {
        $pre_id = $_POST['pre_id'];
        
    }
    else if( isset($_POST['delete']) && $_POST['delete']==1)
    {
        $pre_id = $_POST['pre_id'];
        $pid = $_POST['pid'];
        $c_member_id=$_POST['uid'];
        $del_a_pre_reserve = "delete from a_pre_reserve where pid=$pid";
        $del_a_pre_rs = "delete from a_pre_rs where pid=$pid";
        $del_a_pre_rv = "delete from a_pre_rv where pid=$pid";
        db_get_all($del_a_pre_reserve);
        db_get_all($del_a_pre_rs);
        db_get_all($del_a_pre_rv);
    }
    else{
        $hall_id=$_POST['hall_id'];
    	$room_id=$_POST['room_id'];
        //$pid="";
        $pre_id=$_POST['pre_id'];
    
    /// 2013.12.21 消費税改定対応 begin
    
    	$tmp_ymd  = strtotime($_POST['begin_datetime']);
    	$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
    	$tmp_sql  = "";
    	$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
    	$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
    	$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
    	$tmp_sql .= "limit 0, 1";			/// 先頭１件
    	$tmp_tab  = db_get_all($tmp_sql);
    	$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率
    
    /// 2013.12.21 消費税改定対応 end
    
    	$begin_datetime=$_POST['begin_datetime'];
    	$dt = new DateTime($_POST['begin_datetime']);
    	$this->set('begin', $dt->format("Y年m月d日 H時i分"));
    
    	$finish_datetime=$_POST['finish_datetime'];
    	$dt = new DateTime($_POST['finish_datetime']);
        $week = get_week($dt->format("Ymd"));
    	$this->set('finish', $dt->format("Y年m月d日 H時i分 ($week)"));
    
    	$purpose=$_POST['purpose'];
    	$c_member_id=$_POST['c_member_id'];
    	$vessel_num=$_POST['vessel_num'];
    	$service_num=$_POST['service_num'];
    	$room_price = $_POST['room_price'];
    	$people=$_POST['people'];
    	$kanban=$_POST['kanban'];
		$memo=isset($pre_resever_data)?$pre_resever_data['memo']:'';
    	$sql = "select * from c_member where c_member_id = ".$_POST['c_member_id'];
    	$result = db_get_all($sql);
    	$post_data['c_member'] = $result[0];
    
    	$vessel_list = array();
    	$vessel_price = 0;
    	for($x=0;$x<$_POST['vessel_num'];$x++){
    		if($_POST['select_vessel'.$x]){
    			$vessel_id=$_POST['select_vessel'.$x];
    			$vessel_list[$x]['select_vessel']=$_POST['select_vessel'.$x];
                $vessel_list[$x]['vessel_id']=$_POST['select_vessel'.$x];
    			$vessel_list[$x]['vessel_num']=$_POST['remainder'.$x];
    			$vessel_list[$x]['remainder']=$_POST['remainder'.$x];
    			$sql="select * from a_vessel_data where vessel_id = ".$_POST['select_vessel'.$x];
    			$result = db_get_all($sql);
    			$tmp_price = $result[0]['price'];		/// 備品使用料
    			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
    			$tmp_price = round($tmp_price * (1 + $tmp_tax));
    			$result[0]['price'] = $tmp_price;		/// 書き戻し
    			$vessel_list[$x]['vessel_data'] = $result[0];
                $vessel_list[$x]['vessel_data']['price']=$result[0]['price']*$_POST['remainder'.$x];
               	$vessel_price += $result[0]['price']*$_POST['remainder'.$x];
                
                
    		}
    	}
    	$service_list = array();
    	$service_price = 0;
    	for($x=0;$x<$_POST['service_num'];$x++){
    		if($_POST['select_service'.$x]){
    			$service_list[$x]['service_id']=$_POST['select_service'.$x];
    			$service_list[$x]['select_service']=$_POST['select_service'.$x];
    			$service_list[$x]['service_num']=$_POST['service_remainder'.$x];
    			$service_list[$x]['service_remainder']=$_POST['service_remainder'.$x];
    			$sql="select * from a_service_data where service_id = ".$_POST['select_service'.$x];
    			$result = db_get_all($sql);
    			$tmp_price = $result[0]['price'];		/// サービス使用料
    			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
    			$tmp_price = round($tmp_price * (1 + $tmp_tax));
    			$result[0]['price'] = $tmp_price;		/// 書き戻し
    			$service_list[$x]['service_data'] = $result[0];
                $service_list[$x]['service_data']['price']=$result[0]['price']*$_POST['service_remainder'.$x];
    			$service_price += $result[0]['price']*$_POST['service_remainder'.$x];
    		}
    	}
    	$total_price = $_POST['room_price']+$vessel_price+$service_price;
    	$sql = "select * from c_profile_option where c_profile_id = 3";
    	$ken_list=db_get_all($sql);
    
    	$this->set('birth_month_list', $birth_month_list);
    	$this->set('birth_day_list', $birth_day_list);
    	$this->set('ken_list', $ken_list);
    
        if($_POST['c_member_id']){
            if(check_guest($_POST['c_member_id'])){
                $this->set('guest', "ゲスト");
            }else{
                $this->set('guest', "会員");
            }
        }else{
            $this->set('guest', "ゲスト");
        }
           //insert into  a_pre_reserve;
         if($_SESSION['set_reserver_vesel']){
           
           $sql = "insert into a_pre_reserve (pid,pre_id, hall_id, room_id, begin_datetime, finish_datetime, room_price,vessel_price,service_price,total_price, purpose, limit_datetime, people,kanban,c_member_id, memo";
    
                    $sql.= ") values (";
                    $sql.= "'$pid', ";
                    $sql.= "'$pre_id', ";
                    $sql.= "'$hall_id', ";
                    $sql.= "'$room_id', ";
                    $sql.= "'$begin_datetime', ";
                    $sql.= "'$finish_datetime', ";
                    $sql.= "'$room_price', ";
                    $sql.= "'$vessel_price', ";
                    $sql.= "'$service_price', ";
                    $sql.= "'".$total_price."', ";
                    $sql.= "'" . $purpose . "', ";
                    $sql.= "$time_limit, ";
                    $sql.= "'" . $people . "',";
                    $sql.= "'" . $kanban . "',";
                    $sql.= "'" . $c_member_id . "',";
                    $sql.= "'" . $memo . "'";
    
                    $sql.= ")";
                    db_get_all($sql);
                    $pid=mysql_insert_id();
                    
             // insert service
                    foreach ($service_list as $value) {
                        $sql = "insert into a_pre_rs (pid, pre_id, service_id, num, price, limit_datetime, weight) values (";
                        $sql.= "'$pid', ";
                        $sql.= "'$pre_id', ";
                        $sql.= "'" . $value['service_id'] . "', ";
                        $sql.= "'" . $value['service_num'] . "', ";
                        $sql.= "'" . $value['service_data']['price'] . "', ";
                        $sql.= "$time_limit, ";
                        $sql.= "'" . $value['service_data']['weight'] . "'";
                        $sql.= ")";
                        db_get_all($sql);
                    }
             // insert revesel
                    foreach ($vessel_list as $value) {
                    $sql = "insert into a_pre_rv (pid, pre_id, vessel_id, num, price, limit_datetime, weight) values (";
                    $sql.= "'$pid', ";
                    $sql.= "'$pre_id', ";
                    $sql.= "'" . $value['vessel_id'] . "', ";
                    $sql.= "'" . $value['vessel_num'] . "', ";
                    $sql.= "'" . $value['vessel_data']['price'] . "', ";
                    $sql.= "$time_limit, ";
                    $sql.= "'" . $value['vessel_data']['weight'] . "'";
                    $sql.= ")";
                    //print "$sql<br>";
                    db_get_all($sql);
                    }              
            $_SESSION['set_reserver_vesel']=0;
         }   
    }
	
        
       
      
        //get all a_pre_reserve
        $sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by pid asc";
        $pre_data = db_get_all($sql, $db);
        $all_total =0;
        if (is_null($pre_data)) {
            $this->set('msg', '選択した予約が見つかりません。。');
            return 'success';
        } else {
            foreach ($pre_data as $key => $value) {
// 時間
                $dt = new DateTime($value['begin_datetime']);
                $pre_data[$key]['date'] = $dt->format("Y年m月d日");
                $pre_data[$key]['week'] = get_week($dt->format("Ymd"));
                $pre_data[$key]['begin'] = $dt->format("H時i分");
                $dt = new DateTime($value['finish_datetime']);
                $pre_data[$key]['finish'] = $dt->format("H時i分");
                $tmp_ymd  = strtotime($value['begin_datetime']);
            	$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
            	$tmp_sql  = "";
            	$tmp_sql .= "select rate from a_tax ";		
            	$tmp_sql .= "where stadate <= '$tmp_ymd' ";
            	$tmp_sql .= "order by stadate desc ";		
            	$tmp_sql .= "limit 0, 1";			
            	$tmp_tab  = db_get_all($tmp_sql);
            	$tmp_tax  = $tmp_tab[0]['rate'] / 100;		    
                $hall_id = $value['hall_id'];
                    
// 会場取得

                $sql = "select * from a_hall where hall_id = " . $value['hall_id'];
                $hall_data = db_get_all($sql, $db);
                $pre_data[$key]['hall_data'] = $hall_data[0];
                

// 部屋データ

                $sql = "select * from a_room where hall_id = " . $value['hall_id'] . " and room_id = " . $value['room_id'];
                $room_data = db_get_all($sql, $db);
                $pre_data[$key]['room_data'] = $room_data[0];

// キャンセル料率

                $sql = "select * from a_cancel_charge where hall_id = " . $value['hall_id'] . " and pattern_id = " . $room_data[0]['cancel'];
                $cancel_list = db_get_all($sql, $db);
                $pre_data[$key]['cancel_list'] = $cancel_list[0];

// 選択備品
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


// 選択サービス
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
            $this->set('all_total',$all_total);
            $this->set('pre_id', $pre_id);
            $this->set('pre_data', $pre_data);
            $this->set('num_pre_data',count($pre_data));
            //$this->set('people', $people);
        	//$this->set('purpose', $_POST['purpose']);
        	$this->set('c_member_id', $c_member_id);
        	$this->set('year', $_POST['year']);
        	$this->set('month', $_POST['month']);
        	$this->set('day', $_POST['day']);
        	$this->set('hall_id', $hall_id);
            
        }
        return 'success';
    }

}
