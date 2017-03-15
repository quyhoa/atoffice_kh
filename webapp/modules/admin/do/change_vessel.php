<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_change_vessel extends OpenPNE_Action
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

	$list = $_POST['vessel_list_num'];


	$sql = "select * from a_reserve_list where reserve_id = '$reserve_id'";
	$reserve_data = db_get_all($sql, $db);
	$reserve_data = $reserve_data[0];

/// 2013.12.21 消費税改定対応 begin

	$tmp_date = strtotime($reserve_data['begin_datetime']);	/// 会議室使用開始時刻
	$tmp_date = date('Y-m-d 00:00:00', $tmp_date);		/// 消費税率適用日

	$tmp_sql  = "";
	$tmp_sql .= "select rate from a_tax ";			/// 消費税率テーブル
	$tmp_sql .= "where stadate <= '$tmp_date' ";		/// 適用開始日
	$tmp_sql .= "order by stadate desc ";			/// 適用開始日の降順
	$tmp_sql .= "limit 0, 1";				/// 先頭１件
	$tmp_tab  = db_get_all($tmp_sql, $db);
	$tmp_tax  = $tmp_tab[0]['rate'] / 100;			/// 消費税率

/// 2013.12.21 消費税改定対応 end

	$hall_id = $reserve_data['hall_id'];
	$room_id = $reserve_data['room_id'];
	$begin_datetime = $reserve_data['begin_datetime'];
	$finish_datetime = $reserve_data['finish_datetime'];

	$key=0;
	$reserve_v=array();
	for($x=0;$x<$list_num;$x++){
		if($_POST['vessel_id'.$x]){
			$reserve_v[$key]['reserve_id']=$reserve_id;
			$reserve_v[$key]['vessel_id']=$_POST['vessel_id'.$x];
			$reserve_v[$key]['num']=$_POST['num'.$x];
			$sql = "select * from a_vessel_data where vessel_id = ".$_POST['vessel_id'.$x];
			$result = db_get_all($sql);

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $result[0]['price'];		/// 備品価格
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));

			$reserve_v[$key]['price'] = $tmp_price;

/// 2013.12.21 消費税改定対応 end

			$key++;
		}
	}


	// 在庫不足再確認

	if($reserve_v){
		foreach($reserve_v as $value){

			// 在庫数
			$sql = "select num from a_vessel_data where vessel_id = ".$value['vessel_id'];
			$zaiko = db_get_all($sql);
			$zaiko = $zaiko[0]['num'];
			// 時間帯のかぶっている他の予約
			$sql = "select reserve_id from a_reserve_list where hall_id = $hall_id and room_id != $room_id and cancel_flag=0 and ((begin_datetime between '$begin_datetime' and '$finish_datetime') or (finish_datetime between '$begin_datetime' and '$finish_datetime') or ('$begin_datetime' between begin_datetime and finish_datetime))";
			$reserve_id_list = db_get_all($sql);
			// 予約数
			if($reserve_id_list){
				$sql = "select num from a_reserve_v where vessel_id = ".$value['vessel_id'];
				$sql.= " and (";
				foreach($reserve_id_list as $k=>$v){
					$sql.= "reserve_id = ".$v['reserve_id'];
					if($reserve_id_list[($k+1)]['reserve_id']){
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
			if (($reserve_v_num + $value['num']) > $zaiko){
				admin_client_redirect('vessel_revision&reserve_id='.$reserve_id, get_vessel_name($value['vessel_id']).'の在庫が不足のため、変更できませんでした。');
				exit();
			}
		}// foreach
	}// if($reserve_v)

	// ログ登録
	$sql = "select * from a_reserve_v where reserve_id = $reserve_id";
	$old_data = db_get_all($sql);
	$sql = "select * from a_rv_log where reserve_id = $reserve_id order by revision_id desc";
	$revision_id = db_get_all($sql);
	if($revision_id){
		$revision_id = $revision_id[0]['revision_id']+1;
	}else{
		$revision_id = 1;
	}

	foreach($old_data as $key=>$value){
		$sql = "insert into a_rv_log (reserve_id, vessel_id, num, price, cancel_flag, staff_name, revision_id, change_datetime) values (";
		$sql.= "'$reserve_id', ";
		$sql.= "'".$value['vessel_id']."', ";
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
	$sql = "delete from a_reserve_v where reserve_id = $reserve_id";
	db_get_all($sql);

	for($x=0;$x<$list;$x++){
//		if($_POST['vessel_id'.$x]){
		if($_POST['vessel_id'.$x] && !$_POST['cancel_flag'.$x]){
			$vessel_id = $_POST['vessel_id'.$x];
			$price = get_vessel_price($vessel_id);

/// 2013.12.21 消費税改定対応 begin

			$tmp_price = $price;				/// 備品価格
			$tmp_price = round($tmp_price * 100 / 105);	/// 本体価格
			$tmp_price = round($tmp_price * (1 + $tmp_tax));
			$price      = $tmp_price;

/// 2013.12.21 消費税改定対応 end

			$num = $_POST['num'.$x];
/*
			if($_POST['cancel_flag'.$x]){
				$cancel_flag=1;
			}else{
				$cancel_flag=0;
			}
*/
//			$sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price, cancel_flag) values ($reserve_id, $vessel_id, $num, $price, $cancel_flag)";
			$sql = "insert into a_reserve_v (reserve_id, vessel_id, num, price, cancel_flag) values ($reserve_id, $vessel_id, $num, $price, 0)";
			//print "$sql";
			db_get_all($sql);

		}
	}


	admin_client_redirect('vessel_revision&reserve_id='.$reserve_id, '備品の予約情報を修正しました。予約データの料金も修正してください。');


    }
}


?>
