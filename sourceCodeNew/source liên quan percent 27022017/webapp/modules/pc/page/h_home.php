<?php
/**
*@author: haipt
*@date: 2017-03-13
**/
if(isset($_REQUEST['page']) && $_REQUEST['page'] =='reserve_confirm')
{
	$u_member = db_member_c_member_secure4c_member_id($_REQUEST['uid']);
	$_REQUEST['u_email'] = $u_member['pc_address'];
	
}
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

class pc_page_h_home extends OpenPNE_Action
{
    function handleError($errors)
    {
        openpne_redirect('pc', 'page_h_home');
    }

    function execute($requests)
    {

/// 2013.12.21 消費税改定対応 begin

	$tmp_ymd = "";
	switch(true){
		case isset($_POST['year']):
			$tmp_yy   = $_POST['year'];		/// 会議室使用日の年
			$tmp_mm   = $_POST['month'];		/// 会議室使用日の月
			$tmp_dd   = $_POST['day'];		/// 会議室使用日の日
			$tmp_ymd  = $tmp_yy."-".$tmp_mm."-".$tmp_dd." 00:00:00";
			break;
		case isset($_POST["pre_id"]):
			$tmp_pre  = $_POST["pre_id"];		/// 仮予約ＩＤ
			$tmp_pid  = isset($_POST["pid"]) ? $_POST["pid"] : '';		/// 予約識別？
			$tmp_sql  = "select * from a_pre_reserve ";
			$tmp_sql .= "where pre_id = '$tmp_pre' and pid = '$tmp_pid'";
			$tmp_tab  = db_get_all($tmp_sql);
			$tmp_tab  = isset($tmp_tab[0]) ? $tmp_tab[0] : null;
			$tmp_ymd  = strtotime($tmp_tab['begin_datetime']);
			$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
			break;
	}
	if($tmp_ymd !== ""){
		$tmp_sql  = "";
		$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
		$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
		$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
		$tmp_sql .= "limit 0, 1";			/// 先頭１件
		$tmp_tab  = db_get_all($tmp_sql);
		$tmp_tab[0]['rate'] = isset($tmp_tab[0]['rate']) ? $tmp_tab[0]['rate'] : 0;
		$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率
	}

/// 2013.12.21 消費税改定対応 end

        $u = $GLOBALS['AUTH']->uid();

        $inc_navi = fetch_inc_navi('h');
        $this->set('inc_navi', $inc_navi);

        $OPTION = $this->get('C_MEMBER_CONFIG');

        /// infomation ///

        // 運営者からのおしらせ
        $this->set('site_info', p_common_c_siteadmin4target_pagename('h_home'));
        // メンバー情報
        $c_member = db_member_c_member_with_profile($u, 'private');
        $this->set('c_member', $c_member);
		//2017-03-14
		if(!empty($c_member) && !empty($c_member['c_member_id']))
		{
			$u_member = db_member_c_member_secure4c_member_id($c_member['c_member_id']);
			$_REQUEST['u_email'] = $u_member['pc_address'];
		}
/*
        if (OPENPNE_USE_POINT_RANK) {
            // ポイント
            $point = db_point_get_point($u);
            $this->set("point", $point);

            // ランク
            $this->set("rank", db_point_get_rank4point($point));
        }


        // 今日の日付、曜日
        $this->set('r_datetime', date('m/d'));
        $date = array('日','月','火','水','木','金','土');
        $this->set('r_datetime_date', $date[date('w')]);


        // API用セッションID
        $this->set('api_session_id', get_api_sessionid($u));

        // アクセス日時を記録
        db_member_do_access($u);

        // inc_entry_point
        $this->set('inc_entry_point', fetch_inc_entry_point($this->getView(), 'h_home'));
*/


	// at_office


	//var_dump($_SESSION);
	$_SESSION['u'] = $u;

	//var_dump($_REQUEST);
	//var_dump($requests);
	//print $requests['login_params'];


if(isset($_REQUEST['page']) && $_REQUEST['page']=="" || !isset($_REQUEST['page'])){
	$_REQUEST['page'] = 'vacant';
}

if(isset($_REQUEST['hid']) && $_REQUEST['hid']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['hid'])){
		$hall_id = $_REQUEST['hid'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
}else{
	$_REQUEST['hid'] = 3;
	$hall_id = 3;
}

if(isset($_REQUEST['rid']) && $_REQUEST['rid']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['rid'])){
		$room_id = $_REQUEST['rid'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
}else{
	$_REQUEST['rid'] = 1;
	$room_id = 1;
}

if(isset($_REQUEST['rid_c']) && $_REQUEST['rid_c']!=""){
	if(preg_match("/^[0-9]+$/", $_REQUEST['rid_c'])){
		$room_id = $_REQUEST['rid_c'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
}else{
	$_REQUEST['rid_c'] = 1;
	$room_id = 1;
}
// 有効になっている会場か
if($hall_id){
	$sql = "select flag from a_hall where hall_id = '$hall_id'";
	$flag = db_get_all($sql);
	if(isset($flag[0]['flag']) && $flag[0]['flag']==2){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
}

// 有効になっている部屋か
/*
if($hall_id and !is_null($room_id)){
	$sql = "select flag from a_room where hall_id = '$hall_id' and room_id = '$room_id'";
	$flag = db_get_all($sql);
	if($flag[0]['flag']==0){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
}
*/
	$this->set('hall_id', $hall_id);
	$this->set('room_id', $room_id);
	if(!empty($_REQUEST['mes'])){
		$this->set('mes', $_REQUEST['mes']);
	}


	if(!empty($_REQUEST['page'])){
		$page = $_REQUEST['page'];
		if($page=="reserve" && !isset($_REQUEST['pre_id'])) $_REQUEST['page']=$page="vacant";

		if($page=='error'){
			$php = "/error.php";
			$url = "";
		}elseif($page=='reserve_complete'){
			$php = "/reserve_complete.php";
			$url = "";
		}elseif($page=='vacant'){
			$url = "?hid=$hall_id&rid=$room_id";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
			//echo $url."<br>";
			$requests['login_params']=$url;
			$this->set('Calendar', 1);
			$this->set('schedule', 1);

		}elseif($page=='reserve' || $page=='customerdata'){
				$_REQUEST['pre_id'] = isset($_REQUEST['pre_id']) ? $_REQUEST['pre_id'] : '';
         		check_agency_price($_REQUEST['pre_id'], $u, $hall_id);
			$page="reserve"; $_REQUEST['page']=$page; 

			$url = "?hid=$hall_id&rid=$room_id&u=$u";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$this->set('Calendar', 1);
			$this->set('schedule', 1);
		}elseif($page=='reserve_edit'){
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
		}elseif($page=='reserve_list'){
			check_agency_price($_REQUEST['pre_id'], $u, $hall_id);
			$php = "/reserve_list.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

		}elseif($page=='reserve_service'){
			check_agency_price($_REQUEST['pre_id'], $u, $hall_id);
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
			$requests['login_params']=$url;
		}elseif($page=='reserve_vessel'){
			check_agency_price($_REQUEST['pre_id'], $u, $hall_id);
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
			$requests['login_params']=$url;

		}elseif($page=='reserved_info'){
			$php = "/reserved_info.php";
			$url = "?a=1";
			foreach($_POST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
		}elseif($page=='change_vessel'){
			if(check_reserve_id($_POST['reserve_id'], $u)){
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			$php = "/change_vessel.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
		}elseif($page=='change_vessel_confirm'){
			$php = "/change_vessel_confirm.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
		}elseif($page=='change_reserve'){
			if(check_reserve_id($_POST['reserve_id'], $u)){
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			$php = "/change_reserve.php";
			$url = "?a=1";

			$reserve_id = $_REQUEST['reserve_id'];

			if(!$hall_id and !$room_id){
			$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
			$reserve_data = db_get_all($sql, $db);
			$reserve_data = $reserve_data[0];

			$hall_id = $reserve_data['hall_id'];
			$room_id = $reserve_data['room_id'];

			$dt = new DateTime($reserve_data['begin_datetime']);
			$year = $dt->format("Y");
			$month = $dt->format("m");
			$day = $dt->format("d");

			}

			$url.="&hid=$hall_id&rid=$room_id&target_year=$year&target_month=$month";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}
			$this->set('Calendar2', 1);
		}elseif($page=='reserve_confirm'){
			check_agency_price($_REQUEST['pre_id'], $u, $hall_id);
			$php = "/reserve_confirm.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

			$url.="&c_member_id=$u";
		}elseif($page=='change_reserve_confirm'){
			if(check_pre_id($_REQUEST['pre_id'], $u)){
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			$php = "/change_reserve_confirm.php";
			$url = "?a=1";
			foreach($_REQUEST as $key=>$value){
				$url.="&$key=".urlencode($value);
			}

		}elseif($page=='do_yoyaku'){
/////////////////////////////////////////////////////////////////////////

//var_dump($_POST);
	if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
		$pre_id = $_POST['pre_id'];
	}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}

	$sql = "select * from a_pre_reserve where pre_id = '$pre_id' order by limit_datetime";
	$pre_data = db_get_all($sql);
	if(!$pre_data){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
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
		$this->set('mes', $mes);
		$page = array(
			"page" => "reserve",
			"hid" => $hall_id,
			"rid" => $room_id,
			"mes" => $mes,
			"pre_id" => $pre_id
		);

		openpne_redirect('pc', 'h_home', $page);
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
			openpne_redirect('pc', 'h_home', $page);
			exit();
		}
	}

	}
}// foreach

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$u;
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);

// メール本文


$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($u, 12);
$address = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

require_once("trmessage.inc.php");
$body = trmessage($corp,$nickname);

$body.= "<仮予約者情報>\n";
$body.= "■アカウント登録：会員\n";
$body.= "■お客様ID：".$u."\n";
$body.= "■仮予約者名：".$nickname." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($u, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".date("Y年m月d日 H:i")."\n\n";

	// 予約データ挿入

// メッセージのシングルクォートをエスケープ
//$_POST['message'] = ereg_replace("'", '\\\'', $_POST['message']);

$mailing_list = array();

foreach($pre_data as $key=>$value){
	// メイン
	$sql="insert into a_reserve_list (hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, room_price, vessel_price, service_price, total_price, people, purpose, kanban, message) values (".$value['hall_id'].", ".$value['room_id'].", $u, '".$value['begin_datetime']."', '".$value['finish_datetime']."', now(), ".$value['room_price'].", ".$value['vessel_price'].", ".$value['service_price'].", ".$value['total_price'].", ".$value['people'].", ".$value['purpose'].", '".mysql_real_escape_string($value['kanban'])."', '".mysql_real_escape_string($_POST['message'])."')";
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

if($_POST['message']){
	$body.= "■メッセージ\n";
	// エスケープ解除
//	$_POST['message'] = ereg_replace("\\\'", '\'', $_POST['message']);
	$body.= $_POST['message']."\n\n";

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
	openpne_redirect('pc', 'h_home', $page);




///////////////////////////////////////////////////////////////////////////////
		}elseif($page=='do_change_reserve'){

			// 予約変更
			//var_dump($_POST);

if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
	$pre_id = $_POST['pre_id'];
}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
}

$sql = "select * from a_pre_reserve where pre_id = '$pre_id'";
$pre_data = db_get_all($sql);
$pre_data = $pre_data[0];

if(!$pre_data){
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}

$reserve_id = $pre_data['reserve_id'];
$begin_datetime = $pre_data['begin_datetime'];
$finish_datetime = $pre_data['finish_datetime'];
$hall_id = $pre_data['hall_id'];
$room_id = $pre_data['room_id'];

// 予約変更済みか再チェック
$sql = "select change_flag from a_reserve_list where reserve_id = '$reserve_id'";
$change_flag = db_get_all($sql);
if($change_flag[0]['change_flag']>0){
	$mes="既に1回変更済みの為、変更できません。";
	$page = array(
		"page" => "reserved_info",
		"mes" => $mes
	);
	openpne_redirect('pc', 'h_home', $page);
}

			// 3営業日後
			$pay_limitdate = get_business_days(3);
			//print "<br>$pay_limitdate<br>";
			// 旧データ
			$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
			$old_rd = db_get_all($sql);
			$old_rd = $old_rd[0];
			// 備品データ取得
			$sql = "select * from a_reserve_v where reserve_id = $reserve_id";
			$reserve_v = db_get_all($sql);
			// 在庫不足確認
			if($reserve_v){
				foreach($reserve_v as $value){

// 利用できない備品を予約している
$sql = "select * from a_room_vessel where hall_id = '$hall_id' ";
$sql.= "and room_id = '$room_id' ";
$sql.= "and vessel_id = ".$value['vessel_id'];
$reserve_check = db_get_all($sql);
if(!$reserve_check){
	$mes="ご予約の変更ができませんでした。\n";
	$mes.="変更後の部屋で利用できない備品をご予約されています。\n";
	$mes.="(".get_vessel_name($value['vessel_id']).")\n";
	$mes.="備品の変更で該当する備品を取り消した後に再度変更を申し込んでください。";

$page = array(
	"page" => "reserved_info",
	"mes" => $mes
);

openpne_redirect('pc', 'h_home', $page);
}

					// 在庫数
					$sql = "select num from a_vessel_data where vessel_id = ".$value['vessel_id'];
					$zaiko = db_get_all($sql);
					$zaiko = $zaiko[0]['num'];
					// 時間帯のかぶっている他の予約
					$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and reserve_id != $reserve_id and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
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

			$mes="ご予約の変更ができませんでした。\n";
			$mes.="ご希望の日時では備品が不足のため、変更できませんでした。\n\n";
			$mes.="再度別の日程を指定してくださいますようよろしくお願いいたします。";

		$page = array(
			"page" => "reserved_info",
			"mes" => $mes
		);

		openpne_redirect('pc', 'h_home', $page);


					}// 在庫不足
				}//foreach
			}// $reserve_v

// 更新
$new_total_price = $pre_data['room_price']+$old_rd['vessel_price']+$old_rd['service_price'];
$room_price = $pre_data['room_price'];


// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$u;
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);

	//備品
	$sql = "select * from a_reserve_v where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_v_list = db_get_all($sql);
	foreach($reserve_v_list as $k=>$v){
		$vessel_data = get_vessel_data($v['vessel_id']);
		$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
		$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];
	}

