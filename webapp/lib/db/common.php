<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

$GLOBALS['_OPENPNE_DB_LIST'] = array();

function &db_get_instance($name = 'main', $readonly = false)
{
    global $_OPENPNE_DB_LIST;

    if (empty($_OPENPNE_DB_LIST[$name])) {
        if (!$dsn = db_get_dsn($name)) {
            if ($name == 'main') {
                return false;
            } else {
                $_OPENPNE_DB_LIST[$name] =& db_get_instance();
            }
        } else {
            $_OPENPNE_DB_LIST[$name] =new OpenPNE_DB($dsn, $readonly);
        }
    }
    return $_OPENPNE_DB_LIST[$name];
}

function db_get_dsn($name = 'main')
{
    global $_OPENPNE_DSN_LIST;

    if (empty($_OPENPNE_DSN_LIST[$name])) {
        return false;
    }
    $item = $_OPENPNE_DSN_LIST[$name];

    if (empty($item['dsn'])) {
        // priority に応じた確率で1件取得
        $entries = array();
        foreach ($item as $i) {
            if (empty($i['dsn'])) continue;

            $p = !empty($i['priority']) ? intval($i['priority']) : 1;
            $entries = array_pad($entries, count($entries) + $p, $i);
        }
        if ($entries) {
            $key = array_rand($entries);
            $item = $entries[$key];
        }
    }

    return $item['dsn'];
}

function db_get_one($sql, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_one($sql, $params);
}

function db_get_row($sql, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_row($sql, $params);
}

function db_get_col($sql, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_col($sql, $params);
}

function db_get_col_limit($sql, $from, $count, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_col_limit($sql, $from, $count, $params);
}

function db_get_col_page($sql, $page, $count, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_col_page($sql, $page, $count, $params);
}

function db_get_assoc($sql, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_assoc($sql, $params);
}

function db_get_assoc_limit($sql, $from, $count, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_assoc_limit($sql, $from, $count, $params);
}

function db_get_all($sql, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_all($sql, $params);
}

function db_get_all_limit($sql, $from, $count, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_all_limit($sql, $from, $count, $params);
}

function db_get_all_page($sql, $page, $count, $params = array(), $dsn_name = 'main_reader')
{
    if ($dsn_name === 'main_reader') {
        $reader =& db_get_instance($dsn_name, true);
    } else {
        $reader =& db_get_instance($dsn_name);
    }
    return $reader->get_all_page($sql, $page, $count, $params);
}

function db_quote($str)
{
    $db =& db_get_instance('main_reader', true);
    return $db->quote($str);
}

function db_escapeIdentifier($str)
{
    return OpenPNE_DB::escapeIdentifier($str);
}

function db_query($sql, $params = array())
{
    $db =& db_get_instance();
    return $db->query($sql, $params);
}

function db_insert($table_name, $fields_values, $pkey = null)
{
    if (is_null($pkey)) { // primary key 自動生成
        $pkey = $table_name . '_id';
    }
    $db =& db_get_instance();
    return $db->insert($table_name, $fields_values, $pkey);
}

function db_update($table_name, $fields_values, $where)
{
    $db =& db_get_instance();
    return $db->update($table_name, $fields_values, $where);
}

function db_affected_rows()
{
    $db =& db_get_instance();
    return $db->affectedRows();
}

function db_now()
{
    return date('Y-m-d H:i:s');
}

/**
 * MySQL hint
 */
function db_mysql_hint($hint)
{
    if (OPENPNE_USE_MYSQL_HINT) {
        return ' /*! ' . $hint . ' */ ';
    } else {
        return '';
    }
}

/**
 * MySQL: ORDER BY RAND()
 * PgSQL: ORDER BY RANDOM()
 */
function db_order_by_rand()
{
    if ($GLOBALS['_OPENPNE_DSN_LIST']['main']['dsn']['phptype'] == 'pgsql') {
        $order = ' ORDER BY RANDOM()';
    } else {
        $order = ' ORDER BY RAND()';
    }
    return $order;
}

// at_office
function get_vessel_data($vessel_id){
	$sql = "select * from a_vessel_data where vessel_id = $vessel_id";
	$result = db_get_all($sql);
	return isset($result[0]) ? $result[0] : null;
}

