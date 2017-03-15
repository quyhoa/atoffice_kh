<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_do_change_reserve extends OpenPNE_Action
{
    function execute($requests)
    {
	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$reserve_id = $_POST['reserve_id'];
	// 旧データ
	$sql = "select * from a_reserve_list where reserve_id = $reserve_id";
	$reserve_data = db_get_all($sql);
	$reserve_data = $reserve_data[0];

	$hall_id = $reserve_data['hall_id'];
	$c_member_id = $reserve_data['c_member_id'];

	$error=array();
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['begin_datetime'])){
		array_push($error, "開始時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['finish_datetime'])){
		array_push($error, "終了時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['tmp_reserve_datetime'])){
		array_push($error, "仮予約時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['reserve_datetime'])){
		array_push($error, "予約承認時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['change_datetime'])){
		array_push($error, "予約変更時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['cancel_datetime'])){
		array_push($error, "キャンセル時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['pay_checkdate'])){
		array_push($error, "入金確認時間の書式エラーです。");
	}
	if(!preg_match("/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/", $_POST['pay_limitdate'])){
		array_push($error, "支払期限日の書式エラーです。");
	}


	if($error){
		$this->set('error', $error);
		return 'success';
	}

	$dt = new DateTime($_POST['begin_datetime']);
	$year = $dt->format("Y");
	$month = $dt->format("m");
	$day = $dt->format("d");
	$begin_day = $dt->format("YmdHis");

	$dt = new DateTime($_POST['finish_datetime']);
	$finish_day = $dt->format("YmdHis");

	if($begin_day > $finish_day){
		array_push($error, "開始時間が終了時間より遅い時間です。");
	}

	// 休室日チェック
	if(check_holiday($hall_id, $_POST['room_id'], $year, $month, $day)){
		array_push($error, "休室日を指定しています。");
	}

	// 予約重複確認
	if(check_change_reserve($hall_id, $_POST['room_id'], $c_member_id, $_POST['begin_datetime'], $_POST['finish_datetime'])){
		array_push($error, "他の予約と時間が重複しています。");
	}
	if($_POST['total_price'] != $_POST['room_price']+$_POST['service_price']+$_POST['vessel_price'])
	{
		$_POST['total_price'] = $_POST['room_price']+$_POST['service_price']+$_POST['vessel_price'];
	}
	if($_POST['pay_money'] > $_POST['total_price'] )
	{
		$_POST['pay_flag'] = 2;
	}elseif($_POST['pay_money'] == $_POST['total_price'])
	{
		$_POST['pay_flag'] = 1;
	}
	else{
		$_POST['pay_flag'] = 0;
	}
	
	// 備品不足確認
	$sql = "select * from a_reserve_v where reserve_id = ".$_POST['reserve_id'];
	$vessel_rl = db_get_all($sql);
	// 備品在庫数チェック
	foreach($vessel_rl as $value){
		// 在庫数
		$sql = "select num from a_vessel_data where vessel_id = ".$value['vessel_id'];
		$zaiko = db_get_all($sql);
		$zaiko = $zaiko[0]['num'];
		// 時間帯のかぶっている他の予約（変更前のデータを除く）
		$sql = "select reserve_id from a_reserve_list where reserve_id != $reserve_id and hall_id = $hall_id and room_id != ".$_POST['room_id']." and cancel_flag=0 and ((begin_datetime between '".$_POST['begin_datetime']."' and '".$_POST['finish_datetime']."') or (finish_datetime between '".$_POST['begin_datetime']."' and '".$_POST['finish_datetime']."') or ('".$_POST['begin_datetime']."' between begin_datetime and finish_datetime))";
		
		$reserve_id_list = db_get_all($sql);
		// 予約数
		if($reserve_id_list){
			$sql = "select num from a_reserve_v where vessel_id = ".$value['vessel_id'];
			$sql.= " and (";
			foreach($reserve_id_list as $k=>$v){
				$sql.= "reserve_id = ".$v['reserve_id'];
				if(isset($reserve_id_list[($k+1)]) && $reserve_id_list[($k+1)]['reserve_id']){
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
		$changedate = false;
		if(strtotime($reserve_data['begin_datetime']) != strtotime($_POST['begin_datetime']) || strtotime($reserve_data['finish_datetime']) != strtotime($_POST['finish_datetime']))
		{
			$changedate = true;
		}
		if (($reserve_v_num + $value['num']) > $zaiko && $changedate){
			// 在庫不足
			array_push($error, '変更希望の日時ですと、備品('.get_vessel_name($value['vessel_id']).')の在庫が不足します。');
		}
	}// foreach

	if($_POST['renew_bill_id']==0){
		if($_POST['bill_id']!=0){
			$sql = "select * from a_bill_id where bill_id = '".$_POST['bill_id']."' and reserve_id = '$reserve_id'";
			$check = db_get_all($sql);
			if(!$check){
				array_push($error, '過去に割り当てられたことのない請求番号は指定できません。');
			}else{
				$bill_id = $_POST['bill_id'];
			}
		}else{
			$bill_id = 0;
		}
	}else{
		// 請求番号取得
		$bill_id = get_bill_id($reserve_id, 0);

		if(!$bill_id){
			array_push($error, '請求番号が取得できませんでした。');
		}
	}

	// 支払済み変更によるバーチャル口座再取得
	$virtual_code = $reserve_data['virtual_code'];
	if($reserve_data['pay_flag']==1 and $_POST['pay_flag']==0){
		$virtual_code = get_virtual_number($reserve_data['c_member_id']);
		if($virtual_code){
			// 登録
			$sql = "update a_virtual_account_list SET ";
			$sql.= "flag = 1, ";
			$sql.= "c_member_id = '".$reserve_data['c_member_id']."' ";
			$sql.= "where virtual_number = '$virtual_code'";
			db_get_all($sql);
		}else{
			array_push($error, '空きバーチャル口座番号が取得できませんでした。');
		}
	}

	if($error){
		$this->set('error', $error);
		return 'success';
	}
	$now=date("Y-m-d H:i:s");
	$sql_isset_resever_id="select * from a_repayment_list where reserve_id=".$_POST['reserve_id']." and flag=0";
	$isset_resever_id=db_get_all($sql_isset_resever_id);

	if(count($isset_resever_id)>0){
		$repayment_money=$_POST['pay_money']-$_POST['total_price'];	
		if($repayment_money>0){
			$sql_repayment="update a_repayment_list set repayment_money=".$repayment_money." where reserve_id=".$_POST['reserve_id'];
			db_get_all($sql_repayment);
		}
		else{
			$sql_repayment="DELETE FROM  a_repayment_list  where reserve_id=".$_POST['reserve_id'];
			db_get_all($sql_repayment);
		}

		
	}else{
		$repayment_money=$_POST['pay_money']-$_POST['total_price'];
		if($repayment_money > 0){	
			$flag = 0;
			$sql_repayment="insert into a_repayment_list ( reserve_id, repayment_money, info, flag, repayment_datetime, add_datetime) values('".$_POST['reserve_id']."','".$repayment_money."','入金過多のため','".$flag."','0000-00-00 00:00:00','".$now."')";
			db_get_all($sql_repayment);
		}
	}
	// 旧データをログへ
	$sql = "insert into a_rl_log (reserve_id, hall_id, room_id, c_member_id, begin_datetime, finish_datetime, tmp_reserve_datetime, reserve_datetime, tmp_flag, cancel_flag, change_flag, room_price, vessel_price, service_price, total_price, kanban, memo, virtual_code, pay_limitdate, pay_flag, pay_money, pay_checkdate, purpose, complete_flag, change_datetime, cancel_datetime, receipt_flag, receipt_datetime, staff_name, bill_id, message) values(";
	$sql.= "'".$reserve_data['reserve_id']."', ";
	$sql.= "'".$reserve_data['hall_id']."', ";
	$sql.= "'".$reserve_data['room_id']."', ";
	$sql.= "'".$reserve_data['c_member_id']."', ";
	$sql.= "'".$reserve_data['begin_datetime']."', ";
	$sql.= "'".$reserve_data['finish_datetime']."', ";
	$sql.= "'".$reserve_data['tmp_reserve_datetime']."', ";
	$sql.= "'".$reserve_data['reserve_datetime']."', ";
	$sql.= "'".$reserve_data['tmp_flag']."', ";
	$sql.= "'".$reserve_data['cancel_flag']."', ";
	$sql.= "'".$reserve_data['change_flag']."', ";
	$sql.= "'".$_POST['room_price']."', ";
	$sql.= "'".$_POST['vessel_price']."', ";
	$sql.= "'".$_POST['service_price']."', ";
	$sql.= "'".$_POST['total_price']."', ";
	$sql.= "'".$reserve_data['kanban']."', ";
	$sql.= "'".$reserve_data['memo']."', ";
	$sql.= "'".$reserve_data['virtual_code']."', ";
	$sql.= "'".$reserve_data['pay_limitdate']."', ";
	$sql.= "'".$reserve_data['pay_flag']."', ";
	$sql.= "'".$reserve_data['pay_money']."', ";
	$sql.= "'".$reserve_data['pay_checkdate']."', ";
	$sql.= "'".$reserve_data['purpose']."', ";
	$sql.= "'".$reserve_data['complete_flag']."', ";
	$sql.= "'".$reserve_data['change_datetime']."', ";
	$sql.= "'".$reserve_data['cancel_datetime']."', ";
	$sql.= "'".$reserve_data['receipt_flag']."', ";
	$sql.= "'".$reserve_data['receipt_datetime']."', ";
	$sql.= "'".$result[0]['name']."', ";
	$sql.= "'".$reserve_data['bill_id']."', ";
	$sql.= "'".$reserve_data['message']."'";
	$sql.= ")";
	db_get_all($sql);

	// 更新
	$sql = "update a_reserve_list SET ";
	$sql.= "room_id = ".$_POST['room_id'].", ";
	$sql.= "begin_datetime = '".$_POST['begin_datetime']."', ";
	$sql.= "finish_datetime = '".$_POST['finish_datetime']."', ";
	$sql.= "tmp_reserve_datetime = '".$_POST['tmp_reserve_datetime']."', ";
	/*if($_POST['tmp_flag']==0){
		$sql.= "reserve_datetime = '".$now."', ";		
	}*/
	$sql.= "reserve_datetime = '".$_POST['reserve_datetime']."', ";
	$sql.= "tmp_flag = ".$_POST['tmp_flag'].", ";
	$sql.= "cancel_flag = ".$_POST['cancel_flag'].", ";
	$sql.= "change_flag = ".$_POST['change_flag'].", ";
	if($_POST['cancel_flag'] == 1){
		$sql.= "cancel_datetime = '".$_POST['cancel_datetime']."', ";
	}
	$sql.= "people = ".$_POST['people'].", ";
	$sql.= "change_datetime = now(), ";
	$sql.= "purpose = ".$_POST['purpose'].", ";
	$sql.= "virtual_code = ".$virtual_code.", ";
	$sql.= "pay_limitdate = '".$_POST['pay_limitdate']."', ";
	if($_POST['pay_money'] == '0'){
		$sql.= "pay_checkdate = '0000-00-00 00:00:00', ";	
	}
	if($_POST['pay_checkdate'] != '0000-00-00 00:00:00' && $_POST['pay_money'] != '0'){
		$sql.= "pay_checkdate = '".$_POST['pay_checkdate']."', ";	
	}
	$sql.= "pay_flag = ".$_POST['pay_flag'].", ";
	$sql.= "pay_money = ".$_POST['pay_money'].", ";
	$sql.= "complete_flag = ".$_POST['complete'].", ";
	$sql.= "kanban = '".mysql_real_escape_string($_POST['kanban'])."', ";
	$sql.= "room_price = ".$_POST['room_price'].", ";
	$sql.= "vessel_price = ".$_POST['vessel_price'].", ";
	$sql.= "service_price = ".$_POST['service_price'].", ";
	$sql.= "total_price = ".$_POST['total_price'].", ";
	$sql.= "memo = '".$_POST['memo']."', ";
	$sql.= "receipt_flag = '".$_POST['receipt_flag']."', ";
	$sql.= "receipt_datetime = '".$_POST['receipt_datetime']."', ";
	$sql.= "bill_id = '$bill_id', ";
	$sql.= "message = '".$_POST['message']."' ";

	$sql.= "where reserve_id = $reserve_id";
	db_get_all($sql);

	/*$sql = "update a_reserve_v SET ";
	$sql.= "price = ".$_POST['vessel_price']." ";
	$sql.= "where reserve_id = $reserve_id";
	db_get_all($sql);*/

	$result[$key]['cancel_list'] = get_cancel_list($reserve_id);
	// $cancel_price = $_POST['total_price'];
	// $cancel_price = round($cancel_price*$result[$key]['cancel_list']['percent']*0.01);
	// if($_POST['tmp_flag']==1)
	// {
	// 	$cancel_price = 0;
	// }
	$cancel_list = get_cancel_list2($reserve_id);
	$cancel_price = ceil(($_POST['room_price'] +$_POST['vessel_price']+$_POST['service_price']))*($cancel_list['percent']*0.01);
	//$cancel = get_cancel_price($reserve_id);
	//$cancel_price = $cancel['cancel_price'];
	$sql = "select * from a_amount_billed where reserve_id = ".$reserve_id;
	$ab_data = db_get_all($sql);	
	if($ab_data == NULL){
		$sql = "INSERT INTO a_amount_billed(reserve_id, total_billed_money, info, flag, pay_money, check_datetime, virtual_code, pay_limitdate, add_datetime, bill_id, receipt_flag, receipt_datetime) VALUES(".$reserve_id.",".$cancel_price.",'', '0', '0', '', '','','','".$bill_id."','','')";
		$ab_data = db_get_all($sql);			
	}
	else{
		if($_POST['pay_money'] > 0){
			$sql = "UPDATE a_amount_billed SET flag = 1, pay_money = ".$_POST['pay_money']." WHERE reserve_id = ".$reserve_id."";
			$ab_data = db_get_all($sql);
		}
		$sql = "UPDATE a_amount_billed SET total_billed_money = ".$cancel_price." WHERE reserve_id = ".$reserve_id."";
		$ab_data = db_get_all($sql);
	}
	if($_POST['cancel_flag'] == 1){
		$sql_isset_resever_id="select * from a_repayment_list where reserve_id=".$_POST['reserve_id']." and flag=0";
		$isset_resever_id=db_get_all($sql_isset_resever_id);

		$repayment_money=$_POST['pay_money']-$cancel_price;	
		if($repayment_money>0){
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
		
		
	}
	
	admin_client_redirect("reserve_revision&reserve_id=$reserve_id", '予約を修正しました。必要であれば顧客へ変更連絡メールを送信してください。');
    }
}


?>
