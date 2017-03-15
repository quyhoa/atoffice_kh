<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of set_reserve_complete
 *
 * @author RS
 */
class admin_page_set_reserve_complete extends OpenPNE_Action {

    function execute($requests) {
        $sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '" . $_SESSION['_authsession']['username'] . "'";
        $result = db_get_all($sql);
        $this->set('name', $result[0]['name']);
        $this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);
        if (!$_REQUEST['uid']) {
            $c_member_id = 0;
            $g_flag = 1;
        } else {
            $c_member_id = $_REQUEST['uid'];
            $g_flag = 0;
        }

        $error = array();
        //id member not set 
        if (!$c_member_id) {
            // 氏名
            if ($_POST['shimei'] == "") {
                array_push($error, '氏名を入力してください。');
            }
            // カナ


            if (!mb_ereg("^[ァ-ヶー 　]+$", $_POST['kana'])) {
                array_push($error, '氏名（カナ）を入力してください。');
            }
            // 利用形態
            if ($_POST['riyo'] == "") {
                array_push($error, '利用形態を選択してください。');
            }
            // 法人名・代表者名
            if ($_POST['daihyou'] == "") {
                array_push($error, '法人名・代表者名を入力してください。');
            }
            // メールアドレス
            if ($_POST['mail'] == "") {
                array_push($error, 'メールアドレスを入力してください。');
            } else {
                $hashed_mail = t_encrypt($_POST['mail']);
                $sql = "select c_member_id from c_member_secure where pc_address = '" . $hashed_mail . "'";
                $regist = db_get_all($sql);

                if ($regist[0]['c_member_id']) {
                    $sql = "select * from c_member where c_member_id = " . $regist[0]['c_member_id'];
                    $result = db_get_all($sql);
                    if ($result[0]['guest_flag'] == 0) {
                        array_push($error, 'このメールアドレスは既に登録されています。(顧客ID：' . $regist[0]['c_member_id'] . ')');
                    } else {
                        $c_member_id = $result[0]['c_member_id'];
                    }
                }
            }
            // 郵便番号
            if ($_POST['zip'] != "" and !preg_match("/^\d{3}\-\d{4}$/", $_POST['zip'])) {
                array_push($error, '有効な郵便番号を入力してください。');
            }
            // 市区町村
            if ($_POST['address_city'] == "") {
                array_push($error, '市区町村を入力してください。');
            }
            // 番地
            if ($_POST['address_banchi'] == "") {
                array_push($error, '番地を入力してください。');
            }
            // 電話番号
            if (!preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['tel'])) {
                array_push($error, '有効な電話番号を入力してください。');
            }
            // FAX
            if ($_POST['fax'] and !preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['fax'])) {
                array_push($error, '有効なFAX番号を入力してください。');
            }
        }// !$c_member_id

        if ($error) {
            $this->set('error', $error);
            return 'success';
            exit();
        }

        //print "<br>問題なし<br>";
        if (!$c_member_id and !$error) {
            // ゲスト登録
            // c_member 追加
            $sql = "insert into c_member (nickname, birth_year, birth_month, birth_day, r_date, is_login_rejected, guest_flag) values (";
            $sql.= "'" . $_POST['shimei'] . "', ";
            $sql.= "2000, ";
            $sql.= "1, ";
            $sql.= "1, ";
            $sql.= "now(), 1, 1)";
            db_get_all($sql);
            //print "$sql<br>";
            // 登録したメンバーID取得
            $sql = "SELECT c_member_id FROM c_member where nickname = ";
            $sql.= "'" . $_REQUEST['shimei'] . "' and ";
            $sql.= "(r_date  BETWEEN (NOW() - INTERVAL 1 minute) AND NOW())";
            $c_member_id = db_get_all($sql);
            $c_member_id = $c_member_id[0]['c_member_id'];
            db_get_all($sql);
            //print "$sql<br>";
            // c_member_secure 追加
            $hashed_password = md5('guest');
            $sql = "insert into c_member_secure (c_member_id, hashed_password, pc_address, regist_address) values (";
            $sql.= $c_member_id . ", '" . $hashed_password . "', '" . $hashed_mail . "', '" . $hashed_mail . "')";
            db_get_all($sql);
            //print "$sql<br>";
            // プロフィール追加
            $insert_list = get_prof_list($_REQUEST);

            foreach ($insert_list as $value) {
                if (!is_null($value['value'])) {
                    $sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
                    $sql.=$c_member_id . ", ";
                    $sql.=$value['c_profile_id'] . ", ";
                    $sql.=$value['c_profile_option_id'] . ", ";
                    $sql.="'" . $value['value'] . "'";
                    $sql.= ")";
                    db_get_all($sql);
                    //print "$sql<br>";
                }
            }


            // 固定仮想口座番号設定
            $sql = "select virtual_number from a_virtual_account_list where kotei=1 and flag = 0 and c_member_id = 0";
            $virtual = db_get_all($sql);
            $virtual = $virtual[0]['virtual_number'];

            if ($virtual) {
                $sql = "update a_virtual_account_list SET c_member_id = $c_member_id where virtual_number = '$virtual'";
                db_get_all($sql);
            }

            // if !c_member_id and !error
        }
       
          elseif ($g_flag) {
          // ゲスト情報上書き
          $sql = "update c_member SET nickname = '" . $_POST['shimei'] . "' where c_member_id = $c_member_id";
          db_get_all($sql);
          //print "$sql<br>";
          // プロフィール消去
          $sql = "delete from c_member_profile where c_member_id = $c_member_id";
          db_get_all($sql);

          // プロフィール追加
          $insert_list = get_prof_list($_REQUEST);

          foreach ($insert_list as $value) {
          if (!is_null($value['value'])) {
          $sql = "insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
          $sql.=$c_member_id . ", ";
          $sql.=$value['c_profile_id'] . ", ";
          $sql.=$value['c_profile_option_id'] . ", ";
          $sql.="'" . $value['value'] . "'";
          $sql.= ")";
          db_get_all($sql);
          //print "$sql<br>";
          }
          }
          }

         


        //$_POST['memo'] = ereg_replace("'", '\\\'', $_POST['memo']);
        //$memo = $_POST['memo'];
        $_POST['message'] = ereg_replace("'", '\\\'', $_POST['message']);
        $message = $_POST['message'];

        if ($_POST['mail']) {
            $mail = $_POST['mail'];
        } else {
            // info member
            $sql = "select pc_address from c_member_secure where c_member_id =" . $c_member_id;
            $result = db_get_all($sql);
            $mail = t_decrypt($result[0]['pc_address']);
        }

        //get all pre_reserve

        if (preg_match("/^[0-9]+$/", $_POST['pre_id'])) {
            $pre_id = $_POST['pre_id'];
        } else {
            $msg = "ERROR";
            return 'success';
        }

        $sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
        $pre_data = db_get_all($sql);
        if (!$pre_data) {
            $msg = "選択した予約が見つかりません。";
            return 'success';
        }


        foreach ($pre_data as $key => $value) {
            $hall_id = $value['hall_id'];
            $room_id = $value['room_id'];
            $begin_datetime = $value['begin_datetime'];
            $finish_datetime = $value['finish_datetime'];
            // all vessel
            $sql = "select * from a_pre_rv where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $vessel_rl = db_get_all($sql);
            //all service
            $sql = "select * from a_pre_rs where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $service_rl = db_get_all($sql);
            if (check_reserve2($hall_id, $room_id, $begin_datetime, $finish_datetime)) {
                //print "重複あり<br>";
                array_push($error, '時間の重複する予約が先に登録されています。');
            } else {
                // 備品在庫数チェック
                foreach ($vessel_rl as $value) {
                    // 在庫数
                    $sql = "select num from a_vessel_data where vessel_id = " . $value['vessel_id'];
                    $zaiko = db_get_all($sql);
                    $zaiko = $zaiko[0]['num'];
                    // 時間帯のかぶっている他の予約
                    $sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' and '$finish_datetime') or (finish_datetime between '$begin_datetime' and '$finish_datetime') or ('$begin_datetime' between begin_datetime and finish_datetime))";
                    $reserve_id_list = db_get_all($sql);
                    // 予約数
                    if ($reserve_id_list) {
                        $sql = "select num from a_reserve_v where vessel_id = " . $value['vessel_id'];
                        $sql.= " and (";
                        foreach ($reserve_id_list as $k => $v) {
                            $sql.= "reserve_id = " . $v['reserve_id'];
                            if ($reserve_id_list[($k + 1)]['reserve_id']) {
                                $sql.= " or ";
                            }
                        }
                        $sql.= ")";
                        $v_num = db_get_all($sql);
                        $reserve_v_num = 0;
                        foreach ($v_num as $v) {
                            $reserve_v_num+=$v['num'];
                        }
                    } else {
                        $reserve_v_num = 0;
                    }
                    //print "予約数：".$reserve_v_num."<br>";
                    // 他の予約数＋今回予約数　>　在庫数 = 不足
                    if (($reserve_v_num + $value['num']) > $zaiko) {
                        // 在庫不足
                        array_push($error, '先に他の予約が入った為、備品の在庫が不足します。');
                    }
                }// foreach
            }// 予約重複

            if ($error) {
                $this->set('error', $error);
                return 'success';
                exit();
            }
        }
        $u=$c_member_id;
        $sql = "select pc_address from c_member_secure where c_member_id =" . $u;
        $result = db_get_all($sql);
        $mail = t_decrypt($result[0]['pc_address']);

