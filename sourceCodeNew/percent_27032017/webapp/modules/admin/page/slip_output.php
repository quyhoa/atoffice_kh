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
class admin_page_slip_output extends OpenPNE_Action {

    function execute($requests) {        
        // アクセス権限
        $sql = "select name, atoffice_auth_type from c_admin_user where username = '" . $_SESSION['_authsession']['username'] . "'";
        $result = db_get_all($sql);
        $this->set('name', $result[0]['name']);
        $this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

        $menu = !empty($_REQUEST['menu']) ? $_REQUEST['menu'] : null;
        $this->set('menu', $menu);
        set_time_limit(0);


/////////////////////////////////////////////////////////////////////////
        if ($menu == "business_report") {
            $this->set('title', '業務報告（委託者用）');
            // set_time_limit(0);
            $sql = "select * from a_agency";
            $agencys = db_get_all($sql);
            $agency_list = Array();
            foreach ($agencys as $i)
            {
                if($i['type'] == 1){
                    $hallListId = !empty($i['hall_list']) ? json_decode($i['hall_list'],true) : null;
                    if(!empty($hallListId[$_POST['hall_id']])){
                        $agency_list[$i['c_member_id']] = $hallListId[$_POST['hall_id']];
                    }                    
                }else{
                    $agency_list[$i['c_member_id']] = $i['percent'];
                }
            }
            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year'] = isset($_POST['year']) ? $_POST['year'] : null;
            $_POST['month'] = isset($_POST['month']) ? $_POST['month'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year', $_POST['year']);
            $this->set('month', $_POST['month']);

            if (is_null($_POST['hall_id']) or is_null($_POST['year']) or is_null($_POST['month'])) {
                return 'success';
            }

            $date = $_POST['year'] . "-" . sprintf("%02d", $_POST['month']);
            //var_dump($date);
            $sql = "select * from a_hall where hall_id = " . $_POST['hall_id'];
            $hall_data = db_get_all($sql);
            $hall_data = $hall_data[0];

            $this->set('hall_data', $hall_data);

//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and DATE_FORMAT(begin_datetime, '%Y-%m') = '$date' and ";
////    $sql.= "tmp_flag = 0 and cancel_flag = 0 and pay_flag = 1 ";
//  $sql.= "tmp_flag = 0 and pay_flag = 1 ";
//  $sql.= "order by begin_datetime";
//-!
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and (( DATE_FORMAT(begin_datetime, '%Y-%m') = '$date' and cancel_flag = 0 ) or ";
//  $sql.= "(DATE_FORMAT(cancel_datetime, '%Y-%m') = '$date' and cancel_flag = 1 ))";
//  $sql.= " and tmp_flag = 0 and pay_flag = 1 ";
//  $sql.= "order by begin_datetime";
//キャンセルの支払いはpay_flagに依存しないため、
//ここではcancel_flag==1のものは全て取っておく。
//pay_checkdateが月を越えるものは未入金に回す
//
            $sql = "select * from a_reserve_list where hall_id = " . $_POST['hall_id'] . " and (( DATE_FORMAT(begin_datetime, '%Y-%m') = '$date' and cancel_flag = 0 and (pay_flag = 1 OR pay_flag = 2) and DATE_FORMAT(pay_checkdate,'%Y-%m') <= '$date' ) ";
           // 2014-12-02
            $sql.= " OR (DATE_FORMAT(a_reserve_list.cancel_datetime, '%Y-%m') = '$date' ) and cancel_flag = 1) ";
            $sql.= " and tmp_flag = 0 ";
            $sql.= "order by begin_datetime";


//  echo $sql."\n";


            $reserve_data = db_get_all($sql);

            $total_room_price = 0;
            $total_cancel_price = 0;
            $total_room_aomop = 0;
            $total_vessel_price = 0;
            $total_vessel_aomop = 0;
            $total_earnings = 0;
            $total_room_aomop_payment = 0;
            $total_vessel_aomop_payment = 0;
            foreach ($reserve_data as $key => $value) {
                if ($value['cancel_flag'] == 1) {
                    $sql = "select * from a_amount_billed where reserve_id = " . $value['reserve_id'];
                    $ab_data = db_get_all($sql);
                    $ab_data = isset($ab_data[0]) ? $ab_data[0] : null;
                    // if (!$ab_data['flag']) {
                    //     unset($reserve_data[$key]);
                    //     continue;
                    // }
                }

                $dt = new DateTime($value['begin_datetime']);
                $reserve_data[$key]['date'] = $dt->format("Y/m/d");
                $begin = $dt->format("H:i");
                $dt = new DateTime($value['finish_datetime']);
                $finish = $dt->format("H:i");
                $reserve_data[$key]['time'] = $begin . "-" . $finish;
                $reserve_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                $pay_date = ($value['cancel_flag'] == 1) ? $ab_data['check_datetime'] : $value['pay_checkdate'];
                $dt = new DateTime(($value['cancel_flag'] == 1) ? $ab_data['check_datetime'] : $value['pay_checkdate']);
                // if(!empty($pay_date) && $pay_date !="0000-00-00 00:00:00"){
                //     $reserve_data[$key]['pay_date'] = $dt->format("Y/m/d");               
                // }
                // else{
                //     $reserve_data[$key]['pay_date'] = "";
               
                // }
                $reserve_data[$key]['pay_date'] = $dt->format("Y/m/d"); 
                $dt = new DateTime($value['pay_limitdate']);
                $reserve_data[$key]['limit_date'] = $dt->format("Y/m/d");
                $dt = new DateTime($value['cancel_datetime']);
                $reserve_data[$key]['cancel_date'] = $dt->format("Y/m/d");

                if ($value['cancel_flag'] == 1) {

//          $sql = "select * from a_amount_billed where reserve_id = ".$value['reserve_id'];
//          $ab_data = db_get_all($sql);
//          $ab_data = $ab_data[0];
                    if (!empty($ab_data)) {
                        $reserve_data[$key]['cancel_price'] = $ab_data['total_billed_money'];
                        $total_cancel_price += $ab_data['total_billed_money'];
                    }
                   //rsdn 2014
                        $begindate = date('Y-m-d',strtotime($value['begin_datetime']));
                        $canceldate=date('Y-m-d',strtotime($value['cancel_datetime']));
                        $timeDiff = abs(strtotime($begindate)-strtotime($canceldate));
                        $numberDays = $timeDiff/86400;  
                        $numBeforeDate = intval($numberDays);
                        if($numBeforeDate <=9){
                            $roomprice= $value['room_price'];
                            $verselprice = $value['vessel_price'];
                            
                        }
                        else if($numBeforeDate >9 && $numBeforeDate <=14){
                             $roomprice= $value['room_price']*0.5;
                             $verselprice = $value['vessel_price']*0.5;
                        }
                        else if($numBeforeDate >14 && $numBeforeDate <=29)
                        {
                            $roomprice= $value['room_price']*0.2;
                            $verselprice = $value['vessel_price']*0.2;
                        }
                        else{
                             $roomprice= $value['room_price']*0.1;
                             $verselprice = $value['vessel_price']*0.1;
                        }
                       $reserve_data[$key]['room_price']=$value['room_price']=round($roomprice);
                       $reserve_data[$key]['vessel_price']=$value['vessel_price']=round($verselprice);
                       if($reserve_data[$key]['cancel_price'] > $roomprice)
                       {
                            $reserve_data[$key]['cancel_price'] = $roomprice;
                       }
                       $reserve_data[$key]['room_aomop'] = round($reserve_data[$key]['cancel_price'] * ($hall_data['owner_room'] * 0.01));
               
                    
                } else {
                    $reserve_data[$key]['cancel_price'] = -1;
                    $total_room_price += $value['room_price'];
                    $total_vessel_price += $value['vessel_price'];
                    $reserve_data[$key]['room_aomop'] = round($value['room_price'] * ($hall_data['owner_room'] * 0.01));
               
                    
                }
                
                $total_room_aomop += $reserve_data[$key]['room_aomop'];

                $reserve_data[$key]['vessel_aomop'] = round($value['vessel_price'] * ($hall_data['owner_vessel'] * 0.01));
                $total_vessel_aomop += $reserve_data[$key]['vessel_aomop'];

                $reserve_data[$key]['total_aomop'] = $reserve_data[$key]['room_aomop'] + $reserve_data[$key]['vessel_aomop'];
                if($reserve_data[$key]['pay_date'] != '')
                {
                    $total_room_aomop_payment +=  $reserve_data[$key]['room_aomop'];
                    $total_vessel_aomop_payment +=  $reserve_data[$key]['vessel_aomop'];
                }
                
                // 備品データ
                $sql = "select * from a_reserve_v where reserve_id = " . $value['reserve_id'];
                $result = db_get_all($sql);
                foreach ($result as $k => $v) {
                    $result[$k]['vessel_name'] = get_vessel_name($v['vessel_id']);
                }
                $reserve_data[$key]['vessel_data'] = $result;

                $reserve_data[$key]['earnings'] = ($value['room_price'] + $value['vessel_price']) - $reserve_data[$key]['total_aomop'];
                $total_earnings += $reserve_data[$key]['earnings'];
            }// foreach reserve_data
            
            $this->set('agency_list', $agency_list);
            $this->set('reserve_data', $reserve_data);
            $this->set('total_room_price', $total_room_price);
            $this->set('total_cancel_price', $total_cancel_price);
            $this->set('total_room_aomop', $total_room_aomop);
            $this->set('total_vessel_price', $total_vessel_price);
            $this->set('total_vessel_aomop', $total_vessel_aomop);
            $this->set('total_total_aomop', $total_room_aomop + $total_vessel_aomop);
            $this->set('total_earnings', $total_earnings);
            $this->set('total_room_aomop_payment ', $total_room_aomop_payment );
            $this->set('total_vessel_aomop_payment', $total_vessel_aomop_payment);

            // 過去利用入金済
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and DATE_FORMAT(begin_datetime, '%Y-%m') < '$date' and ";
//  $sql.= "tmp_flag = 0 and pay_flag = 1 ";
//  $sql.= "order by begin_datetime";
//-
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and (( DATE_FORMAT(begin_datetime, '%Y-%m') < '$date' and cancel_flag = 0 ) or ( DATE_FORMAT(cancel_datetime, '%Y-%m') < '$date' and cancel_flag = 1 ))";
//  $sql.= " and tmp_flag = 0 and and pay_flag = 1 ";
//  $sql.= "order by begin_datetime";
//
            $sql = "select * from a_reserve_list where hall_id = " . $_POST['hall_id'] . " and (( DATE_FORMAT(begin_datetime, '%Y-%m') < '$date' and DATE_FORMAT(pay_checkdate, '%Y-%m') = '$date' and cancel_flag = 0 and pay_flag = 1 and DATE_FORMAT(pay_checkdate,'%Y-%m') <= '$date' ) or ( DATE_FORMAT(cancel_datetime, '%Y-%m') < '$date' and cancel_flag = 1 ))";
            $sql.= " and tmp_flag = 0 ";
            $sql.= "order by begin_datetime";
//  echo $sql."\n";
//pay_checkdate //reserve_list  
//check_datetime    // amount_billed
            $paid_data = db_get_all($sql);

            $total_room_price_before = 0;
            $total_cancel_price_before = 0;
            $total_room_aomop_before = 0;
            $total_vessel_price_before = 0;
            $total_vessel_aomop_before = 0;
            $total_earnings_before = 0;

            foreach ($paid_data as $key => $value) {
                if ($value['cancel_flag'] == 1) {
                    $sql = "select * from a_amount_billed where reserve_id = " . $value['reserve_id'] . " and DATE_FORMAT(check_datetime, '%Y-%m') = '$date'";
                    $ab_data = db_get_all($sql);
                    $ab_data = isset($ab_data[0]) ? $ab_data[0] : null;
                    if (!$ab_data['flag']) {
                        unset($paid_data[$key]);
                        continue;
                    }
                }

                $dt = new DateTime($value['begin_datetime']);
                $paid_data[$key]['date'] = $dt->format("Y/m/d");
                $begin = $dt->format("H:i");
                $dt = new DateTime($value['finish_datetime']);
                $finish = $dt->format("H:i");
                $paid_data[$key]['time'] = $begin . "-" . $finish;
                $paid_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                $pay_date = ($value['cancel_flag'] == 1) ? $ab_data['check_datetime'] : $value['pay_checkdate'];
                $dt = new DateTime(($value['cancel_flag'] == 1) ? $ab_data['check_datetime'] : $value['pay_checkdate']);
                if(!empty($pay_date) && $pay_date != "0000-00-00 00:00:00")
                {
                    $paid_data[$key]['pay_date'] = $dt->format("Y/m/d");
                }
                else{
                    $paid_data[$key]['pay_date'] = '';
                }
                
                $dt = new DateTime($value['pay_limitdate']);
                $paid_data[$key]['limit_date'] = $dt->format("Y/m/d");
                $dt = new DateTime($value['cancel_datetime']);
                if(!empty($value['cancel_datetime']) && $value['cancel_datetime'] != "0000-00-00 00:00:00")
                {
                    $paid_data[$key]['cancel_date'] = $dt->format("Y/m/d");
                }
                else{
                    $paid_data[$key]['cancel_date'] = '';
                }
                if ($value['cancel_flag'] == 1) {

//          $sql = "select * from a_amount_billed where reserve_id = ".$value['reserve_id'];
//          $ab_data = db_get_all($sql);
//          $ab_data = $ab_data[0];
                    if ($ab_data) {
                        $paid_data[$key]['cancel_price'] = $ab_data['total_billed_money'];
                        $total_cancel_price_before += $ab_data['total_billed_money'];
                    }
                      //rsdn 2014
                        $begindate = date('Y-m-d',strtotime($value['begin_datetime']));
                        $canceldate=date('Y-m-d',strtotime($value['cancel_datetime']));
                        $timeDiff = abs(strtotime($begindate)-strtotime($canceldate));
                        $numberDays = $timeDiff/86400;  
                        $numBeforeDate = intval($numberDays);
                        if($numBeforeDate <=9){
                            $roomprice= $value['room_price'];
                            $verselprice = $value['vessel_price'];
                            
                        }
                        else if($numBeforeDate >9 && $numBeforeDate <=14){
                             $roomprice= $value['room_price']*0.5;
                             $verselprice = $value['vessel_price']*0.5;
                        }
                        else if($numBeforeDate >14 && $numBeforeDate <=29)
                        {
                            $roomprice= $value['room_price']*0.2;
                            $verselprice = $value['vessel_price']*0.2;
                        }
                        else{
                             $roomprice= $value['room_price']*0.1;
                             $verselprice = $value['vessel_price']*0.1;
                        }
                       $paid_data[$key]['room_price']=$value['room_price']=round($roomprice);
                       $paid_data[$key]['vessel_price']=$value['vessel_price']=round($verselprice);
                    
                    
                } else {
                    $paid_data[$key]['cancel_price'] = -1;
                    $total_room_price_before += $value['room_price'];
                    $total_vessel_price_before += $value['vessel_price'];
                }


                
                $paid_data[$key]['room_aomop'] = round($value['room_price'] * ($hall_data['owner_room'] * 0.01));
                $total_room_aomop_before += $paid_data[$key]['room_aomop'];

                $paid_data[$key]['vessel_aomop'] = round($value['vessel_price'] * ($hall_data['owner_vessel'] * 0.01));
                $total_vessel_aomop_before += $paid_data[$key]['vessel_aomop'];

                $paid_data[$key]['total_aomop'] = $paid_data[$key]['room_aomop'] + $paid_data[$key]['vessel_aomop'];

                // 備品データ
                $sql = "select * from a_reserve_v where reserve_id = " . $value['reserve_id'];
                $result = db_get_all($sql);
                foreach ($result as $k => $v) {
                    $result[$k]['vessel_name'] = get_vessel_name($v['vessel_id']);
                }
                $paid_data[$key]['vessel_data'] = $result;

                $paid_data[$key]['earnings'] = ($value['room_price'] + $value['vessel_price']) - $paid_data[$key]['total_aomop'];
                $total_earnings_before += $paid_data[$key]['earnings'];
            }// foreach paid_data

            $this->set('paid_data', $paid_data);
            $this->set('total_room_price_before', $total_room_price_before);
            $this->set('total_cancel_price_before', $total_cancel_price_before);
            $this->set('total_room_aomop_before', $total_room_aomop_before);
            $this->set('total_vessel_price_before', $total_vessel_price_before);
            $this->set('total_vessel_aomop_before', $total_vessel_aomop_before);
            $this->set('total_total_aomop_before', $total_room_aomop_before + $total_vessel_aomop_before);
            $this->set('total_earnings_before', $total_earnings_before);


            // 過去利用入金待ち
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and DATE_FORMAT(begin_datetime, '%Y-%m') <= '$date' and ";
//  $sql.= "tmp_flag = 0 and pay_flag = 0 ";
//-
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and ((DATE_FORMAT(begin_datetime, '%Y-%m') <= '$date' and cancel_flag = 0) or (DATE_FORMAT(cancel_datetime, '%Y-%m') <= '$date' and cancel_flag = 1))";
//  $sql.= " and tmp_flag = 0 and pay_flag = 0 ";
//-
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and ((DATE_FORMAT(begin_datetime, '%Y-%m') <= '$date' and cancel_flag = 0 and pay_flag = 0) or (DATE_FORMAT(cancel_datetime, '%Y-%m') <= '$date' and cancel_flag = 1))";
//  $sql = "select * from a_reserve_list where hall_id = ".$_POST['hall_id']." and ((DATE_FORMAT(begin_datetime, '%Y-%m') <= '$date' and (cancel_flag = 0 and (pay_flag = 0 or (pay_flag = 1 and DATE_FORMAT(pay_checkdate,'%Y-%m') > '$date')) or (DATE_FORMAT(cancel_datetime, '%Y-%m') <= '$date' and cancel_flag = 1))";
            $a = "cancel_flag = 0 and (pay_flag = 0 or (pay_flag = 1 and DATE_FORMAT(pay_checkdate,'%Y-%m') > '$date'))";
            $b = "DATE_FORMAT(cancel_datetime, '%Y-%m') <= '$date' and cancel_flag = 1";
            $sql = "select * from a_reserve_list where hall_id = " . $_POST['hall_id'] . " and DATE_FORMAT(begin_datetime, '%Y-%m') <= '$date' and (($a) or ($b))";
            $sql.= " and tmp_flag = 0 ";

            $sql.= "order by begin_datetime";
//  echo $sql."\n";

            $unpayment_data = db_get_all($sql);

            $total_room_price_before_unpayment = 0;
            $total_cancel_price_before_unpayment = 0;
            $total_room_aomop_before_unpayment = 0;
            $total_vessel_price_before_unpayment = 0;
            $total_vessel_aomop_before_unpayment = 0;
            $total_earnings_before_unpayment = 0;

            foreach ($unpayment_data as $key => $value) {
                if ($value['cancel_flag'] == 1) {

                    $sql = "select * from a_amount_billed where reserve_id = " . $value['reserve_id'];
                    $ab_data = db_get_all($sql);
                    $ab_data = isset($ab_data[0]) ? $ab_data[0] : null;
                    if (isset($ab_data['flag']) && $ab_data['flag']) {
                        unset($unpayment_data[$key]);
                        continue;
                    }
                }
                $dt = new DateTime($value['begin_datetime']);
                $unpayment_data[$key]['date'] = $dt->format("Y/m/d");
                $begin = $dt->format("H:i");
                $dt = new DateTime($value['finish_datetime']);
                $finish = $dt->format("H:i");
                $unpayment_data[$key]['time'] = $begin . "-" . $finish;
                $unpayment_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                $dt = new DateTime($value['pay_limitdate']);
                $unpayment_data[$key]['limit_date'] = ($value['pay_limitdate'] !='' && $value['pay_limitdate'] !='0000-00-00 00:00:00')?$dt->format("Y/m/d"):'';
                $cdt = new DateTime($value['cancel_datetime']);
                $unpayment_data[$key]['cancel_date'] = ($value['cancel_datetime'] !='' && $value['cancel_datetime'] !='0000-00-00 00:00:00')?$cdt->format("Y/m/d"):'';
                if ($value['cancel_flag'] == 1) {
                    if (!empty($ab_data)) {
                        $unpayment_data[$key]['cancel_price'] = $ab_data['total_billed_money'];
                        $total_cancel_price_before_unpayment += $ab_data['total_billed_money'];
                    }
                     //rsdn 2014
                        $begindate = date('Y-m-d',strtotime($value['begin_datetime']));
                        $canceldate=date('Y-m-d',strtotime($value['cancel_datetime']));
                        $timeDiff = abs(strtotime($begindate)-strtotime($canceldate));
                        $numberDays = $timeDiff/86400;  
                        $numBeforeDate = intval($numberDays);
                        if($numBeforeDate <=9){
                            $roomprice= $value['room_price'];
                            $verselprice = $value['vessel_price'];
                            
                        }
                        else if($numBeforeDate >9 && $numBeforeDate <=14){
                             $roomprice= $value['pay_money']*0.5;
                             $verselprice = $value['vessel_price']*0.5;
                        }
                        else if($numBeforeDate >14 && $numBeforeDate <=29)
                        {
                            $roomprice= $value['pay_money']*0.2;
                            $verselprice = $value['vessel_price']*0.2;
                        }
                        else{
                             $roomprice= $value['pay_money']*0.1;
                             $verselprice = $value['vessel_price']*0.1;
                        }
                       $unpayment_data[$key]['room_price']=$value['room_price']=round($roomprice);
                       $unpayment_data[$key]['vessel_price']=$value['vessel_price']=round($verselprice);
                } else {
                    $unpayment_data[$key]['cancel_price'] = -1;
                    $total_room_price_before_unpayment += $value['room_price'];
                    $total_vessel_price_before_unpayment += $value['vessel_price'];
                }
                $unpayment_data[$key]['room_aomop'] = round($value['room_price'] * ($hall_data['owner_room'] * 0.01));
                if($value['cancel_flag'] == 1)
                {
                     $unpayment_data[$key]['room_aomop'] = isset($unpayment_data[$key]['cancel_price']) ? round($unpayment_data[$key]['cancel_price'] * ($hall_data['owner_room'] * 0.01)) : 0;

                }


                $total_room_aomop_before_unpayment += $unpayment_data[$key]['room_aomop'];

                $unpayment_data[$key]['vessel_aomop'] = round($value['vessel_price'] * ($hall_data['owner_vessel'] * 0.01));
                $total_vessel_aomop_before_unpayment += $unpayment_data[$key]['vessel_aomop'];

                $unpayment_data[$key]['total_aomop'] = $unpayment_data[$key]['room_aomop'] + $unpayment_data[$key]['vessel_aomop'];
            }// foreach unpayment_data

            $this->set('unpayment_data', $unpayment_data);
            $this->set('total_room_price_before_unpayment', $total_room_price_before_unpayment);
            $this->set('total_cancel_price_before_unpayment', $total_cancel_price_before_unpayment);
            $this->set('total_room_aomop_before_unpayment', $total_room_aomop_before_unpayment);
            $this->set('total_vessel_price_before_unpayment', $total_vessel_price_before_unpayment);
            $this->set('total_vessel_aomop_before_unpayment', $total_vessel_aomop_before_unpayment);
            $this->set('total_total_aomop_before_unpayment', $total_room_aomop_before_unpayment + $total_vessel_aomop_before_unpayment);
            $this->set('total_earnings_before_unpayment', $total_earnings_before_unpayment);


            $this->set('price', $total_room_aomop + $total_vessel_aomop + $total_room_aomop_before + $total_vessel_aomop_before);

// business_report ///////////////////////////////////////////////////////////
        } elseif ($menu == "repetition_rate") {
            // set_time_limit(0);
            $this->set('title', 'リピート率分析');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);
            if (is_null($_POST['hall_id']) or is_null($_POST['year1']) or is_null($_POST['month1']) or is_null($_POST['day1']) or is_null($_POST['year2']) or is_null($_POST['month2']) or is_null($_POST['day2'])) {
                return 'success';
            }

            $this->set('hall_name', get_hall_name($_POST['hall_id']));


            // 期間内の予約総数(キャンセルされていない仮予約期間)
            $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $hall_id = $_POST['hall_id'];
            $result = get_repeat_rate($hall_id, $date_s, $date_e);


            $this->set('rate', $result['rate']);
            $this->set('rate_count', $result['count']);
            $this->set('rate_total', $result['total']);


///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////

            $date_s = $_POST['year1'] . sprintf("%02d", $_POST['month1']);
            $date_e = $_POST['year2'] . sprintf("%02d", $_POST['month2']);
            $year = $_POST['year1'];
            $month = $_POST['month1'];

            $repeat_list = array();
            $key = 0;


            while ($date_s <= $date_e) {
                //print $date_s."<br>";

                $repeat_list[$key]['date'] = $year . "年" . $month . "月";

                // 期間内の予約総数(キャンセルされていない仮予約期間)
                $date1 = $year . "-" . $month . "-" . "01 00:00:00";
                if (($month + 1) >= 13) {
                    $date2 = ($year + 1) . "-01-01 00:00:00";
                } else {
                    $date2 = $year . "-" . ($month + 1) . "-" . "01 00:00:00";
                }

//  $rate = get_repeat_rate($hall_id, $date1, $date2);
                $result = get_repeat_rate($hall_id, $date1, $date2);

//  $repeat_list[$key]['repeat_count'] = $repeat_count;
//  ↑値入ってなさげ
//  $repeat_list[$key]['rate'] = $rate;
                $repeat_list[$key]['repeat_count'] = $result['count'];
                $repeat_list[$key]['rate'] = $result['rate'];
                $repeat_list[$key]['rate_total'] = $result['total'];

                $date_s++;
                $month++;
                if ($month > 12) {
                    $month = 1;
                    $year++;
                    $date_s = $year . sprintf("%02d", $month);
                }
                $key++;
            }//while

            $this->set('repeat_list', $repeat_list);
            return 'success';

// repetition_rate //////////////////////////////////////////
        } elseif ($menu == "utilization_rates") {
            $this->set('title', '稼働率一覧');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (is_null($_POST['hall_id']) or $_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

            $this->set('hall_name', get_hall_name($_POST['hall_id']));

            $date_s = $_POST['year1'] . "年" . $_POST['month1'] . "月" . $_POST['day1'] . "日";
            $date_e = $_POST['year2'] . "年" . $_POST['month2'] . "月" . $_POST['day2'] . "日";
            $this->set('date_s', $date_s);
            $this->set('date_e', $date_e);

            $sql = "select * from a_hall where hall_id = " . $_POST['hall_id'];
            $hall_data = db_get_all($sql);
            $hall_data = $hall_data[0];

            $sql = "select * from a_room where hall_id = " . $_POST['hall_id'] . " and flag = 1";
            $room_data = db_get_all($sql);

            $hall_id = $_POST['hall_id'];

            // 営業時間
            $open_time = $hall_data['finish'] - $hall_data['begin'];

            $all_rrp = 0;
            $all_rvp = 0;
            $all_rt = 0;
            $all_tp = 0;
            $all_tt = 0;

            foreach ($room_data as $key => $value) {

                $room_id = $value['room_id'];

// 分子

                $reserved_room_price = 0;
                $reserved_rv_price = 0;


                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

                // 利用金額（オプションなし）
                $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
                $reserved_room_price = db_get_all($sql);
                $reserved_room_price = $reserved_room_price[0]['room_price'];
                $room_data[$key]['reserved_room_price'] = $reserved_room_price;

                // 利用金額（オプションあり）
                $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
                $reserved_rv_price = db_get_all($sql);
                $reserved_rv_price = $reserved_rv_price[0]['room_price'];
                $room_data[$key]['reserved_rv_price'] = $reserved_rv_price;

                // 利用時間
                $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
                $reserved_time = db_get_all($sql);
                $reserved_time = round($reserved_time[0]['reserved_time'], 0);
                $room_data[$key]['reserved_time'] = $reserved_time;


// 分母
                // 貸し出し可能金額
                $total_time = 0;

                $date_s = $_POST['year1'] . sprintf("%02d", $_POST['month1']) . sprintf("%02d", $_POST['day1']);
                $date_e = $_POST['year2'] . sprintf("%02d", $_POST['month2']) . sprintf("%02d", $_POST['day2']);
                $year = $_POST['year1'];
                $month = $_POST['month1'];
                $day = $_POST['day1'];
               
                // 1時間当たりの部屋利用料金
                if ($value['type'] == 2) {
                    if ($value['koma'] == 0.25) {
                        $room_price = $value['k_lowest_price'] * 4;
                    } elseif ($value['koma'] == 0.5) {
                        $room_price = $value['k_lowest_price'] * 2;
                    } elseif ($value['koma'] == 1) {
                        $room_price = $value['k_lowest_price'];
                    } elseif ($value['koma'] > 1) {
                        $room_price = round($value['k_lowest_price'] / $value['koma'], 0);
                    }
                } else {
                    $sql = "SELECT max(price) as price FROM a_room_pack where hall_id = $hall_id and room_id = $room_id";
                    $room_price = db_get_all($sql);
                    $room_price[0]['price'] = isset($room_price[0]['price']) ? $room_price[0]['price'] : 0;
                    $open_time = (isset($open_time) && $open_time > 0) ? $open_time : 1;
                    $room_price = round($room_price[0]['price'] / $open_time, 0);
//      $room_price = $room_price[0]['price'];
                }

                while ($date_s <= $date_e) {
						$checkTime = checkDayHoliday($year, $month, $day);
                         if($checkTime == 1){
				        	if($hall_data['begin1'] != '' && $hall_data['finish1'] != '' )
				        	{
				        	 	$open_time = $hall_data['finish1'] - $hall_data['begin1'];
				        	}
				           
				        }
				        else if($checkTime == 2){
				            if($hall_data['begin2'] != '' && $hall_data['finish2'] != '' )
				        	{
				        		$open_time = $hall_data['finish2'] - $hall_data['begin2'];
				        	}
				         
				        }
				        else if($checkTime == 3){
				            if($hall_data['begin3'] != '' && $hall_data['finish3'] != '' )
				        	{
				        		$open_time = $hall_data['finish3'] - $hall_data['begin3'];
				        	}
				           
				        }
				        else if($checkTime == 4){
				        	if($hall_data['begin4'] != '' && $hall_data['finish4'] != '' )
				        	{
				        			$open_time = $hall_data['finish4'] - $hall_data['begin4'];
				        	}
				           
				     	    
				        }
//休日でなければ
                    if (!check_holiday($hall_id, $room_id, $year, $month, $day)) {

                        // 貸し止め確認
                        $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                        $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                        $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
//echo "<br>$sql<br>";
                        $result = db_get_all($sql);
                        $stop = 0;
                        foreach ($result as $v) {
                            $dt = new DateTime($v['begin_datetime']);
                            $begin = $dt->format("H");
                            $dt = new DateTime($v['finish_datetime']);
                            $finish = $dt->format("H");
                            $stop += $finish - $begin;
                            // echo "貸し止め $date1 $stop<br>";
                        }
                        if ($stop) {
                            $total_time += $open_time - $stop;
                        } else {
                            $total_time += $open_time;
                        }
                    }


                    $date_s++;
                    $day++;
                    if (!checkdate($month, $day, $year)) {
                        $day = 1;
                        $month++;
                        if (!checkdate($month, $day, $year)) {
                            $month = 1;
                            $year++;
                        }
                        $date_s = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
                    }
                }// while

                $room_data[$key]['total_time'] = $total_time;
                $total_price = $room_price * $total_time;
                $room_data[$key]['total_room_price'] = $total_price;

                // レート計算
                // print "rt:" . $reserved_time . " " . $room_price . "*" . $total_time . "<br>";
                // print $room_id . ":" . $reserved_room_price . "/" . $total_price . "<br>";
                if ($total_price > 0) {
                    $rate_a = round(($reserved_room_price / $total_price) * 100, 0);
                    $rate_b = round(($reserved_rv_price / $total_price) * 100, 0);
                } else {
                    $rate_a = 0;
                    $rate_b = 0;
                }
                $room_data[$key]['rate_a'] = $rate_a;
                $room_data[$key]['rate_b'] = $rate_b;
                $rate_c = round(($reserved_time / $total_time) * 100, 0);
                $room_data[$key]['rate_c'] = $rate_c;

                $all_rrp += $reserved_room_price;
                $all_rvp += $reserved_rv_price;
                $all_rt += $reserved_time;
                $all_tp += $total_price;
                $all_tt += $total_time;
            }// foreach room_data

            $this->set('room_data', $room_data);

            if ($all_tp > 0) {
                $all_rate_a = round(($all_rrp / $all_tp) * 100, 0);
                $all_rate_b = round(($all_rvp / $all_tp) * 100, 0);
            } else {
                $all_rate_a = 0;
                $all_rate_b = 0;
            }
            $all_rate_c = round(($all_rt / $all_tt) * 100, 0);

            $this->set('all_rate_a', $all_rate_a);
            $this->set('all_rate_b', $all_rate_b);
            $this->set('all_rate_c', $all_rate_c);


// utilization_rates //////////////////////
        } elseif ($menu == "money_utilization_rates") {
            ini_set("max_execution_time", 0); //*************************************
//  set_time_limit(0);
            $this->set('title', '金額稼働率推移');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);

            if (is_null($_POST['hall_id']) or $_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "") {
                return 'success';
            }

            $this->set('hall_name', get_hall_name($_POST['hall_id']));

            $date_s = $_POST['year1'] . "年" . $_POST['month1'] . "月";
            $date_e = $_POST['year2'] . "年" . $_POST['month2'] . "月";
            $this->set('date_s', $date_s);
            $this->set('date_e', $date_e);

            $sql = "select * from a_hall where hall_id = " . $_POST['hall_id'];
            $hall_data = db_get_all($sql);
            $hall_data = $hall_data[0];

            $sql = "select * from a_room where hall_id = " . $_POST['hall_id'] . " and flag = 1";
            $room_data = db_get_all($sql);
            $this->set('room_data', $room_data);

            $hall_id = $_POST['hall_id'];

            // 営業時間
            $open_time = $hall_data['finish'] - $hall_data['begin'];

            $date_start = $_POST['year1'] . sprintf("%02d", $_POST['month1']);
            $date_end = $_POST['year2'] . sprintf("%02d", $_POST['month2']);

            $year_loop = $_POST['year1'];
            $month_loop = $_POST['month1'];

            $reserved_room_list = array();

            $k = 0;
            while ($date_start <= $date_end) {

                $all_rrp = 0;
                $all_rvp = 0;
                $all_rt = 0;
                $all_tp = 0;
                $all_tt = 0;

                $reserved_room_list[$k]['date'] = $year_loop . "年" . sprintf("%02d", $month_loop) . "月";

                foreach ($room_data as $key => $value) {

                    $room_id = $value['room_id'];
//      echo $room_id."<br>";   // test
                    // 分子

                    $reserved_room_price = 0;
                    $reserved_rv_price = 0;


                    $date_s = $year_loop . "-" . $month_loop . "-01 00:00:00";

                    for ($x = 28; checkdate($month_loop, $x, $year_loop); $x++) {
                        $day = $x;
                    }

                    $date_e = $year_loop . "-" . $month_loop . "-" . $day . " 23:59:59";

                    // 利用金額（オプションなし）
                    $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
//      echo "A:".$sql."<br>"; //+++++++++++++++++++++++++++++++++++++
                    $reserved_room_price = db_get_all($sql);
                    $reserved_room_price = $reserved_room_price[0]['room_price'];
                    $room_data[$key]['reserved_room_price'] = $reserved_room_price;

                    // 利用金額（オプションあり）
                    $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
//      echo "B:".$sql."<br>"; //+++++++++++++++++++++++++++++++++++++
                    $reserved_rv_price = db_get_all($sql);
                    $reserved_rv_price = $reserved_rv_price[0]['room_price'];
                    $room_data[$key]['reserved_rv_price'] = $reserved_rv_price;

                    // 分母
                    // 貸し出し可能金額
                    $total_time = 0;

                    $date_s = $year_loop . sprintf("%02d", $month_loop) . "01";
                    $date_e = $year_loop . sprintf("%02d", $month_loop) . sprintf("%02d", $day);
                    $year = $year_loop;
                    $month = $month_loop;
                    $day = 1;

                    // 1時間当たりの部屋利用料金
                    if ($value['type'] == 2) {
                        if ($value['koma'] == 0.25) {
                            $room_price = $value['k_lowest_price'] * 4;
                        } elseif ($value['koma'] == 0.5) {
                            $room_price = $value['k_lowest_price'] * 2;
                        } elseif ($value['koma'] == 1) {
                            $room_price = $value['k_lowest_price'];
                        } elseif ($value['koma'] > 1) {
                            $room_price = round($value['k_lowest_price'] / $value['koma'], 0);
                        }
                    } else {
                        $sql = "SELECT max(price) as price FROM a_room_pack where hall_id = $hall_id and room_id = $room_id";
//      echo "C:".$sql."<br>"; //+++++++++++++++++++++++++++++++++++++
                        $room_price = db_get_all($sql);
                        $room_price[0]['price'] = isset($room_price[0]['price']) ? $room_price[0]['price'] : 0;
                        $open_time = (isset($open_time) && $open_time > 0) ? $open_time : 1;
                        $room_price = round($room_price[0]['price'] / $open_time, 0);
//          $room_price = $room_price[0]['price'];
                    }

                    while ($date_s <= $date_e) {
						$checkTime = checkDayHoliday($year, $month, $day);
                         if($checkTime == 1){
				        	if($hall_data['begin1'] != '' && $hall_data['finish1'] != '' )
				        	{
				        	 	$open_time = $hall_data['finish1'] - $hall_data['begin1'];
				        	}
				           
				        }
				        else if($checkTime == 2){
				            if($hall_data['begin2'] != '' && $hall_data['finish2'] != '' )
				        	{
				        		$open_time = $hall_data['finish2'] - $hall_data['begin2'];
				        	}
				         
				        }
				        else if($checkTime == 3){
				            if($hall_data['begin3'] != '' && $hall_data['finish3'] != '' )
				        	{
				        		$open_time = $hall_data['finish3'] - $hall_data['begin3'];
				        	}
				           
				        }
				        else if($checkTime == 4){
				        	if($hall_data['begin4'] != '' && $hall_data['finish4'] != '' )
				        	{
				        			$open_time = $hall_data['finish4'] - $hall_data['begin4'];
				        	}
				           
				     	    
				        }

                        //休日でなければ
                        if (!check_holiday($hall_id, $room_id, $year, $month, $day)) {

                            // 貸し止め確認
//      $date1 = $year."-".$month."-01 00:00:00";
                            $date1 = $year . "-" . $month . "-$day 00:00:00";
                            $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                            $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
//      echo "D:".$sql."<br>"; //+++++++++++++++++++++++++++++++++++++
                            $result = db_get_all($sql);
                            $stop = 0;
                            foreach ($result as $v) {
                                $dt = new DateTime($v['begin_datetime']);
                                $begin = $dt->format("H");
                                $dt = new DateTime($v['finish_datetime']);
                                $finish = $dt->format("H");
                                $stop += $finish - $begin;
                            }
                            if ($stop) {
                                $total_time += $open_time - $stop;
                            } else {
                                $total_time += $open_time;
                            }
                        }


                        $date_s++;
                        $day++;
                        if (!checkdate($month, $day, $year)) {
                            $day = 1;
                            $month++;
                            if (!checkdate($month, $day, $year)) {
                                $month = 1;
                                $year++;
                            }
                            $date_s = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
                        }
                    }// while

                    $room_data[$key]['total_time'] = $total_time;
                    $total_price = $room_price * $total_time;
                    $room_data[$key]['total_room_price'] = $total_price;
                    // レート計算
                    if ($total_price > 0) {
                        $rate_a = round(($reserved_room_price / $total_price) * 100, 0);
                        $rate_b = round(($reserved_rv_price / $total_price) * 100, 0);
                    } else {
                        $rate_a = 0;
                        $rate_b = 0;
                    }
                    $room_data[$key]['rate_a'] = $rate_a;
                    $room_data[$key]['rate_b'] = $rate_b;

                    $all_rrp += $reserved_room_price;
                    $all_rvp += $reserved_rv_price;
                    $all_tp += $total_price;
                }// foreach room_data

                $reserved_room_list[$k]['room_data'] = $room_data;

                if ($all_tp > 0) {
                    $all_rate_a = round(($all_rrp / $all_tp) * 100, 0);
                    $all_rate_b = round(($all_rvp / $all_tp) * 100, 0);
                } else {
                    $all_rate_a = 0;
                    $all_rate_b = 0;
                }
                $reserved_room_list[$k]['all_rate_a'] = $all_rate_a;
                $reserved_room_list[$k]['all_rate_b'] = $all_rate_b;

                $date_start++;
                $month_loop++;
                if ($month_loop > 12) {
                    $month_loop = 1;
                    $year_loop++;
                    $date_start = $year_loop . sprintf("%02d", $month_loop);
                }
                $k++;
            }// while


            $this->set('reserved_room_list', $reserved_room_list);


// time_utilization_rates ///////////////////////////////////////////////////
        } elseif ($menu == "time_utilization_rates") {
            $this->set('title', '時間稼働率推移');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);

            if (is_null($_POST['hall_id']) or $_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "") {
                return 'success';
            }
            $this->set('hall_name', get_hall_name($_POST['hall_id']));

            $date_s = $_POST['year1'] . "年" . $_POST['month1'] . "月";
            $date_e = $_POST['year2'] . "年" . $_POST['month2'] . "月";
            $this->set('date_s', $date_s);
            $this->set('date_e', $date_e);

            $sql = "select * from a_hall where hall_id = " . $_POST['hall_id'];
            $hall_data = db_get_all($sql);
            $hall_data = $hall_data[0];

            $sql = "select * from a_room where hall_id = " . $_POST['hall_id'] . " and flag = 1";
            $room_data = db_get_all($sql);
            $this->set('room_data', $room_data);

            $hall_id = $_POST['hall_id'];

            // 営業時間
            $open_time = $hall_data['finish'] - $hall_data['begin'];

            $date_start = $_POST['year1'] . sprintf("%02d", $_POST['month1']);
            $date_end = $_POST['year2'] . sprintf("%02d", $_POST['month2']);

            $year_loop = $_POST['year1'];
            $month_loop = $_POST['month1'];

            $reserved_room_list = array();

            $k = 0;
            while ($date_start <= $date_end) {

                $all_rt = 0;
                $all_tt = 0;

                $reserved_room_list[$k]['date'] = $year_loop . "年" . sprintf("%02d", $month_loop) . "月";

                foreach ($room_data as $key => $value) {

                    $room_id = $value['room_id'];

                    // 分子

                    $date_s = $year_loop . "-" . $month_loop . "-01 00:00:00";

                    for ($x = 28; checkdate($month_loop, $x, $year_loop); $x++) {
                        $day = $x;
                    }

                    $date_e = $year_loop . "-" . $month_loop . "-" . $day . " 23:59:59";


                    // 利用時間
                    $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0 and tmp_flag = 0";
                    $reserved_time = db_get_all($sql);
                    $reserved_time = round($reserved_time[0]['reserved_time'], 0);
                    $room_data[$key]['reserved_time'] = $reserved_time;

                    // 分母
                    // 貸し出し可能金額
                    $total_time = 0;

                    $date_s = $year_loop . sprintf("%02d", $month_loop) . "01";
                    $date_e = $year_loop . sprintf("%02d", $month_loop) . sprintf("%02d", $day);
                    $year = $year_loop;
                    $month = $month_loop;
                    $day = 1;

                    while ($date_s <= $date_e) {
						$checkTime = checkDayHoliday($year, $month, $day);
                         if($checkTime == 1){
				        	if($hall_data['begin1'] != '' && $hall_data['finish1'] != '' )
				        	{
				        	 	$open_time = $hall_data['finish1'] - $hall_data['begin1'];
				        	}
				           
				        }
				        else if($checkTime == 2){
				            if($hall_data['begin2'] != '' && $hall_data['finish2'] != '' )
				        	{
				        		$open_time = $hall_data['finish2'] - $hall_data['begin2'];
				        	}
				         
				        }
				        else if($checkTime == 3){
				            if($hall_data['begin3'] != '' && $hall_data['finish3'] != '' )
				        	{
				        		$open_time = $hall_data['finish3'] - $hall_data['begin3'];
				        	}
				           
				        }
				        else if($checkTime == 4){
				        	if($hall_data['begin4'] != '' && $hall_data['finish4'] != '' )
				        	{
				        			$open_time = $hall_data['finish4'] - $hall_data['begin4'];
				        	}
				           
				     	    
				        }
                        //休日でなければ
                        if (!check_holiday($hall_id, $room_id, $year, $month, $day)) {

                            // 貸し止め確認
                            $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                            $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                            $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
                            $result = db_get_all($sql);
                            $stop = 0;
                            if(!empty($result)){
                                foreach ($result as $v) {
                                    $dt = new DateTime($v['begin_datetime']);
                                    $begin = $dt->format("H");
                                    $dt = new DateTime($v['finish_datetime']);
                                    $finish = $dt->format("H");
                                    $stop += $finish - $begin;
                                }
                            }
                            if ($stop) {
                                $total_time += $open_time - $stop;
                            } else {
                                $total_time += $open_time;
                            }
                        }


                        $date_s++;
                        $day++;
                        if (!checkdate($month, $day, $year)) {
                            $day = 1;
                            $month++;
                            if (!checkdate($month, $day, $year)) {
                                $month = 1;
                                $year++;
                            }
                            $date_s = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
                        }
                    }// while

                    $room_data[$key]['total_time'] = $total_time;
                    // レート計算
                    $reserved_time = isset($reserved_time) ? $reserved_time : 0;
                    $total_times = (isset($total_time) && $total_time > 0) ? $total_time : 1;

                    $rate_c = round(($reserved_time / $total_times) * 100, 0);

                    $room_data[$key]['rate_c'] = $rate_c;
                    $all_rt += $reserved_time;
                    $all_tt += $total_time;
                }// foreach room_data

                $reserved_room_list[$k]['room_data'] = $room_data;
                $all_tts = (isset($all_tt) && $all_tt > 0) ? $all_tt : 1;
                $all_rate_c = round(($all_rt / $all_tts) * 100, 0);

                $reserved_room_list[$k]['all_rate_c'] = $all_rate_c;

                $date_start++;
                $month_loop++;
                if ($month_loop > 12) {
                    $month_loop = 1;
                    $year_loop++;
                    $date_start = $year_loop . sprintf("%02d", $month_loop);
                }
                $k++;
            }// while


            $this->set('reserved_room_list', $reserved_room_list);


// time_utilization_rates //////////////////////
        } elseif ($menu == "analysis_at_reservation_period") {
            $this->set('title', '予約期間分析');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (is_null($_POST['hall_id']) or $_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

            $this->set('hall_name', get_hall_name($_POST['hall_id']));

            $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $hall_id = $_POST['hall_id'];

            // 部屋データ取得
            $sql = "select * from a_room where hall_id = $hall_id and flag = 1";
            $room_data = db_get_all($sql);

            foreach ($room_data as $key => $value) {
                $room_id = $value['room_id'];
                // 予約総数
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e'";
                $result = db_get_all($sql);
                $room_data[$key]['reserve'] = $result[0]['count_num'];

                // 最短期間
                $sql = "SELECT reserve_id, begin_datetime, finish_datetime, tmp_reserve_datetime, min(begin_datetime-tmp_reserve_datetime) as min_date FROM a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' group by reserve_id order by min_date;";
                $result = db_get_all($sql);
                if ($result) {
                    $target_reserve_id = $result[0]['reserve_id'];
                    $sql = "select * from a_reserve_list where reserve_id = $target_reserve_id";
                    $min_data = db_get_all($sql);
                    $min_data = $min_data[0];

                    $dt = new DateTime($min_data['tmp_reserve_datetime']);
                    $min_tmp = $dt->format("Ymd");
                    $dt = new DateTime($min_data['begin_datetime']);
                    $min_begin = $dt->format("Ymd");
                    $room_data[$key]['min'] = $min_begin - $min_tmp;
                } else {
                    $room_data[$key]['min'] = "--";
                }

                // 最長期間
                if ($result) {
                    $c = (count($result) - 1);
                    $target_reserve_id = $result[$c]['reserve_id'];
                    $sql = "select * from a_reserve_list where reserve_id = $target_reserve_id";
                    $max_data = db_get_all($sql);
                    $max_data = $max_data[0];

                    $dt = new DateTime($max_data['tmp_reserve_datetime']);
                    $max_tmp = $dt->format("Ymd");
                    $dt = new DateTime($max_data['begin_datetime']);
                    $max_begin = $dt->format("Ymd");
                    $room_data[$key]['max'] = $max_begin - $max_tmp;
                } else {
                    $room_data[$key]['max'] = "--";
                }

                // 平均
                $days = 0;
                if ($result) {
                    foreach ($result as $value) {
                        $dt = new DateTime($value['tmp_reserve_datetime']);
                        $average_tmp = $dt->format("Ymd");
                        $dt = new DateTime($value['begin_datetime']);
                        $average_begin = $dt->format("Ymd");
                        $days += $average_begin - $average_tmp;
                    }
                    $c = count($result);
                    $room_data[$key]['average'] = round(($days / $c), 0);
                } else {
                    $room_data[$key]['average'] = "--";
                }
            }// foreach room_data

            $this->set('room_data', $room_data);

// analysis_at_reservation_period ///////////////////////////
        } elseif ($menu == "user_analysis") {
            $this->set('title', '利用者分析（用途）');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (is_null($_POST['hall_id']) or $_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

            $this->set('hall_name', get_hall_name($_POST['hall_id']));

            $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $hall_id = $_POST['hall_id'];

            // 部屋データ取得
            $sql = "select * from a_room where hall_id = $hall_id and flag = 1";
            $room_data = db_get_all($sql);

            foreach ($room_data as $key => $value) {
                $room_id = $value['room_id'];

                // 利用数
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e'";
                $result = db_get_all($sql);
                $room_data[$key]['reserve'] = $result[0]['count_num'];

                // 会議
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 1";
                $result = db_get_all($sql);
                $room_data[$key]['conference'] = $result[0]['count_num'];

                // セミナー
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 2";
                $result = db_get_all($sql);
                $room_data[$key]['seminar'] = $result[0]['count_num'];

                // 研修
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 3";
                $result = db_get_all($sql);
                $room_data[$key]['training'] = $result[0]['count_num'];

                // 面接・試験
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 4";
                $result = db_get_all($sql);
                $room_data[$key]['interview'] = $result[0]['count_num'];

                // 懇談会・パーティ
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 5";
                $result = db_get_all($sql);
                $room_data[$key]['party'] = $result[0]['count_num'];

                // その他
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 6";
                $result = db_get_all($sql);
                $room_data[$key]['etc'] = $result[0]['count_num'];

                // 未選択
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = $hall_id and room_id = $room_id and cancel_flag = 0 and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and purpose = 0";
                $result = db_get_all($sql);
                $room_data[$key]['no_data'] = $result[0]['count_num'];
            }// foreach room_data


            $this->set('room_data', $room_data);


// user_analysis //////////////////////////////////////////////////
        } elseif ($menu == "repetition_order") {
            $this->set('title', 'リピート率順位');
             // set_time_limit(0);

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if ($_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

// 順位テーブル削除
            $sql = "delete from a_repetition_order";
            db_get_all($sql);

            $total_table = Array();
            $count_table = Array();
            foreach ($hall_list as $k => $v) {
                $hall_id = $v['hall_id'];

                // 期間内の予約総数(キャンセルされていない仮予約期間)
                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

                $sql = "select count(*) as all_num from a_reserve_list where ";
                $sql.= "hall_id = " . $hall_id . " ";
                $sql.= "and begin_datetime >= '$date_s' ";
                $sql.= "and begin_datetime <= '$date_e' ";
                $total = db_get_all($sql);
                $total = $total[0]['all_num'];

                $this->set('total', $total);


                // 期間内の予約で1度完了している予約
                $sql = "select * from a_reserve_list where ";
                $sql.= "hall_id = " . $hall_id . " ";
//  $sql.= "and tmp_reserve_datetime >= '$date_s' ";
//  $sql.= "and tmp_reserve_datetime <= '$date_e' ";
                $sql.= "and begin_datetime >= '$date_s' ";
                $sql.= "and begin_datetime <= '$date_e' ";
//  $sql.= "and complete_flag = 1 ";
                $comp_list = db_get_all($sql);

                $repeat_count = 0;
                $rate = 0;
                if ($comp_list) {
                    foreach ($comp_list as $key => $value) {
                        $sql = "select count(*) from a_reserve_list where ";
                        $sql.= "hall_id = " . $hall_id . " ";
//          $sql.= "and tmp_reserve_datetime >= '$date_s' ";
//          $sql.= "and tmp_reserve_datetime <= '$date_e' ";
                        $sql.= "and begin_datetime >= '$date_s' ";
                        $sql.= "and begin_datetime <= '$date_e' ";
//          $sql.= "and complete_flag = 1 ";
                        $sql.= "and c_member_id = " . $value['c_member_id'] . " ";
                        $sql.= "and reserve_id != " . $value['reserve_id'] . " ";

                        $result = db_get_all($sql);
                        if ($result[0]["count(*)"]) {
                            $repeat_count++;
                        }
                    }
                    $rate = round(($repeat_count / $total) * 100, 0);
                }

                // データベースに登録
                $sql = "insert into a_repetition_order (hall_id, hall_name, repeat_rate) values ($hall_id, '" . $v['hall_name'] . "', $rate)";
                db_get_all($sql);
                $total_table[$hall_id] = $total;
                $count_table[$hall_id] = $repeat_count;
            }// foreach hall_list
            // 順位順にソートして読み込み
            $sql = "SELECT * FROM a_repetition_order order by repeat_rate desc";
            $order_list = db_get_all($sql);
            foreach ($order_list as $k => $i) {
                $order_list[$k]['total'] = $total_table[$i['hall_id']];
                $order_list[$k]['count'] = $count_table[$i['hall_id']];
            }
            $this->set('order_list', $order_list);

            return 'success';

// utilization_rates_order //////////////////////////////////////////
        } elseif ($menu == "utilization_rates_order") {
//  set_time_limit(0);
            $this->set('title', '会場稼働率順位');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (!empty($_POST['mode'])) {
                $mode = $_POST['mode'];
            } else {
                $mode = 0;
            }
            $this->set('mode', $mode);

            if ($_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

// データベース削除
            $sql = "delete from a_utilization_rates";
            db_get_all($sql);

            foreach ($hall_list as $hl_key => $hl_value) {
                $hall_id = $hl_value['hall_id'];
//  echo $hl_value['hall_name']."<br>"; //---

                $sql = "select * from a_room where hall_id = $hall_id and flag = 1";
                $room_data = db_get_all($sql);

                // 営業時間
                $open_time = $hl_value['finish'] - $hl_value['begin'];

                $all_rrp = 0;
                $all_rvp = 0;
                $all_rt = 0;
                $all_tp = 0;
                $all_tt = 0;

                foreach ($room_data as $key => $value) {

                    $room_id = $value['room_id'];

// 分子

                    $reserved_room_price = 0;
                    $reserved_rv_price = 0;


                    $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                    $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

                    // 利用金額（オプションなし）
                    $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_room_price = db_get_all($sql);
                    $reserved_room_price = $reserved_room_price[0]['room_price'];
                    $room_data[$key]['reserved_room_price'] = $reserved_room_price;
//  echo $reserved_room_price."<br>";   //---
                    // 利用金額（オプションあり）
                    $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_rv_price = db_get_all($sql);
                    $reserved_rv_price = $reserved_rv_price[0]['room_price'];
                    $room_data[$key]['reserved_rv_price'] = $reserved_rv_price;
//  echo $reserved_rv_price."<br>"; //---
                    // 利用時間
                    $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_time = db_get_all($sql);
                    $reserved_time = round($reserved_time[0]['reserved_time'], 0);
                    $room_data[$key]['reserved_time'] = $reserved_time;
//  echo $reserved_time."<br>"; //---
// 分母
                    // 貸し出し可能金額
                    $total_time = 0;

                    $date_s = $_POST['year1'] . sprintf("%02d", $_POST['month1']) . sprintf("%02d", $_POST['day1']);
                    $date_e = $_POST['year2'] . sprintf("%02d", $_POST['month2']) . sprintf("%02d", $_POST['day2']);
                    $year = $_POST['year1'];
                    $month = $_POST['month1'];
                    $day = $_POST['day1'];

                    // 1時間当たりの部屋利用料金
                    if ($value['type'] == 2) {
                        if ($value['koma'] == 0.25) {
                            $room_price = $value['k_lowest_price'] * 4;
                        } elseif ($value['koma'] == 0.5) {
                            $room_price = $value['k_lowest_price'] * 2;
                        } elseif ($value['koma'] == 1) {
                            $room_price = $value['k_lowest_price'];
                        } elseif ($value['koma'] > 1) {
                            $room_price = round($value['k_lowest_price'] / $value['koma'], 0);
                        }
                    } else {
                        $sql = "SELECT max(price) as price FROM a_room_pack where hall_id = $hall_id and room_id = $room_id";
                        $room_price = db_get_all($sql);
                        $room_price[0]['price'] = isset($room_price[0]['price']) ? $room_price[0]['price'] : 0;
                        $open_times = (isset($open_time) && $open_time > 0) ? $open_time : 1;
                        $room_price = round($room_price[0]['price'] / $open_times, 0);
//      $room_price = $room_price[0]['price'];
                    }
//  echo "room_price@ ".$room_price."<br>"; //---

                    while ($date_s <= $date_e) {

//休日でなければ
                        if (!check_holiday($hall_id, $room_id, $year, $month, $day)) {

                            // 貸し止め確認
                            $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                            $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                            $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
                            $result = db_get_all($sql);
                            $stop = 0;
                            if(!empty($result)){
                                foreach ($result as $v) {
                                    $dt = new DateTime($v['begin_datetime']);
                                    $begin = $dt->format("H");
                                    $dt = new DateTime($v['finish_datetime']);
                                    $finish = $dt->format("H");
                                    $stop += $finish - $begin;
                                }
                            }
                            if ($stop) {
                                $total_time += $open_time - $stop;
                            } else {
                                $total_time += $open_time;
                            }
                        }


                        $date_s++;
                        $day++;
                        if (!checkdate($month, $day, $year)) {
                            $day = 1;
                            $month++;
                            if (!checkdate($month, $day, $year)) {
                                $month = 1;
                                $year++;
                            }
                            $date_s = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
                        }
                    }// while

                    $total_price = $room_price * $total_time;
//  echo "total price,time ".$total_price." ".$total_time."<br>";   //---

                    $all_rrp += $reserved_room_price;
                    $all_rvp += $reserved_rv_price;
                    $all_rt += $reserved_time;
                    $all_tp += $total_price;
                    $all_tt += $total_time;
                }// foreach room_data


                if ($all_tp > 0) {
                    $all_rate_a = round(($all_rrp / $all_tp) * 100, 0);
                    $all_rate_b = round(($all_rvp / $all_tp) * 100, 0);
                } else {
                    $all_rate_a = 0;
                    $all_rate_b = 0;
                }
                $all_rt = isset($all_rt) ? $all_rt : 0;
                $all_tts = (isset($all_tt) && $all_tt > 0) ? $all_tt : 1;
                $all_rate_c = round(($all_rt / $all_tts) * 100, 0);

                // データベース登録
                $sql = "insert into a_utilization_rates (hall_id, hall_name, rate_a, rate_b, rate_c) values ($hall_id, '" . $hl_value['hall_name'] . "', $all_rate_a, $all_rate_b, $all_rate_c)";
                db_get_all($sql);
            }// foreach hall_list
            // 順位順に取得
            $sql = "select * from a_utilization_rates ";
            if ($mode == 0) {
                $sql.= "order by rate_a desc";
            } elseif ($mode == 1) {
                $sql.= "order by rate_b desc";
            } elseif ($mode == 2) {
                $sql.= "order by rate_c desc";
            }
            $order_list = db_get_all($sql);

            $this->set('order_list', $order_list);

// utilization_rates_order /////////////////////////////////////////////
        } elseif ($menu == "room_utilization_rates_order") {
//  set_time_limit(0);
            $this->set('title', '部屋稼働率順位');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (!empty($_POST['mode'])) {
                $mode = $_POST['mode'];
            } else {
                $mode = 0;
            }
            $this->set('mode', $mode);

            if ($_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

// データベース削除
            $sql = "delete from a_room_utilization_rates";
            db_get_all($sql);

            foreach ($hall_list as $hl_key => $hl_value) {
                $hall_id = $hl_value['hall_id'];

                $sql = "select * from a_room where hall_id = $hall_id and flag = 1";
                $room_data = db_get_all($sql);

                // 営業時間
                $open_time = $hl_value['finish'] - $hl_value['begin'];

                foreach ($room_data as $key => $value) {

                    $room_id = $value['room_id'];

// 分子

                    $reserved_room_price = 0;
                    $reserved_rv_price = 0;


                    $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                    $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

                    // 利用金額（オプションなし）
                    $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(room_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_room_price = db_get_all($sql);
                    $reserved_room_price = $reserved_room_price[0]['room_price'];
                    $room_data[$key]['reserved_room_price'] = $reserved_room_price;

                    // 利用金額（オプションあり）
                    $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(room_price)+sum(vessel_price) as room_price from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_rv_price = db_get_all($sql);
                    $reserved_rv_price = $reserved_rv_price[0]['room_price'];
                    $room_data[$key]['reserved_rv_price'] = $reserved_rv_price;

                    // 利用時間
                    $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and tmp_reserve_datetime >= '$date_s' and tmp_reserve_datetime <= '$date_e' and cancel_flag = 0";
//  $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date_s' and begin_datetime <= '$date_e' and cancel_flag = 0";
                    $reserved_time = db_get_all($sql);
                    $reserved_time = round($reserved_time[0]['reserved_time'], 0);
                    $room_data[$key]['reserved_time'] = $reserved_time;


// 分母
                    // 貸し出し可能金額
                    $total_time = 0;

                    $date_s = $_POST['year1'] . sprintf("%02d", $_POST['month1']) . sprintf("%02d", $_POST['day1']);
                    $date_e = $_POST['year2'] . sprintf("%02d", $_POST['month2']) . sprintf("%02d", $_POST['day2']);
                    $year = $_POST['year1'];
                    $month = $_POST['month1'];
                    $day = $_POST['day1'];

                    // 1時間当たりの部屋利用料金
                    if ($value['type'] == 2) {
                        if ($value['koma'] == 0.25) {
                            $room_price = $value['k_lowest_price'] * 4;
                        } elseif ($value['koma'] == 0.5) {
                            $room_price = $value['k_lowest_price'] * 2;
                        } elseif ($value['koma'] == 1) {
                            $room_price = $value['k_lowest_price'];
                        } elseif ($value['koma'] > 1) {
                            $room_price = round($value['k_lowest_price'] / $value['koma'], 0);
                        }
                    } else {
                        $sql = "SELECT max(price) as price FROM a_room_pack where hall_id = $hall_id and room_id = $room_id";
                        $room_price = db_get_all($sql);
                        $room_price[0]['price'] = isset($room_price[0]['price']) ? $room_price[0]['price'] : 0;
                        $open_times = (isset($open_time) && $open_time > 0) ? $open_time : 1;
                        $room_price = round($room_price[0]['price'] / $open_times, 0);
//      $room_price = $room_price[0]['price'];  
                    }

                    while ($date_s <= $date_e) {
							$checkTime = checkDayHoliday($year, $month, $day);
                         if($checkTime == 1){
				        	if($hl_value['begin1'] != '' && $hl_value['finish1'] != '' )
				        	{
				        	 	$open_time = $hl_value['finish1'] - $hl_value['begin1'];
				        	}
				           
				        }
				        else if($checkTime == 2){
				            if($hl_value['begin2'] != '' && $hl_value['finish2'] != '' )
				        	{
				        		$open_time = $hl_value['finish2'] - $hl_value['begin2'];
				        	}
				         
				        }
				        else if($checkTime == 3){
				            if($hl_value['begin3'] != '' && $hl_value['finish3'] != '' )
				        	{
				        		$open_time = $hl_value['finish3'] - $hl_value['begin3'];
				        	}
				           
				        }
				        else if($checkTime == 4){
				        	if($hl_value['begin4'] != '' && $hl_value['finish4'] != '' )
				        	{
				        			$open_time = $hl_value['finish4'] - $hl_value['begin4'];
				        	}
				           
				     	    
				        }
//休日でなければ
                        if (!check_holiday($hall_id, $room_id, $year, $month, $day)) {

                            // 貸し止め確認
                            $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                            $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                            $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = $room_id and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
                            $result = db_get_all($sql);
                            $stop = 0;
                            foreach ($result as $v) {
                                $dt = new DateTime($v['begin_datetime']);
                                $begin = $dt->format("H");
                                $dt = new DateTime($v['finish_datetime']);
                                $finish = $dt->format("H");
                                $stop += $finish - $begin;
                            }
                            if ($stop) {
                                $total_time += $open_time - $stop;
                            } else {
                                $total_time += $open_time;
                            }
                        }


                        $date_s++;
                        $day++;
                        if (!checkdate($month, $day, $year)) {
                            $day = 1;
                            $month++;
                            if (!checkdate($month, $day, $year)) {
                                $month = 1;
                                $year++;
                            }
                            $date_s = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
                        }
                    }// while
                    $total_price = $room_price * $total_time;

                    // レート計算
                    if ($total_price > 0) {
                        $rate_a = round(($reserved_room_price / $total_price) * 100, 0);
                        $rate_b = round(($reserved_rv_price / $total_price) * 100, 0);
                    } else {
                        $rate_a = 0;
                        $rate_b = 0;
                    }
                    $rate_c = ($total_time == 0) ? 0 : round(($reserved_time / $total_time) * 100, 0);

                    // データベース登録
                    $sql = "insert into a_room_utilization_rates (hall_id, room_id, hall_name, room_name, rate_a, rate_b, rate_c) values ($hall_id, " . $value['room_id'] . ", '" . $hl_value['hall_name'] . "', '" . $value['room_name'] . "', $rate_a, $rate_b, $rate_c)";
                    db_get_all($sql);
                }// foreach room_data
            }// foreach hall_list
            // 順位順に取得
            $sql = "select * from a_room_utilization_rates ";
            if ($mode == 0) {
                $sql.= "order by rate_a desc";
            } elseif ($mode == 1) {
                $sql.= "order by rate_b desc";
            } elseif ($mode == 2) {
                $sql.= "order by rate_c desc";
            }
            $order_list = db_get_all($sql);

            $this->set('order_list', $order_list);

// room_utilization_rates_order /////////////////////////////////////////////
        } elseif ($menu == "unpayment_list") {
            $this->set('title', '未入金リスト');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);
            //var_dump($hall_list);

            $this->set('hall_list', $hall_list);

            $hall_names = Array();
            $hall_order = Array();
            $a = 0;
            foreach ($hall_list as $i) {
                $hall_names[$i["hall_id"]] = $i["hall_name"];
                $hall_order[$i["hall_id"]] = $a++;
            }
            $this->set('hall_names', $hall_names);

            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year'] = isset($_POST['year']) ? $_POST['year'] : null;
            $_POST['month'] = isset($_POST['month']) ? $_POST['month'] : null;
            $_POST['day'] = isset($_POST['day']) ? $_POST['day'] : null;
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year', $_POST['year']);
            $this->set('month', $_POST['month']);
            $this->set('day', $_POST['day']);

            $hall_id = $_POST['hall_id'];
            $year = $_POST['year'];
            $month = $_POST['month'];
            $day = $_POST['day'];

            if ($hall_id == 0) {
                $this->set('hall_name', "全会場");
            } else {
                $this->set('hall_name', get_hall_name($hall_id));
            }

            $sql = "select * from a_reserve_list where cancel_flag = 0 ";
            $sql.= "and tmp_flag = 0 ";
            $sql.= "and pay_flag = 0 AND total_price > pay_money ";
            if ($hall_id > 0) {
                $sql.= "and hall_id = $hall_id ";
            }
            if ($year and $month and $day) {
                $date_s = $year . "-" . $month . "-" . $day . " 00:00:00";
                $date_e = $year . "-" . $month . "-" . $day . " 23:59:59";
                $sql.= "and pay_limitdate >= '$date_s' ";
                $sql.= "and pay_limitdate <= '$date_e' ";
            } else {
                $sql.= "and pay_limitdate < now() ";
            }

//  $sql.= "order by pay_limitdate";
            $sql.= "order by hall_id";
            $reserve_data = db_get_all($sql);           
            foreach ($reserve_data as $key => $value) {
                $dt = new DateTime($value['pay_limitdate']);
                $reserve_data[$key]['pay_limitdate'] = $dt->format("Y年m月d日");
                $reserve_data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
                $reserve_data[$key]['total_price'] = number_format($value['total_price']);
                $reserve_data[$key]['pay_money'] = number_format($value['pay_money']);
                $reserve_data[$key]['unpayment'] = number_format($value['total_price'] - $value['pay_money']);
                $reserve_data[$key]['order'] = isset($hall_order[$value['hall_id']]) ? $hall_order[$value['hall_id']] : null;

                $s = mktime(0, 0, 0, $dt->format("m"), $dt->format("d"), $dt->format("Y")) - mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                $reserve_data[$key]['over_days'] = ($s / 60 / 60 / 24) * -1;
            }

//  echo "b<br>";
//  var_dump($reserve_data);
            uasort($reserve_data, "hallcmp");
//  echo "a<br>";
//  var_dump($reserve_data);



            $this->set('reserve_data', $reserve_data);


// unpayment_list ////////////////////////////////////////////////////////
        } 
        elseif ($menu == "cancelpayment_list") {
            $this->set('title', 'キャンセル料未入金リスト');
            $sql = "select * from a_hall where flag = 0 order by pulldown desc";           
            $hall_list = db_get_all($sql);
            $this->set('hall_list', $hall_list);
            $hall_names = Array();
            $hall_order = Array();
            $a = 0;
            foreach ($hall_list as $i) {
                $hall_names[$i["hall_id"]] = $i["hall_name"];
                $hall_order[$i["hall_id"]] = $a++;
            }
            $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : null;
            $_POST['year'] = isset($_POST['year']) ? $_POST['year'] : null;
            $_POST['month'] = isset($_POST['month']) ? $_POST['month'] : null;
            $_POST['day'] = isset($_POST['day']) ? $_POST['day'] : null;
            $this->set('hall_names', $hall_names);
            $this->set('hall_id', $_POST['hall_id']);
            $this->set('year', $_POST['year']);
            $this->set('month', $_POST['month']);
            $this->set('day', $_POST['day']);
            $reserve_data = array();

            if(isset($_POST['ok'])){
                $hall_id = $_POST['hall_id'];
                $yearto = $_POST['yearto'];
                $monthto = $_POST['monthto'];
                $dayto = $_POST['dayto'];
                $yearfrom = $_POST['yearfrom'];
                $monthfrom = $_POST['monthfrom'];
                $dayfrom = $_POST['dayfrom'];
                if ($hall_id == 0) {
                    $this->set('hall_name', "全会場");
                } else {
                    $this->set('hall_name', get_hall_name($hall_id));
                }
                $sql = "select * from a_reserve_list where cancel_flag = 1 and pay_flag = 0 and tmp_flag = 0 ";

                if ($hall_id > 0) {
                    $sql.= "and hall_id = $hall_id ";
                }
                if ($yearto && $monthto && $dayto && $yearfrom && $monthfrom && $dayfrom) {
                    $date_s = $yearto . "-" . $monthto . "-" . $dayto . " 00:00:00";
                    $date_e = $yearfrom . "-" . $monthfrom . "-" . $dayfrom . " 23:59:59";
                    $sql.= "and begin_datetime >= '$date_s' ";
                    $sql.= "and finish_datetime <= '$date_e' ";
                }  
                $sql.= "order by hall_id";   
                $reserve_data = db_get_all($sql);           
                foreach ($reserve_data as $key => $value){
                    $dt = new DateTime($value['pay_limitdate']);
                    $reserve_data[$key]['pay_limitdate'] = $dt->format("Y年m月d日");                    
                    $reserve_data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
                    $list = get_cancel_list($reserve_data[$key]['reserve_id']);   
                    $percent = $list['percent']*0.01;  
                    $room_price = round($value['room_price']*$percent);
                    $vessel_price = round($value['vessel_price']*$percent);
                    $service_price = round($value['service_price']*$percent);       
                    // キャンセル料
                    $reserve_data[$key]['percent'] = $percent;
                    $reserve_data[$key]['cancel_price'] = round(($room_price+$vessel_price+$service_price));                   
                    $reserve_data[$key]['cash_balance'] = abs($reserve_data[$key]['cancel_price'] - $reserve_data[$key]['pay_money']);                                  
                    $reserve_data[$key]['order'] = isset($hall_order[$value['hall_id']]) ? $hall_order[$value['hall_id']] : '';
                    if($value['pay_limitdate'] !='0000-00-00 00:00:00')
                    {
                        $s = mktime(0, 0, 0, $dt->format("m"), $dt->format("d"), $dt->format("Y")) - mktime(0, 0, 0, date("m"), date("d"), date("Y"));
                        $reserve_data[$key]['over_days'] =round(($s / 60 / 60 / 24) * -1);                                      
                  
                    }
                    else{
                        $reserve_data[$key]['over_days'] = '';
                    }
                    $sql = "select * from a_repayment_list where reserve_id = ".$value['reserve_id']." order by repayment_id desc";
                    $repay_data = db_get_all($sql);
                    $reserve_data[$key]['repay_data'] = isset($repay_data[0]) ? $repay_data[0] : null;
                    $sql = "select * from a_amount_billed where reserve_id = ".$value['reserve_id'];
                    $ab_data = db_get_all($sql);
                    if(!empty($ab_data))
                    {
                        $reserve_data[$key]['ab_data'] = $ab_data[0];
                        $reserve_data[$key]['cash_balance'] = abs($ab_data[0]['total_billed_money'] - $ab_data[0]['pay_money']);                                  
                        
                    }
                    
        
                }           
            uasort($reserve_data, "hallcmp");
            }
            $yearto = isset($yearto) ? $yearto : null;
            $monthto = isset($monthto) ? $monthto : null;
            $dayto = isset($dayto) ? $dayto : null;
            $yearfrom = isset($yearfrom) ? $yearfrom : null;
            $monthfrom = isset($monthfrom) ? $monthfrom : null;
            $dayfrom = isset($dayfrom) ? $dayfrom : null;
            $this->set('reserve_data', $reserve_data);
            $this->set('yearto', $yearto);
            $this->set('monthto', $monthto);
            $this->set('dayto', $dayto);
            $this->set('yearfrom', $yearfrom);
            $this->set('monthfrom', $monthfrom);
            $this->set('dayfrom', $dayfrom);
        } 
        elseif ($menu == "sales_expectation") {
            $this->set('title', '売上見込表');

            $year = isset($_POST['year']) ? $_POST['year'] : null;
            $month = isset($_POST['month']) ? $_POST['month'] : null;

            $check_year = isset($_POST['check_year']) ? $_POST['check_year'] : null;
            $check_month = isset($_POST['check_month']) ? $_POST['check_month'] : null;
            $check_day = isset($_POST['check_day']) ? $_POST['check_day'] : null;

            $this->set('year', $year);
            $this->set('month', $month);
            $this->set('check_year', $check_year);
            $this->set('check_month', $check_month);
            $this->set('check_day', $check_day);

            if ($year == "" or $month == "" or $check_year == "" or $check_month == "" or $check_day == "") {
                return 'success';
            }

            $month_x = $month;
            for ($x = 1; $x <= 3; $x++) {
                $month_x++;
                if ($month_x >= 13) {
                    $month_x = 1;
                }
                if ($x == 1) {
                    $month_2 = $month_x;
                    $this->set('month_2', $month_2);
                } elseif ($x == 2) {
                    $month_3 = $month_x;
                    $this->set('month_3', $month_3);
                } elseif ($x == 3) {
                    $month_4 = $month_x;
                    $this->set('month_4', $month_4);
                }
            }
            $hall_list = array();
            $sql = "select * from a_hall where flag = 0 order by pulldown desc"; //hall_attribute desc";
            $hall_list = db_get_all($sql);

            $date_s1 = $year . "-" . $month . "-01 00:00:00";
            $date_e1 = $check_year . "-" . $check_month . "-" . $check_day . " 23:59:59";
            $date_s2 = $check_year . "-" . $check_month . "-" . ($check_day + 1) . " 00:00:00";
            
            for ($x = 28; checkdate($check_month, $x, $check_year); $x++) {
                $day = $x;
            }
            $date_e2 = $check_year . "-" . $check_month . "-" . $day . " 23:59:59";

/// 2013.12.21 消費税改定対応 begin

            $sql = "select rate from a_tax where stadate <= '2014-03-31 00:00:00' ";

/// 2013.12.21 消費税改定対応 end
            global $db;
            $tax_rate = db_get_all($sql, $db);
            $tax_rate = ($tax_rate[0]['rate'] * 0.01) + 1;

            foreach ($hall_list as $key => $value) {
                $hall_id = $value['hall_id'];
                // 当月利用金額
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and cancel_flag = 0 ";
                $sql.= "and begin_datetime >= '$date_s1' ";
                $sql.= "and begin_datetime <= '$date_e1' ";

                $reserve_data1 = db_get_all($sql);

                $total_room_price1 = 0;
                $total_vessel_price1 = 0;

                foreach ($reserve_data1 as $v) {
                    $total_room_price1 += $v['room_price'];
                    $total_vessel_price1 += $v['vessel_price'];
                }

                // 税抜き
                $total_room_price1 = $total_room_price1 / $tax_rate;
                $total_vessel_price1 = $total_vessel_price1 / $tax_rate;

                $hall_list[$key]['total_room_price1'] = number_format($total_room_price1);
                $hall_list[$key]['total_vessel_price1'] = number_format($total_vessel_price1);

                // 当月利用予定金額
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and cancel_flag = 0 ";
                $sql.= "and begin_datetime >= '$date_s2' ";
                $sql.= "and begin_datetime <= '$date_e2' ";

                $reserve_data2 = db_get_all($sql);

                $total_room_price2 = 0;
                $total_vessel_price2 = 0;

                foreach ($reserve_data2 as $v) {
                    $total_room_price2 += $v['room_price'];
                    $total_vessel_price2 += $v['vessel_price'];
                }

                // 税抜き
                $total_room_price2 = $total_room_price2 / $tax_rate;
                $total_vessel_price2 = $total_vessel_price2 / $tax_rate;

                $hall_list[$key]['total_room_price2'] = number_format($total_room_price2);
                $hall_list[$key]['total_vessel_price2'] = number_format($total_vessel_price2);

                $month_x = $month;
                $year_x = $year;
                for ($y = 1; $y <= 3; $y++) {
                    $month_x++;
                    if ($month_x >= 13) {
                        $month_x = 1;
                        $year_x++;
                    }
                    $date_s = $year_x . "-" . $month_x . "-01 00:00:00";
                    for ($x = 28; checkdate($month_x, $x, $year_x); $x++) {
                        $day = $x;
                    }
                    $date_e = $year_x . "-" . $month_x . "-" . $day . " 23:59:59";

                    // 当月利用予定金額
                    $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                    $sql.= "and cancel_flag = 0 ";
                    $sql.= "and begin_datetime >= '$date_s' ";
                    $sql.= "and begin_datetime <= '$date_e' ";

                    $reserve_data = db_get_all($sql);

                    $total_room_price = 0;
                    $total_vessel_price = 0;

                    foreach ($reserve_data as $v) {
                        $total_room_price += $v['room_price'];
                        $total_vessel_price += $v['vessel_price'];
                    }

                    // 税抜き
                    $total_room_price = $total_room_price / $tax_rate;
                    $total_vessel_price = $total_vessel_price / $tax_rate;

                    $hall_list[$key]['total_room_price' . ($y + 2)] = number_format($total_room_price);
                    $hall_list[$key]['total_vessel_price' . ($y + 2)] = number_format($total_vessel_price);
                }// for
            }// foreach hall_list

            $this->set('hall_list', $hall_list);



// sales_expectation ///////////////////////////////////////////////////////
        } elseif ($menu == "customer_use_state") {
            $this->set('title', '顧客利用状況');

            if (isset($_POST['c_member_id']) && preg_match("/^[0-9]+$/", $_POST['c_member_id'])) {
                $u = $_POST['c_member_id'];
                $this->set('c_member_id', $u);
            } elseif (!empty($_POST['nickname'])) {
                $nickname = $_POST['nickname'];
                $this->set('nickname', $nickname);

                $sql = "select * from c_member where nickname = '$nickname'";
                $c_member = db_get_all($sql);
                $c_member = $c_member[0];

                $u = $c_member['c_member_id'];
            } elseif (!empty($_POST['corp'])) {
                $corp = $_POST['corp'];
                $this->set('corp', $corp);

                $sql = "select * from c_member_profile where value = '$corp'";
                $c_member_prof = db_get_all($sql);
                $u = $c_member_prof[0]['c_member_id'];
            }

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            // if (!$u) {
            if (empty($u)) {
                return 'success';
            }
            $this->set('u', $u);

            $sql = "select * from c_member where c_member_id = $u";
            $c_member = db_get_all($sql);
            $c_member = $c_member[0];
            $c_member['corp'] = get_profile_value($u, 12);
            $c_member['tel'] = get_profile_value($u, 17);
            $c_member['fax'] = get_profile_value($u, 18);
            $c_member['address'] = get_profile_value($u, 3) . get_profile_value($u, 14) . get_profile_value($u, 15) . get_profile_value($u, 16);

            $this->set('c_member', $c_member);


            $sql = "select * from a_reserve_list where c_member_id = $u ";
            $sql.= "and cancel_flag = 0 ";
            if ($_POST['year1'] and $_POST['month1'] and $_POST['day1'] and $_POST['year2'] and $_POST['month2'] and $_POST['day2']) {
                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

                $sql.= "and begin_datetime >= '$date_s' ";
                $sql.= "and begin_datetime <= '$date_e' ";
            }
            $reserve_data = db_get_all($sql);
            $total_time = 0;
            foreach ($reserve_data as $key => $value) {
                $reserve_data[$key]['hall_name'] = get_hall_name($value['hall_id']);
                $reserve_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);

                $dt = new DateTime($value['begin_datetime']);
                $reserve_data[$key]['date'] = $dt->format("Y/m/d");
                $time = $dt->format("H:i ～ ");
                $time_s = ($dt->format("H") * 60) + $dt->format("i");
                $dt = new DateTime($value['finish_datetime']);
                $time.= $dt->format("H:i");
                $time_e = ($dt->format("H") * 60) + $dt->format("i");
                $reserve_data[$key]['time'] = $time;

                $time = ($time_e - $time_s) / 60;
                $reserve_data[$key]['between_time'] = $time;
                $total_time += $time;

                $reserve_data[$key]['purpose'] = get_purpose_word($value['purpose']);
            }
            $this->set('total_time', $total_time);
            $this->set('reserve_data', $reserve_data);


// customer_use_state ////////////////////////////////////////////
        } elseif ($menu == "news_flash") {
            $this->set('title', '予約・売上速報');
            // set_time_limit(0);
            $year = isset($_POST['year']) ? $_POST['year'] : null;
            $month = isset($_POST['month']) ? $_POST['month'] : null;

            $check_year = isset($_POST['check_year']) ? $_POST['check_year'] : null;
            $check_month = isset($_POST['check_month']) ? $_POST['check_month'] : null;
            $check_day = isset($_POST['check_day']) ? $_POST['check_day'] : null;

            $this->set('year', $year);
            $this->set('month', $month);
            $this->set('check_year', $check_year);
            $this->set('check_month', $check_month);
            $this->set('check_day', $check_day);


            if ($year == "" or $month == "" or $check_year == "" or $check_month == "" or $check_day == "") {
                return 'success';
            }

// 1日以外なら前日へ
            if ($check_day > 1) {
                $check_day--;
            }

            $month_x = $month;
            for ($x = 1; $x <= 3; $x++) {
                $month_x++;
                if ($month_x >= 13) {
                    $month_x = 1;
                }
                if ($x == 1) {
                    $month_2 = $month_x;
                    $this->set('month_2', $month_2);
                } elseif ($x == 2) {
                    $month_3 = $month_x;
                    $this->set('month_3', $month_3);
                } elseif ($x == 3) {
                    $month_4 = $month_x;
                    $this->set('month_4', $month_4);
                }
            }

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
//hall_attribute";
            $hall_list = db_get_all($sql);

            $date_s1 = $check_year . "-" . $check_month . "-" . $check_day . " 00:00:00";
            $date_e1 = $check_year . "-" . $check_month . "-" . $check_day . " 23:59:59";
            $date_s2 = $year . "-" . $month . "-01 00:00:00";
            for ($x = 28; checkdate($check_month, $x, $check_year); $x++) {
                $day = $x;
            }
            $date_e2 = $check_year . "-" . $check_month . "-" . $day . " 23:59:59";

/// 2013.12.21 消費税改定対応 begin

            $sql = "select rate from a_tax where stadate <= '2014-03-31 00:00:00' ";

/// 2013.12.21 消費税改定対応 end
            global $db;
            $tax_rate = db_get_all($sql, $db);            
            $tax_rate = ($tax_rate[0]['rate'] * 0.01) + 1;

            // 昨日予約件数
            $sql = "select count(*) as count_num from a_reserve_list where ";
            $sql.= "tmp_reserve_datetime >= '$date_s1' ";
            $sql.= "and tmp_reserve_datetime <= '$date_e1' ";
            $yesterday_reserve_count = db_get_all($sql);
            $this->set('yesterday_reserve_count', $yesterday_reserve_count[0]['count_num']);

            // 当月予約件数
            $sql = "select count(*) as count_num from a_reserve_list where ";
            $sql.= "tmp_reserve_datetime >= '$date_s2' ";
            $sql.= "and tmp_reserve_datetime <= '$date_e2' ";
            $reserve_count = db_get_all($sql);
            $this->set('reserve_count', $reserve_count[0]['count_num']);

            // 当月予約キャンセル
            $sql = "select count(*) as count_num from a_reserve_list where ";
            $sql.= "cancel_flag = 1 ";
            $sql.= "and cancel_datetime >= '$date_s2' ";
            $sql.= "and cancel_datetime <= '$date_e1' ";
            $reserve_cancel_count = db_get_all($sql);
            $this->set('reserve_cancel_count', $reserve_cancel_count[0]['count_num']);

            foreach ($hall_list as $key => $value) {
                $hall_id = $value['hall_id'];
                // 昨日予約
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and tmp_reserve_datetime >= '$date_s1' ";
                $sql.= "and tmp_reserve_datetime <= '$date_e1' ";

                $reserve_data1 = db_get_all($sql);

                $total_room_price1 = 0;
                $total_vessel_price1 = 0;

                if(!empty($reserve_data1)){
                    foreach ($reserve_data1 as $v) {
                        $total_room_price1 += $v['room_price'];
                        $total_vessel_price1 += $v['vessel_price'];
                    }
                }
                // 税抜き
                $total_room_price1 = $total_room_price1 / $tax_rate;
                $total_vessel_price1 = $total_vessel_price1 / $tax_rate;

                $hall_list[$key]['total_room_price1'] = number_format($total_room_price1);
                $hall_list[$key]['total_vessel_price1'] = number_format($total_vessel_price1);
                // 当月利用予定金額
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and tmp_reserve_datetime >= '$date_s2' ";
                $sql.= "and tmp_reserve_datetime <= '$date_e2' ";

                $reserve_data2 = db_get_all($sql);

                $total_room_price2 = 0;
                $total_vessel_price2 = 0;

                if(!empty($reserve_data2)){
                    foreach ($reserve_data2 as $v) {
                        $total_room_price2 += $v['room_price'];
                        $total_vessel_price2 += $v['vessel_price'];
                    }
                }

                // 税抜き
                $total_room_price2 = $total_room_price2 / $tax_rate;
                $total_vessel_price2 = $total_vessel_price2 / $tax_rate;

                $hall_list[$key]['total_room_price2'] = number_format($total_room_price2);
                $hall_list[$key]['total_vessel_price2'] = number_format($total_vessel_price2);

                // 当月キャンセル
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and cancel_flag = 1 ";
                $sql.= "and cancel_datetime >= '$date_s2' ";
                $sql.= "and cancel_datetime <= '$date_e1' ";
                $reserve_data3 = db_get_all($sql);

                $total_room_price3 = 0;
                $total_vessel_price3 = 0;

                if(!empty($reserve_data3)){
                    foreach ($reserve_data3 as $v) {
                        $cancel_price = get_cancel_price2($v['reserve_id']);
                        $price = $v['total_price'] - $cancel_price['cancel_price'];
                        //print "$price<br>";
                        $total_room_price3 += $price;
                        $total_vessel_price3 += $v['vessel_price'];
                    }
                }

                // 税抜き
                $total_room_price3 = $total_room_price3 / $tax_rate;
                $total_vessel_price3 = $total_vessel_price3 / $tax_rate;

                $hall_list[$key]['total_room_price3'] = number_format($total_room_price3);
                $hall_list[$key]['total_vessel_price3'] = number_format($total_vessel_price3);
            }// foreach hall_list


            $this->set('hall_list', $hall_list);



// news_flash ///////////////////////////////////////////////////////
        } elseif ($menu == "cancellation_analysis") {
            $this->set('title', 'キャンセル分析');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);

            $hall_order = Array();
            $a = 0;
            foreach ($hall_list as $i) {
                $hall_order[$i["hall_id"]] = $a++;
            }

            if (!empty($_POST['hall_id'])) {
                $hall_id = $_POST['hall_id'];
                $sql = "select * from a_room where hall_id = $hall_id and flag = 1";
                $room_list = db_get_all($sql);
                $this->set('room_list', $room_list);

                if (!empty($_POST['room_id'])) {
                    $room_id = $_POST['room_id'];
                } else {
                    $room_id = 0;
                }
                $this->set('room_id', $room_id);
            } else {
                $hall_id = 0;
            }

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';
            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);


            if ($_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

/// 2013.12.21 消費税改定対応 begin

            $sql = "select rate from a_tax where stadate <= '2014-03-31 00:00:00' ";

/// 2013.12.21 消費税改定対応 end
            global $db;
            $tax_rate = db_get_all($sql, $db);
            $tax_rate = ($tax_rate[0]['rate'] * 0.01) + 1;

            $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $sql = "select * from a_reserve_list where cancel_flag = 1 ";
            if ($hall_id > 0) {
                $sql.= "and hall_id = $hall_id ";
            }
            if (isset($room_id) && $room_id > 0) {
                $sql.= "and room_id = $room_id ";
            }
            $sql.= "and cancel_datetime>= '$date_s' ";
            $sql.= "and cancel_datetime<= '$date_e' ";
            $sql.= "order by cancel_datetime";


            $list = db_get_all($sql);

            foreach ($list as $key => $value) {
                $list[$key]['hall_name'] = get_hall_name($value['hall_id']);
                $list[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);

                $cancel_data = get_cancel_price2($value['reserve_id']);
                $list[$key]['cancel_rate'] = $cancel_data['percent'];

                $list[$key]['cancel_price'] = number_format($cancel_data['cancel_price'] / $tax_rate);

                $dt = new DateTime($value['cancel_datetime']);
                $list[$key]['cancel_date'] = $dt->format("Y/m/d");

                $list[$key]['cancel_to_begin_days'] = $cancel_data['before'];

                // 仮予約からキャンセルまで何日か
                $dt = new DateTime($value['cancel_datetime']);
                $dt2 = new DateTime($value['tmp_reserve_datetime']);

                $s = mktime(0, 0, 0, $dt->format("m"), $dt->format("d"), $dt->format("Y")) - mktime(0, 0, 0, $dt2->format("m"), $dt2->format("d"), $dt2->format("Y"));
                $before = ($s / 60 / 60 / 24);
                $list[$key]['tmp_to_cancel_days'] = $before;

                // 予約からキャンセルまで何日か
                if ($value['reserve_datetime'] != "0000-00-00 00:00:00") {
                    $dt = new DateTime($value['cancel_datetime']);
                    $dt2 = new DateTime($value['reserve_datetime']);

                    $s = mktime(0, 0, 0, $dt->format("m"), $dt->format("d"), $dt->format("Y")) - mktime(0, 0, 0, $dt2->format("m"), $dt2->format("d"), $dt2->format("Y"));
                    $before = ($s / 60 / 60 / 24);
                    $list[$key]['reserve_to_cancel_days'] = $before;
                } else {
                    $list[$key]['reserve_to_cancel_days'] = "--";
                }
                $list[$key]['order'] = isset($hall_order[$value['hall_id']]) ? $hall_order[$value['hall_id']] : 0;
            }// foreach $list

            uasort($list, "hallcmp");
            $this->set('list', $list);

// cancellation_analysis ////////////////////////////////////////////////
        } elseif ($menu == "long_term_use") {
            $this->set('title', '長期利用顧客一覧');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (isset($_POST['hall_id']) && $_POST['hall_id']) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            } else {
                $hall_id = 0;
                $this->set('hall_name', "全会場");
            }

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';
            $_POST['year3'] = isset($_POST['year3']) ? $_POST['year3'] : '';
            $_POST['month3'] = isset($_POST['month3']) ? $_POST['month3'] : '';
            $_POST['day3'] = isset($_POST['day3']) ? $_POST['day3'] : '';
            $_POST['year4'] = isset($_POST['year4']) ? $_POST['year4'] : '';
            $_POST['month4'] = isset($_POST['month4']) ? $_POST['month4'] : '';
            $_POST['day4'] = isset($_POST['day4']) ? $_POST['day4'] : '';
            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);
            $this->set('year3', $_POST['year3']);
            $this->set('month3', $_POST['month3']);
            $this->set('day3', $_POST['day3']);
            $this->set('year4', $_POST['year4']);
            $this->set('month4', $_POST['month4']);
            $this->set('day4', $_POST['day4']);

            if ($_POST['year1'] != "" and $_POST['month1'] != "" and $_POST['day1'] != "" and $_POST['year2'] != "" and $_POST['month2'] != "" and $_POST['day2'] != "") {
                $date_s1 = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e1 = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";
            }

            if ($_POST['year3'] != "" and $_POST['month3'] != "" and $_POST['day3'] != "" and $_POST['year4'] != "" and $_POST['month4'] != "" and $_POST['day4'] != "") {
                $date_s2 = $_POST['year3'] . "-" . $_POST['month3'] . "-" . $_POST['day3'] . " 00:00:00";
                $date_e2 = $_POST['year4'] . "-" . $_POST['month4'] . "-" . $_POST['day4'] . " 23:59:59";
            }

            $sql = "select * from c_member";
            $c_member = db_get_all($sql);            

            $list = array();
            $key = 0;
            foreach ($c_member as $value) {
                $sql = "select * from a_reserve_list where c_member_id = " . $value['c_member_id'] . " and long_term = 1 ";
                if ($hall_id > 0) {
                    $sql.= "and hall_id = $hall_id ";
                }
                if ($date_s1) {
                    $sql.= "and begin_datetime >= '$date_s1' ";
                    $sql.= "and begin_datetime <= '$date_e1' ";
                }
                if ($date_s2) {
                    $sql.= "and tmp_reserve_datetime >= '$date_s2' ";
                    $sql.= "and tmp_reserve_datetime <= '$date_e2 ' ";
                }
                $reserve_data = db_get_all($sql);                
                if (!empty($reserve_data)) {

                    foreach ($reserve_data as $k => $v) {
                        $reserve_data[$k]['hall_name'] = get_hall_name($v['hall_id']);
                        $reserve_data[$k]['purpose'] = get_purpose_word($v['purpose']);
                    }

                    $list[$key]['reserve_data'] = $reserve_data;
                    $list[$key]['name'] = $value['nickname'];
                    $list[$key]['c_member_id'] = $value['c_member_id'];
                    // メアド取得
                    $sql = "select pc_address from c_member_secure where c_member_id =" . $value['c_member_id'];
                    $result = db_get_all($sql);
                    $list[$key]['mail'] = t_decrypt($result[0]['pc_address']);
                    $list[$key]['tel'] = get_profile_value($value['c_member_id'], 17);
                    $list[$key]['fax'] = get_profile_value($value['c_member_id'], 18);
                    $list[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
                    $list[$key]['address'] = get_profile_value($value['c_member_id'], 3) . get_profile_value($value['c_member_id'], 14) . get_profile_value($value['c_member_id'], 15) . get_profile_value($value['c_member_id'], 16);

                    // 過去利用回数
                    if ($date_s1) {
                        $sql = "select count(*) as count_num from a_reserve_list where c_member_id = " . $value['c_member_id'] . " and begin_datetime < '$date_s1'";
                        $count = db_get_all($sql);
                        $list[$key]['count'] = $count[0]['count_num'];
                    } elseif ($date_s2) {
                        $sql = "select count(*) as count_num from a_reserve_list where c_member_id = " . $value['c_member_id'] . " and tmp_reserve_datetime < '$date_s2'";
                        $count = db_get_all($sql);
                        $list[$key]['count'] = $count[0]['count_num'];
                    } else {
                        $list[$key]['count'] = "--";
                    }
                    $key++;
                }
            }


            $this->set('list', $list);


// long_term_use /////////////////////////////////////////////////
        } elseif ($menu == "use_schedule_list") {
            $this->set('title', '利用予定一覧');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (!empty($_POST['hall_id'])) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            } else {
                $hall_id = 0;
                $this->set('hall_name', "全会場");
            }

            $_POST['year'] = isset($_POST['year']) ? $_POST['year'] : null;
            $_POST['month'] = isset($_POST['month']) ? $_POST['month'] : null;
            $_POST['day'] = isset($_POST['day']) ? $_POST['day'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $hall_id);
            $this->set('year', $_POST['year']);
            $this->set('month', $_POST['month']);
            $this->set('day', $_POST['day']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if ($_POST['year'] == "" or $_POST['month'] == "" or $_POST['day'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

            $date_s = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $sql = "select * from a_reserve_list where cancel_flag = 0 ";
            $sql.= "and begin_datetime >= '$date_s' ";
            $sql.= "and begin_datetime <= '$date_e' ";
            if ($hall_id > 0) {
                $sql.= "and hall_id = $hall_id ";
            }
            $sql.= "order by begin_datetime ";
            $reserve_data = db_get_all($sql);

            foreach ($reserve_data as $key => $value) {

                $dt = new DateTime($value['begin_datetime']);
                $reserve_data[$key]['begin_datetime'] = $dt->format("Y年m月d日");

                $reserve_data[$key]['hall_name'] = get_hall_name($value['hall_id']);
                $reserve_data[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                $sql = "select * from c_member where c_member_id = " . $value['c_member_id'];
                $name = db_get_all($sql);
                $reserve_data[$key]['name'] = $name[0]['nickname'];
                $reserve_data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
                $reserve_data[$key]['purpose'] = get_purpose_word($value['purpose']);
                // メアド取得
                $sql = "select pc_address from c_member_secure where c_member_id =" . $value['c_member_id'];
                $result = db_get_all($sql);
                $reserve_data[$key]['mail'] = t_decrypt($result[0]['pc_address']);
                $reserve_data[$key]['tel'] = get_profile_value($value['c_member_id'], 17);

                // 報告データ
                $sql = "select * from a_report where reserve_id = " . $value['reserve_id'];
                $report = db_get_all($sql);
                $reserve_data[$key]['report'] = isset($report[0]) ? $report[0] : array();
            }

            $this->set('reserve_data', $reserve_data);

// use_schedule_list //////////////////////////////////////////////////
        } elseif ($menu == "payment_record") {
            $this->set('title', '入金記録');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (!empty($_POST['hall_id'])) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            } else {
                $hall_id = 0;
                $this->set('hall_name', "全会場");
            }

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if ($_POST['year1'] == "" or $_POST['month1'] == "" or $_POST['day1'] == "" or $_POST['year2'] == "" or $_POST['month2'] == "" or $_POST['day2'] == "") {
                return 'success';
            }

            $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
            $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";

            $sql = "select * from a_reserve_list where ";
            $sql.= "pay_checkdate >= '$date_s' ";
            $sql.= "and pay_checkdate <= '$date_e' ";
            $sql.= "and pay_money > 0 ";
            if ($hall_id > 0) {
                $sql.= "and hall_id = $hall_id ";
            }
//  $sql.= "order by pay_checkdate";
            $sql.= "order by hall_id";
            $reserve_data = db_get_all($sql);

            foreach ($reserve_data as $key => $value) {
                $sql = "select * from c_member where c_member_id = " . $value['c_member_id'];
                $name = db_get_all($sql);
                $reserve_data[$key]['name'] = $name[0]['nickname'];
                $reserve_data[$key]['corp'] = get_profile_value($value['c_member_id'], 12);

                $dt = new DateTime($value['pay_checkdate']);
                $reserve_data[$key]['date'] = $dt->format("Y年m月d日");
                $reserve_data[$key]['pay_money'] = number_format($value['pay_money']);
                $reserve_data[$key]['total_price'] = number_format($value['total_price']);
                $reserve_data[$key]['hall_name'] = get_hall_name($value['hall_id']);
            }

            $this->set('reserve_data', $reserve_data);

            // キャンセル料金の入金
            $sql = "select * from a_amount_billed where ";
            $sql.= "check_datetime >= '$date_s' ";
            $sql.= "and check_datetime <= '$date_e' ";
            $sql.= "and pay_money > 0 ";
//  $sql.= "order by check_datetime";
            $sql.= "order by hall_id";

            $ab_data = db_get_all($sql);

            foreach ($ab_data as $key => $value) {
                $sql = "select * from a_reserve_list where reserve_id = " . $value['reserve_id'];
                $reserve_data = db_get_all($sql);
                $reserve_data = $reserve_data[0];

                $sql = "select * from c_member where c_member_id = " . $reserve_data['c_member_id'];
                $name = db_get_all($sql);

                $ab_data[$key]['hall_id'] = $reserve_data['hall_id'];
                $ab_data[$key]['name'] = $name[0]['nickname'];
                $ab_data[$key]['corp'] = get_profile_value($reserve_data['c_member_id'], 12);

                $dt = new DateTime($value['check_datetime']);
                $ab_data[$key]['date'] = $dt->format("Y年m月d日");
                $ab_data[$key]['pay_money'] = number_format($value['pay_money']);
                $ab_data[$key]['total_price'] = number_format($value['total_billed_money']);
                $ab_data[$key]['hall_name'] = get_hall_name($reserve_data['hall_id']);
            }

            $this->set('ab_data', $ab_data);

// payment_record /////////////////////////////////////////
        } elseif ($menu == "repeat_customer_list") {
            $this->set('title', 'リピート顧客リスト');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (isset($_POST['hall_id']) && $_POST['hall_id']) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            } else {
                $hall_id = 0;
                $this->set('hall_name', "全会場");
            }


            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if (!$hall_id) {
                return 'success';
            }


            if ($_POST['year1'] != "" and $_POST['month1'] != "" and $_POST['day1'] != "" and $_POST['year2'] != "" and $_POST['month2'] != "" and $_POST['day2'] != "") {
                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";
            }


            $sql = "select * from c_member";
            $c_member = db_get_all($sql);



            $list = array();
            $key = 0;
            foreach ($c_member as $value) {
                // 期間内に完了している予約がある
                $sql = "select count(*) as a from a_reserve_list ";
                $sql.= "where hall_id = $hall_id and ";
//      $sql.= "c_member_id = ".$value['c_member_id']." and ";
//      $sql.= "complete_flag = 1 ";
                $sql.= "c_member_id = " . $value['c_member_id'] . " ";
                if ($date_s) {
                    $sql.= "and begin_datetime >= '$date_s' ";
                    $sql.= "and begin_datetime <= '$date_e' ";
                }
                $result = db_get_all($sql);

                if ($result[0]['a'] > 0) {
                    // 完了している予約があるユーザーの全体の予約数
                    $sql = "select count(*) as a from a_reserve_list ";
                    $sql.= "where hall_id = $hall_id and ";
                    $sql.= "c_member_id = " . $value['c_member_id'];
                    if ($date_s) {
                        $sql.= " and begin_datetime >= '$date_s' ";
                        $sql.= " and begin_datetime <= '$date_e' ";
                    }
                    $reserve = db_get_all($sql);
                    if (isset($reserve[0]['a']) && $reserve[0]['a'] >= 2) {
                        // リピート（2件以上)
                        $sql = "select * from a_reserve_list ";
                        $sql.= "where hall_id = $hall_id and ";
                        $sql.= "c_member_id = " . $value['c_member_id'];
                        if ($date_s) {
                            $sql.= " and begin_datetime >= '$date_s' ";
                            $sql.= " and begin_datetime <= '$date_e' ";
                        }
                        $reserve_data = db_get_all($sql);

                        foreach ($reserve_data as $k => $v) {
                            $reserve_data[$k]['purpose'] = get_purpose_word($v['purpose']);
                        }

                        $list[$key]['corp'] = get_profile_value($value['c_member_id'], 12);
                        $list[$key]['name'] = $value['nickname'];
                        $list[$key]['reserve_data'] = $reserve_data;
                        $list[$key]['count'] = $reserve[0]['a'];
                        $list[$key]['c_member_id'] = $value['c_member_id'];
// メアド取得
                        $sql = "select pc_address from c_member_secure where c_member_id =" . $value['c_member_id'];
                        $result = db_get_all($sql);
                        $list[$key]['mail'] = t_decrypt($result[0]['pc_address']);
                        $list[$key]['tel'] = get_profile_value($value['c_member_id'], 17);
                        $list[$key]['fax'] = get_profile_value($value['c_member_id'], 18);
                        $list[$key]['address'] = get_profile_value($value['c_member_id'], 3) . get_profile_value($value['c_member_id'], 14) . get_profile_value($value['c_member_id'], 15) . get_profile_value($value['c_member_id'], 16);
                        $key++;
                    }
                }
            }


            $this->set('list', $list);

// repeat_customer_list /////////////////////////////////////////////////
        } elseif ($menu == "sales_report") {
            $this->set('title', '売上報告書（社内）');
            // set_time_limit(0);

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (isset($_POST['hall_id']) && $_POST['hall_id']) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            } else {
                $hall_id = 0;
                $this->set('hall_name', "全会場");
            }

            if (!$hall_id) {
                $hall_id = 0;
            }
            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : '';
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : '';
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : '';
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : '';
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : '';
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : '';

            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if ($_POST['year1'] != "" and $_POST['month1'] != "" and $_POST['day1'] != "" and $_POST['year2'] != "" and $_POST['month2'] != "" and $_POST['day2'] != "") {
                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";
            } else {
                return 'success';
            }
            if ($hall_id == 0) {                          
                $total_room_price = 0; // 利用済み金額　合計
                $total_room_price_paid = 0; // 利用済　入金済 合計
                $total_room_price_unpayment = 0; // 利用済　未入金　合計
                $total_room_use_before = 0; // 以前利用の入金額
                $total_cancel_before = 0; // 以前利用の入金額
                $total_room_sales_use = 0; // 利用ベース
                $total_room_sales_paid = 0; // 入金ベース

                $total_vessel_price = 0; // 利用済み金額　合計
                $total_vessel_price_paid = 0; // 利用済　入金済 合計
                $total_vessel_price_unpayment = 0; // 利用済　未入金　合計
                $total_vessel_use_before = 0; // 以前利用の入金額
                $total_vessel_sales_use = 0; // 利用ベース
                $total_vessel_sales_paid = 0; // 入金ベース

                $total_service_price = 0; // 利用済み金額　合計
                $total_service_price_paid = 0; // 利用済　入金済 合計
                $total_service_price_unpayment = 0; // 利用済　未入金　合計
                $total_service_use_before = 0; // 以前利用の入金額
                $total_service_sales_use = 0; // 利用ベース
                $total_service_sales_paid = 0; // 入金ベース

                foreach ($hall_list as $key => $value) {// 期間内の全予約
                    $sql = "select * from a_reserve_list where hall_id = " . $value['hall_id'];
                    $sql.= " and begin_datetime >= '$date_s' ";
                    $sql.= "and begin_datetime <= '$date_e' ";
                    $reserve_data = db_get_all($sql);                  
                    $hall_list[$key]['all_room_price'] = 0; // 利用済　全額
                    $hall_list[$key]['all_room_price_paid'] = 0; // 利用済　入金済
                    $hall_list[$key]['all_room_price_unpayment'] = 0; // 利用済　未入金

                    $hall_list[$key]['all_vessel_price'] = 0; // 利用済　全額
                    $hall_list[$key]['all_vessel_price_paid'] = 0; // 利用済　入金済
                    $hall_list[$key]['all_vessel_price_unpayment'] = 0; // 利用済　未入金

                    $hall_list[$key]['all_service_price'] = 0; // 利用済　全額
                    $hall_list[$key]['all_service_price_paid'] = 0; // 利用済　入金済
                    $hall_list[$key]['all_service_price_unpayment'] = 0; // 利用済　未入
                    foreach ($reserve_data as $k => $v) {
                        if ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0) {
                            // 本予約で、キャンセルされていない
                            $hall_list[$key]['all_room_price'] += $v['room_price'];
                            $total_room_price += $v['room_price'];

                            $hall_list[$key]['all_vessel_price'] += $v['vessel_price'];
                            $total_vessel_price += $v['vessel_price'];

                            $hall_list[$key]['all_service_price'] += $v['service_price'];
                            $total_service_price += $v['service_price'];

                            // 入金済
                            if ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0 and $v['pay_flag'] == 1) {
                                $hall_list[$key]['all_room_price_paid'] += $v['room_price'];
                                $total_room_price_paid += $v['total_price'];

                                $hall_list[$key]['all_vessel_price_paid'] += $v['vessel_price'];
                                $total_vessel_price_paid += $v['vessel_price'];

                                $hall_list[$key]['all_service_price_paid'] += $v['service_price'];
                                $total_service_price_paid += $v['service_price'];
                            } elseif ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0 and $v['pay_flag'] == 0) {
                                // 未入金
                                $hall_list[$key]['all_room_price_unpayment'] += $v['room_price'];
                                $total_room_price_unpayment += $v['room_price'];

                                $hall_list[$key]['all_vessel_price_unpayment'] += $v['vessel_price'];
                                $total_vessel_price_unpayment += $v['vessel_price'];

                                $hall_list[$key]['all_service_price_unpayment'] += $v['service_price'];
                                $total_service_price_unpayment += $v['service_price'];
                            }
                        } elseif ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 1) {
                            // 本予約で、キャンセルされている
                            $sql = "select * from a_amount_billed where reserve_id = " . $v['reserve_id'];
                            $ab_data = db_get_all($sql);
                            $ab_data = $ab_data[0];
                            if ($ab_data) {
                                $hall_list[$key]['all_room_price'] += $ab_data['total_billed_money'];
                                $total_room_price += $ab_data['total_billed_money'];

// 入金済
                                if ($ab_data['flag'] == 1) {
                                    $hall_list[$key]['all_room_price_paid'] += $ab_data['total_billed_money'];
                                    $total_room_price_paid += $ab_data['total_billed_money'];
                                } elseif ($ab_data['flag'] == 0) {
                                    // 未入金
                                    $hall_list[$key]['all_room_price_unpayment'] += $ab_data['total_billed_money'];
                                    $total_room_price_unpayment += $ab_data['total_billed_money'];
                                }
                            }
                        }
                    }// foreach reserve_data
                    // 以前利用の入金額(予約)
                    $sql = "select * from a_reserve_list ";
                    $sql.= "where hall_id = " . $value['hall_id'] . " and ";
                    $sql.= "tmp_flag=0 and cancel_flag=0 and ";
                    $sql.= "pay_checkdate >= '$date_s' and ";
                    $sql.= "pay_checkdate <= '$date_e' and ";
                    $sql.= "begin_datetime < '$date_s' and ";
                    $sql.= "pay_flag = 1";
                    $result = db_get_all($sql);

                    $hall_list[$key]['room_use_before'] = 0;
                    $hall_list[$key]['vessel_use_before'] = 0;
                    $hall_list[$key]['service_use_before'] = 0;
                    foreach ($result as $k => $v) {
                        $hall_list[$key]['room_use_before'] += $v['room_price'];
                        $total_room_use_before += $v['room_price'];

                        $hall_list[$key]['vessel_use_before'] += $v['vessel_price'];
                        $total_vessel_use_before += $v['vessel_price'];

                        $hall_list[$key]['service_use_before'] += $v['service_price'];
                        $total_service_use_before += $v['service_price'];
                    }
                    //以前利用の入金額（キャンセル料）
                    // 過去のキャンセル
                    $sql = "select * from a_reserve_list ";
                    $sql.= "where hall_id = " . $value['hall_id'] . " and ";
                    $sql.= "tmp_flag=0 and cancel_flag=1 and ";
                    $sql.= "begin_datetime < '$date_s' ";
                    $result = db_get_all($sql);

                    foreach ($result as $k => $v) {
                        // 過去のキャンセルで期間内に入金済みになっている
                        $sql = "select * from a_amount_billed where ";
                        $sql.= "reserve_id = " . $v['reserve_id'] . " and ";
                        $sql.= "check_datetime >= '$date_s' and ";
                        $sql.= "check_datetime <= '$date_e' and ";
                        $sql.= "flag = 1";
                        $ab_data = db_get_all($sql);
                        $ab_data = isset($ab_data[0]) ? $ab_data[0] : null;
                        if ($ab_data) {
                            $hall_list[$key]['room_use_before'] += $ab_data['total_billed_money'];
//          $total_room_use_before += $ab_data['total_billed_money'];
                            $total_cancel_before += $ab_data['total_billed_money'];
                        }
                    }

                    // 売上利用ベース
                    $ao_room = 100 - $value['owner_room'];
                    $hall_list[$key]['ao_room'] = $ao_room;
                    $ao_vessel = 100 - $value['owner_vessel'];
                    $hall_list[$key]['ao_vessel'] = $ao_vessel;

                    $hall_list[$key]['room_sales_use_base'] = round($hall_list[$key]['all_room_price'] * ($ao_room * 0.01));
                    $total_room_sales_use += $hall_list[$key]['room_sales_use_base'];

                    $hall_list[$key]['vessel_sales_use_base'] = round($hall_list[$key]['all_vessel_price'] * ($ao_vessel * 0.01));
                    $total_vessel_sales_use += $hall_list[$key]['vessel_sales_use_base'];

                    // 売上入金ベース
                    $hall_list[$key]['room_sales_paid_base'] = round($hall_list[$key]['all_room_price_paid'] * $ao_room * 0.01) + round($hall_list[$key]['room_use_before'] * $ao_room * 0.01);
                    $total_room_sales_paid += $hall_list[$key]['room_sales_paid_base'];

                    $hall_list[$key]['vessel_sales_paid_base'] = round($hall_list[$key]['all_vessel_price_paid'] * $ao_vessel * 0.01) + round($hall_list[$key]['vessel_use_before'] * $ao_vessel * 0.01);
                    $total_vessel_sales_paid += $hall_list[$key]['vessel_sales_paid_base'];
                }// foreach hall_list


                $this->set('hall_data', $hall_list);
                $this->set('total_room_price', $total_room_price);
                $this->set('total_room_price_paid', $total_room_price_paid);
                $this->set('total_room_price_unpayment', $total_room_price_unpayment);
                $this->set('total_room_use_before', $total_room_use_before);
                $this->set('total_cancel_before', $total_cancel_before);
                $this->set('total_room_sales_use', $total_room_sales_use);
                $this->set('total_room_sales_paid', $total_room_sales_paid);

                $this->set('total_vessel_price', $total_vessel_price);
                $this->set('total_vessel_price_paid', $total_vessel_price_paid);
                $this->set('total_vessel_price_unpayment', $total_vessel_price_unpayment);
                $this->set('total_vessel_use_before', $total_vessel_use_before);
                $this->set('total_vessel_sales_use', $total_vessel_sales_use);
                $this->set('total_vessel_sales_paid', $total_vessel_sales_paid);
                $this->set('total_service_price', $total_service_price);
                $this->set('total_service_price_paid', $total_service_price_paid);
                $this->set('total_service_price_unpayment', $total_service_price_unpayment);
                $this->set('total_service_use_before', $total_service_use_before);
                $this->set('total_service_sales_use', $total_service_sales_use);
                $this->set('total_service_sales_paid', $total_service_sales_paid);
            } else {
                // 会場選択した場合
                $sql = "select * from a_hall where hall_id = $hall_id";
                $hall_data = db_get_all($sql);
                $hall_data = $hall_data[0];

                $hall_data['ao_room'] = 100 - $hall_data['owner_room'];
                $hall_data['ao_vessel'] = 100 - $hall_data['owner_vessel'];

                $this->set('hall_data', $hall_data);

// 期間内の全予約
                $sql = "select * from a_reserve_list where hall_id = $hall_id ";
                $sql.= "and (( begin_datetime >= '$date_s' ";
                $sql.= "and begin_datetime <= '$date_e' and cancel_flag=0)";
                // 2014-12-02
                $sql.= "OR ( cancel_datetime >= '$date_s' ";
                $sql.= "and cancel_datetime <= '$date_e' and cancel_flag=1))";
                $sql.= "order by begin_datetime";
                //var_dump($sql);
                $reserve_data = db_get_all($sql);
                //var_dump($reserve_data);
                $total_room_price = 0; // 部屋利用料合計
                $total_cancel_price = 0;
                $total_vessel_price = 0; // 備品利用料合計
                $total_service_price = 0; // サービス利用料合計
                $total_room_price_unpayment = 0;
                $total_cancel_price_unpayment = 0;
                $total_vessel_price_unpayment = 0;
                $total_service_price_unpayment = 0;
                $total_unpayment_price = 0;
                $total_price_unpaid = 0;

                $total_room_price_paid = isset($total_room_price_paid) ? $total_room_price_paid : 0;
                $total_vessel_price_paid = isset($total_vessel_price_paid) ? $total_vessel_price_paid : 0;
                $total_service_price_paid = isset($total_service_price_paid) ? $total_service_price_paid : 0;
                foreach ($reserve_data as $k => $v) {
                    if ($v['pay_money'] > $v['total_price']) {
                        $reserve_data[$k]['pay_money'] = $v['total_price'];
                        $v['pay_money'] = $v['total_price'];
                    }
                    if ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0) {
                        // 本予約で、キャンセルされていない
                        $total_room_price += $v['room_price'];
                        $total_vessel_price += $v['vessel_price'];
                        $total_service_price += $v['service_price'];

                        // 入金済
                        if ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0 and $v['pay_flag'] == 1) {
                            $total_room_price_paid += $v['room_price'];
                            $total_vessel_price_paid += $v['vessel_price'];
                            $total_service_price_paid += $v['service_price'];
                        } elseif ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0 and $v['pay_flag'] == 0 and $v['pay_money'] == 0) {
                            // 未入金
                            $total_room_price_unpayment += $v['room_price'];
                            $total_vessel_price_unpayment += $v['vessel_price'];
                            $total_service_price_unpayment += $v['service_price'];
                        }
                    } elseif ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 1) {
                        // 本予約で、キャンセルされている
                        
                        $sql = "select * from a_amount_billed where reserve_id = " . $v['reserve_id'];
                        $ab_data = db_get_all($sql);
                        $ab_data = $ab_data[0];
                        
                        $begindate = date('Y-m-d',strtotime($v['begin_datetime']));
                        $canceldate=date('Y-m-d',strtotime($v['cancel_datetime']));
                        $timeDiff = abs(strtotime($begindate)-strtotime($canceldate));
                        $numberDays = $timeDiff/86400;  
                        $numBeforeDate = intval($numberDays);
                        $pcent =1;
                        if($numBeforeDate <=9){
                            $roomprice= $v['room_price'];
                            $verselprice = $v['vessel_price'];
                            
                        }
                        else if($numBeforeDate >9 && $numBeforeDate <=14){
                             $roomprice= $v['room_price']*0.5;
                             $verselprice = $v['vessel_price']*0.5;
                             $totalprice = $v['total_price']*0.5;
                             $pcent =0.5;
                        }
                        else if($numBeforeDate >14 && $numBeforeDate <=29)
                        {
                            $roomprice= $v['room_price']*0.2;
                            $verselprice = $v['vessel_price']*0.2;
                            $totalprice = $v['total_price']*0.2;
                            $pcent =0.2;
                        }
                        else{
                             $roomprice= $v['room_price']*0.1;
                             $verselprice = $v['vessel_price']*0.1;
                             $totalprice = $v['total_price']*0.1;
                             $pcent =0.1;
                        }
                        $reserve_data[$k]['cancel'] = $totalprice;
                        $reserve_data[$k]['room_price'] = $roomprice;
                        $reserve_data[$k]['paid'] = 0;
                        $reserve_data[$k]['versel_op']=$verselprice;
                        $reserve_data[$k]['vessel_price'] = $verselprice;
                        $reserve_data[$k]['total_price'] = $v['total_price']= $totalprice;
                        
                        if ($ab_data) {
                            $reserve_data[$k]['ab_data'] = $ab_data;
                            if($roomprice > $ab_data['total_billed_money'])
                            {
                                $reserve_data[$k]['cancel'] = $ab_data['total_billed_money'];
                                $total_room_price += $ab_data['total_billed_money'];
                            }
                            else{
                                $total_cancel_price += $roomprice;
                            }
// 入金済
                            if ($ab_data['flag'] == 1) {
                                if($roomprice > $ab_data['total_billed_money']){
                                    $reserve_data[$k]['paid'] = $ab_data['total_billed_money'];
                                    $total_room_price_paid += $ab_data['total_billed_money'];
                                }
                                else{
                                    $total_room_price_paid += $roomprice;
                                }
                                
                            } elseif ($ab_data['flag'] == 0) {
                                // 未入金
                              
                                $hall_list[$key]['all_room_price_unpayment'] += $ab_data['total_billed_money'];
                                $total_room_price_unpayment += $ab_data['total_billed_money'];
                                
                            }
                            
                            
                            //$total_service_price_unpayment += $v['service_price'];
                        }// if ab_data
                        $total_vessel_price_unpayment += $verselprice;
                    }
                    // 利用日
                    $dt = new DateTime($v['begin_datetime']);
                    $reserve_data[$k]['date'] = $dt->format("Y年m月d日");
                    $begin = $dt->format("H:i");
                    $dt = new DateTime($v['finish_datetime']);
                    $finish = $dt->format("H:i");
                    $reserve_data[$k]['time'] = $begin . " ～ " . $finish;
                    $reserve_data[$k]['room_name'] = get_room_name($v['hall_id'], $v['room_id']);

                    // 未入金
                    $total_versel_unpaid = isset($total_versel_unpaid) ? $total_versel_unpaid : 0;
                    if ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 0) {
                        $reserve_data[$k]['unpayment'] = $v['total_price'] - $v['pay_money'];
                        if ($reserve_data[$k]['unpayment'] > 0 and $v['pay_money'] > 0) {
                            $reserve_data[$k]['unpayment_flag'] = 1;
                        }
                        if($reserve_data[$k]['unpayment']>0)
                        {
                            $total_versel_unpaid += $v['vessel_price'];
                            $total_price_unpaid += $v['room_price'];
                        }
                    } elseif ($v['tmp_flag'] == 0 and $v['cancel_flag'] == 1) {
                        if($ab_data){
                            $reserve_data[$k]['unpayment'] = $ab_data['total_billed_money'] - $ab_data['pay_money'];
                        if($reserve_data[$k]['unpayment'] > 0 and $ab_data['pay_money'] > 0){
                            $reserve_data[$k]['unpayment_flag'] = 1;
                        }
                        }else{
                            $reserve_data[$k]['unpayment'] = "--";
                        }
                        if($reserve_data[$k]['unpayment'] >0)
                        {
                            $total_versel_unpaid += $verselprice;
                            $total_price_unpaid += $roomprice;
                        }
                    }
                    
                    $total_unpayment_price += (isset($reserve_data[$k]['unpayment']) && $reserve_data[$k]['unpayment']>0)?$reserve_data[$k]['unpayment']:0;

                    if ($v['tmp_flag'] == 1) {
                        unset($reserve_data[$k]);
                    }
                    //rsdn 2015-04-01
                    $sqlService = "SELECT a_service_data.service_name,a_reserve_s.price,a_reserve_s.num FROM a_service_data LEFT JOIN  a_reserve_s ON a_service_data.service_id=a_reserve_s.service_id WHERE a_reserve_s.reserve_id ='".$v['reserve_id']."'";
                    $resultService = db_get_all($sqlService);
                    //var_dump($resultService);
                    $reserve_data[$k]['list_service']=$resultService;
                }// foreach reserve_data
                // 以前利用の入金額済み(予約)
                $sql = "select * from a_reserve_list ";
                $sql.= "where hall_id = $hall_id and ";
                $sql.= "tmp_flag=0 and cancel_flag=0 and ";
                $sql.= "pay_checkdate >= '$date_s' and ";
                $sql.= "pay_checkdate <= '$date_e' and ";
                $sql.= "begin_datetime < '$date_s' and ";
                $sql.= "pay_flag = 1";
                $result = db_get_all($sql);

                $total_room_use_before = 0;
                $total_vessel_use_before = 0;
                $total_service_use_before = 0;

                foreach ($result as $key => $value) {
                    $total_room_use_before += $value['room_price'];
                    $total_vessel_use_before += $value['vessel_price'];
                    $total_service_use_before += $value['service_price'];

                    // 利用日
                    $dt = new DateTime($value['begin_datetime']);
                    $result[$key]['date'] = $dt->format("Y年m月d日");
                    $begin = $dt->format("H:i");
                    $dt = new DateTime($value['finish_datetime']);
                    $finish = $dt->format("H:i");
                    $result[$key]['time'] = $begin . " ～ " . $finish;
                    $result[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                    //rsdn 2015-04-16
                    $sqlService = "SELECT a_service_data.service_name,a_reserve_s.price,a_reserve_s.num FROM a_service_data LEFT JOIN  a_reserve_s ON a_service_data.service_id=a_reserve_s.service_id WHERE a_reserve_s.reserve_id ='".$value['reserve_id']."'";
                    $resultService = db_get_all($sqlService);
                    
                    $result[$key]['list_service']=$resultService;
                    
                }

                $this->set('before_paid_data', $result);

                //以前利用の入金額（キャンセル料）
                // 過去のキャンセル
                $value['hall_id'] = isset($value['hall_id']) ? $value['hall_id'] : '';
                $sql = "select * from a_reserve_list ";
                $sql.= "where hall_id = " . $value['hall_id'] . " and ";
                $sql.= "tmp_flag=0 and cancel_flag=1 and pay_flag=0 and ";
                $sql.= "begin_datetime < '$date_s' order by begin_datetime";
                $result = db_get_all($sql);


                foreach ($result as $key => $value) {

                    // 利用日
                    $dt = new DateTime($value['begin_datetime']);
                    $result[$key]['date'] = $dt->format("Y年m月d日");
                    $begin = $dt->format("H:i");
                    $dt = new DateTime($value['finish_datetime']);
                    $finish = $dt->format("H:i");
                    $result[$key]['time'] = $begin . " ～ " . $finish;
                    $result[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);

                    // 過去のキャンセルで期間内に入金済みになっている
                    $sql = "select * from a_amount_billed where ";
                    $sql.= "reserve_id = " . $value['reserve_id'] . " and ";
                    $sql.= "check_datetime >= '$date_s' and ";
                    $sql.= "check_datetime <= '$date_e' and ";
                    $sql.= "flag = 1";
                    $ab_data = db_get_all($sql);
                    $ab_data = $ab_data[0];
                    if ($ab_data) {
                        $result[$key]['cancel_price'] = $ab_data['total_billed_money'];
                        $total_room_use_before += $ab_data['total_billed_money'];
                    } else {
                        unset($result[$key]);
                    }
                }

                $this->set('before_paid_data2', $result);

                // 以前利用未入金（予約）
                $sql = "select * from a_reserve_list ";
                $sql.= "where hall_id = $hall_id and ";
                $sql.= "tmp_flag=0 and cancel_flag=0 and ";
                $sql.= "begin_datetime < '$date_s' and ";
                $sql.= "pay_flag = 0";
                $result = db_get_all($sql);

                $total_room_use_before_unpayment = 0;
                $total_cancel_before_unpayment = 0;
                $total_vessel_use_before_unpayment = 0;
                $total_service_use_before_unpayment = 0;
                $total_before_unpayment_price = 0;
                $total_before_vessel_unpayment_price = 0;

                foreach ($result as $key => $value) {
                    $total_room_use_before_unpayment += $value['room_price'];
                    $total_vessel_use_before_unpayment += $value['vessel_price'];
                    $total_service_use_before_unpayment += $value['service_price'];

                    $total_before_unpayment_price += $value['total_price'] - $value['pay_money'];
                    $total_before_vessel_unpayment_price += $value['total_price'] - $value['pay_money'];
                    $result[$key]['unpayment_price'] = $value['total_price'] - $value['pay_money'];
                    // 利用日
                    $dt = new DateTime($value['begin_datetime']);
                    $result[$key]['date'] = $dt->format("Y年m月d日");
                    $begin = $dt->format("H:i");
                    $dt = new DateTime($value['finish_datetime']);
                    $finish = $dt->format("H:i");
                    $result[$key]['time'] = $begin . " ～ " . $finish;
                    $result[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);
                }
                $this->set('before_unpayment_data', $result);


                //以前利用の未入金（キャンセル料）
                // 過去のキャンセル
                $sql = "select * from a_reserve_list ";
                $sql.= "where hall_id = " . $value['hall_id'] . " and ";
                $sql.= "tmp_flag=0 and cancel_flag=1 and pay_flag=0 and ";
                $sql.= "begin_datetime < '$date_s' order by begin_datetime";
                $result = db_get_all($sql);


                foreach ($result as $key => $value) {

                    // 利用日
                    $dt = new DateTime($value['begin_datetime']);
                    $result[$key]['date'] = $dt->format("Y年m月d日");
                    $begin = $dt->format("H:i");
                    $dt = new DateTime($value['finish_datetime']);
                    $finish = $dt->format("H:i");
                    $result[$key]['time'] = $begin . " ～ " . $finish;
                    $result[$key]['room_name'] = get_room_name($value['hall_id'], $value['room_id']);

                    // 過去のキャンセルで未入金
                    $sql = "select * from a_amount_billed where ";
                    $sql.= "reserve_id = " . $value['reserve_id'] . " and ";
                    $sql.= "flag = 0";
                    $ab_data = db_get_all($sql);
                    $ab_data = isset($ab_data[0]) ? $ab_data[0] : null;
                    if ($ab_data) {
//          $total_room_use_before_unpayment += $ab_data['total_billed_money'];
                        $total_cancel_before_unpayment += $ab_data['total_billed_money'];
                        $total_before_unpayment_price += $ab_data['total_billed_money'] - $ab_data['pay_money'];
                        $result[$key]['cancel_price'] = $ab_data['total_billed_money'];
                        $result[$key]['pay_money'] = $ab_data['pay_money'];
                        $result[$key]['unpayment_price'] = $ab_data['total_billed_money'] - $ab_data['pay_money'];
                    } else {
                        unset($result[$key]);
                    }
                }

                $this->set('before_unpayment_data2', $result);

                // 利用ベース
                $total_room_sales_use = round($total_room_price * ($hall_data['ao_room'] * 0.01));
                $total_vessel_sales_use = round($total_vessel_price * ($hall_data['ao_vessel'] * 0.01));
                // 売上ベース


                $total_room_sales_paid = round($total_room_price_paid * $hall_data['ao_room'] * 0.01) + round($total_room_use_before * $hall_data['ao_room'] * 0.01);
                $total_vessel_sales_paid = round($total_vessel_price_paid * $hall_data['ao_vessel'] * 0.01) + round($total_vessel_use_before * $hall_data['ao_vessel'] * 0.01);

                $total_service_sales_paid = $total_service_price_paid + $total_service_use_before;

                // 総額
                $total_price = $total_room_price + $total_vessel_price;
                $total_sales_use = $total_room_sales_use + $total_vessel_sales_use;
                $total_sales_paid = $total_room_sales_paid + $total_vessel_sales_paid;

                $total_versel_unpaid = isset($total_versel_unpaid) ? $total_versel_unpaid : null;
                $this->set('total_versel_unpaid',$total_versel_unpaid);
                $this->set('total_room_price', $total_room_price);
                $this->set('total_cancel_price', $total_cancel_price);
                $this->set('total_room_sales_use', $total_room_sales_use);
                $this->set('total_room_sales_paid', $total_room_sales_paid);

                $this->set('total_vessel_price', $total_vessel_price);
                $this->set('total_vessel_sales_use', $total_vessel_sales_use);
                $this->set('total_vessel_sales_paid', $total_vessel_sales_paid);
                $this->set('total_price', $total_price);
                $this->set('total_sales_use', $total_sales_use);
                $this->set('total_sales_paid', $total_sales_paid);

                $this->set('total_service_price_paid', $total_service_price_paid);
                $this->set('total_service_sales_paid', $total_service_sales_paid);

                $this->set('reserve_data', $reserve_data);
                $this->set('total_room_price_paid', $total_room_price_paid);
                $this->set('total_unpayment_price', $total_unpayment_price);

                $this->set('total_room_use_before', $total_room_use_before);
                $this->set('total_room_price_unpayment', $total_room_price_unpayment);
                $this->set('total_cancel_price_unpayment', $total_cancel_price_unpayment);
                $this->set('total_room_use_before_unpayment', $total_room_use_before_unpayment);
                $this->set('total_cancel_before_unpayment', $total_cancel_before_unpayment);
                $this->set('total_before_unpayment_price', $total_before_unpayment_price);
                $this->set('total_vessel_price_paid', $total_vessel_price_paid);
                $this->set('total_vessel_price_unpayment', $total_vessel_price_unpayment);
                $this->set('total_vessel_use_before', $total_vessel_use_before);
                $this->set('total_vessel_use_before_unpayment', $total_vessel_use_before_unpayment);
                $this->set('total_before_vessel_unpayment_price', $total_before_vessel_unpayment_price);

                $this->set('total_service_price', $total_service_price);
                $this->set('total_service_price_unpayment', $total_service_price_unpayment);
                $this->set('total_service_use_before', $total_service_use_before);
                $this->set('total_service_use_before_unpayment', $total_service_use_before_unpayment);
                $this->set('total_price_unpaid',$total_price_unpaid);
                }
