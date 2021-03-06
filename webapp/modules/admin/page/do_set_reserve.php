<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_do_set_reserve extends OpenPNE_Action
{

    function execute($requests)
    {


	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_POST);

	if(!$_POST['c_member_id']){
		$c_member_id = 0;
		$g_flag = 1;
	}else{
		$c_member_id = $_POST['c_member_id'];
		$g_flag = 0;
	}

	$error=array();
	if(!$c_member_id){
		// 氏名
		if($_POST['shimei']==""){
			array_push($error, '氏名を入力してください。');
		}
		// カナ


		if(!mb_ereg("^[ァ-ヶー 　]+$", $_POST['kana'])){
			array_push($error, '氏名（カナ）を入力してください。');
		}
		// 利用形態
		if($_POST['riyo']==""){
			array_push($error, '利用形態を選択してください。');
		}
		// 法人名・代表者名
		if($_POST['daihyou']==""){
			array_push($error, '法人名・代表者名を入力してください。');
		}
		// メールアドレス
		if($_POST['mail']==""){
			array_push($error, 'メールアドレスを入力してください。');
		}else{
			$hashed_mail = t_encrypt($_POST['mail']);
			$sql = "select c_member_id from c_member_secure where pc_address = '".$hashed_mail."'";
			$regist=db_get_all($sql);

			if($regist[0]['c_member_id']){
				$sql = "select * from c_member where c_member_id = ".$regist[0]['c_member_id'];
				$result = db_get_all($sql);
				if($result[0]['guest_flag']==0){
					array_push($error, 'このメールアドレスは既に登録されています。(顧客ID：'.$regist[0]['c_member_id'].')');
				}else{
					$c_member_id = $result[0]['c_member_id'];
				}
			}

		}
		// 郵便番号
		if($_POST['zip']!="" and !preg_match("/^\d{3}\-\d{4}$/", $_POST['zip'])){
			array_push($error, '有効な郵便番号を入力してください。');
		}
		// 市区町村
		if($_POST['address_city']==""){
			array_push($error, '市区町村を入力してください。');
		}
		// 番地
		if($_POST['address_banchi']==""){
			array_push($error, '番地を入力してください。');
		}
		// 電話番号
		if(!preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['tel'])){
			array_push($error, '有効な電話番号を入力してください。');
		}
		// FAX
		if($_POST['fax'] and !preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_POST['fax'])){
			array_push($error, '有効なFAX番号を入力してください。');
		}

	}// !$c_member_id

	if($error){
		$this->set('error', $error);
		return 'success';
		exit();
	}

	//print "<br>問題なし<br>";
	if(!$c_member_id and !$error){
		// ゲスト登録
		// c_member 追加
		$sql = "insert into c_member (nickname, birth_year, birth_month, birth_day, r_date, is_login_rejected, guest_flag) values (";
		$sql.= "'".$_POST['shimei']."', ";
		$sql.= "2000, ";
		$sql.= "1, ";
		$sql.= "1, ";
		$sql.= "now(), 1, 1)";
		db_get_all($sql);
		//print "$sql<br>";
		// 登録したメンバーID取得
		$sql = "SELECT c_member_id FROM c_member where nickname = ";
		$sql.= "'".$_REQUEST['shimei']."' and ";
		$sql.= "(r_date  BETWEEN (NOW() - INTERVAL 1 minute) AND NOW())";
		$c_member_id = db_get_all($sql);
		$c_member_id = $c_member_id[0]['c_member_id'];
		db_get_all($sql);
		//print "$sql<br>";

		// c_member_secure 追加
		$hashed_password = md5('guest');
		$sql = "insert into c_member_secure (c_member_id, hashed_password, pc_address, regist_address) values (";
		$sql.= $c_member_id.", '".$hashed_password."', '".$hashed_mail."', '".$hashed_mail."')";
		db_get_all($sql);
		//print "$sql<br>";

		// プロフィール追加
		$insert_list = get_prof_list($_REQUEST);

		foreach($insert_list as $value){
			if(!is_null($value['value'])){
				$sql="insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
				$sql.=$c_member_id.", ";
				$sql.=$value['c_profile_id'].", ";
				$sql.=$value['c_profile_option_id'].", ";
				$sql.="'".$value['value']."'";
				$sql.= ")";
				db_get_all($sql);
				//print "$sql<br>";
			}
		}


		// 固定仮想口座番号設定
		$sql = "select virtual_number from a_virtual_account_list where kotei=1 and flag = 0 and c_member_id = 0";
		$virtual = db_get_all($sql);
		$virtual = $virtual[0]['virtual_number'];

		if($virtual){
			$sql = "update a_virtual_account_list SET c_member_id = $c_member_id where virtual_number = '$virtual'";
			db_get_all($sql);

		}

	// if !c_member_id and !error
	}elseif($g_flag){
		// ゲスト情報上書き
		$sql = "update c_member SET nickname = '".$_POST['shimei']."' where c_member_id = $c_member_id";
		db_get_all($sql);
		//print "$sql<br>";
		// プロフィール消去
		$sql = "delete from c_member_profile where c_member_id = $c_member_id";
		db_get_all($sql);

		// プロフィール追加
		$insert_list = get_prof_list($_REQUEST);

		foreach($insert_list as $value){
			if(!is_null($value['value'])){
				$sql="insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
				$sql.=$c_member_id.", ";
				$sql.=$value['c_profile_id'].", ";
				$sql.=$value['c_profile_option_id'].", ";
				$sql.="'".$value['value']."'";
				$sql.= ")";
				db_get_all($sql);
				//print "$sql<br>";
			}
		}


	}

	// 予約データ準備
	$begin_datetime = $_POST['begin_datetime'];

	$finish_datetime = $_POST['finish_datetime'];

