<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_vessel extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$result[0]['name'] = isset($result[0]['name']) ? $result[0]['name'] : null;
	$result[0]['atoffice_auth_type'] = isset($result[0]['atoffice_auth_type']) ? $result[0]['atoffice_auth_type'] : null;
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	$hall_id 		= null;
	$vessel_id 		= null;
	$delete_flag 	= null;

	if(!empty($_GET['msg'])){
		$msg = explode("。", $_GET['msg']);
		$this->set('msg', $msg[0]);
		$id = explode("_", $msg[1]);
		$hall_id = $id[0];
		$vessel_id = $id[1];
		if($vessel_id){
			$delete_flag = 1;
		}
	}else{
		$hall_id = $_POST['hall_id'];
		$vessel_id = isset($_POST['vessel_id']) ? $_POST['vessel_id'] : null;
		$delete_flag = isset($_POST['delete_flag']) ? $_POST['delete_flag'] : null;
	}
	$this->set('hall_id', $hall_id);
	$this->set('vessel_id', $vessel_id);
	$this->set('delete_flag', $delete_flag);

	//print $vessel_id;

	//会場名・総部屋数データ取得
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$result[0]['hall_name'] = isset($result[0]['hall_name']) ? $result[0]['hall_name'] : null;
	$this->set('hall_name', $result[0]['hall_name']);


	//備品データ取得
	$sql = "select * from a_vessel_data where hall_id = $hall_id and vessel_id = $vessel_id";
	$result = db_get_all($sql);

	$result[0] = isset($result[0]) ? $result[0] : null;
	$this->set('vessel_list', $result[0]);



        return 'success';
    }
}

?>