// sales_report //////////////////////////////////////////////////////////
        } elseif ($menu == "management_analysis") {
            $this->set('title', '会場運営分析');

            $sql = "select * from a_hall where flag = 0 order by pulldown desc";
            $hall_list = db_get_all($sql);

            $this->set('hall_list', $hall_list);
            if (!empty($_POST['hall_id'])) {
                $hall_id = $_POST['hall_id'];
                $this->set('hall_name', get_hall_name($hall_id));
            }

            if (empty($hall_id)) {
                $hall_id = 0;
            }

            $_POST['year1'] = isset($_POST['year1']) ? $_POST['year1'] : null;
            $_POST['month1'] = isset($_POST['month1']) ? $_POST['month1'] : null;
            $_POST['day1'] = isset($_POST['day1']) ? $_POST['day1'] : null;
            $_POST['year2'] = isset($_POST['year2']) ? $_POST['year2'] : null;
            $_POST['month2'] = isset($_POST['month2']) ? $_POST['month2'] : null;
            $_POST['day2'] = isset($_POST['day2']) ? $_POST['day2'] : null;
            $this->set('hall_id', $hall_id);
            $this->set('year1', $_POST['year1']);
            $this->set('month1', $_POST['month1']);
            $this->set('day1', $_POST['day1']);
            $this->set('year2', $_POST['year2']);
            $this->set('month2', $_POST['month2']);
            $this->set('day2', $_POST['day2']);

            if ($_POST['year1'] != "" and $_POST['month1'] != "" and $_POST['day1'] != "" and $_POST['year2'] != "" and $_POST['month2'] != "" and $_POST['day2'] != "") {
                $date_s = $_POST['year1'] . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e = $_POST['year2'] . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";
                $date_s1 = ($_POST['year1'] - 1) . "-" . $_POST['month1'] . "-" . $_POST['day1'] . " 00:00:00";
                $date_e1 = ($_POST['year2'] - 1) . "-" . $_POST['month2'] . "-" . $_POST['day2'] . " 23:59:59";
            } else {
                return 'success';
            }


            // 消費税
/// 2013.12.21 消費税改定対応 begin

            $sql = "select rate from a_tax where stadate <= '2014-03-31 00:00:00' ";

/// 2013.12.21 消費税改定対応 end
            global $db;
            $tax_rate = db_get_all($sql, $db);
            $tax_rate = ($tax_rate[0]['rate'] * 0.01) + 1;

            // 会場全体
            $hall_data = array();
            // 予約件数
            $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and ";
            $sql.= "tmp_reserve_datetime >= '$date_s' and ";
            $sql.= "tmp_reserve_datetime <= '$date_e' ";

            $hall_data['reserve_count'] = db_get_all($sql);
            $hall_data['reserve_count'] = $hall_data['reserve_count'][0]['count_num'];
            // 予約利用金額
            $sql = "select sum(room_price) as total_room_price from a_reserve_list where hall_id = '$hall_id' and ";
            $sql.= "tmp_reserve_datetime >= '$date_s' and ";
            $sql.= "tmp_reserve_datetime <= '$date_e' ";

            $hall_data['total_room_price'] = db_get_all($sql);
            $hall_data['total_room_price'] = $hall_data['total_room_price'][0]['total_room_price'];
            // 税抜き
            $hall_data['total_room_price'] = round($hall_data['total_room_price'] / $tax_rate);

            // 予約利用金額OP含む
            $sql = "select sum(room_price+vessel_price) as total_rv_price from a_reserve_list where hall_id = '$hall_id' and ";
            $sql.= "tmp_reserve_datetime >= '$date_s' and ";
            $sql.= "tmp_reserve_datetime <= '$date_e' ";

            $hall_data['total_rv_price'] = db_get_all($sql);
            $hall_data['total_rv_price'] = $hall_data['total_rv_price'][0]['total_rv_price'];
            // 税抜き
            $hall_data['total_rv_price'] = round($hall_data['total_rv_price'] / $tax_rate);

            // 昨年の予約利用金額OP含む
            $sql = "select sum(room_price+vessel_price) as total_rv_price from a_reserve_list where hall_id = '$hall_id' and ";
            $sql.= "tmp_reserve_datetime >= '$date_s1' and ";
            $sql.= "tmp_reserve_datetime <= '$date_e1' ";

            $result = db_get_all($sql);
            $result = $result[0]['total_rv_price'];
            // 税抜き
            $result = round($result / $tax_rate);
            $hall_data['total_rv_last_year'] = $hall_data['total_rv_price'] - $result;

            // 利用金額
            $sql = "select sum(room_price) as total_use_room_price from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0 and ";
            $sql.= "begin_datetime >= '$date_s' and ";
            $sql.= "begin_datetime <= '$date_e' ";

            $hall_data['total_use_room_price'] = db_get_all($sql);
            $hall_data['total_use_room_price'] = $hall_data['total_use_room_price'][0]['total_use_room_price'];
            // 税抜き
            $hall_data['total_use_room_price'] = round($hall_data['total_use_room_price'] / $tax_rate);

            // 利用OP含む
            $sql = "select sum(room_price+vessel_price) as total_use_rv_price from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0 and ";
            $sql.= "begin_datetime >= '$date_s' and ";
            $sql.= "begin_datetime <= '$date_e' ";

            $hall_data['total_use_rv_price'] = db_get_all($sql);
            $hall_data['total_use_rv_price'] = $hall_data['total_use_rv_price'][0]['total_use_rv_price'];
            // 税抜き
            $hall_data['total_use_rv_price'] = round($hall_data['total_use_rv_price'] / $tax_rate);

            // 昨年の予約利用金額OP含む
            $sql = "select sum(room_price+vessel_price) as total_use_rv_price from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0 and ";
            $sql.= "begin_datetime >= '$date_s1' and ";
            $sql.= "begin_datetime <= '$date_e1' ";

            $result = db_get_all($sql);
            $result = $result[0]['total_use_rv_price'];
            // 税抜き
            $result = round($result / $tax_rate);
            $hall_data['total_use_rv_last_year'] = $hall_data['total_use_rv_price'] - $result;

            // 未入金事故件数
            $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0 and ";
            $sql.= "pay_limitdate >= '$date_s' and ";
            $sql.= "pay_limitdate <= '$date_e' and ";
            $sql.= "pay_limitdate < pay_checkdate ";
            $hall_data['accident'] = db_get_all($sql);
            $hall_data['accident'] = $hall_data['accident'][0]['count_num'];

            // 累計利用数
            $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0";
            $hall_data['all_reserved'] = db_get_all($sql);
            $hall_data['all_reserved'] = $hall_data['all_reserved'][0]['count_num'];
            // 来場者数
            $sql = "select sum(people) as total_people from a_reserve_list where hall_id = '$hall_id' and tmp_flag = 0 and cancel_flag = 0";
            $hall_data['total_people'] = db_get_all($sql);
            $hall_data['total_people'] = $hall_data['total_people'][0]['total_people'];
            if (!$hall_data['total_people']) {
                $hall_data['total_people'] = 0;
            }

            // リピート率
            $result = get_repeat_rate($hall_id, $date_s, $date_e);
            $hall_data['rate'] = $result['rate'];

            // リピート率昨年同期差
            $result = get_repeat_rate($hall_id, $date_s1, $date_e1);
            $last_year_rate = $result['rate'];
            $hall_data['rate_difference'] = $hall_data['rate'] - $last_year_rate;

            // 金額稼働率
            $hall_data['room_price_rate'] = get_room_price_rate($hall_id, 0, $date_s, $date_e, $_POST['year1'], $_POST['month1'], $_POST['day1'], $_POST['year2'], $_POST['month2'], $_POST['day2']);

            // 昨年金額稼働率
            $room_rate_last_year = get_room_price_rate($hall_id, 0, $date_s1, $date_e1, ($_POST['year1'] - 1), $_POST['month1'], $_POST['day1'], ($_POST['year2'] - 1), $_POST['month2'], $_POST['day2']);

            $hall_data['room_rate_difference'] = $hall_data['room_price_rate'] - $room_rate_last_year;

            // 時間稼働率
            $hall_data['time_rate'] = get_time_rate($hall_id, 0, $date_s, $date_e, $_POST['year1'], $_POST['month1'], $_POST['day1'], $_POST['year2'], $_POST['month2'], $_POST['day2']);


            $this->set('hall_data', $hall_data);

/////////////////
/////////////////
            // 部屋データ取得
            $sql = "select * from a_room where hall_id = '$hall_id' and flag=1";
            $room_data = db_get_all($sql);

            foreach ($room_data as $key => $value) {
                $room_id = $value['room_id'];
                $room_data[$key]['room_name'] = get_room_name($hall_id, $room_id);


                // 予約件数
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and ";
                $sql.= "tmp_reserve_datetime >= '$date_s' and ";
                $sql.= "tmp_reserve_datetime <= '$date_e' ";

                $room_data[$key]['reserve_count'] = db_get_all($sql);
                $room_data[$key]['reserve_count'] = $room_data[$key]['reserve_count'][0]['count_num'];
                // 予約利用金額
                $sql = "select sum(room_price) as total_room_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and ";
                $sql.= "tmp_reserve_datetime >= '$date_s' and ";
                $sql.= "tmp_reserve_datetime <= '$date_e' ";

                $room_data[$key]['total_room_price'] = db_get_all($sql);
                $room_data[$key]['total_room_price'] = $room_data[$key]['total_room_price'][0]['total_room_price'];
                // 税抜き
                $room_data[$key]['total_room_price'] = round($room_data[$key]['total_room_price'] / $tax_rate);

                // 予約利用金額OP含む
                $sql = "select sum(room_price+vessel_price) as total_rv_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and ";
                $sql.= "tmp_reserve_datetime >= '$date_s' and ";
                $sql.= "tmp_reserve_datetime <= '$date_e' ";

                $room_data[$key]['total_rv_price'] = db_get_all($sql);
                $room_data[$key]['total_rv_price'] = $room_data[$key]['total_rv_price'][0]['total_rv_price'];
                // 税抜き
                $room_data[$key]['total_rv_price'] = round($room_data[$key]['total_rv_price'] / $tax_rate);

                // 昨年の予約利用金額OP含む
                $sql = "select sum(room_price+vessel_price) as total_rv_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and ";
                $sql.= "tmp_reserve_datetime >= '$date_s1' and ";
                $sql.= "tmp_reserve_datetime <= '$date_e1' ";

                $result = db_get_all($sql);
                $result = $result[0]['total_rv_price'];
                // 税抜き
                $result = round($result / $tax_rate);
                $room_data[$key]['total_rv_last_year'] = $room_data[$key]['total_rv_price'] - $result;

                // 利用金額
                $sql = "select sum(room_price) as total_use_room_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0 and ";
                $sql.= "begin_datetime >= '$date_s' and ";
                $sql.= "begin_datetime <= '$date_e' ";

                $room_data[$key]['total_use_room_price'] = db_get_all($sql);
                $room_data[$key]['total_use_room_price'] = $room_data[$key]['total_use_room_price'][0]['total_use_room_price'];
                // 税抜き
                $room_data[$key]['total_use_room_price'] = round($room_data[$key]['total_use_room_price'] / $tax_rate);

                // 利用OP含む
                $sql = "select sum(room_price+vessel_price) as total_use_rv_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0 and ";
                $sql.= "begin_datetime >= '$date_s' and ";
                $sql.= "begin_datetime <= '$date_e' ";

                $room_data[$key]['total_use_rv_price'] = db_get_all($sql);
                $room_data[$key]['total_use_rv_price'] = $room_data[$key]['total_use_rv_price'][0]['total_use_rv_price'];
                // 税抜き
                $room_data[$key]['total_use_rv_price'] = round($room_data[$key]['total_use_rv_price'] / $tax_rate);

                // 昨年の予約利用金額OP含む
                $sql = "select sum(room_price+vessel_price) as total_use_rv_price from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0 and ";
                $sql.= "begin_datetime >= '$date_s1' and ";
                $sql.= "begin_datetime <= '$date_e1' ";

                $result = db_get_all($sql);
                $result = $result[0]['total_use_rv_price'];
                // 税抜き
                $result = round($result / $tax_rate);
                $room_data[$key]['total_use_rv_last_year'] = $room_data[$key]['total_use_rv_price'] - $result;

                // 未入金事故件数
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0 and ";
                $sql.= "pay_limitdate >= '$date_s' and ";
                $sql.= "pay_limitdate <= '$date_e' and ";
                $sql.= "pay_limitdate < pay_checkdate ";
                $room_data[$key]['accident'] = db_get_all($sql);
                $room_data[$key]['accident'] = $room_data[$key]['accident'][0]['count_num'];

                // 累計利用数
                $sql = "select count(*) as count_num from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0";
                $room_data[$key]['all_reserved'] = db_get_all($sql);
                $room_data[$key]['all_reserved'] = $room_data[$key]['all_reserved'][0]['count_num'];
                // 来場者数
                $sql = "select sum(people) as total_people from a_reserve_list where hall_id = '$hall_id' and room_id = $room_id and tmp_flag = 0 and cancel_flag = 0";
                $room_data[$key]['total_people'] = db_get_all($sql);
                $room_data[$key]['total_people'] = $room_data[$key]['total_people'][0]['total_people'];
                if (!$room_data[$key]['total_people']) {
                    $room_data[$key]['total_people'] = 0;
                }

                // 金額稼働率
                $room_data[$key]['room_price_rate'] = get_room_price_rate($hall_id, $room_id, $date_s, $date_e, $_POST['year1'], $_POST['month1'], $_POST['day1'], $_POST['year2'], $_POST['month2'], $_POST['day2']);

                // 昨年金額稼働率
                $room_rate_last_year = get_room_price_rate($hall_id, $room_id, $date_s1, $date_e1, ($_POST['year1'] - 1), $_POST['month1'], $_POST['day1'], ($_POST['year2'] - 1), $_POST['month2'], $_POST['day2']);

                $room_data[$key]['room_rate_difference'] = $room_data[$key]['room_price_rate'] - $room_rate_last_year;

                // 時間稼働率
                $room_data[$key]['time_rate'] = get_time_rate($hall_id, $room_id, $date_s, $date_e, $_POST['year1'], $_POST['month1'], $_POST['day1'], $_POST['year2'], $_POST['month2'], $_POST['day2']);
            }// foreach room_data

            $this->set('room_data', $room_data);


// management_analysis //////////////////////////////////////////////////
        }



