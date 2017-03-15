<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_bank_config extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if(preg_match("/^[0-9]+$/", $_GET['msg'])){
		$hall_id = $_GET['msg'];
		$this->set('msg', '口座データを登録しました');
	}elseif($_GET['msg']){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	//口座データ
	$sql = "select * from a_bank_data where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('bank_data', $result[0]);

	//会場名
	$sql = "select hall_name from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$this->set('hall_name', $result[0]['hall_name']);


        return 'success';
    }
}

?>
