<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_preview extends OpenPNE_Action
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
		$service_id = $id[1];
		if($service_id){
			$delete_flag = 1;
		}
	}else{
		$hall_id = $_POST['hall_id'];
		$service_id = $_POST['service_id'];
		$delete_flag = $_POST['delete_flag'];
	}
	$this->set('hall_id', $hall_id);
	$this->set('service_id', $service_id);
	$this->set('delete_flag', $delete_flag);

	//print $service_id;

	//会場名・総部屋数データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$this->set('hall_data', $hall_data[0]);

	//画像データ
	$sql = "select * from a_hall_image where hall_id = $hall_id ";
	$sql.= "order by image_id";
	$result = db_get_all($sql);
	$this->set('image_data', $result);

	//有効な部屋データ取得
	$sql = "select * from a_room where hall_id = $hall_id and flag = 1";
	$result = db_get_all($sql);

	foreach($result as $key=>$value){
		//キャンセル料率
		$sql = "select * from a_cancel_charge where hall_id = $hall_id and pattern_id = ".$value['cancel'];
		$cancel_list = db_get_all($sql);
		//var_dump($cancel_list);
		$result[$key]['cancel_list'] = $cancel_list[0];

		// 最大収容人数
		if($value['num_school'] > $value['num_mouth'] and $value['num_school'] > $value['num_theater']){
			$max_num = $value['num_school'];
		}elseif($value['num_theater'] > $value['num_mouth']){
			$max_num = $value['num_theater'];
		}else{
			$max_num = $value['num_mouth'];
		}
		$result[$key]['max_num'] = $max_num;

	}


	$this->set('room_data', $result);


	//有効な備品データ取得
	$sql = "select * from a_vessel_data where hall_id = $hall_id and flag = 1";
	$result = db_get_all($sql);
	foreach($result as $key=>$value){
		$result[$key]['used_room']="";
		$sql = "select room_id from a_room_vessel where vessel_id = ".$value['vessel_id'];
		$room_id_vessel = db_get_all($sql);
		if($room_id_vessel[0]['room_id']){
			foreach($room_id_vessel as $v){
				$sql="select room_name from a_room where hall_id = $hall_id and room_id = ".$v['room_id'];
				$room_name_vessel = db_get_all($sql);
				$result[$key]['used_room'].= $room_name_vessel[0]['room_name']."\n";
			}
		}
	}

	$this->set('vessel_list', $result);

	//有効なサービスデータ取得
	$sql = "select * from a_service_data where hall_id = $hall_id and flag = 1";
	$result = db_get_all($sql);
	foreach($result as $key=>$value){
		$result[$key]['used_room']="";
		$sql = "select room_id from a_room_service where service_id = ".$value['service_id'];
		$room_id_service = db_get_all($sql);
		if($room_id_service[0]['room_id']){
			foreach($room_id_service as $v){
				$sql="select room_name from a_room where hall_id = $hall_id and room_id = ".$v['room_id'];
				$room_name_service = db_get_all($sql);
				$result[$key]['used_room_service'].= $room_name_service[0]['room_name']."\n";
			}
		}
	}

	$this->set('service_list', $result);


	//近隣会場データ（同県）
	$sql = "select * from a_hall where hall_id != $hall_id and flag != 2 and address_prefecture = ".$hall_data[0]['address_prefecture']." limit 10";
	$result = db_get_all($sql);
	foreach($result as $key=>$value){
		$sql = "select image_filename from a_hall_image where hall_id = ".$value['hall_id']." and image_id = 1";
		$image = db_get_all($sql);
		$result[$key]['image_filename']=$image[0]['image_filename'];
	}
	$this->set('vicinity', $result);


        return 'success';
    }
}

?>
