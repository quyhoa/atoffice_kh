<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_reserve_cancel extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	$reserve_id = $_POST['reserve_id'];
	$cancel = get_cancel_price($reserve_id);
	$page = $_POST['page'];

// 予約データ取得
$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
$reserve_data = db_get_all($sql);
$reserve_data = $reserve_data[0];

	// キャンセルする
	$sql = "update a_reserve_list SET ";
	$sql.= "cancel_flag = 1, ";
	$sql.= "virtual_code = 0, ";
	$sql.= "cancel_datetime = now() ";
	$sql.= "where reserve_id = $reserve_id";
	db_get_all($sql);

$u = $reserve_data['c_member_id'];

//担当者
$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
$result = db_get_all($sql);
$name = $result[0]['name'];

// メアド取得
$sql = "select pc_address from c_member_secure where c_member_id =".$reserve_data['c_member_id'];
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

//備品とサービスを削除する 暫定処理
$sql = "delete * from a_reserve_v where reserve_id = $reserve_id";
db_get_all($sql);
$sql = "select * from a_reserve_s where reserve_id = $reserve_id";
db_get_all($sql);

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

	// 予約に使われたバーチャル口座を閉じる
	$check = check_virtual_code($reserve_data['virtual_code'], $reserve_id);
	if($check==0){
		$sql = "update a_virtual_account_list SET flag = '0' where virtual_number = '".$reserve_data['virtual_code']."' and c_member_id = '".$reserve_data['c_member_id']."'";
		db_get_all($sql);
	}

	if($reserve_data['pay_money'] > $cancel['cancel_price']){
		// 返金
		$repay = $reserve_data['pay_money'] - $cancel['cancel_price'];


// キャンセル請求テーブルにキャンセル料支払済みとして登録
$billed_money = $cancel['cancel_price'];
$virtual_number = get_virtual_number($reserve_data['c_member_id']);

$sql = "delete from a_amount_billed where reserve_id = '$reserve_id' and flag = '0'";
db_get_all($sql);
$limitdate = get_business_days(3);
$sql = "insert into a_amount_billed (reserve_id, total_billed_money, info, virtual_code, pay_limitdate, add_datetime, flag, check_datetime, pay_money) values ($reserve_id, $billed_money, 'キャンセル料金（入金後キャンセルの為、既に入金済）', $virtual_number, '$limitdate', now(), 1, now(), $billed_money)";
db_get_all($sql);


		// 返金リストに追加
		$sql = "delete from a_repayment_list where reserve_id = $reserve_id and flag = '0'";
		db_get_all($sql);

		$sql = "insert into a_repayment_list (reserve_id, repayment_money, info, add_datetime) values ($reserve_id, ".$repay.", '入金後キャンセルの差額', now())";
		db_get_all($sql);

	}elseif($reserve_data['pay_money'] < $cancel['cancel_price'] and $reserve_data['tmp_flag']==0){

		// 請求
		$billed_money = $cancel['cancel_price'] - $reserve_data['pay_money'];
		$virtual_number = get_virtual_number($reserve_data['c_member_id']);
		// 口座番号登録
		$sql = "update a_virtual_account_list SET flag = '1', c_member_id = '".$reserve_data['c_member_id']."' where virtual_number = '$virtual_number'";
		db_get_all($sql);
		// 請求リスト登録
		$sql = "delete from a_amount_billed where reserve_id = $reserve_id and flag = '0'";
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

	}else{

// キャンセル請求テーブルにキャンセル料支払済みとして登録
$billed_money = $cancel['cancel_price'];
$virtual_number = get_virtual_number($reserve_data['c_member_id']);

$sql = "delete from a_amount_billed where reserve_id = '$reserve_id' and flag = '0'";
db_get_all($sql);
$limitdate = get_business_days(3);
$sql = "insert into a_amount_billed (reserve_id, total_billed_money, info, virtual_code, pay_limitdate, add_datetime, flag, check_datetime, pay_money) values ($reserve_id, $billed_money, 'キャンセル料金（入金後キャンセルの為、既に入金済）', $virtual_number, '$limitdate', now(), 1, now(), $billed_money)";
db_get_all($sql);

	}
	// 変更通知メール
	if(isset($_POST['submit2'])){	// メール送信経由
		admin_client_redirect("$page&reserve_id=$reserve_id", "メールを送信し、予約ID : $reserve_id の予約をキャンセルしました。");
	}else{
		admin_client_redirect("$page&reserve_id=$reserve_id", "メール送信をしないで 予約ID : $reserve_id の予約をキャンセルしました。");
	}
    }
}


?>