//////////////////////////////////////////////////////////////////////////


        return 'success';
    }

}

function get_repeat_rate($hall_id, $date_s, $date_e) {

    $_POST['hall_id'] = isset($_POST['hall_id']) ? $_POST['hall_id'] : '';
    $sql = "select count(*) as all_num from a_reserve_list where ";
    $sql.= "hall_id = " . $_POST['hall_id'] . " ";
//  $sql.= "and tmp_reserve_datetime >= '$date_s' ";
//  $sql.= "and tmp_reserve_datetime <= '$date_e' ";
    $sql.= "and begin_datetime >= '$date_s' ";
    $sql.= "and begin_datetime <= '$date_e' ";
//  $sql.= "and complete_flag = 1";

    $total = db_get_all($sql);
    $total = isset($total[0]['all_num']) ? $total[0]['all_num'] : 0;

    // 期間内の予約で1度完了している予約
    $sql = "select * from a_reserve_list where ";
    $sql.= "hall_id = " . $_POST['hall_id'] . " ";
//  $sql.= "and tmp_reserve_datetime >= '$date_s' ";
//  $sql.= "and tmp_reserve_datetime <= '$date_e' ";
    $sql.= "and begin_datetime >= '$date_s' ";
    $sql.= "and begin_datetime <= '$date_e' ";
//  $sql.= "and complete_flag = 1 ";
    $comp_list = db_get_all($sql);

//  echo $sql."<br>";
//  var_dump($comp_list);
    $repeat_count = 0;
    $rate = 0;
    if ($comp_list) {
        foreach ($comp_list as $key => $value) {
            $sql = "select count(*) from a_reserve_list where ";
            $sql.= "hall_id = " . $_POST['hall_id'] . " ";
//          $sql.= "and tmp_reserve_datetime >= '$date_s' ";
//          $sql.= "and tmp_reserve_datetime <= '$date_e' ";
            $sql.= "and begin_datetime >= '$date_s' ";
            $sql.= "and begin_datetime <= '$date_e' ";
//          $sql.= "and complete_flag = 1 ";    // completeのみ
            $sql.= "and c_member_id = " . $value['c_member_id'] . " ";
            $sql.= "and reserve_id != " . $value['reserve_id'] . " "; // 同じデータはひっかけない

            $result = db_get_all($sql);
//          var_dump($result);
//          echo "<br>$sql<br>";
            if ($result[0]["count(*)"]) {
                $repeat_count++;
//              echo "r:".$repeat_count."<br>";
            }
        }
        $rate = round(($repeat_count / $total) * 100, 0);
    }

//  return $rate;
    return Array("rate" => $rate, "count" => $repeat_count, "total" => $total);
}

