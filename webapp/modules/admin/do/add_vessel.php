<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_vessel extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	//削除
	if($_POST['delete_flag']==2){
		//メイン
		$sql="delete from a_vessel_data where vessel_id = ".$_POST['vessel_id'];

		db_get_all($sql);
		//部屋利用
		$sql="delete from a_room_vessel where vessel_id = ".$_POST['vessel_id'];
		db_get_all($sql);

		admin_client_redirect('vessel_list', $_POST['vessel_name'].'を削除しました。'.$_POST['hall_id']);
		exit();
	}


	// データチェック

	if($_POST['vessel_name'] == ""){
		admin_client_redirect('add_vessel', '備品名称を入力してください。'.$_POST['hall_id']."_".$_POST['vessel_id']);
		exit();
	}

	if(!preg_match("/^[0-9]+$/", $_POST['num'])){
		admin_client_redirect('add_vessel', '在庫数は正の整数を入力してください。'.$_POST['hall_id']."_".$_POST['vessel_id']);
		exit();
	}

	if(!preg_match("/^[0-9]+$/", $_POST['price'])){
		admin_client_redirect('add_vessel', '使用料金は正の整数を入力してください。'.$_POST['hall_id']."_".$_POST['vessel_id']);
		exit();
	}

	if($_POST['charge_devision'] == ""){
		admin_client_redirect('add_vessel', '料金区分を選択してください。'.$_POST['hall_id']."_".$_POST['vessel_id']);
		exit();
	}

	if($_POST['flag'] == ""){
		admin_client_redirect('add_vessel', '状態を選択してください。'.$_POST['hall_id']."_".$_POST['vessel_id']);
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

		if($_POST['vessel_id']){

		$sql = "update a_vessel_data SET ";
		$where = " where vessel_id = ".$_POST['vessel_id'];
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
			$sql = "update a_room_vessel SET flag = 1 where vessel_id = ".$_POST['vessel_id'];
		}else{
			$sql = "update a_room_vessel SET flag = 0 where vessel_id = ".$_POST['vessel_id'];
		}
		db_get_all($sql);

		admin_client_redirect('add_vessel', '備品データを更新しました。'.$_POST['hall_id']."_".$_POST['vessel_id']);

		exit();

		}else{

		$sql1 = "insert into a_vessel_data (";
		$sql2 = ") values (";
		$sql3 = ")";
		$col = "";
		$val = "";

		foreach($col_list as $value){
			if(!is_null($_POST[$value])){
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
        	admin_client_redirect('add_vessel', '備品の登録に失敗しました。'.$_POST['hall_id']);
	}



        admin_client_redirect('add_vessel', '備品を追加しました。'.$_POST['hall_id']);


    }
}


function get_col_list(){

	$sql = "DESCRIBE a_vessel_data";
	$result = db_get_all($sql);
	$list = array();

	foreach($result as $key => $val){
		array_push($list, $val['Field']);
	}
	return($list);

}

?>
