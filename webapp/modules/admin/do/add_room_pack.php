<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_add_room_pack extends OpenPNE_Action
{

    function execute($requests)
    {

	//var_dump($_REQUEST);

	// データチェック
	for($x=1;$x<7;$x++){
		if($_POST['pack_name'.$x] and !$_POST['price'.$x]){
        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'のPack料金が入力されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
		}
		if(!$_POST['pack_name'.$x] and $_POST['price'.$x]){
        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'の名称が入力されていません。'.$_POST['hall_id']."_".$_POST['room_id']);
		}

		if($_POST['price'.$x] and !preg_match("/^[0-9]+$/", $_POST['price'.$x])){
        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'のPack料金は正の整数で入力してください。'.$_POST['hall_id']."_".$_POST['room_id']);
		}

		if($_POST['pack_name'.$x] and !is_null($_POST['begin_time'.$x]) and !is_null($_POST['finish_time'.$x])){
			if($_POST['begin_time'.$x] >= $_POST['finish_time'.$x]){
	        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'の開始～終了時間の範囲が無効です。'.$_POST['hall_id']."_".$_POST['room_id']);

			}

			// 開始時間チェック
			$sql = "select count(*) as count from a_room where (hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'].") and (begin_time1 = ".$_POST['begin_time'.$x]." or begin_time2 = ".$_POST['begin_time'.$x]." or begin_time3 = ".$_POST['begin_time'.$x]." or begin_time4 = ".$_POST['begin_time'.$x]." or begin_time5 = ".$_POST['begin_time'.$x]." or begin_time6 = ".$_POST['begin_time'.$x]." or begin_time7 = ".$_POST['begin_time'.$x].")";

			//print $sql;

			$result = db_get_all($sql);
			if(!$result[0]['count']){
	        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'の開始で始まるコマがないため無効です。'.$_POST['hall_id']."_".$_POST['room_id']);
			}


			// 終了時間チェック
			$sql = "select count(*) as count from a_room where (hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'].") and (finish_time1 = ".$_POST['finish_time'.$x]." or finish_time2 = ".$_POST['finish_time'.$x]." or finish_time3 = ".$_POST['finish_time'.$x]." or finish_time4 = ".$_POST['finish_time'.$x]." or finish_time5 = ".$_POST['finish_time'.$x]." or finish_time6 = ".$_POST['finish_time'.$x]." or finish_time7 = ".$_POST['finish_time'.$x].")";

			//print $sql;

			$result = db_get_all($sql);
			if(!$result[0]['count']){
	        		admin_client_redirect('room_discount_conf', 'パック料金設定'.mb_convert_kana($x, 'A').'の終了で終わるコマがないため無効です。'.$_POST['hall_id']."_".$_POST['room_id']);
			}


		}


	}


	// 削除
	$sql = "delete from a_room_pack where hall_id = ".$_POST['hall_id']." and room_id = ".$_POST['room_id'];
	db_get_all($sql);

	// 登録
	for($x=1; $x<7; $x++){
		if($_POST['price'.$x]){
			if(!$_POST['pack_flag'.$x]){
				$_POST['pack_flag'.$x]=0;
			}
			$sql1 = "insert into a_room_pack (hall_id, room_id, pack_id, pack_name, pack_flag, ";
			$sql2 = "price) values (".$_POST['hall_id'].", ".$_POST['room_id'].", $x, '".$_POST['pack_name'.$x]."', ".$_POST['pack_flag'.$x].", ";

			$sql3 = $_POST['price'.$x].")";
			$col = "";
			$val = "";
			if($_POST['begin_time'.$x]){
				$col.="begin_time, finish_time, ";
				$val.=$_POST['begin_time'.$x].", ".$_POST['finish_time'.$x].", ";
			}
			if($_POST['koma1_'.$x]){
				$col.="koma1, ";
				$val.=$_POST['koma1_'.$x].", ";
			}
			if($_POST['koma2_'.$x]){
				$col.="koma2, ";
				$val.=$_POST['koma2_'.$x].", ";
			}
			$sql = $sql1.$col.$sql2.$val.$sql3;

			//print $sql."<br>";
			db_get_all($sql);

		}

	}


        admin_client_redirect('room_discount_conf', 'パック料金設定を更新しました。'.$_POST['hall_id']."_".$_POST['room_id']);

    }
}

?>
