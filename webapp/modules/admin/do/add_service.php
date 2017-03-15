<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_service extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	//削除
	if($_POST['delete_flag']==2){
		$sql="delete from a_service_data where service_id = ".$_POST['service_id'];

		db_get_all($sql);
		//部屋利用
		$sql="delete from a_room_service where service_id = ".$_POST['service_id'];
		db_get_all($sql);

		admin_client_redirect('service_list', $_POST['service_name'].'を削除しました。'.$_POST['hall_id']);
		exit();
	}


	// データチェック

	if($_POST['service_name'] == ""){
		admin_client_redirect('add_service', 'サービス名称を入力してください。'.$_POST['hall_id']."_".$_POST['service_id']);
		exit();
	}

	if(!preg_match("/^[0-9]+$/", $_POST['price'])){
		admin_client_redirect('add_service', '使用料金は正の整数を入力してください。'.$_POST['hall_id']."_".$_POST['service_id']);
		exit();
	}

	if(!preg_match("/^[0-9]+$/", $_POST['minimum_orders'])){
		admin_client_redirect('add_service', '最低予約数は正の整数を入力してください。'.$_POST['hall_id']."_".$_POST['service_id']);
		exit();
	}

	if($_POST['cancel_mode'] == ""){
		admin_client_redirect('add_service', 'キャンセル料のモードを選択してください。'.$_POST['hall_id']."_".$_POST['service_id']);
		exit();
	}

	if($_POST['flag'] == ""){
		admin_client_redirect('add_service', '状態を選択してください。'.$_POST['hall_id']."_".$_POST['service_id']);
		exit();
	}

	// 登録


	// カラム名リスト
	$col_list = get_col_list();

	// 値があるかチェックする
	$box_flag=0;
	foreach($col_list as $value){
		if($_POST[$value]){
			$box_flag++;
		}
	}

	if($box_flag){

		if($_POST['service_id']){

		$sql = "update a_service_data SET ";
		$where = " where service_id = ".$_POST['service_id'];
		foreach($col_list as $value){
			if($_POST[$value]){
				$sql .= $value."=";
				if(!preg_match("/^[0-9]+$/", $_POST[$value])){
					$sql .= "'".$_POST[$value]."',";
				}else{
					$sql .= $_POST[$value].",";
				}
			}
		}
		$sql = substr($sql, 0, strlen($sql)-1).$where;
		//print $sql;
		db_get_all($sql);

		// 公開変更
		if($_POST['flag']==2){
			$sql = "update a_room_service SET flag = 1 where service_id = ".$_POST['service_id'];
		}else{
			$sql = "update a_room_service SET flag = 0 where service_id = ".$_POST['service_id'];
		}
		db_get_all($sql);


		admin_client_redirect('add_service', 'サービスデータを更新しました。'.$_POST['hall_id']."_".$_POST['service_id']);

		exit();

		}else{

		$sql1 = "insert into a_service_data (";
		$sql2 = ") values (";
		$sql3 = ")";
		$col = "";
		$val = "";

		foreach($col_list as $value){
			if($_POST[$value]){
				$col .= $value.",";
				if(!preg_match("/^[0-9]+$/", $_POST[$value])){
					$val .= "'".$_POST[$value]."',";
				}else{
					$val .= $_POST[$value].",";
				}
			}
		}

		$col = substr($col, 0, strlen($col)-1);
		$val = substr($val, 0, strlen($val)-1);

		$sql = $sql1.$col.$sql2.$val.$sql3;

		//print "<br>".$sql;

		db_get_all($sql);

		}

	}else{
        	admin_client_redirect('add_service', 'サービスの登録に失敗しました。'.$_POST['hall_id']);
	}



        admin_client_redirect('add_service', 'サービスを追加しました。'.$_POST['hall_id']);


    }
}


function get_col_list(){

	$sql = "DESCRIBE a_service_data";
	$result = db_get_all($sql);
	$list = array();

	foreach($result as $key => $val){
		array_push($list, $val['Field']);
	}
	return($list);

}

?>
