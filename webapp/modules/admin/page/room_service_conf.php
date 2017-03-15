<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_room_service_conf extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if($_GET['msg']){
		$msg = split("。", $_GET['msg']);
		$this->set('msg', $msg[0]);
		$id = split("_", $msg[1]);
		$hall_id = $id[0];
		$room_id = $id[1];
	}else{
		$hall_id = $_POST['hall_id'];
		$room_id = $_POST['room_id'];
	}
	$this->set('hall_id', $hall_id);
	$this->set('room_id', $room_id);

	//会場名・総部屋数データ取得
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('hall_name', $result[0]['hall_name']);

	// 部屋名
	$sql = "select room_name from a_room where hall_id = $hall_id ";
	$sql.= "and room_id = $room_id";
	$result = db_get_all($sql);
	$this->set('room_name', $result[0]['room_name']);



	//選択済みサービスデータ取得
	$sql = "select service_id from a_room_service where hall_id = $hall_id and room_id = $room_id";
	$room_service_list_db = db_get_all($sql);

	$room_service_list=array();
	foreach($room_service_list_db as $value){
		array_push($room_service_list, $value['service_id']);
	}

	//var_dump($room_service_list);

	//サービスデータ取得
	$sql = "select * from a_service_data where hall_id = $hall_id and flag = 1 order by weight desc";
	$result = db_get_all($sql);


	foreach($result as $key=>$value){

		if (in_array($value[service_id], $room_service_list)){
			$result[$key]['checked']=1;
		}else{
			$result[$key]['checked']=0;
		}

	}

	//var_dump($result);

	$this->set('service_list', $result);


        return 'success';
    }
}

?>