	//サービス
	$sql = "select * from a_reserve_s where reserve_id = $reserve_id and cancel_flag = 0";
	$reserve_s_list = db_get_all($sql);
	foreach($reserve_s_list as $k=>$v){
		$service_data = get_service_data($v['service_id']);
		$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
		$reserve_s_list[$k]['memo'] = $service_data['memo2'];
	}

$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($u, 12);

$dt = new DateTime($old_rd['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$old_date = $dt->format("Y年m月d日");
$old_date = $old_date." ".$week."曜日";
$old_begin = $dt->format("H時i分");
$dt = new DateTime($old_rd['finish_datetime']);
$old_finish = $dt->format("H時i分");

$dt = new DateTime($begin_datetime);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$dt = new DateTime($finish_datetime);
$finish = $dt->format("H時i分");

if($old_rd['virtual_code']>0){
	$virtual_number = substr($old_rd['virtual_code'], 4, 10);
	$branch_id = substr($old_rd['virtual_code'], 0, 3);
	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_id'";
	$virtual_conf = db_get_all($sql);
	$virtual_conf = $virtual_conf[0];
}

// 3営業日後
$limitdate = get_business_days(3);
$dt = new DateTime($limitdate);
$limit = $dt->format("Y年m月d日");

// メール本文
$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "下記の通り、予約内容の変更を承りました。\n";
$body.= "変更後の予約内容をご確認ください。\n\n";

$body.= "**************************************************\n";
$body.= "【 変更前 】\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($old_rd['hall_id'])."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($old_rd['purpose'])."\n";
$body.= "■看板表示：".$old_rd['kanban']."\n";
$body.= "■利用日：".$old_date."\n";
$body.= "■人数：".$old_rd['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($old_rd['hall_id'], $old_rd['room_id'])."($old_begin ～ $old_finish)\n\n";
$body.= "・施設料金：".number_format($old_rd['room_price'])." 円\n\n";
if($reserve_v_list){
	$body.= "<仮予約備品情報>\n";
	foreach($reserve_v_list as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($old_rd['vessel_price'])." 円\n\n";
}
if($reserve_s_list){
	$body.= "<仮予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス品料金：".number_format($old_rd['service_price'])." 円\n\n";
}
$body.= "■合計料金：".number_format($old_rd['total_price'])." 円\n\n";

$body.= "【 変更後 】\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($hall_id)."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($pre_data['purpose'])."\n";
$body.= "■看板表示：".$old_rd['kanban']."\n";
$body.= "■利用日：".$date."\n";
$body.= "■人数：".$pre_data['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($hall_id, $room_id)."($begin ～ $finish)\n\n";
$body.= "・施設料金：".number_format($room_price)." 円\n\n";
if($reserve_v_list){
	$body.= "<仮予約備品情報>\n";
	foreach($reserve_v_list as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($old_rd['vessel_price'])." 円\n\n";
}
if($reserve_s_list){
	$body.= "<仮予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス品料金：".number_format($old_rd['service_price'])." 円\n\n";
}

$body.= "■合計料金：".number_format($new_total_price)." 円\n";

$body.= "************************************************\n\n";

if($old_rd['message']){
	$body.= "■メッセージ\n";
	$body.= $old_rd['message']."\n\n";

}
if($old_rd['virtual_code']>0){
	$body.= "<お支払内容>\n";
	$body.= "■お振込金額　　：　".number_format($new_total_price)."円（税込）\n";
	$body.= "■お振込期限　　：　".$limit."\n";
	$body.= "■お振込先口座  ：　".$virtual_conf['bank']."　".$virtual_conf['branch']."　普通　".$virtual_number."\n";
	$body.= "■口座名義人　  ：　".$virtual_conf['account']."\n\n";
}

// 請求
// 入金前
$sql = "update a_reserve_list SET ";
$sql.= "change_flag = 1, ";
$sql.= "change_datetime = now(), ";
$sql.= "room_id = '$room_id', ";
$sql.= "people = '".$pre_data['people']."', ";
$sql.= "purpose = '".$pre_data['purpose']."', ";
$sql.= "begin_datetime = '$begin_datetime', ";
$sql.= "finish_datetime = '$finish_datetime', ";
$sql.= "pay_limitdate = '$pay_limitdate', ";
$sql.= "room_price = '".$pre_data['room_price']."', ";
$sql.= "total_price = '$new_total_price' ";
$sql.= "where reserve_id = $reserve_id";
db_get_all($sql);



	// preデータ消去
	$sql = "delete from a_pre_reserve where pre_id = '$pre_id'";
	db_get_all($sql);


	// 変更通知メール
	$source = get_c_template_mail_source('m_atoffice_change_reserve');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "予約変更を承りました。";
	}
	$subject.= "【".get_hall_name($hall_id)."/".$date_s."/".$nickname."様】";

	$body.= $tmp_body;


	put_mail_queue($mail, $subject, $body);

	// メーリングリスト取得
	$sql = "select mailing_list from a_hall where hall_id = '$hall_id'";
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		put_mail_queue($ml, $subject, $body);
	}

			$mes = "予約情報を更新し、通知メールを送信しましたので、ご確認ください。";


		$page = array(
			"page" => "reserved_info",
			"mes" => $mes
		);

		openpne_redirect('pc', 'h_home', $page);

		}elseif($page=="do_cancel_reserve"){
//////////////////////////////////////////////////////////////////////////////
			//var_dump($_REQUEST);

			$reserve_id = $_REQUEST['reserve_id'];
			$cancel = get_cancel_price($reserve_id);

$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];

			// キャンセル済みか再確認
			if($reserve_data['cancel_flag']>0){
				$mes="既にキャンセル済みになっています。";
				$page = array(
					"page" => "reserved_info",
					"mes" => $mes
				);
				openpne_redirect('pc', 'h_home', $page);
			}

			// キャンセルする
			$sql = "update a_reserve_list SET ";
			$sql.= "cancel_flag = 1, ";
			$sql.= "virtual_code = 0, ";
			$sql.= "cancel_datetime = now() ";
			$sql.= "where reserve_id = '$reserve_id'";
			db_get_all($sql);

			// バーチャル口座の利用終了
			$check = check_virtual_code($reserve_data['virtual_code'], $reserve_id);
			if($check==0){
				$sql = "update a_virtual_account_list SET flag=0 where virtual_number = '".$reserve_data['virtual_code']."' and c_member_id = '$u'";
				db_get_all($sql);
			}

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$u;
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);

//備品
$sql = "select * from a_reserve_v where reserve_id = $reserve_id and cancel_flag = 0";
$reserve_v_list = db_get_all($sql);
foreach($reserve_v_list as $k=>$v){
	$vessel_data = get_vessel_data($v['vessel_id']);
	$reserve_v_list[$k]['vessel_name'] = $vessel_data['vessel_name'];
	$reserve_v_list[$k]['memo'] = $vessel_data['memo2'];
}

//サービス
$sql = "select * from a_reserve_s where reserve_id = $reserve_id and cancel_flag = 0";
$reserve_s_list = db_get_all($sql);
foreach($reserve_s_list as $k=>$v){
	$service_data = get_service_data($v['service_id']);
	$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
	$reserve_s_list[$k]['memo'] = $service_data['memo2'];
}

$sql = "select * from c_member where c_member_id = '$u'";
$nickname = db_get_all($sql);
$nickname = $nickname[0]['nickname'];

$corp = get_profile_value($u, 12);
$address = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

$dt = new DateTime($reserve_data['tmp_reserve_datetime']);
$tmp_date = $dt->format("Y年m月d日 H:i");

$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "下記予約のキャンセルを受け付けました。\n";
$body.= "この変更により、規定のキャンセル料金が発生いたします。\n";
$body.= "内容をご確認ください。\n";
//$body.= "ご返金およびご請求が発生する場合は弊社より別途ご連絡させていただきます。\n\n";

$body.= "**************************************************\n";
$body.= "<予約者情報>\n";
$body.= "■お客様ID：".$u."\n";
$body.= "■仮予約者名：".$nickname." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($u, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".$tmp_date."\n";
$body.= "■キャンセル受付日時：".date("Y年m月d日 H:i")."\n\n";
$body.= "■ キャンセル料率：".$cancel['percent']."％\n";
if($reserve_data['tmp_flag']==1){
	$body.= "(仮予約のキャンセルは無料です。)\n";
}else{
	if($cancel['before']>0){
		$body.= "(ご利用予定日の".$cancel['before']."日前キャンセルのため)\n";
	}elseif($cancel['before']==0){
		$body.= "(ご利用予定日当日キャンセルのため)\n";
	}elseif($cancel['before']<0){
		$body.= "(ご利用予定日から".($cancel['before']*-1)."日経過後キャンセルのため)\n";
	}
}
$body.= "■キャンセル料金：".number_format($cancel['cancel_price'])." 円\n";
$body.= "■キャンセル特記事項：お客様都合によりキャンセル\n\n";

$body.= "■入金済み金額：".number_format($reserve_data['pay_money'])." 円\n";

			if($reserve_data['pay_money'] > $cancel['cancel_price']){
				// 返金
				$repay = $reserve_data['pay_money'] - $cancel['cancel_price'];
				$billed_money = $cancel['cancel_price'];
				$virtual_number = get_virtual_number($u);
				// キャンセル請求テーブルにキャンセル料支払済みとして登録
$sql = "delete from a_amount_billed where reserve_id = '$reserve_id' and flag = '0'";
db_get_all($sql);
$limitdate = get_business_days(3);
$sql = "insert into a_amount_billed (reserve_id, total_billed_money, info, virtual_code, pay_limitdate, add_datetime, flag, check_datetime, pay_money) values ($reserve_id, $billed_money, 'キャンセル料金（入金後キャンセルの為、既に入金済）', $virtual_number, '$limitdate', now(), 1, now(), $billed_money)";
db_get_all($sql);

				// 返金リストに差額を登録

				$sql = "delete from a_repayment_list where reserve_id = '$reserve_id' and flag = '0'";
				db_get_all($sql);
				$sql = "insert into a_repayment_list (reserve_id, repayment_money, info, add_datetime) values ($reserve_id, $repay, '入金後キャンセルの差額', now())";
				db_get_all($sql);

				$body.="■差額返金額：".number_format($repay)." 円\n\n";

			}elseif($reserve_data['pay_money'] < $cancel['cancel_price'] and $reserve_data['tmp_flag']==0){

				// 請求
				$billed_money = $cancel['cancel_price'] - $reserve_data['pay_money'];
				$virtual_number = get_virtual_number($u);
				if(!$virtual_number){
					print "error: 振込口座番号が発行できませんでした。<br>";
					exit(1);
				}
				// 口座番号登録
				$sql = "update a_virtual_account_list SET flag = '1', c_member_id = '$u' where virtual_number = '$virtual_number'";
				db_get_all($sql);
				// 請求リスト登録
				$sql = "delete from a_amount_billed where reserve_id = '$reserve_id' and flag = '0'";
				db_get_all($sql);

$limitdate = get_business_days(3);

				$sql = "insert into a_amount_billed (reserve_id, total_billed_money, pay_money, info, virtual_code, pay_limitdate, add_datetime) values ($reserve_id, ".$cancel['cancel_price'].", ".$reserve_data['pay_money'].", 'キャンセル料金', $virtual_number, '$limitdate', now())";
				db_get_all($sql);

		$sql = "select billed_id from a_amount_billed where reserve_id = '$reserve_id'";
		$billed_id = db_get_all($sql);
		$billed_id = $billed_id[0]['billed_id'];
		// 請求番号取得
		$bill_id = get_bill_id(0, $billed_id);

		if(!$bill_id){
			admin_client_redirect("$page&reserve_id=$reserve_id", '新規請求番号が取得できませんでした。');
			exit();
		}


		$sql = "update a_amount_billed SET ";
		$sql.= "bill_id = '$bill_id' ";
		$sql.= "where billed_id = '$billed_id'";
		db_get_all($sql);

// 3営業日後
$dt = new DateTime($limitdate);
$limit = $dt->format("Y年m月d日");

$virtual = substr($virtual_number, 4, 10);
$branch_id = substr($virtual_number, 0, 3);
$sql = "select * from a_virtual_account_conf where branch_id = '$branch_id'";
$virtual_conf = db_get_all($sql);
$virtual_conf = $virtual_conf[0];

$body.="■キャンセル料金請求金額：".number_format($cancel['cancel_price'])." 円\n";
$body.="■残り：".number_format($billed_money)." 円(税込)\n";
$body.= "■お振込期限　　：　".$limit."\n";
$body.= "■お振込先口座  ：　".$virtual_conf['bank']."　".$virtual_conf['branch']."　普通　".$virtual."\n";
$body.= "■口座名義人　  ：　".$virtual_conf['account']."\n\n";

			}else{

$billed_money = $cancel['cancel_price'];
$virtual_number = get_virtual_number($u);
// キャンセル請求テーブルにキャンセル料支払済みとして登録
$sql = "delete from a_amount_billed where reserve_id = '$reserve_id' and flag = '0'";
db_get_all($sql);
$limitdate = get_business_days(3);
$sql = "insert into a_amount_billed (reserve_id, total_billed_money, info, virtual_code, pay_limitdate, add_datetime, flag, check_datetime, pay_money) values ($reserve_id, $billed_money, 'キャンセル料金（入金後キャンセルの為、既に入金済）', $virtual_number, '$limitdate', now(), 1, now(), $billed_money)";
db_get_all($sql);

$body.= "・入金額とキャンセル料金との差額はございません。\n\n";
			}

$body.= "--------------------------------------------------\n";
$body.= "<予約施設情報>\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($reserve_data['hall_id'])."\n";
	$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
	$body.= "■看板表示：".$reserve_data['kanban']."\n";
	$body.= "■利用日：".$date."\n";

	$body.= "■人数：".$reserve_data['people']."名\n";
	$body.= "■部屋名（利用時間）\n";
	$body.= "・".get_room_name($reserve_data['hall_id'], $reserve_data['room_id'])."($begin ～ $finish)\n\n";
	$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";

if($reserve_v_list){
	$body.= "<仮予約備品情報>\n";
	foreach($reserve_v_list as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($reserve_data['vessel_price'])." 円\n\n";
}
if($reserve_s_list){
	$body.= "<仮予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス品料金：".number_format($reserve_data['service_price'])." 円\n\n";
}

	$body.= "合計料金：".number_format($reserve_data['total_price'])." 円\n";
	$body.= "************************************************\n\n";

			// 変更通知メール
	$source = get_c_template_mail_source('m_atoffice_user_cancel');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "予約キャンセルを承りました。";
	}

	$subject.= "【".get_hall_name($reserve_data['hall_id'])."/".$date_s."/".$nickname."様】";

	$body.= $tmp_body;

	put_mail_queue($mail, $subject, $body);


	// メーリングリスト取得
	$sql = "select mailing_list from a_hall where hall_id = ".$reserve_data['hall_id'];
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		put_mail_queue($ml, $subject, $body);
	}


			$mes = "ご予約をキャンセルし、通知メールを送信いたしましたのでご確認ください。";
			$page = array(
				"page" => "reserved_info",
				"mes" => $mes
			);

			openpne_redirect('pc', 'h_home', $page);

		}elseif($page=="do_change_vessel"){
//////////////////////////////////////////////////////////////////////////////
//var_dump($_POST);

if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
	$pre_id = $_POST['pre_id'];
}else{
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
}

$sql = "select * from a_pre_reserve where pre_id = '$pre_id'";
$pre_data = db_get_all($sql);
$pre_data = $pre_data[0];

if($u!=$pre_data['c_member_id']){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
}

$reserve_id = $pre_data['reserve_id'];

$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
$reserve_data = db_get_all($sql, $db);
$reserve_data = $reserve_data[0];

// 入金済み確認
if($reserve_data['pay_money']>0){
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}

$hall_id = $reserve_data['hall_id'];
$room_id = $reserve_data['room_id'];
$begin_datetime = $reserve_data['begin_datetime'];
$finish_datetime = $reserve_data['finish_datetime'];

$sql = "select * from a_pre_rv where pre_id = '$pre_id' order by weight desc";
$reserve_v = db_get_all($sql);

//var_dump($reserve_v);


