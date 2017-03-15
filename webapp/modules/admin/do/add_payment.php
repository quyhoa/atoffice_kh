<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_payment extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	if(!preg_match("/^[0-9]+$/", $_POST['money']) or $_POST['money'] < 1){
		admin_client_redirect('reserve_list', '入金額が不正であったため、入金処理を行いませんでした。');
	}

	if($_POST['pay_money']+$_POST['money'] < $_POST['total_price']){
		//print "一部入金<br>";
		$sql = "update a_reserve_list SET pay_money = ".($_POST['pay_money']+$_POST['money']).", pay_checkdate=now() where reserve_id = ".$_POST['reserve_id'];
		//print $sql;
		db_get_all($sql);
		admin_client_redirect('reserve_list', '一部入金処理を行いました。');
	}elseif($_POST['pay_money']+$_POST['money'] > $_POST['total_price']){
		//print "入金過多";

		$sql = "update a_reserve_list SET pay_money = ".($_POST['pay_money']+$_POST['money']).", pay_flag=1, pay_checkdate=now() where reserve_id = ".$_POST['reserve_id'];
		db_get_all($sql);

		// 返金リストへ追加
		$repay = ($_POST['pay_money']+$_POST['money']) - $_POST['total_price'];
		$sql = "insert into a_repayment_list (reserve_id, repayment_money, info) values (".$_POST['reserve_id'].", $repay, '入金過多のため')";
		db_get_all($sql);

		admin_client_redirect('paid_reserve_list', '入金処理を行いましたが、入金過多のため返金処理リストへ追加しました。');
	}else{
		//print "入金済み";
		$sql = "update a_reserve_list SET pay_money = ".($_POST['pay_money']+$_POST['money']).", pay_flag=1, pay_checkdate=now() where reserve_id = ".$_POST['reserve_id'];
		db_get_all($sql);
		admin_client_redirect('paid_reserve_list', '入金処理をしました。');
	}

    }
}


?>
