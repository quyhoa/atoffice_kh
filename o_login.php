<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_o_login extends OpenPNE_Action
{
    function isSecure()
    {
        return false;
    }

    function execute($requests)
    {
        if (LOGIN_URL_PC && !DISPLAY_LOGIN) {
            client_redirect_absolute(LOGIN_URL_PC);
        }
	//var_dump($_REQUEST);
	//print $requests['login_params'];

if(!$_REQUEST['page'] or $_REQUEST['page']=="reserved_info"){
	$_REQUEST['page'] = 'reserve';
}

if($_REQUEST['hid']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['hid'])){
		$hall_id = $_REQUEST['hid'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
	}
}else{
	$_REQUEST['hid'] = "3";
	$hall_id = "3";
}


if($_REQUEST['rid']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['rid'])){
		$room_id = $_REQUEST['rid'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
	}
}else{
	$_REQUEST['rid'] = "1";
	$room_id = "1";
}


if($_REQUEST['rid_c']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['rid_c'])){
		$room_id = $_REQUEST['rid_c'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
	}
}else{
	$_REQUEST['rid_c'] = "1";
	$room_id = "1";
}

// 有効になっている会場か
if($hall_id){
	$sql = "select flag from a_hall where hall_id = '$hall_id'";
	$flag = db_get_all($sql);
	if($flag[0]['flag']==2){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
	}
}

// 有効になっている部屋か
/*
if($room_id!=""){
	$sql = "select flag from a_room where hall_id = '$hall_id' and room_id = '$room_id'";
	$flag = db_get_all($sql);
	if($flag[0]['flag']==0){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
	}
}
*/