// 24時を23時59分に変換
$finish_data = split(' ', $finish_datetime);

if($finish_data[1] == "24:00:00"){
			$finish_datetime = $finish_data[0]." "."23:59:59";
}

	$room_price = $_POST['room_price'];
	$vessel_price = $_POST['vessel_price'];
	$service_price = $_POST['service_price'];
	$total_price = $_POST['total_price'];
	$hall_id = $_POST['hall_id'];
	$room_id = $_POST['room_id'];
	$_POST['memo'] = preg_replace("/'/", '\\\'', $_POST['memo']);
	$memo = $_POST['memo'];
	$_POST['message'] = preg_replace("/'/", '\\\'', $_POST['message']);
	$message = $_POST['message'];

	if($_POST['mail']){
		$mail = $_POST['mail'];
	}else{
		// メアド取得
		$sql = "select pc_address from c_member_secure where c_member_id =".$c_member_id;
		$result=db_get_all($sql);
		$mail = t_decrypt($result[0]['pc_address']);
	}
	// 備品リスト
	$vessel_rl = array();
	$key=0;
	for($x=0;$x < $_POST['vessel_num'];$x++){
		if($_POST['select_vessel'.$x]){
			$vessel_rl[$key]['vessel_id'] = $_POST['select_vessel'.$x];
			$vessel_rl[$key]['num'] = $_POST['remainder'.$x];
			$vessel_rl[$key]['price'] = get_vessel_price($_POST['select_vessel'.$x]);
			$key++;
		}
	}
	$service_rl = array();
	$key=0;
	for($x=0;$x < $_POST['service_num'];$x++){
		if($_POST['select_service'.$x]){
			$service_rl[$x]['service_id'] = $_POST['select_service'.$x];
			$service_rl[$x]['num'] = $_POST['service_remainder'.$x];
			$service_rl[$x]['price'] = get_service_price($_POST['select_service'.$x]);
			$key++;
		}
	}

	//var_dump($vessel_rl);
	//var_dump($service_rl);

	// 予約重複チェック
	if (check_reserve2($hall_id, $room_id, $begin_datetime, $finish_datetime)){
		//print "重複あり<br>";
		array_push($error, '時間の重複する予約が先に登録されています。');
	}else{
		// 備品在庫数チェック
		foreach($vessel_rl as $value){
			// 在庫数
			$sql = "select num from a_vessel_data where vessel_id = ".$value['vessel_id'];
			$zaiko = db_get_all($sql);
			$zaiko = $zaiko[0]['num'];
			// 時間帯のかぶっている他の予約
			$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' and '$finish_datetime') or (finish_datetime between '$begin_datetime' and '$finish_datetime') or ('$begin_datetime' between begin_datetime and finish_datetime))";
			$reserve_id_list = db_get_all($sql);
			// 予約数
			if($reserve_id_list){
				$sql = "select num from a_reserve_v where vessel_id = ".$value['vessel_id'];
				$sql.= " and (";
				foreach($reserve_id_list as $k=>$v){
					$sql.= "reserve_id = ".$v['reserve_id'];
					if($reserve_id_list[($k+1)]['reserve_id']){
						$sql.= " or ";
					}
				}
				$sql.= ")";
				$v_num = db_get_all($sql);
				$reserve_v_num = 0;
				foreach($v_num as $v){
					$reserve_v_num+=$v['num'];
				}
			}else{
				$reserve_v_num = 0;
			}
			//print "予約数：".$reserve_v_num."<br>";
			// 他の予約数＋今回予約数　>　在庫数 = 不足
			if (($reserve_v_num + $value['num']) > $zaiko){
				// 在庫不足
				array_push($error, '先に他の予約が入った為、備品の在庫が不足します。');
			}
		}// foreach
	}// 予約重複

	if($error){
		$this->set('error', $error);
		return 'success';
		exit();
	}


// メール本文


$sql = "select * from c_member where c_member_id = '$c_member_id'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($c_member_id, 12);
$address = get_profile_value($c_member_id, 3).get_profile_value($c_member_id, 14).get_profile_value($c_member_id, 15).get_profile_value($c_member_id, 16);

require_once('trmessage.inc.php');
$body = trmessage($corp,$nickname);