function get_vessel_price($vessel_id){
	$sql = "select price from a_vessel_data where vessel_id = $vessel_id";
	$result = db_get_all($sql);
	return isset($result[0]['price']) ? $result[0]['price'] : null;
}
function get_vessel_name($vessel_id){
	$sql = "select vessel_name from a_vessel_data where vessel_id = $vessel_id";
	$result = db_get_all($sql);
	return isset($result[0]['vessel_name']) ? $result[0]['vessel_name'] : null;
}

function get_service_data($service_id){
	$sql = "select * from a_service_data where service_id = $service_id";
	$result = db_get_all($sql);
	return isset($result[0]) ? $result[0] : null;
}

function get_service_price($service_id){
	$sql = "select price from a_service_data where service_id = $service_id";
	$result = db_get_all($sql);
	return isset($result[0]['price']) ? $result[0]['price'] : null;
}
function get_service_name($service_id){
	$sql = "select service_name from a_service_data where service_id = $service_id";
	$result = db_get_all($sql);
	return isset($result[0]['service_name']) ? $result[0]['service_name'] : null;
}

function check_reserve($hall_id, $room_id, $begin_datetime, $finish_datetime){

	$begin_datetime2=$begin_datetime;
	$finish_datetime2=$finish_datetime;

	$sql="select hall_attribute from a_hall where hall_id=$hall_id";
	$result=db_get_all($sql);
	$hall_attribute=$result[0]['hall_attribute'];	// 1でシェア
	if(!$hall_attribute){

		$sql="select type,koma from a_room where hall_id=$hall_id and room_id=$room_id";
		$result=db_get_all($sql);
		$room_type=$result[0]['type'];	// 2ならコマタイプ 
		$room_koma=$result[0]['koma'];	//

		if($room_type==2){	// 予約エリアの拡張
			$second=$room_koma*60*60;
			$tmptime=strtotime($begin_datetime)-$second;
			$begin_datetime2=date("Y-m-d H:i:s",$tmptime);
			$tmptime=strtotime($finish_datetime)+$second;
			$finish_datetime2=date("Y-m-d H:i:s",$tmptime);

		}
	}


	$count = 0;
	// 予約
	$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime2' + INTERVAL 1 second and '$finish_datetime2' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime2' + INTERVAL 1 second and '$finish_datetime2' - INTERVAL 1 second) or ('$begin_datetime2' + INTERVAL 1 second between begin_datetime and finish_datetime))";

	$result = db_get_all($sql);
	$count += $result[0]['reserve'];

	// 貸し止め重複
	$sql = "select count(stop_id) as stop_id from a_rental_stop where hall_id = $hall_id and room_id = $room_id and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";

	$result = db_get_all($sql);
	$count += $result[0]['stop_id'];

	return $count;

}

function check_reserve2($hall_id, $room_id, $begin_datetime, $finish_datetime){

	$count = 0;
	// 予約
	$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";

	$result = db_get_all($sql);
	$count += $result[0]['reserve'];

	return $count;

}


function check_change_reserve($hall_id, $room_id, $c_member_id, $begin_datetime, $finish_datetime){

	$sql = "select count(reserve_id) as reserve from a_reserve_list where hall_id = $hall_id and room_id = $room_id and c_member_id != $c_member_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";

	$result = db_get_all($sql);
	return isset($result[0]['reserve']) ? $result[0]['reserve'] : null;

}


function send_mail_message($subject, $pc_body, $mail_address){


	if (OPENPNE_MAIL_QUEUE) {
		//メールキューに蓄積
		put_mail_queue($mail_address, $subject, $pc_body);
	} else {
		t_send_email($mail_address, $subject, $pc_body);
	}

}

function get_hall_name($hall_id){
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$hall_name = db_get_all($sql);
	return isset($hall_name[0]['hall_name']) ? $hall_name[0]['hall_name'] : null;
}

function get_room_name($hall_id, $room_id){
	$sql = "select room_name from a_room where hall_id = $hall_id and room_id = $room_id";
	$hall_name = db_get_all($sql);
	return isset($hall_name[0]['room_name']) ? $hall_name[0]['room_name'] : null;
}


