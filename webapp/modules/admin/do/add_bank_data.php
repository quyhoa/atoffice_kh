<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_bank_data extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	// データチェック
	if(!$_POST['bank']){
		admin_client_redirect('bank_config', "銀行名が入力されていませんでした。確認し、再度入力し直してください。".$_POST['hall_id']);
	}
	if(!$_POST['branch']){
		admin_client_redirect('bank_config', "支店名が入力されていませんでした。確認し、再度入力し直してください。".$_POST['hall_id']);
	}
	if(!$_POST['account_number']){
		admin_client_redirect('bank_config', "口座番号が入力されていませんでした。確認し、再度入力し直してください。".$_POST['hall_id']);
	}elseif(!preg_match("/^[0-9]+$/", $_POST['account_number'])){
		admin_client_redirect('bank_config', "口座番号に数字以外の文字が含まれていました。確認し、再度入力し直してください。".$_POST['hall_id']);
	}
	if(!$_POST['account_name']){
		admin_client_redirect('bank_config', "口座名義人が入力されていませんでした。確認し、再度入力し直してください。".$_POST['hall_id']);
	}
	if(!$_POST['account_kana']){
		admin_client_redirect('bank_config', "口座名義人（カナ）が入力されていませんでした。確認し、再度入力し直してください。".$_POST['hall_id']);
	}elseif(!mb_ereg("^[ァ-ヶー\s]+$", $_POST['account_kana'])){
		admin_client_redirect('bank_config', "口座名義人（カナ）に全角カタカナ以外の文字が入力されています。確認し、再度入力し直してください。".$_POST['hall_id']);
	}

	// 以前のデータ削除
	$sql = "delete from a_bank_data where hall_id = ".$_POST['hall_id'];
	db_get_all($sql);

	$sql = "insert into a_bank_data (hall_id, bank_name, branch, account_type, ";
	$sql.= "account_number, account_name, account_kana) values (";
	$sql.= $_POST['hall_id'].", '".$_POST['bank']."', '";
	$sql.= $_POST['branch']."', ".$_POST['account_type'].", ";
	$sql.= $_POST['account_number'].", '".$_POST['account_name']."', '";
	$sql.= $_POST['account_kana']."')";

	//print $sql;
	db_get_all($sql);

        admin_client_redirect('bank_config', $_POST['hall_id']);


    }
}

?>
