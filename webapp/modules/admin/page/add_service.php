<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_add_service extends OpenPNE_Action
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
		$msg = explode("。", $_GET['msg']);
		$this->set('msg', $msg[0]);
		$id = explode("_", $msg[1]);
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
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('hall_name', $result[0]['hall_name']);


	//備品データ取得
	$sql = "select * from a_service_data where hall_id = $hall_id and service_id = $service_id";
	$result = db_get_all($sql);

	$this->set('service_list', $result[0]);



        return 'success';
    }
}

?>
