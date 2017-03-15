<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// スキン画像更新
class admin_do_add_room_service extends OpenPNE_Action
{

    function execute($requests)
    {

	//var_dump($_REQUEST);

	// 一旦削除
	$sql = "delete from a_room_service where hall_id = ".$_POST['hall_id'];
	$sql.= " and room_id = ".$_POST['room_id'];
	db_get_all($sql);


	// 登録
	if ($_POST['service_id']){

		foreach($_POST['service_id'] as $value){

            $sql = "select weight from a_service_data where service_id = ".$value;
            $result = db_get_all($sql);
            $weight = $result[0]['weight'];

			$sql = "insert into a_room_service (hall_id, room_id, service_id, weight) values (".$_POST['hall_id'].", ".$_POST['room_id'].", ".$value.", ".$weight.")";
			//print "<br>".$sql."<br>";
			db_get_all($sql);
		}

	}

        admin_client_redirect('room_service_conf', '利用可能サービスを更新しました。'.$_POST['hall_id']."_".$_POST['room_id']);

    }
}

?>