	// 在庫不足再確認

	if($reserve_v){
		foreach($reserve_v as $value){

			// 在庫数
			$sql = "select num from a_vessel_data where vessel_id = ".$value['vessel_id'];
			$zaiko = db_get_all($sql);
			$zaiko = $zaiko[0]['num'];
			// 時間帯のかぶっている他の予約
			$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
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
				$mes = get_vessel_name($value['vessel_id'])."の在庫数が不足のため、変更できませんでした。";
				$page = array(
					"page"=>"change_vessel_confirm",
					"pre_id"=>$pre_id,
					"mes"=>$mes
					);

				openpne_redirect('pc', 'h_home', $page);

				return 'success';
				exit();
			}
		}// foreach
	}// if($reserve_v)

// 旧備品データ
$sql = "select * from a_reserve_v where reserve_id = '$reserve_id'";
$old_rv = db_get_all($sql);


	// 備品データ削除
	$sql = "delete from a_reserve_v where reserve_id = '$reserve_id'";
	db_get_all($sql);


	if($reserve_v){
		foreach($reserve_v as $key=>$value){
			$vessel_data = get_vessel_data($value['vessel_id']);
			$reserve_v[$key]['vessel_name'] = $vessel_data['vessel_name'];
			$vessel_id = $value['vessel_id'];
			$price = $value['price'];
			$num = $value['num'];
			$sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price, cancel_flag) values ($reserve_id, $vessel_id, $num, $price, 0)";
			//print "$sql<br>";
			db_get_all($sql);
		}
	}
	$vessel_new_price = $pre_data['vessel_price'];
	$total_new_price = $pre_data['total_price'];

	if($old_rv){
		foreach($old_rv as $key=>$value){
			$vessel_data = get_vessel_data($value['vessel_id']);
			$old_rv[$key]['vessel_name'] = $vessel_data['vessel_name'];
		}
	}

	//print "$vessel_new_price ---- $total_new_price";

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$u;
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);

