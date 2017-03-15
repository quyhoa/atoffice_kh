<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メール文言の更新
class admin_do_delete_hall_data extends OpenPNE_Action
{
    function execute($requests)
    {

	//var_dump($_REQUEST);

	$hall_id = $_POST['hall_id'];
	if(!preg_match("/^[0-9]+$/", $hall_id)){
	        admin_client_redirect('hall_list', '会場IDが不正のため、削除できませんでした');
	}
	// キャンセル料率削除
	$sql = "delete from a_cancel_charge where hall_id = '$hall_id'";
	db_get_all($sql);

	// 銀行固定設定
	$sql = "delete from a_bank_data where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場データ
	$sql = "delete from a_hall where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場休日
	$sql = "delete from a_hall_holiday where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場画像
	$sql = "delete from a_hall_image where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場定休日
	$sql = "delete from a_hall_regular_holiday where hall_id = '$hall_id'";
	db_get_all($sql);

	// 貸し止め
	$sql = "delete from a_rental_stop where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋データ
	$sql = "delete from a_room where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋割引データ
	$sql = "delete from a_room_discount where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋休日データ
	$sql = "delete from a_room_holiday where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋パック料金データ
	$sql = "delete from a_room_pack where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋定休日データ
	$sql = "delete from a_room_regular_holiday where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋サービス使用登録
	$sql = "delete from a_room_service where hall_id = '$hall_id'";
	db_get_all($sql);

	// 部屋備品使用登録
	$sql = "delete from a_room_vessel where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場サービス品データ
	$sql = "delete from a_service_data where hall_id = '$hall_id'";
	db_get_all($sql);

	// 会場備品データ
	$sql = "delete from a_vessel_data where hall_id = '$hall_id'";
	db_get_all($sql);

///////////////////

	$sql = "select * from a_reserve_list where hall_id = '$hall_id'";
	$reserve_data = db_get_all($sql);

if(!empty($reserve_data)){
	foreach($reserve_data as $value){

	$reserve_id = $value['reserve_id'];

	// 予約データ
	$sql = "delete from a_reserve_list where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// キャンセル請求データ
	$sql = "delete from a_amount_billed where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 請求番号
	$sql = "delete from a_bill_id where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 返金データ
	$sql = "delete from a_repayment_list where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 完了報告データ
	$sql = "delete from a_report where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// サービス予約データ
	$sql = "delete from a_reserve_s where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 備品予約データ
	$sql = "delete from a_reserve_v where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 予約修正ログデータ
	$sql = "delete from a_rl_log where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// サービス修正ログデータ
	$sql = "delete from a_rs_log where reserve_id = '$reserve_id'";
	db_get_all($sql);

	// 備品修正ログデータ
	$sql = "delete from a_rv_log where reserve_id = '$reserve_id'";
	db_get_all($sql);


	}
}


        admin_client_redirect('hall_list', '会場を削除しました');
    }

}

?>