function get_prof_list($data){

		$insert_prof_list = array();
		// 県
		$insert_prof_list[0]['c_profile_id']=3;
		$insert_prof_list[0]['c_profile_option_id']=$data['ken'];
		$sql="select value from c_profile_option where c_profile_option_id = ".$data['ken'];
		$result=db_get_all($sql);
		$insert_prof_list[0]['value']=$result[0]['value'];
		// カナ
		$insert_prof_list[1]['c_profile_id']=11;
		$insert_prof_list[1]['c_profile_option_id']=0;
		$insert_prof_list[1]['value']=$data['kana'];
		// 利用形態
		$insert_prof_list[2]['c_profile_id']=10;
		$insert_prof_list[2]['c_profile_option_id']=$data['riyo'];
		$sql="select value from c_profile_option where c_profile_option_id = ".$data['riyo'];
		$result=db_get_all($sql);
		$insert_prof_list[2]['value']=$result[0]['value'];
		// 法人・個人名
		$insert_prof_list[3]['c_profile_id']=12;
		$insert_prof_list[3]['c_profile_option_id']=0;
		$insert_prof_list[3]['value']=$data['daihyou'];
		// 部署名
		$insert_prof_list[4]['c_profile_id']=19;
		$insert_prof_list[4]['c_profile_option_id']=0;
		$insert_prof_list[4]['value']=$data['busho'];
		// 郵便番号
		$insert_prof_list[5]['c_profile_id']=13;
		$insert_prof_list[5]['c_profile_option_id']=0;
		$insert_prof_list[5]['value']=$data['zip'];
		// 市区町村
		$insert_prof_list[6]['c_profile_id']=14;
		$insert_prof_list[6]['c_profile_option_id']=0;
		$insert_prof_list[6]['value']=$data['address_city'];
		// 番地
		$insert_prof_list[7]['c_profile_id']=15;
		$insert_prof_list[7]['c_profile_option_id']=0;
		$insert_prof_list[7]['value']=$data['address_banchi'];
		// 建物名
		$insert_prof_list[8]['c_profile_id']=16;
		$insert_prof_list[8]['c_profile_option_id']=0;
		$insert_prof_list[8]['value']=$data['address_build'];
		// 電話番号
		$insert_prof_list[9]['c_profile_id']=17;
		$insert_prof_list[9]['c_profile_option_id']=0;
		$insert_prof_list[9]['value']=$data['tel'];
		// FAX
		$insert_prof_list[10]['c_profile_id']=18;
		$insert_prof_list[10]['c_profile_option_id']=0;
		$insert_prof_list[10]['value']=$data['fax'];

		return($insert_prof_list);

}

function get_price($str){
	$list = explode(",", $str);
	$num="";
	foreach($list as $value){
		$num.=$value;
	}

	return(intval($num));

}

function get_profile_value($u, $p){
	$sql = "select value from c_member_profile where c_member_id = $u and c_profile_id = $p";
	$result = db_get_all($sql);
	// return($result[0]['value']);
	$rs = isset($result[0]['value']) ? $result[0]['value'] : null;
	return($rs);
}

function get_cancel_list($reserve_id){

	$sql = "select hall_id, room_id, begin_datetime from a_reserve_list where reserve_id = $reserve_id";
	$reserve_data = db_get_all($sql);
	$hall_id = $reserve_data[0]['hall_id'];
	$room_id = $reserve_data[0]['room_id'];

	$sql = "select cancel from a_room where hall_id = $hall_id and room_id = $room_id";
	$cancel = db_get_all($sql);
	$cancel = isset($cancel[0]['cancel']) ? $cancel[0]['cancel'] : null;

	$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = $cancel";
	$cancel_list = db_get_all($sql);
	$cancel_list = isset($cancel_list[0]) ? $cancel_list[0] : null;


	// 何日前か
	$dt = new DateTime($reserve_data[0]['begin_datetime']);
	$s = mktime(0,0,0,$dt->format("m"),$dt->format("d"),$dt->format("Y")) - mktime(0,0,0,date("m"),date("d"),date("Y"));
	$before = ($s/60/60/24)+1;
	
	$percent = $cancel_list['percent1'];
	if($cancel_list['day2'] and $cancel_list['day2']>=$before){
		$percent = $cancel_list['percent2'];		
	}
	if($cancel_list['day3'] and $cancel_list['day3']>=$before){
		$percent = $cancel_list['percent3'];		
	}
	if($cancel_list['day4'] and $cancel_list['day4']>=$before){
		$percent = $cancel_list['percent4'];	
	}
	if($cancel_list['day5'] and $cancel_list['day5']>=$before){
		$percent = $cancel_list['percent5'];
	}
	$cancel_list['before'] = $before;
	$cancel_list['percent'] = $percent;
//	echo $before."<br>";
//	echo ($cancel_list['day2'] and $cancel_list['day2']>=$before)."<br>";
//	echo ($cancel_list['day3'] and $cancel_list['day3']>=$before)."<br>";
//	echo ($cancel_list['day4'] and $cancel_list['day4']>=$before)."<br>";
//	echo ($cancel_list['day5'] and $cancel_list['day5']>=$before)."<br>";
//	echo "<br>";

	return($cancel_list);

}