// 3営業日後
$limitdate = get_business_days(3);
$dt = new DateTime($limitdate);
$limit = $dt->format("Y年m月d日");

// 予約データ
$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];

$hall_id = $reserve_data['hall_id'];
$room_id = $reserve_data['room_id'];

// 会員情報
$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
$c_member = db_get_all($sql);
$c_member = $c_member[0];
// プロフィール
$corp = get_profile_value($reserve_data['c_member_id'], 12);

//サービス
$sql = "select * from a_reserve_s where reserve_id = $reserve_id and cancel_flag = 0";
$reserve_s_list = db_get_all($sql);
foreach($reserve_s_list as $k=>$v){
	$service_data = get_service_data($v['service_id']);
	$reserve_s_list[$k]['service_name'] = $service_data['service_name'];
	$reserve_s_list[$k]['memo'] = $service_data['memo2'];
}

$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

if($reserve_data['virtual_code']>0){
	$virtual_number = substr($reserve_data['virtual_code'], 4, 10);
	$branch_id = substr($reserve_data['virtual_code'], 0, 3);
	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_id'";
	$virtual_conf = db_get_all($sql);
	$virtual_conf = $virtual_conf[0];
}

// メール本文
	$body = $corp."\n";
	$body.= $c_member['nickname']." 様\n\n";
	$body.= "下記の通り、ご予約のオプション備品およびサービスを変更いたしました。\n";
	$body.= "内容をご確認ください。\n\n";