function get_room_price_rate($hall_id, $room_id, $date_s, $date_e, $year1, $month1, $day1, $year2, $month2, $day2) {

//$room_id = 3;

    $sql = "select * from a_hall where hall_id = $hall_id";
    $hall = db_get_all($sql);
    $hall = isset($hall[0]) ? $hall[0] : array(); 
    $hall['finish'] = isset($hall['finish']) ? $hall['finish'] : '';
    $hall['begin'] = isset($hall['begin']) ? $hall['begin'] : '';
    $open_time = $hall['finish'] - $hall['begin'];

    $sql = "select * from a_room where hall_id = $hall_id ";
    if ($room_id > 0) {
        $sql.= "and room_id = $room_id";
    }
    $room = db_get_all($sql);

    // 分子（利用金額OP含まず）
    $sql = "select sum(room_price) as room_price from a_reserve_list ";
    $sql.= "where hall_id = $hall_id and tmp_flag = 0 and cancel_flag = 0 and ";
    if ($room_id > 0) {
        $sql.= "room_id = $room_id and ";
    }
    $sql.= "begin_datetime >= '$date_s' and ";
    $sql.= "begin_datetime <= '$date_e' ";

    $total_room_price = db_get_all($sql);
    $total_room_price = $total_room_price[0]['room_price'];


    $total_price = 0;

    foreach ($room as $key => $value) {
        // 分母（貸し出し可能金額）

        $total_time = 0;

        // 1時間当たりの部屋利用料金
        if ($value['type'] == 2) {
            if ($value['koma'] == 0.25) {
                $room_price = $value['k_lowest_price'] * 4;
            } elseif ($value['koma'] == 0.5) {
                $room_price = $value['k_lowest_price'] * 2;
            } elseif ($value['koma'] == 1) {
                $room_price = $value['k_lowest_price'];
            } elseif ($value['koma'] > 1) {
                $room_price = round($value['k_lowest_price'] / $value['koma'], 0);
            }
        } else {
            $sql = "SELECT max(price) as price FROM a_room_pack where hall_id = $hall_id and room_id = " . $value['room_id'];
            $room_price = db_get_all($sql);
            $room_price[0]['price'] = isset($room_price[0]['price']) ? $room_price[0]['price'] : 0;
            $open_time = (isset($open_time) && $open_time > 0) ? $open_time : 1;
            $room_price = round($room_price[0]['price'] / $open_time, 0);
//      $room_price = $room_price[0]['price'];
        }

        $year = $year1;
        $month = $month1;
        $day = $day1;

        $date_s1 = $year1 . sprintf("%02d", $month1) . sprintf("%02d", $day1);
        $date_e1 = $year2 . sprintf("%02d", $month2) . sprintf("%02d", $day2);



        while ($date_s1 <= $date_e1) {
			$checkTime = checkDayHoliday($year, $month, $day);
             if($checkTime == 1){
	        	if($hall['begin1'] != '' && $hall['finish1'] != '' )
	        	{
	        	 	$open_time = $hall['finish1'] - $hall['begin1'];
	        	}
	           
	        }
	        else if($checkTime == 2){
	            if($hall['begin2'] != '' && $hall['finish2'] != '' )
	        	{
	        		$open_time = $hall['finish2'] - $hall['begin2'];
	        	}
	         
	        }
	        else if($checkTime == 3){
	            if($hall['begin3'] != '' && $hall['finish3'] != '' )
	        	{
	        		$open_time = $hall['finish3'] - $hall['begin3'];
	        	}
	           
	        }
	        else if($checkTime == 4){
	        	if($hall['begin4'] != '' && $hall['finish4'] != '' )
	        	{
	        			$open_time = $hall['finish4'] - $hall['begin4'];
	        	}
	           
	     	    
	        }
            //休日でなければ
            if (!check_holiday($hall_id, $value['room_id'], $year, $month, $day)) {

                // 貸し止め確認
                $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = " . $value['room_id'] . " and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
                $result = db_get_all($sql);
                $stop = 0;
                foreach ($result as $v) {
                    $dt = new DateTime($v['begin_datetime']);
                    $begin = $dt->format("H");
                    $dt = new DateTime($v['finish_datetime']);
                    $finish = $dt->format("H");
                    $stop += $finish - $begin;
                }
                if ($stop) {
                    $total_time += $open_time - $stop;
                } else {
                    $total_time += $open_time;
                }
            }

            $date_s1++;
            $day++;
//print $year.$month.$day."<br>";
            if (!checkdate($month, $day, $year)) {
                $day = 1;
                $month++;
                if (!checkdate($month, $day, $year)) {
                    $month = 1;
                    $year++;
                }
                $date_s1 = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
            }
            //print "日単位:".$date_s1.":".$total_time."<br>";
        }// while
        //print "部屋単位:".$total_time."<br>";
        //print $total_price."←".$room_price*$total_time."=".$room_price."*".$total_time."<br>";
        $total_price += $room_price * $total_time;
    }// foreach room
    //print "合計:".$total_time."<br>";
    // レート計算
    $total_room_price = isset($total_room_price) ? $total_room_price : 0;
    $total_price = (isset($total_price) && $total_price > 0) ? $total_price : 1;
    $rate = round(($total_room_price / $total_price) * 100, 0);
//print $room_id.":".$total_room_price."/".$total_price."<br>";
    if (!$rate) {
        $rate = 0;
    }

    return $rate;
}

