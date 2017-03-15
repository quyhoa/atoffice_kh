<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_add_room_regular_holiday extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_POST);

	// 登録データ削除
	$sql = "delete from a_room_regular_holiday where hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'];
	db_get_all($sql);

	// カラム名リスト
	$col_list = get_col_list();

	// 値があるかチェックする
	$box_flag=0;
	foreach($col_list as $value){
		if(isset($_POST[$value]) && $_POST[$value]){
			$box_flag++;
		}
	}

	if($box_flag){

		$sql1 = "insert into a_room_regular_holiday (";
		$sql2 = ") values (";
		$sql3 = ")";
		$col = "";
		$val = "";

		foreach($col_list as $value){
			if(isset($_POST[$value]) && $_POST[$value]){
				$col .= $value.",";
				$val .= $_POST[$value].",";
			}
		}

		$col = substr($col, 0, strlen($col)-1);
		$val = substr($val, 0, strlen($val)-1);

		$sql = $sql1.$col.$sql2.$val.$sql3;

		//print $sql;
		db_get_all($sql);

	}

        admin_client_redirect('room_holiday_conf', '定休日設定を更新しました。'.$_POST['hall_id']."_".$_POST['room_id']);
    }
}

function get_col_list(){

	$sql = "DESCRIBE a_room_regular_holiday";
	$result = db_get_all($sql);
	$list = array();

	foreach($result as $key => $val){
		array_push($list, $val['Field']);
	}
	return($list);

}

?>
