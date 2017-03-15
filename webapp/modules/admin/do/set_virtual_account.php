<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_set_virtual_account extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);
	$sql = "select count(*) as num from a_virtual_account_list";
	$num = db_get_all($sql);
	$num = $num[0]['num'];

	if(!$_POST['bank']){
		admin_client_redirect('virtual_account_setup', '銀行名を入力してください。');
	}
	if(!$_POST['branch']){
		admin_client_redirect('virtual_account_setup', '支店名を入力してください。');
	}
	if(!$_POST['account']){
		admin_client_redirect('virtual_account_setup', '名義人を入力してください。');
	} 

	// データチェック
/*
	if(!preg_match("/^[0-9]+$/", $_POST['kotei_start'])){
		admin_client_redirect('virtual_account_setup', '固定範囲開始を半角数字で入力してください。');
	}

	if(!preg_match("/^[0-9]+$/", $_POST['kotei_end'])){
		admin_client_redirect('virtual_account_setup', '固定範囲終了を半角数字で入力してください。');
	}

	if($_POST['kotei_end'] < $_POST['kotei_start']){
		admin_client_redirect('virtual_account_setup', '固定範囲終了が開始より大きい数値です。');
	}
*/
	if(!preg_match("/^[0-9]+$/", $_POST['branch_id'])){
		admin_client_redirect('virtual_account_setup', '支店番号を半角数字で入力してください。');
	}

	if($_POST['branch_id'] > 999){
		admin_client_redirect('virtual_account_setup', '支店番号は3桁までの数値で入力してください。');
	}


	// 一旦削除
	$sql = "delete from a_virtual_account_conf where branch_id = ".$_POST['branch_id'];
	db_get_all($sql);


	// 登録
	$sql = "insert into a_virtual_account_conf (branch_id, bank, branch, account) values (".$_POST['branch_id'].", '".$_POST['bank']."', '".$_POST['branch']."', '".$_POST['account']."')";
	db_get_all($sql);

	admin_client_redirect('virtual_account_setup', 'バーチャル口座設定を更新しました。');

    }
}




?>
