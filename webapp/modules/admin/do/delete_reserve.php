<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// メンバー情報一括登録
class admin_do_delete_reserve extends OpenPNE_Action
{
    function handleError($msg)
    {
        admin_client_redirect('delete_reserve', $msg);
    }

    function execute($requests)
    {

	$list = explode(',', $_POST['delete_id']);
	if($list){
		foreach($list as $value){
			$range = explode('-', $value);
			// メインデータ
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_reserve_list where reserve_id = $value";
			}else{
				$sql = "delete from a_reserve_list where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}
			//print $sql."<br>";
			db_get_all($sql);

			// 備品
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_reserve_v where reserve_id = $value";
			}else{
				$sql = "delete from a_reserve_v where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}
			db_get_all($sql);

			// サービス品
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_reserve_s where reserve_id = $value";
			}else{
				$sql = "delete from a_reserve_s where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}
			db_get_all($sql);

			// キャンセル請求
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_amount_billed where reserve_id = $value";
			}else{
				$sql = "delete from a_amount_billed where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}
			db_get_all($sql);

			// 請求番号
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_bill_id where reserve_id = $value";
			}else{
				$sql = "delete from a_bill_id where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}
			db_get_all($sql);

			// 返金データ
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_repayment_list where reserve_id = $value";
			}else{
				$sql = "delete from a_repayment_list where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}

			db_get_all($sql);

			// レポート
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_report where reserve_id = $value";
			}else{
				$sql = "delete from a_report where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}

			db_get_all($sql);


			// 予約ログ
			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_rl_log where reserve_id = $value";
			}else{
				$sql = "delete from a_rl_log where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}

			db_get_all($sql);

			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_rv_log where reserve_id = $value";
			}else{
				$sql = "delete from a_rv_log where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}

			db_get_all($sql);

			if(isset($range[1]) && is_null($range[1])){
				$sql = "delete from a_rs_log where reserve_id = $value";
			}else{
				$sql = "delete from a_rs_log where reserve_id >= ".$range[0]." and reserve_id <= ".$range[1];
			}

			db_get_all($sql);


		}
	}else{
		admin_client_redirect('delete_reserve', "削除対象が入力されていません。");
	}

        admin_client_redirect('delete_reserve', "削除完了しました。");
    }

}

?>
