<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_tmp_cancel extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	$sql = "update a_reserve_list SET ";
	$sql.= "cancel_flag = 1, ";
	$sql.= "cancel_datetime = now() ";
	$sql.= "where reserve_id = ".$_POST['reserve_id'];
	db_get_all($sql);

// 担当者
$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
$result = db_get_all($sql);
$name = $result[0]['name'];

$reserve_id = $_POST['reserve_id'];

// 予約データ
$sql = "select * from a_reserve_list where reserve_id = ".$_POST['reserve_id'];
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];
$hall_id = $reserve_data['hall_id'];
$room_id = $reserve_data['room_id'];
//check repayment_list
$sql_isset_resever_id="select * from a_repayment_list where reserve_id=".$_POST['reserve_id']." and flag=0";
$isset_resever_id=db_get_all($sql_isset_resever_id);
if($reserve_data['pay_money'] >0)
{
	$repayment_money = $reserve_data['pay_money'];
	if(count($isset_resever_id)>0){
		$sql_repayment="update a_repayment_list set repayment_money=".$repayment_money." where reserve_id=".$_POST['reserve_id'];
		db_get_all($sql_repayment);
	}
	else{
		$flag = 0;
		$sql_repayment="insert into a_repayment_list ( reserve_id, repayment_money, info, flag, repayment_datetime, add_datetime) values('".$_POST['reserve_id']."','".$repayment_money."','入金過多のため','".$flag."','0000-00-00 00:00:00','".$now."')";
		db_get_all($sql_repayment);
	}
}

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data['c_member_id'];
$result=db_get_all($sql);
$mail = t_decrypt($result[0]['pc_address']);


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
$u = $c_member['c_member_id'];
// プロフィール
$corp = get_profile_value($reserve_data['c_member_id'], 12);
$address = get_profile_value($u, 3).get_profile_value($u, 14).get_profile_value($u, 15).get_profile_value($u, 16);

$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");

$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");

	// 予約完了メール

$body = $corp."\n";
$body.= $c_member['nickname']." 様\n\n";

$body.= "下記の仮予約を取り消しいたしました。\n";
$body.= "内容をご確認ください。\n";
$body.= "この変更による料金は発生いたしません。\n";
$body.= "またのご利用を心よりお待ちしております。\n\n";

$body.= "**************************************************\n";
$body.= "■ 受付担当者：".$name."\n\n";

$body.= "<仮予約者情報>\n";
$body.= "■お客様ID：".$c_member['c_member_id']."\n";
$body.= "■仮予約者名：".$c_member['nickname']." 様\n";
$body.= "■法人／団体名：".$corp."\n";
$body.= "■住所：".$address."\n";
$body.= "■TEL：".get_profile_value($u, 17)."\n";
$body.= "■E-Mail：".$mail."\n";
$body.= "■仮予約受付日時：".date("Y年m月d日 H:i")."\n\n";

$body.= "<仮予約施設情報>\n";
$body.= "■予約ID：".$reserve_id."\n";
$body.= "■施設名：".get_hall_name($hall_id)."\n";
$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
$body.= "■看板表示：".$reserve_data['kanban']."\n";
$body.= "■利用日：".$date."\n";
$body.= "■人数：".$reserve_data['people']."名\n";
$body.= "■部屋名（利用時間）\n";
$body.= "・".get_room_name($hall_id, $room_id)."($begin ～ $finish)\n\n";
$body.= "・施設料金：".number_format($reserve_data['room_price'])." 円\n\n";

if($vessel_rl){
$body.= "<仮予約備品情報>\n";
foreach($vessel_rl as $v){
	$body.= "・".get_vessel_name($v['vessel_id'])."(数量：".$v['num'].")\n";
}
$body.= "\n備品料金：".number_format($reserve_data['vessel_price'])." 円\n\n";
}

if($service_rl){
$body.= "<仮予約サービス品情報>\n";
foreach($service_rl as $v){
	$body.= "・".get_service_name($v['service_id'])."(数量：".$v['num'].")\n";
}
$body.= "\nサービス料金：".number_format($reserve_data['service_price'])." 円\n\n";
}

$body.= "合計料金：".number_format($reserve_data['total_price'])." 円\n";
$body.= "*********************************************\n\n";


	$source = get_c_template_mail_source('m_atoffice_ao_tmpcancel');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "★会議室の仮予約を取り消しいたしました。";
	}
	$subject.= "【".get_hall_name($hall_id)."/".$date_s."/".$c_member['nickname']."様】";


	$body.= $tmp_body;

if($_POST['mail_flag']==1){
	put_mail_queue($mail, $subject, $body);

	$sql = "select mailing_list from a_hall where hall_id = ".$reserve_data['hall_id'];
	$ml = db_get_all($sql);
	$ml = $ml[0]['mailing_list'];
	// メーリングリストにも送信
	if($ml){
		put_mail_queue($ml, $subject, $body);
	}

	admin_client_redirect('tmp_reserve_list', '仮予約を取り消し、通知メールを送信しました。');
}else{
	admin_client_redirect('tmp_reserve_list', '仮予約を取り消し、通知メールは送信しませんでした。');
}

    }
}


?>
