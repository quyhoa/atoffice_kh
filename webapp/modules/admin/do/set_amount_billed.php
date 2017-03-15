<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_set_amount_billed extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	$reserve_id = $_POST['reserve_id'];
	$billed_id = $_POST['billed_id'];

	$sql = "select c_member_id from a_reserve_list where reserve_id = $reserve_id";
	$u = db_get_all($sql);
	$u = $u[0]['c_member_id'];

	// バーチャル口座
	if($_POST['virtual_code']){
		$virtual_code = $_POST['virtual_code'];
		$flag=$_POST['flag'];
		if($_POST['flag']==1){
			$check = check_virtual_code($virtual_code, $reserve_id);
			if($check==0){
				// 未使用にする
				$sql = "update a_virtual_account_list SET ";
				$sql.= "flag = 0 ";
				$sql.= "where virtual_number = '$virtual_code'";				db_get_all($sql);
				$virtual_code = 0;
			}
		}
	}else{
		$flag=0;
		$virtual_code = get_virtual_number($u);
		if($virtual_code){
			// 使用中にする
			$sql = "update a_virtual_account_list SET ";
			$sql.= "flag = 1, ";
			$sql.= "c_member_id = '$u' ";
			$sql.= "where virtual_number = '$virtual_code'";
			db_get_all($sql);
		}else{
			admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", 'バーチャル口座に空きがありません！！');
		}
	}

if($billed_id){
	if($_POST['renew_bill_id']==0){
		$sql = "select * from a_bill_id where bill_id = '".$_POST['bill_id']."' and billed_id = '$billed_id'";
		$check = db_get_all($sql);
		if(!$check){
			admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", '過去に割り当てられたことのない請求番号は指定できません。');
		}else{
			$bill_id = $_POST['bill_id'];
		}
	}else{
		// 請求番号取得
		$bill_id = get_bill_id(0, $billed_id);
		if(!$bill_id){
			admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", '請求番号が取得できませんでした。');
		}
	}

	$sql = "update a_amount_billed SET ";
	$sql.= "total_billed_money = '".$_POST['total_billed_money']."', ";
	$sql.= "info = '".$_POST['info']."', ";
	$sql.= "flag = '$flag', ";
	$sql.= "pay_money = '".$_POST['pay_money']."', ";
	$sql.= "check_datetime = '".$_POST['check_datetime']."', ";
	$sql.= "pay_limitdate = '".$_POST['pay_limitdate']."', ";
	$sql.= "bill_id = '$bill_id' ";
	$sql.= "where billed_id = '$billed_id'";
	db_get_all($sql);


}else{
	$sql = "delete from a_amount_billed where reserve_id = $reserve_id";
	db_get_all($sql);

	$sql = "insert into a_amount_billed (reserve_id, total_billed_money, info, flag, pay_money, check_datetime, virtual_code, pay_limitdate, add_datetime) values (";
	$sql.= "'$reserve_id', ";
	$sql.= "'".$_POST['total_billed_money']."', ";
	$sql.= "'".$_POST['info']."', ";
	$sql.= "'$flag', ";
	$sql.= "'".$_POST['pay_money']."', ";
	$sql.= "'".$_POST['check_datetime']."', ";
	$sql.= "'$virtual_code', ";
	$sql.= "'".$_POST['pay_limitdate']."', ";
	$sql.= "now()";
	$sql.= ")";
	//print "$sql<br>";
	db_get_all($sql);

	$sql = "select billed_id from a_amount_billed where reserve_id = '$reserve_id'";
	$billed_id = db_get_all($sql);
	$billed_id = $billed_id[0]['billed_id'];

	if($_POST['renew_bill_id']==0){
		$sql = "select * from a_bill_id where bill_id = '".$_POST['bill_id']."' and billed_id = '$billed_id'";
		$check = db_get_all($sql);
		if(!$check){
			admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", '過去に割り当てられたことのない請求番号は指定できません。');
		}else{
			$bill_id = $_POST['bill_id'];
		}
	}else{
		// 請求番号取得
		$bill_id = get_bill_id(0, $billed_id);

		if(!$bill_id){
			admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", '請求番号が取得できませんでした。');
		}
	}


	$sql = "update a_amount_billed SET ";
	$sql.= "bill_id = '$bill_id' ";
	$sql.= "where billed_id = '$billed_id'";
	db_get_all($sql);

}
	admin_client_redirect("set_amount_billed&reserve_id=$reserve_id", '請求データを更新しました。顧客へ請求内容をメールしてください。');


    }
}


?>