function get_business_days($days){
	$year = date("Y");
	$month = date("m");
	$day = date("d");

	$count=1;

	while($count<=$days){
		$day++;
		if(!checkdate($month, $day, $year)){
			$month++;
			$day=1;
			if(!checkdate($month, $day, $year)){
				$year++;
				$month=1;
			}
		}
		// 土日を飛ばす
		$week = date('w',mktime(0,0,0,$month,$day,$year));
		if($week!=0 and $week!=6){
			// 祝日を飛ばす
			$sql = "select * from c_holiday where month = $month and day = $day";
			$result = db_get_all($sql);
			if(!$result){
				//print "$month / $day<br>";
				$count++;
			}
		}
	}

	return("$year-$month-$day 23:59:59");

}

function get_virtual_number($u){

	// 固定設定がされているか
	$q = "select virtual_number from a_virtual_account_list where kotei=1 and c_member_id = $u";
	$result = db_get_all($q);
	if($result[0]['virtual_number']){
		return($result[0]['virtual_number']);
	}else{
		$q = "select virtual_number from a_virtual_account_list where kotei=1 and flag = 0 and c_member_id = 0";
		$number = db_get_all($q);
		return($number[0]['virtual_number']);
	}
	return(0);
}

function get_dairi_percent($c_member_id){
	$sql = "select * from a_agency where c_member_id = $c_member_id";
	$agency = db_get_all($sql);
	$agency = $agency[0];
	if($agency['percent']){
		return($agency['percent']);
	}else{
		return(0);
	}
}

function get_waribiki_percent($hall_id, $room_id, $reserve_date){

	// 割引期間
	$sql = "select * from a_room_discount where hall_id = $hall_id and room_id = $room_id and flag = 1";
	//print $sql."<br>";
	$result = db_get_all($sql);
	if ($result){
		if($result[0]['pattern_id'] <= 3){
			$d_begin_time = $result[0]['begin_year'].sprintf('%02d', $result[0]['begin_month']).sprintf('%02d', $result[0]['begin_day']);
			$d_finish_time = $result[0]['finish_year'].sprintf('%02d', $result[0]['finish_month']).sprintf('%02d', $result[0]['finish_day']);

			// print $d_begin_time."<br>".$reserve_date."<br>".$d_finish_time;
			if($d_begin_time <= $reserve_date and $reserve_date <= $d_finish_time){

				return($result[0]['percent']);

			}else{
				return(0);
			}

		}else{
			$discount = 0;
			$week = date('w',mktime(0,0,0,$month,$day,$year));
			if($result[0]['continuance']==1){
				//すべての平日
				if($week!=0 and $week!=6){
					//土日以外
					$sql = "select * from c_holiday where month=$month and day=$day";
					if(!db_get_all($sql, $db)){
						//祝日以外
						$discount = $result[0]['percent'];

					}
				}
			}elseif($result[0]['continuance']==2){
				//すべての土曜
				if($week==6){
					$discount = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==3){
				//すべての日祭日
				$sql = "select * from c_holiday where month=$month and day=$day";
				if($week==0 or db_get_all($sql, $db)){
					$discount = $result[0]['percent'];
				}
			}elseif($result[0]['continuance']==4){
				//すべての営業日
				$discount = $result[0]['percent'];
			}

			return($discount);

		}
	}// result


}

function get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $vessel_id){

//	$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id 
	and room_id != $room_id and cancel_flag=0 
	and ((begin_datetime between '$begin_datetime' and '$finish_datetime') 
	or (finish_datetime between '$begin_datetime' and '$finish_datetime') 
	or ('$begin_datetime' between begin_datetime and finish_datetime)
	or ( begin_datetime <= '$begin_datetime' and  '$begin_datetime' <= finish_datetime)
	or ( begin_datetime <= '$finish_datetime' and  '$finish_datetime' <= finish_datetime)
	)";
	
	//and ((begin_datetime  >'$begin_datetime' and begin_datetime < '$finish_datetime') 
	//or (finish_datetime > '$begin_datetime' and finish_datetime< '$finish_datetime'))"; 
	//or ('$begin_datetime' between begin_datetime and finish_datetime))";
	$reserve_id_list = db_get_all($sql);
	
	// 予約数
	if($reserve_id_list){
		$sql = "select num from a_reserve_v where vessel_id = ".$vessel_id;
		$sql.= " and (";
		foreach($reserve_id_list as $k=>$v){
			$sql.= "reserve_id = ".$v['reserve_id'];
			if($reserve_id_list[($k+1)]['reserve_id']){
				$sql.= " or ";
			}
		}
		$sql.= ")";
		$v_num = db_get_all($sql);

		if($v_num){
			$reserve_v_num = 0;
			foreach($v_num as $v){
				$reserve_v_num+=$v['num'];
			}
		}else{
			$reserve_v_num = 0;
		}
	}else{
		$reserve_v_num = 0;
	}
	$sql = " select a_pre_rv.num from a_pre_reserve INNER JOIN a_pre_rv ON a_pre_reserve.pid = a_pre_rv.pid where a_pre_reserve.hall_id = $hall_id 
	and a_pre_reserve.room_id != $room_id 
	and ((a_pre_reserve.begin_datetime between '$begin_datetime' and '$finish_datetime') 
	or (a_pre_reserve.finish_datetime between '$begin_datetime' and '$finish_datetime') 
	or ('$begin_datetime' between a_pre_reserve.begin_datetime and a_pre_reserve.finish_datetime)) 
AND a_pre_rv.vessel_id = '$vessel_id'";
	$num_tmp = db_get_all($sql);
	if($num_tmp)
	{
		foreach($num_tmp as $v){
			$reserve_v_num+=$v['num'];
		}
		
	}
	
	return $reserve_v_num;

}


