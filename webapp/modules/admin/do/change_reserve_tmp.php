<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_change_reserve_tmp extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);

	$reserve_id = $_POST['reserve_id'];
	if($_POST['approval'.$reserve_id]==2){

		$sql = "update a_reserve_list SET ";
		$sql.= "cancel_flag=1, ";
		$sql.= "cancel_datetime = now(), ";
		$sql.= "reserve_datetime = now() ";
		$sql.= "where reserve_id = $reserve_id";
		db_get_all($sql);

	// メアド取得
	$sql = "select pc_address from c_member_secure where c_member_id =".$_REQUEST['c_member_id'];
	$result=db_get_all($sql);
	$mail = t_decrypt($result[0]['pc_address']);

	$hall_id = $_REQUEST['hall_id'];
	$room_id = $_REQUEST['room_id'];

	// 予約データ
	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

	// 会場データ
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$hall_data = $hall_data[0];

	// 部屋データ
	$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
	$room_data = db_get_all($sql);
	$room_data = $room_data[0];


	// 顧客データ

	$corp = get_profile_value($_REQUEST['c_member_id'], 12);
	$address = get_profile_value($_REQUEST['c_member_id'], 3).get_profile_value($_REQUEST['c_member_id'], 14).get_profile_value($_REQUEST['c_member_id'], 15).get_profile_value($_REQUEST['c_member_id'], 16);

	$sql = "select * from c_member where c_member_id = ".$_REQUEST['c_member_id'];
	$c_member = db_get_all($sql);
	$c_member = $c_member[0];


// メール
$u = $c_member['c_member_id'];
$tmp_dt = new DateTime($reserve_data['tmp_reserve_datetime']);
$dt = new DateTime($reserve_data['begin_datetime']);
$week = get_week($dt->format("Ymd"));
$date_s = $dt->format("Y-m-d");
$date = $dt->format("Y年m月d日");
$date = $date." ".$week."曜日";
$begin = $dt->format("H時i分");
$pay_flag = $reserve_data['pay_flag'];
$total_price = $reserve_data['total_price'];
$pay_money = $reserve_data['pay_money'];
if($pay_money== $total_price){
	$pay_flag = '1';
}
else if($pay_money < $total_price)
{
	$pay_flag = '0';
}
else{
	$pay_flag = '2';
}
$dt = new DateTime($reserve_data['finish_datetime']);
$finish = $dt->format("H時i分");


	$body = "このたびはアットビジネスセンターのご予約をいただき、ありがとうございます。\n\n";

	$body.= "申し訳ございませんが以下の仮予約はお受けすることができないため、\n";
	$body.= "お取り消しとさせていただきます。\n\n";
	$body.= "**************************************************\n";
	$body.= "<仮予約者情報>\n";
	$body.= "■お客様ID：".$u."\n";
	$body.= "■仮予約者名：".$c_member['nickname']." 様\n";
	$body.= "■法人／団体名：".$corp."\n";
	$body.= "■住所：".$address."\n";
	$body.= "■TEL：".get_profile_value($u, 17)."\n";
	$body.= "■E-Mail：".$mail."\n";
	$body.= "■仮予約受付日時：".$tmp_dt->format("Y年m月d日 H:i")."\n\n";

	$body.= "<仮予約施設情報>\n";
	$body.= "■予約ID：".$reserve_data['reserve_id']."\n";
	$body.= "■施設名：".$hall_data['hall_name']."\n";
	$body.= "■ご利用目的：仮：".get_purpose_word($reserve_data['purpose'])."\n";
	$body.= "■看板表示：".$reserve_data['kanban']."\n";
	$body.= "■利用日：".$date."\n";
	$body.= "■人数：".$reserve_data['people']."名\n";
	$body.= "■部屋名（利用時間）\n";
	$body.= "・".$room_data['room_name']."($begin ～ $finish)\n\n";
	$body.= "**************************************************\n\n";


	$source = get_c_template_mail_source('m_atoffice_hisyounin');
	list($subject, $tmp_body) = explode("\n", $source, 2);

	if(!$subject){
		$subject = "申し訳ございませんが、この度のご予約は受け付けできませんでした。";
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
		put_mail_queue($ml, $subject, $pc_body);
	}

		admin_client_redirect('tmp_reserve_list&hall_list='.$_REQUEST['hall_list']."&index=".$_REQUEST['index'], "仮予約ID:".$_POST['reserve_id'].'を拒否に設定しました。');
		exit();
	}
	else{
		$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
		$reserve_data = db_get_all($sql);
		$reserve_data = $reserve_data[0];
		$pay_flag = $reserve_data['pay_flag'];
		$total_price = $reserve_data['total_price'];
		$pay_money = $reserve_data['pay_money'];
		if($pay_money== $total_price){
			$pay_flag = '1';
		}
		else if($pay_money < $total_price)
		{
			$pay_flag = '0';
		}
		else{
			$pay_flag = '2';
		}
	}

	// 承認
	$hall_id = $_REQUEST['hall_id'];
	$room_id = $_REQUEST['room_id'];

	// 3営業日後
	$limitdate = get_business_days(3);
	$dt = new DateTime($limitdate);
	$limit = $dt->format("Y年m月d日");

	// 請求番号取得
	$bill_id = get_bill_id($reserve_id, 0);

	if(!$bill_id){
		admin_client_redirect('tmp_reserve_list&hall_list='.$_REQUEST['hall_list']."&index=".$_REQUEST['index'], '請求番号が取得できませんでした。');
		exit();
	}

	$sql = "update a_reserve_list SET tmp_flag=0, reserve_datetime = now(), pay_limitdate = '".$limitdate."' ,pay_flag='".$pay_flag."'";

	if($_REQUEST['bank_flag']==0){

		$virtual_number = get_virtual_number($_REQUEST['c_member_id']);

		if(!$virtual_number){
			admin_client_redirect('tmp_reserve_list&hall_list='.$_REQUEST['hall_list']."&index=".$_REQUEST['index'], 'バーチャル口座番号に空きがありません。');
			exit();
		}

		$sql.= ", virtual_code = '$virtual_number', ";
		$sql.= "bill_id = '$bill_id' ";
	}

	$sql.= "where reserve_id = $reserve_id";

	db_get_all($sql);

	// 登録
	$sql = "update a_virtual_account_list SET ";
	$sql.= "flag = 1, ";
	$sql.= "c_member_id = '".$_REQUEST['c_member_id']."' ";
	$sql.= "where virtual_number = '$virtual_number'";
	db_get_all($sql);
	admin_client_redirect('tmp_reserve_list&hall_list='.$_REQUEST['hall_list']."&index=".$_REQUEST['index'], "仮予約ID:".$_POST['reserve_id'].'を承認しました。');


    }
}


?>