// メール本文


        $sql = "select * from c_member where c_member_id = '$u'";
        $nickname = db_get_all($sql);
        $nickname = $nickname[0]['nickname'];

        $corp = get_profile_value($u, 12);
        $address = get_profile_value($u, 3) . get_profile_value($u, 14) . get_profile_value($u, 15) . get_profile_value($u, 16);

        require_once("trmessage.inc.php");
        $body = trmessage($corp, $nickname);
        $body.= "<仮予約者情報>\n";
        $body.= "■アカウント登録：会員\n";
        $body.= "■お客様ID：" . $u . "\n";
        $body.= "■仮予約者名：" . $nickname . " 様\n";
        $body.= "■法人／団体名：" . $corp . "\n";
        $body.= "■住所：" . $address . "\n";
        $body.= "■TEL：" . get_profile_value($u, 17) . "\n";
        $body.= "■E-Mail：" . $mail . "\n";
        $body.= "■仮予約受付日時：" . date("Y年m月d日 H:i") . "\n\n";

        // 予約データ挿入
// メッセージのシングルクォートをエスケープ
//$_POST['message'] = ereg_replace("'", '\\\'', $_POST['message']);

        $mailing_list = array();

        //Insert in to reserve table 
        foreach ($pre_data as $key => $value) {
            if(isset($_POST['room_price_'.$value['pid']]))
            {
                 $room_price = $_POST['room_price_'.$value['pid']];     
            }
            else{
                $room_price=$value['room_price'];
            }
            if(isset($_POST['vessel_price_'.$value['pid']]))
            {
                $vessel_price = $_POST['vessel_price_'.$value['pid']];
            }
            else{
                $vessel_price = $value['vessel_price'];
            }
            if(isset($_POST['service_price_'.$value['pid']]))
            {
                $service_price = $_POST['service_price_'.$value['pid']];
            }
            else{
                $service_price = $value['service_price'];
            }
            if(isset($_POST['total_price_'.$value['pid']]))
            {
                $total_prices= $_POST['total_price_'.$value['pid']];
            }
            else {
                $total_prices = $value['total_price'];
            }
            if(isset($_POST['memo_'.$value['pid']]))
            {
                $_POST['memo_'.$value['pid']] = ereg_replace("'", '\\\'', $_POST['memo_'.$value['pid']]);
                $memo = $_POST['memo_'.$value['pid']];
            }
            else{
                $memo = '';
            }
            if(isset($_POST['kanban_'.$value['pid']]))
            {
                $_POST['kanban_'.$value['pid']] = ereg_replace("'", '\\\'', $_POST['kanban_'.$value['pid']]);
                $kanban = $_POST['kanban_'.$value['pid']];
            }
            else{
                $kanban = '';
            }
            $sql="insert into a_reserve_list (hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, room_price, vessel_price, service_price, total_price, people, purpose, kanban, memo, message, long_term) values (" . $value['hall_id'] . ", " . $value['room_id'] . ", $c_member_id, '" . $value['begin_datetime'] . "', '" . $value['finish_datetime'] . "', now(), " . $room_price . ", " . $vessel_price . ", " . $service_price . ", " . $total_prices . ", " . $value['people'] . ", " . $value['purpose'] . ", '".mysql_real_escape_string($kanban)."', '". mysql_real_escape_string($memo) ."', '". mysql_real_escape_string($_POST['message']) ."', '".$_POST['long_term']."')";
	
            //$sql = "insert into a_reserve_list (hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, room_price, vessel_price, service_price, total_price, people, purpose, kanban, message) values (" . $value['hall_id'] . ", " . $value['room_id'] . ", $c_member_id, '" . $value['begin_datetime'] . "', '" . $value['finish_datetime'] . "', now(), " . $value['room_price'] . ", " . $value['vessel_price'] . ", " . $value['service_price'] . ", " . $value['total_price'] . ", " . $value['people'] . ", " . $value['purpose'] . ", '" . mysql_real_escape_string($value['kanban']) . "', '" . mysql_real_escape_string($_POST['message']) . "')";
            db_get_all($sql);

            $sql = "SELECT reserve_id FROM a_reserve_list where c_member_id = $c_member_id and hall_id = " . $value['hall_id'] . " and room_id = " . $value['room_id'] . " and begin_datetime = '" . $value['begin_datetime'] . "' and finish_datetime = '" . $value['finish_datetime'] . "' and cancel_flag = 0 order by reserve_id desc";
            $reserve_id = db_get_all($sql);
            $reserve_id = $reserve_id[0]['reserve_id'];

            // 備品リスト
            $sql = "select * from a_pre_rv where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $vessel_rl = db_get_all($sql);
            //var_dump($vessel_rl);
            // サービスリスト
            $sql = "select * from a_pre_rs where pid = '" . $value['pid'] . "' and pre_id = '$pre_id' order by weight desc";
            $service_rl = db_get_all($sql);

            // 備品
            foreach ($vessel_rl as $v) {
                $sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price) values (";
                $sql.= "$reserve_id, " . $v['vessel_id'] . ", ";
                $sql.= $v['num'] . ", " . $v['price']/$v['num'];
                $sql.= ")";
                db_get_all($sql);
            }
            foreach ($service_rl as $v) {
                $sql = "insert into a_reserve_s (reserve_id, service_id, num, price) values (";
                $sql.="$reserve_id, " . $v['service_id'] . ", ";
                $sql.=$v['num'] . ", " . $v['price']/$v['num'];
                $sql.=")";
                db_get_all($sql);
            }

            $dt = new DateTime($value['begin_datetime']);
            $week = get_week($dt->format("Ymd"));
            $date = $dt->format("Y年m月d日");
            $date = $date . " " . $week . "曜日";
            $begin = $dt->format("H時i分");

            $dt = new DateTime($value['finish_datetime']);
            $finish = $dt->format("H時i分");

            $sql = "select * from a_room where hall_id = " . $value['hall_id'] . " and room_id = " . $value['room_id'];
            $room_data = db_get_all($sql);
            $room_data = $room_data[0];


            $body.= "***************** 予約:" . ($key + 1) . " *****************\n";
            $body.= "<仮予約施設情報>\n";
            $body.= "■予約ID：" . $reserve_id . "\n";
            $body.= "■施設名：" . get_hall_name($value['hall_id']) . "\n";
            $body.= "■ご利用目的：仮：" . get_purpose_word($value['purpose']) . "\n";
            $body.= "■看板表示：" . $kanban . "\n";
            $body.= "■利用日：" . $date . "\n";
            $body.= "■人数：" . $value['people'] . "名\n";
            $body.= "■部屋名（利用時間）\n";
            $body.= "・" . get_room_name($value['hall_id'], $value['room_id']) . "($begin ～ $finish)\n\n";
            $body.= "・施設料金：" . number_format($room_price) . " 円\n\n";

            if ($vessel_rl) {
                $body.= "<仮予約備品情報>\n";
                foreach ($vessel_rl as $v) {
                    $body.= "・" . get_vessel_name($v['vessel_id']) . "(数量：" . $v['num'] . ")\n";
                }
                $body.= "\n備品料金：" . number_format($vessel_price) . " 円\n\n";
            }

            if ($service_rl) {
                $body.= "<仮予約サービス品情報>\n";
                foreach ($service_rl as $v) {
                    $body.= "・" . get_service_name($v['service_id']) . "(数量：" . $v['num'] . ")\n";
                }
                $body.= "\nサービス料金：" . number_format($service_price) . " 円\n\n";
            }

            $body.= "合計料金：" . number_format($total_prices) . " 円\n";
            $body.= "*********************************************\n\n";

            if ($_POST['mail_flag'] == 1) {
                $sql = "select mailing_list from a_hall where hall_id = " . $value['hall_id'];
                $ml = db_get_all($sql);
                if ($ml) {
                    if (!in_array($ml[0]['mailing_list'], $mailing_list)) {
                        array_push($mailing_list, $ml[0]['mailing_list']);
                    }
                }
            }
        }// foreach
        if ($_POST['message']) {
            $body.= "■メッセージ\n";

            $body.= $_POST['message'] . "\n\n";
        }


        $sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by begin_datetime";
        $result = db_get_all($sql);

        foreach ($result as $key => $value) {
            if ($key == 0) {
                $dt = new DateTime($value['begin_datetime']);
                $date_s = $dt->format("Y-m-d");
            }
            $dt = new DateTime($value['begin_datetime']);
            $date_e = $dt->format("Y-m-d");
        }

        if ($date_s != $date_e) {
            $date_s = $date_s . " ～ " . $date_e;
        }


        // preデータ消去
        $sql = "delete from a_pre_reserve where pre_id = '$pre_id'";
        db_get_all($sql);
        $sql = "delete from a_pre_rv where pre_id = '$pre_id'";
        db_get_all($sql);
        $sql = "delete from a_pre_rs where pre_id = '$pre_id'";
        db_get_all($sql);
		$sql="delete from a_tmp_user where pre_id='$pre_id'";
		db_get_all($sql);
        $source = get_c_template_mail_source('m_atoffice_aokari');
        list($subject, $tmp_body) = explode("\n", $source, 2);

        if (!$subject) {
            $subject = "★会議室の仮予約を承りました。";
        }

        $subject.= "【" . get_hall_name($hall_id) . "/" . $date_s . "/" . $nickname . "様】";

        $body.= $tmp_body;

        if ($_POST['mail_flag'] == 1) {

            put_mail_queue($mail, $subject, $body);

            if ($mailing_list) {
                foreach ($mailing_list as $mail) {
                    put_mail_queue($mail, $subject, $body);
                }
            }
        }
		
        $year = $_SESSION['year'];
        $month =$_SESSION['month'];
        $day = $_SESSION['day'];
        $hall_id_last=$_SESSION['hall_id'];
        unset($_SESSION['year']);
        unset($_SESSION['month']);
        unset($_SESSION['day']);
        //unset($_SESSION['old_member']);
        //unset($_SESSION['hid']);
        admin_client_redirect("set_reserve&hall_list=$hall_id_last&year=$year&month=$month&day=$day", '予約を登録しました。');
		



        exit();
        
    }

}