$body.= "**************************************************\n";
$body.= "【 変更前 】\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($reserve_data['hall_id'])."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
$body.= "■看板表示：".$reserve_data['kanban']."\n";
$body.= "■利用日：".$date."\n";
$body.= "■人数：".$reserve_data['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($reserve_data['hall_id'], $reserve_data['room_id'])."($begin ～ $finish)\n\n";
$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";
if($old_rv){
	$body.= "<仮予約備品情報>\n";
	foreach($old_rv as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($reserve_data['vessel_price'])." 円\n\n";
}
if($reserve_s_list){
	$body.= "<仮予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス品料金：".number_format($reserve_data['service_price'])." 円\n\n";
}
$body.= "■合計料金：".number_format($reserve_data['total_price'])." 円\n\n";

$body.= "【 変更後 】\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($hall_id)."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
$body.= "■看板表示：".$reserve_data['kanban']."\n";
$body.= "■利用日：".$date."\n";
$body.= "■人数：".$reserve_data['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($hall_id, $room_id)."($begin ～ $finish)\n\n";
$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";
if($reserve_v){
	$body.= "<仮予約備品情報>\n";
	foreach($reserve_v as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($vessel_new_price)." 円\n\n";
}
if($reserve_s_list){
	$body.= "<仮予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\nサービス品料金：".number_format($reserve_data['service_price'])." 円\n\n";
}

$body.= "■合計料金：".number_format($total_new_price)." 円\n";

$body.= "************************************************\n\n";

if($reserve_data['message']){
	$body.= "■メッセージ\n";
	$body.= $reserve_data['message']."\n\n";

}
if($reserve_data['virtual_code']>0){
	$body.= "<お支払内容>\n";
	$body.= "■お振込金額　　：　".number_format($total_new_price)."円（税込）\n";
	$body.= "■お振込期限　　：　".$limit."\n";
	$body.= "■お振込先口座  ：　".$virtual_conf['bank']."　".$virtual_conf['branch']."　普通　".$virtual_number."\n";
	$body.= "■口座名義人　  ：　".$virtual_conf['account']."\n\n";
}

	// 予約データ更新
	// 請求
	$sql = "update a_reserve_list SET ";
	$sql.= "vessel_price = '$vessel_new_price', ";
	$sql.= "total_price = '$total_new_price', ";
	$sql.= "pay_flag = '0' ";
	$sql.= "where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 変更通知メール
	$source = get_c_template_mail_source('m_atoffice_change_vessel');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "備品の予約内容を変更いたしました。";
	}
	$subject.= "【".get_hall_name($hall_id)."/".$date_s."/".$c_member['nickname']."様】";


	$body.= $tmp_body;

	put_mail_queue($mail, $subject, $body);

	// メーリングリスト取得
	$sql = "select mailing_list from a_hall where hall_id = '$hall_id'";
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		put_mail_queue($ml, $subject, $body);
	}

	$mes = "備品の予約内容を変更しました。";

	$page = array(
		"page" => "reserved_info",
		"mes" => $mes
	);

	openpne_redirect('pc', 'h_home', $page);

		}elseif($page=='do_pre_reserve_set' or $page=='do_pre_change_set'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_POST);

// 既に変更済みでないか再確認
if($page=='do_pre_change_set'){
	if(!preg_match("/^[0-9]+$/", $_POST['reserve_id'])){
		$page = array("page"=>"error");
		openpne_redirect('pc', 'h_home', $page);
	}
	$reserve_id = $_POST['reserve_id'];
	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
	$result = db_get_all($sql);
	if($result[0]['change_flag']){
		$msg = "既に１回以上変更済みのため、変更できません。";
		$page = array(
			"mes" => $mes
		);
		openpne_redirect('pc', 'h_home', $page);
	}
}

			$pre_id = $_POST['pre_id'];
			if(!$pre_id){
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}

if($page=='do_pre_change_set'){
	// 変更の場合１つのデータのみなので現在のpre_idを削除
	$sql = "delete from a_pre_reserve where pre_id = '$pre_id'";
	db_get_all($sql);
}

			$hall_id = $_POST['hid'];
			$room_id = $_POST['rid'];

			$begin_datetime = $_POST['year']."-".$_POST['month']."-".$_POST['day']." ".$_POST['reserve_begin_time'].":00";

// 24時を23時59分に変換
if($_POST['reserve_finish_time']=="24:00"){
			$finish_datetime = $_POST['year']."-".$_POST['month']."-".$_POST['day']." "."23:59:59";
}else{
			$finish_datetime = $_POST['year']."-".$_POST['month']."-".$_POST['day']." ".$_POST['reserve_finish_time'].":00";
}

// print $finish_datetime;

	// 同じ時間の多重登録を削除
	$sql = "delete from a_pre_reserve where pre_id = '$pre_id' ";
	$sql.= "and hall_id = '$hall_id' ";
	$sql.= "and room_id = '$room_id' ";
	$sql.= " and ((begin_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or (finish_datetime between '$begin_datetime' + INTERVAL 1 second and '$finish_datetime' - INTERVAL 1 second) or ('$begin_datetime' + INTERVAL 1 second between begin_datetime and finish_datetime))";
	db_get_all($sql);

	$sql = "insert into a_pre_reserve (pre_id, hall_id, room_id, begin_datetime, finish_datetime, room_price, total_price, purpose, limit_datetime, people, kanban";
    if($page=='do_pre_change_set'){
		$sql.= ", reserve_id, c_member_id";
	}else{
        $sql.= ", agency_flag";
    }
	$sql.= ") values (";
	$sql.= "'$pre_id', ";
	$sql.= "'$hall_id', ";
	$sql.= "'$room_id', ";
	$sql.= "'$begin_datetime', ";
	$sql.= "'$finish_datetime', ";
	$sql.= "'".$_POST['reserve_price']."', ";
	$sql.= "'".$_POST['reserve_price']."', ";
	$sql.= "'".$_POST['purpose']."', ";
	$sql.= "NOW() + INTERVAL 3 hour, ";
	$sql.= "'".$_POST['people']."',";
	$sql.= "'".mysql_real_escape_string($_REQUEST['kanban'])."'";
	if($page=='do_pre_change_set'){
		$sql.= ", '".$_POST['reserve_id']."', ";
		$sql.= "'$u'";
	}else{
        $sql.=", '".$_POST['agency_flag']."'";
    }
	$sql.= ")";
	db_get_all($sql);

	if($page=='do_pre_reserve_set'){
		$page = array(
			"page"=>"reserve_list",
			"hid"=>$hall_id,
			"rid"=>$room_id,
			"year"=>$_POST['year'],
			"month"=>$_POST['month'],
			"day"=>$_POST['day'],
			"pre_id"=>$pre_id
			);
	}elseif($page=='do_pre_change_set'){
		$page = array(
			"page"=>"change_reserve_confirm",
			"pre_id"=>$pre_id
			);
	}

			openpne_redirect('pc', 'h_home', $page);
			exit();
		}elseif($page=='do_pre_reserve_edit'){
////////////////////////////////////////////////////////////////////////////
//			var_dump($_REQUEST);
//	exit();
			

			$pre_id = $_REQUEST['pre_id'];
			if(!$pre_id){
				exit();
			}

	$sql = "update a_pre_reserve set kanban='".mysql_real_escape_string($_REQUEST['kanban']).
		"',people=".$_REQUEST['people'].",purpose=".$_REQUEST['purpose'].
		" where pid=".$_REQUEST['pid'];
//	echo $sql;
	db_get_all($sql);

			$page = array(
				"page"=>"reserve_list",
				"hid"=>$hall_id,
				"rid"=>$room_id,
				"pre_id"=>$pre_id
				);

//			var_dump($_REQUEST);
			openpne_redirect('pc', 'h_home', $page);
			exit();
		}elseif($page=='do_pre_delete'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_REQUEST);
			if($_REQUEST['del_id']){
				$pid = $_REQUEST['del_id'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			$hall_id = $_REQUEST['hid'];
			$room_id = $_REQUEST['rid'];
			$pre_id = $_REQUEST['pre_id'];

			$sql = "delete from a_pre_reserve where pid = '$pid'";
			db_get_all($sql);

			$sql = "select count(*) from a_pre_reserve where pre_id = $pre_id";
			$dat=db_get_all($sql);
			$rest=$dat[0]['count(*)'];

			$back=$_REQUEST['back'];
			if(!$rest) $back="reserve";

//			var_dump($dat);
//			echo $back." ".$rest." ".$pre_id." ".$pid."<br>";
//			exit();

			$page = array(
				"page"=>$back,
				"hid"=>$hall_id,
				"rid"=>$room_id,
				"year"=>$_REQUEST['year'],
				"month"=>$_REQUEST['month'],
				"day"=>$_REQUEST['day'],
				"pre_id"=>$pre_id
				);

			openpne_redirect('pc', 'h_home', $page);

			exit();

		}elseif($page=='do_set_reserve_v'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_POST);

			if(preg_match("/^[0-9]+$/", $_POST['pid'])){
				$pid = $_POST['pid'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
				$pre_id = $_POST['pre_id'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}

// pid と pre_idが合っているか
$sql = "select * from a_pre_reserve where pid = '$pid' and pre_id = '$pre_id'";
$pre_data = db_get_all($sql);
$pre_data = $pre_data[0];
if(is_null($pre_data)){
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}
			if(preg_match("/^[0-9]+$/", $_POST['vessel_num'])){
				$vessel_num = $_POST['vessel_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			if(preg_match("/^[0-9]+$/", $_POST['service_num'])){
				$service_num = $_POST['service_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}

$vessel_list = array();
$key=0;
$vessel_price = 0;
for($x=0;$x<$vessel_num;$x++){
	if($_POST['select_vessel'.$x]){
		$vessel_list[$key]['vessel_id']=$_POST['select_vessel'.$x];
		$vessel_list[$key]['vessel_num']=$_POST['remainder'.$x];
		$sql = "select vessel_name, price,weight from a_vessel_data where vessel_id = ".$_POST['select_vessel'.$x];
		$result = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

		$tmp_price = $result[0]['price'];			/// 備品使用料
		$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
		$result[0]['price'] = $tmp_price;			/// 書き戻し

/// 2013.12.21 消費税改定対応 end

		$vessel_list[$key]['vessel_data']=$result[0];
		$vessel_price += $result[0]['price'] * $_POST['remainder'.$x];
		$key++;
	}
}

$total_price = $pre_data['room_price']+$vessel_price;

// pre登録
$sql = "update a_pre_reserve SET ";
$sql.= "vessel_price = '$vessel_price', ";
$sql.= "total_price = service_price+$total_price ";
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

			$page = array(
				"page"=>"reserve_list",
				"pre_id"=>$pre_id
				);

			openpne_redirect('pc', 'h_home', $page);

			exit();

		}elseif($page=='do_set_reserve_s'){
////////////////////////////////////////////////////////////////////////////
			//var_dump($_POST);

			if(preg_match("/^[0-9]+$/", $_POST['pid'])){
				$pid = $_POST['pid'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
				$pre_id = $_POST['pre_id'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}

// pid と pre_idが合っているか
$sql = "select * from a_pre_reserve where pid = '$pid' and pre_id = '$pre_id'";
$pre_data = db_get_all($sql);
$pre_data = $pre_data[0];
if(is_null($pre_data)){
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}
			if(preg_match("/^[0-9]+$/", $_POST['vessel_num'])){
				$vessel_num = $_POST['vessel_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}
			if(preg_match("/^[0-9]+$/", $_POST['service_num'])){
				$service_num = $_POST['service_num'];
			}else{
				$page = array("page"=>"error");
				openpne_redirect('pc', 'h_home', $page);
			}

$service_list = array();
$key=0;
$service_price = 0;
for($x=0;$x<$service_num;$x++){
	if($_POST['select_service'.$x]){
		$service_list[$key]['service_id']=$_POST['select_service'.$x];
		$service_list[$key]['service_num']=$_POST['service_remainder'.$x];
		$sql = "select service_name, price,weight from a_service_data where service_id = ".$_POST['select_service'.$x];
		$result = db_get_all($sql, $db);

/// 2013.12.21 消費税改定対応 begin

		$tmp_price = $result[0]['price'];			/// サービス使用料
		$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
		$result[0]['price'] = $tmp_price;			/// 書き戻し

/// 2013.12.21 消費税改定対応 end

		$service_list[$key]['service_data']=$result[0];
		$service_price += $result[0]['price'] * $_POST['service_remainder'.$x];
		$key++;
	}
}
$total_price = $pre_data['room_price']+$service_price;

// pre登録
$sql = "update a_pre_reserve SET ";
$sql.= "service_price = '$service_price', ";
$sql.= "total_price = vessel_price+$total_price ";
$sql.= "where pid = '$pid' and pre_id = '$pre_id'";
//print "$sql<br>";
db_get_all($sql);

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

			openpne_redirect('pc', 'h_home', $page);

			exit();

		}elseif($page=='do_change_set_v'){
////////////////////////////////////////////////////////////////////////////
//var_dump($_POST);

if(preg_match("/^[0-9]+$/", $_POST['pre_id'])){
	$pre_id = $_POST['pre_id'];
}else{
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}

if(preg_match("/^[0-9]+$/", $_POST['reserve_id'])){
	$reserve_id = $_POST['reserve_id'];
}else{
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}

if(preg_match("/^[0-9]+$/", $_POST['vessel_list_num'])){
	$vessel_num = $_POST['vessel_list_num'];
}else{
	$page = array("page"=>"error");
	openpne_redirect('pc', 'h_home', $page);
}

// 予約データ
$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];

/// 2013.12.21 消費税改定対応 begin

$tmp_ymd  = strtotime($reserve_data['begin_datetime']);
$tmp_ymd  = date('Y-m-d 00:00:00', $tmp_ymd);
$tmp_sql  = "";
$tmp_sql .= "select rate from a_tax ";		/// 消費税率テーブル
$tmp_sql .= "where stadate <= '$tmp_ymd' ";	/// 適用開始日
$tmp_sql .= "order by stadate desc ";		/// 適用開始日の降順
$tmp_sql .= "limit 0, 1";			/// 先頭１件
$tmp_tab  = db_get_all($tmp_sql);
$tmp_tax  = $tmp_tab[0]['rate'] / 100;		/// 消費税率

/// 2013.12.21 消費税改定対応 end

$vessel_list = array();
$key=0;
$vessel_price = 0;
for($x=0;$x<$vessel_num;$x++){
	if($_POST['vessel_id'.$x]){
		$vessel_list[$key]['vessel_id']=$_POST['vessel_id'.$x];
		$vessel_list[$key]['vessel_num']=$_POST['num'.$x];
		$sql = "select vessel_name, price,weight from a_vessel_data where vessel_id = ".$_POST['vessel_id'.$x];
		$result = db_get_all($sql, $db);
		$vessel_list[$key]['vessel_data']=$result[0];

/// 2013.12.21 消費税改定対応 begin

		$tmp_price = $result[0]['price'];			/// 備品使用料
		$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
		$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
		$vessel_price += $tmp_price*$_POST['num'.$x];

/// 2013.12.21 消費税改定対応 end

		$key++;
	}
}
//print "<br><br>";
//var_dump($vessel_list);
$new_total = $reserve_data['room_price'] + $vessel_price + $reserve_data['service_price'];

// pre登録

$sql = "delete from a_pre_reserve where pre_id = '$pre_id'";

db_get_all($sql);
$sql = "insert into a_pre_reserve (pre_id, vessel_price, total_price, reserve_id, c_member_id) values (";
$sql.= "'$pre_id', ";
$sql.= "'$vessel_price', ";
$sql.= "'$new_total', ";
$sql.= "'$reserve_id', ";
$sql.= "'$u'";
$sql.= ")";
db_get_all($sql);

// pre備品消去
$sql = "delete from a_pre_rv where pid = '0' and pre_id = '$pre_id'";
db_get_all($sql);

foreach($vessel_list as $value){
	$sql = "insert into a_pre_rv (pid, pre_id, vessel_id, num, price, limit_datetime, weight) values (";
	$sql.= "'0', ";
	$sql.= "'$pre_id', ";
	$sql.= "'".$value['vessel_id']."', ";
	$sql.= "'".$value['vessel_num']."', ";

/// 2013.12.21 消費税改定対応 begin

	$tmp_price = $value['vessel_data']['price'];		/// 備品使用料
	$tmp_price = round($tmp_price * 100 / 105);		/// 本体価格
	$tmp_price = round($tmp_price * (1 + $tmp_tax));	/// 税込み価格
	$sql.= "'".$tmp_price."', ";

/// 2013.12.21 消費税改定対応 end

	$sql.= "NOW() + INTERVAL 3 hour, ";
	$sql.= "'".$value['vessel_data']['weight']."'";
	$sql.= ")";
	//print "$sql<br>";
	db_get_all($sql);
}



$page = array(
	"page"=>"change_vessel_confirm",
	"pre_id"=>$pre_id
	);

openpne_redirect('pc', 'h_home', $page);

exit();

/////////////////////////////////////////////////////////////////////////
		}else{
			//$pageがない
			$page = array("page"=>"error");
			openpne_redirect('pc', 'h_home', $page);
		}// $page

		$this->set('url', $url);
		$this->set('page', $page);


	}elseif(!empty($requests['login_params'])){
		$list = explode('&', $requests['login_params']);

		foreach($list as $value){
			$get = explode('=', $value);
			if ($get[0]=="hid" and $get[1]){
				$this->set('hall_id', $get[1]);
			}
			if ($get[0]=="rid" and $get[1]){
				$this->set('room_id', $get[1]);
			}
		}
	}




        return 'success';
    }

    function get_calendar($u, $week, $start_day)
    {
        include_once 'Calendar/Week.php';
        $w = intval($week);
        if (empty($w)) {
            $w = 0;
        }
        $this->set('w', $w);
        $time = strtotime($w . ' week');
        $Week = new Calendar_Week(date('Y', $time), date('m', $time), date('d', $time), $start_day);
        $Week->build();
        $calendar = array();
        $dayofweek = array('日','月','火','水','木','金','土');
        $i = $start_day;
        $dayofweek = array_merge($dayofweek,
            array_slice($dayofweek, 0, ($start_day + 1)));
        while ($Day = $Week->fetch()) {
            $y = $Day->thisYear();
            $m = $Day->thisMonth();
            $d = $Day->thisDay();
            $birth = db_member_birth4c_member_id($m, $d, $u);
            $item = array(
                'year'=> $y,
                'month'=>$m,
                'day' => $d,
                'dayofweek'=>$dayofweek[$i++],
                'now' => false,
                'birth' => $birth,
                'event' => db_commu_event4c_member_id($y, $m, $d, $u),
                'schedule' => db_schedule_c_schedule_list4date($y, $m, $d, $u),
                'holiday' => db_c_holiday_list4date($m, $d),
            );
            if ($w == 0 && $d == date('d')) {
                $item['now'] = true;
            }
            $calendar[] = $item;
        }
        return $calendar;
    }
}


function check_agency_price($pre_id, $u, $hall_id = null){
    //仮データ取得
    $sql = "select * from a_pre_reserve where pre_id = '$pre_id' and agency_flag = '0'";
    $pre_data = db_get_all($sql);
    if(!empty($pre_data)){
        $sql = "select * from a_agency where c_member_id = '$u'";
        $result = db_get_all($sql);
        $result = isset($result[0]) ? $result[0] : null;
        if(!empty($result)){
        	$percent = 0;
        	$flag = 0;
        	if($agency['type'] == 1){
				$hallListId = !empty($agency['hall_list']) ? json_decode($agency['hall_list'],true) : null;
				if(!empty($hallListId[$hall_id])){
					$percent = $hallListId[$hall_id];
					$flag = 1;
				}				
			}elseif($agency['percent']){
				$percent = $agency['percent'];
				$flag = 1;
			}
			if($flag){
				foreach($pre_data as $value){
	                $waribiki_price = round($value['room_price'] - ($value['room_price'] * $result['percent'] * 0.01));
	                $total_price = $waribiki_price + $value['vessel_price'] + $value['service_price'];

	                $sql = "update a_pre_reserve SET room_price = '$waribiki_price', total_price = '$total_price', agency_flag = '1' where pid = ".$value['pid'];
	                db_get_all($sql);

	            }
			}
        }
    }

    return;

}

?>