function check_holiday($hall_id, $room_id, $year, $month, $day){
	$week = date('w',mktime(0,0,0,$month,$day,$year));
	// 会場の休日
	$sql = "select * from a_hall_holiday where hall_id = $hall_id and year = $year and month = $month and day = $day";
	if(db_get_all($sql)){
		return(1);
	}
	// 部屋の休日
	$sql = "select * from a_room_holiday where hall_id = $hall_id and room_id = $room_id and year = $year and month = $month and day = $day";
	if(db_get_all($sql)){
		return(1);
	}
	$sql = "select * from a_hall_regular_holiday where hall_id = $hall_id";
	$hall_rh = db_get_all($sql);
	$hall_rh = isset($hall_rh[0]) ? $hall_rh[0] : null;
	$sql = "select * from a_room_regular_holiday where hall_id = $hall_id and room_id = $room_id";
	$room_rh = db_get_all($sql);
	$room_rh = isset($room_rh[0]) ? $room_rh[0] : null;
	if(($hall_rh['january'] or $room_rh['january']) and $month==1){
		return(1);
	}elseif(($hall_rh['february'] or $room_rh['february']) and $month==2){
		return(1);
	}elseif(($hall_rh['march'] or $room_rh['march']) and $month==3){
		return(1);
	}elseif(($hall_rh['april'] or $room_rh['april']) and $month==4){
		return(1);
	}elseif(($hall_rh['may'] or $room_rh['may']) and $month==5){
		return(1);
	}elseif(($hall_rh['june'] or $room_rh['june']) and $month==6){
		return(1);
	}elseif(($hall_rh['july'] or $room_rh['july']) and $month==7){
		return(1);
	}elseif(($hall_rh['august'] or $room_rh['august']) and $month==8){
		return(1);
	}elseif(($hall_rh['september'] or $room_rh['september']) and $month==9){
		return(1);
	}elseif(($hall_rh['october'] or $room_rh['october']) and $month==10){
		return(1);
	}elseif(($hall_rh['november'] or $room_rh['november']) and $month==11){
		return(1);
	}elseif(($hall_rh['december'] or $room_rh['december']) and $month==12){
		return(1);
	}
	if(($hall_rh['sunday'] or $room_rh['sunday']) and $week==0){
		return(1);
	}elseif(($hall_rh['monday'] or $room_rh['monday']) and $week==1){
		return(1);
	}elseif(($hall_rh['tuesday'] or $room_rh['tuesday']) and $week==2){
		return(1);
	}elseif(($hall_rh['wednesday'] or $room_rh['wednesday']) and $week==3){
		return(1);
	}elseif(($hall_rh['thursday'] or $room_rh['thursday']) and $week==4){
		return(1);
	}elseif(($hall_rh['friday'] or $room_rh['friday']) and $week==5){
		return(1);
	}elseif(($hall_rh['saturday'] or $room_rh['saturday']) and $week==6){
		return(1);
	}
	if($hall_rh['day'.$day] or $room_rh['day'.$day]){
		return(1);
	}
	if($hall_rh['holiday'] or $room_rh['holiday']){
		$sql = "select * from c_holiday where month = $month and day = $day";
		if(db_get_all($sql)){
			return(1);
		}
	}
	return(0);
}
function check_virtual_code($vc, $reserve_id){
	$sql = "select * from a_reserve_list where reserve_id!='$reserve_id' and virtual_code='$vc' and pay_flag='0' and cancel_flag='0'";
	$result = db_get_all($sql);

	if($result){
		return(1);
	}

	$sql = "select * from a_amount_billed where reserve_id!='$reserve_id' and virtual_code='$vc' and flag='0'";
	$result = db_get_all($sql);
	if($result){
		return(1);
	}else{
		return(0);
	}

}

