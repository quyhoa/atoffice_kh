<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_add_room_discount extends OpenPNE_Action
{

    function execute($requests)
    {

	//var_dump($_REQUEST);

	// 解除
	if($_POST['mode']==1){

		$sql = "update a_room_discount SET flag = 0 where hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'];
		db_get_all($sql);

		admin_client_redirect('room_discount_conf', 'パターン割引設定を解除しました。'.$_POST['hall_id']."_".$_POST['room_id']);
		exit();
	}

	// データチェック
	for($x=1;$x<7;$x++){
		if($x<4){
			if($_POST['begin_year'.$x] and $_POST['finish_year'.$x]){
	// 割引率が入力されているか
	if(!$_POST['percent'.$x]){
		admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の割引率が入力されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
			}

	// 日付が存在するか
	if(!checkdate($_POST['begin_month'.$x], $_POST['begin_day'.$x], $_POST['begin_year'.$x])){
		admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の開始期間で存在しない月日が選択されています。'.$_POST['hall_id']."_".$_POST['room_id']);
	}
	if(!checkdate($_POST['finish_month'.$x], $_POST['finish_day'.$x], $_POST['finish_year'].$x)){
		admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の終了期間で存在しない月日が選択されています。'.$_POST['hall_id']."_".$_POST['room_id']);
	}

	// 開始日　＜　終了日　になっているか
	$begin = strval($_POST['begin_year'.$x]).strval(sprintf("%02d", $_POST['begin_month'.$x])).strval(sprintf("%02d", $_POST['begin_day'.$x]));
	$finish = strval($_POST['finish_year'.$x]).strval(sprintf("%02d", $_POST['finish_month'.$x])).strval(sprintf("%02d", $_POST['finish_day'.$x]));
	if(intval($finish) <= intval($begin)){
		admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の終了期間は開始期間より後日で設定してください。'.$_POST['hall_id']."_".$_POST['room_id']);
	}

			}elseif($_POST['percent'.$x]){
				admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の期間で年が選択されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
			}
		}else{
		// パターン4～6
			if(!$_POST['continuance'.$x] and $_POST['percent'.$x]){
				admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の対象が選択されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
			}elseif($_POST['continuance'.$x] and !$_POST['percent'.$x]){
				admin_client_redirect('room_discount_conf', 'パターン'.mb_convert_kana($x, 'A').'の割引率が入力されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
			}
		}
	}


	// 全削除
	$sql = "delete from a_room_discount where hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'];
	db_get_all($sql);

	// 登録
	for($x=1; $x<7; $x++){
		if($x<4){
			if($_POST['percent'.$x]){
				$sql = "insert into a_room_discount (hall_id, room_id, pattern_id, flag, begin_year, begin_month, begin_day, finish_year, finish_month, finish_day, percent) values (";
				$sql.=$_POST['hall_id'].", ";
				$sql.=$_POST['room_id'].", ";
				$sql.=$x.", ";
				if($_POST['pattern']==$x){
					$sql.= "1, ";
				}else{
					$sql.="0, ";
				}
				$sql.=$_POST['begin_year'.$x].", ";
				$sql.=$_POST['begin_month'.$x].", ";
				$sql.=$_POST['begin_day'.$x].", ";
				$sql.=$_POST['finish_year'.$x].", ";
				$sql.=$_POST['finish_month'.$x].", ";
				$sql.=$_POST['finish_day'.$x].", ";
				$sql.=$_POST['percent'.$x];
				$sql.=")";
				//print $sql."<br>";
				db_get_all($sql);
			}

		}else{

			if($_POST['percent'.$x]){
				$sql = "insert into a_room_discount (hall_id, room_id, pattern_id, flag, continuance, percent) values (";
				$sql.=$_POST['hall_id'].", ";
				$sql.=$_POST['room_id'].", ";
				$sql.=$x.", ";
				if($_POST['pattern']==$x){
					$sql.= "1, ";
				}else{
					$sql.="0, ";
				}
				$sql.=$_POST['continuance'.$x].", ";
				$sql.=$_POST['percent'.$x];
				$sql.=")";
				//print $sql."<br>";
				db_get_all($sql);
			}

		}
	}


        admin_client_redirect('room_discount_conf', '割引設定を更新しました。'.$_POST['hall_id']."_".$_POST['room_id']);

    }
}

?>
