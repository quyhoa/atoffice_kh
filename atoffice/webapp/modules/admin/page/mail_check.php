<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_mail_check extends OpenPNE_Action
{
    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);
	//var_dump($_SESSION);

if($_REQUEST['msg']){
	$this->set('msg', $_REQUEST['msg']);
	return 'success';
}

	$reserve_id = $_REQUEST['reserve_id'];

	// 承認
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


	// 会場データ
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$hall_data = $hall_data[0];

	// 部屋データ
	$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql);
	$room_data = $room_data[0];

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

	// 会員情報
	$sql = "select * from c_member where c_member_id = ".$reserve_data['c_member_id'];
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];
	// プロフィール
	$corp = get_profile_value($reserve_data['c_member_id'], 12);
	$address = get_profile_value($reserve_data['c_member_id'], 3).get_profile_value($reserve_data['c_member_id'], 14).get_profile_value($reserve_data['c_member_id'], 15).get_profile_value($reserve_data['c_member_id'], 16);

	$tel = get_profile_value($reserve_data['c_member_id'], 17);

	// 仮予約日
	$dt = new DateTime($reserve_data['tmp_reserve_datetime']);
	$tmp = $dt->format("Y年m月d日 H時i分s秒");

	// メアド取得
	$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data['c_member_id'];
	$result=db_get_all($sql);
	$mail = t_decrypt($result[0]['pc_address']);

	//print $mail."<br>";

	$virtual_number = get_virtual_number($reserve_data['c_member_id']);
	$branch_id = substr($virtual_number, 0, 3);
	$virtual_number = substr($virtual_number, 4, 10);

	$sql = "select * from a_virtual_account_conf where branch_id = '$branch_id'";
	$virtual_conf = db_get_all($sql);
	$virtual_conf = $virtual_conf[0];

// メール文言用変数
$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");

$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");
//$max = max($room_data['num_school'], $room_data['num_mouth'], $room_data['num_theater']);

	$body = "　■ ■ ■ ■ ご 予 約 お 申 込 み あ り が と う ご ざ い ま す ■ ■ ■ ■　\n";
	$body.= $corp."\n";
	$body.= $c_member['nickname']." 様\n\n";

	$body.= "この度はアットビジネスセンターをご予約いただき、誠にありがとうございます。\n";
	$body.= "お申込みいただきました予約が承認され、ご予約が確定いたしました。\n";
	$body.= "つきましては下記の期限にてご入金のお手続きをお願いいたします。\n\n";
//	$body.= "※アカウント登録がお済みのお客様は、ログイン後に請求書及び領収書の自動出力が可能です。\n";
//	$body.= "　請求書・領収書の自動出力はこちら(".$_SESSION['_authsession']['data']['OPENPNE_URL']."?page=reserved_info)\n\n";

	$body.= "<予約者情報>\n";
	$body.= "■会員登録（アカウント）：";
	if($c_member['guest_flag']>0){
		$body.= "ゲスト\n";
	}else{
		$body.= "会員\n";
	}
	$body.= "■お客様ID：".$c_member['c_member_id']."\n";
	$body.= "■予約者名：".$c_member['nickname']." 様\n";
	$body.= "■法人/団体名：".$corp."\n";
	$body.= "■住所：".$address."\n";
	$body.= "■TEL：".$tel."\n";
	$body.= "■E-Mail：".$mail."\n";
	$body.= "■予約受付日時：".$tmp."\n";


	$body.= "************************************************\n";
	$body.= "<お支払内容>\n";
	$body.= "■お振込金額　　：　".number_format($reserve_data['total_price'])."円（税込）\n";
	$body.= "■お振込期限　　：　".$limit."\n";
	$body.= "■お振込先口座  ：　".$virtual_conf['bank']."　".$virtual_conf['branch']."　普通　".$virtual_number."\n";
	$body.= "■口座名義人　  ：　".$virtual_conf['account']."\n\n";

	$body.= "<ご予約内容>\n";
	$body.= "■予約ID：".$reserve_id."\n";
	$body.= "■施設名：".$hall_data['hall_name']."\n";
	$body.= "■ご利用目的：".get_purpose_word($reserve_data['purpose'])."\n";
	$body.= "■看板表示：".$reserve_data['kanban']."\n";
	$body.= "■利用日：".$date."\n";

	$body.= "■人数：".$reserve_data['people']."名\n";
	$body.= "■部屋名（利用時間）\n";
	$body.= "・".$room_data['room_name']."($begin ～ $finish)\n\n";
	$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";

if($reserve_v_list){
	$body.= "<予約備品情報>\n";
	foreach($reserve_v_list as $v){
		$body.= "・".$v['vessel_name']."(数量：".$v['num'].")\n";
	}
	$body.= "\n備品料金：".number_format($reserve_data['vessel_price'])." 円\n\n";
}
if($reserve_s_list){
	$body.= "<予約サービス品情報>\n";
	foreach($reserve_s_list as $v){
		$body.= "・".$v['service_name']."(数量：".$v['num'].")\n";
	}
	
	$body.= "\nサービス品料金：".number_format($reserve_data['service_price'])." 円\n\n";
}

	$body.= "合計料金：".number_format($reserve_data['total_price'])." 円\n";
	$body.= "************************************************\n\n";

if($reserve_data['message']){
	$body.= "■メッセージ\n";
	$body.= $reserve_data['message']."\n\n";

}

	//print nl2br($body);

	$source = get_c_template_mail_source('m_atoffice_syounin');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "★会議室のご予約を確定いたしました。";
	}

	$subject.= "【".get_hall_name($hall_id)."/".$date_s."/".$c_member['nickname']."様】";

	// 説明文
	$body.= $hall_data['mail']."\n";

	$body.= $tmp_body;
	
	//put_mail_queue($mail, $subject, $body);

	$sql = "select mailing_list from a_hall where hall_id = '$hall_id'";
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	$this->set('subject', $subject);
	$this->set('body', $body);
	$this->set('mail', $mail);
	$this->set('ml', $ml);

        return 'success';
    }
}

?>