function get_pre_rv($hall_id, $room_id, $begin_datetime, $finish_datetime, $vessel_id, $pre_id){

	$sql = "select pid from a_pre_reserve where pre_id = $pre_id and hall_id = $hall_id and room_id != $room_id and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	$reserve_id_list = db_get_all($sql);
	if($reserve_id_list){
		$sql = "select num from a_pre_rv where vessel_id = ".$vessel_id;
		$sql.= " and (";
		foreach($reserve_id_list as $k=>$v){
			$sql.= "pid = ".$v['pid'];
			if($reserve_id_list[($k+1)]['pid']){
				$sql.= " or ";
			}
		}
		$sql.= ")";

		$v_num = db_get_all($sql);
		if($v_num){
			$reserve_v_num = 0;
			foreach($v_num as $v){
				$reserve_v_num+=$v['num'];
			}
		}else{
			$reserve_v_num = 0;
		}
	}else{
		$reserve_v_num = 0;
	}

	return $reserve_v_num;

}

function check_reserve_id($reserve_id, $u){
	if(preg_match("/^[0-9]+$/", $reserve_id)){
		$sql = "select * from a_reserve_list where reserve_id = '$reserve_id' and c_member_id = '$u'";
		$result = db_get_all($sql);
		if(!$result){
			return(1);
		}else{
			return(0);
		}
	}else{
		return(1);
	}

}

function check_pre_id($pre_id, $u){
	if(preg_match("/^[0-9]+$/", $pre_id)){
		$sql = "select * from a_pre_reserve where pre_id = '$pre_id' and c_member_id = '$u'";
		$result = db_get_all($sql);
		if(!$result){
			return(1);
		}else{
			return(0);
		}
	}else{
		return(1);
	}

}

function get_bill_id($reserve_id, $billed_id){
	// 請求番号取得
	$sql = "insert into a_bill_id (reserve_id, billed_id) values ($reserve_id, $billed_id)";
	db_get_all($sql);
	$sql = "select bill_id from a_bill_id where reserve_id = '$reserve_id' and billed_id = '$billed_id' order by bill_id desc";
	$bill_id = db_get_all($sql);
	$bill_id = $bill_id[0]['bill_id'];
	return $bill_id;
}

function get_cancel_price($reserve_id){

//	$debugsql="insert into debug (pr,tx) values('reserve_cancel',$reserve_id)";
//	db_get_all($debugsql);

	// 予約データ
	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];
	//rsdn-20160405-change cancel_price with tmp order
	if($reserve_data['tmp_flag']==1){
		$cancel = array(
			'cancel_price' => 0,
			'percent' => 0,
			'before' => 0
			);

		return($cancel);
	}
	//end
	
	//GMO-Runsystem edit 2015-11-11
