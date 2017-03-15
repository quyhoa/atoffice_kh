<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_room extends OpenPNE_Action
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

	//会場名データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$result1 = db_get_all($sql);
	$this->set('hall_name', $result1[0]['hall_name']);

	// POSTデータ　又は　設定済みデータ取得

	if($_POST['confrim']){

		$this->set('room_data', $_POST);

		// コマ設定数（7コマ）
		$koma_list = array();
		for($x=0; $x<7; $x++){
			$koma_list[$x]['num']=$x+1;
			$koma_list[$x]['price']=$_POST['price'.($x+1)];
			$koma_list[$x]['begin_time']=$_POST['begin_time'.($x+1)];
			$koma_list[$x]['finish_time']=$_POST['finish_time'.($x+1)];
		}

		$this->set('koma_list', $koma_list);


	}else{
		$sql = "select * from a_room where hall_id = $hall_id and room_id = $room_id";
		$result = db_get_all($sql);
		if($result[0]['type'] == 1){
			$this->set('begin', $result1[0]['begin1']);
			$this->set('finish', $result1[0]['finish1']);
		}
		if($result[0]['type'] == 2){
			$this->set('begin', $result1[0]['begin2']);
			$this->set('finish', $result1[0]['finish2']);
		}
		if($result[0]['type'] == 3){
			$this->set('begin', $result1[0]['begin3']);
			$this->set('finish', $result1[0]['finish3']);
		}
		if($result[0]['type'] == 4){
			$this->set('begin', $result1[0]['begin4']);
			$this->set('finish', $result1[0]['finish4']);
		}
		if($result[0]){

		foreach($result[0] as $key=>$value){
			if($key=="room_name"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="num_school"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="num_mouth"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="num_theater"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="corp"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="individual"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="conference"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="seminar"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="training"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="interview"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="party"){
				$result[0][$key.$result[0]['type']]=$value;
			}
			if($key=="etc"){
				$result[0][$key.$result[0]['type']]=$value;
			}
		}

		}

		//var_dump($result[0]);

		$this->set('room_data', $result[0]);

		// コマ設定数（7コマ）
		$koma_list = array();
		for($x=0; $x<7; $x++){
			if($result[0]['finish_time'.($x+1)]){
				$koma_list[$x]['num']=$x+1;
				$koma_list[$x]['price']=$result[0]['price'.($x+1)];
				$koma_list[$x]['begin_time']=$result[0]['begin_time'.($x+1)];
				$koma_list[$x]['finish_time']=$result[0]['finish_time'.($x+1)];
			}else{
				$koma_list[$x]['num']=$x+1;
			}
		}
		//var_dump($koma_list);
		$this->set('koma_list', $koma_list);

	}



	// 有効なキャンセル料率パターン
	$sql = "select * from a_cancel_charge where hall_id = $hall_id and ";
	$sql.= "flag = 1";
	$result = db_get_all($sql);
	$this->set('cancel_charge', $result);

        return 'success';
    }
}

?>
