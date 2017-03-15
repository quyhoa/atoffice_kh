<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_cancel_config extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);

	if(isset($_GET['msg']) && preg_match("/^[0-9]+$/", $_GET['msg'])){
		$hall_id = $_GET['msg'];
		$this->set('msg', 'キャンセル料率を設定しました');
	}elseif(isset($_GET['msg']) && $_GET['msg']){
		$hall_id = preg_replace("/[^0-9]+/", "", $_GET['msg']);
		$this->set('msg', preg_replace("/[0-9]+/", "", $_GET['msg']));
	}else{
		$hall_id = $_POST['hall_id'];
	}
	$this->set('hall_id', $hall_id);

	//キャンセル率データ
	$sql = "select * from a_cancel_charge where hall_id = $hall_id order by pattern_id asc";
	$result = db_get_all($sql);

	$this->set('cancel_data', $result);
	//var_dump($result);

	//会場名、キャンセル設定範囲
	$sql = "select hall_name, cancel_days from a_hall where hall_id = $hall_id";
	$result = db_get_all($sql);
	$result[0]['hall_name'] = isset($result[0]['hall_name']) ? $result[0]['hall_name'] : null;
	$result[0]['cancel_days'] = isset($result[0]['cancel_days']) ? $result[0]['cancel_days'] : 0;
	$this->set('hall_name', $result[0]['hall_name']);
	$this->set('cancel_days', $result[0]['cancel_days']);

	$day_list=array();

	for ($x=$result[0]['cancel_days']; $x>=0; $x--){
		array_push($day_list, strval($x));
	}
	//var_dump($day_list);

	$this->set('day_list', $day_list);

        return 'success';
    }
}

?>