/*
/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($reserve_data['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql, $db);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2013.12.21 消費税改定対応 end

	if($reserve_data['tmp_flag']==1){
		$cancel = array(
			'cancel_price' => 0,
			'percent' => 0,
			'before' => 0
			);

		return($cancel);
	}

	//備品
	$sql = "select * from a_reserve_v where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_v_list = db_get_all($sql, $db);
	$cancel_vessel_price=0;
	if($reserve_v_list){
		foreach($reserve_v_list as $k=>$v){
			$sql = "select * from a_vessel_data where vessel_id = ".$v['vessel_id'];
			$vessel_data = db_get_all($sql, $db);
			$vessel_data = $vessel_data[0];
			//if($service_data['cancel_mode']==1){

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $vessel_data['price'];		/// 備品使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$cancel_vessel_price += $tmp_price*$v['num'];

/// 2013.12.21 消費税改定対応 end

			//}
		}
	}else{
			$reserve_v_list = 0;
	}

	//サービス
	$sql = "select * from a_reserve_s where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_s_list = db_get_all($sql);
	$cancel_service_price = 0;
	if($reserve_s_list){
		foreach($reserve_s_list as $k=>$v){
			$sql = "select * from a_service_data where service_id = ".$v['service_id'];
			$service_data = db_get_all($sql);
			$service_data = $service_data[0];
			if($service_data['cancel_mode']==1){

/// 2013.12.21 消費税改定対応 begin

			  $tmp_price = $service_data['price'];		/// サービス使用料
			  $tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			  $tmp_price = round($tmp_price * (1 + $tmp_tax));
			  $cancel_service_price += $tmp_price*$v['num'];

/// 2013.12.21 消費税改定対応 end

			}
		}
	}else{
		$reserve_s_list = 0;
	}
*/	
	// キャンセル料計算
	$cancel_list = get_cancel_list($reserve_id);
	// キャンセル料
	$cancel_price = round(($reserve_data['room_price']+$reserve_data['vessel_price']+$reserve_data['service_price'])*($cancel_list['percent']*0.01));

//	$debugsql="insert into debug (pr,tx) values('reserve_cancel','$cancel_price ".$reserve_data['room_price']." $cancel_service_price $cancel_vessel_price')";
//	db_get_all($debugsql);

	$cancel = array(
		'cancel_price' => $cancel_price,
		'percent' => $cancel_list['percent'],
		'before' => $cancel_list['before']
		);

	return($cancel);

}

function get_page_list($index, $num, $list, $page){

	if($index < ($list*$page)-$list){
		$start_page = 1;
		$end_page = ($num+$list)/$list;
		if($end_page>$page){
			$end_page = $page+1;
		}
	}elseif($index >= $num-($list*($page/2))){
		$start_page = ceil((($num+$list)/$list)-$page);
		$end_page = ceil(($num+$list)/$list);
	}else{
		$start_page = (($index+$list)/$list)-($page/2);
		$end_page = (($index+$list)/$list)+($page/2);
	}
	if($start_page<=0){
		$start_page = 1;
	}
	$page_list = array();
	$key=0;

	for($x=$start_page;$x<$end_page;$x++){
		if( (($x*$list)-$list) == $index){
			$page_list[$key]['page']=$x;
			$page_list[$key]['select']=1;
		}else{
			$page_list[$key]['page']=$x;
			$page_list[$key]['select']=0;
			$page_list[$key]['index']=($x*$list)-$list;
		}
		$key++;

	}
	return $page_list;
}


function get_purpose_word($purpose){
	if ($purpose==0){
		return '未選択';
	}elseif($purpose==1){
		return '会議';
	}elseif($purpose==2){
		return 'セミナー';
	}elseif($purpose==3){
		return '研修';
	}elseif($purpose==4){
		return '面接・試験';
	}elseif($purpose==5){
		return '懇談会・パーティ';
	}elseif($purpose==6){
		return 'その他';
	}
	return '未選択';
}

function get_week($date){
    $sday = strtotime($date);
    $res = date("w", $sday);
    $day = array("日", "月", "火", "水", "木", "金", "土");
    return $day[$res];
}


function get_before_business_days($days){
	$year = date("Y");
	$month = date("m");
	$day = date("d");

	$count=1;

	while($count<=$days){
		$day--;
		if($day<=0){
			$month--;
			if($month<=0){
				$month=12;
				$year--;
			}
			for($x=1;checkdate($month, $x, $year);$x++){
				$day=$x;
			}
		}
		// 土日を飛ばす
		// $week = date(w,mktime(0,0,0,$month,$day,$year));
		$week = date('w',mktime(0,0,0,$month,$day,$year));
		if($week!=0 and $week!=6){
			// 祝日を飛ばす
			$sql = "select * from c_holiday where month = $month and day = $day";
			$result = db_get_all($sql);
			if(!$result){
				//print "$month / $day<br>";
				$count++;
			}
		}
	}

	return("$year-$month-$day 23:59:59");

}

