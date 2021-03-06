<?php

/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト

/**
 * function checkDayHoliday
 * @author RSDN-hieudt
 * @since 2016-06-29
 * @param unknown $data
 * @param unknown $checks
 * @return multitype:
 */
function checkDayHoliday($year, $month, $day)
{
    $sql = "select * from c_holiday where month = $month and day = $day";
    if(db_get_all($sql)){
        return (4);
    }
    else{
        $date = strtolower(date("l", strtotime($year."-".$month."-".$day)));
        if($date == 'saturday'){
            return (2);
        }
        if($date == 'sunday'){
            return (3);
        }
        else{
            return (1);
        }
    }
}
class admin_page_today_reservation extends OpenPNE_Action
{

    function execute ($requests)
    {
        
        // アクセス権限
        $sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '" .
                 $_SESSION['_authsession']['username'] . "'";
        $result = db_get_all($sql);
        $this->set('name', $result[0]['name']);
        $this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
        $hall_id = $result[0]['hall_id'];
        
        // 日付
        $year = date("Y");
        $month = date("m");
        $day = date("d");
        $week = get_week($year . sprintf('%02d', $month) . sprintf('%02d', 
                $day));
        // var_dump($_REQUEST);
        
        if ($result[0]['atoffice_auth_type'] == 2 or
                 $result[0]['atoffice_auth_type'] == 4) {
            $sql = "select * from a_hall where flag=0";
            $hall_list = db_get_all($sql);
            if (isset($_REQUEST['hall_list']) && $_REQUEST['hall_list']) {
                $hall_id = $_REQUEST['hall_list'];
            } else {
                $hall_id = $hall_list[0]['hall_id'];
            }
            $this->set('hall_list', $hall_list);
        }
        

        if($result[0]['atoffice_auth_type']==3){
            $array_push = array();
            $hall_list_id = explode(",",$result[0]['hall_id']);
            foreach($hall_list_id as $key => $value){
                $sql = "select * from a_hall where hall_id = ".$value."";   
                $hall_list = db_get_all($sql);
                array_push($array_push, $hall_list);
            }
			//echo "<pre>",print_r($array_push),"</pre>";exit;
            if($_REQUEST['hall_list']){
                $hall_id = $_REQUEST['hall_list'];
            }else{
                $hall_id = $array_push[0][0]['hall_id'];
            }
            $this->set('hall_list', $array_push);           
        }
        // 会場取得
        
        $sql = "select * from a_hall where hall_id = $hall_id";
        $hall_data = db_get_all($sql);
        $hall_data = $hall_data[0];
        //var_dump($hall_data);
        // 営業時間範囲
        $open_time = array();
        $checkTime = checkDayHoliday($year, $month, $day);
        $beginS = $hall_data['begin'];
        $finS = $hall_data['finish'];
        $usedate = explode(',',$hall_data['usedate']);
        if($checkTime == 1){
        	if($hall_data['begin1'] != '' && $hall_data['finish1'] != '' )
        	{
        		$beginS = $hall_data['begin1'];
        		$finS = $hall_data['finish1'];
            	$hall_data['finish'] = $hall_data['finish1'];
        		$hall_data['begin'] = $hall_data['begin1'];
        	}
            if($hall_data['begin_often1'] !='' &&  $hall_data['finish_often1'] != '' && in_array($checkTime,$usedate))
            {
            	$hall_data['begin_often']= $hall_data['begin_often1'];
            	$hall_data['finish_often'] = $hall_data['finish_often1'];
            	
            }
        	
        }
        else if($checkTime == 2){
            if($hall_data['begin2'] != '' && $hall_data['finish2'] != '' )
        	{
        		$beginS = $hall_data['begin2'];
            	$finS = $hall_data['finish2'];
            	$hall_data['finish'] = $hall_data['finish2'];
        		$hall_data['begin'] = $hall_data['begin2'];
        	}
            if($hall_data['begin_often2'] !='' &&  $hall_data['finish_often2'] != '' && in_array($checkTime,$usedate))
            {
            	$hall_data['begin_often']= $hall_data['begin_often2'];
            	$hall_data['finish_often'] = $hall_data['finish_often2'];
            }
        }
        else if($checkTime == 3){
            if($hall_data['begin3'] != '' && $hall_data['finish3'] != '' )
        	{
        		$beginS = $hall_data['begin3'];
            	$finS = $hall_data['finish3'];
            	$hall_data['finish'] = $hall_data['finish3'];
        		$hall_data['begin'] = $hall_data['begin3'];
        	}
            if($hall_data['begin_often3'] !='' &&  $hall_data['finish_often3'] != '' && in_array($checkTime,$usedate))
            {
            	$hall_data['begin_often']= $hall_data['begin_often3'];
            	$hall_data['finish_often'] = $hall_data['finish_often3'];
            }
        }
        else if($checkTime == 4){
        	if($hall_data['begin4'] != '' && $hall_data['finish4'] != '' )
        	{
        		$beginS = $hall_data['begin4'];
            	$finS = $hall_data['finish4'];
            	$hall_data['finish'] = $hall_data['finish4'];
        		$hall_data['begin'] = $hall_data['begin4'];
        	}
           
     	    if($hall_data['begin_often4'] !='' &&  $hall_data['finish_often4'] != '' && in_array($checkTime,$usedate))
            {
            	$hall_data['begin_often']= $hall_data['begin_often4'];
            	$hall_data['finish_often'] = $hall_data['finish_often4'];
            }
        }
        for ($x = $beginS; $x < $finS; $x ++) {
            array_push($open_time, intval($x));
        }
        $col_num = 1;
        
        // その日のデータを全て取得する。
        $dayday = $year . "-" . $month . "-" . $day . " ";
        $daystart = $dayday . "00:00:00";
        $dayend = $dayday . "23:59:59";
        
        // 会場で有効な部屋データ
        
        //$sql = "select * from a_room where hall_id = $hall_id and flag=1";
        $sql = "SELECT ROOM1.*, ROOM2.re_begin_datetime, ROOM2.re_finish_datetime, ROOM2.re_reserve_id,
                    ROOM3.*
                FROM
                (
                    SELECT *
                    FROM a_room
                    WHERE  hall_id = $hall_id
                        AND flag=1
                ) AS ROOM1
                 
                LEFT JOIN
                 
                (
                    SELECT  RO.room_id, CAST( GROUP_CONCAT(RE.begin_datetime) AS CHAR(10000) CHARACTER SET utf8 ) AS re_begin_datetime,
                        CAST( GROUP_CONCAT(RE.finish_datetime) AS CHAR(10000) CHARACTER SET utf8 ) AS re_finish_datetime,
                        CAST( GROUP_CONCAT(RE.reserve_id) AS CHAR(10000) CHARACTER SET utf8 ) AS re_reserve_id
                    FROM a_room AS RO
                    LEFT JOIN a_reserve_list AS RE ON RO.room_id = RE.room_id
                    WHERE RO.hall_id = $hall_id
                        AND RE.hall_id = $hall_id
                        AND RO.flag=1
                        AND RE.cancel_flag=0
                        AND (RE.begin_datetime >= '$daystart' AND '$dayend' > RE.finish_datetime)
                    GROUP BY RO.room_id
                ) AS ROOM2
                 
                ON ROOM1.room_id = ROOM2.room_id
                 
                LEFT JOIN
                
                (
                    SELECT  RO.room_id, CAST( GROUP_CONCAT(REN.begin_datetime) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_begin_datetime,
                        CAST( GROUP_CONCAT(REN.finish_datetime) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_finish_datetime,
                        CAST( GROUP_CONCAT(REN.flag ) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_flag,
                        CAST( GROUP_CONCAT(REN.limit_datetime ) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_limit_datetime,
                        CAST( GROUP_CONCAT(REN.admin_name ) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_admin_name,
                        CAST( GROUP_CONCAT(REN.memo ) AS CHAR(10000) CHARACTER SET utf8 ) AS ren_memo
                    FROM a_room AS RO
                    LEFT JOIN a_rental_stop AS REN ON RO.room_id = REN.room_id
                    WHERE RO.hall_id = $hall_id
                        AND REN.hall_id = $hall_id
                        AND RO.flag=1
                        AND (REN.begin_datetime >= '$daystart' AND '$dayend' > REN.finish_datetime)
                        AND (REN.limit_datetime > NOW() OR REN.flag=1)
                    GROUP BY RO.room_id
                ) AS ROOM3
                 
                ON ROOM1.room_id = ROOM3.room_id
                 
                ORDER BY ROOM1.room_id";
                global $db;
        $room_data = db_get_all($sql, $db);
        $room_data = $room_data;
        
        foreach ($room_data as $k => $v) {
            if (! check_holiday($hall_id, $v['room_id'], $year, $month, $day)) {
                $room_data[$k]['holiday'] = 0;
                $room_data[$k]['opentime'] = $open_time;
                $room_data[$k]['max'] = max($v['num_school'], $v['num_mouth'], 
                        $v['num_theater']);
                
                if ($v['type'] == 2) {
                    if ($v['koma'] > 1) {
                        $hosei = $v['koma'] * $v['lowest_koma'];
                    } else {
                        $hosei = $v['lowest_koma'];
                    }
                    $koma = $v['koma'];
                    $min = array();
                    if ($koma == 0.5) {
                        $room_data[$k]['cs'] = 2;
                        $key = 0;
                        foreach ($open_time as $value) {
                            $min[$key]['time'] = sprintf("%02d", $value) . ':00';
                            $key ++;
                            $min[$key]['time'] = sprintf("%02d", $value) . ':30';
                            $key ++;
                        }
                        $room_data[$k]['opentime'] = $min;
                        if ($col_num < 2) {
                            $col_num = 2;
                        }
                    } elseif ($koma == 0.25) {
                        $room_data[$k]['cs'] = 1;
                        foreach ($open_time as $value) {
                            $min[$key]['time'] = sprintf("%02d", $value) . ':00';
                            $key ++;
                            $min[$key]['time'] = sprintf("%02d", $value) . ':15';
                            $key ++;
                            $min[$key]['time'] = sprintf("%02d", $value) . ':30';
                            $key ++;
                            $min[$key]['time'] = sprintf("%02d", $value) . ':45';
                            $key ++;
                        }
                        $room_data[$k]['opentime'] = $min;
                        if ($col_num < 3) {
                            $col_num = 3;
                        }
                    } else {
                        
                        $room_data[$k]['cs'] = 4 * $v['koma'];
                        $count_koma = 0;
                        $key = isset($key) ? $key : 0;
                        foreach ($open_time as $value) {
                            $count_koma --;
                            if ($count_koma <= 0) {
                                if (($value + $v['koma']) <= $hall_data['finish']) {
                                    $min[$key]['time'] = sprintf("%02d", $value) .
                                             ':00';
                                    $key ++;
                                    $count_koma = $v['koma'];
                                }
                            }
                        }
                        $room_data[$k]['opentime'] = $min;
                    }
                    
                    /**
                     * OLD
                     */
                    /* // その日のデータを全て取得する。
                    $dayday = $year . "-" . $month . "-" . $day . " ";
                    $daystart = $dayday . "00:00:00";
                    $dayend = $dayday . "23:59:59";
                    $sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = " .
                             $v['room_id'] .
                             " and cancel_flag=0 and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime)";
                    $today_reserve_flag = db_get_all($sql, $db);
                    // echo $sql;
                    // var_dump($today_reserve_flag);
                    
                    // 重なる貸し止め
                    $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = " .
                             $v['room_id'] .
                             " and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and (limit_datetime > now() or flag=1)";
                    $today_stop_flag = db_get_all($sql, $db); */
                    
                    foreach ($room_data[$k]['opentime'] as $key => $val) {
                        $room_data[$k]['opentime'][$key]['reserved'] = 0;
                        $datetime = $year . "-" . $month . "-" . $day . " " .
                                 $val['time'] . ":00";
                        $strdt = strtotime($datetime);
                        
                        /*
                         * // 重なる予約
                         * $sql = "select reserve_id from a_reserve_list where
                         * hall_id = $hall_id and room_id = ".$v['room_id']."
                         * and cancel_flag=0 and (begin_datetime <= '$datetime'
                         * and '$datetime' < finish_datetime)";
                         * $reserve_flag = db_get_all($sql);
                         * // 重なる貸し止め
                         * $sql = "select * from a_rental_stop where hall_id =
                         * $hall_id and room_id = ".$v['room_id']." and
                         * (begin_datetime <= '$datetime' and '$datetime' <
                         * finish_datetime)";
                         *
                         * $stop_flag = db_get_all($sql);
                         */
                        $reserve_flag = $stop_flag = 0;
                        /* if (isset($today_reserve_flag))
                            foreach ($today_reserve_flag as $kk => $vv) {
                                if (strtotime($vv['begin_datetime']) <= $strdt &&
                                         strtotime($vv['finish_datetime']) >
                                         $strdt) {
                                    $reserve_flag = $vv['reserve_id'];
                                    break;
                                }
                            }
                        if (isset($today_stop_flag))
                            foreach ($today_stop_flag as $kk => $vv) {
                                if (strtotime($vv['begin_datetime']) <= $strdt &&
                                         strtotime($vv['finish_datetime']) >
                                         $strdt) {
                                    $stop_flag = $vv;
                                    break;
                                }
                            } */
                            
                        /**
                         * NEW
                         */
                        if (isset($v['re_begin_datetime'])){
                            $today_reserve_begin = explode(",", $v['re_begin_datetime']);
                            $today_reserve_finish = explode(",", $v['re_finish_datetime']);
                            $today_reserve_id = explode(",", $v['re_reserve_id']);
                            for ($i = 0; $i < count($today_reserve_begin); $i++) {
                                if (strtotime($today_reserve_begin[$i]) <= $strdt &&
                                        strtotime($today_reserve_finish[$i]) > $strdt) {
                                    $reserve_flag = $today_reserve_id[$i];
                                    break;
                                }
                            }
                        }
                        if (isset($v['ren_begin_datetime'])) {
                            $today_stop_begin = explode(",", $v['ren_begin_datetime']);
                            $today_stop_finish = explode(",", $v['ren_finish_datetime']);
                            $today_stop_flag = explode(",", $v['ren_flag']);
                            $today_stop_limit_datetime = explode(",", $v['ren_limit_datetime']);
                            $today_stop_admin_name = explode(",", $v['ren_admin_name']);
                            $today_stop_memo = explode(",", $v['ren_memo']);
                            for ($i = 0; $i < count($today_stop_begin); $i++) {
                                if (strtotime($today_stop_begin[$i]) <= $strdt &&
                                        strtotime($today_stop_finish[$i]) > $strdt) {
                                    $ren_values = array();
                                    $ren_values['flag'] = $today_stop_flag[$i];
                                    $ren_values['limit_datetime'] = $today_stop_limit_datetime[$i];
                                    $ren_values['admin_name'] = $today_stop_admin_name[$i];
                                    $ren_values['memo'] = $today_stop_memo[$i];
                                    $stop_flag = $ren_values;
                                    break;
                                }
                            }
                        }
                            /*
                         * if($reserve_flag){
                         * $room_data[$k]['opentime'][$key]['reserved'] =
                         * $reserve_flag[0]['reserve_id'];
                         * }elseif($stop_flag){
                         * $room_data[$k]['opentime'][$key]['stoped'] =
                         * $stop_flag[0];
                         * }
                         */
                        if ($reserve_flag) {
                            $room_data[$k]['opentime'][$key]['reserved'] = $reserve_flag;
                        } elseif ($stop_flag) {
                            if ($stop_flag['flag'] == 1) { // rental_stopとの仕様合わせ:この3行
                                $stop_flag['limit_datetime'] = "無期限";
                            }
                            $room_data[$k]['opentime'][$key]['stoped'] = $stop_flag;
                        }
                    }
                } else {
                    // 池袋
                    // コマ割り
                    $room_data[$k]['komawari'] = array();
                    
                    /**
                     * OLD
                     */
                    /* $sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = " .
                             $v['room_id'] .
                             " and cancel_flag=0 and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime)";
                    $today_reserve_flag = db_get_all($sql, $db);
                    
                    // 重なる貸し止め
                    $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = " .
                             $v['room_id'] .
                             " and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime) and (limit_datetime > now() or flag=1)";
                    $today_stop_flag = db_get_all($sql, $db);
                    // var_dump($today_stop_flag);
                    
                    // 部屋データ取得
                    
                    $sql = "select * from a_room where hall_id=$hall_id and room_id=" .
                             $v['room_id'];
                    $roomstatus = db_get_all($sql, $db); */
                    
                    $sql = "select * from a_reserve_list where hall_id = $hall_id and room_id = " .
                             $v['room_id'] .
                             " and cancel_flag = 1 and (begin_datetime >= '$daystart' and '$dayend' > finish_datetime)";
                    $moneycancel = db_get_all($sql, $db);
                    foreach ($room_data[$k]['opentime'] as $open_k => $open_v) {
                        $datetime = $year . "-" . $month . "-" . $day . " " .
                                 $open_v . ":00:00";
                        $strdt = strtotime($datetime);
                        /*
                         * // 重なる予約
                         * $sql = "select reserve_id from a_reserve_list where
                         * hall_id = $hall_id and room_id = ".$v['room_id']."
                         * and cancel_flag=0 and (begin_datetime <= '$datetime'
                         * and '$datetime' < finish_datetime)";
                         * $reserve_flag = db_get_all($sql);
                         * // 重なる貸し止め
                         * $sql = "select * from a_rental_stop where hall_id =
                         * $hall_id and room_id = ".$v['room_id']." and
                         * (begin_datetime <= '$datetime' and '$datetime' <
                         * finish_datetime)";
                         * $stop_flag = db_get_all($sql);
                         */
                        // print $sql."<br>";
                        for ($x = 1; $x <= 23; $x ++) {
                            if (! is_null($v['begin_time' . $x]) and
                                     $open_v == $v['begin_time' . $x]) {
                                $room_data[$k]['komawari'][$open_k]['cs'] = ($v['finish_time' .
                                 $x] - $v['begin_time' . $x]) * 4;
                        $room_data[$k]['komawari'][$open_k]['begin_time'] = sprintf(
                                "%02d", $v['begin_time' . $x]) . ":00";
                        $room_data[$k]['komawari'][$open_k]['finish_time'] = sprintf(
                                "%02d", $v['finish_time' . $x]) . ":00";
                        $room_data[$k]['komawari'][$open_k]['price'] = $v['price' .
                                 $x];
                        $room_data[$k]['komawari'][$open_k]['rest'] = 0;
                        $reserve_flag = $stop_flag = 0;
                        if (isset($moneycancel)) {
                            $num = 0;
                            $room_data[$k]['komawari'][$open_k]['money'] = 0;
                            foreach ($moneycancel as $key => $value) {
                                $cancel_date = strtotime(
                                        $value['cancel_datetime']);
                                $begin_date = strtotime(
                                        $value['begin_datetime']);
                                $datediff = abs($begin_date - $cancel_date);
                                $num = floor($datediff / (60 * 60 * 24));
                                if ($num < 9) {
                                    $room_data[$k]['komawari'][$open_k]['money'] = $value['total_price'];
                                } else 
                                    if ($num >= 9 && $num < 14) {
                                        $room_data[$k]['komawari'][$open_k]['money'] = $value['total_price'] *
                                                 0.5;
                                    } else 
                                        if ($num >= 14 && $num <= 29) {
                                            $room_data[$k]['komawari'][$open_k]['money'] = $value['total_price'] *
                                                     0.2;
                                        } else 
                                            if ($num > 29) {
                                                $room_data[$k]['komawari'][$open_k]['money'] = $value['total_price'] *
                                                         0.1;
                                            }
                            }
                        }
                        
                        /**
                         * OLD
                         */
                        /* if (isset($today_reserve_flag))
                            foreach ($today_reserve_flag as $kk => $vv) {
                                if (strtotime($vv['begin_datetime']) <= $strdt &&
                                         strtotime($vv['finish_datetime']) >
                                         $strdt) {
                                    $reserve_flag = $vv['reserve_id'];
                                    break;
                                }
                            }
                        if (isset($today_stop_flag))
                            foreach ($today_stop_flag as $kk => $vv) {
                                if (strtotime($vv['begin_datetime']) <= $strdt &&
                                         strtotime($vv['finish_datetime']) >
                                         $strdt) {
                                    $stop_flag = $vv;
                                    break;
                                }
                            } */
                        
                        /**
                         * NEW
                         */
                        if (isset($v['re_begin_datetime'])){
                            $today_reserve_begin = explode(",", $v['re_begin_datetime']);
                            $today_reserve_finish = explode(",", $v['re_finish_datetime']);
                            $today_reserve_id = explode(",", $v['re_reserve_id']);
                            for ($i = 0; $i < count($today_reserve_begin); $i++) {
                                if (strtotime($today_reserve_begin[$i]) <= $strdt &&
                                        strtotime($today_reserve_finish[$i]) > $strdt) {
                                    $reserve_flag = $today_reserve_id[$i];
                                    break;
                                }
                            }
                        }
                        if (isset($v['ren_begin_datetime'])) {
                            $today_stop_begin = explode(",", $v['ren_begin_datetime']);
                            $today_stop_finish = explode(",", $v['ren_finish_datetime']);
                            $today_stop_flag = explode(",", $v['ren_flag']);
                            $today_stop_limit_datetime = explode(",", $v['ren_limit_datetime']);
                            $today_stop_admin_name = explode(",", $v['ren_admin_name']);
                            $today_stop_memo = explode(",", $v['ren_memo']);
                            for ($i = 0; $i < count($today_stop_begin); $i++) {
                                if (strtotime($today_stop_begin[$i]) <= $strdt &&
                                        strtotime($today_stop_finish[$i]) > $strdt) {
                                    $ren_values = array();
                                    $ren_values['flag'] = $today_stop_flag[$i];
                                    $ren_values['limit_datetime'] = $today_stop_limit_datetime[$i];
                                    $ren_values['admin_name'] = $today_stop_admin_name[$i];
                                    $ren_values['memo'] = $today_stop_memo[$i];
                                    $stop_flag = $ren_values;
                                    break;
                                }
                            }
                        }
                        
                        if ($reserve_flag) {
                            $room_data[$k]['komawari'][$open_k]['reserved'] = $reserve_flag;
                        } elseif ($stop_flag) {
                            if ($stop_flag['flag'] == 1) { // rental_stopとの仕様合わせ
                                                       // この3行
                                $stop_flag['limit_datetime'] = "無期限";
                            }
                            $room_data[$k]['komawari'][$open_k]['stoped'] = $stop_flag;
                        }
                        /*
                         * if($reserve_flag[0]['reserve_id']){
                         * $room_data[$k]['komawari'][$open_k]['reserved']=$reserve_flag[0]['reserve_id'];
                         * }elseif($stop_flag[0]['stop_id']){
                         * $room_data[$k]['komawari'][$open_k]['stoped']=$stop_flag[0];
                         * }
                         */
                        break;
                    } else {
                        /*
                         * $sql="select count(*) as flag from a_room where
                         * hall_id=$hall_id and room_id=".$v['room_id']." and
                         * ((begin_time1 < $open_v and $open_v < finish_time1)
                         * or (begin_time2 < $open_v and $open_v < finish_time2)
                         * or (begin_time3 < $open_v and $open_v < finish_time3)
                         * or (begin_time4 < $open_v and $open_v < finish_time4)
                         * or (begin_time5 < $open_v and $open_v < finish_time5)
                         * or (begin_time6 < $open_v and $open_v < finish_time6)
                         * or (begin_time7 < $open_v and $open_v < finish_time7)
                         * or (begin_time8 < $open_v and $open_v < finish_time8)
                         * or (begin_time9 < $open_v and $open_v < finish_time9)
                         * or (begin_time10 < $open_v and $open_v <
                         * finish_time10) or (begin_time11 < $open_v and $open_v
                         * < finish_time11) or (begin_time12 < $open_v and
                         * $open_v < finish_time12) or (begin_time13 < $open_v
                         * and $open_v < finish_time13) or (begin_time14 <
                         * $open_v and $open_v < finish_time14) or (begin_time15
                         * < $open_v and $open_v < finish_time15) or
                         * (begin_time16 < $open_v and $open_v < finish_time16)
                         * or (begin_time17 < $open_v and $open_v <
                         * finish_time17) or (begin_time18 < $open_v and $open_v
                         * < finish_time18) or (begin_time19 < $open_v and
                         * $open_v < finish_time19) or (begin_time20 < $open_v
                         * and $open_v < finish_time20) or (begin_time21 <
                         * $open_v and $open_v < finish_time21) or (begin_time22
                         * < $open_v and $open_v < finish_time22) or
                         * (begin_time23 < $open_v and $open_v <
                         * finish_time23))";
                         * //print $sql."<br>";
                         * $check = db_get_all($sql);
                         * if(!$check[0]['flag']){
                         */
                        $f = 0;
                        for ($i = 1; $i <= 23; $i ++) {
                            if ($v['begin_time' . $i] < $open_v &&
                                     $open_v < $v['finish_time' . $i]) {
                                $f = 1;
                                break;
                            }
                        }
                        if (! $f) {
                            $room_data[$k]['komawari'][$open_k]['cs'] = 4;
                            $room_data[$k]['komawari'][$open_k]['rest'] = 1;
                        }
                    } // if
                } // for
            }
        } // if type
    } else { // holiday
        
        $room_data[$k]['holiday'] = 1;
    } // holiday
} // foreach
  
// //////////////予約のコマをくっつける

foreach ($room_data as $key => $value) {
    $opentime2 = array();
    $line = 0;
    if ($value['type'] == 2) {
        $count = 0;
        if ($value['opentime']) {
            foreach ($value['opentime'] as $k => $v) {
                if ($v['reserved']) {
                    if ($count == 0) {
                        $kk = $k;
                        while ($v['reserved'] ==
                                 $value['opentime'][$kk]['reserved']) {
                                    // print
                                    // $v['reserved']."==".$value['opentime'][$kk]['reserved']."<br>";
                                    $count ++;
                            if ($count > 20) {
                                break;
                            }
                            $kk ++;
                        }
                        // print $v['time']."<br>";
                        $opentime2[$line] = $v;
                        $opentime2[$line]['cs'] = $value['cs'] * $count;
                        
                        // 予約情報を入れる
                        $sql = "select * from a_reserve_list where reserve_id = " .
                                 $v['reserved'];
                        $reserve_data = db_get_all($sql);
                        $opentime2[$line]['reserve_data'] = $reserve_data[0];
                        $opentime2[$line]['kanban'] = urlencode(
                                $reserve_data[0]['kanban']);
                        $dt = new DateTime($reserve_data[0]['begin_datetime']);
                        $opentime2[$line]['begin'] = $dt->format("H時i分");
                        $dt = new DateTime($reserve_data[0]['finish_datetime']);
                        $opentime2[$line]['finish'] = $dt->format("H時i分");
                        
                        $sql = "select * from c_member where c_member_id = " .
                                 $reserve_data[0]['c_member_id'];
                        $c_member = db_get_all($sql);
                        $opentime2[$line]['c_member'] = $c_member[0];
                        
                        $opentime2[$line]['corp'] = get_profile_value(
                                $reserve_data[0]['c_member_id'], 12);
                        
                        // 備品
                        $sql = "select * from a_reserve_v where reserve_id = " .
                                 $v['reserved'] . " and cancel_flag = 0";
                        $reserve_v_list = db_get_all($sql);
                        if ($reserve_v_list) {
                            foreach ($reserve_v_list as $loop_k => $loop_v) {
                                $vessel_data = get_vessel_data(
                                        $loop_v['vessel_id']);
                                $reserve_v_list[$loop_k]['vessel_name'] = $vessel_data['vessel_name'];
                            }
                        } else {
                            $reserve_v_list = 0;
                        }
                        $opentime2[$line]['reserve_v_list'] = $reserve_v_list;
                        
                        // サービス
                        $sql = "select * from a_reserve_s where reserve_id = " .
                                 $v['reserved'] . " and cancel_flag = 0";
                        $reserve_s_list = db_get_all($sql);
                        
                        if ($reserve_s_list) {
                            foreach ($reserve_s_list as $loop_k => $loop_v) {
                                $service_data = get_service_data(
                                        $loop_v['service_id']);
                                $reserve_s_list[$loop_k]['service_name'] = $service_data['service_name'];
                            }
                        } else {
                            $reserve_s_list = 0;
                        }
                        $opentime2[$line]['reserve_s_list'] = $reserve_s_list;
                        $line ++;
                    }
                } else {
                    // print $v['time']."<br>";
                    $opentime2[$line] = $v;
                    $opentime2[$line]['cs'] = $value['cs'];
                    $line ++;
                }
                if ($count) {
                    $count --;
                }
            }
        }
        $room_data[$key]['opentime'] = $opentime2;
    } else {
        // type=1
        $count = 0;
        if ($value['komawari']) {
            $col = count($value['komawari']);
            foreach ($value['komawari'] as $k => $v) {
                if ($count == 0) {
                    $opentime2[$line] = $v;
                    $opentime2[$line]['cs'] = $v['cs'];
                    $colspan = 0;
                    if (isset($v['reserved'])) {
                        foreach ($value['komawari'] as $kk => $vv) {
                            if (isset($vv['reserved']) && isset($v['reserved']) && $v['reserved'] == $vv['reserved']) {
                                // ///////////////////////
                                
                                // $colspan = 1;
                                $colspan = $kk;
                                
                                // //////////////////////
                            }
                        }
                        // 予約情報を入れる
                        $sql = "select * from a_reserve_list where reserve_id = " .
                                 $v['reserved'];
                        $reserve_data = db_get_all($sql);
                        $opentime2[$line]['reserve_data'] = $reserve_data[0];
                        $opentime2[$line]['kanban'] = urlencode(
                                $reserve_data[0]['kanban']);
                        $dt = new DateTime($reserve_data[0]['begin_datetime']);
                        $opentime2[$line]['begin'] = $dt->format("H時i分");
                        $dt = new DateTime($reserve_data[0]['finish_datetime']);
                        $opentime2[$line]['finish'] = $dt->format("H時i分");
                        
                        $sql = "select * from c_member where c_member_id = " .
                                 $reserve_data[0]['c_member_id'];
                        $c_member = db_get_all($sql);
                        $opentime2[$line]['c_member'] = $c_member[0];
                        
                        $opentime2[$line]['corp'] = get_profile_value(
                                $reserve_data[0]['c_member_id'], 12);
                        
                        // 備品
                        $sql = "select * from a_reserve_v where reserve_id = " .
                                 $v['reserved'] . " and cancel_flag = 0";
                        $reserve_v_list = db_get_all($sql);
                        if ($reserve_v_list) {
                            foreach ($reserve_v_list as $loop_k => $loop_v) {
                                $vessel_data = get_vessel_data(
                                        $loop_v['vessel_id']);
                                $reserve_v_list[$loop_k]['vessel_name'] = $vessel_data['vessel_name'];
                            }
                        } else {
                            $reserve_v_list = 0;
                        }
                        $opentime2[$line]['reserve_v_list'] = $reserve_v_list;
                        // サービス
                        $sql = "select * from a_reserve_s where reserve_id = " .
                                 $v['reserved'] . " and cancel_flag = 0";
                        $reserve_s_list = db_get_all($sql);
                        
                        if ($reserve_s_list) {
                            foreach ($reserve_s_list as $loop_k => $loop_v) {
                                $service_data = get_service_data(
                                        $loop_v['service_id']);
                                $reserve_s_list[$loop_k]['service_name'] = $service_data['service_name'];
                            }
                        } else {
                            $reserve_s_list = 0;
                        }
                        $opentime2[$line]['reserve_s_list'] = $reserve_s_list;
                    }
                    // print "$k!=$colspan : id=".$v['reserved']."<Br>";
                    
                    if ($colspan) {
                        $count ++;
                        foreach ($value['komawari'] as $kk => $vv) {
                            if ($k < $kk and $kk <= $colspan) {
                                $opentime2[$line]['cs'] += $vv['cs'];
                                
                                $count ++;
                            }
                        }
                    }
                    $line ++;
                }
                
                if ($count) {
                    $count --;
                }
            }
        }
        $room_data[$key]['komawari'] = $opentime2;
    }
}
$this->set('open_time', $open_time);
$this->set('money', isset($imoney) ? $imoney : null);
$this->set('room_data', $room_data);
$this->set('hall_data', $hall_data);
$this->set('hall_id', $hall_id);
$this->set('year', $year);
$this->set('month', $month);
$this->set('day', $day);
$this->set('week', $week);

$ct = count($open_time);
$this->set('ct', $ct);

return 'success';
}
}

?>
