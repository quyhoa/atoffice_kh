<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_room_vessel_conf extends OpenPNE_Action
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



	//選択済み備品データ取得
	$sql = "select vessel_id from a_room_vessel where hall_id = $hall_id and room_id = $room_id";
	$room_vessel_list_db = db_get_all($sql);

	$room_vessel_list=array();
	foreach($room_vessel_list_db as $value){
		array_push($room_vessel_list, $value['vessel_id']);
	}

	//var_dump($room_vessel_list);

	//備品データ取得
	$sql = "select * from a_vessel_data where hall_id = $hall_id and flag = 1 order by weight desc";
	$result = db_get_all($sql);


	foreach($result as $key=>$value){

		if (in_array($value[vessel_id], $room_vessel_list)){
			$result[$key]['checked']=1;
		}else{
			$result[$key]['checked']=0;
		}

	}

	//var_dump($result);

	$this->set('vessel_list', $result);


        return 'success';
    }
}

?>