function get_cancel_list2($reserve_id){

	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$reserve_data = db_get_all($sql);
	$hall_id = $reserve_data[0]['hall_id'];
	$room_id = $reserve_data[0]['room_id'];

	$sql = "select cancel from a_room where hall_id = $hall_id and room_id = $room_id";
	$cancel = db_get_all($sql);
	$cancel = isset($cancel[0]['cancel']) ? $cancel[0]['cancel'] : null;

	$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = $cancel";
	$cancel_list = db_get_all($sql);
	$cancel_list = isset($cancel_list[0]) ? $cancel_list[0] : null;


	// 何日前か
	$dt = new DateTime($reserve_data[0]['begin_datetime']);
	$dt2 = new DateTime($reserve_data[0]['cancel_datetime']);

	$s = mktime(0,0,0,$dt->format("m"),$dt->format("d"),$dt->format("Y")) - mktime(0,0,0,$dt2->format("m"),$dt2->format("d"),$dt2->format("Y"));
	$before = ($s/60/60/24)+1;

	$percent = $cancel_list['percent1'];
	if($cancel_list['day2'] and $cancel_list['day2']>=$before){
		$percent = $cancel_list['percent2'];
	}
	if($cancel_list['day3'] and $cancel_list['day3']>=$before){
		$percent = $cancel_list['percent3'];
	}
	if($cancel_list['day4'] and $cancel_list['day4']>=$before){
		$percent = $cancel_list['percent4'];
	}
	if($cancel_list['day5'] and $cancel_list['day5']>=$before){
		$percent = $cancel_list['percent5'];
	}
	$cancel_list['before'] = $before;
	$cancel_list['percent'] = $percent;

	return($cancel_list);

}

function get_cancel_price2($reserve_id){

	// 予約データ
	global $db; // add by quyhoa
	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($reserve_data['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql, $db);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2013.12.21 消費税改定対応 end

	if($reserve_data['tmp_flag']==1){
		$cancel = array(
			'cancel_price' => 0,
			'percent' => 0,
			'before' => 0
			);

		return($cancel);
	}

	//備品
	$sql = "select * from a_reserve_v where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_v_list = db_get_all($sql, $db);
	$cancel_vessel_price=0;
	if($reserve_v_list){
		foreach($reserve_v_list as $k=>$v){
			$sql = "select * from a_vessel_data where vessel_id = ".$v['vessel_id'];
			$vessel_data = db_get_all($sql, $db);
			$vessel_data = $vessel_data[0];
			//if($service_data['cancel_mode']==1){

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $vessel_data['price'];		/// 備品使用料
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$cancel_vessel_price += $tmp_price*$v['num'];

/// 2013.12.21 消費税改定対応 end

			//}
		}
	}else{
			$reserve_v_list = 0;
	}

	//サービス
	$sql = "select * from a_reserve_s where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_s_list = db_get_all($sql);
	$cancel_service_price = 0;
	if($reserve_s_list){
		foreach($reserve_s_list as $k=>$v){
			$sql = "select * from a_service_data where service_id = ".$v['service_id'];
			$service_data = db_get_all($sql);
			$service_data = $service_data[0];
			if($service_data['cancel_mode']==1){

/// 2013.12.21 消費税改定対応 begin

			  $tmp_price = $service_data['price'];		/// サービス使用料
			  $tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			  $tmp_price = round($tmp_price * (1 + $tmp_tax));
			  $cancel_service_price += $tmp_price*$v['num'];

/// 2013.12.21 消費税改定対応 end

			}
		}
	}else{
		$reserve_s_list = 0;
	}
	// キャンセル料計算
	$cancel_list = get_cancel_list2($reserve_id);
	// キャンセル料
	$cancel_price = round(($reserve_data['room_price']+$cancel_service_price+$cancel_vessel_price)*($cancel_list['percent']*0.01));

	$cancel = array(
		'cancel_price' => $cancel_price,
		'percent' => $cancel_list['percent'],
		'before' => $cancel_list['before']
		);

	return($cancel);

}

function get_nickname($c_member_id){
	$sql = "select nickname from c_member where c_member_id = '$c_member_id'";
	$nickname = db_get_all($sql);
	return($nickname[0]['nickname']);
}

function check_guest($c_member_id){
    $sql = "select count(*) as guest from c_member where c_member_id = '$c_member_id' and guest_flag = '1'";
    $result = db_get_all($sql);
    return($result[0]['guest']);
}


?>