$body.= "<仮予約者情報>\n";
if(check_guest($c_member_id)){
	$body.= "■アカウント登録：ゲスト\n";
	$body.= "■お客様ID：".$c_member_id."\n";
}else{
	$body.= "■アカウント登録：会員\n";
	$body.= "■お客様ID：".$c_member_id."\n";
}
$body.= "■仮予約者名：".$nickname." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($c_member_id, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".date("Y年m月d日 H:i")."\n\n";

	// 登録
	// メイン
	$sql="insert into a_reserve_list (hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, room_price, vessel_price, service_price, total_price, people, purpose, kanban, memo, message, long_term) values ($hall_id, $room_id, $c_member_id, '$begin_datetime', '$finish_datetime', now(), $room_price, $vessel_price, $service_price, $total_price, ".$_POST['people'].", ".$_POST['purpose'].", '".mysql_real_escape_string($_POST['kanban'])."', '$memo', '$message', '".$_POST['long_term']."')";
	db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($begin_datetime);			/// 使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 税率適用日
	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2013.12.21 消費税改定対応 end

	//print "<br>$sql<br>";

	// 登録した予約ID
	$sql = "SELECT reserve_id FROM a_reserve_list where c_member_id = $c_member_id and hall_id = $hall_id and room_id = $room_id and begin_datetime = '$begin_datetime' and finish_datetime = '$finish_datetime' and cancel_flag = 0 order by reserve_id desc";
	$reserve_id = db_get_all($sql);
	$reserve_id = $reserve_id[0]['reserve_id'];

	// 備品
	foreach($vessel_rl as $value){
		$sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price) values (";
		$sql.= "$reserve_id, ".$value['vessel_id'].", ";

/// 2013.12.21 消費税改定対応 begin

		$tmp_price = $value['price'];			/// 備品使用料
		$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));
		$sql.= $value['num'].", ".$tmp_price;

/// 2013.12.21 消費税改定対応 end

		$sql.= ")";
		db_get_all($sql);
		//print "$sql<br>";
	}

	// サービス

	foreach($service_rl as $value){
		$sql ="insert into a_reserve_s (reserve_id, service_id, num, price) values (";
		$sql.="$reserve_id, ".$value['service_id'].", ";

/// 2013.12.21 消費税改定対応 begin

		$tmp_price = $value['price'];			/// サービス使用料
		$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));
		$sql.=$value['num'].", ".$tmp_price;

/// 2013.12.21 消費税改定対応 end

		$sql.=")";
		//print $sql."<br>";
		db_get_all($sql);
	}

	// 予約完了メール
// メール文言用変数
$dt = new DateTime($begin_datetime);
$week = get_week($dt->format("Ymd"));
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$date_s = $dt->format("Y-m-d");

$dt = new DateTime($finish_datetime);
$finish = $dt->format("H時i分");

$sql = "select * from a_room where hall_id = ".$hall_id." and room_id = ".$room_id;
$room_data = db_get_all($sql);
$room_data = $room_data[0];

//$max = max($room_data['num_school'], $room_data['num_mouth'], $room_data['num_theater']);

	$body.= "*********************************************\n";
	$body.= "<仮予約施設情報>\n";
	$body.= "■予約ID：".$reserve_id."\n";
	$body.= "■施設名：".get_hall_name($hall_id)."\n";
	$body.= "■ご利用目的：仮：".get_purpose_word($_POST['purpose'])."\n";
	$body.= "■看板表示：".$_POST['kanban']."\n";
	$body.= "■利用日：".$date."\n";
	$body.= "■人数：".$_POST['people']."名\n";
	$body.= "■部屋名（利用時間）\n";
	$body.= "・".get_room_name($hall_id, $room_id)."($begin ～ $finish)\n\n";
	$body.= "・施設料金：".number_format($room_price)." 円\n\n";

if($vessel_rl){
	$body.= "<仮予約備品情報>\n";
	foreach($vessel_rl as $v){
		$body.= "・".get_vessel_name($v['vessel_id'])."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($vessel_price)." 円\n\n";
}

if($service_rl){
	$body.= "<仮予約サービス品情報>\n";
	foreach($service_rl as $v){
		$body.= "・".get_service_name($v['service_id'])."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス料金：".number_format($service_price)." 円\n\n";
}

	$body.= "合計料金：".number_format($total_price)." 円\n";
	$body.= "*********************************************\n\n";

if($_POST['message']){
	$body.= "■メッセージ\n";
	// エスケープ解除
	$_POST['message'] = preg_replace("/\\\'/", '\'', $_POST['message']);
	$body.= $_POST['message']."\n\n";

}



	// 予約完了メール
	$source = get_c_template_mail_source('m_atoffice_aokari');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "★会議室の仮予約を承りました。";
	}

	$subject.= "【".get_hall_name($hall_id)."/".$date_s."/".$nickname."様】";

	$body.= $tmp_body;

if($_POST['mail_flag']==1){

	put_mail_queue($mail, $subject, $body);

	$sql = "select mailing_list from a_hall where hall_id = '$hall_id'";
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		put_mail_queue($ml, $subject, $body);
	}

}
	$dt = new DateTime($_POST['begin_datetime']);
	$year = $dt->format("Y");
	$month = $dt->format("m");
	$day = $dt->format("d");

	admin_client_redirect("set_reserve&hall_list=$hall_id&year=$year&month=$month&day=$day", '予約を登録しました。');

    }
}


?>