//var_dump($_REQUEST);


	$this->set('hall_id', $hall_id);
	$this->set('room_id', $room_id);

	if($_REQUEST['mes']){
		$this->set('mes', $_REQUEST['mes']);
	}

	if($_REQUEST['page']){
		$page = $_REQUEST['page'];
		if($page=='error'){
			$php = "/error.php";
			$url = "";
		}elseif($page=='reserved_info'){
			$page = "";
		}elseif($page=='reserve_complete'){
			$php = "/reserve_complete.php";
			$url = "";
		}elseif($page=='reserve'){
			$php = "/room_reserve.php";
			$url = "?hid=$hall_id&rid=$room_id";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$requests['login_params']=$url;
			$this->set('Calendar', 1);
			$this->set('schedule', 1);

		}elseif($page=='search'){
			$php = "/search.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
			$requests['login_params']=$url;

		}elseif($page=='reserve_list'){
			$php = "/reserve_list.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
            $requests['login_params']=$url;
		}elseif($page=='reserve_service'){
			$php = "/reserve_service.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$requests['login_params']=$url;

		}elseif($page=='reserve_confirm'){

			$php = "/reserve_confirm.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$requests['login_params']=$url;



		}elseif($page=='do_yoyaku'){
////////////////////////////////////////////////////////////////////////////

	// 予約データ準備
	if(preg_match("/^[0-9]+$/", $_REQUEST['pre_id'])){
		$pre_id = $_REQUEST['pre_id'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
		exit(1);
	}

	$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
	$pre_data = db_get_all($sql);
	if(!$pre_data){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'o_login', $page);
		exit(1);
	}

			// ゲスト情報チェック
			if(!$_REQUEST['shimei']){
				$msg="氏名を入力してください";
			}elseif(!mb_ereg("^[ア-ン　]+$", $_REQUEST['kana'])){
				$msg="フリガナを全角カタカナで入力してください";
			}elseif(!$_REQUEST['riyo']){
				$msg="利用形態を選択してください";
			}elseif(!$_REQUEST['daihyou']){
				$msg="法人/団体名を入力してください";
			}elseif(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_REQUEST['mail'])){
				$msg="有効なメールアドレスを入力してください";
			}elseif($_REQUEST['zip']!="" and !preg_match("/^\d{3}\-\d{4}$/", $_REQUEST['zip'])){
				$msg="郵便番号をﾊｲﾌﾝ付き半角数字で入力して下さい";
			}elseif(!$_REQUEST['address_city']){
				$msg="市区町村を入力してください";
			}elseif(!$_REQUEST['address_banchi']){
				$msg="番地を入力してください";
			}elseif(!preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_REQUEST['tel'])){
				$msg="電話番号をﾊｲﾌﾝ付き半角数字で入力して下さい";
			}elseif($_REQUEST['fax']){
				if(!preg_match("/^\d{2,5}-\d{1,4}-\d{4}$/", $_REQUEST['fax'])){
				$msg="FAXをﾊｲﾌﾝ付き半角数字で入力して下さい";
				}

			}



			if ($msg){

				$page="reserve_confirm";
				$php = "/reserve_confirm.php";
				$url = "?a=1";
				$_REQUEST['page'] = "reserve_confirm";
				foreach($_REQUEST as $key=>$value){
					$url.="&$key=".urlencode($value);
				}

				$url.="&msg=".urlencode($msg);

				$requests['login_params']=$url;

				$this->set('requests', $requests);
				$this->set('url', $url);
				$this->set('page', $page);

			        //---- inc_ テンプレート用 変数 ----//
			        $this->set('inc_page_header', fetch_inc_page_header('public'));
			        $this->set('INC_PAGE_HEADER', db_banner_get_top_banner(false));
			        $this->set('IS_CLOSED_SNS', IS_CLOSED_SNS);
			        $this->set('top_banner_html_before', p_common_c_siteadmin4target_pagename('top_banner_html_before'));
			        $this->set('top_banner_html_after', p_common_c_siteadmin4target_pagename('top_banner_html_after'));

			        $this->set('inc_page_footer',
			            p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
			        return 'success';

			}else{

// すべての入力フィールドのシングルクォートをエスケープ
$_REQUEST['shimei'] = ereg_replace("'", '\\\'', $_REQUEST['shimei']);
$_REQUEST['kana'] = ereg_replace("'", '\\\'', $_REQUEST['kana']);
$_REQUEST['daihyou'] = ereg_replace("'", '\\\'', $_REQUEST['daihyou']);
$_REQUEST['busho'] = ereg_replace("'", '\\\'', $_REQUEST['busho']);
$_REQUEST['address_city'] = ereg_replace("'", '\\\'', $_REQUEST['address_city']);
$_REQUEST['address_banchi'] = ereg_replace("'", '\\\'', $_REQUEST['address_banchi']);
$_REQUEST['address_build'] = ereg_replace("'", '\\\'', $_REQUEST['address_build']);


// ゲストユーザー登録
// メールアドレスが既に登録されているか
	$mail = $_REQUEST['mail'];
	$hashed_mail = t_encrypt($mail);
	//print $hashed_mail."<br>";
	$sql = "select c_member_id from c_member_secure where pc_address = '".$hashed_mail."'";
	$regist=db_get_all($sql);
	if($regist[0]['c_member_id']){
		//print "アドレスあり<br>";
		$u = $regist[0]['c_member_id'];
		//print $c_member_id."<br>";

// ブラックリストに登録されているか////////////

$sql = "select * from c_blacklist where c_member_id = '$u'";
$black_flag = db_get_all($sql);
if($black_flag[0]['c_blacklist_id']){
	$mes = "お客さまからのご予約受け付けは停止中のため、ご予約を受け付けできませんでした。";
	$page = array(
		"mes" => $mes,
	);

	openpne_redirect('pc', 'o_login', $page);
	exit();
}

///////////////////////////////////////////////

		// ゲストか
		$sql = "select guest_flag from c_member where c_member_id = $u";
		$guest_flag = db_get_all($sql);
		if($guest_flag[0]['guest_flag']==1){

			// ユーザー情報更新
			$sql = "update c_member SET nickname='".$_REQUEST['shimei']."', ";
			$sql.= "birth_year=2000, ";
			$sql.= "birth_month=1, ";
			$sql.= "birth_day=1, ";
			$sql.= "u_datetime=now() where c_member_id = $u";
			db_get_all($sql);

			// プロフィール更新
			$insert_list = get_prof_list($_REQUEST);
			foreach($insert_list as $value){
				if(!is_null($value['value'])){
					$sql="delete from c_member_profile where c_member_id=$u and c_profile_id=".$value['c_profile_id'];
					db_get_all($sql);
					$sql="insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
					$sql.=$u.", ";
					$sql.=$value['c_profile_id'].", ";
					$sql.=$value['c_profile_option_id'].", ";
					$sql.="'".$value['value']."'";
					$sql.= ")";
					db_get_all($sql);
				}else{
					$sql="delete from c_member_profile where c_member_id=$u and c_profile_id=".$value['c_profile_id'];
					db_get_all($sql);
				}
			}
		}else{  // guest_flag
			// ゲストでないユーザーがゲストから予約

			$msg = "入力されたメールアドレスはアカウント登録されているため、ゲストからは予約できません。\nログインをしてから予約を行ってください。";

			$page="reserve_confirm";
			$php = "/reserve_confirm.php";
			$url = "?a=1";
			$_REQUEST['page'] = "reserve_confirm";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$url.="&msg=".urlencode($msg);

			$requests['login_params']=$url;

			$this->set('requests', $requests);
			$this->set('url', $url);
			$this->set('page', $page);

		        //---- inc_ テンプレート用 変数 ----//
		        $this->set('inc_page_header', fetch_inc_page_header('public'));
		        $this->set('INC_PAGE_HEADER', db_banner_get_top_banner(false));
		        $this->set('IS_CLOSED_SNS', IS_CLOSED_SNS);
		        $this->set('top_banner_html_before', p_common_c_siteadmin4target_pagename('top_banner_html_before'));
		        $this->set('top_banner_html_after', p_common_c_siteadmin4target_pagename('top_banner_html_after'));

		        $this->set('inc_page_footer',
		            p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
		        return 'success';

		}

	}else{
		//print "アドレスなし<br>";

		// c_member 追加
		$sql = "insert into c_member (nickname, birth_year, birth_month, birth_day, r_date, is_login_rejected, guest_flag) values (";
		$sql.= "'".$_REQUEST['shimei']."', ";
		$sql.= "2000, ";
		$sql.= "1, ";
		$sql.= "1, ";
		$sql.= "now(), 1, 1)";
		db_get_all($sql);

		$sql = "SELECT c_member_id FROM c_member where nickname = ";
		$sql.= "'".$_REQUEST['shimei']."'  and ";
		$sql.= "(r_date  BETWEEN (NOW() - INTERVAL 1 minute) AND NOW())";
		$c_member_id = db_get_all($sql);
		$u = $c_member_id[0]['c_member_id'];

		//print $c_member_id."<br>";

		// c_member_secure 追加
		$hashed_password = md5('guest');
		$sql = "insert into c_member_secure (c_member_id, hashed_password, pc_address, regist_address) values (";
		$sql.= $u.", '".$hashed_password."', '".$hashed_mail."', '".$hashed_mail."')";
		db_get_all($sql);

		// プロフィール追加
		$insert_list = get_prof_list($_REQUEST);

		foreach($insert_list as $value){
			if(!is_null($value['value'])){
				$sql="insert into c_member_profile (c_member_id, c_profile_id, c_profile_option_id, value) values (";
				$sql.=$u.", ";
				$sql.=$value['c_profile_id'].", ";
				$sql.=$value['c_profile_option_id'].", ";
				$sql.="'".$value['value']."'";
				$sql.= ")";
				db_get_all($sql);

			}
		}

		// 固定仮想口座番号設定
		$sql = "select virtual_number from a_virtual_account_list where kotei=1 and flag = 0 and c_member_id = 0";
		$virtual = db_get_all($sql);
		$virtual = $virtual[0]['virtual_number'];

		if($virtual){
			$sql = "update a_virtual_account_list SET c_member_id = $u where virtual_number = '$virtual'";
			db_get_all($sql);

		}


	}




foreach($pre_data as $key=>$value){
	// 予約データ重複確認
	$hall_id = $value['hall_id'];
	$room_id = $value['room_id'];
	$begin_datetime=$value['begin_datetime'];
	$finish_datetime=$value['finish_datetime'];

	// 備品リスト
	$sql = "select * from a_pre_rv where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$vessel_rl = db_get_all($sql);
	//var_dump($vessel_rl);

	// サービスリスト
	$sql = "select * from a_pre_rs where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$service_rl = db_get_all($sql);

	// 予約重複チェック
	if (check_reserve($hall_id, $room_id, $begin_datetime, $finish_datetime)){
		//print "重複あり<br>";
		$mes ="ご予約が確定できませんでした。(予約：".($key+1).")\n";
		$mes.="お客様が仮予約を確定する前に、先にご予約を確定したお客様がいらっしゃった為、\nご希望の日程でのご予約受け付けはできませんでした。\n\n";
		$mes.="お手数ではございますが、再度別の日程を指定してくださいますようよろしくお願いいたします。\n";
		$page = array(
			"page" => "reserve",
			"hid" => $hall_id,
			"rid" => $room_id,
			"mes" => $mes,
			"pre_id" => $pre_id
		);

		openpne_redirect('pc', 'o_login', $page);
		exit();

	}else{

		// 備品在庫数チェック
		foreach($vessel_rl as $vv){
			// 在庫数
			$sql = "select num from a_vessel_data where vessel_id = ".$vv['vessel_id'];
			$zaiko = db_get_all($sql);
			$zaiko = $zaiko[0]['num'];
			// 時間帯のかぶっている他の予約
			$reserve_v_num = get_reserve_vessel($hall_id, $room_id, $begin_datetime, $finish_datetime, $vv['vessel_id']);
			$reserve_pre_vessel_num = get_pre_rv($hall_id, $room_id, $begin_datetime, $finish_datetime, $vv['vessel_id'], $value['pre_id']);

			// 予約数合算
			$reserve_v_num += $reserve_pre_vessel_num;

			//print "予約数：".$reserve_v_num."<br>";
			// 他の予約数＋今回予約数　>　在庫数 = 不足
			if (($reserve_v_num + $vv['num']) > $zaiko){
				// 在庫不足
				$mes="ご予約が確定できませんでした。(在庫不足：".get_vessel_name($vv['vessel_id']).")\n";
				$mes.="お客様が仮予約を確定する前に、先にご予約を確定したお客様が\n同じ備品を選択していため、ご希望の備品が在庫不足となりました。\n\n";
				$mes.="お手数ではございますが、備品を減らしていただくか再度別の日程を指定してくださいますよう\nよろしくお願いいたします。";
				$page = array(
					"page" => "reserve_service",
					"mes" => $mes,
					"pre_id" => $pre_id,
					"pid" => $value['pid']
				);
				openpne_redirect('pc', 'o_login', $page);
				exit();
			}//if
		}// foreach
	}

}// foreach


$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($u, 12);
$address = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

require_once("trmessage.inc.php");
$body = trmessage($corp,$nickname);

$body.= "<仮予約者情報>\n";
$body.= "■アカウント登録：ゲスト\n";
$body.= "■お客様ID：".$u."\n";
$body.= "■仮予約者名：".$nickname." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($u, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".date("Y年m月d日 H:i")."\n\n";

	// 予約データ挿入

// メッセージのシングルクォートをエスケープ
$_REQUEST['message'] = ereg_replace("'", '\\\'', $_REQUEST['message']);

$mailing_list = array();

foreach($pre_data as $key=>$value){
	// メイン
	$sql="insert into a_reserve_list (hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, room_price, vessel_price, service_price, total_price, people, purpose, kanban, message) values (".$value['hall_id'].", ".$value['room_id'].", ".$u.", '".$value['begin_datetime']."', '".$value['finish_datetime']."', now(), ".$value['room_price'].", ".$value['vessel_price'].", ".$value['service_price'].", ".$value['total_price'].", ".$value['people'].", ".$value['purpose'].", '".$value['kanban']."', '".$_REQUEST['message']."')";
	db_get_all($sql);

	$sql = "SELECT reserve_id FROM a_reserve_list where c_member_id = $u and hall_id = ".$value['hall_id']." and room_id = ".$value['room_id']." and begin_datetime = '".$value['begin_datetime']."' and finish_datetime = '".$value['finish_datetime']."' and cancel_flag = 0 order by reserve_id desc";

	$reserve_id = db_get_all($sql);
	$reserve_id = $reserve_id[0]['reserve_id'];

	// 備品リスト
	$sql = "select * from a_pre_rv where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$vessel_rl = db_get_all($sql);
	//var_dump($vessel_rl);

	// サービスリスト
	$sql = "select * from a_pre_rs where pid = '".$value['pid']."' and pre_id = '$pre_id' order by weight desc";
	$service_rl = db_get_all($sql);

	// 備品
	foreach($vessel_rl as $v){
		$sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price) values (";
		$sql.= "$reserve_id, ".$v['vessel_id'].", ";
		$sql.= $v['num'].", ".$v['price'];
		$sql.= ")";
		db_get_all($sql);
	}

	// サービス
	foreach($service_rl as $v){
		$sql ="insert into a_reserve_s (reserve_id, service_id, num, price) values (";
		$sql.="$reserve_id, ".$v['service_id'].", ";
		$sql.=$v['num'].", ".$v['price'];
		$sql.=")";
		//print $sql."<br>";
		db_get_all($sql);
	}

// メール文言用変数
$dt = new DateTime($value['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");

$dt = new DateTime($value['finish_datetime']);
$finish = $dt->format("H時i分");

$sql = "select * from a_room where hall_id = ".$value['hall_id']." and room_id = ".$value['room_id'];
$room_data = db_get_all($sql);
$room_data = $room_data[0];

//$max = max($room_data['num_school'], $room_data['num_mouth'], $room_data['num_theater']);

	$body.= "***************** 予約:".($key+1)." *****************\n";
	$body.= "<仮予約施設情報>\n";
	$body.= "■予約ID：".$reserve_id."\n";
	$body.= "■施設名：".get_hall_name($value['hall_id'])."\n";
	$body.= "■ご利用目的：仮：".get_purpose_word($value['purpose'])."\n";
	$body.= "■看板表示：".$value['kanban']."\n";
	$body.= "■利用日：".$date."\n";
	$body.= "■人数：".$value['people']."名\n";
	$body.= "■部屋名（利用時間）\n";
	$body.= "・".get_room_name($value['hall_id'], $value['room_id'])."($begin ～ $finish)\n\n";
	$body.= "・施設料金：".number_format($value['room_price'])." 円\n\n";

if($vessel_rl){
	$body.= "<仮予約備品情報>\n";
	foreach($vessel_rl as $v){
		$body.= "・".get_vessel_name($v['vessel_id'])."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($value['vessel_price'])." 円\n\n";
}

if($service_rl){
	$body.= "<仮予約サービス品情報>\n";
	foreach($service_rl as $v){
		$body.= "・".get_service_name($v['service_id'])."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス料金：".number_format($value['service_price'])." 円\n\n";
}

	$body.= "合計料金：".number_format($value['total_price'])." 円\n";
	$body.= "*********************************************\n\n";

	// メーリングリスト取得
	$sql = "select mailing_list from a_hall where hall_id = ".$value['hall_id'];
	$ml = db_get_all($sql);
	if($ml){
		if(!in_array($ml[0]['mailing_list'], $mailing_list)){
			array_push($mailing_list, $ml[0]['mailing_list']);
		}
	}

}// foreach

if($_REQUEST['message']){
	$body.= "■メッセージ\n";
	// エスケープ解除
	$_REQUEST['message'] = ereg_replace("\\\'", '\'', $_REQUEST['message']);
	$body.= $_REQUEST['message']."\n\n";

}

// 予約期間取得
$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by begin_datetime";
$result = db_get_all($sql);

foreach($result as $key=>$value){
	if($key==0){
		$dt = new DateTime($value['begin_datetime']);
		$date_s = $dt->format("Y-m-d");
	}
	$dt = new DateTime($value['begin_datetime']);
	$date_e = $dt->format("Y-m-d");
}

if($date_s != $date_e){
	$date_s = $date_s." ～ ".$date_e;
}


	// preデータ消去
	$sql = "delete from a_pre_reserve where pre_id = '$pre_id'";
	db_get_all($sql);
	$sql = "delete from a_pre_rv where pre_id = '$pre_id'";
	db_get_all($sql);
	$sql = "delete from a_pre_rs where pre_id = '$pre_id'";
	db_get_all($sql);

	// メアド取得
	$sql = "select pc_address from c_member_secure where c_member_id =".$u;
	$result=db_get_all($sql);
	$mail = t_decrypt($result[0]['pc_address']);


	// 予約完了メール
	$source = get_c_template_mail_source('m_atoffice_kari');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "会議室の仮予約を承りました。";
	}

	$subject.= "【".get_hall_name($value['hall_id'])."/".$date_s."/".$nickname."様】";

	$body.= $tmp_body;


	put_mail_queue($mail, $subject, $body);

	// メーリングリストにも送信
	if($mailing_list){
		foreach($mailing_list as $mail){
			put_mail_queue($mail, $subject, $body);
		}
	}

	$page = array("page"=>"reserve_complete");
	openpne_redirect('pc', 'o_login', $page);

			}

		}elseif($page=='do_pre_reserve_set'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_REQUEST);

			$pre_id = $_REQUEST['pre_id'];
			if(!$pre_id){
				exit();
			}
			$hall_id = $_REQUEST['hid'];
			$room_id = $_REQUEST['rid'];
			$begin_datetime = $_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['day']." ".$_REQUEST['reserve_begin_time'].":00";
// 24時を23時59分に変換
if($_REQUEST['reserve_finish_time']=="24:00"){
			$finish_datetime = $_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['day']." "."23:59:59";
}else{
			$finish_datetime = $_REQUEST['year']."-".$_REQUEST['month']."-".$_REQUEST['day']." ".$_REQUEST['reserve_finish_time'].":00";
}


	// 同じ時間の多重登録を削除
	$sql = "delete from a_pre_reserve where pre_id = '$pre_id' ";
	$sql.= "and hall_id = '$hall_id' ";
	$sql.= "and room_id = '$room_id' ";
	$sql.= " and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	db_get_all($sql);


	$sql = "insert into a_pre_reserve (pre_id, hall_id, room_id, begin_datetime, finish_datetime, room_price, total_price, purpose, limit_datetime, people) values (";
	$sql.= "'$pre_id', ";
	$sql.= "'$hall_id', ";
	$sql.= "'$room_id', ";
	$sql.= "'$begin_datetime', ";
	$sql.= "'$finish_datetime', ";
	$sql.= "'".$_REQUEST['reserve_price']."', ";
	$sql.= "'".$_REQUEST['reserve_price']."', ";
	$sql.= "'".$_REQUEST['purpose']."', ";
	$sql.= "NOW() + INTERVAL 3 hour, ";
	$sql.= "'".$_REQUEST['people']."'";
	$sql.= ")";
	db_get_all($sql);

			$page = array(
				"page"=>"reserve",
				"hid"=>$hall_id,
				"rid"=>$room_id,
				"year"=>$_REQUEST['year'],
				"month"=>$_REQUEST['month'],
				"day"=>$_REQUEST['day'],
				"pre_id"=>$pre_id
				);

			openpne_redirect('pc', 'o_login', $page);
			exit();
		}elseif($page=='do_pre_delete'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_REQUEST);
			if($_REQUEST['del_id']){
				$pid = $_REQUEST['del_id'];
			}else{
				exit();
			}
			$hall_id = $_REQUEST['hid'];
			$room_id = $_REQUEST['rid'];
			$pre_id = $_REQUEST['pre_id'];

			$sql = "delete from a_pre_reserve where pid = '$pid'";
			db_get_all($sql);

			$page = array(
				"page"=>"reserve",
				"hid"=>$hall_id,
				"rid"=>$room_id,
				"year"=>$_REQUEST['year'],
				"month"=>$_REQUEST['month'],
				"day"=>$_REQUEST['day'],
				"pre_id"=>$pre_id
				);

			openpne_redirect('pc', 'o_login', $page);

			exit();


		}elseif($page=='do_set_reserve_vsk'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_REQUEST);

			if(preg_match("/^[0-9]+$/", $_REQUEST['pid'])){
				$pid = $_REQUEST['pid'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'o_login', $page);
			}
			if(preg_match("/^[0-9]+$/", $_REQUEST['pre_id'])){
				$pre_id = $_REQUEST['pre_id'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'o_login', $page);
			}
			$kanban = $_REQUEST['kanban'];
			// シングルクォートエスケープ
			$kanban = ereg_replace("'", '\\\'', $kanban);

// pid と pre_idが合っているか
$sql = "select * from a_pre_reserve where pid = '$pid' and pre_id = '$pre_id'";
$pre_data = db_get_all($sql);
$pre_data = $pre_data[0];
if(is_null($pre_data)){
	$page = array("page"=>"error");
	openpne_redirect('pc', 'o_login', $page);
}
			if(preg_match("/^[0-9]+$/", $_REQUEST['vessel_num'])){
				$vessel_num = $_REQUEST['vessel_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'o_login', $page);
			}
			if(preg_match("/^[0-9]+$/", $_REQUEST['service_num'])){
				$service_num = $_REQUEST['service_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'o_login', $page);
			}

$vessel_list = array();
$key=0;
$vessel_price = 0;
for($x=0;$x<$vessel_num;$x++){
	if($_REQUEST['select_vessel'.$x]){
		$vessel_list[$key]['vessel_id']=$_REQUEST['select_vessel'.$x];
		$vessel_list[$key]['vessel_num']=$_REQUEST['remainder'.$x];
		$sql = "select vessel_name, price,weight from at_office.a_vessel_data where vessel_id = ".$_REQUEST['select_vessel'.$x];
		$result = db_get_all($sql, $db);
		$vessel_list[$key]['vessel_data']=$result[0];
		$vessel_price += $result[0]['price'] * $_REQUEST['remainder'.$x];
        
		$key++;
	}
}
//print "<br><br>";
//var_dump($vessel_list);
//print "<br>".$vessel_price."円<br>";

$service_list = array();
$key=0;
$service_price = 0;
for($x=0;$x<$service_num;$x++){
	if($_REQUEST['select_service'.$x]){
		$service_list[$key]['service_id']=$_REQUEST['select_service'.$x];
		$service_list[$key]['service_num']=$_REQUEST['service_remainder'.$x];
		$sql = "select service_name, price,weight from at_office.a_service_data where service_id = ".$_REQUEST['select_service'.$x];
		$result = db_get_all($sql, $db);
		$service_list[$key]['service_data']=$result[0];
		$service_price += $result[0]['price'] * $_REQUEST['service_remainder'.$x];
		$key++;
	}
}
//print "<br><br>";
//var_dump($service_list);
//print "<br>".$service_price."円<br>";

$total_price = $pre_data['room_price']+$vessel_price+$service_price;
//print $total_price."円<br>";

// pre登録
$sql = "update a_pre_reserve SET ";
$sql.= "vessel_price = '$vessel_price', ";
$sql.= "service_price = '$service_price', ";
$sql.= "total_price = '$total_price', ";
$sql.= "kanban = '$kanban'";
$sql.= "where pid = '$pid' and pre_id = '$pre_id'";
//print "$sql<br>";
db_get_all($sql);

// pre備品消去
$sql = "delete from a_pre_rv where pid = '$pid' and pre_id = '$pre_id'";
db_get_all($sql);

foreach($vessel_list as $value){
	$sql = "insert into a_pre_rv (pid, pre_id, vessel_id, num, price, limit_datetime, weight) values (";
	$sql.= "'$pid', ";
	$sql.= "'$pre_id', ";
	$sql.= "'".$value['vessel_id']."', ";
	$sql.= "'".$value['vessel_num']."', ";
	$sql.= "'".$value['vessel_data']['price']."', ";
	$sql.= "NOW() + INTERVAL 3 hour, ";
    $sql.= "'".$value['vessel_data']['weight']."'";
	$sql.= ")";
	//print "$sql<br>";
	db_get_all($sql);
}

// preサービス消去
$sql = "delete from a_pre_rs where pid = '$pid' and pre_id = '$pre_id'";
db_get_all($sql);

foreach($service_list as $value){
	$sql = "insert into a_pre_rs (pid, pre_id, service_id, num, price, limit_datetime, weight) values (";
	$sql.= "'$pid', ";
	$sql.= "'$pre_id', ";
	$sql.= "'".$value['service_id']."', ";
	$sql.= "'".$value['service_num']."', ";
	$sql.= "'".$value['service_data']['price']."', ";
	$sql.= "NOW() + INTERVAL 3 hour, ";
	$sql.= "'".$value['service_data']['weight']."'";
	$sql.= ")";
	//print "$sql<br>";
	db_get_all($sql);
}

			$page = array(
				"page"=>"reserve_list",
				"pre_id"=>$pre_id
				);

			openpne_redirect('pc', 'o_login', $page);

			exit();


		}else{
			$page = array("page"=>"error");
			openpne_redirect('pc', 'o_login', $page);
		}// $page

		$this->set('url', $url);
		$this->set('page', $page);

	}elseif($requests['login_params']){
		$list = split('&', $requests['login_params']);

	}

	$this->set('requests', $requests);

        //---- inc_ テンプレート用 変数 ----//
        $this->set('inc_page_header', fetch_inc_page_header('public'));
        $this->set('INC_PAGE_HEADER', db_banner_get_top_banner(false));
        $this->set('IS_CLOSED_SNS', IS_CLOSED_SNS);
        $this->set('top_banner_html_before', p_common_c_siteadmin4target_pagename('top_banner_html_before'));
        $this->set('top_banner_html_after', p_common_c_siteadmin4target_pagename('top_banner_html_after'));

        $this->set('inc_page_footer',
            p_common_c_siteadmin4target_pagename('inc_page_footer_before'));
        return 'success';
    }
}


?>