// function

function get_time_rate($hall_id, $room_id, $date_s, $date_e, $year1, $month1, $day1, $year2, $month2, $day2) {


    $sql = "select * from a_hall where hall_id = $hall_id";
    $hall = db_get_all($sql);
    $hall = isset($hall[0]) ? $hall[0] : array();
    $hall['finish'] = isset($hall['finish']) ? $hall['finish'] : '';
    $hall['begin'] = isset($hall['begin']) ? $hall['begin'] : '';
    $open_time = $hall['finish'] - $hall['begin'];

    $sql = "select * from a_room where hall_id = $hall_id ";
    if ($room_id > 0) {
        $sql.= "and room_id = $room_id";
    }
    $room = db_get_all($sql);

    // 分子（利用時間）
    $sql = "select sum(finish_datetime-begin_datetime)/10000 as reserved_time from a_reserve_list where hall_id = $hall_id and tmp_flag = 0 and cancel_flag = 0 and ";
    if ($room_id > 0) {
        $sql.= "room_id = $room_id and ";
    }
    $sql.= "begin_datetime >= '$date_s' and ";
    $sql.= "begin_datetime <= '$date_e'";

    $reserved_time = db_get_all($sql);
    $reserved_time = round($reserved_time[0]['reserved_time'], 0);


    $total_time = 0;

    foreach ($room as $key => $value) {
        // 分母（貸し出し可能金額）

        $year = $year1;
        $month = $month1;
        $day = $day1;

        $date_s1 = $year1 . sprintf("%02d", $month1) . sprintf("%02d", $day1);
        $date_e1 = $year2 . sprintf("%02d", $month2) . sprintf("%02d", $day2);

        while ($date_s1 <= $date_e1) {
				$checkTime = checkDayHoliday($year, $month, $day);
             if($checkTime == 1){
	        	if($hall['begin1'] != '' && $hall['finish1'] != '' )
	        	{
	        	 	$open_time = $hall['finish1'] - $hall['begin1'];
	        	}
	           
	        }
	        else if($checkTime == 2){
	            if($hall['begin2'] != '' && $hall['finish2'] != '' )
	        	{
	        		$open_time = $hall['finish2'] - $hall['begin2'];
	        	}
	         
	        }
	        else if($checkTime == 3){
	            if($hall['begin3'] != '' && $hall['finish3'] != '' )
	        	{
	        		$open_time = $hall['finish3'] - $hall['begin3'];
	        	}
	           
	        }
	        else if($checkTime == 4){
	        	if($hall['begin4'] != '' && $hall['finish4'] != '' )
	        	{
	        			$open_time = $hall['finish4'] - $hall['begin4'];
	        	}
	           
	     	    
	        }
            //休日でなければ
            if (!check_holiday($hall_id, $value['room_id'], $year, $month, $day)) {

                // 貸し止め確認
                $date1 = $year . "-" . $month . "-" . $day . " 00:00:00";
                $date2 = $year . "-" . $month . "-" . $day . " 23:59:59";

                $sql = "select * from a_rental_stop where hall_id = $hall_id and room_id = " . $value['room_id'] . " and begin_datetime >= '$date1' and begin_datetime <= '$date2'";
                $result = db_get_all($sql);
                $stop = 0;
                foreach ($result as $v) {
                    $dt = new DateTime($v['begin_datetime']);
                    $begin = $dt->format("H");
                    $dt = new DateTime($v['finish_datetime']);
                    $finish = $dt->format("H");
                    $stop += $finish - $begin;
                }
                if ($stop) {
                    $total_time += $open_time - $stop;
                } else {
                    $total_time += $open_time;
                }
            }

            $date_s1++;
            $day++;
//print $year.$month.$day."<br>";
            if (!checkdate($month, $day, $year)) {
                $day = 1;
                $month++;
                if (!checkdate($month, $day, $year)) {
                    $month = 1;
                    $year++;
                }
                $date_s1 = $year . sprintf("%02d", $month) . sprintf("%02d", $day);
            }
            //print "日単位:".$date_s1.":".$total_time."<br>";
        }// while
        //print "部屋単位:".$total_time."<br>";
    }// foreach room
    //print "合計:".$total_time."<br>";
    // レート計算
    $reserved_time = isset($reserved_time) ? $reserved_time : 0;
    $total_time = (isset($total_time) && $total_time > 0) ? $total_time : 1;

    $rate = round(($reserved_time / $total_time) * 100, 0);
//print $room_id.":".$total_room_price."/".$total_price."<br>";
    if (!$rate) {
        $rate = 0;
    }

    return $rate;
}

// function

function hallcmp($a, $b) {
    return $a['order'] < $b['order'];
}

?>
