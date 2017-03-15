<?php
/**
 * @copyright 2005-2008 OpenPNE Project
 * @license   http://www.php.net/license/3_01.txt PHP License 3.01
 */

// 画像リスト
class admin_page_hall_kiyaku_preview extends OpenPNE_Action
{

    function execute($requests)
    {

	// アクセス権限
	$sql = "select name, atoffice_auth_type from c_admin_user where username = '".$_SESSION['_authsession']['username']."'";
	$result = db_get_all($sql);
	$this->set('name', $result[0]['name']);
	$this->set('atoffice_auth_type', $result[0]['atoffice_auth_type']);

	//var_dump($_REQUEST);


	$hall_id = $_GET['h'];
	$this->set('hall_id', $hall_id);


	//print $service_id;

	//会場名・総部屋数データ取得
	$sql = "select * from a_hall where hall_id = $hall_id";
	$hall_data = db_get_all($sql);
	$this->set('hall_data', $hall_data[0]);



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
