<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// プロフィール項目追加
class admin_do_add_cancel_charge extends OpenPNE_Action
{

    function execute($requests)
    {
	//var_dump($_REQUEST);

	// データチェック
	if(is_null($_POST['1_day1']) or is_null($_POST['1_percent1'])){
		admin_client_redirect('cancel_config', "パターン１の最上段は必須項目です。".$_POST['hall_id']);
	}

	if(!$_POST['1_flag'] and !$_POST['2_flag'] and !$_POST['3_flag'] and !$_POST['4_flag'] and !$_POST['5_flag'] and !$_POST['6_flag']){
		admin_client_redirect('cancel_config', "パターンが有効になっていません。１つ以上のパターンを有効にしてください。".$_POST['hall_id']);
	}

	// フラグデータ変換
	if(!$_POST['1_flag']){
		$_POST['1_flag']=0;
	}
	if(!$_POST['2_flag']){
		$_POST['2_flag']=0;
	}
	if(!$_POST['3_flag']){
		$_POST['3_flag']=0;
	}
	if(!$_POST['4_flag']){
		$_POST['4_flag']=0;
	}
	if(!$_POST['5_flag']){
		$_POST['5_flag']=0;
	}
	if(!$_POST['6_flag']){
		$_POST['6_flag']=0;
	}


	// 登録データ削除
	$sql = "delete from a_cancel_charge where hall_id = ".$_POST['hall_id'];	db_get_all($sql);

	// パターン登録
	for($x=1; $x<7;$x++){

		//print $_POST[$x.'_flag'];

		$sql = "insert into a_cancel_charge (hall_id, pattern_id, ";
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day1'])){
			$sql.= "day1, percent1, ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day2'])){
			$sql.= "day2, percent2, ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day3'])){
			$sql.= "day3, percent3, ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day4'])){
			$sql.= "day4, percent4, ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day5'])){
			$sql.= "day5, percent5, ";
		}
		$sql.= "flag) values (".$_POST['hall_id'].", $x, ";
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day1'])){
			$sql.= $_POST[$x.'_day1'].", ".$_POST[$x.'_percent1'].", ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day2'])){
			$sql.= $_POST[$x.'_day2'].", ".$_POST[$x.'_percent2'].", ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day3'])){
			$sql.= $_POST[$x.'_day3'].", ".$_POST[$x.'_percent3'].", ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day4'])){
			$sql.= $_POST[$x.'_day4'].", ".$_POST[$x.'_percent4'].", ";
		}
		if(preg_match("/^[0-9]+$/", $_POST[$x.'_day5'])){
			$sql.= $_POST[$x.'_day5'].", ".$_POST[$x.'_percent5'].", ";
		}
		$sql.= $_POST[$x.'_flag'].")";

		db_get_all($sql);
		//print $sql;

	}


        admin_client_redirect('cancel_config', $_POST['hall_id']);


    }
}

?>
