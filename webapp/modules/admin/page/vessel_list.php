<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_vessel_list extends OpenPNE_Action
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

	if(!empty($_GET['msg'])){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	//会場名・総部屋数データ取得
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$result[0]['hall_name'] = isset($result[0]['hall_name']) ? $result[0]['hall_name'] : null;
	$this->set('hall_name', $result[0]['hall_name']);

	//備品データ取得
	$sql = "select * from a_vessel_data where hall_id = $hall_id order by weight desc;";
	$result = db_get_all($sql);

	$this->set('vessel_list', $result);


        return 'success';
    }
}

?>
