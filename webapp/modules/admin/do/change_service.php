<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_change_service extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);
	//print "<br>";

	// アクセス権限
	$sql = "select name, atoffice_auth_type, hall_id from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$staff_name = $result[0]['name'];

	$reserve_id = $_POST['reserve_id'];

	$list = $_POST['service_list_num'];

/// 2014.01.19 消費税改定対応 begin

	$tmp_sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
	$tmp_list = db_get_all($tmp_sql);
	$tmp_list = $tmp_list[0];

	$tmp_date = strtotime($tmp_list['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日

	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2014.01.19 消費税改定対応 end

	// ログ登録
	$sql = "select * from a_reserve_s where reserve_id = $reserve_id";
	$old_data = db_get_all($sql);
	$sql = "select * from a_rs_log where reserve_id = $reserve_id order by revision_id desc";
	$revision_id = db_get_all($sql);
	if($revision_id){
		$revision_id = $revision_id[0]['revision_id']+1;
	}else{
		$revision_id = 1;
	}

	foreach($old_data as $key=>$value){
		$sql = "insert into a_rs_log (reserve_id, service_id, num, price, cancel_flag, staff_name, revision_id, change_datetime) values (";
		$sql.= "'$reserve_id', ";
		$sql.= "'".$value['service_id']."', ";
		$sql.= "'".$value['num']."', ";
		$sql.= "'".$value['price']."', ";
		$sql.= "'".$value['cancel_flag']."', ";
		$sql.= "'".$staff_name."', ";
		$sql.= "'".$revision_id."', ";
		$sql.= "now() ";
		$sql.= ")";
		db_get_all($sql);
	}


	// 削除
	$sql = "delete from a_reserve_s where reserve_id = $reserve_id";
	db_get_all($sql);

	for($x=0;$x<$list;$x++){
		if($_POST['service_id'.$x]){
			$service_id = $_POST['service_id'.$x];
			$price = get_service_price($service_id);

/// 2014.01.19 消費税改定対応 begin

			$tmp_price = $price;				/// 備品価格
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$price      = $tmp_price;

/// 2014.01.19 消費税改定対応 end

			$num = $_POST['num'.$x];
			if($_POST['cancel_flag'.$x]){
				$cancel_flag=1;
			}else{
				$cancel_flag=0;
			}

			$sql = "insert into a_reserve_s (reserve_id, service_id, num, price, cancel_flag) values ($reserve_id, $service_id, $num, $price, $cancel_flag)";
			//print "$sql<br>";
			db_get_all($sql);

		}
	}

	admin_client_redirect('service_revision&reserve_id='.$reserve_id, 'サービスの予約情報を修正しました。予約データの料金も修正してください。');


    }
}


?>
